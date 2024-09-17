<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dopp extends Model
{
    protected $table = 'dopps';
    protected $primaryKey = 'id';
    protected $keyType = "int";
    public $timestamps = true;
    public $incrementing = true;
    public $fillable = [
        'penyiapan_spt_id',
        'pajak_penghasilan_id',
        'dopp_point_id',
        'kode_objek_pajak',
        'jumlah_dpp',
        'jumlah_pph'
    ];

    public function penyiapanSpt()
    {
        return $this->belongsTo(PenyiapanSpt::class);
    }
}
