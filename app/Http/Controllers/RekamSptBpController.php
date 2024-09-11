<?php

namespace App\Http\Controllers;

use App\Models\RekamSptBp;
use App\Models\PerekamanBp;
use App\Models\PenyiapanSpt;
use Illuminate\Http\Request;
use App\Models\PembayaranSpt;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\RekamSptBpResource;
use App\Http\Requests\RekamSptBpCreateRequest;

class RekamSptBpController extends Controller
{
    public function getAll()
    {
        $rekamSptBp = RekamSptBp::all();
        return RekamSptBpResource::collection($rekamSptBp);
    }

    public function create(RekamSptBpCreateRequest $request): JsonResponse
    {
        // Ambil user_id yang sedang login
        $userId = auth()->user()->id;

        // Query awal untuk mencari data di tabel pembayaran_spts
        $query = PembayaranSpt::where('ntpn', $request->ntpn_id)
            ->where('tahun_pajak', $request->tahun_pajak);

        // Jika beda_npwp_id tidak di-check (false), maka npwp_id harus sesuai
        if (!$request->beda_npwp_id) {
            $query->where('npwp_penyetor', $request->npwp_id);
        }

        // Eksekusi query untuk mencari data pembayaran_spts
        $pembayaranSpt = $query->first();

        // Jika tidak ditemukan, return error
        if (!$pembayaranSpt) {
            return response()->json([
                'error' => 'Data pembayaran tidak ditemukan atau tidak valid'
            ], 404);
        }

        // Siapkan data untuk insert ke RekamSptBp
        $rekamSptBpData = [
            'user_id' => $userId,
            'jenis_bukti_penyetoran' => $request->jenis_bukti_penyetoran,
            'npwp_id' => $request->npwp_id, // Tetap simpan npwp_id yang diinput user
            'ntpn_id' => $request->ntpn_id,
            'nomor_pemindahbukuan' => $request->nomor_pemindahbukuan,
            'tahun_pajak' => $request->tahun_pajak,
            'masa_pajak' => $pembayaranSpt->masa_pajak, // Dari pembayaran_spts
            'jenis_pajak' => $pembayaranSpt->kode_jenis_pajak, // Dari pembayaran_spts
            'jenis_setoran' => $pembayaranSpt->kode_jenis_setoran, // Dari pembayaran_spts
            'jumlah_setor' => $pembayaranSpt->jumlah_setor, // Dari pembayaran_spts
            'pph_yang_dipotong' => $pembayaranSpt->pph_yang_dipotong, // Dari pembayaran_spts
            'tanggal_setor' => $pembayaranSpt->created_at, // Dari pembayaran_spts
            'beda_npwp_id' => $request->beda_npwp_id ? 1 : 0 // Checkbox untuk beda npwp_id
        ];

        // Insert data ke RekamSptBp
        $rekamSptBp = RekamSptBp::create($rekamSptBpData);

        // Coba mencari data di perekaman_bps berdasarkan kode_billing yang cocok dengan id_billing
        $perekamanBp = PerekamanBp::where('id_billing', $pembayaranSpt->kode_billing)->first();

        // Jika data ditemukan di perekaman_bps
        if ($perekamanBp) {
            // Update pph_yang_disetor dengan jumlah setor dari rekam_spt_bps
            $perekamanBp->pph_yang_disetor = $rekamSptBp->jumlah_setor;

            // Jika ada selisih antara pph_yang_dipotong dan pph_yang_disetor
            if ($perekamanBp->pph_yang_dipotong > $perekamanBp->pph_yang_disetor) {
                $perekamanBp->selisih = $perekamanBp->pph_yang_dipotong - $perekamanBp->pph_yang_disetor;
            } else {
                $perekamanBp->selisih = 0; // Jika tidak ada selisih
            }

            // Simpan perubahan di perekaman_bps
            $perekamanBp->save();
        }

        // Hitung total pph_yang_dipotong dari tabel perekaman_bps berdasarkan masa_pajak dan tahun_pajak
        $totalPphDisetor = PerekamanBp::where('masa_pajak', $rekamSptBp->masa_pajak)
            ->where('tahun_pajak', $rekamSptBp->tahun_pajak)
            ->sum('pph_yang_disetor');

        // Validasi apakah jumlah pph_yang_dipotong sesuai dengan kolom jumlah_pph_kurang_setor di tabel penyiapan_spts
        $penyiapanSpt = PenyiapanSpt::where('masa_pajak', $rekamSptBp->masa_pajak)
            ->where('tahun_pajak', $rekamSptBp->tahun_pajak)
            ->first();

        if ($penyiapanSpt && $totalPphDisetor == $penyiapanSpt->jumlah_pph_kurang_setor) {
            // Update keterangan_spt menjadi 'lengkapi spt'
            $penyiapanSpt->keterangan_spt = 'lengkapi spt';
            $penyiapanSpt->save();
        }

        // Return response dengan resource
        return (new RekamSptBpResource($rekamSptBp))
            ->response()
            ->setStatusCode(201);
    }

    public function destroy($id): JsonResponse
    {
        // Cari data rekam_spt_bp berdasarkan id
        $rekamSptBp = RekamSptBp::find($id);

        // Jika data tidak ditemukan, return error
        if (!$rekamSptBp) {
            return response()->json([
                'message' => 'Rekam SPT Bukti Potong not found'
            ], 404);
        }

        // Dapatkan nilai masa_pajak dan tahun_pajak sebelum dihapus
        $masaPajak = $rekamSptBp->masa_pajak;
        $tahunPajak = $rekamSptBp->tahun_pajak;

        // Cari data pembayaran_spts yang sesuai dengan ntpn_id
        $pembayaranSpt = PembayaranSpt::where('ntpn', $rekamSptBp->ntpn_id)->first();

        // Pastikan data pembayaran_spts ditemukan
        if (!$pembayaranSpt) {
            return response()->json([
                'message' => 'Data Pembayaran SPT tidak ditemukan'
            ], 404);
        }

        // Cocokkan kode_billing dari tabel pembayaran_spts dengan id_billing di tabel perekaman_bps
        $perekamanBp = PerekamanBp::where('id_billing', $pembayaranSpt->kode_billing)->first();

        // Pastikan data perekaman_bps ditemukan
        if ($perekamanBp) {
            // Kurangi pph_yang_disetor sesuai dengan jumlah_setor yang dihapus
            $perekamanBp->pph_yang_disetor -= $rekamSptBp->jumlah_setor;

            // Jika ada selisih karena penghapusan, update kolom selisih
            if ($perekamanBp->pph_yang_dipotong > $perekamanBp->pph_yang_disetor) {
                $perekamanBp->selisih = $perekamanBp->pph_yang_dipotong - $perekamanBp->pph_yang_disetor;
            } else {
                $perekamanBp->selisih = 0; // Set selisih ke 0 jika tidak ada selisih
            }

            $perekamanBp->save(); // Simpan perubahan ke tabel perekaman_bps
        }

        // Hapus data rekam_spt_bp
        $rekamSptBp->delete();

        // Cari data penyiapan_spt yang terkait
        $penyiapanSpt = PenyiapanSpt::where('masa_pajak', $masaPajak)
            ->where('tahun_pajak', $tahunPajak)
            ->first();

        if ($penyiapanSpt) {
            // Hitung total pph_yang_disetor dari perekaman_bps berdasarkan masa_pajak dan tahun_pajak
            $totalPphDisetor = PerekamanBp::where('masa_pajak', $masaPajak)
                ->where('tahun_pajak', $tahunPajak)
                ->sum('pph_yang_disetor');

            // Validasi apakah jumlah pph_yang_disetor lebih kecil dari jumlah_pph_kurang_setor
            if ($totalPphDisetor < $penyiapanSpt->jumlah_pph_kurang_setor) {
                // Update keterangan_spt menjadi 'kurang setor'
                $penyiapanSpt->keterangan_spt = 'kurang setor';
                $penyiapanSpt->save();
            }
        }

        // Return response berhasil
        return response()->json([
            'message' => 'Rekam SPT Bukti Potong deleted successfully and keterangan_spt updated if necessary'
        ], 200);
    }
}
