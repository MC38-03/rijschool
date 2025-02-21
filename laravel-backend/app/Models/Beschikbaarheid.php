<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beschikbaarheid extends Model
{
    use HasFactory;

    protected $table = 'beschikbaarheden';

    protected $fillable = [
        'datum',
        'begin_tijd',
        'eind_tijd',
        'instructeur_id',
        'voertuig_id'
    ];

    public function instructeur()
    {
        return $this->belongsTo(Instructeur::class);
    }

    public function voertuig()
    {
        return $this->belongsTo(Voertuig::class, 'voertuig_id');
    }
}
