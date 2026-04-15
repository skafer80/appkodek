<?php

namespace App\Services;

use App\DTO\EntePersonaleDto;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PersonaleApiService
{
    public function getPersonaleByEnte(string $enteSelezionato): EntePersonaleDto
    {
        $enteSelezionato = trim($enteSelezionato);

        $filePath = $this->resolveEntiJsonPath();

        if ($filePath === null) {
            $datiRemoti = $this->caricaEntiDaRemoto();

            if ($datiRemoti === null) {
                return new EntePersonaleDto(ente: $enteSelezionato, personale: []);
            }

            $enti = $this->estraiEnti($datiRemoti);

            return $this->risolviEnte($enteSelezionato, $enti, 'remote:https://app.kodek.it/utility/enti.json');
        }

        $contenuto = file_get_contents($filePath);
        $dati = json_decode($contenuto, true);

        $enti = $this->estraiEnti($dati);

        if (!is_array($enti)) {
            $datiRemoti = $this->caricaEntiDaRemoto();
            $enti = $this->estraiEnti($datiRemoti);

            if (!is_array($enti)) {
                return new EntePersonaleDto(ente: $enteSelezionato, personale: []);
            }

            return $this->risolviEnte($enteSelezionato, $enti, 'remote:https://app.kodek.it/utility/enti.json');
        }

        return $this->risolviEnte($enteSelezionato, $enti, $filePath);
    }

    private function risolviEnte(string $enteSelezionato, array $enti, string $origine): EntePersonaleDto
    {
        $enteNorm = $this->normalizza($enteSelezionato);

        $ente = collect($enti)->first(
            fn ($item) => $this->normalizza($item['ente'] ?? '') === $enteNorm
        );

        if ($ente === null) {
            Log::warning('PersonaleApiService: ente non trovato nel JSON', [
                'ente_selezionato' => $enteSelezionato,
                'origine' => $origine,
                'enti_disponibili' => collect($enti)->pluck('ente')->take(20)->values()->all(),
            ]);
        }

        return EntePersonaleDto::fromArray([
            'ente' => $enteSelezionato,
            'personale' => $ente['personale'] ?? [],
        ]);
    }

    private function caricaEntiDaRemoto(): ?array
    {
        try {
            $response = Http::timeout(8)->get('https://app.kodek.it/utility/enti.json');

            if (!$response->ok()) {
                return null;
            }

            $json = $response->json();

            return is_array($json) ? $json : null;
        } catch (\Throwable $e) {
            Log::warning('PersonaleApiService: fallback remoto fallito', [
                'errore' => $e->getMessage(),
            ]);

            return null;
        }
    }

    private function resolveEntiJsonPath(): ?string
    {
        $paths = [
            public_path('utility/enti.json'),
            base_path('public/utility/enti.json'),
            base_path('utility/enti.json'),
            storage_path('app/utility/enti.json'),
        ];

        foreach ($paths as $path) {
            if (is_file($path)) {
                return $path;
            }
        }

        $matches = glob(base_path('**/enti.json')) ?: [];
        foreach ($matches as $path) {
            if (is_file($path)) {
                return $path;
            }
        }

        return null;
    }

    private function estraiEnti(mixed $dati): ?array
    {
        if (!is_array($dati)) {
            return null;
        }

        if (isset($dati['enti']) && is_array($dati['enti'])) {
            return $dati['enti'];
        }

        if (array_is_list($dati)) {
            return $dati;
        }

        // Supporta formato associativo: { "carpan": { "personale": [...] }, ... }
        $enti = [];
        foreach ($dati as $chiave => $valore) {
            if (!is_array($valore)) {
                continue;
            }

            $enti[] = [
                'ente' => is_string($chiave) ? $chiave : ($valore['ente'] ?? ''),
                'personale' => $valore['personale'] ?? [],
            ];
        }

        return $enti;
    }

    private function normalizza(string $value): string
    {
        return Str::lower(trim($value));
    }
}
