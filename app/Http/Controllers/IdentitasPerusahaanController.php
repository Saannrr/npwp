<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IdentitasPerusahaan;
use App\Http\Resources\IdentitasPerusahaanResource;

class IdentitasPerusahaanController extends Controller
{
    public function getAll()
    {
        $identitas = IdentitasPerusahaan::all();
        return IdentitasPerusahaanResource::collection($identitas);
    }

    public function cariIdentitasPerusahaan(Request $request)
    {
        $query = $request->input('query');
        $identitas = IdentitasPerusahaan::where('npwp_perusahaan', $query)->orWhere('nik_perusahaan', $query)->first();

        if ($identitas) {
            return response()->json([
                new IdentitasPerusahaanResource($identitas)
            ]);
        }

        return response()->json([
            'errors' => 'Identitas tidak ditemukan'
        ], 404);
    }
}
