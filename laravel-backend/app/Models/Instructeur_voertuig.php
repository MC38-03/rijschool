<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstructeurVoertuig extends Model
{
    use HasFactory;

    protected $table = 'instructeur_voertuig';

    protected $fillable = [
        'instructeur_id',
        'voertuig_id',
    ];

    public function instructeur()
    {
        return $this->belongsTo(Instructeur::class);
    }

    public function voertuig()
    {
        return $this->belongsTo(Voertuig::class);
    }
}
