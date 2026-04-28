@extends('layouts.regione')

@section('content')
    <div class="page-content-wrapper">
        <div class="page-content" style="background-color: #f5f5f5!important;">
            @include('simulatore.menuPercorso')
            <hr>

            <a href="{{ route('simulatore.showDettagliPercorso', [$SimulatorPlayer->id, $percorso->id]) }}"
                class="d-inline-block mb-5 p-2 bg-blue underline-off-i">
                <i class="fa fa-long-arrow-left" aria-hidden="true"></i>&nbsp;Indietro
            </a>

            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-check"></i>
                        Verifica e Conferma Progettazione Esecutiva &mdash; Riferimento Percorso {{ $percorso->nome }}
                    </div>
                </div>

                <div class="portlet-body">

                    @if ($verificaOk)
                        <div class="alert alert-success text-center">
                            <i class="fa fa-check-circle fa-2x"></i>
                            <br><strong>Verifica superata!</strong><br>
                            Tutti i controlli sulla P.E. sono stati completati correttamente.
                        </div>
                        <div class="alert alert-info text-center mt-2">
                            <i class="fa fa-clock-o me-1"></i>
                            <strong>Inizio simulazione:</strong>
                            {{ $SimulatorPlayer->start_time ? $SimulatorPlayer->start_time->format('d/m/Y H:i:s') : '—' }}
                            &nbsp;&nbsp;&nbsp;
                            <i class="fa fa-flag-checkered me-1"></i>
                            <strong>Verifica completata:</strong>
                            {{ $SimulatorPlayer->end_time ? $SimulatorPlayer->end_time->format('d/m/Y H:i:s') : '—' }}
                        </div>
                    @endif

                    <div id="esito_verifica" class="mb-3">
                        <ul class="list-group">
                            @foreach ($controlli as $blocco)
                                <li class="list-group-item bg-grey-light-i">
                                    @if ($blocco['ok'])
                                        <i class="fa fa-check-circle me-2 text-success"></i>
                                        <a class="text-success underline-off-i" href="javascript:void(null);"
                                            onclick="
                                                $('.section-errors').addClass('d-none');
                                                $(this).parent().next().removeClass('d-none');
                                            ">
                                            {{ $blocco['sezione'] }}
                                        </a>
                                    @else
                                        <i class="fa fa-list me-2 text-danger"></i>
                                        <a class="text-danger underline-off-i" href="javascript:void(null);"
                                            onclick="
                                                $('.section-errors').addClass('d-none');
                                                $(this).parent().next().removeClass('d-none');
                                            ">
                                            {{ $blocco['sezione'] }}
                                        </a>
                                    @endif
                                    <a href="{{ $blocco['route'] }}" class="float-right text-warning underline-off-i">
                                        {{ $blocco['link_label'] }}
                                    </a>
                                </li>
                                @if ($blocco['ok'])
                                    <li class="section-errors list-group-item d-none">
                                        <ul class="list-group mb-0">
                                            <li class="list-group-item">
                                                <b class="text-success"><i class="fa fa-check me-1"></i></b>
                                                &nbsp;Controllo superato
                                            </li>
                                        </ul>
                                    </li>
                                @else
                                    <li class="section-errors list-group-item d-none">
                                        <ul class="list-group mb-0">
                                            @foreach ($blocco['errori'] as $errore)
                                                <li class="list-group-item">
                                                    <b class="text-danger"><i class="fa fa-times me-1"></i></b>
                                                    &nbsp;{{ $errore }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>

                    <p class="text-center mt-3">
                        <a href="{{ route('simulatore.showVerifica', [$SimulatorPlayer->id, $percorso->id]) }}"
                            class="mx-auto btn btn-primary">
                            <i class="fa fa-refresh"></i> AVVIA VERIFICA
                        </a>
                    </p>

                </div>
            </div>

        </div>
    </div>
@endsection
