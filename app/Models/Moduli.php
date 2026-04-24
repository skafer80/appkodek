<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Moduli extends Model
{
    protected $table = 'modulis';
    protected $fillable = [
        'nome',
        'gruppo_moduli_id',
        'ore_aula',
        'ore_fad',
    ];

    public function gruppoModuli()
    {
        return $this->belongsTo(GruppoModuli::class, 'gruppo_moduli_id');
    }
}
