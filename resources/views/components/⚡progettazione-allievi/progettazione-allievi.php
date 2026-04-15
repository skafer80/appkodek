<?php

use Livewire\Component;
use App\Services\StudentiApiService;

new class extends Component
{
    public $classeSelezionata = null;
    public array $studenti = [];

    public function mount($classeSelezionata = null, StudentiApiService $service): void
    {
        $this->classeSelezionata = $classeSelezionata;
        $this->caricaStudenti($service);
    }

    public function updatedClasseSelezionata(StudentiApiService $service): void
    {
        $this->caricaStudenti($service);
    }

    private function caricaStudenti(StudentiApiService $service): void
    {
        if (!$this->classeSelezionata) {
            $this->studenti = [];

            return;
        }

        $classe = $service->getStudenti($this->classeSelezionata);
        $this->studenti = $classe->studenti ?? [];
    }
};
