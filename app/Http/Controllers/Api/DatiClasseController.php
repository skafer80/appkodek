<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DatiClasseController extends Controller
{
    public function execute(Request $request)
    {
        $classeId = $request->classeId;

        $datiClasse = [
            [
                "classeId" => $classeId,
                "DataAvvio" => "30/11/2025",
                "DataFine" => "30/11/2025",
                "Importo" => 1747744,
                "NumeroGiorniPrevisti" => 30,
                "DataAvvioStage" => "30/12/2025",
                "DataFineStage" => "30/12/2025",
                "NumeroGiorniStage" => 10,
                "DenominazioneStage" => "cacaacacacacacacac",
                "PIVA" => "12345678901",
                "NumeroAllievi" => 10,
                "Provincia" => "PA",
                "Comune" => "Palermo",
                "Indirizzo" => "Via Roma",
                "NumeroCivico" => "1"
            ]
        ];

        return response()->json($datiClasse);
    }
}
