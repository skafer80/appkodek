<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SimulatorClassroom extends Model
{
    protected $fillable = [
        'simulator_player_id',
        'classroom_id',
        'data_avvio',
        'data_fine',
        'importo',
        'totale_giornate',
        'data_avvio_stage',
        'data_fine_stage',
        'totale_giornate_stage',
        'fascia_a',
        'fascia_b',
        'fascia_c',
    ];

    public function simulatorPlayer()
    {
        return $this->belongsTo(SimulatorPlayer::class);
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'classroom_id');
    }

}
