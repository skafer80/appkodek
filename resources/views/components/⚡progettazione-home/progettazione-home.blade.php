<div>
    <div class="pg-wrapper">
        <div class="pg-card">
            @if ($erroreCaricamento)
                <div class="alert alert-danger" style="margin: 16px;">
                    {{ $erroreCaricamento }}
                </div>
            @endif
            <div class="pg-card-header">
                <div>
                    <h1>Progettazione dati</h1>
                    @if ($this->classeCorrente)
                        <p class="pg-hint" style="margin-top: 4px;">
                            <strong>Ente:</strong> {{ $enteSelezionato }} |
                            <strong>Classe:</strong> {{ $this->classeCorrente->nome }} |
                            <strong>Priorita:</strong> {{ $this->classeCorrente->ordine + 1 }} <br>
                            <strong>Sede:</strong> {{ $this->classeCorrente->sede }} <br>
                            <strong>Descrizione:</strong> {{ $this->classeCorrente->descrizione ?: '-' }}
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
                                            – {{ $classe->sede }} - {{ $classe->descrizione }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>

                    <ul class="nav nav-tabs pg-tabs-row">
                        <li class="nav-item">
                            <button type="button"
                                class="nav-link py-1 px-2 {{ $tabAttiva === 'allievi' ? 'active' : '' }}"
                                wire:click="selezionaTab('allievi')" @disabled(!$classeSelezionata)>
                                Allievi
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button"
                                class="nav-link py-1 px-2 {{ $tabAttiva === 'aziende' ? 'active' : '' }}"
                                wire:click="selezionaTab('aziende')" @disabled(!$classeSelezionata)>
                                Aziende
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        @if ($classeSelezionata)
            @if ($tabAttiva === 'allievi')
                <livewire:progettazione-allievi :classe-selezionata="$classeSelezionata" :key="'progettazione-allievi-' . ($classeSelezionata ?: 'none')" />
            @elseif ($tabAttiva === 'aziende')
                <livewire:progettazione-aziende :classe-selezionata="$classeSelezionata" :key="'progettazione-aziende-' . ($classeSelezionata ?: 'none')" />
            @endif
        @else
            <div class="pg-card" style="margin-top: 12px;">
                <div style="padding: 16px 20px;">Seleziona una classe per visualizzare Allievi e Aziende.</div>
            </div>
        @endif
    </div>
</div>
