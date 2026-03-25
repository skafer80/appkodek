<?php

namespace App\Http\Controllers;

use App\Models\Comune;
use Illuminate\Http\Request;

class ComuneController extends Controller
{
    public function getComuniByProvincia(Request $request)
    {
        $provincia = $request->input('option');

        if (! $provincia) {
            return response()->json([]);
        }

        $comuni = Comune::where('sigla', $provincia)
            ->orderBy('comune')
            ->get(['id', 'comune']);

        // Duplichiamo il valore in t_denominazione
        $comuni = $comuni->map(function ($item) {
            $item->t_denominazione = $item->comune;

            return $item;
        });

        return response()->json($comuni);
    }
}

