<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembayaranSpt extends Model
{
    protected $table = 'pembayaran_spts';
    protected $primaryKey = 'id';
    protected $keyType = "int";
    public $timestamps = true;
    public $incrementing = true;
    public $fillable = [
        'user_id',
        'npwp_id',
        'nama_wp',
        'alamat_wp',
        'ntpn',
        'kode_billing',
        'kode_jenis_pajak',
        'kode_jenis_setoran',
        'pph_yang_dipotong',
        'jumlah_setor',
        'masa_pajak',
        'tahun_pajak',
        'nop',
        'nomor_ketetapan',
        'uraian',
        'nama_bank',
        'nomor_transaksi_bank',
        'npwp_penyetor',
    ];
}
