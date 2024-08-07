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
        'npwp_id',
        'nik_id',
        'dasar_pemotongan_id',
        'kode_objek_pajak',
        'fasilitas_pajak_penghasilan',
        'no_fasilitas',
        'jumlah_penghasilan_bruto',
        'tarif',
        'jumlah_setor',
        'kelebihan_pemotongan',
        'status',
    ];

    public function nama_dokumen(): BelongsTo
    {
        return $this->belongsTo(DasarPemotongan::class, 'dasar_pemotongan_id', 'id');
    }

    public function identitas_yang_dipotong(): BelongsTo
    {
        return $this->belongsTo(IdentitasOrang::class, 'nik_id', 'nik')->orWhere('npwp_id', 'npwp');
    }

    public function pengaturan(): BelongsTo
    {
        return $this->belongsTo(Pengaturan::class, 'pengaturan_id', 'id');
    }

    public function dokumen_pph_pasal(): HasOne
    {
        return $this->hasOne(DokumenPphPasal::class, 'pphpasal_id', 'id');
    }
}
