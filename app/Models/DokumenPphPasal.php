<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DokumenPphPasal extends Model
{
    protected $table = 'dokumen_pph_pasals';
    protected $primaryKey = 'id';
    protected $keyType = "int";
    public $timestamps = true;
    public $incrementing = true;
    protected $fillable = [
      'nama_dokumen',
        'no_dokumen',
        'tgl_dokumen',
        'pphpasal_id'
    ];

    public function pphpasal(): BelongsTo
    {
        return $this->belongsTo(PphPasal::class, 'pphpasal_id', 'id');
    }
}
