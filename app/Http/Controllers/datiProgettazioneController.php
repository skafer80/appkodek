<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class datiProgettazioneController extends Controller
{
    public function datiProgettazione(Request $request)
    {
        return view('progettazione.dati');
    }
}
