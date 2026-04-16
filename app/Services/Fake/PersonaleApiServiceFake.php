<?php

namespace App\Services\Fake;

use App\DTO\EntePersonaleDto;
use App\Services\PersonaleApiService;

class PersonaleApiServiceFake extends PersonaleApiService
{
    public function getPersonaleByEnte(string $enteSelezionato): EntePersonaleDto
    {
        $json = file_get_contents(base_path('tests/fixtures/enti.json'));
        $enti = json_decode($json, true);

        $enteNorm = mb_strtolower(trim($enteSelezionato));

        $ente = collect($enti)->first(
            fn ($item) => mb_strtolower(trim($item['ente'] ?? '')) === $enteNorm
        );

        return EntePersonaleDto::fromArray([
            'ente' => $enteSelezionato,
            'personale' => $ente['personale'] ?? [],
        ]);
    }
}
