<?php

namespace App\Models\Allenamento;

use Illuminate\Database\Eloquent\Model;

class ClickStudent extends Model
{

    protected $table = 'click_students';

    protected $fillable = [
        'd_ammesso_selezione',
        't_nome',
        't_cognome',
        't_sesso',
        'b_disabile',
        'd_nascita',
        't_n_provincia',
        't_n_comune',
        't_n_altro_comune',
        't_codice_fiscale',
        'i_cittadinanza_id',
        't_r_provincia',
        't_r_comune',
        't_d_provincia',
        't_d_comune',
        'i_tipo_titolo_studio_id',
        'i_tipo_condizione_occupazionale_id',
        'player_id',
    ];


}
