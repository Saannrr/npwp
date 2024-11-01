<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DasarPemotongan;
use App\Models\DokumenPphPasal;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\DokumenPphpasalResource;
use App\Http\Requests\DokumenPphpasalCreateRequest;

class DokumenPphpasalController extends Controller
{
    public function getAll()
    {
        $dokumen = DokumenPphPasal::all();
        return DokumenPphpasalResource::collection($dokumen);
    }

    public function create(DokumenPphpasalCreateRequest $request): JsonResponse
    {
        $data = $request->validated();

        // Simpan data dokumen PPh Pasal terlebih dahulu
        $dokumen = new DokumenPphPasal([
            'nama_dokumen' => $data['nama_dokumen'],
            'no_dokumen' => $data['no_dokumen'],
            'tgl_dokumen' => $data['tgl_dokumen'],
            // pphpasal_id akan diisi setelah pph pasal dibuat
        ]);

        $dokumen->user_id = Auth::user()->id;
        $dokumen->save();

        return response()->json(new DokumenPphpasalResource($dokumen), 201);
    }

    public function destroy($id): JsonResponse
    {
        $dokumen = DokumenPphPasal::findOrFail($id);
        $dokumen->delete();
        return response()->json([
            'message' => 'Dokumen Pph Pasal deleted successfully'
        ], 200);
    }
}
