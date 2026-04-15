<?php

namespace App\DTO;

use Livewire\Wireable;

class ModuloDto implements Wireable
{
    public function __construct(
        public ?string $nomeModuli,
        public array $conoscenze,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            nomeModuli: $data['nomeModuli'] ?? null,
            conoscenze: ConoscenzaModuloDto::collection($data['conoscenze'] ?? []),
        );
    }

    public static function collection(array $items): array
    {
        return array_map(
            fn ($item) => self::fromArray($item),
            $items
        );
    }

    public function toLivewire(): array
    {
        return [
            'nomeModuli' => $this->nomeModuli,
            'conoscenze' => array_map(fn ($conoscenza) => $conoscenza->toLivewire(), $this->conoscenze),
        ];
    }

    public static function fromLivewire($value): static
    {
        return new self(
            nomeModuli: $value['nomeModuli'] ?? null,
            conoscenze: ConoscenzaModuloDto::collection($value['conoscenze'] ?? []),
        );
    }
}
