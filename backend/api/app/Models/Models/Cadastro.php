<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Cadastro extends Model implements Authenticatable, JWTSubject
{
    use HasFactory, AuthenticableTrait;

    protected $fillable = [
        'id',
        'email',
        'password'
    ];

    // Retorna o identificador único do usuário para ser usado no token JWT
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    // Retorna quaisquer reivindicações personalizadas que você deseja incluir no token JWT
    public function getJWTCustomClaims()
    {
        return [];
    }
}
