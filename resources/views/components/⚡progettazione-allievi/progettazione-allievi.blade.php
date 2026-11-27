<div>
    <div class="pg-card" style="margin-top: 12px;">
        <div class="pg-card-header">
            <div>
                <h1>Allievi per classe</h1>
                <p class="pg-hint">Dati anagrafici, percorso, documento e genitore degli allievi.</p>
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
            @foreach ($studenti as $studente)
                <div style="padding: 16px 20px; border-top: 1px solid #e5e7eb;">
                    <h2 style="font-size: 1rem; margin-bottom: 12px;">{{ $loop->iteration }}. {{ $studente->cognome }} {{ $studente->nome }}</h2>
                    <div class="pg-table-wrap">
                        <table class="pg-table">
                            <thead><tr>
                                <th>Nome</th><th>Cognome</th><th>Codice fiscale</th><th>CF provvisorio</th>
                                <th>Data nascita</th><th>Provincia nascita</th><th>Comune nascita</th><th>Sesso</th>
                                <th>Cittadinanza</th><th>Disabile</th><th>Competenze corso</th>
                            </tr></thead>
                            <tbody><tr>
                                @foreach (['nome', 'cognome', 'codice_fiscale', 'cf_provvisorio', 'data_di_nascita', 'prov_nascita', 'comune_di_nascita', 'sesso', 'cittadinanza', 'soggetto_disabile', 'competenze_tecniche_corso'] as $campo)
                                    @php($valore = is_bool($studente->{$campo}) ? ($studente->{$campo} ? 'Sì' : 'No') : $studente->{$campo})
                                    <td class="pg-copy-cell">{{ $valore ?? '-' }}<button type="button" class="pg-copy-btn" onclick="pgCopy(this, {{ json_encode($valore) }})"><i class="fa fa-copy"></i></button></td>
                                @endforeach
                            </tr></tbody>
                        </table>
                    </div>

                    <div class="pg-table-wrap" style="margin-top: 12px;">
                        <table class="pg-table">
                            <thead><tr>
                                <th>Tipo documento</th><th>Numero documento</th><th>Rilasciato da</th><th>Data rilascio</th><th>Scadenza</th>
                                <th>Continuità</th><th>Apprendista</th><th>Annualità</th><th>Grado provenienza</th>
                                <th>Percorso provenienza</th><th>N. percorso</th><th>Qualifica terzi</th><th>N. qualifica</th>
                                <th>Data qualifica</th><th>Scuola provenienza</th><th>Subordine 1</th><th>Subordine 2</th>
                            </tr></thead>
                            <tbody><tr>
                                @foreach (['doc_tipologia', 'doc_numero', 'doc_rilasciato_da', 'doc_data_rilascio', 'doc_scadenza', 'allievo_continuita', 'allievo_apprendista', 'annualita_provenienza', 'provenienza_scuola_grado', 'percorso_provenienza', 'percorso_provenienza_n', 'qualifica_terzi', 'qualifica_terzi_n', 'qualifica_terzi_data', 'provenienza_scuola_nome', 'subordine1', 'subordine2'] as $campo)
                                    @php($valore = is_bool($studente->{$campo}) ? ($studente->{$campo} ? 'Sì' : 'No') : $studente->{$campo})
                                    <td class="pg-copy-cell">{{ $valore ?? '-' }}<button type="button" class="pg-copy-btn" onclick="pgCopy(this, {{ json_encode($valore) }})"><i class="fa fa-copy"></i></button></td>
                                @endforeach
                            </tr></tbody>
                        </table>
                    </div>

                    <div class="pg-table-wrap" style="margin-top: 12px;">
                        <table class="pg-table">
                            <thead><tr>
                                <th>Genitore nome</th><th>Genitore cognome</th><th>Codice fiscale</th><th>Nato a</th><th>Nato il</th><th>Sesso</th>
                                <th>Email</th><th>Telefono</th><th>Indirizzo</th><th>N. civico</th><th>CAP</th><th>Comune</th><th>Provincia</th>
                                <th>Tipo documento</th><th>Numero documento</th><th>Rilasciato da</th><th>Data rilascio</th><th>Scadenza</th>
                            </tr></thead>
                            <tbody><tr>
                                @foreach (['genitore_nome', 'genitore_cognome', 'genitore_cf', 'genitore_nato_a', 'genitore_nato_il', 'genitore_sesso', 'genitore_email', 'genitore_telefono', 'genitore_indirizzo', 'genitore_numero_civico', 'genitore_cap', 'genitore_comune', 'genitore_provincia', 'genitore_doc_tipologia', 'genitore_doc_numero', 'genitore_doc_rilasciato_da', 'genitore_doc_data_rilascio', 'genitore_doc_scadenza'] as $campo)
                                    <td class="pg-copy-cell">{{ $studente->{$campo} ?? '-' }}<button type="button" class="pg-copy-btn" onclick="pgCopy(this, {{ json_encode($studente->{$campo}) }})"><i class="fa fa-copy"></i></button></td>
                                @endforeach
                            </tr></tbody>
                        </table>
                    </div>
                </div>
            @endforeach
        @else
            <div style="padding: 16px 20px;">Nessun allievo disponibile per la classe selezionata.</div>
        @endif
    </div>
</div>
