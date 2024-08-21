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
        $tahunPajak = $request->$data('tahun_pajak');
        $masaPajak = $request->$data('masa_pajak');

        // Cek di setiap tabel PPH berdasarkan tahun pajak dan masa pajak
        $pphPasal = PphPasal::where('tahun_pajak', $tahunPajak)
            ->where('masa_pajak', $masaPajak)
            ->first();

        // $pphNonResiden = PphNonResiden::where('tahun_pajak', $tahunPajak)
        //     ->where('masa_pajak', $masaPajak)
        //     ->first();

        // $pphSetorSendiri = PphSetorSendiri::where('tahun_pajak', $tahunPajak)
        //     ->where('masa_pajak', $masaPajak)
        //     ->first();

        // $imporDataPph = ImporDataPph::where('tahun_pajak', $tahunPajak)
        //     ->where('masa_pajak', $masaPajak)
        //     ->first();

        // Tentukan tipe pajak berdasarkan data yang ditemukan
        if ($pphPasal) {
            $posting = new PostingPph();
            $posting->pph()->associate($pphPasal);
            $posting->status = 'success';
            $posting->save();
            return (new PostingPphResource($posting))->response()->json(['message' => 'PPH Pasal 4 berhasil diposting'], 201);
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

        // Jika tidak ditemukan data pajak, return response error
        return response()->json(['message' => 'Data pajak tidak ditemukan untuk periode ini'], 404);
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
