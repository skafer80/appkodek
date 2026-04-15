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
                                @disabled(!$classeSelezionata)
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
                </div>
            </div>
        </div>

        @if ($classeSelezionata)
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
                <div class="pg-card" style="margin-top: 12px;">
                    <div style="padding: 16px 20px;">Componente Dettagli in preparazione.</div>
                </div>
            @elseif ($tabAttiva === 'personale')
                <div class="pg-card" style="margin-top: 12px;">
                    <div style="padding: 16px 20px;">Componente Personale in preparazione.</div>
                </div>
            @elseif ($tabAttiva === 'stage')
                <div class="pg-card" style="margin-top: 12px;">
                    <div style="padding: 16px 20px;">Componente Stage in preparazione.</div>
                </div>
            @endif
        @else
            <div class="pg-card" style="margin-top: 12px;">
                <div style="padding: 16px 20px;">Seleziona una classe per attivare i tab: Dettagli, Allievi, Moduli, Personale e Stage.</div>
            </div>
        @endif
    </div>
</div>
