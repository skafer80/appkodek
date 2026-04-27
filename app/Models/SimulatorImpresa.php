<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SimulatorImpresa extends Model
{
    protected $fillable = [
        'simulator_player_id',
        'classroom_id',
        'denominazione',
        'partita_iva',
        'indirizzo',
        'numero_civico',
        'cap',
        'comune_id',
        'numero_allievi',
    ];

    public function simulatorPlayer()
    {
        return $this->belongsTo(SimulatorPlayer::class);
    }

    public function classroom()
    {
        return $this->belongsTo(SimulatorClassroom::class, 'classroom_id');
    }

    public function comune()
    {
        return $this->belongsTo(Comune::class, 'comune_id');
    }
}
