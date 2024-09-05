<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IdentitasPerusahaan extends Model
{
    protected $table = 'identitas_perusahaans';
    protected $primaryKey = 'id';
    protected $keyType = "int";
    public $timestamps = true;
    public $incrementing = true;

    public function user()
    {
        return $this->morphOne(User::class, 'profileable');
    }
}
