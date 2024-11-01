<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class PphPasal extends Model
{
    use SoftDeletes;

    protected $table = 'pph_pasals';
    protected $primaryKey = 'id';
    protected $keyType = "int";
    public $timestamps = true;
    public $incrementing = true;
    protected $fillable = [
        'pengaturan_id',
        'penandatangan_bukti_potong',
        'tahun_pajak',
        'masa_pajak',
        'nama',
        'identitas',
        'npwp_id',
        'nik_id',
        'dokumen_pph_pasal_id',
        'kode_objek_pajak',
        'fasilitas_pajak_penghasilan',
        'no_fasilitas',
        'jumlah_penghasilan_bruto',
        'tarif',
        'jumlah_setor',
        'kelebihan_pemotongan',
        'status',
        'revisi',
    ];

    public function identitas()
    {
        return $this->belongsTo(User::class, 'nik_id', 'nik')->orWhere('npwp_id', 'npwp');
    }

    public function pengaturan()
    {
        return $this->belongsTo(Pengaturan::class, 'pengaturan_id', 'id');
    }

    public function dokumen_pph_pasal(): BelongsToMany
    {
        return $this->belongsToMany(DokumenPphPasal::class, 'pphpasal_id', 'id');
    }

    public function kode_objek_pajak(): BelongsTo
    {
        return $this->belongsTo(ObjekPajak::class, 'kode_objek_pajak', 'kode_pajak');
    }
}
