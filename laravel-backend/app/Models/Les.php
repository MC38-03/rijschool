<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Les extends Model
{
    use HasFactory;

    protected $table = 'lessen';

    protected $fillable = [
        'datum',
        'begin_tijd',
        'eind_tijd',
        'instructeur_id',
        'leerling_id',
        'voertuig_id',
    ];

    public function instructeur()
    {
        return $this->belongsTo(Instructeur::class);
    }

    public function leerling()
    {
        return $this->belongsTo(User::class);
    }

    public function voertuig()
    {
        return $this->belongsTo(Voertuig::class);
    }
}
