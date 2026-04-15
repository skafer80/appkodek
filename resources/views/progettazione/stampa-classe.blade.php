<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stampa classe {{ $classeId }}</title>
    <style>
        @page {
            size: A4;
            margin: 12mm;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: "Segoe UI", Tahoma, sans-serif;
            color: #111827;
            background: #ffffff;
            font-size: 12px;
            line-height: 1.35;
        }

        .sheet {
            max-width: 1100px;
            margin: 0 auto;
        }

        .print-actions {
            display: flex;
            justify-content: flex-end;
            margin: 12px 0;
        }

        .btn {
            border: 1px solid #9ca3af;
            background: #f9fafb;
            color: #111827;
            border-radius: 8px;
            padding: 6px 10px;
            cursor: pointer;
            font-size: 12px;
        }

        .doc-header {
            border: 1px solid #d1d5db;
            border-radius: 10px;
            padding: 14px 16px;
            margin-bottom: 12px;
            display: grid;
            gap: 4px;
        }

        .doc-title {
            margin: 0;
            font-size: 18px;
            font-weight: 700;
        }

        .meta {
            margin: 0;
            color: #4b5563;
        }

        .section {
            border: 1px solid #d1d5db;
            border-radius: 10px;
            margin-bottom: 10px;
            overflow: hidden;
            page-break-inside: avoid;
        }

        .section-title {
            margin: 0;
            padding: 8px 12px;
            background: #f3f4f6;
            border-bottom: 1px solid #d1d5db;
            font-size: 13px;
            letter-spacing: .2px;
            text-transform: uppercase;
        }

        .section-body {
            padding: 10px 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #374151;
            padding: 5px 6px;
            text-align: left;
            vertical-align: top;
            word-break: break-word;
        }

        th {
            background: #f9fafb;
            font-weight: 700;
        }

        .compact td,
        .compact th {
            padding: 4px 5px;
            font-size: 11px;
        }

        .grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }

        .tag {
            display: inline-block;
            border: 1px solid #9ca3af;
            border-radius: 999px;
            padding: 2px 8px;
            font-size: 11px;
            color: #374151;
            margin-right: 6px;
        }

        .page-break {
            page-break-before: always;
        }

        @media print {
            .print-actions {
                display: none;
            }

            .section {
                break-inside: avoid;
            }
        }
    </style>
</head>
<body>
    <div class="sheet">
        <div class="print-actions">
            <button class="btn" onclick="window.print()">Stampa</button>
        </div>

        <header class="doc-header">
            <h1 class="doc-title">Scheda classe {{ $classeId }}</h1>
            <p class="meta"><strong>Ente:</strong> {{ $enteSelezionato ?: '-' }}</p>
            <p class="meta"><strong>Classe:</strong> {{ $classeMeta?->nome ?: '-' }}</p>
            <p class="meta"><strong>Sede:</strong> {{ $classeMeta?->sede ?: '-' }}</p>
            <p class="meta"><strong>Generato il:</strong> {{ $generatedAt->format('d/m/Y H:i') }}</p>
        </header>

        <section class="section">
            <h2 class="section-title">Dettagli</h2>
            <div class="section-body">
                @if ($datiClasse)
                    <table>
                        <tbody>
                            <tr>
                                <th style="width: 28%;">Data avvio</th>
                                <td>{{ $datiClasse->dataAvvio ?: '-' }}</td>
                            </tr>
                            <tr>
                                <th>Data fine</th>
                                <td>{{ $datiClasse->dataFine ?: '-' }}</td>
                            </tr>
                            <tr>
                                <th>Importo</th>
                                <td>€ {{ number_format((float) ($datiClasse->importo ?? 0), 2, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <th>Numero giorni previsti</th>
                                <td>{{ $datiClasse->numeroGiorniPrevisti ?? 0 }}</td>
                            </tr>
                        </tbody>
                    </table>
                @else
                    <p>Nessun dato dettaglio disponibile.</p>
                @endif
            </div>
        </section>

        <section class="section">
            <h2 class="section-title">Stage</h2>
            <div class="section-body">
                @if ($datiClasse)
                    @php
                        $sedeStage = trim(($datiClasse->indirizzo ?? '') . (($datiClasse->numeroCivico ?? '') ? ', ' . $datiClasse->numeroCivico : '') . (($datiClasse->comune ?? '') ? ' - ' . $datiClasse->comune . (($datiClasse->provincia ?? '') ? ' (' . $datiClasse->provincia . ')' : '') : ''));
                    @endphp
                    <table>
                        <tbody>
                            <tr>
                                <th style="width: 28%;">Denominazione stage</th>
                                <td>{{ $datiClasse->denominazioneStage ?: '-' }}</td>
                            </tr>
                            <tr>
                                <th>Partita IVA</th>
                                <td>{{ $datiClasse->piva ?: '-' }}</td>
                            </tr>
                            <tr>
                                <th>Numero allievi</th>
                                <td>{{ $datiClasse->numeroAllievi ?: '-' }}</td>
                            </tr>
                            <tr>
                                <th>Data avvio stage</th>
                                <td>{{ $datiClasse->dataAvvioStage ?: '-' }}</td>
                            </tr>
                            <tr>
                                <th>Data fine stage</th>
                                <td>{{ $datiClasse->dataFineStage ?: '-' }}</td>
                            </tr>
                            <tr>
                                <th>Numero giorni stage</th>
                                <td>{{ $datiClasse->numeroGiorniStage ?? 0 }}</td>
                            </tr>
                            <tr>
                                <th>Sede stage</th>
                                <td>{{ $sedeStage ?: '-' }}</td>
                            </tr>
                        </tbody>
                    </table>
                @else
                    <p>Nessun dato stage disponibile.</p>
                @endif
            </div>
        </section>

        <section class="section page-break">
            <h2 class="section-title">Allievi</h2>
            <div class="section-body">
                <span class="tag">Totale allievi: {{ count($studenti) }}</span>
                @if (count($studenti) > 0)
                    <div style="margin-top: 8px; overflow: hidden;">
                        <table class="compact">
                            <thead>
                                <tr>
                                    <th>Data selezione</th>
                                    <th>Nome</th>
                                    <th>Cognome</th>
                                    <th>Sesso</th>
                                    <th>Cat. protetta / Disabilita</th>
                                    <th>Data nascita</th>
                                    <th>Prov. nascita</th>
                                    <th>Comune nascita</th>
                                    <th>Codice fiscale</th>
                                    <th>Cittadinanza</th>
                                    <th>Prov. residenza</th>
                                    <th>Comune residenza</th>
                                    <th>Titolo studio</th>
                                    <th>Stato soggetto</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($studenti as $studente)
                                    <tr>
                                        <td>{{ $studente->data_selezione ?? '-' }}</td>
                                        <td>{{ $studente->nome ?? '-' }}</td>
                                        <td>{{ $studente->cognome ?? '-' }}</td>
                                        <td>{{ $studente->sesso ?? '-' }}</td>
                                        <td>{{ $studente->categoria_protetta_disabilita ?? '-' }}</td>
                                        <td>{{ $studente->data_di_nascita ?? '-' }}</td>
                                        <td>{{ $studente->prov_nascita ?? '-' }}</td>
                                        <td>{{ $studente->comune_di_nascita ?? '-' }}</td>
                                        <td>{{ $studente->codice_fiscale ?? '-' }}</td>
                                        <td>{{ $studente->cittadinanza ?? '-' }}</td>
                                        <td>{{ $studente->prov_residenza ?? '-' }}</td>
                                        <td>{{ $studente->comune_di_residenza ?? '-' }}</td>
                                        <td>{{ $studente->titolo_di_studio ?? '-' }}</td>
                                        <td>{{ $studente->stato_soggetto ?? '-' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p style="margin-top: 8px;">Nessun allievo disponibile.</p>
                @endif
            </div>
        </section>

        <section class="section">
            <h2 class="section-title">Moduli</h2>
            <div class="section-body">
                <span class="tag">Totale moduli: {{ count($moduli) }}</span>
                @php
                    $totaleConoscenze = collect($moduli)->sum(fn ($modulo) => count($modulo->conoscenze ?? []));
                @endphp
                <span class="tag">Totale conoscenze: {{ $totaleConoscenze }}</span>

                @if (count($moduli) > 0)
                    <div style="margin-top: 10px; display: grid; gap: 8px;">
                        @foreach ($moduli as $modulo)
                            @php
                                $totOre = collect($modulo->conoscenze ?? [])->sum(fn ($conoscenza) => (int) ($conoscenza->oreConoscenza ?? 0));
                                $totOreFad = collect($modulo->conoscenze ?? [])->sum(fn ($conoscenza) => (int) ($conoscenza->oreFadConoscenza ?? 0));
                            @endphp
                            <div style="border: 1px solid #d1d5db; border-radius: 8px; overflow: hidden;">
                                <div style="padding: 6px 8px; background: #f9fafb; border-bottom: 1px solid #d1d5db;">
                                    <strong>{{ $modulo->nomeModuli ?: 'Modulo senza nome' }}</strong>
                                    <span style="margin-left: 10px; color: #374151;">Conoscenze: {{ count($modulo->conoscenze ?? []) }}</span>
                                    <span style="margin-left: 10px; color: #374151;">Ore: {{ $totOre }}</span>
                                    <span style="margin-left: 10px; color: #374151;">Ore FAD: {{ $totOreFad }}</span>
                                </div>
                                <div style="padding: 8px;">
                                    <table class="compact">
                                        <thead>
                                            <tr>
                                                <th style="width: 40px;">#</th>
                                                <th>Conoscenza</th>
                                                <th style="width: 70px;">Ore</th>
                                                <th style="width: 80px;">Ore FAD</th>
                                                <th style="width: 70px;">Totale</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($modulo->conoscenze ?? [] as $index => $conoscenza)
                                                @php
                                                    $oreAula = (int) ($conoscenza->oreConoscenza ?? 0);
                                                    $oreFad = (int) ($conoscenza->oreFadConoscenza ?? 0);
                                                @endphp
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $conoscenza->nomeConoscenza ?? '-' }}</td>
                                                    <td>{{ $oreAula }}</td>
                                                    <td>{{ $oreFad }}</td>
                                                    <td>{{ $oreAula + $oreFad }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5">Nessuna conoscenza disponibile.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p style="margin-top: 8px;">Nessun modulo disponibile.</p>
                @endif
            </div>
        </section>

        <section class="section">
            <h2 class="section-title">Personale</h2>
            <div class="section-body">
                <span class="tag">Totale personale: {{ count($personale) }}</span>
                <span class="tag">Ente: {{ $enteSelezionato ?: '-' }}</span>

                @if (count($personale) > 0)
                    <div style="margin-top: 8px; overflow: hidden;">
                        <table class="compact">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>Cognome</th>
                                    <th>Codice fiscale</th>
                                    <th>Telefono</th>
                                    <th>Email</th>
                                    <th>Data nascita</th>
                                    <th>Titolo</th>
                                    <th>Ruolo</th>
                                    <th>Esterno</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($personale as $persona)
                                    <tr>
                                        <td>{{ $persona->id ?? '-' }}</td>
                                        <td>{{ $persona->nome ?? '-' }}</td>
                                        <td>{{ $persona->cognome ?? '-' }}</td>
                                        <td>{{ $persona->codice_fiscale ?? '-' }}</td>
                                        <td>{{ $persona->telefono ?? '-' }}</td>
                                        <td>{{ $persona->email ?? '-' }}</td>
                                        <td>{{ $persona->data_nascita ?? '-' }}</td>
                                        <td>{{ $persona->titolo ?? '-' }}</td>
                                        <td>{{ $persona->ruolo ?? '-' }}</td>
                                        <td>{{ $persona->esterno ?? '-' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p style="margin-top: 8px;">Nessun personale disponibile per l'ente associato alla classe.</p>
                @endif
            </div>
        </section>
    </div>
</body>
</html>
