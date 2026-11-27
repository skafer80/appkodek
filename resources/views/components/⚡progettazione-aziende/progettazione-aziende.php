<?php

use App\Services\AziendeApiService;
use Livewire\Component;

new class extends Component
{
    public $classeSelezionata = null;
    public array $aziende = [];

    public function mount($classeSelezionata = null, AziendeApiService $service): void
    {
        $this->classeSelezionata = $classeSelezionata;
        $this->caricaAziende($service);
    }

    public function updatedClasseSelezionata(AziendeApiService $service): void
    {
        $this->caricaAziende($service);
    }

    private function caricaAziende(AziendeApiService $service): void
    {
        $this->aziende = $this->classeSelezionata
            ? $service->getAziende((int) $this->classeSelezionata)
            : [];
    }
};
