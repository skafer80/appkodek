<?php

namespace App\Http\Controllers;

use App\Models\Allenamento\ClickSubject;
use App\Models\Allenamento\Player;
use App\Models\Allenamento\ClickStudent as student;
use Carbon\Carbon;
use Illuminate\Http\Request;

class allenamentoController extends Controller
{
    public function index()
    {
        $players = Player::where('ente', 2)->get();
        $giocate = Player::whereNotNull('end_time')
            ->where('ente', 2)
            ->where('tipo', 0)
            ->orderBy('start_time', 'DESC') // Ordino per data più recente prima
            ->get();

        $giocateModuli = Player::whereNotNull('end_time')
            ->where('ente', 2)
            ->where('tipo', 1)
            ->orderBy('start_time', 'DESC') // Ordino per data più recente prima
            ->get();

        return view('allenamento.index', compact('players', 'giocate', 'giocateModuli'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
        ]);

        $player = Player::create([
            'nome' => $request->nome,
            'start_time' => now(),
            'ente' => 2,
            'tipo' => $request->tipo === 'MODULI' ? 1 : 0,
        ]);

        if ($request->tipo === 'MODULI') {
            // Aggiungo i moduli predefiniti per il player (da 155863 a 155871)
            for ($i = 155863; $i <= 155871; $i++) {
                ClickSubject::create([
                    'id_subject' => $i,
                    'ore_conoscenza' => 0,
                    'ore_fad_conoscenza' => 0,
                    'gruppo' => '36345',
                    'player_id' => $player->id,
                ]);
            }
            for ($i = 155872; $i <= 155876; $i++) {
                ClickSubject::create([
                    'id_subject' => $i,
                    'ore_conoscenza' => 0,
                    'ore_fad_conoscenza' => 0,
                    'gruppo' => '36346',
                    'player_id' => $player->id,
                ]);
            }

            for ($i = 155877; $i <= 155882; $i++) {
                ClickSubject::create([
                    'id_subject' => $i,
                    'ore_conoscenza' => 0,
                    'ore_fad_conoscenza' => 0,
                    'gruppo' => '36347',
                    'player_id' => $player->id,
                ]);
            }

            for ($i = 155883; $i <= 155893; $i++) {
                ClickSubject::create([
                    'id_subject' => $i,
                    'ore_conoscenza' => 0,
                    'ore_fad_conoscenza' => 0,
                    'gruppo' => '36348',
                    'player_id' => $player->id,
                ]);
            }

            return redirect()->route('allenamento.showModuli', ['id' => $player->id]);
        }

        return redirect()->route('allenamento.showClasse', ['id' => $player->id]);
    }

    public function showClasse($id)
    {
        $player = Player::findOrFail($id);
        $students = Student::where('player_id', $player->id)->get();

        return view('allenamento.showClasse', compact('player', 'students'));
    }

    public function showModuli($id)
    {
        $player = Player::findOrFail($id);
        $subjects = ClickSubject::where('player_id', $player->id)->get();

        return view('allenamento.showModuli', compact('player', 'subjects'));
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

        // dd($request->all());

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

        if ($MD36345 === 84 && $MD36346 === 78 && $MD36347 >= 156 && $MD36348 === 102 && $subject_zero === 0) {
            $player = Player::findOrFail($request->player_id);
            $player->end_time = now();
            $player->save();
        }

        return redirect()->route('allenamento.showModuli', ['id' => $request->player_id])
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
        Student::create($data);

        $contaStudenti = Student::where('player_id', $request->player_id)->count();

        if ($contaStudenti >= 10) {
            $player = Player::findOrFail($request->player_id);
            $player->end_time = now();
            $player->save();
        }

        return redirect()->route('allenamento.showClasse', ['id' => $request->player_id])
            ->with('success', 'Destinatario aggiunto con successo.');
    }

    public function createDestinatario($id)
    {
        return view('allenamento.create')
            ->with('player_id', $id);
    }
}
