<div>
    <div class="pg-card" style="margin-top: 12px;">
        <div class="pg-card-header">
            <div>
                <h1>Moduli per classe</h1>
                <p class="pg-hint">Visualizza i moduli e il dettaglio delle conoscenze con ore aula e FAD.</p>
            </div>
            @if ($moduli)
                @php
                    $totaleConoscenze = collect($moduli)->sum(fn ($modulo) => count($modulo->conoscenze ?? []));
                @endphp
                <div class="pg-selects">
                    <strong>{{ count($moduli) }} moduli</strong>
                    <strong>{{ $totaleConoscenze }} conoscenze</strong>
                </div>
            @endif
        </div>

        @if (!$classeSelezionata)
            <div style="padding: 16px 20px;">Seleziona prima una classe dal contenitore principale.</div>
        @elseif (!$moduli)
            <div style="padding: 16px 20px;">Nessun modulo disponibile per la classe selezionata.</div>
        @else
            <div style="padding: 12px 12px 16px; display: grid; gap: 12px;">
                @foreach ($moduli as $modulo)
                    @php
                        $totOre = collect($modulo->conoscenze)->sum(fn ($conoscenza) => (int) ($conoscenza->oreConoscenza ?? 0));
                        $totOreFad = collect($modulo->conoscenze)->sum(fn ($conoscenza) => (int) ($conoscenza->oreFadConoscenza ?? 0));
                    @endphp

                    <div class="pg-card" style="border-radius: 10px; box-shadow: none;">
                        <div class="pg-card-header" style="padding: 10px 14px;">
                            <div>
                                <strong>{{ $modulo->nomeModuli ?: 'Modulo senza nome' }}</strong>
                            </div>
                            <div class="pg-selects" style="gap: 8px;">
                                <span class="badge text-bg-light">{{ count($modulo->conoscenze) }} conoscenze</span>
                                <span class="badge text-bg-light">Ore: {{ $totOre }}</span>
                                <span class="badge text-bg-light">Ore FAD: {{ $totOreFad }}</span>
                            </div>
                        </div>

                        <div class="pg-table-wrap">
                            <table class="pg-table" style="min-width: 860px;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Conoscenza</th>
                                        <th>Ore</th>
                                        <th>Ore FAD</th>
                                        <th>Totale</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($modulo->conoscenze as $index => $conoscenza)

                                    @if($conoscenza->nomeConoscenza === 'STAGE')
                                        @continue
                                    @endif
                                        @php
                                            $oreAula = (int) ($conoscenza->oreConoscenza ?? 0);
                                            $oreFad  = (int) ($conoscenza->oreFadConoscenza ?? 0);
                                        @endphp
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td class="pg-copy-cell" style="text-align: left;">
                                                {{ $conoscenza->nomeConoscenza }}
                                                <button type="button" class="pg-copy-btn" onclick="pgCopy(this, {{ json_encode($conoscenza->nomeConoscenza) }})"><i class="fa fa-copy"></i></button>
                                            </td>
                                            <td class="pg-copy-cell">
                                                {{ $oreAula }}
                                                <button type="button" class="pg-copy-btn" onclick="pgCopy(this, {{ json_encode((string) $oreAula) }})"><i class="fa fa-copy"></i></button>
                                            </td>
                                            <td class="pg-copy-cell">
                                                {{ $oreFad }}
                                                <button type="button" class="pg-copy-btn" onclick="pgCopy(this, {{ json_encode((string) $oreFad) }})"><i class="fa fa-copy"></i></button>
                                            </td>
                                            <td class="pg-copy-cell">
                                                {{ $oreAula + $oreFad }}
                                                <button type="button" class="pg-copy-btn" onclick="pgCopy(this, {{ json_encode((string) ($oreAula + $oreFad)) }})"><i class="fa fa-copy"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
