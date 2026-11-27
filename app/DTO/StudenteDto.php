<?php

namespace App\DTO;

use Livewire\Wireable;

class StudenteDto implements Wireable
{
    public function __construct(
        public ?string $competenze_tecniche_corso, public ?string $nome, public ?string $cognome,
        public ?string $cittadinanza, public bool $cf_provvisorio, public ?string $codice_fiscale,
        public ?string $data_di_nascita, public ?string $prov_nascita, public ?string $comune_di_nascita,
        public ?string $sesso, public bool $soggetto_disabile, public ?string $doc_numero,
        public ?string $doc_tipologia, public ?string $doc_rilasciato_da, public ?string $doc_data_rilascio,
        public ?string $doc_scadenza, public bool $allievo_apprendista, public bool $allievo_continuita,
        public ?int $annualita_provenienza, public ?string $provenienza_scuola_grado,
        public ?string $percorso_provenienza, public ?string $percorso_provenienza_n,
        public ?string $qualifica_terzi, public ?string $qualifica_terzi_n, public ?string $qualifica_terzi_data,
        public ?string $provenienza_scuola_nome, public ?string $subordine1, public ?string $subordine2,
        public ?string $genitore_nome, public ?string $genitore_cognome, public ?string $genitore_cf,
        public ?string $genitore_nato_a, public ?string $genitore_nato_il, public ?string $genitore_sesso,
        public ?string $genitore_email, public ?string $genitore_telefono, public ?string $genitore_indirizzo,
        public ?string $genitore_numero_civico, public ?string $genitore_cap, public ?string $genitore_comune,
        public ?string $genitore_provincia, public ?string $genitore_doc_numero,
        public ?string $genitore_doc_tipologia, public ?string $genitore_doc_rilasciato_da,
        public ?string $genitore_doc_data_rilascio, public ?string $genitore_doc_scadenza,
    ) {}

    public static function fromArray(array $data): self
    {
        $string = static fn (string $key): ?string => isset($data[$key]) ? (string) $data[$key] : null;

        return new self(
            $string('competenze_tecniche_corso'), $string('nome'), $string('cognome'), $string('cittadinanza'),
            (bool) ($data['cf_provvisorio'] ?? false), $string('codice_fiscale'), $string('data_di_nascita'),
            $string('prov_nascita'), $string('comune_di_nascita'), $string('sesso'),
            (bool) ($data['soggetto_disabile'] ?? false), $string('doc_numero'), $string('doc_tipologia'),
            $string('doc_rilasciato_da'), $string('doc_data_rilascio'), $string('doc_scadenza'),
            (bool) ($data['allievo_apprendista'] ?? false), (bool) ($data['allievo_continuita'] ?? false),
            isset($data['annualita_provenienza']) ? (int) $data['annualita_provenienza'] : null,
            $string('provenienza_scuola_grado'), $string('percorso_provenienza'), $string('percorso_provenienza_n'),
            $string('qualifica_terzi'), $string('qualifica_terzi_n'), $string('qualifica_terzi_data'),
            $string('provenienza_scuola_nome'), $string('subordine1'), $string('subordine2'),
            $string('genitore_nome'), $string('genitore_cognome'), $string('genitore_cf'),
            $string('genitore_nato_a'), $string('genitore_nato_il'), $string('genitore_sesso'),
            $string('genitore_email'), $string('genitore_telefono'), $string('genitore_indirizzo'),
            $string('genitore_numero_civico'), $string('genitore_cap'), $string('genitore_comune'),
            $string('genitore_provincia'), $string('genitore_doc_numero'), $string('genitore_doc_tipologia'),
            $string('genitore_doc_rilasciato_da'), $string('genitore_doc_data_rilascio'),
            $string('genitore_doc_scadenza'),
        );
    }

    public static function collection(array $items): array
    {
        return array_map(fn (array $item) => self::fromArray($item), $items);
    }

    public function toLivewire(): array { return get_object_vars($this); }

    public static function fromLivewire($value): static { return self::fromArray((array) $value); }
}
