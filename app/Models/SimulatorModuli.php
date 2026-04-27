<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SimulatorModuli extends Model
{
    protected $fillable = [
        'simulator_player_id',
        'modulo_id',
        'ore_aula',
        'ore_fad',
    ];

    public function simulatorPlayer()
    {
        return $this->belongsTo(SimulatorPlayer::class);
    }

    public function modulo()
    {
        return $this->belongsTo(Moduli::class);
    }
}
