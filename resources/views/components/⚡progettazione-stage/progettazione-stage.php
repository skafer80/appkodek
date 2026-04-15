<?php

use App\Services\DatiClasseApiService;
use Livewire\Component;

new class extends Component
{
    public $classeSelezionata = null;

    public ?string $dataAvvioStage     = null;
    public ?string $dataFineStage      = null;
    public ?int    $numeroGiorniStage  = null;
    public ?string $denominazioneStage = null;
    public ?string $piva               = null;
    public ?string $numeroAllievi      = null;
    public ?string $provincia          = null;
    public ?string $comune             = null;
    public ?string $indirizzo          = null;
    public ?string $numeroCivico       = null;
    public bool    $loaded             = false;

    public function mount($classeSelezionata = null, DatiClasseApiService $service): void
    {
        $this->classeSelezionata = $classeSelezionata;
        $this->caricaDati($service);
    }

    private function caricaDati(DatiClasseApiService $service): void
    {
        if (! $this->classeSelezionata) {
            $this->loaded = false;
            return;
        }

        $dto = $service->getDatiClasse((int) $this->classeSelezionata);

        $this->dataAvvioStage     = $dto->dataAvvioStage;
        $this->dataFineStage      = $dto->dataFineStage;
        $this->numeroGiorniStage  = $dto->numeroGiorniStage;
        $this->denominazioneStage = $dto->denominazioneStage;
        $this->piva               = $dto->piva;
        $this->numeroAllievi      = $dto->numeroAllievi;
        $this->provincia          = $dto->provincia;
        $this->comune             = $dto->comune;
        $this->indirizzo          = $dto->indirizzo;
        $this->numeroCivico       = $dto->numeroCivico;
        $this->loaded             = true;
    }
};
