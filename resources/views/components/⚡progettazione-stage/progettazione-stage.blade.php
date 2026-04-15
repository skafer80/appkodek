<div>
<div class="pg-card" style="margin-top: 12px;">
    <div class="pg-card-header">
        <div>
            <h2 style="font-size: 1rem; margin: 0;">Stage</h2>
        </div>
    </div>

    @if (! $loaded)
        <div style="padding: 16px 20px; color: #888;">Nessun dato disponibile.</div>
    @else
        <div style="padding: 16px 20px;">
            <table class="table table-sm table-bordered" style="max-width: 600px;">
                <tbody>
                    @php
                        $sedeTesto = trim($indirizzo . ($numeroCivico ? ', ' . $numeroCivico : '') . ($comune ? ' – ' . $comune . ($provincia ? ' (' . $provincia . ')' : '') : ''));
                    @endphp
                    <tr>
                        <th style="width: 220px; background: #f8f9fa;">Azienda</th>
                        <td class="pg-copy-cell">
                            {{ $denominazioneStage }}
                            <button type="button" class="pg-copy-btn" onclick="pgCopy(this, {{ json_encode($denominazioneStage) }})"><i class="fa fa-copy"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <th style="background: #f8f9fa;">Partita IVA</th>
                        <td class="pg-copy-cell">
                            {{ $piva }}
                            <button type="button" class="pg-copy-btn" onclick="pgCopy(this, {{ json_encode($piva) }})"><i class="fa fa-copy"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <th style="background: #f8f9fa;">Numero allievi</th>
                        <td class="pg-copy-cell">
                            {{ $numeroAllievi }}
                            <button type="button" class="pg-copy-btn" onclick="pgCopy(this, {{ json_encode($numeroAllievi) }})"><i class="fa fa-copy"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <th style="background: #f8f9fa;">Data avvio stage</th>
                        <td class="pg-copy-cell">
                            {{ $dataAvvioStage }}
                            <button type="button" class="pg-copy-btn" onclick="pgCopy(this, {{ json_encode($dataAvvioStage) }})"><i class="fa fa-copy"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <th style="background: #f8f9fa;">Data fine stage</th>
                        <td class="pg-copy-cell">
                            {{ $dataFineStage }}
                            <button type="button" class="pg-copy-btn" onclick="pgCopy(this, {{ json_encode($dataFineStage) }})"><i class="fa fa-copy"></i></button>
                        </td>

             </tr>
                    <tr>
                        <th style="background: #f8f9fa;">Giorni stage</th>
                        <td class="pg-copy-cell">
                            {{ $numeroGiorniStage }}
                            <button type="button" class="pg-copy-btn" onclick="pgCopy(this, {{ json_encode((string) $numeroGiorniStage) }})"><i class="fa fa-copy"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <th style="background: #f8f9fa;">Sede stage</th>
                        <td class="pg-copy-cell">
                            {{ $sedeTesto }}
                            <button type="button" class="pg-copy-btn" onclick="pgCopy(this, {{ json_encode($sedeTesto) }})"><i class="fa fa-copy"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    @endif
</div>
</div>
