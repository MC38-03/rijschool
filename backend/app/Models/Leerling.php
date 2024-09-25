<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Leerling extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'leerling';

    protected $fillable = [
        'gebruikersnaam', 'naam', 'achternaam', 'geboortedatum', 'email', 'wachtwoord',
    ];

    protected $hidden = [
        'wachtwoord', 'remember_token',
    ];

    protected $middleware = [
        \Fruitcake\Cors\HandleCors::class,
    ];
    

    public function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
        ];
    }
}

