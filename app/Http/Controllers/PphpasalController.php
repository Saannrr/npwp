<?php

namespace App\Http\Controllers;

use App\Http\Requests\PphpasalCreateRequest;
use App\Http\Resources\PphpasalResource;
use App\Models\IdentitasOrang;
use App\Models\PphPasal;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PphpasalController extends Controller
{
    public function getAll()
    {
        $pphpasal = PphPasal::all();
        return PphpasalResource::collection($pphpasal);
    }

    public function cariIdentitas(Request $request)
    {
        $query = $request->input('query');
        $identitas = IdentitasOrang::where('npwp', $query)->orWhere('nik', $query)->first();

        if ($identitas) {
            return response()->json([
                'data' => $identitas
            ]);
        }

        return response()->json([
            'errors' => 'Identitas tidak ditemukan'
        ], 404);
    }

    public function create(PphpasalCreateRequest $request): JsonResponse
    {
        $data = $request->validated();

        // Validasi manual untuk NPWP dan NIK
        $npwpExists = isset($data['npwp_id']) && PphPasal::where('npwp_id', $data['npwp_id'])->exists();
        $nikExists = isset($data['nik_id']) && PphPasal::where('nik_id', $data['nik_id'])->exists();
//        $namaExists = isset($data['nama']) && Pengaturan::where('nama', $data['nama'])->exists();

        if ($npwpExists || $nikExists) {
            throw new HttpResponseException(response()->json([
                "errors" => [
                    "message" => [
                        "NPWP atau NIK sudah terdaftar"
                    ]
                ]
            ], 400));
        }

        $pphpasal = new PphPasal($data);
        $pphpasal->save();

        return (new PphpasalResource($pphpasal))->response()->setStatusCode(201);
    }
}
