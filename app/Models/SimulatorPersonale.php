<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SimulatorPersonale extends Model
{
    protected $fillable = [
        'simulator_player_id',
        'classroom_id',
        'nome',
        'cognome',
        'cf',
        'telefono',
        'email',
        'data_nascita',
        'ruolo',
        'esterno',
    ];

    public function simulatorPlayer()
    {
        return $this->belongsTo(SimulatorPlayer::class);
    }
    public function classroom()
    {
        return $this->belongsTo(SimulatorClassroom::class, 'classroom_id');
    }
}
