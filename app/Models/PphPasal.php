<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PphPasal extends Model
{
    protected $table = 'pph_pasals';
    protected $primaryKey = 'id';
    protected $keyType = "int";
    public $timestamps = true;
    public $incrementing = true;
    protected $fillable = [
        'pengaturan_id',
        'tahun_pajak',
        'masa_pajak',
        'nama',
        'identitas',
        'no_identitas',
        'qq',
        'kode_objek_pajak',
        'fasilitas_pajak_penghasilan',
        'no_fasilitas',
        'jumlah_penghasilan_bruto',
        'tarif',
        'jumlah_setor',
        'no_bukti',
        'kelebihan_pemotongan',
        'status',
    ];

    public function pengaturan(): BelongsTo
    {
        return $this->belongsTo(Pengaturan::class, 'pengaturan_id', 'id');
    }

    public function dokumen_pph_pasal(): HasOne
    {
        return $this->hasOne(DokumenPphPasal::class, 'pph_pasal_id', 'id');
    }
}
