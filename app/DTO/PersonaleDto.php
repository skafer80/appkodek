<?php

namespace App\DTO;

use Livewire\Wireable;

class PersonaleDto implements Wireable
{
    public function __construct(
        public ?int $id,
        public ?string $nome,
        public ?string $cognome,
        public ?string $codice_fiscale,
        public ?string $telefono,
        public ?string $email,
        public ?string $data_nascita,
        public ?string $titolo,
        public ?string $esterno,
        public ?string $ruolo,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: isset($data['id']) ? (int) $data['id'] : null,
            nome: $data['nome'] ?? null,
            cognome: $data['cognome'] ?? null,
            codice_fiscale: $data['codice_fiscale'] ?? ($data['cf'] ?? null),
            telefono: $data['telefono'] ?? null,
            email: $data['email'] ?? null,
            data_nascita: $data['data_nascita'] ?? null,
            titolo: $data['titolo'] ?? null,
            esterno: isset($data['esterno']) ? (string) $data['esterno'] : null,
            ruolo: $data['ruolo'] ?? null,
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
            'cognome' => $this->cognome,
            'codice_fiscale' => $this->codice_fiscale,
            'telefono' => $this->telefono,
            'email' => $this->email,
            'data_nascita' => $this->data_nascita,
            'titolo' => $this->titolo,
            'esterno' => $this->esterno,
            'ruolo' => $this->ruolo,
        ];
    }

    public static function fromLivewire($value): static
    {
        return self::fromArray($value);
    }
}
