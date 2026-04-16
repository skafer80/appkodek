<?php

namespace App\Services\Fake;

use App\DTO\EnteDto;
use App\Services\ClassiApiService;

class ClassiApiServiceFake extends ClassiApiService
{
    public function getClassi(): array
    {
        $json = file_get_contents(base_path('tests/fixtures/enti-sedi-classi.json'));

        return EnteDto::collection(json_decode($json, true));
    }
}
