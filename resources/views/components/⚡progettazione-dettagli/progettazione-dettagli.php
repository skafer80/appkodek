<?php

use App\Services\DatiClasseApiService;
use Livewire\Component;

new class extends Component
{
    public $classeSelezionata = null;

    public ?string $dataAvvio            = null;
    public ?string $dataFine             = null;
    public ?string $importo              = null;
    public ?int    $numeroGiorniPrevisti = null;
    public bool    $loaded               = false;

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

        $this->dataAvvio            = $dto->dataAvvio;
        $this->dataFine             = $dto->dataFine;
        $this->importo              = $dto->importo;
        $this->numeroGiorniPrevisti = $dto->numeroGiorniPrevisti;
        $this->loaded               = true;
    }
};
