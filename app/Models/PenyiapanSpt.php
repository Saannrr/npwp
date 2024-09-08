<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenyiapanSpt extends Model
{
    protected $table = 'penyiapan_spts';
    protected $primaryKey = 'id';
    protected $keyType = "int";
    public $timestamps = true;
    public $incrementing = true;
    public $fillable = [
        'user_id',
        'tahun_pajak',
        'masa_pajak',
        'pbtl_ke',
        'jumlah_pph_kurang_setor',
        'status_spt',
        'keterangan_spt',
        'bertindak_sebagai',
        'pengaturan_id',
        'lampiran_doss_id',
        'lampiran_dopp_id',
    ];
}
