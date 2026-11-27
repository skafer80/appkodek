<div>
    <style>
        .pg-student-list { display: grid; gap: 12px; padding: 16px 20px; }
        .pg-student-card { border: 1px solid #dfe3e8; border-radius: 8px; overflow: hidden; background: #fff; }
        .pg-student-summary { cursor: pointer; padding: 14px 16px; background: #f8f9fa; list-style: none; }
        .pg-student-summary::-webkit-details-marker { display: none; }
        .pg-student-summary-row { display: flex; align-items: center; justify-content: space-between; gap: 12px; flex-wrap: wrap; }
        .pg-student-summary-main { display: flex; align-items: center; gap: 10px; }
        .pg-student-number { display: inline-flex; align-items: center; justify-content: center; min-width: 30px; height: 30px; border-radius: 50%; background: #0d6efd; color: #fff; font-weight: 700; }
        .pg-student-meta { display: flex; gap: 16px; flex-wrap: wrap; color: #667085; font-size: .88rem; }
        .pg-student-chevron { transition: transform .2s ease; }
        .pg-student-card[open] .pg-student-chevron { transform: rotate(180deg); }
        .pg-student-body { padding: 16px; border-top: 1px solid #e5e7eb; }
        .pg-data-section + .pg-data-section { margin-top: 20px; }
        .pg-data-section h3 { margin: 0 0 10px; font-size: 1rem; }
        .pg-data-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(210px, 1fr)); gap: 8px; }
        .pg-data-item { position: relative; min-width: 0; padding: 9px 36px 9px 10px; border: 1px solid #eaecf0; border-radius: 6px; background: #fcfcfd; }
        .pg-data-label { display: block; margin-bottom: 3px; color: #667085; font-size: .75rem; font-weight: 600; text-transform: uppercase; }
        .pg-data-value { display: block; overflow-wrap: anywhere; }
        .pg-data-item .pg-copy-btn { position: absolute; top: 50%; right: 8px; transform: translateY(-50%); }
    </style>

    @php
        $campiAnagrafici = [
            'nome' => 'Nome', 'cognome' => 'Cognome', 'codice_fiscale' => 'Codice fiscale',
            'cf_provvisorio' => 'CF provvisorio', 'data_di_nascita' => 'Data di nascita',
            'prov_nascita' => 'Provincia di nascita', 'comune_di_nascita' => 'Comune di nascita',
            'sesso' => 'Sesso', 'cittadinanza' => 'Cittadinanza', 'soggetto_disabile' => 'Disabile',
            'competenze_tecniche_corso' => 'Competenze tecniche corso',
        ];
        $campiDocumento = [
            'doc_tipologia' => 'Tipo documento', 'doc_numero' => 'Numero documento',
            'doc_rilasciato_da' => 'Documento rilasciato da', 'doc_data_rilascio' => 'Data rilascio',
            'doc_scadenza' => 'Scadenza documento',
        ];
        $campiPercorso = [
            'allievo_continuita' => 'Continuità', 'allievo_apprendista' => 'Apprendista',
            'annualita_provenienza' => 'Annualità provenienza',
            'provenienza_scuola_grado' => 'Grado provenienza', 'percorso_provenienza' => 'Percorso provenienza',
            'qualifica_terzi' => 'Qualifica terzi', 'qualifica_terzi_data' => 'Data qualifica',
            'provenienza_scuola_nome' => 'Scuola provenienza', 'subordine1' => 'Subordine 1',
            'subordine2' => 'Subordine 2',
        ];
        $campiGenitore = [
            'genitore_nome' => 'Nome', 'genitore_cognome' => 'Cognome', 'genitore_cf' => 'Codice fiscale',
            'genitore_nato_a' => 'Nato/a a', 'genitore_nato_il' => 'Nato/a il', 'genitore_sesso' => 'Sesso',
            'genitore_email' => 'Email', 'genitore_telefono' => 'Telefono',
            'genitore_indirizzo' => 'Indirizzo', 'genitore_numero_civico' => 'Numero civico',
            'genitore_cap' => 'CAP', 'genitore_comune' => 'Comune', 'genitore_provincia' => 'Provincia',
            'genitore_doc_tipologia' => 'Tipo documento', 'genitore_doc_numero' => 'Numero documento',
            'genitore_doc_rilasciato_da' => 'Documento rilasciato da',
            'genitore_doc_data_rilascio' => 'Data rilascio', 'genitore_doc_scadenza' => 'Scadenza documento',
        ];
    @endphp

    <div class="pg-card" style="margin-top: 12px;">
        <div class="pg-card-header">
            <div>
                <h1>Allievi per classe</h1>
                <p class="pg-hint">Apri una scheda per consultare e copiare i dati dell'allievo.</p>
            </div>
            @if ($studenti)
                <div class="pg-selects">
                    <strong>{{ count($studenti) }} allievi</strong>
                    <button type="button" class="btn btn-outline-secondary btn-sm" onclick="pgResetCopied(this)">Reset copie</button>
                </div>
            @endif
        </div>

        @if (!$classeSelezionata)
            <div style="padding: 16px 20px;">Seleziona prima una classe.</div>
        @elseif ($studenti)
            <div class="pg-student-list">
                @foreach ($studenti as $studente)
                    @php
                        $haGenitore = collect(array_keys($campiGenitore))
                            ->contains(fn ($campo) => filled($studente->{$campo}));
                    @endphp
                    <details class="pg-student-card" @if ($loop->first) open @endif>
                        <summary class="pg-student-summary">
                            <div class="pg-student-summary-row">
                                <div class="pg-student-summary-main">
                                    <span class="pg-student-number">{{ $loop->iteration }}</span>
                                    <strong>{{ $studente->cognome }} {{ $studente->nome }}</strong>
                                </div>
                                <div class="pg-student-meta">
                                    <span>CF: {{ $studente->codice_fiscale ?: '-' }}</span>
                                    <span>Nascita: {{ $studente->data_di_nascita ?: '-' }}</span>
                                    @if ($haGenitore)<span><i class="fa fa-user-group"></i> Genitore presente</span>@endif
                                    <i class="fa fa-chevron-down pg-student-chevron"></i>
                                </div>
                            </div>
                        </summary>

                        <div class="pg-student-body">
                            @foreach ([
                                ['Anagrafica', $campiAnagrafici],
                                ["Documento dell'allievo", $campiDocumento],
                                ['Percorso formativo', $campiPercorso],
                            ] as [$titolo, $campi])
                                <section class="pg-data-section">
                                    <h3>{{ $titolo }}</h3>
                                    <div class="pg-data-grid">
                                        @foreach ($campi as $campo => $etichetta)
                                            @php($valore = is_bool($studente->{$campo}) ? ($studente->{$campo} ? 'Sì' : 'No') : $studente->{$campo})
                                            <div class="pg-data-item">
                                                <span class="pg-data-label">{{ $etichetta }}</span>
                                                <span class="pg-data-value">{{ filled($valore) ? $valore : '-' }}</span>
                                                <button type="button" class="pg-copy-btn" onclick="pgCopy(this, {{ json_encode($valore) }})"><i class="fa fa-copy"></i></button>
                                            </div>
                                        @endforeach
                                    </div>
                                </section>
                            @endforeach

                            @if ($haGenitore)
                                <section class="pg-data-section">
                                    <h3>Genitore</h3>
                                    <div class="pg-data-grid">
                                        @foreach ($campiGenitore as $campo => $etichetta)
                                            @php($valore = $studente->{$campo})
                                            <div class="pg-data-item">
                                                <span class="pg-data-label">{{ $etichetta }}</span>
                                                <span class="pg-data-value">{{ filled($valore) ? $valore : '-' }}</span>
                                                <button type="button" class="pg-copy-btn" onclick="pgCopy(this, {{ json_encode($valore) }})"><i class="fa fa-copy"></i></button>
                                            </div>
                                        @endforeach
                                    </div>
                                </section>
                            @endif
                        </div>
                    </details>
                @endforeach
            </div>
        @else
            <div style="padding: 16px 20px;">Nessun allievo disponibile per la classe selezionata.</div>
        @endif
    </div>
</div>
