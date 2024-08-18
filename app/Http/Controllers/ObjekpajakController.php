<?php

namespace App\Http\Controllers;

use App\Models\ObjekPajak;
use Illuminate\Http\Request;
use App\Http\Resources\ObjekpajakResource;

class ObjekpajakController extends Controller
{
    public function getAll()
    {
        $objekpajak = ObjekPajak::all();
        return ObjekpajakResource::collection($objekpajak);
    }

    public function cariObjekPajak(Request $request)
    {
        $query = $request->input('query');
        $objekpajak = ObjekPajak::where('kode_pajak', $query)->first();

        if ($objekpajak) {
            return response()->json([
                new ObjekpajakResource($objekpajak)
            ]);
        }

        return response()->json([
            'errors' => 'Kode pajak tidak ditemukan'
        ], 404);
    }
}
