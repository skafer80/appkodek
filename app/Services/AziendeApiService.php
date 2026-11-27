<?php

namespace App\Services;

use App\DTO\AziendaDto;
use Illuminate\Support\Facades\Http;

class AziendeApiService
{
    public function getAziende(int $classeId): array
    {
        $response = Http::get("https://app.kodek.it/api/aziende-classe/{$classeId}");
        $response->throw();

        return AziendaDto::collection($response->json() ?? []);
    }
}
