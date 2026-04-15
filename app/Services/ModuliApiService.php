<?php

namespace App\Services;

use App\DTO\ClasseModuliDto;
use Illuminate\Support\Facades\Http;

class ModuliApiService
{
    public function getModuli(int $classeId): ClasseModuliDto
    {
        $response = Http::get("https://app.kodek.it/api/elenco-moduli-classe/{$classeId}");

        return ClasseModuliDto::fromArray($response->json() ?? []);
    }
}
