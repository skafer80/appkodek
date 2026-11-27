<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\DTO\EnteDto;
use RuntimeException;

class ClassiApiService
{
    public function getClassi(): array
    {
        $response = Http::get('https://app.kodek.it/api/enti-sedi-classi');

        $payload = $response->json();

        if ($response->failed() || ! is_array($payload) || ! array_is_list($payload)) {
            $message = is_array($payload) ? ($payload['message'] ?? null) : null;

            throw new RuntimeException(
                $message
                    ? "Impossibile caricare enti e classi: {$message}. Verificare SI1420_EXPORT_TOKEN."
                    : 'Il servizio enti e classi ha restituito un payload non valido.'
            );
        }

        return EnteDto::collection($payload);
    }
}
