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

    protected $casts = [
        'start_time' => 'datetime',
        'end_time'   => 'datetime',
    ];

    protected static function booted(): void
    {
        static::creating(function (self $player) {
            if (empty($player->start_time)) {
                $player->start_time = now();
            }
        });
    }

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

    public function getElapsedTimeAttribute(): ?string
    {
        if (! $this->start_time || ! $this->end_time) {
            return null;
        }

        $intervallo = $this->start_time->diff($this->end_time);
        $giorni = $intervallo->days > 0 ? $intervallo->days.'g ' : '';

        return $giorni.$intervallo->format('%H:%I:%S');
    }
}
