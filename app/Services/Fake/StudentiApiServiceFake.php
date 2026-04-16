<?php

namespace App\Services\Fake;

use App\DTO\ClasseDto;
use App\Services\StudentiApiService;

class StudentiApiServiceFake extends StudentiApiService
{
    public function getStudenti(int $classeId): ClasseDto
    {
        $path = base_path("tests/fixtures/elenco-allievi-classe-{$classeId}.json");

        if (! file_exists($path)) {
            $path = base_path('tests/fixtures/elenco-allievi-classe-999.json');
        }

        $json = file_get_contents($path);

        return ClasseDto::fromArray(json_decode($json, true));
    }
}
