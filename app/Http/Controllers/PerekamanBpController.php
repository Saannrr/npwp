<?php

namespace App\Http\Controllers;

use App\Models\PerekamanBp;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\PerekamanBpResource;

class PerekamanBpController extends Controller
{
    public function getAll()
    {
        $perekamanBps = PerekamanBp::all();
        return PerekamanBpResource::collection($perekamanBps);
    }

    public function cariPerekamanBp(Request $request): JsonResponse
    {
        // Ambil input dari request
        $tahunPajak = $request->input('tahun_pajak');
        $masaPajak = $request->input('masa_pajak');

        // Query pajak_penghasilans berdasarkan relasi ke pphpasal
        $perekamanBp = PerekamanBp::where('tahun_pajak', $tahunPajak)->where('masa_pajak', $masaPajak)->get();

        // Cek apakah data ditemukan
        if ($perekamanBp->isNotEmpty()) {
            return response()->json([
                'data' => PerekamanBpResource::collection($perekamanBp)
            ]);
        }

        // Jika data tidak ditemukan, kembalikan response 404
        return response()->json([
            'errors' => 'Perekaman Bukti Potong tidak ditemukan'
        ], 404);
    }

    public function generateIdBilling($perekamanBpId)
    {
        // Find the record by ID
        $perekamanBp = PerekamanBp::find($perekamanBpId);

        // Check if id_billing is already generated
        if ($perekamanBp->id_billing) {
            return response()->json([
                'message' => 'ID Billing already generated: ' . $perekamanBp->id_billing
            ], 200);
        }

        // Generate a 15-digit random number as id_billing
        $idBilling = str_pad(mt_rand(0, 999999999999999), 15, '0', STR_PAD_LEFT);

        // Store the generated id_billing in the database
        $perekamanBp->id_billing = $idBilling;
        $perekamanBp->save();

        return response()->json([
            'message' => 'ID Billing generated successfully.',
            'id_billing' => $idBilling
        ], 200);
    }
}
