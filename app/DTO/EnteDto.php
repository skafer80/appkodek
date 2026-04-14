<?php
namespace App\DTO;

use App\DTO\ClasseItemDto;
use Livewire\Wireable;

class EnteDto implements Wireable
{
    public function __construct(
        public string $ente,
        public array $classi
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            ente: $data['ente'],
            classi: ClasseItemDto::collection($data['classi'])
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
            'ente' => $this->ente,
            'classi' => array_map(fn ($c) => $c->toLivewire(), $this->classi),
        ];
    }

    public static function fromLivewire($value): static
    {
        return new self(
            ente: $value['ente'],
            classi: ClasseItemDto::collection($value['classi']),
        );
    }
}
