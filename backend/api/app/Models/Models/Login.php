<?php
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class Login extends Authenticatable
{
    use HasFactory, HasApiTokens;

    protected $fillable = [
        'email',
        'password'
    ];
}