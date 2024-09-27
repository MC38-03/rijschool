<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voertuig extends Model
{
    use HasFactory;

    protected $table = 'voertuigen';

    protected $fillable = [
        'type',
        'license_plate',
    ];

    public function lessen()
    {
        return $this->hasMany(Les::class);
    }

    public function instructeurs()
    {
        return $this->hasMany(Instructeur::class);
    }
}
