<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instructeur extends Model
{
    use HasFactory;

    protected $table = 'instructeurs';

    protected $fillable = [
        'naam',
        'achternaam',
        'email',
        'voertuig_id',
    ];

    public function lessen()
    {
        return $this->hasMany(Les::class);
    }

    public function voertuig()
    {
        return $this->belongsTo(Voertuig::class);
    }
}
