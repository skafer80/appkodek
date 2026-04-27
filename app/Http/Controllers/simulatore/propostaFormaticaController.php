<?php

namespace App\Http\Controllers\simulatore;

use App\Http\Controllers\Controller;
use App\Models\classroom;
use App\Models\Formazione;
use App\Models\Moduli;
use App\Models\SimulatorImpresa;
use App\Models\SimulatorPlayer;

class propostaFormaticaController extends Controller
{
    public function index(SimulatorPlayer $SimulatorPlayer)
    {
        $formazione = Formazione::all();

        return view('simulatore.propostaformatica', compact('formazione', 'SimulatorPlayer'));
    }

    public function showModuli(SimulatorPlayer $SimulatorPlayer,$id)
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

        return view('simulatore.showModuli', compact('moduliRaggruppati', 'SimulatorPlayer'));
    }

    public function showPercorsi(SimulatorPlayer $SimulatorPlayer, $id)
    {
        $percorsi = classroom::where('formazione_id', $id)->get();

        return view('simulatore.percorsi', compact('percorsi', 'SimulatorPlayer'));
    }

    public function showDettagliPercorso(SimulatorPlayer $SimulatorPlayer, $id)
    {
        $percorso = classroom::findOrFail($id);

        $SimulatorPlayer->load(['simulatorClassrooms' => function ($query) use ($percorso) {
            $query->where('classroom_id', $percorso->id);
        }]);

        $dataAvvioPrevista = $SimulatorPlayer->simulatorClassrooms->first()->data_avvio ?? '';
        $dataFinePrevista = $SimulatorPlayer->simulatorClassrooms->first()->data_fine ?? '';
        $importoFinanziamenti = $SimulatorPlayer->simulatorClassrooms->first()->importo ?? '';
        $giornateAulaPreviste = $SimulatorPlayer->simulatorClassrooms->first()->totale_giornate ?? '';

        return view('simulatore.dettagliPercorso', compact('percorso', 'SimulatorPlayer', 'dataAvvioPrevista', 'dataFinePrevista', 'importoFinanziamenti', 'giornateAulaPreviste'));
    }

    public function showDatiEconomici(SimulatorPlayer $SimulatorPlayer, $id)
    {
        $percorso = classroom::findOrFail($id);
        $SimulatorPlayer->load(['simulatorClassrooms' => function ($query) use ($percorso) {
            $query->where('classroom_id', $percorso->id);
        }]);
        $orePresunteFasciaA = $SimulatorPlayer->simulatorClassrooms->first()->fascia_a ?? 0;
        $orePresunteFasciaB = $SimulatorPlayer->simulatorClassrooms->first()->fascia_b ?? 0;
        $orePresunteFasciaC = $SimulatorPlayer->simulatorClassrooms->first()->fascia_c ?? 0;

        return view('simulatore.datieconomici', compact('percorso', 'SimulatorPlayer', 'orePresunteFasciaA', 'orePresunteFasciaB', 'orePresunteFasciaC'));
    }

    public function showStage(SimulatorPlayer $SimulatorPlayer, $id)
    {
        $percorso = classroom::findOrFail($id);

        $SimulatorPlayer->load(['simulatorClassrooms' => function ($query) use ($percorso) {
            $query->where('classroom_id', $percorso->id);
        }]);

        $dataAvvioStage = $SimulatorPlayer->simulatorClassrooms->first()->data_avvio_stage ?? '';
        $dataFineStage = $SimulatorPlayer->simulatorClassrooms->first()->data_fine_stage ?? '';
        $giornateStage = $SimulatorPlayer->simulatorClassrooms->first()->totale_giornate_stage ?? 0;

        $imprese = SimulatorImpresa::where('simulator_player_id', $SimulatorPlayer->id)
            ->where('classroom_id', $percorso->id)
            ->get();

        return view('simulatore.showStage', compact('percorso', 'SimulatorPlayer', 'dataAvvioStage', 'dataFineStage', 'giornateStage', 'imprese'));
    }

    public function showImpresa(SimulatorPlayer $SimulatorPlayer, $id)
    {
        $percorso = classroom::findOrFail($id);

        return view('simulatore.showImpresa', compact('percorso', 'SimulatorPlayer'));
    }
}
