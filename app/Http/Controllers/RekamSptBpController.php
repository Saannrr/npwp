<?php

namespace App\Http\Controllers;

use App\Models\RekamSptBp;
use Illuminate\Http\Request;
use App\Models\PembayaranSpt;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\RekamSptBpResource;
use App\Http\Requests\RekamSptBpCreateRequest;

class RekamSptBpController extends Controller
{
    public function getAll()
    {
        $rekamSptBp = RekamSptBp::all();
        return RekamSptBpResource::collection($rekamSptBp);
    }

    public function create(RekamSptBpCreateRequest $request): JsonResponse
    {
        // Ambil user_id yang sedang login
        $userId = auth()->user()->id;

        // Query awal untuk mencari data di tabel pembayaran_spts
        $query = PembayaranSpt::where('ntpn', $request->ntpn_id)
            ->where('tahun_pajak', $request->tahun_pajak);

        // Jika beda_npwp_id tidak di-check (false), maka npwp_id harus sesuai
        if (!$request->beda_npwp_id) {
            $query->where('npwp_penyetor', $request->npwp_id);
        }

        // Eksekusi query untuk mencari data pembayaran_spts
        $pembayaranSpt = $query->first();

        // Jika tidak ditemukan, return error
        if (!$pembayaranSpt) {
            return response()->json([
                'error' => 'Data pembayaran tidak ditemukan atau tidak valid'
            ], 404);
        }

        // Siapkan data untuk insert ke RekamSptBp
        $rekamSptBpData = [
            'user_id' => $userId,
            'jenis_bukti_penyetoran' => $request->jenis_bukti_penyetoran,
            'npwp_id' => $request->npwp_id, // Tetap simpan npwp_id yang diinput user
            'ntpn_id' => $request->ntpn_id,
            'nomor_pemindahbukuan' => $request->nomor_pemindahbukuan,
            'tahun_pajak' => $request->tahun_pajak,
            'masa_pajak' => $pembayaranSpt->masa_pajak, // Dari pembayaran_spts
            'jenis_pajak' => $pembayaranSpt->kode_jenis_pajak, // Dari pembayaran_spts
            'jenis_setoran' => $pembayaranSpt->kode_jenis_setoran, // Dari pembayaran_spts
            'jumlah_setor' => $pembayaranSpt->jumlah_setor, // Dari pembayaran_spts
            'pph_yang_dipotong' => $pembayaranSpt->pph_yang_dipotong, // Dari pembayaran_spts
            'tanggal_setor' => $pembayaranSpt->created_at, // Dari pembayaran_spts
            'beda_npwp_id' => $request->beda_npwp_id ? 1 : 0 // Checkbox untuk beda npwp_id
        ];

        // Insert data ke RekamSptBp
        $rekamSptBp = RekamSptBp::create($rekamSptBpData);

        // Return response dengan resource
        return (new RekamSptBpResource($rekamSptBp))
            ->response()
            ->setStatusCode(201);
    }

    public function destroy($id): JsonResponse
    {
        $rekamSptBp = RekamSptBp::find($id);

        if (!$rekamSptBp) {
            return response()->json([
                'message' => 'Rekam SPT Bukti Potong not found'
            ], 404);
        }

        $rekamSptBp->delete();

        return response()->json([
            'message' => 'Rekam SPT Bukti Potong deleted successfully'
        ], 200);
    }
}
