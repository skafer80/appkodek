<?php

namespace App\Http\Controllers\simulatore;

use App\Http\Controllers\Controller;
use App\Models\classroom;
use App\Models\SimulatorClassroom;
use App\Models\SimulatorPlayer;
use App\Models\SimulatorImpresa;
use App\Models\SimulatorPersonale;
use App\Models\Comune;
use Carbon\Carbon;
use Illuminate\Http\Request;

class memorizzaController extends Controller
{
    public function dettagliPercorso(SimulatorPlayer $SimulatorPlayer, classroom $classroom, Request $request)
    {
        $validated = $request->validate([
            'data_avvio_prevista' => ['required', 'date_format:d/m/Y', 'after_or_equal:27/04/2026', 'before_or_equal:03/06/2026'],
            'data_fine_prevista' => ['required', 'date_format:d/m/Y', 'after_or_equal:data_avvio_prevista', 'before_or_equal:20/11/2026'],
            'importo_finanziamenti' => ['nullable', 'numeric', 'min:0'],
            'giornate_aula_previste' => ['nullable', 'integer', 'min:70', 'max:139'],
        ], [
            'data_avvio_prevista.required' => 'Inserire la data di avvio prevista.',
            'data_avvio_prevista.date_format' => 'La data di avvio prevista deve essere nel formato gg/mm/aaaa.',
            'data_avvio_prevista.after_or_equal' => 'La data di avvio prevista non pu\u00f2 essere antecedente al 27/04/2026.',
            'data_avvio_prevista.before_or_equal' => 'La data di avvio prevista non pu\u00f2 essere successiva al 03/06/2026.',
            'data_fine_prevista.required' => 'Inserire la data di fine prevista.',
            'data_fine_prevista.date_format' => 'La data di fine prevista deve essere nel formato gg/mm/aaaa.',
            'data_fine_prevista.after_or_equal' => 'La data di fine prevista non pu\u00f2 essere antecedente alla data di avvio prevista.',
            'data_fine_prevista.before_or_equal' => 'La data di fine prevista non pu\u00f2 essere successiva al 20/11/2026.',
            'importo_finanziamenti.numeric' => 'L\'importo dei finanziamenti deve essere numerico.',
            'importo_finanziamenti.min' => 'L\'importo dei finanziamenti non pu\u00f2 essere negativo.',
            'giornate_aula_previste.integer' => 'Il numero di giornate previste deve essere un intero.',
            'giornate_aula_previste.min' => 'Il numero di giornate previste non pu\u00f2 essere inferiore a 70.',
            'giornate_aula_previste.max' => 'Il numero di giornate previste non pu\u00f2 essere superiore a 139.',
        ]);

        $classroom = SimulatorClassroom::updateOrCreate([
            'simulator_player_id' => $SimulatorPlayer->id,
            'classroom_id' => $classroom->id,
        ], [
            'data_avvio' => $validated['data_avvio_prevista'],
            'data_fine' => $validated['data_fine_prevista'],
            'importo' => $validated['importo_finanziamenti'],
            'totale_giornate' => $validated['giornate_aula_previste'],
        ]);

        return redirect()->route('simulatore.showDettagliPercorso', [$SimulatorPlayer->id, $classroom->id])->with('success', 'Dettagli percorso memorizzati con successo.');
    }

    public function dettagliStage(SimulatorPlayer $SimulatorPlayer, Classroom $classroom, Request $request)
    {
        $validated = $request->validate([
            'd_avvio_stage' => ['required', 'date_format:d/m/Y', 'after_or_equal:27/04/2026', 'before_or_equal:20/11/2026'],
            'd_fine_stage' => ['required', 'date_format:d/m/Y', 'after_or_equal:d_avvio_stage', 'before_or_equal:20/11/2026'],
            'i_giornate_stage' => ['required', 'integer', 'min:19', 'max:38'],
        ], [
            'd_avvio_stage.required' => 'Inserire la data di avvio prevista dello stage.',
            'd_avvio_stage.date_format' => 'La data di avvio dello stage deve essere nel formato gg/mm/aaaa.',
            'd_avvio_stage.after_or_equal' => 'La data di avvio dello stage non pu\u00f2 essere antecedente al 27/04/2026.',
            'd_avvio_stage.before_or_equal' => 'La data di avvio dello stage non pu\u00f2 essere successiva al 20/11/2026.',
            'd_fine_stage.required' => 'Inserire la data di fine prevista dello stage.',
            'd_fine_stage.date_format' => 'La data di fine dello stage deve essere nel formato gg/mm/aaaa.',
            'd_fine_stage.after_or_equal' => 'La data di fine dello stage non pu\u00f2 essere antecedente alla data di avvio.',
            'd_fine_stage.before_or_equal' => 'La data di fine dello stage non pu\u00f2 essere successiva al 20/11/2026.',
            'i_giornate_stage.required' => 'Inserire il numero di giornate stage.',
            'i_giornate_stage.integer' => 'Il numero di giornate stage deve essere un intero.',
            'i_giornate_stage.min' => 'Il numero di giornate stage non pu\u00f2 essere inferiore a 19.',
            'i_giornate_stage.max' => 'Il numero di giornate stage non pu\u00f2 essere superiore a 38.',
        ]);

        $classroom = SimulatorClassroom::updateOrCreate([
            'simulator_player_id' => $SimulatorPlayer->id,
            'classroom_id' => $classroom->id,
        ], [
            'data_avvio_stage' => $validated['d_avvio_stage'],
            'data_fine_stage' => $validated['d_fine_stage'],
            'totale_giornate_stage' => $validated['i_giornate_stage'],
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

    public function dettagliPersonale(SimulatorPlayer $SimulatorPlayer, Classroom $classroom, Request $request)
    {
        $simulatorClassroom = SimulatorClassroom::where('simulator_player_id', $SimulatorPlayer->id)
            ->where('classroom_id', $classroom->id)
            ->first();

        if (! $simulatorClassroom) {
            return back()
                ->withErrors(['classroom' => 'Prima di inserire il personale, completa e salva i dettagli del percorso.'])
                ->withInput();
        }

        $isCreate = empty($request->input('personale_id'));

        $rules = [
            'personale_id' => ['nullable', 'integer', 'exists:simulator_personales,id'],
            'nome' => ['required', 'string', 'max:255'],
            'cognome' => ['required', 'string', 'max:255'],
            'cf' => ['required', 'string', 'max:16'],
            'telefono' => ['required', 'string', 'max:20'],
            'email' => ['required', 'email', 'max:255'],
            'data_nascita' => ['required', 'date_format:d/m/Y'],
            'ruolo' => ['required', 'string', 'max:100'],
            'esterno' => ['required', 'in:Y,N'],
        ];

        $messages = [
            'nome.required' => 'Inserire il nome.',
            'cognome.required' => 'Inserire il cognome.',
            'cf.required' => 'Inserire il codice fiscale.',
            'telefono.required' => 'Inserire il telefono.',
            'email.required' => 'Inserire l\'email.',
            'email.email' => 'Inserire un indirizzo email valido.',
            'data_nascita.required' => 'Inserire la data di nascita.',
            'data_nascita.date_format' => 'La data di nascita deve essere nel formato gg/mm/aaaa.',
            'ruolo.required' => 'Selezionare un ruolo.',
            'esterno.required' => 'Indicare se il personale è esterno.',
            'esterno.in' => 'Il valore del personale esterno non è valido.',
        ];

        if ($isCreate) {
            $rules['captcha_code'] = [
                'required',
                'string',
                function (string $attribute, mixed $value, \Closure $fail) use ($request): void {
                    $expectedCaptcha = (string) $request->session()->get('simulatore_personale_captcha', '');
                    $submittedCaptcha = trim((string) $value);

                    if ($expectedCaptcha === '' || ! hash_equals($expectedCaptcha, $submittedCaptcha)) {
                        $fail('Il codice di controllo non è corretto.');
                    }
                },
            ];

            $messages['captcha_code.required'] = 'Digitare il codice di controllo.';
        }

        $validated = $request->validate($rules, $messages);

        if ($isCreate) {
            $request->session()->forget('simulatore_personale_captcha');
        }

        $personale = null;
        if (! empty($validated['personale_id'])) {
            $personale = SimulatorPersonale::findOrFail($validated['personale_id']);

            if ($personale->simulator_player_id !== $SimulatorPlayer->id || $personale->classroom_id !== $simulatorClassroom->id) {
                abort(403, 'Azione non autorizzata');
            }
        }

        $payload = [
            'simulator_player_id' => $SimulatorPlayer->id,
            'classroom_id' => $simulatorClassroom->id,
            'nome' => $validated['nome'],
            'cognome' => $validated['cognome'],
            'cf' => strtoupper($validated['cf']),
            'telefono' => $validated['telefono'],
            'email' => $validated['email'],
            'data_nascita' => Carbon::createFromFormat('d/m/Y', $validated['data_nascita'])->format('Y-m-d'),
            'ruolo' => $validated['ruolo'],
            'esterno' => $validated['esterno'] === 'Y',
        ];

        if ($personale) {
            $personale->update($payload);
        } else {
            SimulatorPersonale::create($payload);
        }

        return redirect()->route('simulatore.showPersonale', [$SimulatorPlayer->id, $classroom->id])->with('success', 'Personale non docente salvato con successo.');
    }

    public function eliminaImpresa(SimulatorPlayer $SimulatorPlayer, SimulatorImpresa $impresa)
     {
        if ($impresa->simulator_player_id !== $SimulatorPlayer->id) {
            abort(403, 'Azione non autorizzata');
        }

        $classroom = classroom::findOrFail($impresa->classroom_id);

        $impresa->delete();

        return redirect()->route('simulatore.showStage', [$SimulatorPlayer->id, $classroom->id])->with('success', 'Dettagli impresa eliminata con successo.');

    }

    public function eliminaPersonale(SimulatorPlayer $SimulatorPlayer, SimulatorPersonale $personale)
    {
        if ($personale->simulator_player_id !== $SimulatorPlayer->id) {
            abort(403, 'Azione non autorizzata');
        }

        $simulatorClassroom = SimulatorClassroom::findOrFail($personale->classroom_id);

        if ($simulatorClassroom->simulator_player_id !== $SimulatorPlayer->id) {
            abort(403, 'Azione non autorizzata');
        }

        $personale->delete();

        return redirect()->route('simulatore.showPersonale', [$SimulatorPlayer->id, $simulatorClassroom->classroom_id])->with('success', 'Personale non docente eliminato con successo.');
    }

    public function dettagliDatiEconomici(SimulatorPlayer $SimulatorPlayer, Classroom $classroom, Request $request)
    {
        $validated = $request->validate([
            'ore_presunte_fascia_a' => ['required', 'integer', 'min:162', 'max:202'],
            'ore_presunte_fascia_b' => ['required', 'integer', 'min:0', 'max:242'],
            'ore_presunte_fascia_c' => ['required', 'integer', 'min:0', 'max:101'],
        ], [
            'ore_presunte_fascia_a.required' => 'Inserire le ore della fascia A.',
            'ore_presunte_fascia_a.integer' => 'Le ore della fascia A devono essere un numero intero.',
            'ore_presunte_fascia_a.min' => 'Le ore della fascia A devono essere almeno 162.',
            'ore_presunte_fascia_a.max' => 'Le ore della fascia A non possono superare 202.',
            'ore_presunte_fascia_b.required' => 'Inserire le ore della fascia B.',
            'ore_presunte_fascia_b.integer' => 'Le ore della fascia B devono essere un numero intero.',
            'ore_presunte_fascia_b.min' => 'Le ore della fascia B non possono essere negative.',
            'ore_presunte_fascia_b.max' => 'Le ore della fascia B non possono superare 242.',
            'ore_presunte_fascia_c.required' => 'Inserire le ore della fascia C.',
            'ore_presunte_fascia_c.integer' => 'Le ore della fascia C devono essere un numero intero.',
            'ore_presunte_fascia_c.min' => 'Le ore della fascia C non possono essere negative.',
            'ore_presunte_fascia_c.max' => 'Le ore della fascia C non possono superare 101.',
        ]);

        $totaleOre = $validated['ore_presunte_fascia_a'] + $validated['ore_presunte_fascia_b'] + $validated['ore_presunte_fascia_c'];

        if ($totaleOre !== 404) {
            return back()
                ->withErrors(['ore_totali' => 'La somma delle ore delle fasce A, B e C deve essere pari a 404.'])
                ->withInput();
        }

        $classroom = SimulatorClassroom::updateOrCreate([
            'simulator_player_id' => $SimulatorPlayer->id,
            'classroom_id' => $classroom->id,
        ], [
            'fascia_a' => $validated['ore_presunte_fascia_a'],
            'fascia_b' => $validated['ore_presunte_fascia_b'],
            'fascia_c' => $validated['ore_presunte_fascia_c'],
        ]);

        return redirect()->route('simulatore.showDatiEconomici', [$SimulatorPlayer->id, $classroom->id])->with('success', 'Dati economici memorizzati con successo.');

    }
}
