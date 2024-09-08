<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PajakPenghasilan extends Model
{
    protected $table = 'pajak_penghasilans';
    protected $primaryKey = 'id';
    protected $keyType = "int";
    public $timestamps = true;
    public $incrementing = true;
    public $fillable = [
        'is_posted',
        'posting_date',
        'tipe_pph',
        'pphpasal_id',
    ];

    public function pphpasal()
    {
        return $this->belongsTo(PphPasal::class, 'pphpasal_id', 'id');
    }
}
