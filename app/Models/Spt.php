<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spt extends Model
{
    use HasFactory;

    protected $table = 'spt';

    protected $fillable = [
        'no_bpe_ntte',
        'masa_tahun_pajak',
        'pbtl_ke',
        'tanggal_kirim',
    ];
}
