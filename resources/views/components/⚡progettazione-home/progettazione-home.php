<?php

use Livewire\Component;
use App\Services\ClassiApiService;

new class extends Component {
    public array $enti = [];
    public string $enteSelezionato = '';
    public $classeSelezionata = null;
    public string $tabAttiva = 'allievi';
    public string $passwordSelettori = '';
    public bool $selettoriSbloccati = true;
    public ?string $erroreCaricamento = null;

    public function mount(ClassiApiService $classiService)
    {
        try {
            $this->enti = $classiService->getClassi();
        } catch (\Throwable $e) {
            report($e);
            $this->enti = [];
            $this->erroreCaricamento = $e->getMessage();
        }

    }

    public function updatedEnteSelezionato(): void
    {
        if (! $this->selettoriSbloccati) {
            $this->enteSelezionato = '';
            return;
        }

        $this->classeSelezionata = null;

        $this->tabAttiva = 'allievi';
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

        $tabsDisponibili = ['allievi', 'aziende'];

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

    public function getClasseCorrenteProperty()
    {
        return collect($this->getClassiEnteSelezionato())->first(
            fn ($classe) => (string) $classe->id === (string) $this->classeSelezionata,
        );
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
