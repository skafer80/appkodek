<?php

namespace App\Services;

use App\DTO\DatiClasseDto;
use Illuminate\Support\Facades\Http;

class DatiClasseApiService
{
    public function getDatiClasse(int $classeId): DatiClasseDto
    {
        $response = Http::get("https://app.kodek.it/api/dati-classe/{$classeId}");

        return DatiClasseDto::fromArray($response->json() ?? []);
    }
}
