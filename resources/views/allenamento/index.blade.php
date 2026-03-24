{{-- resources/views/gioco/index.blade.php --}}
@extends('layouts.layoutClick') {{-- o il layout che stai usando --}}

@section('title', 'Carica Dati & Classifica')

@section('content')
    <div class="container py-5">
        <h1 class="text-center mb-4">Benvenuti su Allenamento Click</h1>

        {{-- Form per creare un player --}}
        <div class="row justify-content-center mb-5">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card shadow-lg border-0 rounded-4">
                        <div class="card-body p-4">
                            <h5 class="card-title text-primary mb-3">
                                <i class="bi bi-play-circle-fill"></i> Inizio Allenamento
                            </h5>
                            <p class="card-text">
                                <strong>Appena clicchi su “Inizio Allenamento”, il timer parte.</strong>
                            </p>
                            <ul class="list-group list-group-flush mb-3">
                                <li class="list-group-item">
                                    <span class="fw-bold text-success">Modalità Allievo:</span>
                                    inserisci <strong>15 allievi</strong> nel minor tempo possibile.
                                </li>
                                <li class="list-group-item">
                                    <span class="text-danger">Assicurati di avere tutti i dati da caricare pronti prima di
                                        iniziare. Per non perdere tempo</span>
                                </li>
                            </ul>
                            <form action="{{ route('allenamento.store') }}" method="POST">
                                @csrf
                                <div class="mb-3 bg-warning p-3 rounded">
                                    <div class="mb-3">
                                        <label for="nome" class="form-label">Nome Partecipante</label>
                                        <input type="text" name="nome" id="nome"
                                            class="form-control @error('nome') is-invalid @enderror"
                                            placeholder="Inserisci il nome">
                                        @error('nome')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="tipo" class="form-label">Selezione tipo di allenamento</label>
                                        <select name="tipo" id="tipo"
                                            class="form-select @error('tipo') is-invalid @enderror">
                                            <option value="0" selected>Allievi</option>
                                            <option value="1" {{ old('tipo') == '1' ? 'selected' : '' }}>Moduli</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-success">Inizio Allenamento</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        {{--

    @if ($players->count() < 15)
        <div class="row justify-content-center mb-4">
            <div class="col-md-6 text-center">
                <div class="alert alert-info">
                    Attualmente ci sono <strong>{{ $players->count() }}</strong> allievi. Quando arriveremo a 15, calcoleremo il tempo!
                </div>
            </div>
        </div>
    @endif --}}

        {{-- Classifiche con Tab --}}
        <div class="row">
            <div class="col-md-12">
                <h2 class="mb-3">Classifiche Allenamento</h2>

                {{-- Navigation tabs --}}
                <ul class="nav nav-tabs" id="classificaTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="allievi-tab" data-bs-toggle="tab"
                            data-bs-target="#allievi-tab-pane" type="button" role="tab"
                            aria-controls="allievi-tab-pane" aria-selected="true">
                            <i class="fa-solid fa-users"></i> Classifica Allievi
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="moduli-tab" data-bs-toggle="tab" data-bs-target="#moduli-tab-pane"
                            type="button" role="tab" aria-controls="moduli-tab-pane" aria-selected="false">
                            <i class="fa-solid fa-book"></i> Classifica Moduli
                        </button>
                    </li>
                </ul>

                {{-- Tab content --}}
                <div class="tab-content" id="classificaTabsContent">
                    {{-- Tab Allievi --}}
                    <div class="tab-pane fade show active" id="allievi-tab-pane" role="tabpanel"
                        aria-labelledby="allievi-tab" tabindex="0">
                        <div class="mt-3">
                            @php
                                // Raggruppa per giorni e mantieni l'ordine cronologico inverso (più recente prima)
$giocatePerGiorno = $giocate->groupBy(function ($item) {
    return $item->start_time ? $item->start_time->format('d/m/Y') : 'Senza data';
                                });
                            @endphp

                            @forelse($giocatePerGiorno as $giorno => $giocateDelGiorno)
                                @if ($loop->first)
                                    {{-- Primo accordion (più recente) - aperto di default --}}
                                    <div class="accordion mb-4" id="accordionClassificaAllievi">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingAllievi{{ $loop->iteration }}">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#collapseAllievi{{ $loop->iteration }}"
                                                    aria-expanded="true"
                                                    aria-controls="collapseAllievi{{ $loop->iteration }}">
                                                    <strong>{{ $giorno }}</strong>
                                                    <span class="badge bg-primary ms-2">{{ $giocateDelGiorno->count() }}
                                                        Allenamenti</span>
                                                    @php
                                                        $tempoMedio = $giocateDelGiorno
                                                            ->where('software', 0)
                                                            ->whereNotNull('tempo')
                                                            ->avg('tempo');
                                                    @endphp
                                                    @if ($tempoMedio)
                                                        <span class="badge bg-success ms-2">Media:
                                                            {{ floor($tempoMedio / 60) }}:{{ str_pad($tempoMedio % 60, 2, '0', STR_PAD_LEFT) }}</span>
                                                    @endif
                                                </button>
                                            </h2>
                                            <div id="collapseAllievi{{ $loop->iteration }}"
                                                class="accordion-collapse collapse show"
                                                aria-labelledby="headingAllievi{{ $loop->iteration }}"
                                                data-bs-parent="#accordionClassificaAllievi">
                                                <div class="accordion-body p-0">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-hover align-middle mb-0">
                                                            <thead class="table-dark">
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Nome</th>
                                                                    <th>Inizio</th>
                                                                    <th>Fine</th>
                                                                    <th>Tempo</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($giocateDelGiorno->sortBy('tempo') as $giocata)
                                                                    <tr>
                                                                        <td>{{ $loop->iteration }}
                                                                            @if ($loop->iteration === 1)
                                                                                <span class="fa-solid fa-trophy"
                                                                                    style="color: gold;"></span>
                                                                            @endif
                                                                            @if ($loop->iteration === 2)
                                                                                <span class="fa-solid fa-trophy"
                                                                                    style="color: silver;"></span>
                                                                            @endif
                                                                            @if ($loop->iteration === 3)
                                                                                <span class="fa-solid fa-trophy"
                                                                                    style="color: bronze;"></span>
                                                                            @endif
                                                                        </td>
                                                                        <td><a href="{{ route('allenamento.showClasse', ['id' => $giocata->id]) }}">{{ $giocata->nome }}</a>
                                                                            @if ($giocata->software === 1)
                                                                                <span class="fa-solid fa-plane"
                                                                                    style="color: bronze;"></span>
                                                                            @endif
                                                                        </td>
                                                                        <td>{{ $giocata->start_time ? $giocata->start_time->format('H:i:s') : '-' }}
                                                                        </td>
                                                                        <td>{{ $giocata->end_time ? $giocata->end_time->format('H:i:s') : '-' }}
                                                                        </td>
                                                                        <td>
                                                                            @if ($giocata->start_time && $giocata->end_time)
                                                                                {{ floor($giocata->tempo / 60) }} minuti e
                                                                                {{ $giocata->tempo % 60 }} secondi
                                                                            @else
                                                                                —
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        {{-- Altri accordion - chiusi di default --}}
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingAllievi{{ $loop->iteration }}">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#collapseAllievi{{ $loop->iteration }}"
                                                    aria-expanded="false"
                                                    aria-controls="collapseAllievi{{ $loop->iteration }}">
                                                    <strong>{{ $giorno }}</strong>
                                                    <span class="badge bg-primary ms-2">{{ $giocateDelGiorno->count() }}
                                                        Allenamenti</span>
                                                    @php
                                                        $tempoMedio = $giocateDelGiorno
                                                            ->whereNotNull('tempo')
                                                            ->avg('tempo');
                                                    @endphp
                                                    @if ($tempoMedio)
                                                        <span class="badge bg-success ms-2">Media:
                                                            {{ floor($tempoMedio / 60) }}:{{ str_pad($tempoMedio % 60, 2, '0', STR_PAD_LEFT) }}</span>
                                                    @endif
                                                </button>
                                            </h2>
                                            <div id="collapseAllievi{{ $loop->iteration }}"
                                                class="accordion-collapse collapse"
                                                aria-labelledby="headingAllievi{{ $loop->iteration }}"
                                                data-bs-parent="#accordionClassificaAllievi">
                                                <div class="accordion-body p-0">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-hover align-middle mb-0">
                                                            <thead class="table-dark">
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Nome</th>
                                                                    <th>Inizio</th>
                                                                    <th>Fine</th>
                                                                    <th>Tempo</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($giocateDelGiorno->sortBy('tempo') as $giocata)
                                                                    <tr>
                                                                        <td>{{ $loop->iteration }}
                                                                            @if ($loop->iteration === 1)
                                                                                <span class="fa-solid fa-trophy"
                                                                                    style="color: gold;"></span>
                                                                            @endif
                                                                            @if ($loop->iteration === 2)
                                                                                <span class="fa-solid fa-trophy"
                                                                                    style="color: silver;"></span>
                                                                            @endif
                                                                            @if ($loop->iteration === 3)
                                                                                <span class="fa-solid fa-trophy"
                                                                                    style="color: bronze;"></span>
                                                                            @endif
                                                                        </td>
                                                                        <td>{{ $giocata->nome }}
                                                                            @if ($giocata->software === 1)
                                                                                <span class="fa-solid fa-plane"
                                                                                    style="color: bronze;"></span>
                                                                            @endif
                                                                        </td>
                                                                        <td>{{ $giocata->start_time ? $giocata->start_time->format('H:i:s') : '-' }}
                                                                        </td>
                                                                        <td>{{ $giocata->end_time ? $giocata->end_time->format('H:i:s') : '-' }}
                                                                        </td>
                                                                        <td>
                                                                            @if ($giocata->start_time && $giocata->end_time)
                                                                                {{ floor($giocata->tempo / 60) }} minuti e
                                                                                {{ $giocata->tempo % 60 }} secondi
                                                                            @else
                                                                                —
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                @endif

                                @if ($loop->last)
                        </div> {{-- Chiude accordion --}}
                        @endif
                    @empty
                        <div class="alert alert-info text-center">
                            <i class="fa-solid fa-info-circle"></i> Nessun tempo registrato per gli allievi.
                        </div>
                        @endforelse
                    </div>
                </div>

                {{-- Tab Moduli --}}
                <div class="tab-pane fade" id="moduli-tab-pane" role="tabpanel" aria-labelledby="moduli-tab"
                    tabindex="0">
                    <div class="mt-3">
                        @php
                            // Raggruppa per giorni e mantieni l'ordine cronologico inverso (più recente prima)
$giocatePerGiornoModuli = $giocateModuli->groupBy(function ($item) {
    return $item->start_time ? $item->start_time->format('d/m/Y') : 'Senza data';
                            });
                        @endphp

                        @forelse($giocatePerGiornoModuli as $giorno => $giocateDelGiorno)
                            @if ($loop->first)
                                {{-- Primo accordion (più recente) - aperto di default --}}
                                <div class="accordion mb-4" id="accordionClassificaModuli">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingModuli{{ $loop->iteration }}">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapseModuli{{ $loop->iteration }}"
                                                aria-expanded="true"
                                                aria-controls="collapseModuli{{ $loop->iteration }}">
                                                <strong>{{ $giorno }}</strong>
                                                <span class="badge bg-primary ms-2">{{ $giocateDelGiorno->count() }}
                                                    Allenamenti</span>
                                                @php
                                                    $tempoMedio = $giocateDelGiorno
                                                        ->where('software', 0)
                                                        ->whereNotNull('tempo')
                                                        ->avg('tempo');
                                                @endphp
                                                @if ($tempoMedio)
                                                    <span class="badge bg-success ms-2">Media:
                                                        {{ floor($tempoMedio / 60) }}:{{ str_pad($tempoMedio % 60, 2, '0', STR_PAD_LEFT) }}</span>
                                                @endif
                                            </button>
                                        </h2>
                                        <div id="collapseModuli{{ $loop->iteration }}"
                                            class="accordion-collapse collapse show"
                                            aria-labelledby="headingModuli{{ $loop->iteration }}"
                                            data-bs-parent="#accordionClassificaModuli">
                                            <div class="accordion-body p-0">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-hover align-middle mb-0">
                                                        <thead class="table-dark">
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Nome</th>
                                                                <th>Inizio</th>
                                                                <th>Fine</th>
                                                                <th>Tempo</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($giocateDelGiorno->sortBy('tempo') as $giocata)
                                                                <tr>
                                                                    <td>{{ $loop->iteration }}
                                                                        @if ($loop->iteration === 1)
                                                                            <span class="fa-solid fa-trophy"
                                                                                style="color: gold;"></span>
                                                                        @endif
                                                                        @if ($loop->iteration === 2)
                                                                            <span class="fa-solid fa-trophy"
                                                                                style="color: silver;"></span>
                                                                        @endif
                                                                        @if ($loop->iteration === 3)
                                                                            <span class="fa-solid fa-trophy"
                                                                                style="color: bronze;"></span>
                                                                        @endif
                                                                    </td>
                                                                    <td>{{ $giocata->nome }}
                                                                        @if ($giocata->software === 1)
                                                                            <span class="fa-solid fa-plane"
                                                                                style="color: bronze;"></span>
                                                                        @endif
                                                                    </td>
                                                                    <td>{{ $giocata->start_time ? $giocata->start_time->format('H:i:s') : '-' }}
                                                                    </td>
                                                                    <td>{{ $giocata->end_time ? $giocata->end_time->format('H:i:s') : '-' }}
                                                                    </td>
                                                                    <td>
                                                                        @if ($giocata->start_time && $giocata->end_time)
                                                                            {{ floor($giocata->tempo / 60) }} minuti e
                                                                            {{ $giocata->tempo % 60 }} secondi
                                                                        @else
                                                                            —
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    {{-- Altri accordion - chiusi di default --}}
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingModuli{{ $loop->iteration }}">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse"
                                                data-bs-target="#collapseModuli{{ $loop->iteration }}"
                                                aria-expanded="false"
                                                aria-controls="collapseModuli{{ $loop->iteration }}">
                                                <strong>{{ $giorno }}</strong>
                                                <span class="badge bg-primary ms-2">{{ $giocateDelGiorno->count() }}
                                                    Allenamenti</span>
                                                @php
                                                    $tempoMedio = $giocateDelGiorno
                                                        ->whereNotNull('tempo')
                                                        ->avg('tempo');
                                                @endphp
                                                @if ($tempoMedio)
                                                    <span class="badge bg-success ms-2">Media:
                                                        {{ floor($tempoMedio / 60) }}:{{ str_pad($tempoMedio % 60, 2, '0', STR_PAD_LEFT) }}</span>
                                                @endif
                                            </button>
                                        </h2>
                                        <div id="collapseModuli{{ $loop->iteration }}"
                                            class="accordion-collapse collapse"
                                            aria-labelledby="headingModuli{{ $loop->iteration }}"
                                            data-bs-parent="#accordionClassificaModuli">
                                            <div class="accordion-body p-0">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-hover align-middle mb-0">
                                                        <thead class="table-dark">
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Nome</th>
                                                                <th>Inizio</th>
                                                                <th>Fine</th>
                                                                <th>Tempo</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($giocateDelGiorno->sortBy('tempo') as $giocata)
                                                                <tr>
                                                                    <td>{{ $loop->iteration }}
                                                                        @if ($loop->iteration === 1)
                                                                            <span class="fa-solid fa-trophy"
                                                                                style="color: gold;"></span>
                                                                        @endif
                                                                        @if ($loop->iteration === 2)
                                                                            <span class="fa-solid fa-trophy"
                                                                                style="color: silver;"></span>
                                                                        @endif
                                                                        @if ($loop->iteration === 3)
                                                                            <span class="fa-solid fa-trophy"
                                                                                style="color: bronze;"></span>
                                                                        @endif
                                                                    </td>
                                                                    <td>{{ $giocata->nome }}
                                                                        @if ($giocata->software === 1)
                                                                            <span class="fa-solid fa-plane"
                                                                                style="color: bronze;"></span>
                                                                        @endif
                                                                    </td>
                                                                    <td>{{ $giocata->start_time ? $giocata->start_time->format('H:i:s') : '-' }}
                                                                    </td>
                                                                    <td>{{ $giocata->end_time ? $giocata->end_time->format('H:i:s') : '-' }}
                                                                    </td>
                                                                    <td>
                                                                        @if ($giocata->start_time && $giocata->end_time)
                                                                            {{ floor($giocata->tempo / 60) }} minuti e
                                                                            {{ $giocata->tempo % 60 }} secondi
                                                                        @else
                                                                            —
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            @endif

                            @if ($loop->last)
                    </div> {{-- Chiude accordion --}}
                    @endif
                @empty
                    <div class="alert alert-info text-center">
                        <i class="fa-solid fa-info-circle"></i> Nessun tempo registrato per i moduli.
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
