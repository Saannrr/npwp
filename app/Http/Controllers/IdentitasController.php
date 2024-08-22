<?php

namespace App\Http\Controllers;

use App\Http\Resources\IdentitasResource;
use Illuminate\Http\Request;
use App\Models\IdentitasOrang;

class IdentitasController extends Controller
{
    public function getAllIdentitas()
    {
        $identitas = IdentitasOrang::all();
        return IdentitasResource::collection($identitas);
    }

    public function cariIdentitas(Request $request)
    {
        $nik = $request->input('nik');
        $nama = $request->input('nama');

        // Search for a matching record where both no_identitas and nama match
        $identitasNik = IdentitasOrang::where(function ($query) use ($nik) {
            $query->where('nik', $nik);
        })
            ->where('nama', $nama)
            ->first();

        if ($identitasNik) {
            return response()->json([
                new IdentitasResource($identitasNik)
            ]);
        }

        return response()->json([
            'errors' => 'Identitas tidak ditemukan'
        ], 404);
    }

    public function cariIdentitasByNpwp(Request $request)
    {
        $npwp = $request->input('npwp');

        $identitasNpwp = IdentitasOrang::where('npwp', $npwp)->first();

        if ($identitasNpwp) {
            return response()->json([
                new IdentitasResource($identitasNpwp)
            ]);
        }

        return response()->json([
            'errors' => 'Identitas tidak ditemukan'
        ], 404);
    }
}
