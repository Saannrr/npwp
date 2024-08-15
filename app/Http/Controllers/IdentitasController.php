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
        $query = $request->input('query');
        $identitas = IdentitasOrang::where('npwp', $query)->orWhere('nik', $query)->first();

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
