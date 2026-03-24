<?php

namespace App\Models\Allenamento;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $fillable = [
        'nome',
        'email',
        'start_time',
        'end_time',
        'software',
        'tipo',
        'ente',
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

        protected function tempo(): Attribute
    {
        return Attribute::get(function () {
            if ($this->start_time && $this->end_time) {
                $start = \Carbon\Carbon::parse($this->start_time);
                $end = \Carbon\Carbon::parse($this->end_time);
                return $start->diffInSeconds($end);
            }

            return null;
        });
    }


}
