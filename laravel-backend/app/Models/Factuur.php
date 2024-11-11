<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factuur extends Model
{
    use HasFactory;

    protected $table = 'facturen';

    protected $fillable = [
        'instructeur_id',
        'leerling_id',
        'bedrag',
        'datum_uitgegeven',
        'verval_datum',
        'status',
    ];

    public function leerling()
    {
        return $this->belongsTo(User::class, 'leerling_id');
    }
    
    public function instructeur()
    {
        return $this->belongsTo(Instructeur::class, 'instructeur_id');
    }
    
}
