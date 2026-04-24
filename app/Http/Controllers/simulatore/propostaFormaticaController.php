<?php

namespace App\Http\Controllers\simulatore;

use App\Http\Controllers\Controller;
use App\Models\classroom;
use App\Models\Formazione;
use App\Models\Moduli;

class propostaFormaticaController extends Controller
{
    public function index()
    {
        $formazione = Formazione::all();

        return view('simulatore.propostaformatica', compact('formazione'));
    }

    public function showModuli($id)
    {
        $moduli = Moduli::with('gruppoModuli')
            ->where('formazione_id', $id)
            ->get();

            $moduliRaggruppati = $moduli
                ->groupBy(fn($m) => $m->gruppoModuli->id ?? 0)
                ->map(function ($moduliGruppo) {

                    $categoria = $moduliGruppo->first()->gruppoModuli;

                    return [
                        'categoria' => $categoria,
                        'moduli' => $moduliGruppo,
                        'totale_ore_aula' => $moduliGruppo->sum('ore_aula'),
                        'totale_ore_fad' => $moduliGruppo->sum('ore_fad'),
                    ];
                })
                ->values();

        return view('simulatore.showModuli', compact('moduliRaggruppati'));
    }

    public function showPercorsi($id)
    {
        $percorsi = classroom::where('formazione_id', $id)->get();

        return view('simulatore.percorsi', compact('percorsi'));
    }

    public function showDettagliPercorso($id)
    {
        $percorso = classroom::findOrFail($id);

        return view('simulatore.dettagliPercorso', compact('percorso'));
    }

    public function showDatiEconomici($id)
    {
        $percorso = classroom::findOrFail($id);

        return view('simulatore.datieconomici', compact('percorso'));
    }

    public function showStage($id)
    {
        $percorso = classroom::findOrFail($id);

        return view('simulatore.showStage', compact('percorso'));
    }

    public function showImpresa($id)
    {
        $percorso = classroom::findOrFail($id);

        return view('simulatore.showImpresa', compact('percorso'));
    }
}
