<?php

namespace App\Services\Fake;

use App\DTO\ClasseModuliDto;
use App\Services\ModuliApiService;

class ModuliApiServiceFake extends ModuliApiService
{
    public function getModuli(int $classeId): ClasseModuliDto
    {
        $path = base_path("tests/fixtures/elenco-moduli-classe-{$classeId}.json");

        if (! file_exists($path)) {
            $path = base_path('tests/fixtures/elenco-moduli-classe-999.json');
        }

        $json = file_get_contents($path);

        return ClasseModuliDto::fromArray(json_decode($json, true));
    }
}
