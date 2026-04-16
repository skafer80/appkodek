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
            if (mb_strtoupper(trim($modulo->nomeModuli ?? '')) === 'STAGE') {
                continue;
            }

            foreach ($modulo->conoscenze as $conoscenza) {
                $totaleOre += (int) ($conoscenza->oreConoscenza ?? 0);
                $totaleOre += (int) ($conoscenza->oreFadConoscenza ?? 0);
            }
        }

        $valore = (int) round($totaleOre / 2);

        $this->fasciaA = $valore;
        $this->fasciaB = $valore;
        $this->fasciaC = $valore;
        $this->loaded  = true;
    }
};
