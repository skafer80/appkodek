<?php

namespace App\Models\Allenamento;

use Illuminate\Database\Eloquent\Model;

class ClickSubject extends Model
{
    protected $fillable = [
        'id_subject',
        'nome',
        'ore_conoscenza',
        'ore_fad_conoscenza',
        'player_id',
        'gruppo',
    ];
}
