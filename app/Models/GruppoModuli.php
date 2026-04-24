<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GruppoModuli extends Model
{
    protected $table = 'gruppo_modulis';
    protected $fillable = [
        'nome',
    ];

    public function moduli()
    {
        return $this->hasMany(Moduli::class, 'gruppo_moduli_id');
    }

    public function getOreAula()
    {
        return $this->moduli()->sum('ore_aula');
    }

    public function getOreFad()
    {
        return $this->moduli()->sum('ore_fad');
    }
}
