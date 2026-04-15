<div>
<div class="pg-card" style="margin-top: 12px;">
    <div class="pg-card-header">
        <div>
            <h2 style="font-size: 1rem; margin: 0;">Dettagli classe</h2>
        </div>
    </div>

    @if (! $loaded)
        <div style="padding: 16px 20px; color: #888;">Nessun dato disponibile.</div>
    @else
        <div style="padding: 16px 20px;">
            <table class="table table-sm table-bordered" style="max-width: 480px;">
                <tbody>
                    <tr>
                        <th style="width: 200px; background: #f8f9fa;">Data avvio</th>
                        <td class="pg-copy-cell">
                            {{ $dataAvvio }}
                            <button type="button" class="pg-copy-btn" onclick="pgCopy(this, {{ json_encode($dataAvvio) }})"><i class="fa fa-copy"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <th style="background: #f8f9fa;">Data fine</th>
                        <td class="pg-copy-cell">
                            {{ $dataFine }}
                            <button type="button" class="pg-copy-btn" onclick="pgCopy(this, {{ json_encode($dataFine) }})"><i class="fa fa-copy"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <th style="background: #f8f9fa;">Importo</th>
                        <td class="pg-copy-cell">
                            € {{ number_format((float) $importo, 2, ',', '.') }}
                            <button type="button" class="pg-copy-btn" onclick="pgCopy(this, {{ json_encode($importo) }})"><i class="fa fa-copy"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <th style="background: #f8f9fa;">Giorni previsti</th>
                        <td class="pg-copy-cell">
                            {{ $numeroGiorniPrevisti }}
                            <button type="button" class="pg-copy-btn" onclick="pgCopy(this, {{ json_encode((string) $numeroGiorniPrevisti) }})"><i class="fa fa-copy"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    @endif
</div>
</div>
