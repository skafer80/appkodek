<?php

namespace App\Http\Controllers;

use App\Models\Allenamento\ClickPersonale;
use App\Models\Allenamento\ClickStudent as student;
use App\Models\Allenamento\ClickSubject;
use App\Models\Allenamento\Player;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class clickController extends Controller
{
    public function index()
    {
        $players = Player::all();
        $giocate = Player::whereNotNull('end_time')
            ->where('tipo', 0)
            ->orderBy('start_time', 'DESC') // Ordino per data più recente prima
            ->get();

        // Media dei partecipanti e tempo per giocate con nome uguale (tipo 0 - studenti)
        $giocateConMedia = Player::whereNotNull('end_time')
            ->where('tipo', 0)
 ->selectRaw('nome,
                AVG((SELECT COUNT(*) FROM click_students WHERE click_students.player_id = players.id)) as media_partecipanti,
                AVG(TIMESTAMPDIFF(SECOND, start_time, end_time)) as tempo_medio_secondi,
                COUNT(*) as numero_giocate')
                ->groupBy('nome')
            ->orderBy('tempo_medio_secondi', 'ASC')
            ->get();

        // dd($giocateConMedia);

        $giocateModuli = Player::whereNotNull('end_time')
            ->where('tipo', 1)
            ->orderBy('start_time', 'DESC') // Ordino per data più recente prima
            ->get();

        $giocatePersonale = Player::whereNotNull('end_time')
            ->where('tipo', 2)
            ->orderBy('start_time', 'DESC') // Ordino per data più recente prima
            ->get();

        return view('click.index', compact('players', 'giocate', 'giocateModuli', 'giocatePersonale', 'giocateConMedia'));
    }

    public function ewebShow()
    {
        return view('click.ewebIndex');
    }

    public function ewebEnti()
    {
        return view('click.ewebEnti');
    }

    public function tabellaSelezione()
    {
        return view('click.tabellaSelezione');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
        ]);

        $player = Player::create([
            'nome' => $request->nome,
            'start_time' => now(),
            'tipo' => $request->tipo === 'MODULI' ? 1 : ($request->tipo === 'PERSONALE' ? 2 : 0),
            'tabella' => $request->tabella ?? null,
        ]);

        if ($request->tipo === 'MODULI') {
            // Aggiungo i moduli predefiniti per il player (da 155863 a 155871)
            for ($i = 155863; $i <= 155865; $i++) {
                ClickSubject::create([
                    'id_subject' => $i,
                    'ore_conoscenza' => 0,
                    'ore_fad_conoscenza' => 0,
                    'gruppo' => '36345',
                    'player_id' => $player->id,
                ]);
            }
            for ($i = 155866; $i <= 155870; $i++) {
                ClickSubject::create([
                    'id_subject' => $i,
                    'ore_conoscenza' => 0,
                    'ore_fad_conoscenza' => 0,
                    'gruppo' => '36346',
                    'player_id' => $player->id,
                ]);
            }

            for ($i = 155871; $i <= 155872; $i++) {
                ClickSubject::create([
                    'id_subject' => $i,
                    'ore_conoscenza' => 0,
                    'ore_fad_conoscenza' => 0,
                    'gruppo' => '36347',
                    'player_id' => $player->id,
                ]);
            }

            for ($i = 155873; $i <= 155883; $i++) {
                ClickSubject::create([
                    'id_subject' => $i,
                    'ore_conoscenza' => 0,
                    'ore_fad_conoscenza' => 0,
                    'gruppo' => '36348',
                    'player_id' => $player->id,
                ]);
            }

            return redirect()->route('click.showModuli', ['id' => $player->id]);
        }

        if ($request->tipo === 'PERSONALE') {
            return redirect()->route('click.showClassePersonale', ['id' => $player->id]);
        }

        return redirect()->route('click.showClasse', ['id' => $player->id]);
    }

    public function showClasse($id)
    {
        $player = Player::findOrFail($id);
        $students = student::where('player_id', $player->id)->get();

        return view('click.showClasse', compact('player', 'students'));
    }

    public function showClassePersonale($id)
    {
        $player = Player::findOrFail($id);
        $persone = ClickPersonale::where('player_id', $player->id)->get();
        $ruoliPossibili = collect(['Direttore di progetto', 'Personale amministrativo', 'Tutor', 'REO']);
        $ruoliPresenti = $persone->pluck('ruolo')->unique()->sort()->values();
        $ruoliMancanti = $ruoliPossibili->diff($ruoliPresenti);
        $allRuoliPresenti = $ruoliMancanti->isEmpty();

        return view('click.showClassePersonale', compact('player', 'persone', 'ruoliMancanti', 'allRuoliPresenti'));
    }

    public function showModuli($id)
    {
        $player = Player::findOrFail($id);
        $subjects = ClickSubject::where('player_id', $player->id)->get();

        return view('click.showModuli', compact('player', 'subjects'));
    }

    public function getModulo($id)
    {
        $materia = ClickSubject::find($id);
        if (! $materia) {
            return response()->json(['error' => 'Modulo non trovato'], 404);
        }

        return response()->json([
            'data' => [
                'id' => $id,
                't_denominazione_conoscenza' => 'Titolo modulo fittizio',
                'ore_conoscenza' => $materia->ore_conoscenza,
                'ore_fad_conoscenza' => $materia->ore_fad_conoscenza,
                'ore_stage_conoscenza' => 0,
                'b_competenza_trasversale' => 0,
                't_competenze_correlate' => 0,
            ],
        ]);
    }

    public function editModuli(Request $request)
    {

        $subject = ClickSubject::find($request->id);

        if (! $subject) {
            return redirect()->back()->with('error', 'Modulo non trovato');
        }

        $subject->ore_conoscenza = $request->ore_conoscenza ?? 0;
        $subject->ore_fad_conoscenza = $request->ore_fad_conoscenza ?? 0;
        $subject->save();

        $subjects = ClickSubject::where('player_id', $request->player_id)->get();
        $MD36345 = $subjects->where('gruppo', '36345')->sum('ore_conoscenza') + $subjects->where('gruppo', '36345')->sum('ore_fad_conoscenza');
        $MD36346 = $subjects->where('gruppo', '36346')->sum('ore_conoscenza') + $subjects->where('gruppo', '36346')->sum('ore_fad_conoscenza');
        $MD36347 = $subjects->where('gruppo', '36347')->sum('ore_conoscenza') + $subjects->where('gruppo', '36347')->sum('ore_fad_conoscenza');
        $MD36348 = $subjects->where('gruppo', '36348')->sum('ore_conoscenza') + $subjects->where('gruppo', '36348')->sum('ore_fad_conoscenza');

        $subject_zero = ClickSubject::where('player_id', $request->player_id)
            ->where(function ($query) {
                $query->whereNull('ore_conoscenza')
                    ->orWhere('ore_conoscenza', 0);
            })->count();

        if ($MD36345 === 66 && $MD36346 === 68 && $MD36347 >= 24 && $MD36348 === 192 && $subject_zero === 0) {
            $player = Player::findOrFail($request->player_id);
            $player->end_time = now();
            $player->save();
        }

        return redirect()->route('click.showModuli', ['id' => $request->player_id])
            ->with('success', 'Modulo aggiornato con successo.');
    }

    public function storeDestinatario(Request $request)
    {

        /*         $request->validate([
                    'd_ammesso_selezione' => 'required',
                    'd_nascita' => 'required',
                    't_nome' => 'required|string|max:255',
                    't_cognome' => 'required|string|max:255',
                    't_sesso' => 'required|string|max:10',
                    'b_disabile' => 'required|boolean',
                    't_n_provincia' => 'required|string|max:255',
                    't_n_comune' => 'required|string|max:255',
                    't_n_altro_comune' => 'nullable|string|max:255',
                    't_codice_fiscale' => 'required|string|max:16',
                    'i_cittadinanza_id' => 'required|integer',
                    't_r_provincia' => 'required|string|max:255',
                    't_r_comune' => 'required|string|max:255',
                    't_d_provincia' => 'nullable|string|max:255',
                    't_d_comune' => 'nullable|string|max:255',
                    'i_tipo_titolo_studio_id' => 'required|integer',
                    'i_tipo_condizione_occupazionale_id' => 'required|integer',
                    'player_id' => 'required|exists:players,id',
                ]); */

        // Converti le date in formato MySQL
        $data = $request->all();
        $data['d_ammesso_selezione'] = Carbon::createFromFormat('d/m/Y', $request->d_ammesso_selezione)->format('Y-m-d');
        $data['d_nascita'] = Carbon::createFromFormat('d/m/Y', $request->d_nascita)->format('Y-m-d');
        $data['b_disabile'] = $request->b_disabile === 'Y' ? 1 : 0;

        // Inserisci nel database
        student::create($data);

        $contaStudenti = student::where('player_id', $request->player_id)->count();

        if ($contaStudenti >= 15) {
            $player = Player::findOrFail($request->player_id);
            $player->end_time = now();
            $player->save();
        }

        return redirect()->route('click.showClasse', ['id' => $request->player_id])
            ->with('success', 'Destinatario aggiunto con successo.');
    }

    public function createDestinatario($id)
    {
        return view('click.create')
            ->with('player_id', $id);
    }

    public function createPersonale($id)
    {
        return view('click.personale')
            ->with('player_id', $id);
    }

    public function storePersonale(Request $request)
    {
        try {
            $test = $request->validate([
                'nome' => 'required|string|max:255',
                'cognome' => 'required|string|max:255',
                'cf' => 'required|string|max:16',
                'telefono' => 'required|string|max:20',
                'email' => 'required|email|max:255',
                'data_nascita' => 'required|date_format:d/m/Y',
                'ruolo' => 'required|string|max:50',
                'player_id' => 'required|exists:players,id',
            ]);
        } catch (ValidationException $e) {
            dd('Errori di validazione:', $e->errors(), 'Request data:', $request->all());
        }

        // Converti la data di nascita in formato MySQL
        $data = $request->all();
        $data['data_nascita'] = Carbon::createFromFormat('d/m/Y', $request->data_nascita)->format('Y-m-d');
        $data['esterno'] = $request->esterno === 'Y' ? 1 : 0;

        // Inserisci nel database
        ClickPersonale::create($data);

        $persone = ClickPersonale::where('player_id', $request->player_id)->get();
        $ruoliPossibili = collect(['Direttore di progetto', 'Personale amministrativo', 'Tutor', 'REO']);
        $ruoliPresenti = $persone->pluck('ruolo')->unique()->sort()->values();
        $ruoliMancanti = $ruoliPossibili->diff($ruoliPresenti);

        if ($ruoliMancanti->isEmpty()) {
            $player = Player::findOrFail($request->player_id);
            $player->end_time = now();
            $player->save();
        }

        return redirect()->route('click.showClassePersonale', ['id' => $request->player_id])
            ->with('success', 'Personale aggiunto con successo.');
    }
}
