<?php

namespace App\Models\Allenamento;

use Illuminate\Database\Eloquent\Model;

class ClickPersonale extends Model
{
    protected $fillable = [
        'nome',
        'cognome',
        'cf',
        'telefono',
        'email',
        'data_nascita',
        'ruolo',
        'esterno',
        'player_id'
    ];
}
