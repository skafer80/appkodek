<?php

use App\Services\ModuliApiService;
use Livewire\Component;

new class extends Component
{
    public $classeSelezionata = null;
    public ?string $classeId = null;
    public array $moduli = [];

    public function mount($classeSelezionata = null, ModuliApiService $service): void
    {
        $this->classeSelezionata = $classeSelezionata;
        $this->caricaModuli($service);
    }

    public function updatedClasseSelezionata(ModuliApiService $service): void
    {
        $this->caricaModuli($service);
    }

    private function caricaModuli(ModuliApiService $service): void
    {
        if (!$this->classeSelezionata) {
            $this->classeId = null;
            $this->moduli = [];

            return;
        }

        $classe = $service->getModuli((int) $this->classeSelezionata);

        $this->classeId = $classe->classeId;
        $this->moduli = $classe->moduli ?? [];
    }
};
