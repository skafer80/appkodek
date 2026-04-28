<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SimulatorPartecipante extends Model
{
    protected $table = 'simulator_partecipanti';

    protected $fillable = [
        'simulator_player_id',
        'classroom_id',
        't_codice_fiscale',
        'b_disabile',
        't_r_provincia',
        't_r_comune',
        't_d_provincia',
        't_d_comune',
        'i_tipo_condizione_occupazionale_id',
    ];

    public function simulatorPlayer()
    {
        return $this->belongsTo(SimulatorPlayer::class);
    }

    public function classroom()
    {
        return $this->belongsTo(classroom::class, 'classroom_id');
    }

    public function getStatoSoggettoLabelAttribute(): string
    {
        return match ((int) $this->i_tipo_condizione_occupazionale_id) {
            8 => 'Inoccupato',
            10 => 'Disoccupato',
            12 => 'Inattivo',
            default => 'N/D',
        };
    }
}
