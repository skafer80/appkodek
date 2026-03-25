<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'nome_ufficiale',
        'nome_esteso',
        'indirizzo',
        'cap',
        'pec',
        'codice_fiscale',
        'rappresentante_natoa',
        'rappresentante_natoil',
        'rappresentante_codice_fiscale',
        'partita_iva',
        'telefono',
        'email',
        'web',
        'codice_univoco',
        'legale_rappresentante',
        'accreditamento_numero',
        'accreditamento_data',
        'cir',
    ];

    public function contratti()
    {
        return $this->hasMany(Contract::class);
    }

    public function colonna()
    {
        return $this->morphMany(InfoTable::class, 'infoTable');
    }

    public function comuneEnte()
    {
        return $this->belongsTo(Comune::class, 'comune_id');
    }

    public function foroCompetente()
    {
        return $this->belongsTo(Comune::class, 'foro_comune_id');
    }
}
