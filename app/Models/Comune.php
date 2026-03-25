<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comune extends Model
{
    use HasFactory;
    // Se la tabella non segue la convenzione Laravel per le pivot, specifichiamo il nome della tabella
    protected $table = 'comuni';

    // Colonne che possono essere riempite in massa
    protected $fillable = ['codice_istat', 'comune', 'provincia','sigla'];

    public function anagrafica()
    {
        return $this->belongsTo(Person::class, 'comune_id');
    }

    public function caps()
    {
        return $this->hasOne(Cap::class, 'codice_istat', 'codice_istat');
    }
}
