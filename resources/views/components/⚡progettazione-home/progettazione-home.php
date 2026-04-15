<?php

use Livewire\Component;
use App\Services\ClassiApiService;

new class extends Component {
    public array $enti = [];
    public string $enteSelezionato = '';
    public $classeSelezionata = null;
    public string $tabAttiva = 'allievi';

    public function mount(ClassiApiService $classiService)
    {
        $this->enti = $classiService->getClassi();
    }

    public function updatedEnteSelezionato(): void
    {
        $this->classeSelezionata = null;
        $this->tabAttiva = 'allievi';
    }

    public function updatedClasseSelezionata(): void
    {
        $this->tabAttiva = 'allievi';
    }

    public function selezionaTab(string $tab): void
    {
        $tabsDisponibili = ['dettagli', 'allievi', 'moduli', 'personale', 'stage'];

        if (!in_array($tab, $tabsDisponibili, true)) {
            return;
        }

        $this->tabAttiva = $tab;
    }

    public function getClassiEnteSelezionato(): array
    {
        if (!$this->enteSelezionato) {
            return [];
        }

        $ente = collect($this->enti)->first(fn ($e) => $e->ente === $this->enteSelezionato);

        return $ente ? $ente->classi : [];
    }
};
