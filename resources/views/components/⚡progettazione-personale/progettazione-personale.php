<?php

use App\Services\PersonaleApiService;
use Livewire\Component;

new class extends Component
{
    public string $enteSelezionato = '';
    public array $personale = [];

    public function mount($enteSelezionato = '', PersonaleApiService $service): void
    {
        $this->enteSelezionato = (string) $enteSelezionato;
        $this->caricaPersonale($service);
    }

    public function updatedEnteSelezionato(PersonaleApiService $service): void
    {
        $this->caricaPersonale($service);
    }

    private function caricaPersonale(PersonaleApiService $service): void
    {
        if (!$this->enteSelezionato) {
            $this->personale = [];

            return;
        }

        $ente = $service->getPersonaleByEnte($this->enteSelezionato);
        $this->personale = $ente->personale ?? [];
    }
};
