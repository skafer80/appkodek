<?php

namespace App\DTO;

use Livewire\Wireable;

class ClasseDto implements Wireable
{
    public function __construct(
        public string $classeId,
        public array $studenti
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            classeId: $data['classeId'],
            studenti: StudenteDto::collection($data['studente'])
        );
    }

    public function toLivewire(): array
    {
        return [
            'classeId' => $this->classeId,
            'studenti' => array_map(fn ($s) => $s->toLivewire(), $this->studenti),
        ];
    }

    public static function fromLivewire($value): static
    {
        return new self(
            classeId: $value['classeId'],
            studenti: StudenteDto::collection($value['studenti']),
        );
    }
}
