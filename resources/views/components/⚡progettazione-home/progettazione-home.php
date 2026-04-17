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
            $this->tabAttiva = 'personale';
        }
    }

    public function updatedClasseSelezionata(): void
    {
        if (! $this->selettoriSbloccati) {
            $this->classeSelezionata = null;
            return;
        }

        $this->tabAttiva = 'moduli';
    }

    public function selezionaTab(string $tab): void
    {
        if (! $this->selettoriSbloccati) {
            return;
        }

        $tabsDisponibili = ['dettagli', 'allievi', 'moduli', 'personale', 'stage', 'fasce'];

        if (!in_array($tab, $tabsDisponibili, true)) {
            return;
        }

        $this->tabAttiva = $tab;
    }

    public function sbloccaSelettori(): void
    {
        if (! hash_equals($this->getPasswordSelettoriAttesa(), trim($this->passwordSelettori))) {
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

    private function getPasswordSelettoriAttesa(): string
    {
        $modalitaFake = (bool) session('fake_api_mode', false);
        $servicesConfig = (array) config('services', []);
        $config = (array) ($servicesConfig['progettazione'] ?? []);

        return $modalitaFake
            ? (string) ($config['password_fake'] ?? 'prova')
            : (string) ($config['password_reale'] ?? 'pappagallo');
    }
};
