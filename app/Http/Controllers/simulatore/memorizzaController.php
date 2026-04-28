<?php

namespace App\Http\Controllers\simulatore;

use App\Http\Controllers\Controller;
use App\Models\classroom;
use App\Models\Comune;
use App\Models\SimulatorClassroom;
use App\Models\SimulatorImpresa;
use App\Models\SimulatorPartecipante;
use App\Models\SimulatorPersonale;
use App\Models\SimulatorPlayer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
            'data_avvio' => Carbon::createFromFormat('d/m/Y', $validated['data_avvio_prevista'])->format('Y-m-d'),
            'data_fine' => Carbon::createFromFormat('d/m/Y', $validated['data_fine_prevista'])->format('Y-m-d'),
            'importo' => $validated['importo_finanziamenti'],
            'totale_giornate' => $validated['giornate_aula_previste'],
        ]);

        return redirect()->route('simulatore.showDettagliPercorso', [$SimulatorPlayer->id, $classroom->id])->with('success', 'Dettagli percorso memorizzati con successo.');
    }

    public function dettagliStage(SimulatorPlayer $SimulatorPlayer, classroom $classroom, Request $request)
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
            'data_avvio_stage' => Carbon::createFromFormat('d/m/Y', $validated['d_avvio_stage'])->format('Y-m-d'),
            'data_fine_stage' => Carbon::createFromFormat('d/m/Y', $validated['d_fine_stage'])->format('Y-m-d'),
            'totale_giornate_stage' => $validated['i_giornate_stage'],
        ]);

        return redirect()->route('simulatore.showStage', [$SimulatorPlayer->id, $classroom->id])->with('success', 'Dettagli stage memorizzati con successo.');
    }

    public function dettagliImpresa(SimulatorPlayer $SimulatorPlayer, classroom $classroom, Request $request)
    {
        $comune = Comune::whereRaw('LOWER(comune) = ?', [
            strtolower(trim($request->input('sede_legale_comune'))),
        ])->first();

        if (! $comune) {
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

    public function dettagliPersonale(SimulatorPlayer $SimulatorPlayer, classroom $classroom, Request $request)
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

    public function dettagliPartecipante(SimulatorPlayer $SimulatorPlayer, classroom $classroom, Request $request)
    {
        $request->merge([
            't_codice_fiscale' => strtoupper(trim((string) $request->input('t_codice_fiscale'))),
        ]);

        $isCreate = empty($request->input('partecipante_id'));

        $rules = [
            'partecipante_id' => ['nullable', 'integer', 'exists:simulator_partecipanti,id'],
            't_codice_fiscale' => [
                'required',
                'string',
                'size:16',
                'regex:/^[A-Z0-9]{16}$/',
                function (string $attribute, mixed $value, \Closure $fail): void {
                    if (! $this->isValidItalianFiscalCode((string) $value)) {
                        $fail('Il codice fiscale non e formalmente valido.');
                    }
                },
                Rule::unique('simulator_partecipanti', 't_codice_fiscale')
                    ->where(fn ($query) => $query
                        ->where('simulator_player_id', $SimulatorPlayer->id)
                        ->where('classroom_id', $classroom->id)
                    )
                    ->ignore($request->input('partecipante_id')),
            ],
            'b_disabile' => ['required', 'in:Y,N'],
            't_r_provincia' => ['required', 'string', 'size:2'],
            't_r_comune' => ['required', 'string', 'max:255'],
            't_d_provincia' => ['nullable', 'string', 'size:2'],
            't_d_comune' => ['nullable', 'string', 'max:255'],
            'i_tipo_condizione_occupazionale_id' => ['required', 'in:8,10,12'],
        ];

        $messages = [
            't_codice_fiscale.required' => 'Inserire il codice fiscale.',
            't_codice_fiscale.size' => 'Il codice fiscale deve avere 16 caratteri.',
            't_codice_fiscale.regex' => 'Il codice fiscale deve contenere solo lettere maiuscole e numeri.',
            't_codice_fiscale.unique' => 'Esiste gia un partecipante con questo codice fiscale per questa edizione.',
            'b_disabile.required' => 'Specificare se il partecipante e disabile/categoria protetta.',
            't_r_provincia.required' => 'Selezionare la provincia di residenza.',
            't_r_comune.required' => 'Selezionare il comune di residenza.',
            'i_tipo_condizione_occupazionale_id.required' => 'Selezionare la condizione occupazionale.',
        ];

        if ($isCreate) {
            $rules['captcha_code'] = [
                'required',
                'string',
                function (string $attribute, mixed $value, \Closure $fail) use ($request): void {
                    $expectedCaptcha = (string) $request->session()->get('simulatore_partecipante_captcha', '');
                    $submittedCaptcha = trim((string) $value);

                    if ($expectedCaptcha === '' || ! hash_equals($expectedCaptcha, $submittedCaptcha)) {
                        $fail('Il codice di controllo non e corretto.');
                    }
                },
            ];

            $messages['captcha_code.required'] = 'Digitare il codice di controllo.';
        }

        $validated = $request->validate($rules, $messages);

        if ($isCreate) {
            $request->session()->forget('simulatore_partecipante_captcha');
        }

        $partecipante = null;
        if (! empty($validated['partecipante_id'])) {
            $partecipante = SimulatorPartecipante::findOrFail($validated['partecipante_id']);

            if ($partecipante->simulator_player_id !== $SimulatorPlayer->id || $partecipante->classroom_id !== $classroom->id) {
                abort(403, 'Azione non autorizzata');
            }
        }

        $payload = [
            'simulator_player_id' => $SimulatorPlayer->id,
            'classroom_id' => $classroom->id,
            't_codice_fiscale' => strtoupper(trim($validated['t_codice_fiscale'])),
            'b_disabile' => $validated['b_disabile'] === 'Y',
            't_r_provincia' => strtoupper(trim($validated['t_r_provincia'])),
            't_r_comune' => trim($validated['t_r_comune']),
            't_d_provincia' => filled($validated['t_d_provincia'] ?? null) ? strtoupper(trim($validated['t_d_provincia'])) : null,
            't_d_comune' => filled($validated['t_d_comune'] ?? null) ? trim($validated['t_d_comune']) : null,
            'i_tipo_condizione_occupazionale_id' => (int) $validated['i_tipo_condizione_occupazionale_id'],
        ];

        if ($partecipante) {
            $partecipante->update($payload);
        } else {
            SimulatorPartecipante::create($payload);
        }

        return redirect()->route('simulatore.showPartecipanti', [$SimulatorPlayer->id, $classroom->id])->with('success', 'Partecipante salvato con successo.');
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

    public function eliminaPartecipante(SimulatorPlayer $SimulatorPlayer, SimulatorPartecipante $partecipante)
    {
        if ($partecipante->simulator_player_id !== $SimulatorPlayer->id) {
            abort(403, 'Azione non autorizzata');
        }

        $classroom = classroom::findOrFail($partecipante->classroom_id);
        $partecipante->delete();

        return redirect()->route('simulatore.showPartecipanti', [$SimulatorPlayer->id, $classroom->id])->with('success', 'Partecipante eliminato con successo.');
    }

    public function dettagliDatiEconomici(SimulatorPlayer $SimulatorPlayer, classroom $classroom, Request $request)
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

    private function isValidItalianFiscalCode(string $fiscalCode): bool
    {
        $cf = strtoupper(trim($fiscalCode));

        if (! preg_match('/^[A-Z0-9]{16}$/', $cf)) {
            return false;
        }

        $oddMap = [
            '0' => 1, '1' => 0, '2' => 5, '3' => 7, '4' => 9,
            '5' => 13, '6' => 15, '7' => 17, '8' => 19, '9' => 21,
            'A' => 1, 'B' => 0, 'C' => 5, 'D' => 7, 'E' => 9,
            'F' => 13, 'G' => 15, 'H' => 17, 'I' => 19, 'J' => 21,
            'K' => 2, 'L' => 4, 'M' => 18, 'N' => 20, 'O' => 11,
            'P' => 3, 'Q' => 6, 'R' => 8, 'S' => 12, 'T' => 14,
            'U' => 16, 'V' => 10, 'W' => 22, 'X' => 25, 'Y' => 24, 'Z' => 23,
        ];

        $sum = 0;

        for ($i = 0; $i < 15; $i++) {
            $char = $cf[$i];
            $position = $i + 1;

            if ($position % 2 === 1) {
                $sum += $oddMap[$char] ?? 0;
                continue;
            }

            if (ctype_digit($char)) {
                $sum += (int) $char;
            } else {
                $sum += ord($char) - ord('A');
            }
        }

        $expectedControlChar = chr(($sum % 26) + ord('A'));

        return $expectedControlChar === $cf[15];
    }
}
