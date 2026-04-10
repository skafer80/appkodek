<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ElencoAllieviClasseController extends Controller
{
    public function execute(Request $request)
    {
        $classeId = $request->classeId;

        $allievi = json_decode(<<<'JSON'
[
    {
        "classeId": 1,
            "studente": [
                {
                    "data_selezione": "04/09/2025",
                    "nome": "ANDREA",
                    "cognome": "CARDINALE",
                    "sesso": "M",
                    "categoria_protetta_disabilita": "NO",
                    "data_di_nascita": "31/10/1965",
                    "prov_nascita": "PA",
                    "comune_di_nascita": "PALERMO",
                    "codice_fiscale": "CRDNDR65R31G273S",
                    "cittadinanza": "ITALIANA",
                    "prov_residenza": "PA",
                    "comune_di_residenza": "Palermo",
                    "titolo_di_studio": "LICENZA MEDIA",
                    "stato_soggetto": "DISOCCUPATO",
                    "ts_numerico": 2
                },
                {
                    "data_selezione": "04/09/2025",
                    "nome": "TIZIANA",
                    "cognome": "SAVASTA",
                    "sesso": "F",
                    "categoria_protetta_disabilita": "NO",
                    "data_di_nascita": "26/05/1981",
                    "prov_nascita": "PA",
                    "comune_di_nascita": "PALERMO",
                    "codice_fiscale": "SVSTZN81E66G273T",
                    "cittadinanza": "ITALIANA",
                    "prov_residenza": "PA",
                    "comune_di_residenza": "Palermo",
                    "titolo_di_studio": "LICENZA MEDIA",
                    "stato_soggetto": "DISOCCUPATO",
                    "ts_numerico": 2
                },
                {
                    "data_selezione": "04/09/2025",
                    "nome": "FRANCESCA",
                    "cognome": "ACQUAVIVA",
                    "sesso": "F",
                    "categoria_protetta_disabilita": "NO",
                    "data_di_nascita": "31/05/1968",
                    "prov_nascita": "PA",
                    "comune_di_nascita": "PALERMO",
                    "codice_fiscale": "CQVFNC68E71G273S",
                    "cittadinanza": "ITALIANA",
                    "prov_residenza": "PA",
                    "comune_di_residenza": "Palermo",
                    "titolo_di_studio": "LICENZA MEDIA",
                    "stato_soggetto": "DISOCCUPATO",
                    "ts_numerico": 2
                },
                {
                    "data_selezione": "04/09/2025",
                    "nome": "EBOU JULIANA",
                    "cognome": "DJEDJI",
                    "sesso": "F",
                    "categoria_protetta_disabilita": "NO",
                    "data_di_nascita": "12/11/2006",
                    "prov_nascita": "EE",
                    "comune_di_nascita": "COSTA DAVORIO",
                    "codice_fiscale": "DJDBLN06S52Z313G",
                    "cittadinanza": "ESTERO",
                    "prov_residenza": "PA",
                    "comune_di_residenza": "Palermo",
                    "titolo_di_studio": "LICENZA MEDIA",
                    "stato_soggetto": "DISOCCUPATO",
                    "ts_numerico": 2
                },
                {
                    "data_selezione": "04/09/2025",
                    "nome": "MARIANNA",
                    "cognome": "ROTOLO",
                    "sesso": "F",
                    "categoria_protetta_disabilita": "NO",
                    "data_di_nascita": "11/09/1969",
                    "prov_nascita": "PA",
                    "comune_di_nascita": "PALERMO",
                    "codice_fiscale": "RTLMNN69P51G273D",
                    "cittadinanza": "ITALIANA",
                    "prov_residenza": "PA",
                    "comune_di_residenza": "Palermo",
                    "titolo_di_studio": "LICENZA MEDIA",
                    "stato_soggetto": "INOCCUPATO",
                    "ts_numerico": 2
                },
                {
                    "data_selezione": "04/09/2025",
                    "nome": "ANTONINO",
                    "cognome": "DE SANTIS",
                    "sesso": "M",
                    "categoria_protetta_disabilita": "NO",
                    "data_di_nascita": "13/08/1970",
                    "prov_nascita": "PA",
                    "comune_di_nascita": "PALERMO",
                    "codice_fiscale": "DSNNNN70M13G273D",
                    "cittadinanza": "ITALIANA",
                    "prov_residenza": "PA",
                    "comune_di_residenza": "Palermo",
                    "titolo_di_studio": "DIPLOMA",
                    "stato_soggetto": "DISOCCUPATO",
                    "ts_numerico": 4
                },
                {
                    "data_selezione": "04/09/2025",
                    "nome": "SALVATORE",
                    "cognome": "LIGA",
                    "sesso": "M",
                    "categoria_protetta_disabilita": "NO",
                    "data_di_nascita": "09/09/1989",
                    "prov_nascita": "PA",
                    "comune_di_nascita": "PALERMO",
                    "codice_fiscale": "LGISVT89P09G273X",
                    "cittadinanza": "ITALIANA",
                    "prov_residenza": "PA",
                    "comune_di_residenza": "Palermo",
                    "titolo_di_studio": "LICENZA MEDIA",
                    "stato_soggetto": "DISOCCUPATO",
                    "ts_numerico": 2
                },
                {
                    "data_selezione": "04/09/2025",
                    "nome": "PROVVIDENZA",
                    "cognome": "NAPOLI",
                    "sesso": "F",
                    "categoria_protetta_disabilita": "NO",
                    "data_di_nascita": "07/01/1976",
                    "prov_nascita": "PA",
                    "comune_di_nascita": "PALERMO",
                    "codice_fiscale": "NPLPVV76A47G273Z",
                    "cittadinanza": "ITALIANA",
                    "prov_residenza": "PA",
                    "comune_di_residenza": "Palermo",
                    "titolo_di_studio": "LICENZA MEDIA",
                    "stato_soggetto": "DISOCCUPATO",
                    "ts_numerico": 2
                },
                {
                    "data_selezione": "04/09/2025",
                    "nome": "JAMAL",
                    "cognome": "SBATH",
                    "sesso": "M",
                    "categoria_protetta_disabilita": "NO",
                    "data_di_nascita": "08/06/1989",
                    "prov_nascita": "EE",
                    "comune_di_nascita": "MAROCCO",
                    "codice_fiscale": "SBHJML89H08Z330M",
                    "cittadinanza": "ESTERO",
                    "prov_residenza": "PA",
                    "comune_di_residenza": "Palermo",
                    "titolo_di_studio": "LICENZA MEDIA",
                    "stato_soggetto": "INOCCUPATO",
                    "ts_numerico": 2
                },
                {
                    "data_selezione": "04/09/2025",
                    "nome": "ROBERTA",
                    "cognome": "BULINO",
                    "sesso": "F",
                    "categoria_protetta_disabilita": "NO",
                    "data_di_nascita": "20/10/1976",
                    "prov_nascita": "PA",
                    "comune_di_nascita": "PALERMO",
                    "codice_fiscale": "BLNRRT76R60G273I",
                    "cittadinanza": "ITALIANA",
                    "prov_residenza": "PA",
                    "comune_di_residenza": "Carini",
                    "titolo_di_studio": "DIPLOMA",
                    "stato_soggetto": "DISOCCUPATO",
                    "ts_numerico": 4
                },
                {
                    "data_selezione": "04/09/2025",
                    "nome": "ENZA",
                    "cognome": "STRANEO",
                    "sesso": "F",
                    "categoria_protetta_disabilita": "NO",
                    "data_di_nascita": "30/01/1983",
                    "prov_nascita": "PA",
                    "comune_di_nascita": "PALERMO",
                    "codice_fiscale": "STRNZE83A70G273F",
                    "cittadinanza": "ITALIANA",
                    "prov_residenza": "PA",
                    "comune_di_residenza": "Palermo",
                    "titolo_di_studio": "LICENZA MEDIA",
                    "stato_soggetto": "INOCCUPATO",
                    "ts_numerico": 2
                },
                {
                    "data_selezione": "04/09/2025",
                    "nome": "VINCENZA",
                    "cognome": "RUSSO",
                    "sesso": "F",
                    "categoria_protetta_disabilita": "NO",
                    "data_di_nascita": "12/02/1971",
                    "prov_nascita": "PA",
                    "comune_di_nascita": "PALERMO",
                    "codice_fiscale": "RSSVCN71B52G273A",
                    "cittadinanza": "ITALIANA",
                    "prov_residenza": "PA",
                    "comune_di_residenza": "Palermo",
                    "titolo_di_studio": "LICENZA MEDIA",
                    "stato_soggetto": "DISOCCUPATO",
                    "ts_numerico": 2
                },
                {
                    "data_selezione": "04/09/2025",
                    "nome": "PIETRO ALFREDO",
                    "cognome": "LI PUMA",
                    "sesso": "M",
                    "categoria_protetta_disabilita": "NO",
                    "data_di_nascita": "26/07/2004",
                    "prov_nascita": "PA",
                    "comune_di_nascita": "PALERMO",
                    "codice_fiscale": "LPMPRL04L26G273S",
                    "cittadinanza": "ITALIANA",
                    "prov_residenza": "PA",
                    "comune_di_residenza": "Palermo",
                    "titolo_di_studio": "DIPLOMA",
                    "stato_soggetto": "INOCCUPATO",
                    "ts_numerico": 4
                },
                {
                    "data_selezione": "04/09/2025",
                    "nome": "ANNA",
                    "cognome": "DI CORRADO",
                    "sesso": "F",
                    "categoria_protetta_disabilita": "NO",
                    "data_di_nascita": "23/11/1983",
                    "prov_nascita": "PA",
                    "comune_di_nascita": "PALERMO",
                    "codice_fiscale": "DCRNNA83S63G273S",
                    "cittadinanza": "ITALIANA",
                    "prov_residenza": "PA",
                    "comune_di_residenza": "Palermo",
                    "titolo_di_studio": "LICENZA MEDIA",
                    "stato_soggetto": "DISOCCUPATO",
                    "ts_numerico": 2
                },
                {
                    "data_selezione": "04/09/2025",
                    "nome": "SALVATORE",
                    "cognome": "FERRANTE",
                    "sesso": "M",
                    "categoria_protetta_disabilita": "NO",
                    "data_di_nascita": "11/01/1994",
                    "prov_nascita": "PA",
                    "comune_di_nascita": "CARINI",
                    "codice_fiscale": "FRRSVT94A11B780J",
                    "cittadinanza": "ITALIANA",
                    "prov_residenza": "PA",
                    "comune_di_residenza": "Palermo",
                    "titolo_di_studio": "LICENZA MEDIA",
                    "stato_soggetto": "DISOCCUPATO",
                    "ts_numerico": 2
                }
            ]
        }
    ]
JSON, true);

        return response()->json($allievi);
    }
}
