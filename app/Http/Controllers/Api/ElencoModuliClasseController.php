<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ElencoModuliClasseController extends Controller
{
    public function execute(Request $request)
    {
        $classeId = $request->classeId;

        $moduli = json_decode(<<<'JSON'
        [
                    {
                        "nomeConoscenza": "Elementi di osservazione e comunicazione",
                        "oreConoscenza": 10,
                        "oreFadConoscenza": 5,
                        "nomeModuli": "1 - Assistere la persona nella soddisfazione dei bisogni primari e nella gestione degli interventi igienico-sanitari"
                    },
                    {
                        "nomeConoscenza": "I bisogni primari: tecniche di base",
                        "oreConoscenza": 8,
                        "oreFadConoscenza": 4,
                        "nomeModuli": "1 - Assistere la persona nella soddisfazione dei bisogni primari e nella gestione degli interventi igienico-sanitari"
                    },
                    {
                        "nomeConoscenza": "Sicurezza e prevenzione",
                        "oreConoscenza": 12,
                        "oreFadConoscenza": 6,
                        "nomeModuli": "2 - Gestire le attività di supporto alla persona nella vita quotidiana"
                    },
                    {
                        "nomeConoscenza": "Tecniche di mobilizzazione",
                        "oreConoscenza": 9,
                        "oreFadConoscenza": 3,
                        "nomeModuli": "2 - Gestire le attività di supporto alla persona nella vita quotidiana"
                    }
                ]

        JSON, true);

        return response()->json($moduli);
    }
}
