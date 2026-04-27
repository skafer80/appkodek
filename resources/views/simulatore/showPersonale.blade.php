@extends('layouts.regione')

@section('content')
    <div class="page-content-wrapper">
        <div class="page-content" style="background-color: #f5f5f5!important;">
            @include('simulatore.menuPercorso')
            <hr>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <h4 class="page-title">
                    Progettazione esecutiva - Riferimento Edizione {{ $percorso->nome }}
                </h4>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <table class="table table-bordered table-responsive table-condensed">
                        <tbody>
                            <tr>
                                <td style="width:1%;padding-right:1rem;white-space:nowrap;">Titolo / Denominazione del percorso</td>
                                <td><strong>{{ $percorso->formazione->titolo }}</strong></td>
                            </tr>
                            <tr>
                                <td>Allievi minimi / Allievi massimi:</td>
                                <td><strong>8 / 10</strong></td>
                            </tr>
                            <tr>
                                <td>Allievi disabili inseriti</td>
                                <td><strong class="text-success">0</strong></td>
                            </tr>
                            <tr>
                                <td>Numero massimo allievi disabili</td>
                                <td><strong>2</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <style type="text/css">
                #sample_1_filter {
                    position: absolute;
                    right: 0;
                    margin-top: 0.25rem;
                    margin-right: 3.5rem;
                }
            </style>

            <div class="portlet box red mt-2">
                <div class="portlet-title">
                    <div class="caption">
                        <a href="javascript:void(0)" class="text-white-i underline-off-i">
                            <i class="fa fa-user"></i> Personale non docente
                            (Indicare almeno un soggetto per ruolo)
                        </a>
                    </div>
                </div>
                <div class="portlet-body" id="personale_container">
                    <div class="table-toolbar">
                        @if (! $allRuoliPresenti)
                            <div class="alert alert-warning">
                                Mancano ancora i seguenti ruoli: {{ $ruoliMancanti->implode(', ') }}.
                            </div>
                        @else
                            <div class="alert alert-success">
                                Tutti i ruoli minimi richiesti risultano assegnati.
                            </div>
                        @endif
                    </div>

                    <div class="col-md-12 col-lg-12 col-xs-12 text-right mb-3">
                        <div class="btn-group">
                            <a href="{{ route('simulatore.showCreatePersonale', [$SimulatorPlayer->id, $percorso->id]) }}" class="btn red">
                                <i class="fa fa-plus"></i> Aggiungi personale non docente
                            </a>
                        </div>
                    </div>

                    <table class="table table-striped table-bordered table-hover dataTable" id="sample_1">
                        <thead>
                            <tr>
                                <th>N.</th>
                                <th>Soggetto</th>
                                <th>Ruolo</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($personale as $index => $persona)
                                <tr class="gradeX">
                                    <td>{{ $index + 1 }}</td>
                                    <td class="text-uppercase">
                                        {{ $persona->cognome }} {{ $persona->nome }}<br>
                                        {{ $persona->cf }}<br>
                                        nato il {{ \Carbon\Carbon::parse($persona->data_nascita)->format('d/m/Y') }}
                                    </td>
                                    <td>
                                        {{ $persona->ruolo }}
                                        @if ($persona->esterno)
                                            <br>(Esterno)
                                        @endif
                                    </td>
                                    <td class="text-right">
                                        <a href="{{ route('simulatore.showDettaglioPersonale', [$SimulatorPlayer->id, $percorso->id, $persona->id]) }}" class="btn default red blue">Dettagli</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td>1</td>
                                    <td>Nessun elemento</td>
                                    <td>-</td>
                                    <td></td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        jQuery(document).ready(function() {
            $('#sample_1').dataTable({
                "bPaginate": false,
                "bLengthChange": false,
                "bFilter": true,
                "bSort": true,
                "bInfo": false,
                "bAutoWidth": false,
                "bStateSave": true,
            });
        });
    </script>
@endsection
