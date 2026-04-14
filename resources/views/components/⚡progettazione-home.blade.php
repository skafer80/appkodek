<?php

use Livewire\Component;
use App\Services\ClassiApiService;
use App\Services\StudentiApiService;

new class extends Component {
    public array $enti = [];
    public string $enteSelezionato = '';
    public $classeSelezionata = null;
    public $studenti = [];

    public function mount(ClassiApiService $classiService)
    {
        $this->enti = $classiService->getClassi();
    }

    public function updatedEnteSelezionato(): void
    {
        $this->classeSelezionata = null;
        $this->studenti = [];
    }

    public function updatedClasseSelezionata(StudentiApiService $service): void
    {
        if ($this->classeSelezionata) {
            $classe = $service->getStudenti($this->classeSelezionata);
            $this->studenti = $classe->studenti;
        } else {
            $this->studenti = [];
        }
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
?>

<div>

    <script>
        async function pgCopy(btn, value) {
            const text = (value ?? '').toString();
            const td = btn.closest('td');
            try {
                await navigator.clipboard.writeText(text);
                td.classList.add('pg-cell-copied');
                btn.classList.add('copied');
                btn.querySelector('i').className = 'fa fa-check';
                setTimeout(() => {
                    td.classList.remove('pg-cell-copied');
                    btn.classList.remove('copied');
                    btn.querySelector('i').className = 'fa fa-copy';
                }, 1400);
            } catch {
                alert('Copia non riuscita. Verifica i permessi del browser.');
            }
        }
    </script>

    <div class="pg-wrapper">
        <div class="pg-card">
            <div class="pg-card-header">
                <div>
                    <h1>Allievi per classe</h1>
                    <p class="pg-hint">Seleziona ente e classe per visualizzare gli allievi. Clicca l'icona per copiare un valore.</p>
                </div>
                <div class="pg-selects">
                    <select wire:model.live="enteSelezionato">
                        <option value="">Seleziona ente</option>
                        @foreach ($enti as $ente)
                            <option value="{{ $ente->ente }}">{{ $ente->ente }}</option>
                        @endforeach
                    </select>

                    <select wire:model.live="classeSelezionata" @disabled(!$enteSelezionato)>
                        <option value="">Seleziona classe</option>
                        @foreach ($this->getClassiEnteSelezionato() as $classe)
                            <option value="{{ $classe->id }}">{{ $classe->nome }} – {{ $classe->sede }}</option>
                        @endforeach
                    </select>

                    @if ($studenti)
                        <strong>{{ count($studenti) }} allievi</strong>
                    @endif
                </div>
            </div>

            @if ($studenti)
                <div class="pg-table-wrap">
                    <table class="pg-table">
                        <thead>
                            <tr>
                                <th>Data selezione</th>
                                <th>Nome</th>
                                <th>Cognome</th>
                                <th>Sesso</th>
                                <th>Cat. protetta / Disabilità</th>
                                <th>Data di nascita</th>
                                <th>Prov. nascita</th>
                                <th>Comune nascita</th>
                                <th>Codice fiscale</th>
                                <th>Cittadinanza</th>
                                <th>Prov. residenza</th>
                                <th>Comune residenza</th>
                                <th>Titolo di studio</th>
                                <th>Stato soggetto</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($studenti as $studente)
                                <tr>
                                    <td class="pg-copy-cell">
                                        {{ $studente->data_selezione }}
                                        <button type="button" class="pg-copy-btn" onclick="pgCopy(this, {{ json_encode($studente->data_selezione) }})"><i class="fa fa-copy"></i></button>
                                    </td>
                                    <td class="pg-copy-cell">
                                        {{ $studente->nome }}
                                        <button type="button" class="pg-copy-btn" onclick="pgCopy(this, {{ json_encode($studente->nome) }})"><i class="fa fa-copy"></i></button>
                                    </td>
                                    <td class="pg-copy-cell">
                                        {{ $studente->cognome }}
                                        <button type="button" class="pg-copy-btn" onclick="pgCopy(this, {{ json_encode($studente->cognome) }})"><i class="fa fa-copy"></i></button>
                                    </td>
                                    <td>{{ $studente->sesso }}</td>
                                    <td class="pg-copy-cell">
                                        {{ $studente->categoria_protetta_disabilita }}
                                        <button type="button" class="pg-copy-btn" onclick="pgCopy(this, {{ json_encode($studente->categoria_protetta_disabilita) }})"><i class="fa fa-copy"></i></button>
                                    </td>
                                    <td class="pg-copy-cell">
                                        {{ $studente->data_di_nascita }}
                                        <button type="button" class="pg-copy-btn" onclick="pgCopy(this, {{ json_encode($studente->data_di_nascita) }})"><i class="fa fa-copy"></i></button>
                                    </td>
                                    <td>{{ $studente->prov_nascita }}</td>
                                    <td>{{ $studente->comune_di_nascita }}</td>
                                    <td class="pg-copy-cell">
                                        {{ $studente->codice_fiscale }}
                                        <button type="button" class="pg-copy-btn" onclick="pgCopy(this, {{ json_encode($studente->codice_fiscale) }})"><i class="fa fa-copy"></i></button>
                                    </td>
                                    <td class="pg-copy-cell">
                                        {{ $studente->cittadinanza }}
                                        <button type="button" class="pg-copy-btn" onclick="pgCopy(this, {{ json_encode($studente->cittadinanza) }})"><i class="fa fa-copy"></i></button>
                                    </td>
                                    <td>{{ $studente->prov_residenza }}</td>
                                    <td>{{ $studente->comune_di_residenza }}</td>
                                    <td>{{ $studente->titolo_di_studio }}</td>
                                    <td>{{ $studente->stato_soggetto }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
