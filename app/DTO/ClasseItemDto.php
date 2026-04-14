<?php

namespace App\DTO;

use Livewire\Wireable;

class ClasseItemDto implements Wireable
{
    public function __construct(
        public int $id,
        public string $nome,
        public string $descrizione,
        public string $sede,
        public int $ordine
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: (int) $data['id'],
            nome: $data['nome'],
            descrizione: $data['descrizione'],
            sede: $data['sede'],
            ordine: (int) $data['ordine']
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
            'id' => $this->id,
            'nome' => $this->nome,
            'descrizione' => $this->descrizione,
            'sede' => $this->sede,
            'ordine' => $this->ordine,
        ];
    }

    public static function fromLivewire($value): static
    {
        return self::fromArray($value);
    }
}
