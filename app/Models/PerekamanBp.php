<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerekamanBp extends Model
{
    protected $table = 'perekaman_bps';
    protected $primaryKey = 'id';
    protected $keyType = "int";
    public $timestamps = true;
    public $incrementing = true;
    public $fillable = [
        'user_id',
        'tahun_pajak',
        'masa_pajak',
        'pajak_penghasilan_id',
        'jenis_pajak',
        'jenis_setoran',
        'pph_yang_dipotong',
        'id_billing',
        'pph_yang_disetor',
        'selisih',
    ];
}
