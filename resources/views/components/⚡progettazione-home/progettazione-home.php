<?php

use Livewire\Component;
use App\Services\ClassiApiService;

new class extends Component {
    public array $enti = [];
    public string $enteSelezionato = '';
    public $classeSelezionata = null;
    public string $tabAttiva = 'moduli';
    public string $passwordSelettori = '';
    public bool $selettoriSbloccati = false;

    public function mount(ClassiApiService $classiService)
    {
        $this->enti = $classiService->getClassi();
    }

    public function updatedEnteSelezionato(): void
    {
        if (! $this->selettoriSbloccati) {
            $this->enteSelezionato = '';
            return;
        }

        $this->classeSelezionata = null;

        if ($this->tabAttiva !== 'personale') {
            $this->tabAttiva = 'allievi';
        }
    }

    public function updatedClasseSelezionata(): void
    {
        if (! $this->selettoriSbloccati) {
            $this->classeSelezionata = null;
            return;
        }

        $this->tabAttiva = 'allievi';
    }

    public function selezionaTab(string $tab): void
    {
        if (! $this->selettoriSbloccati) {
            return;
        }

        $tabsDisponibili = ['dettagli', 'allievi', 'moduli', 'personale', 'stage'];

        if (!in_array($tab, $tabsDisponibili, true)) {
            return;
        }

        $this->tabAttiva = $tab;
    }

    public function sbloccaSelettori(): void
    {
        if (mb_strtolower(trim($this->passwordSelettori)) !== 'gargarozzo') {
            $this->addError('passwordSelettori', 'Password non valida.');
            return;
        }

        $this->selettoriSbloccati = true;
        $this->passwordSelettori = '';
        $this->resetErrorBag('passwordSelettori');
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
