<?php

namespace App\Http\Controllers;

use App\Models\PphPasal;
use Illuminate\Http\Request;
use App\Models\IdentitasOrang;
use App\Models\DokumenPphPasal;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Models\IdentitasPerusahaan;
use App\Http\Resources\PphpasalResource;
use App\Http\Requests\PphpasalCreateRequest;
use App\Http\Requests\PphpasalUpdateRequest;
use App\Models\PajakPenghasilan;
use Illuminate\Http\Exceptions\HttpResponseException;

class PphpasalController extends Controller
{
    /**
     * Retrieve all PphPasal records.
     */
    public function getAll()
    {
        $pphpasal = PphPasal::withTrashed()->get();
        return PphpasalResource::collection($pphpasal);
    }

    public function getPphpasalById($id)
    {
        // Cari PphPasal berdasarkan ID
        $pphPasal = PphPasal::find($id);

        // Jika tidak ditemukan, kembalikan response 404
        if (!$pphPasal) {
            return response()->json([
                'errors' => 'Pph Pasal tidak ditemukan'
            ], 404);
        }

        // Jika ditemukan, kembalikan data menggunakan resource
        return new PphpasalResource($pphPasal);
    }

    /**
     * Create a new PphPasal record.
     */
    public function create(PphpasalCreateRequest $request): JsonResponse
    {
        $data = $request->validated();

        // Validasi manual untuk NPWP dan NIK di tabel users
        $npwpExists = isset($data['npwp_id']) && DB::table('users')->where('npwp', $data['npwp_id'])->exists();
        $nikExists = isset($data['nik_id']) && DB::table('users')->where('nik', $data['nik_id'])->exists();

        if (!$npwpExists && !$nikExists) {
            return response()->json([
                "errors" => [
                    "message" => "NPWP atau NIK tidak ditemukan"
                ]
            ], 400);
        }

        // Ambil tarif dari tabel objekpajak berdasarkan kode objek pajak
        $kodeObjekPajak = $data['kode_objek_pajak'];
        $objekPajak = DB::table('objek_pajaks')->where('kode_pajak', $kodeObjekPajak)->first();

        if (!$objekPajak) {
            return response()->json([
                "errors" => [
                    "message" => "Kode objek pajak tidak valid"
                ]
            ], 400);
        }

        $tarif = $objekPajak->persen;

        // Hitung pemotongan
        $jumlahPenghasilanBruto = $data['jumlah_penghasilan_bruto'];
        $jumlahSetor = $jumlahPenghasilanBruto * $tarif;

        // Set nilai yang sudah dihitung ke dalam data yang akan disimpan
        $data['tarif'] = $tarif;
        $data['jumlah_setor'] = $jumlahSetor;
        $data['status'] = 'Belum di post';

        // Cari dokumen yang belum memiliki pphpasal_id (null)
        $dokumens = DokumenPphPasal::whereNull('pphpasal_id')->get();

        if ($dokumens->isEmpty()) {
            return response()->json([
                "errors" => [
                    "message" => "Tidak ada dasar pemotongan!"
                ]
            ], 400);
        }

        DB::beginTransaction();
        try {
            // Simpan data ke tabel pph_pasals
            $pphpasal = new PphPasal($data);
            $pphpasal->user_id = auth()->user()->id;
            $pphpasal->save();

            // Simpan referensi pph_pasals ke pajak_penghasilans
            $pajakPenghasilan = new PajakPenghasilan();
            $pajakPenghasilan->pphpasal_id = $pphpasal->id;
            $pajakPenghasilan->tipe_pph = 'pph pasal';
            $pajakPenghasilan->save();

            // Assign dokumen's ID to dokumen_pph_pasal_id in the pph_pasals table
            $firstDokumen = $dokumens->first();
            $pphpasal->dokumen_pph_pasal_id = $firstDokumen->id;
            $pphpasal->save();

            // Update semua dokumen yang belum memiliki pphpasal_id
            foreach ($dokumens as $dokumen) {
                $dokumen->pphpasal_id = $pphpasal->id;
                $dokumen->save();
            }

            DB::commit();

            return (new PphpasalResource($pphpasal))->response()->setStatusCode(201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                "errors" => [
                    "message" => "Terjadi kesalahan saat menyimpan data: " . $e->getMessage()
                ]
            ], 500);
        }
    }

    /**
     * Update an existing PphPasal record.
     */
    public function update(PphpasalUpdateRequest $request, $id): JsonResponse
    {
        // Temukan PphPasal berdasarkan id
        $pphpasal = PphPasal::findOrFail($id);

        // Ambil data yang sudah divalidasi
        $data = $request->validated();

        // Jika identitas diubah menjadi 'nik', pastikan nik_id disertakan dan valid
        if (isset($data['identitas']) && $data['identitas'] === 'nik') {
            if (isset($data['nik_id'])) {
                $nikExists = DB::table('users')->where('nik', $data['nik_id'])->exists();
                if (!$nikExists) {
                    return response()->json([
                        "errors" => [
                            "message" => "NIK tidak ditemukan"
                        ]
                    ], 400);
                }
                // Update nik_id jika valid
                $pphpasal->nik_id = $data['nik_id'];
            } else {
                return response()->json([
                    "errors" => [
                        "message" => "NIK harus disertakan saat identitas adalah NIK"
                    ]
                ], 400);
            }
        }

        // Jika identitas diubah menjadi 'npwp', pastikan npwp_id disertakan dan valid
        if (isset($data['identitas']) && $data['identitas'] === 'npwp') {
            if (isset($data['npwp_id'])) {
                $npwpExists = DB::table('users')->where('npwp', $data['npwp_id'])->exists();
                if (!$npwpExists) {
                    return response()->json([
                        "errors" => [
                            "message" => "NPWP tidak ditemukan"
                        ]
                    ], 400);
                }
                // Update npwp_id jika valid
                $pphpasal->npwp_id = $data['npwp_id'];
            } else {
                return response()->json([
                    "errors" => [
                        "message" => "NPWP harus disertakan saat identitas adalah NPWP"
                    ]
                ], 400);
            }
        }

        // Jika kode_objek_pajak diubah, ambil tarif dari tabel objekpajak berdasarkan kode objek pajak baru
        if (isset($data['kode_objek_pajak'])) {
            $kodeObjekPajak = $data['kode_objek_pajak'];
            $objekPajak = DB::table('objek_pajaks')->where('kode_pajak', $kodeObjekPajak)->first();

            if (!$objekPajak) {
                return response()->json([
                    "errors" => [
                        "message" => "Kode objek pajak tidak valid"
                    ]
                ], 400);
            }

            $data['tarif'] = $objekPajak->persen;

            // Recalculate jumlah_setor jika tarif atau jumlah_penghasilan_bruto diubah
            if (isset($data['jumlah_penghasilan_bruto'])) {
                $data['jumlah_setor'] = $data['jumlah_penghasilan_bruto'] * $data['tarif'];
            } elseif (!isset($data['jumlah_setor'])) {
                // If jumlah_penghasilan_bruto is not provided but tarif is changed, recalculate jumlah_setor based on existing jumlah_penghasilan_bruto
                $data['jumlah_setor'] = $pphpasal->jumlah_penghasilan_bruto * $data['tarif'];
            }
        }

        // Tambahkan satu ke kolom revisi sebelum update
        $pphpasal->revisi += 1;

        // Update data PphPasal dengan data baru
        $pphpasal->update($data);

        // **Handle new dokumen with null pphpasal_id**
        $newDokumens = DokumenPphPasal::whereNull('pphpasal_id')->get();

        // Assign new dokumen to this pphpasal
        foreach ($newDokumens as $dokumen) {
            $dokumen->pphpasal_id = $pphpasal->id;
            $dokumen->save();
        }

        // **Handle existing dokumen update**
        if (isset($data['dokumen_pph_pasal_id'])) {
            // Cari dokumen yang sudah terkait dengan pphpasal_id
            $existingDokumens = DokumenPphPasal::where('pphpasal_id', $pphpasal->id)->get();

            // Update dokumen yang ada dengan dokumen baru
            foreach ($existingDokumens as $dokumen) {
                $dokumen->pphpasal_id = $data['dokumen_pph_pasal_id'];
                $dokumen->save();
            }
        }

        return (new PphpasalResource($pphpasal))->response()->setStatusCode(200);
    }

    /**
     * Delete a PphPasal record.
     */
    public function destroy($id): JsonResponse
    {
        $pphpasal = PphPasal::findOrFail($id);
        $pphpasal->delete();
        return response()->json([
            'message' => 'Pph Pasal deleted successfully'
        ], 200);
    }
}
