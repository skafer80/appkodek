<?php

namespace App\DTO;

use Livewire\Wireable;

class AziendaDto implements Wireable
{
    public function __construct(
        public ?string $classeId, public ?int $numeroAllievi, public ?int $nTutorAziendali,
        public ?string $rischio, public ?string $denominazione, public ?string $codiceFiscale,
        public ?string $partitaIva, public ?string $codiceAteco, public ?string $indirizzo,
        public ?string $comune, public ?string $provincia, public ?string $cap, public ?string $numeroCivico,
    ) {}

    public static function fromArray(array $data): self
    {
        $string = static fn (string $key): ?string => isset($data[$key]) ? (string) $data[$key] : null;

        return new self(
            $string('classeId'), isset($data['numeroAllievi']) ? (int) $data['numeroAllievi'] : null,
            isset($data['nTutorAziendali']) ? (int) $data['nTutorAziendali'] : null, $string('rischio'),
            $string('denominazione'), $string('codiceFiscale'), $string('partitaIva'), $string('codiceAteco'),
            $string('indirizzo'), $string('comune'), $string('provincia'), $string('cap'), $string('numeroCivico'),
        );
    }

    public static function collection(array $items): array
    {
        return array_map(fn (array $item) => self::fromArray($item), $items);
    }

    public function toLivewire(): array { return get_object_vars($this); }

    public static function fromLivewire($value): static { return self::fromArray((array) $value); }
}
