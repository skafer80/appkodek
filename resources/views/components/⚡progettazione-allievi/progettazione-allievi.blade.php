<div>
    <div class="pg-card" style="margin-top: 12px;">
        <div class="pg-card-header">
            <div>
                <h1>Allievi per classe</h1>
                <p class="pg-hint">Componente figlio: mostra gli allievi della classe selezionata nel contenitore padre.</p>
            </div>
            @if ($studenti)
                <div class="pg-selects">
                    <strong>{{ count($studenti) }} allievi</strong>
                    <button type="button" class="btn btn-outline-secondary btn-sm" onclick="pgResetCopied(this)">Reset copie</button>
                </div>
            @endif
        </div>

        @if (!$classeSelezionata)
            <div style="padding: 16px 20px;">Seleziona prima una classe dal contenitore principale.</div>
        @elseif ($studenti)
            <div class="pg-table-wrap">
                <table class="pg-table">
                    <thead>
                        <tr>
                            <th>Data selezione</th>
                            <th>Nome</th>
                            <th>Cognome</th>
                            <th>Sesso</th>
                            <th>Cat. protetta / Disabilità</th>
                            <th>Data di nascita</th>
                            <th>Prov. nascita</th>
                            <th>Comune nascita</th>
                            <th>Codice fiscale</th>
                            <th>Cittadinanza</th>
                            <th>Prov. residenza</th>
                            <th>Comune residenza</th>
                            <th>Titolo di studio</th>
                            <th>Stato soggetto</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($studenti as $studente)
                            <tr>
                                <td class="pg-copy-cell">
                                    {{ $studente->data_selezione }}
                                    <button type="button" class="pg-copy-btn" onclick="pgCopy(this, {{ json_encode($studente->data_selezione) }})"><i class="fa fa-copy"></i></button>
                                </td>
                                <td class="pg-copy-cell">
                                    {{ $studente->nome }}
                                    <button type="button" class="pg-copy-btn" onclick="pgCopy(this, {{ json_encode($studente->nome) }})"><i class="fa fa-copy"></i></button>
                                </td>
                                <td class="pg-copy-cell">
                                    {{ $studente->cognome }}
                                    <button type="button" class="pg-copy-btn" onclick="pgCopy(this, {{ json_encode($studente->cognome) }})"><i class="fa fa-copy"></i></button>
                                </td>
                                <td>{{ $studente->sesso }}</td>
                                <td class="pg-copy-cell">
                                    {{ $studente->categoria_protetta_disabilita }}
                                    <button type="button" class="pg-copy-btn" onclick="pgCopy(this, {{ json_encode($studente->categoria_protetta_disabilita) }})"><i class="fa fa-copy"></i></button>
                                </td>
                                <td class="pg-copy-cell">
                                    {{ $studente->data_di_nascita }}
                                    <button type="button" class="pg-copy-btn" onclick="pgCopy(this, {{ json_encode($studente->data_di_nascita) }})"><i class="fa fa-copy"></i></button>
                                </td>
                                <td>{{ $studente->prov_nascita }}</td>
                                <td>{{ $studente->comune_di_nascita }}</td>
                                <td class="pg-copy-cell">
                                    {{ $studente->codice_fiscale }}
                                    <button type="button" class="pg-copy-btn" onclick="pgCopy(this, {{ json_encode($studente->codice_fiscale) }})"><i class="fa fa-copy"></i></button>
                                </td>
                                <td class="pg-copy-cell">
                                    {{ $studente->cittadinanza }}
                                    <button type="button" class="pg-copy-btn" onclick="pgCopy(this, {{ json_encode($studente->cittadinanza) }})"><i class="fa fa-copy"></i></button>
                                </td>
                                <td>{{ $studente->prov_residenza }}</td>
                                <td>{{ $studente->comune_di_residenza }}</td>
                                <td>{{ $studente->titolo_di_studio }}</td>
                                <td>{{ $studente->stato_soggetto }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div style="padding: 16px 20px;">Nessun allievo disponibile per la classe selezionata.</div>
        @endif
    </div>
</div>
