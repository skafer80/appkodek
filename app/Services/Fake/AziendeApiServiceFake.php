<?php

namespace App\Services\Fake;

use App\DTO\AziendaDto;
use App\Services\AziendeApiService;

class AziendeApiServiceFake extends AziendeApiService
{
    public function getAziende(int $classeId): array
    {
        $path = base_path("tests/fixtures/aziende-classe-{$classeId}.json");

        if (! file_exists($path)) {
            $path = base_path('tests/fixtures/aziende-classe-999.json');
        }

        return AziendaDto::collection(json_decode(file_get_contents($path), true) ?? []);
    }
}
