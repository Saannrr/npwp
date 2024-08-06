<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pengaturan extends Model
{
    protected $table = 'pengaturans';
    protected $primaryKey = 'id';
    protected $keyType = "int";
    public $timestamps = true;
    public $incrementing = true;
    protected $fillable = [
        'bertindak_sebagai',
        'identitas',
        'npwp_id',
        'nik_id',
        'nama_penandatangan',
        'user_id',
        'status',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function pegawai(): BelongsTo
    {
        return $this->belongsTo(IdentitasOrang::class, 'nik_id', 'nik')->orWhere('npwp_id', 'npwp');
    }

    public function pph_pasal(): HasMany
    {
        return $this->hasMany(PphPasal::class, 'pengaturan_id', 'id');
    }
}
