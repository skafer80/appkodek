<div>
<div class="pg-card" style="margin-top: 12px;">
    <div class="pg-card-header">
        <div>
            <h2 style="font-size: 1rem; margin: 0;">Fasce ore</h2>
            <p class="pg-hint" style="margin-top: 4px;">Somma totale ore (escluso modulo STAGE) divisa per 2.</p>
        </div>
    </div>

    @if (! $loaded)
        <div style="padding: 16px 20px; color: #888;">Nessun dato disponibile.</div>
    @else
        <div style="padding: 16px 20px;">
            <table class="table table-sm table-bordered" style="max-width: 400px;">
                <tbody>
                    <tr>
                        <th style="width: 140px; background: #f8f9fa;">Fascia A</th>
                        <td class="pg-copy-cell">
                            {{ $fasciaA }}
                            <button type="button" class="pg-copy-btn" onclick="pgCopy(this, {{ json_encode((string) $fasciaA) }})"><i class="fa fa-copy"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <th style="background: #f8f9fa;">Fascia B</th>
                        <td class="pg-copy-cell">
                            {{ $fasciaB }}
                            <button type="button" class="pg-copy-btn" onclick="pgCopy(this, {{ json_encode((string) $fasciaB) }})"><i class="fa fa-copy"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <th style="background: #f8f9fa;">Fascia C</th>
                        <td class="pg-copy-cell">
                            0
                            <button type="button" class="pg-copy-btn" onclick="pgCopy(this, 0)"><i class="fa fa-copy"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    @endif
</div>
</div>
