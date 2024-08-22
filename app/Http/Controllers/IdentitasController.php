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
        $noIdentitas = $request->input('no_identitas');
        $nama = $request->input('nama');

        // Search for a matching record where both no_identitas and nama match
        $identitas = IdentitasOrang::where(function ($query) use ($noIdentitas) {
            $query->where('npwp', $noIdentitas)
                ->orWhere('nik', $noIdentitas);
        })
            ->where('nama', $nama)
            ->first();

        if ($identitas) {
            return response()->json([
                new IdentitasResource($identitas)
            ]);
        }

        return response()->json([
            'errors' => 'Identitas tidak ditemukan'
        ], 404);
    }
}
