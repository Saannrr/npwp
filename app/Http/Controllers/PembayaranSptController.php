<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\PerekamanBp;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PembayaranSpt;
use App\Models\PajakPenghasilan;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\PembayaranSptResource;
use App\Http\Requests\PembayaranSptCreateRequest;

class PembayaranSptController extends Controller
{
    public function getAll()
    {
        $pembayaranSpt = PembayaranSpt::all();
        return PembayaranSptResource::collection($pembayaranSpt);
    }

    public function create(PembayaranSptCreateRequest $request)
    {
        // Mengambil data dari tabel PerekamanBp berdasarkan kode_billing
        $perekamanBp = PerekamanBp::where('id_billing', $request->kode_billing)->first();

        // Jika kode_billing tidak ditemukan, berikan error
        if (!$perekamanBp) {
            return response()->json(['error' => 'Kode Billing tidak ditemukan'], 404);
        }

        // Mengambil data terkait dari PajakPenghasilan
        $pajakPenghasilan = PajakPenghasilan::find($perekamanBp->pajak_penghasilan_id);

        // Jika pajak penghasilan tidak ditemukan, berikan error
        if (!$pajakPenghasilan) {
            return response()->json(['error' => 'Pajak Penghasilan tidak ditemukan'], 404);
        }

        // Mengambil data terkait dari PphPasal
        $pphPasal = $pajakPenghasilan->pphpasal;

        // Generate nomor NTPN dan nomor transaksi bank secara acak
        $ntpn = Str::random(16); // Random 16 digit (alphanumeric)
        $nomorTransaksiBank = mt_rand(100000000000, 999999999999); // Random 12 digit angka

        // Buat record di tabel PembayaranSpt
        $pembayaranSpt = PembayaranSpt::create([
            'user_id' => auth()->user()->id, // Mengambil user_id yang sedang login
            'npwp_id' => $pphPasal->npwp_id, // Mengambil npwp_id dari PerekamanBp
            'nama_wp' => $pphPasal->nama, // Mengambil nama dari PphPasal
            'alamat_wp' => $request->alamat,
            'ntpn' => $ntpn, // Nomor Transaksi Penerimaan Negara (NTPN)
            'kode_billing' => $perekamanBp->id_billing, // Mengambil kode_billing dari PerekamanBp
            'kode_jenis_pajak' => $perekamanBp->jenis_pajak, // Mengambil kode jenis pajak dari PerekamanBp
            'kode_jenis_setoran' => $perekamanBp->jenis_setoran, // Mengambil kode jenis setoran dari PerekamanBp
            'pph_yang_dipotong' => $perekamanBp->pph_yang_dipotong, // Mengambil pph yang dipotong dari PerekamanBp
            'jumlah_setor' => $request->jumlah_setor, // Input jumlah setor
            'masa_pajak' => $perekamanBp->masa_pajak, // Mengambil masa_pajak dari PerekamanBp
            'tahun_pajak' => $perekamanBp->tahun_pajak, // Mengambil tahun_pajak dari PerekamanBp
            'nop' => $request->has('nop') ? $request->nop : '-', // Jika nop tidak ada, set ke '-'
            'nomor_ketetapan' => $request->has('nomor_ketetapan') ? $request->nomor_ketetapan : '00000/000/00/000/00', // Default nomor ketetapan
            'uraian' => $request->uraian, // Uraian (opsional)
            'nama_bank' => $request->nama_bank, // Nama bank dari input user
            'nomor_transaksi_bank' => $nomorTransaksiBank, // Nomor transaksi bank 12 digit acak
            'npwp_penyetor' => $request->npwp_penyetor, // NPWP penyetor dari input user
        ]);

        // Menggunakan Resource untuk mengembalikan response
        return new PembayaranSptResource($pembayaranSpt);
    }

    public function destroy($id): JsonResponse
    {
        $pembayaranSpt = PembayaranSpt::find($id);

        if (!$pembayaranSpt) {
            return response()->json([
                'message' => 'Pembayaran SPT not found'
            ], 404);
        }

        $pembayaranSpt->delete();

        return response()->json([
            'message' => 'Pembayaran SPT deleted successfully'
        ], 200);
    }
}
