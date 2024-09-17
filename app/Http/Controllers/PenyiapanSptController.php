<?php

namespace App\Http\Controllers;

use App\Models\Dopp;
use App\Models\Doss;
use App\Models\PphPasal;
use App\Models\PerekamanBp;
use App\Models\PenyiapanSpt;
use Illuminate\Http\Request;
use App\Models\PajakPenghasilan;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\PenyiapanSptResource;

class PenyiapanSptController extends Controller
{
    // TODO: bikin alur buat lengkapi spt dan kirim spt
    public function getAll()
    {
        $penyiapanSpt = PenyiapanSpt::all();
        return PenyiapanSptResource::collection($penyiapanSpt);
    }

    public function simpan_doss_dopp(request $request)
    {
        // 1. Ambil data dari tabel penyiapan_spts berdasarkan masa_pajak dan tahun_pajak
        $penyiapanSpt = PenyiapanSpt::where('masa_pajak', $request->masa_pajak)
            ->where('tahun_pajak', $request->tahun_pajak)
            ->first();

        if (!$penyiapanSpt) {
            return response()->json(['message' => 'Data Penyiapan SPT tidak ditemukan'], 404);
        }

        // 2. Ambil data perekaman_bps yang terkait dengan masa_pajak dan tahun_pajak dari penyiapan_spts
        $perekamanBps = PerekamanBp::where('masa_pajak', $penyiapanSpt->masa_pajak)
            ->where('tahun_pajak', $penyiapanSpt->tahun_pajak)
            ->get();

        if ($perekamanBps->isEmpty()) {
            return response()->json(['message' => 'Data Perekaman BPS tidak ditemukan'], 404);
        }

        $datadoss = [];
        $datadopp = [];

        // 3. Loop untuk mendapatkan pajak_penghasilan_id dan melakukan proses lebih lanjut
        foreach ($perekamanBps as $bps) {
            // Ambil pajak_penghasilan_id dari perekaman_bps
            $pajakPenghasilan = PajakPenghasilan::where('id', $bps->pajak_penghasilan_id)
                ->where('tipe_pph', 'pph pasal')  // Fokus ke tipe 'pph pasal'
                ->first();

            if (!$pajakPenghasilan) {
                continue;  // Jika pajak_penghasilan_id tidak ditemukan, lewati
            }

            // 4. Ambil pphpasal_id dari pajak_penghasilans
            $pphPasal = PphPasal::where('id', $pajakPenghasilan->pph_pasal_id)->first();

            if ($pphPasal) {
                // Ambil data DOSS dan DOPP dari request dan update sesuai dengan jumlah_setor dari pph_pasals

                $datadoss[] = [
                    [
                        'doss_point_id' => '1',
                        'kode_objek_pajak' => null,
                        'jumlah_dpp' => str_replace(",", "", $request->jumlah_dpp1),
                        'jumlah_pph' => str_replace(",", "", $request->jumlah_pph1),
                        'pajak_penghasilan_id' => $pajakPenghasilan->id,

                    ],
                    [
                        'doss_point_id' => '2',
                        'kode_objek_pajak' => null,
                        'jumlah_dpp' => str_replace(",", "", $request->jumlah_dpp2),
                        'jumlah_pph' => str_replace(",", "", $request->jumlah_pph2),
                        'pajak_penghasilan_id' => $pajakPenghasilan->id,
                    ],
                    [
                        'doss_point_id' => '3',
                        'kode_objek_pajak' => null,
                        'jumlah_dpp' => null,
                        'jumlah_pph' => str_replace(",", "", $request->jumlah_pph3),
                        'pajak_penghasilan_id' => $pajakPenghasilan->id,
                    ],
                    [
                        'doss_point_id' => '4',
                        'kode_objek_pajak' => null,
                        'jumlah_dpp' => null,
                        'jumlah_pph' => str_replace(",", "", $request->jumlah_pph4),
                        'pajak_penghasilan_id' => $pajakPenghasilan->id,
                    ],
                    [
                        'doss_point_id' => '5',
                        'kode_objek_pajak' => null,
                        'jumlah_dpp' => null,
                        'jumlah_pph' => str_replace(",", "", $request->jumlah_pph5),
                        'pajak_penghasilan_id' => $pajakPenghasilan->id,
                    ]
                ];

                $datadopp[] = [
                    [
                        'dopp_point_id' => '1',
                        'kode_objek_pajak' => "22-101-01",
                        'jumlah_dpp' => str_replace(",", "", $request->jumlah_dpp6),
                        'jumlah_pph' => str_replace(",", "", $request->jumlah_pph6),
                        'pajak_penghasilan_id' => $pajakPenghasilan->id,

                    ],
                    [
                        'dopp_point_id' => '2',
                        'kode_objek_pajak' => "22-405-01",
                        'jumlah_dpp' => str_replace(",", "", $request->jumlah_dpp7),
                        'jumlah_pph' => str_replace(",", "", $request->jumlah_pph7),
                        'pajak_penghasilan_id' => $pajakPenghasilan->id,

                    ],
                    [
                        'dopp_point_id' => '3',
                        'kode_objek_pajak' => "22-405-02",
                        'jumlah_dpp' => str_replace(",", "", $request->jumlah_dpp8),
                        'jumlah_pph' => str_replace(",", "", $request->jumlah_pph8),
                        'pajak_penghasilan_id' => $pajakPenghasilan->id,

                    ],
                    [
                        'dopp_point_id' => '4',
                        'kode_objek_pajak' => "27-100-07",
                        'jumlah_dpp' => str_replace(",", "", $request->jumlah_dpp9),
                        'jumlah_pph' => str_replace(",", "", $request->jumlah_pph9),
                        'pajak_penghasilan_id' => $pajakPenghasilan->id,

                    ],
                    [
                        'dopp_point_id' => '5',
                        'kode_objek_pajak' => "27-102-03",
                        'jumlah_dpp' => str_replace(",", "", $request->jumlah_dpp10),
                        'jumlah_pph' => str_replace(",", "", $request->jumlah_pph10),
                        'pajak_penghasilan_id' => $pajakPenghasilan->id,

                    ],
                    [
                        'dopp_point_id' => '6',
                        'kode_objek_pajak' => "28-401-01",
                        'jumlah_dpp' => str_replace(",", "", $request->jumlah_dpp11),
                        'jumlah_pph' => str_replace(",", "", $request->jumlah_pph11),
                        'pajak_penghasilan_id' => $pajakPenghasilan->id,

                    ],
                    [
                        'dopp_point_id' => '7',
                        'kode_objek_pajak' => "28-401-04",
                        'jumlah_dpp' => str_replace(",", "", $request->jumlah_dpp12),
                        'jumlah_pph' => str_replace(",", "", $request->jumlah_pph12),
                        'pajak_penghasilan_id' => $pajakPenghasilan->id,

                    ],
                    [
                        'dopp_point_id' => '8',
                        'kode_objek_pajak' => "28-401-05",
                        'jumlah_dpp' => str_replace(",", "", $request->jumlah_dpp13),
                        'jumlah_pph' => str_replace(",", "", $request->jumlah_pph13),
                        'pajak_penghasilan_id' => $pajakPenghasilan->id,

                    ],
                    [
                        'dopp_point_id' => '9',
                        'kode_objek_pajak' => "28-401-06",
                        'jumlah_dpp' => str_replace(",", "", $request->jumlah_dpp14),
                        'jumlah_pph' => str_replace(",", "", $request->jumlah_pph14),
                        'pajak_penghasilan_id' => $pajakPenghasilan->id,

                    ],
                    [
                        'dopp_point_id' => '10',
                        'kode_objek_pajak' => "28-404-01",
                        'jumlah_dpp' => str_replace(",", "", $request->jumlah_dpp15),
                        'jumlah_pph' => str_replace(",", "", $request->jumlah_pph15),
                        'pajak_penghasilan_id' => $pajakPenghasilan->id,

                    ],
                    [
                        'dopp_point_id' => '11',
                        'kode_objek_pajak' => "28-404-02",
                        'jumlah_dpp' => str_replace(",", "", $request->jumlah_dpp16),
                        'jumlah_pph' => str_replace(",", "", $request->jumlah_pph16),
                        'pajak_penghasilan_id' => $pajakPenghasilan->id,

                    ],
                    [
                        'dopp_point_id' => '12',
                        'kode_objek_pajak' => "28-404-03",
                        'jumlah_dpp' => str_replace(",", "", $request->jumlah_dpp17),
                        'jumlah_pph' => str_replace(",", "", $request->jumlah_pph17),
                        'pajak_penghasilan_id' => $pajakPenghasilan->id,

                    ],
                    [
                        'dopp_point_id' => '13',
                        'kode_objek_pajak' => "28-404-04",
                        'jumlah_dpp' => str_replace(",", "", $request->jumlah_dpp18),
                        'jumlah_pph' => str_replace(",", "", $request->jumlah_pph18),
                        'pajak_penghasilan_id' => $pajakPenghasilan->id,

                    ],
                    [
                        'dopp_point_id' => '14',
                        'kode_objek_pajak' => "28-404-05",
                        'jumlah_dpp' => str_replace(",", "", $request->jumlah_dpp19),
                        'jumlah_pph' => str_replace(",", "", $request->jumlah_pph19),
                        'pajak_penghasilan_id' => $pajakPenghasilan->id,

                    ],
                    [
                        'dopp_point_id' => '15',
                        'kode_objek_pajak' => "28-404-06",
                        'jumlah_dpp' => str_replace(",", "", $request->jumlah_dpp20),
                        'jumlah_pph' => str_replace(",", "", $request->jumlah_pph20),
                        'pajak_penghasilan_id' => $pajakPenghasilan->id,

                    ],
                    [
                        'dopp_point_id' => '16',
                        'kode_objek_pajak' => "28-404-07",
                        'jumlah_dpp' => str_replace(",", "", $request->jumlah_dpp21),
                        'jumlah_pph' => str_replace(",", "", $request->jumlah_pph21),
                        'pajak_penghasilan_id' => $pajakPenghasilan->id,

                    ],
                    [
                        'dopp_point_id' => '17',
                        'kode_objek_pajak' => "28-404-08",
                        'jumlah_dpp' => str_replace(",", "", $request->jumlah_dpp22),
                        'jumlah_pph' => str_replace(",", "", $request->jumlah_pph22),
                        'pajak_penghasilan_id' => $pajakPenghasilan->id,

                    ],
                    [
                        'dopp_point_id' => '18',
                        'kode_objek_pajak' => "28-102-09",
                        'jumlah_dpp' => str_replace(",", "", $request->jumlah_dpp23),
                        'jumlah_pph' => str_replace(",", "", $request->jumlah_pph23),
                        'pajak_penghasilan_id' => $pajakPenghasilan->id,

                    ],
                    [
                        'dopp_point_id' => '19',
                        'kode_objek_pajak' => "28-404-10",
                        'jumlah_dpp' => str_replace(",", "", $request->jumlah_dpp24),
                        'jumlah_pph' => str_replace(",", "", $request->jumlah_pph24),
                        'pajak_penghasilan_id' => $pajakPenghasilan->id,

                    ],
                    [
                        'dopp_point_id' => '20',
                        'kode_objek_pajak' => "28-404-11",
                        'jumlah_dpp' => str_replace(",", "", $request->jumlah_dpp25),
                        'jumlah_pph' => str_replace(",", "", $request->jumlah_pph25),
                        'pajak_penghasilan_id' => $pajakPenghasilan->id,

                    ],
                    [
                        'dopp_point_id' => '21',
                        'kode_objek_pajak' => "28-406-01",
                        'jumlah_dpp' => str_replace(",", "", $request->jumlah_dpp26),
                        'jumlah_pph' => str_replace(",", "", $request->jumlah_pph26),
                        'pajak_penghasilan_id' => $pajakPenghasilan->id,

                    ],
                    [
                        'dopp_point_id' => '22',
                        'kode_objek_pajak' => "28-407-01",
                        'jumlah_dpp' => str_replace(",", "", $request->jumlah_dpp27),
                        'jumlah_pph' => str_replace(",", "", $request->jumlah_pph27),
                        'pajak_penghasilan_id' => $pajakPenghasilan->id,

                    ],
                    [
                        'dopp_point_id' => '23',
                        'kode_objek_pajak' => "28 -408-01",
                        'jumlah_dpp' => str_replace(",", "", $request->jumlah_dpp28),
                        'jumlah_pph' => str_replace(",", "", $request->jumlah_pph28),
                        'pajak_penghasilan_id' => $pajakPenghasilan->id,

                    ]

                ];
            }
        }

        // Loop untuk data Dopp untuk cek apakah kode_objek_pajak sesuai dengan kode di pph_pasals
        foreach ($datadopp as &$doppData) {
            // Cek apakah kode_objek_pajak sama dengan kode objek di tabel pph_pasals
            if ($doppData['kode_objek_pajak'] == $pphPasal->kode_objek_pajak) {
                // Replace jumlah_pph dengan nilai dari jumlah_setor di tabel pph_pasals
                $doppData['jumlah_pph'] = str_replace(",", "", $pphPasal->jumlah_setor);
            }
        }

        // Gunakan upsert untuk melakukan insert atau update jika ada kode_objek_pajak yang sama
        Doss::upsert($datadoss, ['doss_point_id'], ['jumlah_dpp', 'jumlah_pph', 'pajak_penghasilan_id']);
        Dopp::upsert($datadopp, ['kode_objek_pajak'], ['jumlah_dpp', 'jumlah_pph', 'pajak_penghasilan_id']);

        return response()->json([
            'message' => 'Data DOPP dan DOPS berhasil ditambahkan',
            'data' => [
                'doss' => $datadoss,
                'dopp' => $datadopp
            ]
        ]);
    }

    public function lengkapiSpt($id): JsonResponse
    {
        // Temukan record penyiapan_spt berdasarkan ID
        $penyiapanSpt = PenyiapanSpt::find($id);

        // Jika data tidak ditemukan
        if (!$penyiapanSpt) {
            return response()->json([
                'message' => 'Penyiapan SPT tidak ditemukan'
            ], 404);
        }

        // Pastikan keterangan_spt adalah 'lengkapi spt'
        if ($penyiapanSpt->keterangan_spt !== 'lengkapi spt') {
            return response()->json([
                'message' => 'Fitur lengkapi SPT tidak dapat diakses pada tahap ini.'
            ], 403);
        }

        // Validasi input user (DOPP bisa null, DOSS harus ada meskipun kosong)
        $validatedData = request()->validate([
            'lampiran_doss_data' => 'nullable', // Data untuk DOSS, bisa null
            'lampiran_dopp_data' => 'nullable', // Data untuk DOPP, bisa null
            'bertindak_sebagai' => 'required|in:pengurus,kuasa',
            'pengaturan_id' => 'required|exists:pengaturans,id',
        ]);

        // Buat lampiran DOSS baru (bernilai 0 jika tidak ada input user)
        $lampiranDoss = Doss::create([
            'kode_objek_pajak' => $validatedData['lampiran_doss_data']['kode_objek_pajak'] ?? '0', // Default 0
            'jumlah_dpp' => $validatedData['lampiran_doss_data']['jumlah_dpp'] ?? 0, // Default 0
            'jumlah_pph' => $validatedData['lampiran_doss_data']['jumlah_pph'] ?? 0, // Default 0
            'pajak_penghasilan_id' => $penyiapanSpt->pajak_penghasilan_id,
        ]);

        // Jika lampiran DOPP tidak ada, isi otomatis berdasarkan kode objek pajak di pph pasal
        if (empty($validatedData['lampiran_dopp_data'])) {
            // Dapatkan data PPh Pasal yang sesuai dengan pajak_penghasilan_id
            $pphPasal = PphPasal::where('pajak_penghasilan_id', $penyiapanSpt->pajak_penghasilan_id)->first();

            if (!$pphPasal) {
                return response()->json([
                    'message' => 'Tidak ada data PPh Pasal yang sesuai untuk melengkapi lampiran DOPP.'
                ], 404);
            }

            // Buat lampiran DOPP baru berdasarkan PPh Pasal
            $lampiranDopp = Dopp::create([
                'kode_objek_pajak' => $pphPasal->kode_objek_pajak, // Kode objek pajak dari PPh Pasal
                'jumlah_dpp' => 0, // Nilai dari PPh Pasal
                'jumlah_pph' => $pphPasal->jumlah_setor,
                'pajak_penghasilan_id' => $penyiapanSpt->pajak_penghasilan_id,
            ]);
        } else {
            // Buat lampiran DOPP baru dari input user
            $lampiranDopp = Dopp::create([
                'kode_objek_pajak' => $validatedData['lampiran_dopp_data']['kode_objek_pajak'],
                'jumlah_dpp' => $validatedData['lampiran_dopp_data']['jumlah_dpp'],
                'jumlah_pph' => $validatedData['lampiran_dopp_data']['jumlah_pph'],
                'pajak_penghasilan_id' => $penyiapanSpt->pajak_penghasilan_id,
            ]);
        }

        // Update penyiapan_spt dengan lampiran_doss_id dan lampiran_dopp_id
        $penyiapanSpt->lampiran_doss_id = $lampiranDoss->id; // Simpan ID dari lampiran DOSS
        $penyiapanSpt->lampiran_dopp_id = $lampiranDopp->id; // Simpan ID dari lampiran DOPP
        $penyiapanSpt->bertindak_sebagai = $validatedData['bertindak_sebagai'];
        $penyiapanSpt->pengaturan_id = $validatedData['pengaturan_id'];

        // Ubah keterangan_spt menjadi 'siap kirim'
        $penyiapanSpt->keterangan_spt = 'siap kirim';

        // Simpan perubahan ke database
        $penyiapanSpt->save();

        return response()->json([
            'message' => 'SPT berhasil dilengkapi dan siap untuk dikirim'
        ], 200);
    }
}
