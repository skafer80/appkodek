<?php

namespace App\DTO;

use Livewire\Wireable;

class ConoscenzaModuloDto implements Wireable
{
    public function __construct(
        public ?string $nomeConoscenza,
        public ?int $oreConoscenza,
        public ?int $oreFadConoscenza,
        public ?string $fascia,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            nomeConoscenza: $data['nomeConoscenza'] ?? null,
            oreConoscenza: isset($data['oreConoscenza']) ? (int) $data['oreConoscenza'] : null,
            oreFadConoscenza: isset($data['oreFadConoscenza']) ? (int) $data['oreFadConoscenza'] : null,
            fascia: array_key_exists('fascia', $data)
                ? ($data['fascia'] === null ? null : (string) $data['fascia'])
                : null,
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
            'nomeConoscenza' => $this->nomeConoscenza,
            'oreConoscenza' => $this->oreConoscenza,
            'oreFadConoscenza' => $this->oreFadConoscenza,
            'fascia' => $this->fascia,
        ];
    }

    public static function fromLivewire($value): static
    {
        return self::fromArray($value);
    }
}
