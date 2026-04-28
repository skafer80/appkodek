<?php

namespace App\Http\Controllers\simulatore;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\classroom;
use App\Models\formazione;
use App\Models\Moduli;
use App\Models\SimulatorImpresa;
use App\Models\Comune;
use App\Models\SimulatorClassroom;
use App\Models\SimulatorModuli;
use App\Models\SimulatorPartecipante;
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
                        'totale_ore_stage' => $categoria->ore_stage,
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

    public function showPartecipanti(SimulatorPlayer $SimulatorPlayer, $id)
    {
        $percorso = classroom::findOrFail($id);

        $partecipanti = SimulatorPartecipante::where('simulator_player_id', $SimulatorPlayer->id)
            ->where('classroom_id', $percorso->id)
            ->orderBy('created_at')
            ->get();

        $minimoRichiesto = 8;
        $massimoConsentito = 10;

        return view('simulatore.showPartecipanti', compact('percorso', 'SimulatorPlayer', 'partecipanti', 'minimoRichiesto', 'massimoConsentito'));
    }

    public function showCreatePartecipante(SimulatorPlayer $SimulatorPlayer, $id)
    {
        $percorso = classroom::findOrFail($id);
        $captchaCode = $this->generateCaptchaCode();
        session(['simulatore_partecipante_captcha' => $captchaCode]);
        $captchaImageDataUri = $this->generateCaptchaSvgDataUri($captchaCode);

        $province = Comune::query()
            ->whereNotNull('sigla')
            ->select('sigla')
            ->distinct()
            ->orderBy('sigla')
            ->pluck('sigla');

        $comuniBySigla = Comune::query()
            ->whereNotNull('sigla')
            ->select('sigla', 'comune')
            ->orderBy('comune')
            ->get()
            ->groupBy('sigla')
            ->map(fn ($items) => $items->pluck('comune')->values());

        return view('simulatore.partecipanteForm', compact('percorso', 'SimulatorPlayer', 'province', 'comuniBySigla', 'captchaImageDataUri'));
    }

    public function showDettaglioPartecipante(SimulatorPlayer $SimulatorPlayer, $id, SimulatorPartecipante $partecipante)
    {
        $percorso = classroom::findOrFail($id);

        if ($partecipante->simulator_player_id !== $SimulatorPlayer->id || $partecipante->classroom_id !== $percorso->id) {
            abort(403, 'Azione non autorizzata');
        }

        $province = Comune::query()
            ->whereNotNull('sigla')
            ->select('sigla')
            ->distinct()
            ->orderBy('sigla')
            ->pluck('sigla');

        $comuniBySigla = Comune::query()
            ->whereNotNull('sigla')
            ->select('sigla', 'comune')
            ->orderBy('comune')
            ->get()
            ->groupBy('sigla')
            ->map(fn ($items) => $items->pluck('comune')->values());

        return view('simulatore.partecipanteForm', compact('percorso', 'SimulatorPlayer', 'partecipante', 'province', 'comuniBySigla'));
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

    public function showVerifica(SimulatorPlayer $SimulatorPlayer, $id)
    {
        $percorso = classroom::with('formazione')->findOrFail($id);

        $simulatorClassroom = SimulatorClassroom::where('simulator_player_id', $SimulatorPlayer->id)
            ->where('classroom_id', $percorso->id)
            ->first();

        $controlli = [];
        $errori = [];

        $addControllo = function (string $sezione, string $route, string $linkLabel, array $erroriControllo) use (&$controlli, &$errori): void {
            $controllo = [
                'sezione' => $sezione,
                'route' => $route,
                'link_label' => $linkLabel,
                'errori' => $erroriControllo,
                'ok' => empty($erroriControllo),
            ];

            $controlli[] = $controllo;

            if (! $controllo['ok']) {
                $errori[] = $controllo;
            }
        };

        // 1. Dettaglio percorso - date
        $erroriDettaglio = [];
        if (! $simulatorClassroom || ! $simulatorClassroom->data_avvio) {
            $erroriDettaglio[] = 'Inserire data avvio prevista';
        }
        if (! $simulatorClassroom || ! $simulatorClassroom->data_fine) {
            $erroriDettaglio[] = 'Inserire data fine prevista';
        }
        $addControllo(
            'Controlli sul dettaglio percorso',
            route('simulatore.showDettagliPercorso', [$SimulatorPlayer->id, $percorso->id]),
            'APRI SEZIONE DETTAGLIO',
            $erroriDettaglio
        );

        // 2. Personale non docente - Conteggi
        $personale = collect();
        if ($simulatorClassroom) {
            $personale = SimulatorPersonale::where('simulator_player_id', $SimulatorPlayer->id)
                ->where('classroom_id', $simulatorClassroom->id)
                ->get();
        }
        $erroriPersonaleConteggi = [];
        if ($personale->isEmpty()) {
            $erroriPersonaleConteggi[] = 'Inserire almeno un soggetto tra il personale non docente';
        }
        $addControllo(
            'Personale non docente => Conteggi',
            route('simulatore.showPersonale', [$SimulatorPlayer->id, $percorso->id]),
            'APRI SEZIONE PERSONALE NON DOCENTE',
            $erroriPersonaleConteggi
        );

        // 3. Personale non docente - Figure professionali
        $ruoliAttesi = [
            'REO'                      => ['esatto' => 1],
            'Direttore di progetto'    => ['minimo' => 1],
            'Tutor'                    => ['minimo' => 1],
            'Responsabile amministrativo' => ['minimo' => 1],
        ];
        $erroriRuoli = [];
        foreach ($ruoliAttesi as $ruolo => $regola) {
            $count = $personale->filter(fn ($p) => strtolower($p->ruolo) === strtolower($ruolo))->count();
            if (isset($regola['esatto'])) {
                if ($count !== $regola['esatto']) {
                    $volte = $regola['esatto'] === 1 ? 'una volta' : $regola['esatto'].' volte';
                    $erroriRuoli[] = 'La figura di "'.strtoupper($ruolo).'" deve essere presente '.$volte.' ('.$count.')';
                }
            } elseif (isset($regola['minimo']) && $count < $regola['minimo']) {
                $erroriRuoli[] = 'La figura di "'.strtoupper($ruolo).'" deve essere presente almeno una volta';
            }
        }
        $addControllo(
            'Personale non docente => Figure professionali',
            route('simulatore.showPersonale', [$SimulatorPlayer->id, $percorso->id]),
            'APRI SEZIONE PERSONALE NON DOCENTE',
            $erroriRuoli
        );

        // 4. Docenti - Fasce (somma fascia_a + fascia_b + fascia_c deve essere 404)
        $oreTotaliAttese = 404;
        $fasceOk = $simulatorClassroom
            && $simulatorClassroom->fascia_a !== null
            && $simulatorClassroom->fascia_b !== null
            && $simulatorClassroom->fascia_c !== null
            && ((int) $simulatorClassroom->fascia_a + (int) $simulatorClassroom->fascia_b + (int) $simulatorClassroom->fascia_c) === $oreTotaliAttese;
        $erroriFasce = [];
        if (! $fasceOk) {
            $erroriFasce[] = 'La somma delle ore non corrisponde al totale delle ore aula/FAD';
        }
        $addControllo(
            'Docenti => Fasce',
            route('simulatore.showDatiEconomici', [$SimulatorPlayer->id, $percorso->id]),
            'APRI SEZIONE DATI ECONOMICI',
            $erroriFasce
        );

        // 5. Partecipanti - Conteggi
        $countPartecipanti = SimulatorPartecipante::where('simulator_player_id', $SimulatorPlayer->id)
            ->where('classroom_id', $percorso->id)
            ->count();
        $erroriPartecipanti = [];
        if ($countPartecipanti < 8 || $countPartecipanti > 10) {
            $erroriPartecipanti[] = 'Numero minimo/massimo di partecipanti (8/10) non corretto ('.$countPartecipanti.')';
        }
        $addControllo(
            'Partecipanti => Conteggi',
            route('simulatore.showPartecipanti', [$SimulatorPlayer->id, $percorso->id]),
            'APRI SEZIONE PARTECIPANTI',
            $erroriPartecipanti
        );

        // 6 & 7. Moduli - Conteggi e Ore aula pari a zero
        $moduli = Moduli::with('gruppoModuli')
            ->where('formazione_id', $percorso->formazione_id)
            ->get();

        $salvataggiModuli = SimulatorModuli::where('simulator_player_id', $SimulatorPlayer->id)
            ->whereIn('modulo_id', $moduli->pluck('id'))
            ->get()
            ->keyBy('modulo_id');

        $erroriModuliConteggi = [];
        $erroriModuliZero = [];

        foreach ($moduli->groupBy('gruppo_moduli_id') as $moduliGruppo) {
            $gruppo = $moduliGruppo->first()->gruppoModuli;
            $oreAttese = (int) $gruppo->getOreAula();
            $oreInserite = $moduliGruppo->sum(fn ($m) => (int) ($salvataggiModuli->get($m->id)->ore_aula ?? 0));

            if ($oreInserite !== $oreAttese) {
                $erroriModuliConteggi[] = 'Conteggio ore AULA modulo "'.$gruppo->nome.'" differente da '.$oreAttese.' ('.$oreInserite.')';
            }

            foreach ($moduliGruppo as $modulo) {
                $oreAula = (int) ($salvataggiModuli->get($modulo->id)->ore_aula ?? 0);
                if ($oreAula === 0) {
                    $erroriModuliZero[] = 'Il modulo "'.$gruppo->nome.' => '.$modulo->nome.'" ha zero (0) ore';
                }
            }
        }

        $addControllo(
            'Moduli => Conteggi',
            route('simulatore.showModuli', [$SimulatorPlayer->id, 'id' => $percorso->formazione_id]),
            'APRI SEZIONE MODULI',
            $erroriModuliConteggi
        );

        $addControllo(
            'Moduli => Ore aula pari a zero',
            route('simulatore.showModuli', [$SimulatorPlayer->id, 'id' => $percorso->formazione_id]),
            'APRI SEZIONE MODULI',
            $erroriModuliZero
        );

        // 8. Stage - Campi di dettaglio (giornate stage)
        $erroriStageDettaglio = [];
        if (! $simulatorClassroom || ! $simulatorClassroom->totale_giornate_stage) {
            $erroriStageDettaglio[] = 'Compilare tutti i campi del dettaglio stage';
        }
        $addControllo(
            'Stage => Campi di dettaglio',
            route('simulatore.showStage', [$SimulatorPlayer->id, $percorso->id]),
            'APRI SEZIONE STAGE',
            $erroriStageDettaglio
        );

        // 9. Stage - Date
        $erroriStageDate = [];
        if (! $simulatorClassroom || ! $simulatorClassroom->data_avvio_stage) {
            $erroriStageDate[] = 'Compilare i campi data avvio e fine stage e le date di avvio e fine edizione';
        } elseif (! $simulatorClassroom->data_fine_stage) {
            $erroriStageDate[] = 'Compilare i campi data avvio e fine stage e le date di avvio e fine edizione';
        }
        $addControllo(
            'Stage => Date',
            route('simulatore.showStage', [$SimulatorPlayer->id, $percorso->id]),
            'APRI SEZIONE STAGE',
            $erroriStageDate
        );

        // 10. Stage - Sedi
        $countImprese = SimulatorImpresa::where('simulator_player_id', $SimulatorPlayer->id)
            ->where('classroom_id', $percorso->id)
            ->count();
        $erroriStageSedi = [];
        if ($countImprese === 0) {
            $erroriStageSedi[] = 'Inserire almeno un soggetto presso cui fare lo stage';
        }
        $addControllo(
            'Stage => Sedi',
            route('simulatore.showStage', [$SimulatorPlayer->id, $percorso->id]),
            'APRI SEZIONE STAGE',
            $erroriStageSedi
        );

        $verificaOk = empty($errori);

        return view('simulatore.verifica', compact('percorso', 'SimulatorPlayer', 'controlli', 'errori', 'verificaOk'));
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
