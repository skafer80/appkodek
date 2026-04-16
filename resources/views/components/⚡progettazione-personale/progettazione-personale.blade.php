<div>
    <div class="pg-card" style="margin-top: 12px;">
        <div class="pg-card-header">
            <div>
                <h1>Personale per ente</h1>
                <p class="pg-hint">Dati letti da utility/enti.json in base all'ente selezionato.</p>
            </div>
            @if ($personale)
                <div class="pg-selects">
                    <strong>{{ count($personale) }} persone</strong>
                </div>
            @endif
        </div>

        @if (!$enteSelezionato)
            <div style="padding: 16px 20px;">Seleziona prima un ente dal contenitore principale.</div>
        @elseif (!$personale)
            <div style="padding: 16px 20px;">Nessun personale disponibile per l'ente selezionato.</div>
        @else
            <div class="pg-table-wrap">
                <table class="pg-table" style="min-width: 1100px;">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Cognome</th>
                            <th>Codice fiscale</th>
                            <th>Telefono</th>
                            <th>Email</th>
                            <th>Data nascita</th>
                            <th>Ruolo</th>
                            <th>Esterno</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($personale as $persona)
                            <tr>
                                <td>{{ $persona->id ?? '-' }}</td>
                                <td class="pg-copy-cell">
                                    {{ $persona->nome ?? '-' }}
                                    <button type="button" class="pg-copy-btn" onclick="pgCopy(this, {{ json_encode($persona->nome ?? '') }})"><i class="fa fa-copy"></i></button>
                                </td>
                                <td class="pg-copy-cell">
                                    {{ $persona->cognome ?? '-' }}
                                    <button type="button" class="pg-copy-btn" onclick="pgCopy(this, {{ json_encode($persona->cognome ?? '') }})"><i class="fa fa-copy"></i></button>
                                </td>
                                <td class="pg-copy-cell">
                                    {{ $persona->codice_fiscale ?? '-' }}
                                    <button type="button" class="pg-copy-btn" onclick="pgCopy(this, {{ json_encode($persona->codice_fiscale ?? '') }})"><i class="fa fa-copy"></i></button>
                                </td>
                                <td class="pg-copy-cell">
                                    {{ $persona->telefono ?? '-' }}
                                    <button type="button" class="pg-copy-btn" onclick="pgCopy(this, {{ json_encode($persona->telefono ?? '') }})"><i class="fa fa-copy"></i></button>
                                </td>
                                <td class="pg-copy-cell">
                                    {{ $persona->email ?? '-' }}
                                    <button type="button" class="pg-copy-btn" onclick="pgCopy(this, {{ json_encode($persona->email ?? '') }})"><i class="fa fa-copy"></i></button>
                                </td>
                                <td class="pg-copy-cell">
                                    {{ $persona->data_nascita ?? '-' }}
                                    <button type="button" class="pg-copy-btn" onclick="pgCopy(this, {{ json_encode($persona->data_nascita ?? '') }})"><i class="fa fa-copy"></i></button>
                                </td>
                                <td class="pg-copy-cell">
                                    {{ $persona->ruolo ?? '-' }}
                                    <button type="button" class="pg-copy-btn" onclick="pgCopy(this, {{ json_encode($persona->ruolo ?? '') }})"><i class="fa fa-copy"></i></button>
                                </td>
                                <td>{{ $persona->esterno === 'Y' ? 'Sì' : 'No' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
