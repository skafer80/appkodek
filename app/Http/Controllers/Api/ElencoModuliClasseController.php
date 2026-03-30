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
        "nomeModuli": "1 - Assistere la persona nella soddisfazione dei bisogni primari e nella gestione degli interventi igienico-sanitari"
    },
    {
        "nomeConoscenza": "Tecniche di mobilizzazione",
        "oreConoscenza": 9,
        "oreFadConoscenza": 3,
        "nomeModuli": "1 - Assistere la persona nella soddisfazione dei bisogni primari e nella gestione degli interventi igienico-sanitari"
    },
    {
        "nomeConoscenza": "Elementi di primo soccorso",
        "oreConoscenza": 9,
        "oreFadConoscenza": 3,
        "nomeModuli": "1 - Assistere la persona nella soddisfazione dei bisogni primari e nella gestione degli interventi igienico-sanitari"
    },
    {
        "nomeConoscenza": "Tecniche di prevenzione e di cura delle complicanze delle principali patologie degenerative",
        "oreConoscenza": 15,
        "oreFadConoscenza": 7,
        "nomeModuli": "1 - Assistere la persona nella soddisfazione dei bisogni primari e nella gestione degli interventi igienico-sanitari"
    },
    {
        "nomeConoscenza": "Elementi di igiene personale",
        "oreConoscenza": 10,
        "oreFadConoscenza": 5,
        "nomeModuli": "1 - Assistere la persona nella soddisfazione dei bisogni primari e nella gestione degli interventi igienico-sanitari"
    },
    {
        "nomeConoscenza": "Tecniche di automedicazione e di assunzione dei farmaci",
        "oreConoscenza": 6,
        "oreFadConoscenza": 3,
        "nomeModuli": "1 - Assistere la persona nella soddisfazione dei bisogni primari e nella gestione degli interventi igienico-sanitari"
    },
    {
        "nomeConoscenza": "Conservazione dei farmaci e loro smaltimento",
        "oreConoscenza": 5,
        "oreFadConoscenza": 2,
        "nomeModuli": "1 - Assistere la persona nella soddisfazione dei bisogni primari e nella gestione degli interventi igienico-sanitari"
    },

    {
        "nomeConoscenza": "Elementi di igiene ambientale a domicilio: pulizia della casa e cura della biancheria",
        "oreConoscenza": 15,
        "oreFadConoscenza": 5,
        "nomeModuli": "2 - Supportare la persona nelle attività domestico alberghiere e igienico ambientali"
    },
    {
        "nomeConoscenza": "Elementi di economia domestica e di gestione del bilancio domestico",
        "oreConoscenza": 10,
        "oreFadConoscenza": 5,
        "nomeModuli": "2 - Supportare la persona nelle attività domestico alberghiere e igienico ambientali"
    },
    {
        "nomeConoscenza": "Preparazione dei pasti",
        "oreConoscenza": 15,
        "oreFadConoscenza": 5,
        "nomeModuli": "2 - Supportare la persona nelle attività domestico alberghiere e igienico ambientali"
    },
    {
        "nomeConoscenza": "Prevenzione incidenti domestici",
        "oreConoscenza": 8,
        "oreFadConoscenza": 3,
        "nomeModuli": "2 - Supportare la persona nelle attività domestico alberghiere e igienico ambientali"
    },
    {
        "nomeConoscenza": "Elementi di igiene alimentare",
        "oreConoscenza": 10,
        "oreFadConoscenza": 5,
        "nomeModuli": "2 - Supportare la persona nelle attività domestico alberghiere e igienico ambientali"
    },

    {
        "nomeConoscenza": "Tipologia di utenza",
        "oreConoscenza": 15,
        "oreFadConoscenza": 5,
        "nomeModuli": "3 - Gestire dinamiche di relazione d'aiuto"
    },
    {
        "nomeConoscenza": "La relazione di aiuto: strategie e tecniche",
        "oreConoscenza": 25,
        "oreFadConoscenza": 10,
        "nomeModuli": "3 - Gestire dinamiche di relazione d'aiuto"
    },
    {
        "nomeConoscenza": "Tecniche di osservazione",
        "oreConoscenza": 20,
        "oreFadConoscenza": 10,
        "nomeModuli": "3 - Gestire dinamiche di relazione d'aiuto"
    },
    {
        "nomeConoscenza": "Teorie e tecniche di comunicazione",
        "oreConoscenza": 30,
        "oreFadConoscenza": 10,
        "nomeModuli": "3 - Gestire dinamiche di relazione d'aiuto"
    },
    {
        "nomeConoscenza": "Ruoli e funzioni nei gruppi di lavoro",
        "oreConoscenza": 20,
        "oreFadConoscenza": 10,
        "nomeModuli": "3 - Gestire dinamiche di relazione d'aiuto"
    },
    {
        "nomeConoscenza": "Etica e deontologia professionale",
        "oreConoscenza": 20,
        "oreFadConoscenza": 5,
        "nomeModuli": "3 - Gestire dinamiche di relazione d'aiuto"
    }

]
JSON, true);

        return response()->json($moduli);
    }
}
