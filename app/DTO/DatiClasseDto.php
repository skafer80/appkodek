<?php

namespace App\DTO;

use Livewire\Wireable;

class DatiClasseDto implements Wireable
{
    public function __construct(
        public string $classeId,
        // Dettagli
        public string $dataAvvio,
        public string $dataFine,
        public string $importo,
        public int    $numeroGiorniPrevisti,
        // Stage
        public string $dataAvvioStage,
        public string $dataFineStage,
        public int    $numeroGiorniStage,
        public string $denominazioneStage,
        public string $piva,
        public string $numeroAllievi,
        public string $provincia,
        public string $comune,
        public string $indirizzo,
        public string $numeroCivico,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            classeId:             (string) ($data['classeId'] ?? ''),
            dataAvvio:            $data['DataAvvio']            ?? '',
            dataFine:             $data['DataFine']             ?? '',
            importo:              $data['Importo']              ?? '0.00',
            numeroGiorniPrevisti: (int)    ($data['NumeroGiorniPrevisti'] ?? 0),
            dataAvvioStage:       $data['DataAvvioStage']       ?? '',
            dataFineStage:        $data['DataFineStage']        ?? '',
            numeroGiorniStage:    (int)    ($data['NumeroGiorniStage']    ?? 0),
            denominazioneStage:   trim($data['DenominazioneStage']        ?? ''),
            piva:                 trim($data['PIVA']                      ?? ''),
            numeroAllievi:        (string) ($data['NumeroAllievi']        ?? '0'),
            provincia:            $data['Provincia']            ?? '',
            comune:               $data['Comune']               ?? '',
            indirizzo:            trim($data['Indirizzo']                 ?? ''),
            numeroCivico:         trim($data['NumeroCivico']              ?? ''),
        );
    }

    public function toLivewire(): array
    {
        return [
            'classeId'             => $this->classeId,
            'dataAvvio'            => $this->dataAvvio,
            'dataFine'             => $this->dataFine,
            'importo'              => $this->importo,
            'numeroGiorniPrevisti' => $this->numeroGiorniPrevisti,
            'dataAvvioStage'       => $this->dataAvvioStage,
            'dataFineStage'        => $this->dataFineStage,
            'numeroGiorniStage'    => $this->numeroGiorniStage,
            'denominazioneStage'   => $this->denominazioneStage,
            'piva'                 => $this->piva,
            'numeroAllievi'        => $this->numeroAllievi,
            'provincia'            => $this->provincia,
            'comune'               => $this->comune,
            'indirizzo'            => $this->indirizzo,
            'numeroCivico'         => $this->numeroCivico,
        ];
    }

    public static function fromLivewire($value): static
    {
        return self::fromArray($value);
    }
}
