<?php

namespace App\Http\Controllers;

use App\Models\PphPasal;
use App\Models\PostingPph;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\PostingPphResource;
use App\Http\Requests\PostingPphCreateRequest;

class PostingPphController extends Controller
{
    public function getAll()
    {
        $pph = PostingPph::all();
        return PostingPphResource::collection($pph);
    }

    public function cariPostingPph(Request $request): JsonResponse
    {
        $tahunPajak = $request->input('tahun_pajak');
        $masaPajak = $request->input('masa_pajak');

        $postingan = PostingPph::where('tahun_pajak', $tahunPajak)->orWhere('masa_pajak', $masaPajak)->first();

        if ($postingan) {
            return response()->json([
                new PostingPphResource($postingan)
            ]);
        }

        return response()->json([
            'errors' => 'Posting Pph tidak ditemukan'
        ], 404);
    }

    public function create(PostingPphCreateRequest $request): JsonResponse
    {
        $data = $request->validated();

        // Ambil input user
        $tahunPajak = $data['tahun_pajak'];
        $masaPajak = $data['masa_pajak'];

        // Cek di setiap tabel PPH berdasarkan tahun pajak dan masa pajak
        $pphPasals = PphPasal::where('tahun_pajak', $tahunPajak)
            ->where('masa_pajak', $masaPajak)
            ->get();

        // $pphNonResiden = PphNonResiden::where('tahun_pajak', $tahunPajak)
        //     ->where('masa_pajak', $masaPajak)
        //     ->first();

        // $pphSetorSendiri = PphSetorSendiri::where('tahun_pajak', $tahunPajak)
        //     ->where('masa_pajak', $masaPajak)
        //     ->first();

        // $imporDataPph = ImporDataPph::where('tahun_pajak', $tahunPajak)
        //     ->where('masa_pajak', $masaPajak)
        //     ->first();

        // Jika tidak ada data pajak yang ditemukan
        if ($pphPasals->isEmpty()) {
            return response()->json(['message' => 'Data pajak tidak ditemukan untuk periode ini'], 404);
        }

        // Iterasi setiap PPH Pasal yang ditemukan
        foreach ($pphPasals as $pphPasal) {
            // Cek apakah data sudah pernah di-posting di pph pasal
            $existingPosting = PostingPph::where('pph_id', $pphPasal->id)
                ->where('pph_type', get_class($pphPasal))
                ->where('tahun_pajak', $tahunPajak)
                ->where('masa_pajak', $masaPajak)
                ->first();

            if ($existingPosting) {
                // Jika data sudah pernah di-posting, skip dan lanjutkan ke data berikutnya
                continue;
            }

            // Tentukan tipe pajak berdasarkan data yang ditemukan
            if ($pphPasal) {
                $posting = new PostingPph();
                $posting->user_id = auth()->user()->id;
                $posting->pph()->associate($pphPasal);
                $posting->tahun_pajak = $tahunPajak;
                $posting->masa_pajak = $masaPajak;
                $posting->status = 'Success';
                $pphPasal->status = 'Sudah di posting';
                $posting->kode_objek_pajak = $pphPasal->kode_objek_pajak;
                $pphPasal->save();
                $posting->save();
            } // elseif ($pphNonResiden) {
            //     $posting = new PostingPajak();
            //     $posting->taxable()->associate($pphNonResiden);
            //     $posting->status = 'success';
            //     $posting->save();
            //     return response()->json(['message' => 'PPH Non Residen berhasil diposting'], 201);
            // } elseif ($pphSetorSendiri) {
            //     $posting = new PostingPajak();
            //     $posting->taxable()->associate($pphSetorSendiri);
            //     $posting->status = 'success';
            //     $posting->save();
            //     return response()->json(['message' => 'PPH yang Disetor Sendiri berhasil diposting'], 201);
            // } elseif ($imporDataPph) {
            //     $posting = new PostingPajak();
            //     $posting->taxable()->associate($imporDataPph);
            //     $posting->status = 'success';
            //     $posting->save();
            //     return response()->json(['message' => 'Impor Data PPH berhasil diposting'], 201);
            // }
        }

        // Return response setelah semua data diproses
        return response()->json([
            'message' => 'Semua PPH Pasal 4 untuk periode ini berhasil diposting'
        ], 201);
    }

    public function destroy($id): JsonResponse
    {
        $pph = PostingPph::findOrFail($id);
        $pph->delete();
        return response()->json([
            'message' => 'Posting Pph deleted successfully'
        ], 200);
    }
}
