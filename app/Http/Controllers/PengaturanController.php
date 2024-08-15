<?php

namespace App\Http\Controllers;

use App\Http\Requests\PengaturanCreateRequest;
use App\Http\Requests\PengaturanUpdateRequest;
use App\Http\Resources\PengaturanResource;
use App\Models\IdentitasOrang;
use App\Models\Pengaturan;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class PengaturanController extends Controller
{
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

    public function create(PengaturanCreateRequest $request): JsonResponse
    {
        $data = $request->validated();
        //        \Log::info('Data yang divalidasi:', $data);
        $user = Auth::user();

        // Validasi manual untuk NPWP dan NIK
        $npwpExists = isset($data['npwp_id']) && Pengaturan::where('npwp_id', $data['npwp_id'])->exists();
        $nikExists = isset($data['nik_id']) && Pengaturan::where('nik_id', $data['nik_id'])->exists();
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

        $pengaturan = new Pengaturan($data);
        $pengaturan->user_id = $user->id;
        $pengaturan->save();

        return (new PengaturanResource($pengaturan))->response()->setStatusCode(201);
    }

    public function getAll()
    {
        $penandatangan = Pengaturan::all();
        return PengaturanResource::collection($penandatangan);
    }

    public function update(PengaturanUpdateRequest $request, $id): JsonResponse
    {
        // Validasi data yang diterima
        $data = $request->validated();

        // Cari pengaturan berdasarkan ID
        $pengaturan = Pengaturan::findOrFail($id);

        // Periksa apakah status yang akan diperbarui sama dengan status yang ada
        if ((bool)$pengaturan->status === (bool)$data['status']) {
            throw new HttpResponseException(response([
                "errors" => [
                    "message" => [
                        "Status penandatangan tidak diperbarui"
                    ]
                ]
            ], 401));
        }

        // Update status
        $pengaturan->status = $data['status'];
        $pengaturan->save();

        return response()->json([
            'message' => 'Status penandatangan berhasil diperbarui.',
            'data' => $pengaturan
        ], 200);
    }

    public function destroy($id)
    {
        $penandatangan = Pengaturan::findOrFail($id);
        $penandatangan->delete();

        return response()->json([
            'message' => 'Penandatangan berhasil dihapus.',
            'data' => $penandatangan
        ], 200);
    }
}
