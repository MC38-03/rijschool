<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'leerling';
    protected $fillable = [
        'gebruikersnaam', 'naam', 'achternaam', 'geboortedatum', 'email', 'wachtwoord', 'role'
    ];

    protected $hidden = [
        'wachtwoord', 'remember_token',
    ];

    public function getAuthPassword()
    {
        return $this->wachtwoord;
    }
}
