<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekamSptBp extends Model
{
    protected $table = 'rekam_spt_bps';
    protected $primaryKey = 'id';
    protected $keyType = "int";
    public $timestamps = true;
    public $incrementing = true;
    public $fillable = [
        'user_id',
        'jenis_bukti_penyetoran',
        'npwp_id',
        'ntpn_id',
        'nomor_pemindahbukuan',
        'tahun_pajak',
        'masa_pajak',
        'jenis_pajak',
        'jenis_setoran',
        'jumlah_setor',
        'pph_yang_dipotong',
        'tanggal_setor',
        'beda_npwp_id',
    ];
}
