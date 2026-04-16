<?php

namespace App\Services\Fake;

use App\DTO\DatiClasseDto;
use App\Services\DatiClasseApiService;

class DatiClasseApiServiceFake extends DatiClasseApiService
{
    public function getDatiClasse(int $classeId): DatiClasseDto
    {
        $path = base_path("tests/fixtures/dati-classe-{$classeId}.json");

        if (! file_exists($path)) {
            // Fallback: restituisce il primo fixture disponibile
            $path = base_path('tests/fixtures/dati-classe-999.json');
        }

        $json = file_get_contents($path);

        return DatiClasseDto::fromArray(json_decode($json, true));
    }
}
