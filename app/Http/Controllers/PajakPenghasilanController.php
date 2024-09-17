<?php

namespace App\Http\Controllers;

use App\Models\PerekamanBp;
use App\Models\PenyiapanSpt;
use Illuminate\Http\Request;
use App\Models\PajakPenghasilan;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\PajakPenghasilanResource;

class PajakPenghasilanController extends Controller
{
    public function getAll()
    {
        $pajak = PajakPenghasilan::with('pphpasal')->get();
        return PajakPenghasilanResource::collection($pajak);
    }

    public function cariPajakPenghasilan(Request $request): JsonResponse
    {
        // Ambil input dari request
        $tahunPajak = $request->input('tahun_pajak');
        $masaPajak = $request->input('masa_pajak');

        // Query pajak_penghasilans berdasarkan relasi ke pphpasal
        $pajakPenghasilans = PajakPenghasilan::with('pphpasal')->whereHas('pphpasal', function ($query) use ($tahunPajak, $masaPajak) {
            $query->where('tahun_pajak', $tahunPajak)
                ->where('masa_pajak', $masaPajak);
        })->get();

        // Cek apakah data ditemukan
        if ($pajakPenghasilans->isNotEmpty()) {
            return response()->json([
                'data' => PajakPenghasilanResource::collection($pajakPenghasilans)
            ]);
        }

        // Jika data tidak ditemukan, kembalikan response 404
        return response()->json([
            'errors' => 'Pajak Penghasilan tidak ditemukan'
        ], 404);
    }

    public function postPajakPenghasilan(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'masa_pajak' => 'required|in:januari,februari,maret,april,mei,juni,juli,agustus,september,oktober,november,desember',
            'tahun_pajak' => 'required|digits:4|integer|min:1900|max:' . date('Y'), // Validates a 4-digit year within the reasonable range
        ]);

        // Define mapping for tipe_pph to kode pajak
        $kodePajakMapping = [
            'pph pasal' => '4111',
            // Tambahkan mapping lainnya jika ada
        ];

        // Use DB transaction to wrap your logic
        DB::transaction(function () use ($validated, $kodePajakMapping) {
            // Find all unposted pajak_penghasilan records
            $pajakPenghasilans = PajakPenghasilan::where('is_posted', 0)
                ->whereHas('pphpasal', function ($query) use ($validated) {
                    $query->where('masa_pajak', $validated['masa_pajak'])
                        ->where('tahun_pajak', $validated['tahun_pajak']);
                })
                ->get();

            // Check if records are found
            if ($pajakPenghasilans->isEmpty()) {
                throw new \Exception('No matching unposted records found.');
            }

            // Initialize total jumlah_setor
            $totalJumlahSetor = 0;

            // Loop through each pajak_penghasilan record
            foreach ($pajakPenghasilans as $pajakPenghasilan) {
                // Get the related pph_pasal
                $pphPasal = $pajakPenghasilan->pphpasal;

                // Total jumlah_setor dari semua pph_pasal yang terkait
                $totalJumlahSetor += $pphPasal->jumlah_setor;

                // Get tipe_pph from pajak_penghasilan
                $tipePph = $pajakPenghasilan->tipe_pph;

                // Get kode from tipe_pph using the mapping
                $kodePajak = $kodePajakMapping[$tipePph] ?? null;

                if (!$kodePajak) {
                    throw new \Exception('Kode pajak tidak ditemukan untuk tipe_pajak: ' . $tipePph);
                }

                // Get the middle part of kode_objek_pajak from related pph_pasal
                $kodeObjekPajak = $pphPasal->kode_objek_pajak;
                $kodeObjekPajakParts = explode('-', $kodeObjekPajak);
                $jenisSetoran = $kodeObjekPajakParts[1] ?? null; // Bagian tengahnya

                // Combine kode_pajak and kode_objek_pajak to form jenis_pajak
                $jenisPajak = $kodePajak . $kodeObjekPajakParts[0];

                // Insert into perekaman_bps with jenis_pajak, jenis_setoran, and pph_yang_dipotong
                PerekamanBp::create([
                    'pajak_penghasilan_id' => $pajakPenghasilan->id,
                    'user_id' => auth()->user()->id,
                    'masa_pajak' => $validated['masa_pajak'],
                    'tahun_pajak' => $validated['tahun_pajak'],
                    'jenis_pajak' => $jenisPajak, // Insert combined kode_pajak + kode_objek_pajak here
                    'jenis_setoran' => $jenisSetoran, // Insert the middle part of kode_objek_pajak here
                    'pph_yang_dipotong' => $pphPasal->jumlah_setor, // Insert jumlah_setor from pph_pasals here
                    'pph_yang_disetor' => 0,
                    'selisih' => $pphPasal->jumlah_setor
                    // Add other necessary fields
                ]);

                // Mark the record as posted
                $pajakPenghasilan->is_posted = 1;
                $pajakPenghasilan->posting_date = now();
                $pajakPenghasilan->save();

                // **Update the status in pph_pasals to 'sudah di post'**
                $pphPasal->status = 'sudah di post';
                $pphPasal->save(); // Save the updated status in the pph_pasals table
            }

            // Insert into penyiapan_spts
            PenyiapanSpt::create([
                'user_id' => auth()->user()->id,
                'masa_pajak' => $validated['masa_pajak'],
                'tahun_pajak' => $validated['tahun_pajak'],
                'jumlah_pph_kurang_setor' => $totalJumlahSetor,
                // Add other necessary fields
            ]);
        });

        // Return success response outside of the transaction block
        return response()->json([
            'message' => 'Pajak penghasilan has been posted successfully.',
        ], 200);
    }

    public function destroy($id): JsonResponse
    {
        $pph = PajakPenghasilan::find($id);

        if (!$pph) {
            return response()->json([
                'message' => 'Pajak Penghasilan not found'
            ], 404);
        }

        $pph->delete();

        return response()->json([
            'message' => 'Pajak Penghasilan deleted successfully'
        ], 200);
    }
}
