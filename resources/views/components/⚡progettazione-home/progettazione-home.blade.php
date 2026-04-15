<div>
    <div class="pg-wrapper">
        <div class="pg-card">
            <div class="pg-card-header">
                <div>
                    <h1>Progettazione dati</h1>
                    <p class="pg-hint">Seleziona ente e classe, poi scegli il tab da visualizzare.</p>
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

                    <ul class="nav nav-tabs" style="border-bottom: 0; gap: 6px; margin: 0;">
                        <li class="nav-item">
                            <button
                                type="button"
                                class="nav-link py-1 px-2 {{ $tabAttiva === 'dettagli' ? 'active' : '' }}"
                                wire:click="selezionaTab('dettagli')"
                                @disabled(!$classeSelezionata)
                            >
                                Dettagli
                            </button>
                        </li>
                        <li class="nav-item">
                            <button
                                type="button"
                                class="nav-link py-1 px-2 {{ $tabAttiva === 'allievi' ? 'active' : '' }}"
                                wire:click="selezionaTab('allievi')"
                                @disabled(!$classeSelezionata)
                            >
                                Allievi
                            </button>
                        </li>
                        <li class="nav-item">
                            <button
                                type="button"
                                class="nav-link py-1 px-2 {{ $tabAttiva === 'moduli' ? 'active' : '' }}"
                                wire:click="selezionaTab('moduli')"
                                @disabled(!$classeSelezionata)
                            >
                                Moduli
                            </button>
                        </li>
                        <li class="nav-item">
                            <button
                                type="button"
                                class="nav-link py-1 px-2 {{ $tabAttiva === 'personale' ? 'active' : '' }}"
                                wire:click="selezionaTab('personale')"
                                @disabled(!$enteSelezionato)
                            >
                                Personale
                            </button>
                        </li>
                        <li class="nav-item">
                            <button
                                type="button"
                                class="nav-link py-1 px-2 {{ $tabAttiva === 'stage' ? 'active' : '' }}"
                                wire:click="selezionaTab('stage')"
                                @disabled(!$classeSelezionata)
                            >
                                Stage
                            </button>
                        </li>
                    </ul>

                    @if ($classeSelezionata)
                        <a
                            href="{{ route('progettazione.stampa', ['classeId' => $classeSelezionata]) }}"
                            target="_blank"
                            class="btn btn-outline-secondary btn-sm"
                            title="Apri versione stampabile della classe"
                        >
                            <i class="fa fa-print"></i> Stampa classe
                        </a>
                    @else
                        <button type="button" class="btn btn-outline-secondary btn-sm" disabled>
                            <i class="fa fa-print"></i> Stampa classe
                        </button>
                    @endif
                </div>
            </div>
        </div>

        @if ($tabAttiva === 'personale')
            <livewire:progettazione-personale
                :ente-selezionato="$enteSelezionato"
                :key="'progettazione-personale-' . ($enteSelezionato ?: 'none')"
            />
        @elseif ($classeSelezionata)
            @if ($tabAttiva === 'allievi')
                <livewire:progettazione-allievi
                    :classe-selezionata="$classeSelezionata"
                    :key="'progettazione-allievi-' . ($classeSelezionata ?: 'none')"
                />
            @elseif ($tabAttiva === 'moduli')
                <livewire:progettazione-moduli
                    :classe-selezionata="$classeSelezionata"
                    :key="'progettazione-moduli-' . ($classeSelezionata ?: 'none')"
                />
            @elseif ($tabAttiva === 'dettagli')
                <livewire:progettazione-dettagli
                    :classe-selezionata="$classeSelezionata"
                    :key="'progettazione-dettagli-' . ($classeSelezionata ?: 'none')"
                />
            @elseif ($tabAttiva === 'stage')
                <livewire:progettazione-stage
                    :classe-selezionata="$classeSelezionata"
                    :key="'progettazione-stage-' . ($classeSelezionata ?: 'none')"
                />
            @endif
        @else
            <div class="pg-card" style="margin-top: 12px;">
                <div style="padding: 16px 20px;">Seleziona una classe per attivare i tab: Dettagli, Allievi, Moduli e Stage. Per il tab Personale basta selezionare l'ente.</div>
            </div>
        @endif
    </div>
</div>
