<?php

namespace App\Http\Controllers;

use App\Models\PphPasal;
use Illuminate\Http\Request;
use App\Models\IdentitasOrang;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\PphpasalResource;
use App\Http\Requests\PphpasalCreateRequest;
use App\Http\Requests\PphpasalUpdateRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class PphpasalController extends Controller
{
    public function getAll()
    {
        $pphpasal = PphPasal::all();
        return PphpasalResource::collection($pphpasal);
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

    public function update(PphpasalUpdateRequest $request, $id): JsonResponse
    {
        // Validasi input dari request
        $data = $request->validated();

        // Cari data Pphpasal berdasarkan ID
        $pphpasal = PphPasal::findOrFail($id);

        // Tentukan field yang diizinkan untuk di-update
        $allowUpdateFields = [
            'tahun_pajak',
            'masa_pajak',
            'dasar_pemotongan_id',
            'kode_objek_pajak',
            'fasilitas_pajak_penghasilan',
            'no_fasilitas',
            'jumlah_penghasilan_bruto',
            'tarif',
            'jumlah_setor',
            'kelebihan_pemotongan',
            'status'
        ];

        // Update hanya field yang diizinkan
        foreach ($allowUpdateFields as $field) {
            if (isset($data[$field])) {
                $pphpasal->$field = $data[$field];
            }
        }

        // Simpan perubahan ke database
        $pphpasal->save();

        return (new PphpasalResource($pphpasal))->response()->setStatusCode(200);
    }
}
