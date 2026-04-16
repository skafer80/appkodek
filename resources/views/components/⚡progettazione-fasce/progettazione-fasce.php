<?php

use App\Services\ModuliApiService;
use Livewire\Component;

new class extends Component
{
    public $classeSelezionata = null;
    public int $fasciaA = 0;
    public int $fasciaB = 0;
    public int $fasciaC = 0;
    public bool $loaded = false;

    public function mount($classeSelezionata = null, ModuliApiService $service): void
    {
        $this->classeSelezionata = $classeSelezionata;
        $this->caricaDati($service);
    }

    private function caricaDati(ModuliApiService $service): void
    {
        if (! $this->classeSelezionata) {
            $this->loaded = false;
            return;
        }

        $classe = $service->getModuli((int) $this->classeSelezionata);
        $moduli = $classe->moduli ?? [];

        $totaleOre = 0;

        foreach ($moduli as $modulo) {

            foreach ($modulo->conoscenze as $conoscenza) {
                if ($conoscenza->fascia==='A') {
                    $this->fasciaA += $conoscenza->oreConoscenza;
                }
                if ($conoscenza->fascia==='B') {
                    $this->fasciaB += $conoscenza->oreConoscenza;
                }

            }
        }

        $this->loaded  = true;
    }
};
