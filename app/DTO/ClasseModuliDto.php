<?php

namespace App\DTO;

use Livewire\Wireable;

class ClasseModuliDto implements Wireable
{
    public function __construct(
        public ?string $classeId,
        public array $moduli,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            classeId: isset($data['classeId']) ? (string) $data['classeId'] : null,
            moduli: ModuloDto::collection($data['moduli'] ?? []),
        );
    }

    public function toLivewire(): array
    {
        return [
            'classeId' => $this->classeId,
            'moduli' => array_map(fn ($modulo) => $modulo->toLivewire(), $this->moduli),
        ];
    }

    public static function fromLivewire($value): static
    {
        return new self(
            classeId: isset($value['classeId']) ? (string) $value['classeId'] : null,
            moduli: ModuloDto::collection($value['moduli'] ?? []),
        );
    }
}
