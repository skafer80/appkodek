<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\DTO\EnteDto;

class ClassiApiService
{
    public function getClassi(): array
    {
        $response = Http::get('https://app.kodek.it/api/enti-sedi-classi');

        return EnteDto::collection($response->json());
    }
}
