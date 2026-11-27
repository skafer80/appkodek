<div>
    <div class="pg-card" style="margin-top: 12px;">
        <div class="pg-card-header">
            <div>
                <h1>Aziende per classe</h1>
                <p class="pg-hint">Aziende associate allo stage della classe selezionata.</p>
            </div>
            @if ($aziende)
                <div class="pg-selects">
                    <strong>{{ count($aziende) }} aziende</strong>
                    <button type="button" class="btn btn-outline-secondary btn-sm" onclick="pgResetCopied(this)">Reset copie</button>
                </div>
            @endif
        </div>

        @if (!$classeSelezionata)
            <div style="padding: 16px 20px;">Seleziona prima una classe.</div>
        @elseif ($aziende)
            <div class="pg-table-wrap">
                <table class="pg-table">
                    <thead><tr>
                        <th>N.</th><th>Denominazione</th><th>Codice fiscale</th><th>Partita IVA</th>
                        <th>Codice ATECO</th><th>Allievi</th><th>Tutor aziendali</th><th>Rischio</th>
                        <th>Indirizzo</th><th>N. civico</th><th>CAP</th><th>Comune</th><th>Provincia</th>
                    </tr></thead>
                    <tbody>
                        @foreach ($aziende as $azienda)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                @foreach (['denominazione', 'codiceFiscale', 'partitaIva', 'codiceAteco', 'numeroAllievi', 'nTutorAziendali', 'rischio', 'indirizzo', 'numeroCivico', 'cap', 'comune', 'provincia'] as $campo)
                                    <td class="pg-copy-cell">
                                        {{ $azienda->{$campo} ?? '-' }}
                                        <button type="button" class="pg-copy-btn" onclick="pgCopy(this, {{ json_encode($azienda->{$campo}) }})"><i class="fa fa-copy"></i></button>
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div style="padding: 16px 20px;">Nessuna azienda disponibile per la classe selezionata.</div>
        @endif
    </div>
</div>
