<div>
    <div class="pg-wrapper">
        <div class="pg-card">
            <div class="pg-card-header">
                <div>

                    @php
                        $classeCorrente = collect($this->getClassiEnteSelezionato())->first(
                            fn($classe) => (string) $classe->id === (string) $this->classeSelezionata,
                        );
                    @endphp

                    <h1>Progettazione dati</h1>
                    @if ($classeCorrente)
                        <p class="pg-hint" style="margin-top: 4px;">
                            <strong>Ente:</strong> {{ $enteSelezionato }} |
                            <strong>Classe:</strong> {{ $classeCorrente->nome }} |
                            <strong>Priorita:</strong> {{ $classeCorrente->ordine + 1 }} |
                            <strong>Sede:</strong> {{ $classeCorrente->sede }} |
                            <strong>Descrizione:</strong> {{ $classeCorrente->descrizione ?: '-' }}
                        </p>
                    @else
                        <p class="pg-hint">Seleziona ente e classe, poi scegli il tab da visualizzare.</p>
                    @endif
                </div>
                <div class="pg-toolbar">
                    @if (! $selettoriSbloccati)
                        <div class="pg-card" style="margin: 0 0 12px;">
                            <div style="padding: 12px 16px; display: flex; gap: 8px; align-items: center; flex-wrap: wrap;">
                                <label for="password-selettori" class="pg-control-label" style="margin: 0;">Password</label>
                                <input
                                    id="password-selettori"
                                    type="password"
                                    wire:model.live="passwordSelettori"
                                    class="form-control form-control-sm"
                                    style="max-width: 220px;"
                                    placeholder="Inserisci password"
                                >
                                <button type="button" class="btn btn-primary btn-sm" wire:click="sbloccaSelettori">
                                    Sblocca selettori
                                </button>
                                @error('passwordSelettori')
                                    <span style="color: #b42318; font-size: 0.85rem;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    @endif

                    <div class="pg-controls-row">
                        <div class="pg-selects pg-selects-compact">
                            <div class="pg-control-block">
                                <label class="pg-control-label">Ente</label>
                                <select wire:model.live="enteSelezionato" @disabled(! $selettoriSbloccati)>
                                    <option value="">Seleziona ente</option>
                                    @foreach ($enti as $ente)
                                        <option value="{{ $ente->ente }}">{{ $ente->ente }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="pg-control-block">
                                <label class="pg-control-label">Classe</label>
                                <select wire:model.live="classeSelezionata" @disabled(! $selettoriSbloccati || ! $enteSelezionato)>
                                    <option value="">Seleziona classe</option>
                                    @foreach ($this->getClassiEnteSelezionato() as $classe)
                                        <option value="{{ $classe->id }}">{{ $loop->iteration }}. {{ $classe->nome }}
                                            – {{ $classe->sede }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="pg-print-wrap">
                            @if ($classeSelezionata)
                                <a href="{{ route('progettazione.stampa', ['classeId' => $classeSelezionata]) }}"
                                    target="_blank" class="btn btn-outline-secondary btn-sm"
                                    title="Apri versione stampabile della classe">
                                    <i class="fa fa-print"></i> Stampa classe
                                </a>
                            @else
                                <button type="button" class="btn btn-outline-secondary btn-sm" disabled>
                                    <i class="fa fa-print"></i> Stampa classe
                                </button>
                            @endif
                        </div>
                    </div>

                    <ul class="nav nav-tabs pg-tabs-row">
                        <li class="nav-item">
                            <button type="button"
                                class="nav-link py-1 px-2 {{ $tabAttiva === 'moduli' ? 'active' : '' }}"
                                wire:click="selezionaTab('moduli')" @disabled(!$classeSelezionata)>
                                Moduli
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button"
                                class="nav-link py-1 px-2 {{ $tabAttiva === 'dettagli' ? 'active' : '' }}"
                                wire:click="selezionaTab('dettagli')" @disabled(!$classeSelezionata)>
                                Dettagli
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button"
                                class="nav-link py-1 px-2 {{ $tabAttiva === 'allievi' ? 'active' : '' }}"
                                wire:click="selezionaTab('allievi')" @disabled(!$classeSelezionata)>
                                Allievi
                            </button>
                        </li>

                        <li class="nav-item">
                            <button type="button"
                                class="nav-link py-1 px-2 {{ $tabAttiva === 'personale' ? 'active' : '' }}"
                                wire:click="selezionaTab('personale')" @disabled(!$enteSelezionato)>
                                Personale
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button"
                                class="nav-link py-1 px-2 {{ $tabAttiva === 'stage' ? 'active' : '' }}"
                                wire:click="selezionaTab('stage')" @disabled(!$classeSelezionata)>
                                Stage
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        @if ($tabAttiva === 'personale')
            <livewire:progettazione-personale :ente-selezionato="$enteSelezionato" :key="'progettazione-personale-' . ($enteSelezionato ?: 'none')" />
        @elseif ($classeSelezionata)
            @if ($tabAttiva === 'allievi')
                <livewire:progettazione-allievi :classe-selezionata="$classeSelezionata" :key="'progettazione-allievi-' . ($classeSelezionata ?: 'none')" />
            @elseif ($tabAttiva === 'moduli')
                <livewire:progettazione-moduli :classe-selezionata="$classeSelezionata" :key="'progettazione-moduli-' . ($classeSelezionata ?: 'none')" />
            @elseif ($tabAttiva === 'dettagli')
                <livewire:progettazione-dettagli :classe-selezionata="$classeSelezionata" :key="'progettazione-dettagli-' . ($classeSelezionata ?: 'none')" />
            @elseif ($tabAttiva === 'stage')
                <livewire:progettazione-stage :classe-selezionata="$classeSelezionata" :key="'progettazione-stage-' . ($classeSelezionata ?: 'none')" />
            @endif
        @else
            <div class="pg-card" style="margin-top: 12px;">
                <div style="padding: 16px 20px;">Seleziona una classe per attivare i tab: Dettagli, Allievi, Moduli e
                    Stage. Per il tab Personale basta selezionare l'ente.</div>
            </div>
        @endif
    </div>
</div>
