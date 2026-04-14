<?php

namespace App\DTO;

use Livewire\Wireable;

class StudenteDto implements Wireable
{
    public function __construct(
        public ?string $data_selezione,
        public ?string $nome,
        public ?string $cognome,
        public ?string $sesso,
        public ?string $categoria_protetta_disabilita,
        public ?string $data_di_nascita,
        public ?string $prov_nascita,
        public ?string $comune_di_nascita,
        public ?string $codice_fiscale,
        public ?string $cittadinanza,
        public ?string $prov_residenza,
        public ?string $comune_di_residenza,
        public ?string $titolo_di_studio,
        public ?int $ts_numerico,
        public ?string $stato_soggetto,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            data_selezione: $data['data_selezione'],
            nome: $data['nome'],
            cognome: $data['cognome'],
            sesso: $data['sesso'],
            categoria_protetta_disabilita: $data['categoria_protetta_disabilita'],
            data_di_nascita: $data['data_di_nascita'],
            prov_nascita: $data['prov_nascita'],
            comune_di_nascita: $data['comune_di_nascita'],
            codice_fiscale: $data['codice_fiscale'],
            cittadinanza: $data['cittadinanza'],
            prov_residenza: $data['prov_residenza'],
            comune_di_residenza: $data['comune_di_residenza'],
            titolo_di_studio: $data['titolo_di_studio'],
            ts_numerico: (int) $data['ts_numerico'],
            stato_soggetto: $data['stato_soggetto'],
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
            'data_selezione' => $this->data_selezione,
            'nome' => $this->nome,
            'cognome' => $this->cognome,
            'sesso' => $this->sesso,
            'categoria_protetta_disabilita' => $this->categoria_protetta_disabilita,
            'data_di_nascita' => $this->data_di_nascita,
            'prov_nascita' => $this->prov_nascita,
            'comune_di_nascita' => $this->comune_di_nascita,
            'codice_fiscale' => $this->codice_fiscale,
            'cittadinanza' => $this->cittadinanza,
            'prov_residenza' => $this->prov_residenza,
            'comune_di_residenza' => $this->comune_di_residenza,
            'titolo_di_studio' => $this->titolo_di_studio,
            'ts_numerico' => $this->ts_numerico,
            'stato_soggetto' => $this->stato_soggetto,
        ];
    }

    public static function fromLivewire($value): static
    {
        return self::fromArray($value);
    }
}
