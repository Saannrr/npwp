<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model implements Authenticatable
{
    use SoftDeletes;

    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $keyType = "int";
    public $timestamps = true;
    public $incrementing = true;
    protected $fillable = [
        'name',
        'email',
        'npwp',
        'nik',
        'password',
    ];

    public function pengaturan(): HasMany
    {
        return $this->hasMany(Pengaturan::class, 'user_id', 'id');
    }

    public function getAuthIdentifierName()
    {
        return 'npwp';
    }

    public function getAuthIdentifier()
    {
        return $this->npwp;
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getRememberToken()
    {
        return $this->token;
    }

    public function setRememberToken($value)
    {
        $this->token = $value;
    }

    public function getRememberTokenName()
    {
        return 'token';
    }
}
