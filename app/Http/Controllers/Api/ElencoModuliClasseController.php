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
                "classeId": 1,

                        "conoscenze": [
                            {
                                "nomeConoscenza": "Conoscenza 1",
                                "oreConoscenza": 10,
                                "oreFadConoscenza": 5,
                                "nomeModuli": "1 - Assistere la persona nella soddisfazione dei bisogni primari e nella gestione degli interventi igienico-sanitari",
                            },
                            {
                                "nomeConoscenza": "Conoscenza 2",
                                "oreConoscenza": 8,
                                "oreFadConoscenza": 4,
                                "nomeModuli": "1 - Assistere la persona nella soddisfazione dei bisogni primari e nella gestione degli interventi igienico-sanitari",
                            },
                            {
                                "nomeConoscenza": "Conoscenza 3",
                                "oreConoscenza": 12,
                                "oreFadConoscenza": 6,
                                "nomeModuli": "2 - Gestire le attività di supporto alla persona nella vita quotidiana",
                            },
                            {
                                "nomeConoscenza": "Conoscenza 4",
                                "oreConoscenza": 9,
                                "oreFadConoscenza": 3,
                                "nomeModuli": "2 - Gestire le attività di supporto alla persona nella vita quotidiana",
                            }
                        ]
                    }

                ]

        JSON, true);


        return response()->json($moduli);
    }
}

