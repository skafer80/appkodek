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
                "moduli": [
                    {
                        "nomeModuli": "1 - Assistere la persona nella soddisfazione dei bisogni primari e nella gestione degli interventi igienico-sanitari",
                        "conoscenze": [
                            {
                                "nomeConoscenza": "Conoscenza 1",
                                "oreConoscenza": 10,
                                "oreFadConoscenza": 5
                            },
                            {
                                "nomeConoscenza": "Conoscenza 2",
                                "oreConoscenza": 8,
                                "oreFadConoscenza": 4
                            }
                        ]
                    },
                    {
                        "nomeModuli": "2 - Gestire le attività di supporto alla persona nella vita quotidiana",
                        "conoscenze": [
                            {
                                "nomeConoscenza": "Conoscenza 3",
                                "oreConoscenza": 12,
                                "oreFadConoscenza": 6
                            },
                            {
                                "nomeConoscenza": "Conoscenza 4",
                                "oreConoscenza": 9,
                                "oreFadConoscenza": 3
                            }
                        ]
                    }

                ]
                }
            ]
        JSON, true);


        return response()->json($moduli);
    }
}

