<?php

namespace App\DTO;

use Livewire\Wireable;

class EntePersonaleDto implements Wireable
{
    public function __construct(
        public string $ente,
        public array $personale,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            ente: (string) ($data['ente'] ?? ''),
            personale: PersonaleDto::collection($data['personale'] ?? []),
        );
    }

    public function toLivewire(): array
    {
        return [
            'ente' => $this->ente,
            'personale' => array_map(fn ($persona) => $persona->toLivewire(), $this->personale),
        ];
    }

    public static function fromLivewire($value): static
    {
        return new self(
            ente: (string) ($value['ente'] ?? ''),
            personale: PersonaleDto::collection($value['personale'] ?? []),
        );
    }
}
