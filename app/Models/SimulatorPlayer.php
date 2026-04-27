<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SimulatorPlayer extends Model
{
    protected $fillable = [
        'user_id',
        'start_time',
        'end_time',
        'kind',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function simulatorClassrooms()
    {
        return $this->hasMany(SimulatorClassroom::class);
    }

    public function simulatorImprese()
    {
        return $this->hasMany(SimulatorImpresa::class);
    }
}
