<?php

namespace App\Http\Controllers\simulatore;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\classroom;
use App\Models\formazione;
use App\Models\Moduli;
use App\Models\SimulatorImpresa;
use App\Models\SimulatorClassroom;
use App\Models\SimulatorModuli;
use App\Models\SimulatorPersonale;
use App\Models\SimulatorPlayer;

class propostaFormaticaController extends Controller
{
    public function index(SimulatorPlayer $SimulatorPlayer)
    {
        $formazione = formazione::all();

        return view('simulatore.propostaformatica', compact('formazione', 'SimulatorPlayer'));
    }

    public function showModuli(SimulatorPlayer $SimulatorPlayer,$id)
    {
        $salvataggiUtente = SimulatorModuli::where('simulator_player_id', $SimulatorPlayer->id)
            ->get()
            ->keyBy('modulo_id');

        $moduli = Moduli::with('gruppoModuli')
            ->where('formazione_id', $id)
            ->get();

            $moduliRaggruppati = $moduli
                ->map(function ($modulo) use ($salvataggiUtente) {
                    $salvataggio = $salvataggiUtente->get($modulo->id);
                    $modulo->ore_aula_utente = $salvataggio->ore_aula ?? 0;
                    $modulo->ore_fad_utente = $salvataggio->ore_fad ?? 0;

                    return $modulo;
                })
                ->groupBy(fn($m) => $m->gruppoModuli->id ?? 0)
                ->map(function ($moduliGruppo) {

                    $categoria = $moduliGruppo->first()->gruppoModuli;

                    return [
                        'categoria' => $categoria,
                        'moduli' => $moduliGruppo,
                        'totale_ore_aula_moduli' => $moduliGruppo->sum('ore_aula'),
                        'totale_ore_fad_moduli' => $moduliGruppo->sum('ore_fad'),
                        'totale_ore_aula' => $moduliGruppo->sum('ore_aula_utente'),
                        'totale_ore_fad' => $moduliGruppo->sum('ore_fad_utente'),
                    ];
                })
                ->values();

        $totaleOreAula = $moduliRaggruppati->sum('totale_ore_aula');
        $totaleOreFad = $moduliRaggruppati->sum('totale_ore_fad');

        return view('simulatore.showModuli', compact('moduliRaggruppati', 'SimulatorPlayer', 'totaleOreAula', 'totaleOreFad', 'id'));
    }

    public function getModulo(SimulatorPlayer $SimulatorPlayer, $id)
    {
        $modulo = Moduli::find($id);

        if (! $modulo) {
            return response()->json(['error' => 'Modulo non trovato'], 404);
        }

        $simulatorModulo = SimulatorModuli::where('simulator_player_id', $SimulatorPlayer->id)
            ->where('modulo_id', $modulo->id)
            ->first();

        return response()->json([
            'data' => [
                'id' => $modulo->id,
                't_denominazione_conoscenza' => $modulo->nome,
                'ore_conoscenza' => $simulatorModulo->ore_aula ?? 0,
                'ore_fad_conoscenza' => $simulatorModulo->ore_fad ?? 0,
                'ore_stage_conoscenza' => 0,
                'b_competenza_trasversale' => 0,
                't_competenze_correlate' => 0,
            ],
        ]);
    }

    public function editModuli(Request $request, SimulatorPlayer $SimulatorPlayer)
    {
        $request->validate([
            'id' => ['required', 'integer', 'exists:modulis,id'],
            'formazione_id' => ['required', 'integer'],
            'ore_conoscenza' => ['nullable', 'integer', 'min:0'],
            'ore_fad_conoscenza' => ['nullable', 'integer', 'min:0'],
        ]);

        $modulo = Moduli::find($request->id);

        if (! $modulo) {
            if ($request->expectsJson()) {
                return response()->json(['data' => false, 'error' => 'Modulo non trovato'], 404);
            }

            return redirect()->back()->with('error', 'Modulo non trovato');
        }

        $simulatorModulo = SimulatorModuli::updateOrCreate(
            [
                'simulator_player_id' => $SimulatorPlayer->id,
                'modulo_id' => $modulo->id,
            ],
            [
                'ore_aula' => $request->ore_conoscenza ?? 0,
                'ore_fad' => $request->ore_fad_conoscenza ?? 0,
            ]
        );

        if ($request->expectsJson()) {
            return response()->json([
                'data' => [
                    'id' => $simulatorModulo->modulo_id,
                    'ore_conoscenza' => $simulatorModulo->ore_aula,
                    'ore_fad_conoscenza' => $simulatorModulo->ore_fad,
                    'ore_stage_conoscenza' => 0,
                ],
            ]);
        }

        return redirect()
            ->route('simulatore.showModuli', [$SimulatorPlayer->id, 'id' => $request->formazione_id])
            ->with('status', 'Modulo salvato correttamente');
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

    public function showPersonale(SimulatorPlayer $SimulatorPlayer, $id)
    {
        $percorso = classroom::findOrFail($id);

        $simulatorClassroom = SimulatorClassroom::where('simulator_player_id', $SimulatorPlayer->id)
            ->where('classroom_id', $percorso->id)
            ->first();

        $personale = collect();
        if ($simulatorClassroom) {
            $personale = SimulatorPersonale::where('simulator_player_id', $SimulatorPlayer->id)
                ->where('classroom_id', $simulatorClassroom->id)
                ->orderBy('cognome')
                ->orderBy('nome')
                ->get();
        }

        $ruoliPossibili = collect([
            'Direttore di progetto',
            'Responsabile amministrativo',
            'Tutor',
            'REO',
        ]);

        $ruoliPresenti = $personale->pluck('ruolo')->unique()->sort()->values();
        $ruoliMancanti = $ruoliPossibili->diff($ruoliPresenti);
        $allRuoliPresenti = $ruoliMancanti->isEmpty();

        return view('simulatore.showPersonale', compact('percorso', 'SimulatorPlayer', 'personale', 'ruoliMancanti', 'allRuoliPresenti'));
    }

    public function showCreatePersonale(SimulatorPlayer $SimulatorPlayer, $id)
    {
        $percorso = classroom::findOrFail($id);

        $captchaCode = $this->generateCaptchaCode();
        session(['simulatore_personale_captcha' => $captchaCode]);
        $captchaImageDataUri = $this->generateCaptchaSvgDataUri($captchaCode);

        return view('simulatore.personaleForm', compact('percorso', 'SimulatorPlayer', 'captchaImageDataUri'));
    }

    public function showDettaglioPersonale(SimulatorPlayer $SimulatorPlayer, $id, SimulatorPersonale $personale)
    {
        $percorso = classroom::findOrFail($id);
        $simulatorClassroom = SimulatorClassroom::where('simulator_player_id', $SimulatorPlayer->id)
            ->where('classroom_id', $percorso->id)
            ->firstOrFail();

        if ($personale->simulator_player_id !== $SimulatorPlayer->id || $personale->classroom_id !== $simulatorClassroom->id) {
            abort(403, 'Azione non autorizzata');
        }

        return view('simulatore.personaleForm', compact('percorso', 'SimulatorPlayer', 'personale'));
    }

    public function showImpresa(SimulatorPlayer $SimulatorPlayer, $id)
    {
        $percorso = classroom::findOrFail($id);

        return view('simulatore.showImpresa', compact('percorso', 'SimulatorPlayer'));
    }

    private function generateCaptchaCode(int $length = 5): string
    {
        $characters = 'ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz23456789';
        $code = '';

        for ($i = 0; $i < $length; $i++) {
            $code .= $characters[random_int(0, strlen($characters) - 1)];
        }

        return $code;
    }

    private function generateCaptchaSvgDataUri(string $code): string
    {
        $escapedCode = htmlspecialchars($code, ENT_QUOTES, 'UTF-8');
        $noise = '';

        for ($i = 0; $i < 70; $i++) {
            $cx = random_int(0, 260);
            $cy = random_int(0, 40);
            $opacity = random_int(2, 4) / 10;
            $noise .= '<circle cx="'.$cx.'" cy="'.$cy.'" r="1" fill="black" opacity="'.$opacity.'"/>';
        }

        $svg = '<svg xmlns="http://www.w3.org/2000/svg" width="260" height="44">'
            .'<rect width="100%" height="100%" fill="white"/>'
            .'<text x="18" y="30" font-size="24" font-family="monospace" fill="black">'.$escapedCode.'</text>'
            .$noise
            .'</svg>';

        return 'data:image/svg+xml;base64,'.base64_encode($svg);
    }
}
