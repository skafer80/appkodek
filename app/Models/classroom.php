<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class classroom extends Model
{
    protected $table = 'classrooms';

    protected $fillable = [
        'nome',
        'indirizzo',
        'numero_civico',
        'cap',
        'citta',
        'provincia',
        'totale_ore',
        'formazione_id',
    ];

    public function formazione()
    {
        return $this->belongsTo(formazione::class);
    }
}
