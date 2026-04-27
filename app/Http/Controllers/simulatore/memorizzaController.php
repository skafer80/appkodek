<?php

namespace App\Http\Controllers\simulatore;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\SimulatorClassroom;
use App\Models\SimulatorPlayer;
use App\Models\SimulatorImpresa;
use App\Models\Comune;
use Illuminate\Http\Request;

class memorizzaController extends Controller
{
    public function dettagliPercorso(SimulatorPlayer $SimulatorPlayer, Classroom $classroom, Request $request)
    {

        $classroom = SimulatorClassroom::updateOrCreate([
            'simulator_player_id' => $SimulatorPlayer->id,
            'classroom_id' => $classroom->id,
        ], [
            'data_avvio' => $request->input('data_avvio_prevista'),
            'data_fine' => $request->input('data_fine_prevista'),
            'importo' => $request->input('importo_finanziamenti'),
            'totale_giornate' => $request->input('giornate_aula_previste'),
        ]);

        return redirect()->route('simulatore.showDettagliPercorso', [$SimulatorPlayer->id, $classroom->id])->with('success', 'Dettagli percorso memorizzati con successo.');
    }

    public function dettagliStage(SimulatorPlayer $SimulatorPlayer, Classroom $classroom, Request $request)
    {
        $classroom = SimulatorClassroom::updateOrCreate([
            'simulator_player_id' => $SimulatorPlayer->id,
            'classroom_id' => $classroom->id,
        ], [
            'data_avvio_stage' => $request->input('d_avvio_stage'),
            'data_fine_stage' => $request->input('d_fine_stage'),
            'totale_giornate_stage' => $request->input('i_giornate_stage'),
        ]);

        return redirect()->route('simulatore.showStage', [$SimulatorPlayer->id, $classroom->id])->with('success', 'Dettagli stage memorizzati con successo.');
    }

    public function dettagliImpresa(SimulatorPlayer $SimulatorPlayer, Classroom $classroom, Request $request)
    {
        $comune = Comune::whereRaw('LOWER(comune) = ?', [
            strtolower(trim($request->input('sede_legale_comune')))
        ])->first();

        if (!$comune) {
            abort(422, 'Comune non trovato');
        }

        $impresa = SimulatorImpresa::updateOrCreate([
            'simulator_player_id' => $SimulatorPlayer->id,
            'classroom_id' => $classroom->id,
        ], [
            'denominazione' => $request->input('t_denominazione_impresa'),
            'partita_iva' => $request->input('t_piva_impresa'),
            'numero_allievi' => $request->input('i_allievi_previsti'),
            'comune_id' => $comune->id,
            'indirizzo' => $request->input('sede_legale_indirizzo'),
            'numero_civico' => $request->input('sede_legale_civico'),
        ]);

        return redirect()->route('simulatore.showStage', [$SimulatorPlayer->id, $classroom->id])->with('success', 'Dettagli impresa memorizzati con successo.');

    }

    public function eliminaImpresa(SimulatorPlayer $SimulatorPlayer, SimulatorImpresa $impresa)
     {
        if ($impresa->simulator_player_id !== $SimulatorPlayer->id) {
            abort(403, 'Azione non autorizzata');
        }

        $classroom = Classroom::findOrFail($impresa->classroom_id);

        $impresa->delete();

        return redirect()->route('simulatore.showStage', [$SimulatorPlayer->id, $classroom->id])->with('success', 'Dettagli impresa eliminata con successo.');

    }

    public function dettagliDatiEconomici(SimulatorPlayer $SimulatorPlayer, Classroom $classroom, Request $request)
    {
        $classroom = SimulatorClassroom::updateOrCreate([
            'simulator_player_id' => $SimulatorPlayer->id,
            'classroom_id' => $classroom->id,
        ], [
            'fascia_a' => $request->input('ore_presunte_fascia_a'),
            'fascia_b' => $request->input('ore_presunte_fascia_b'),
            'fascia_c' => $request->input('ore_presunte_fascia_c'),
        ]);

        return redirect()->route('simulatore.showDatiEconomici', [$SimulatorPlayer->id, $classroom->id])->with('success', 'Dati economici memorizzati con successo.');

    }
}
