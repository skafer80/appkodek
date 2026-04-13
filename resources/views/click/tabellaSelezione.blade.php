<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabella Selezione</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        :root {
            --bg: #f4f7f9;
            --card: #ffffff;
            --line: #d9dee3;
            --text: #1f2933;
            --head: #eef2f6;
            --ok: #e7f6dd;
            --warn: #fff8c2;
            --bad: #ffd5d5;
            --copy: #174ea6;
            --copy-ok: #1f7a39;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: "Segoe UI", Tahoma, sans-serif;
            color: var(--text);
            background: linear-gradient(180deg, #f5f8fa 0%, #edf3f8 100%);
        }

        .wrapper {
            max-width: 1600px;
            margin: 24px auto;
            padding: 0 16px;
        }

        .card {
            background: var(--card);
            border: 1px solid var(--line);
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.08);
            overflow: hidden;
        }

        .card-header {
            padding: 16px 20px;
            border-bottom: 1px solid var(--line);
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
        }

        .card-header h1 {
            margin: 0;
            font-size: 20px;
            font-weight: 700;
        }

        .hint {
            margin: 0;
            font-size: 13px;
            color: #52606d;
        }

        .table-wrap {
            width: 100%;
            overflow: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 1500px;
        }

        th,
        td {
            border: 1px solid #1f2933;
            padding: 8px 10px;
            font-size: 13px;
            text-align: center;
            vertical-align: middle;
        }

        th {
            background: var(--head);
            font-weight: 700;
            position: sticky;
            top: 0;
            z-index: 1;
        }

        .cf-cell {
            white-space: nowrap;
        }

        .copy-cell {
            white-space: nowrap;
        }

        .cell-copied {
            background: #d8f3dc;
        }

        .copy-btn {
            border: 0;
            background: transparent;
            color: var(--copy);
            margin-left: 6px;
            cursor: pointer;
            padding: 2px 4px;
            border-radius: 4px;
        }

        .copy-btn:hover {
            background: rgba(23, 78, 166, 0.1);
        }

        .copy-btn.copied {
            color: var(--copy-ok);
        }

        .toolbar {
            padding: 12px 20px;
            border-top: 1px solid var(--line);
            background: #fafbfd;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
            font-size: 13px;
        }

        .toolbar a {
            text-decoration: none;
            color: #174ea6;
            font-weight: 600;
        }
    </style>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body>
    <div class="wrapper" x-data="tabellaSelezione()">
        <div class="card">
            <div class="card-header">
                <div>
                    <h1>Tabella destinatari selezione</h1>
                    <p class="hint">Clicca l'icona accanto al valore per copiarlo negli appunti (dove disponibile).</p>
                </div>
                <div>
                    <strong x-text="rows.length"></strong> record
                </div>
            </div>

            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Data selezione</th>
                            <th>NOME</th>
                            <th>COGNOME</th>
                            <th>SESSO</th>
                            <th>Categoria protetta/Disabilita</th>
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
                        <template x-for="(row, index) in rows" :key="index">
                            <tr>
                                <td class="copy-cell" :class="{ 'cell-copied': isCopied(index, 'data_selezione') }">
                                    <span x-text="row.data_selezione"></span>
                                    <button type="button" class="copy-btn" :class="{ copied: copiedKey === `${index}-data_selezione` }"
                                        @click="copyValue('data_selezione', row.data_selezione, index)" title="Copia valore" aria-label="Copia valore">
                                        <i class="fa" :class="copiedKey === `${index}-data_selezione` ? 'fa-check' : 'fa-copy'"></i>
                                    </button>
                                </td>
                                <td class="copy-cell" :class="{ 'cell-copied': isCopied(index, 'nome') }">
                                    <span x-text="row.nome"></span>
                                    <button type="button" class="copy-btn" :class="{ copied: copiedKey === `${index}-nome` }"
                                        @click="copyValue('nome', row.nome, index)" title="Copia valore" aria-label="Copia valore">
                                        <i class="fa" :class="copiedKey === `${index}-nome` ? 'fa-check' : 'fa-copy'"></i>
                                    </button>
                                </td>
                                <td class="copy-cell" :class="{ 'cell-copied': isCopied(index, 'cognome') }">
                                    <span x-text="row.cognome"></span>
                                    <button type="button" class="copy-btn" :class="{ copied: copiedKey === `${index}-cognome` }"
                                        @click="copyValue('cognome', row.cognome, index)" title="Copia valore" aria-label="Copia valore">
                                        <i class="fa" :class="copiedKey === `${index}-cognome` ? 'fa-check' : 'fa-copy'"></i>
                                    </button>
                                </td>
                                <td x-text="row.sesso"></td>
                                <td class="copy-cell" :class="{ 'cell-copied': isCopied(index, 'disabilita') }">
                                    <span x-text="row.disabilita"></span>
                                    <button type="button" class="copy-btn" :class="{ copied: copiedKey === `${index}-disabilita` }"
                                        @click="copyValue('disabilita', row.disabilita, index)" title="Copia valore" aria-label="Copia valore">
                                        <i class="fa" :class="copiedKey === `${index}-disabilita` ? 'fa-check' : 'fa-copy'"></i>
                                    </button>
                                </td>
                                <td class="copy-cell" :class="{ 'cell-copied': isCopied(index, 'data_nascita') }">
                                    <span x-text="row.data_nascita"></span>
                                    <button type="button" class="copy-btn" :class="{ copied: copiedKey === `${index}-data_nascita` }"
                                        @click="copyValue('data_nascita', row.data_nascita, index)" title="Copia valore" aria-label="Copia valore">
                                        <i class="fa" :class="copiedKey === `${index}-data_nascita` ? 'fa-check' : 'fa-copy'"></i>
                                    </button>
                                </td>
                                <td x-text="row.prov_nascita"></td>
                                <td x-text="row.comune_nascita"></td>
                                <td class="cf-cell copy-cell" :class="{ 'cell-copied': isCopied(index, 'codice_fiscale') }">
                                    <span x-text="row.codice_fiscale"></span>
                                    <button type="button" class="copy-btn" :class="{ copied: copiedKey === `${index}-codice_fiscale` }"
                                        @click="copyValue('codice_fiscale', row.codice_fiscale, index)" title="Copia valore" aria-label="Copia valore">
                                        <i class="fa" :class="copiedKey === `${index}-codice_fiscale` ? 'fa-check' : 'fa-copy'"></i>
                                    </button>
                                </td>
                                <td class="copy-cell" :class="{ 'cell-copied': isCopied(index, 'cittadinanza') }">
                                    <span x-text="row.cittadinanza"></span>
                                    <button type="button" class="copy-btn" :class="{ copied: copiedKey === `${index}-cittadinanza` }"
                                        @click="copyValue('cittadinanza', row.cittadinanza, index)" title="Copia valore" aria-label="Copia valore">
                                        <i class="fa" :class="copiedKey === `${index}-cittadinanza` ? 'fa-check' : 'fa-copy'"></i>
                                    </button>
                                </td>
                                <td x-text="row.prov_residenza"></td>
                                <td x-text="row.comune_residenza"></td>
                                <td x-text="row.titolo_studio"></td>
                                <td x-text="row.stato_soggetto"></td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>

            <div class="toolbar">
                <span x-text="message"></span>
                <a href="{{ route('click.index') }}">Torna a elenco giocate</a>
            </div>
        </div>
    </div>

    <script>
        function tabellaSelezione() {
            return {
                copiedKey: null,
                copiedCells: {},
                message: 'Nessun valore copiato.',
                rows: [
                    {
                        data_selezione: '04/09/2025',
                        cognome: 'Rossi',
                        nome: 'Marco',
                        sesso: 'M',
                        disabilita: 'NO',
                        data_nascita: '15/01/1985',
                        prov_nascita: 'PA',
                        comune_nascita: 'PALERMO',
                        codice_fiscale: 'RSSMRC85A15F205X',
                        cittadinanza: 'ITALIANA',
                        prov_residenza: 'PA',
                        comune_residenza: 'Palermo',
                        titolo_studio: 'LICENZA MEDIA',
                        stato_soggetto: 'DISOCCUPATO',
                        rowClass: 'row-ok'
                    },
                    {
                        data_selezione: '04/09/2025',
                        cognome: 'Bianchi',
                        nome: 'Luca',
                        sesso: 'M',
                        disabilita: 'NO',
                        data_nascita: '22/03/1990',
                        prov_nascita: 'PA',
                        comune_nascita: 'PALERMO',
                        codice_fiscale: 'BNCLCU90C22H501Y',
                        cittadinanza: 'ITALIANA',
                        prov_residenza: 'PA',
                        comune_residenza: 'Palermo',
                        titolo_studio: 'LICENZA MEDIA',
                        stato_soggetto: 'DISOCCUPATO',
                        rowClass: 'row-ok'
                    },
                    {
                        data_selezione: '04/09/2025',
                        cognome: 'Esposito',
                        nome: 'Giulia',
                        sesso: 'F',
                        disabilita: 'NO',
                        data_nascita: '10/04/1988',
                        prov_nascita: 'PA',
                        comune_nascita: 'PALERMO',
                        codice_fiscale: 'SPTGLI88D10F839Z',
                        cittadinanza: 'ITALIANA',
                        prov_residenza: 'PA',
                        comune_residenza: 'Palermo',
                        titolo_studio: 'LICENZA MEDIA',
                        stato_soggetto: 'DISOCCUPATO',
                        rowClass: 'row-ok'
                    },
                    {
                        data_selezione: '04/09/2025',
                        cognome: 'Romano',
                        nome: 'Francesca',
                        sesso: 'F',
                        disabilita: 'NO',
                        data_nascita: '05/05/1992',
                        prov_nascita: 'EE',
                        comune_nascita: "COSTA D'AVORIO",
                        codice_fiscale: 'RMNFNC92E45L219W',
                        cittadinanza: 'ESTERO',
                        prov_residenza: 'PA',
                        comune_residenza: 'Palermo',
                        titolo_studio: 'LICENZA MEDIA',
                        stato_soggetto: 'DISOCCUPATO',
                        rowClass: 'row-bad'
                    },
                    {
                        data_selezione: '04/09/2025',
                        cognome: 'Ricci',
                        nome: 'Andrea',
                        sesso: 'M',
                        disabilita: 'NO',
                        data_nascita: '12/06/1987',
                        prov_nascita: 'PA',
                        comune_nascita: 'PALERMO',
                        codice_fiscale: 'RCCNDR87H12F205V',
                        cittadinanza: 'ITALIANA',
                        prov_residenza: 'PA',
                        comune_residenza: 'Palermo',
                        titolo_studio: 'LICENZA MEDIA',
                        stato_soggetto: 'INOCCUPATO',
                        rowClass: 'row-ok'
                    },
                    {
                        data_selezione: '04/09/2025',
                        cognome: 'Marino',
                        nome: 'Sara',
                        sesso: 'F',
                        disabilita: 'NO',
                        data_nascita: '30/07/1995',
                        prov_nascita: 'PA',
                        comune_nascita: 'PALERMO',
                        codice_fiscale: 'MRNSRA95L30G273U',
                        cittadinanza: 'ITALIANA',
                        prov_residenza: 'PA',
                        comune_residenza: 'Palermo',
                        titolo_studio: 'DIPLOMA',
                        stato_soggetto: 'DISOCCUPATO',
                        rowClass: 'row-warn'
                    },
                    {
                        data_selezione: '04/09/2025',
                        cognome: 'Greco',
                        nome: 'Davide',
                        sesso: 'M',
                        disabilita: 'NO',
                        data_nascita: '18/09/1989',
                        prov_nascita: 'PA',
                        comune_nascita: 'PALERMO',
                        codice_fiscale: 'GRCDVD89P18H501T',
                        cittadinanza: 'ITALIANA',
                        prov_residenza: 'PA',
                        comune_residenza: 'Palermo',
                        titolo_studio: 'LICENZA MEDIA',
                        stato_soggetto: 'DISOCCUPATO',
                        rowClass: 'row-warn'
                    },
                    {
                        data_selezione: '04/09/2025',
                        cognome: 'Conti',
                        nome: 'Elena',
                        sesso: 'F',
                        disabilita: 'NO',
                        data_nascita: '15/10/1991',
                        prov_nascita: 'PA',
                        comune_nascita: 'PALERMO',
                        codice_fiscale: 'CNTLNE91R55F839S',
                        cittadinanza: 'ITALIANA',
                        prov_residenza: 'PA',
                        comune_residenza: 'Palermo',
                        titolo_studio: 'LICENZA MEDIA',
                        stato_soggetto: 'DISOCCUPATO',
                        rowClass: 'row-warn'
                    },
                    {
                        data_selezione: '04/09/2025',
                        cognome: 'Gallo',
                        nome: 'Matteo',
                        sesso: 'M',
                        disabilita: 'NO',
                        data_nascita: '20/12/1986',
                        prov_nascita: 'EE',
                        comune_nascita: 'MAROCCO',
                        codice_fiscale: 'GLLMTT86T20L219R',
                        cittadinanza: 'ESTERO',
                        prov_residenza: 'PA',
                        comune_residenza: 'Palermo',
                        titolo_studio: 'LICENZA MEDIA',
                        stato_soggetto: 'INOCCUPATO',
                        rowClass: 'row-bad'
                    },
                    {
                        data_selezione: '04/09/2025',
                        cognome: 'Costa',
                        nome: 'Valentina',
                        sesso: 'F',
                        disabilita: 'NO',
                        data_nascita: '05/01/1994',
                        prov_nascita: 'PA',
                        comune_nascita: 'PALERMO',
                        codice_fiscale: 'CSTVNT94A05F205Q',
                        cittadinanza: 'ITALIANA',
                        prov_residenza: 'PA',
                        comune_residenza: 'Carini',
                        titolo_studio: 'DIPLOMA',
                        stato_soggetto: 'DISOCCUPATO',
                        rowClass: 'row-warn'
                    },
                    {
                        data_selezione: '04/09/2025',
                        cognome: 'Fontana',
                        nome: 'Simone',
                        sesso: 'M',
                        disabilita: 'NO',
                        data_nascita: '14/02/1988',
                        prov_nascita: 'PA',
                        comune_nascita: 'PALERMO',
                        codice_fiscale: 'FNTSMN88B14G273P',
                        cittadinanza: 'ITALIANA',
                        prov_residenza: 'PA',
                        comune_residenza: 'Palermo',
                        titolo_studio: 'LICENZA MEDIA',
                        stato_soggetto: 'INOCCUPATO',
                        rowClass: 'row-warn'
                    },
                    {
                        data_selezione: '04/09/2025',
                        cognome: 'Moretti',
                        nome: 'Chiara',
                        sesso: 'F',
                        disabilita: 'NO',
                        data_nascita: '20/08/1993',
                        prov_nascita: 'PA',
                        comune_nascita: 'PALERMO',
                        codice_fiscale: 'MRTCHR93M60H501N',
                        cittadinanza: 'ITALIANA',
                        prov_residenza: 'PA',
                        comune_residenza: 'Palermo',
                        titolo_studio: 'LICENZA MEDIA',
                        stato_soggetto: 'DISOCCUPATO',
                        rowClass: 'row-warn'
                    },
                    {
                        data_selezione: '04/09/2025',
                        cognome: 'Barbieri',
                        nome: 'Paolo',
                        sesso: 'M',
                        disabilita: 'NO',
                        data_nascita: '25/04/1990',
                        prov_nascita: 'PA',
                        comune_nascita: 'PALERMO',
                        codice_fiscale: 'BRBPLA90D25F839M',
                        cittadinanza: 'ITALIANA',
                        prov_residenza: 'PA',
                        comune_residenza: 'Palermo',
                        titolo_studio: 'DIPLOMA',
                        stato_soggetto: 'INOCCUPATO',
                        rowClass: 'row-warn'
                    },
                    {
                        data_selezione: '04/09/2025',
                        cognome: 'Lombardi',
                        nome: 'Laura',
                        sesso: 'F',
                        disabilita: 'NO',
                        data_nascita: '11/05/1987',
                        prov_nascita: 'PA',
                        comune_nascita: 'PALERMO',
                        codice_fiscale: 'LMBLRA87E11L219L',
                        cittadinanza: 'ITALIANA',
                        prov_residenza: 'PA',
                        comune_residenza: 'Palermo',
                        titolo_studio: 'LICENZA MEDIA',
                        stato_soggetto: 'DISOCCUPATO',
                        rowClass: 'row-warn'
                    },
                    {
                        data_selezione: '04/09/2025',
                        cognome: 'Ferrari',
                        nome: 'Alessio',
                        sesso: 'M',
                        disabilita: 'NO',
                        data_nascita: '09/11/1996',
                        prov_nascita: 'PA',
                        comune_nascita: 'CARINI',
                        codice_fiscale: 'FRRLSO96S09F205K',
                        cittadinanza: 'ITALIANA',
                        prov_residenza: 'PA',
                        comune_residenza: 'Palermo',
                        titolo_studio: 'LICENZA MEDIA',
                        stato_soggetto: 'DISOCCUPATO',
                        rowClass: 'row-warn'
                    }
                ],
                async copyValue(field, value, index) {
                    const copyText = (value ?? '').toString();
                    const key = `${index}-${field}`;
                    try {
                        await navigator.clipboard.writeText(copyText);
                        this.copiedKey = key;
                        this.copiedCells[key] = true;
                        this.message = 'Valore copiato: ' + copyText;
                        setTimeout(() => {
                            if (this.copiedKey === key) {
                                this.copiedKey = null;
                                this.message = 'Nessun valore copiato.';
                            }
                        }, 1400);
                    } catch (error) {
                        this.message = 'Copia non riuscita. Verifica i permessi del browser.';
                    }
                },
                isCopied(index, field) {
                    return Boolean(this.copiedCells[`${index}-${field}`]);
                }
            };
        }
    </script>
</body>

</html>
