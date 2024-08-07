<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DasarPemotongan extends Model
{
    public function jenis_dokumen(): HasMany
    {
        return $this->hasMany(PphPasal::class, 'dasar_pemotongan_id', 'id');
    }
}
