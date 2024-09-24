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
        'gebruikersnaam', 'naam', 'achternaam', 'leeftijd', 'email', 'wachtwoord',
    ];

    protected $hidden = [
        'wachtwoord', 'remember_token',
    ];

    public function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
        ];
    }
}

