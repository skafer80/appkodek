<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\DTO\ClasseDto;

class StudentiApiService
{
    public function getStudenti(int $classeId): ClasseDto
    {
        $response = Http::get("https://app.kodek.it/api/elenco-allievi-classe/{$classeId}");

        return ClasseDto::fromArray($response->json());
    }
}

