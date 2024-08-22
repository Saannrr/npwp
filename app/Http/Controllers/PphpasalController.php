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
use Illuminate\Http\Exceptions\HttpResponseException;

class PphpasalController extends Controller
{
    public function getAll()
    {
        $pphpasal = PphPasal::all();
        return PphpasalResource::collection($pphpasal);
    }

    public function create(PphpasalCreateRequest $request): JsonResponse
    {
        $data = $request->validated();

        // Validasi manual untuk NPWP dan NIK
        $npwpExists = isset($data['npwp_id']) && IdentitasPerusahaan::where('npwp_perusahaan', $data['npwp_id'])->exists();
        $nikExists = isset($data['nik_id']) && IdentitasPerusahaan::where('nik_perusahaan', $data['nik_id'])->exists();

        // Cek apakah NPWP atau NIK ada di tabel IdentitasPerusahaans
        if (!$npwpExists && !$nikExists) {
            throw new HttpResponseException(response()->json([
                "errors" => [
                    "message" => [
                        "NPWP atau NIK tidak ditemukan"
                    ]
                ]
            ], 400));
        }

        // Ambil dokumen yang baru dibuat
        $dokumen = DokumenPphPasal::findOrFail($data['dokumen_pph_pasal_id']);

        // ambil id dokumen pph pasal id
        $data['dokumen_pph_pasal_id'] = $dokumen->id;

        // Ambil tarif dari tabel objekpajak berdasarkan kode objek pajak
        $kodeObjekPajak = $data['kode_objek_pajak'];
        $objekPajak = DB::table('objek_pajaks')->where('kode_pajak', $kodeObjekPajak)->first();

        if (!$objekPajak) {
            throw new HttpResponseException(response()->json([
                "errors" => [
                    "message" => [
                        "Kode objek pajak tidak valid"
                    ]
                ]
            ], 400));
        }

        $tarif = $objekPajak->persen; // Asumsi tarif dalam bentuk desimal (misalnya 0.1 untuk 10%)

        // Hitung pemotongan
        $jumlahPenghasilanBruto = $data['jumlah_penghasilan_bruto'];
        $jumlahSetor = $jumlahPenghasilanBruto * $tarif;

        // Set nilai yang sudah dihitung ke dalam data yang akan disimpan
        $data['tarif'] = $tarif;
        $data['jumlah_setor'] = $jumlahSetor;
        $data['status'] = 'Belum di post';

        $pphpasal = new PphPasal($data);
        $pphpasal->save();

        // Update dokumen dengan pphpasal_id yang baru dibuat
        $dokumen->pphpasal_id = $pphpasal->id;
        $dokumen->save();

        return (new PphpasalResource($pphpasal))->response()->setStatusCode(201);
    }

    public function update(PphpasalUpdateRequest $request, $id): JsonResponse
    {
        // Validasi input dari request
        $data = $request->validated();

        // Cari data Pphpasal berdasarkan ID
        $pphpasal = PphPasal::findOrFail($id);

        // Tentukan field yang diizinkan untuk di-update
        $allowUpdateFields = [
            'tahun_pajak',
            'masa_pajak',
            'dasar_pemotongan_id',
            'kode_objek_pajak',
            'fasilitas_pajak_penghasilan',
            'no_fasilitas',
            'jumlah_penghasilan_bruto',
            'tarif',
            'jumlah_setor',
            'kelebihan_pemotongan',
            'status'
        ];

        // Update hanya field yang diizinkan
        foreach ($allowUpdateFields as $field) {
            if (isset($data[$field])) {
                $pphpasal->$field = $data[$field];
            }
        }

        // Ambil tarif dari tabel objekpajak berdasarkan kode objek pajak
        $kodeObjekPajak = $data['kode_objek_pajak'];
        $objekPajak = DB::table('objek_pajaks')->where('kode_pajak', $kodeObjekPajak)->first();

        if (!$objekPajak) {
            throw new HttpResponseException(response()->json([
                "errors" => [
                    "message" => [
                        "Kode objek pajak tidak valid"
                    ]
                ]
            ], 400));
        }

        $tarif = $objekPajak->persen; // Asumsi tarif dalam bentuk desimal (misalnya 0.1 untuk 10%)

        // Hitung pemotongan
        $jumlahPenghasilanBruto = $data['jumlah_penghasilan_bruto'];
        $jumlahSetor = $jumlahPenghasilanBruto * $tarif;

        // Set nilai yang sudah dihitung ke dalam data yang akan disimpan
        $data['tarif'] = $tarif;
        $data['jumlah_setor'] = $jumlahSetor;

        // Simpan perubahan ke database
        $pphpasal->save();

        return (new PphpasalResource($pphpasal))->response()->setStatusCode(200);
    }

    public function destroy($id): JsonResponse
    {
        $pphpasal = PphPasal::findOrFail($id);
        $pphpasal->delete();
        return response()->json([
            'message' => 'Pph Pasal deleted successfully'
        ], 200);
    }
}
