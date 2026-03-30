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
        "oreFadConoscenza": 0,
        "nomeModuli": "1 - Assistere la persona nella soddisfazione dei bisogni primari e nella gestione degli interventi igienico-sanitari"
    },
    {
        "nomeConoscenza": "I bisogni primari: tecniche di base",
        "oreConoscenza": 8,
        "oreFadConoscenza": 0,
        "nomeModuli": "1 - Assistere la persona nella soddisfazione dei bisogni primari e nella gestione degli interventi igienico-sanitari"
    },
    {
        "nomeConoscenza": "Sicurezza e prevenzione",
        "oreConoscenza": 12,
        "oreFadConoscenza": 0,
        "nomeModuli": "1 - Assistere la persona nella soddisfazione dei bisogni primari e nella gestione degli interventi igienico-sanitari"
    },
    {
        "nomeConoscenza": "Tecniche di mobilizzazione",
        "oreConoscenza": 9,
        "oreFadConoscenza": 0,
        "nomeModuli": "1 - Assistere la persona nella soddisfazione dei bisogni primari e nella gestione degli interventi igienico-sanitari"
    },
    {
        "nomeConoscenza": "Elementi di primo soccorso",
        "oreConoscenza": 9,
        "oreFadConoscenza": 0,
        "nomeModuli": "1 - Assistere la persona nella soddisfazione dei bisogni primari e nella gestione degli interventi igienico-sanitari"
    },
    {
        "nomeConoscenza": "Tecniche di prevenzione e di cura delle complicanze delle principali patologie degenerative",
        "oreConoscenza": 15,
        "oreFadConoscenza": 0,
        "nomeModuli": "1 - Assistere la persona nella soddisfazione dei bisogni primari e nella gestione degli interventi igienico-sanitari"
    },
    {
        "nomeConoscenza": "Elementi di igiene personale",
        "oreConoscenza": 10,
        "oreFadConoscenza": 0,
        "nomeModuli": "1 - Assistere la persona nella soddisfazione dei bisogni primari e nella gestione degli interventi igienico-sanitari"
    },
    {
        "nomeConoscenza": "Tecniche di automedicazione e di assunzione dei farmaci",
        "oreConoscenza": 6,
        "oreFadConoscenza": 0,
        "nomeModuli": "1 - Assistere la persona nella soddisfazione dei bisogni primari e nella gestione degli interventi igienico-sanitari"
    },
    {
        "nomeConoscenza": "Conservazione dei farmaci e loro smaltimento",
        "oreConoscenza": 5,
        "oreFadConoscenza": 0,
        "nomeModuli": "1 - Assistere la persona nella soddisfazione dei bisogni primari e nella gestione degli interventi igienico-sanitari"
    },

    {
        "nomeConoscenza": "Elementi di igiene ambientale a domicilio: pulizia della casa e cura della biancheria",
        "oreConoscenza": 15,
        "oreFadConoscenza": 0,
        "nomeModuli": "2 - Supportare la persona nelle attività domestico alberghiere e igienico ambientali"
    },
    {
        "nomeConoscenza": "Elementi di economia domestica e di gestione del bilancio domestico",
        "oreConoscenza": 20,
        "oreFadConoscenza": 0,
        "nomeModuli": "2 - Supportare la persona nelle attività domestico alberghiere e igienico ambientali"
    },
    {
        "nomeConoscenza": "Preparazione dei pasti",
        "oreConoscenza": 15,
        "oreFadConoscenza": 0,
        "nomeModuli": "2 - Supportare la persona nelle attività domestico alberghiere e igienico ambientali"
    },
    {
        "nomeConoscenza": "Prevenzione incidenti domestici",
        "oreConoscenza": 8,
        "oreFadConoscenza": 0,
        "nomeModuli": "2 - Supportare la persona nelle attività domestico alberghiere e igienico ambientali"
    },
    {
        "nomeConoscenza": "Elementi di igiene alimentare",
        "oreConoscenza": 20,
        "oreFadConoscenza": 0,
        "nomeModuli": "2 - Supportare la persona nelle attività domestico alberghiere e igienico ambientali"
    },

    {
        "nomeConoscenza": "Tipologia di utenza",
        "oreConoscenza": 15,
        "oreFadConoscenza": 0,
        "nomeModuli": "3 - Gestire dinamiche di relazione d'aiuto"
    },
    {
        "nomeConoscenza": "La relazione di aiuto: strategie e tecniche",
        "oreConoscenza": 25,
        "oreFadConoscenza": 0,
        "nomeModuli": "3 - Gestire dinamiche di relazione d'aiuto"
    },
    {
        "nomeConoscenza": "Tecniche di osservazione",
        "oreConoscenza": 20,
        "oreFadConoscenza": 0,
        "nomeModuli": "3 - Gestire dinamiche di relazione d'aiuto"
    },
    {
        "nomeConoscenza": "Teorie e tecniche di comunicazione",
        "oreConoscenza": 30,
        "oreFadConoscenza": 0,
        "nomeModuli": "3 - Gestire dinamiche di relazione d'aiuto"
    },
    {
        "nomeConoscenza": "Ruoli e funzioni nei gruppi di lavoro",
        "oreConoscenza": 20,
        "oreFadConoscenza": 0,
        "nomeModuli": "3 - Gestire dinamiche di relazione d'aiuto"
    },
    {
        "nomeConoscenza": "Etica e deontologia professionale",
        "oreConoscenza": 20,
        "oreFadConoscenza": 0,
        "nomeModuli": "3 - Gestire dinamiche di relazione d'aiuto"
    },
    {
    "nomeConoscenza": "Elementi di osservazione e comunicazione",
    "oreConoscenza": 10,
    "oreFadConoscenza": 0,
    "nomeModuli": "4 - Fornire assistenza sociale alla persona al fine di promuovere lo sviluppo e l'autonomia"
},
{
    "nomeConoscenza": "Teorie e tecniche di comunicazione",
    "oreConoscenza": 10,
    "oreFadConoscenza": 0,
    "nomeModuli": "4 - Fornire assistenza sociale alla persona al fine di promuovere lo sviluppo e l'autonomia"
},
{
    "nomeConoscenza": "Strategie di apprendimento",
    "oreConoscenza": 8,
    "oreFadConoscenza": 0,
    "nomeModuli": "4 - Fornire assistenza sociale alla persona al fine di promuovere lo sviluppo e l'autonomia"
},
{
    "nomeConoscenza": "Teorie e tecniche di gestione di conflitti",
    "oreConoscenza": 8,
    "oreFadConoscenza": 0,
    "nomeModuli": "4 - Fornire assistenza sociale alla persona al fine di promuovere lo sviluppo e l'autonomia"
},
{
    "nomeConoscenza": "Tecniche di ascolto e comunicazione",
    "oreConoscenza": 10,
    "oreFadConoscenza": 0,
    "nomeModuli": "4 - Fornire assistenza sociale alla persona al fine di promuovere lo sviluppo e l'autonomia"
},
{
    "nomeConoscenza": "Elementi di psicologia relazione",
    "oreConoscenza": 8,
    "oreFadConoscenza": 0,
    "nomeModuli": "4 - Fornire assistenza sociale alla persona al fine di promuovere lo sviluppo e l'autonomia"
},
{
    "nomeConoscenza": "Funzioni, organizzazione e articolazione territoriale dei servizi",
    "oreConoscenza": 8,
    "oreFadConoscenza": 0,
    "nomeModuli": "4 - Fornire assistenza sociale alla persona al fine di promuovere lo sviluppo e l'autonomia"
},
{
    "nomeConoscenza": "Risorse territoriali (enti, associazioni ed altro)",
    "oreConoscenza": 6,
    "oreFadConoscenza": 0,
    "nomeModuli": "4 - Fornire assistenza sociale alla persona al fine di promuovere lo sviluppo e l'autonomia"
},
{
    "nomeConoscenza": "Teorie e tecniche di relazione e socializzazione",
    "oreConoscenza": 8,
    "oreFadConoscenza": 0,
    "nomeModuli": "4 - Fornire assistenza sociale alla persona al fine di promuovere lo sviluppo e l'autonomia"
},
{
    "nomeConoscenza": "Elementi di psicologia sociale",
    "oreConoscenza": 8,
    "oreFadConoscenza": 0,
    "nomeModuli": "4 - Fornire assistenza sociale alla persona al fine di promuovere lo sviluppo e l'autonomia"
},
{
    "nomeConoscenza": "Elementi di etica e deontologia delle professioni sociali e sanitarie",
    "oreConoscenza": 6,
    "oreFadConoscenza": 0,
    "nomeModuli": "4 - Fornire assistenza sociale alla persona al fine di promuovere lo sviluppo e l'autonomia"
}

]
JSON, true);

        return response()->json($moduli);
    }
}
