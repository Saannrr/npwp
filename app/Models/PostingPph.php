<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostingPph extends Model
{
    use SoftDeletes;

    protected $table = 'posting_pphs';
    protected $primaryKey = 'id';
    protected $keyType = "int";
    public $timestamps = true;
    public $incrementing = true;
    protected $fillable = [
        'pph_id',
        'pph_type',
        'tahun_pajak',
        'masa_pajak',
        'status',
    ];

    // Define the relationship to PPH models
    public function pph()
    {
        return $this->morphTo();
    }
}
