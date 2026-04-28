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
                                <td><strong>{{ $minimoRichiesto }} / {{ $massimoConsentito }}</strong></td>
                            </tr>
                            <tr>
                                <td>Allievi disabili inseriti</td>
                                <td><strong class="text-success">{{ $partecipanti->where('b_disabile', true)->count() }}</strong></td>
                            </tr>
                            <tr>
                                <td>Numero massimo allievi disabili</td>
                                <td><strong>2</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12">
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption"><i class="fa fa-child"></i> Elenco destinatari iscritti al percorso formativo</div>
                        </div>

                        <div class="portlet-body">
                            <div class="table-toolbar">
                                @if ($partecipanti->count() < $minimoRichiesto)
                                    <div class="warning">Non e stato raggiunto il numero minimo di destinatari verificati necessari: {{ $minimoRichiesto }}</div>
                                @else
                                    <div class="alert alert-success">E stato raggiunto il numero minimo di destinatari verificati.</div>
                                @endif
                                <br>
                                <div class="col-md-6 col-lg-6 col-xs-12">
                                    <p>Destinatari iscritti verificati {{ $partecipanti->count() }}</p>
                                </div>

                                <div class="col-md-6 col-lg-6 col-xs-12 text-right">
                                    @if ($partecipanti->count() < $massimoConsentito)
                                        <a href="{{ route('simulatore.showCreatePartecipante', [$SimulatorPlayer->id, $percorso->id]) }}" class="btn default blue">
                                            <span class="glyphicon glyphicon-plus"></span>
                                            Destinatario
                                        </a>
                                    @endif
                                </div>
                                <br><br>

                                @if ($partecipanti->isEmpty())
                                    Nessun valore in lista
                                @else
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>N.</th>
                                                <th>Codice Fiscale</th>
                                                <th>Stato soggetto</th>
                                                <th>Disabile/Categoria protetta</th>
                                                <th>Provincia</th>
                                                <th>&nbsp;</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($partecipanti as $index => $partecipante)
                                                <tr class="odd gradeX">
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $partecipante->t_codice_fiscale }}</td>
                                                    <td>{{ $partecipante->stato_soggetto_label }}</td>
                                                    <td>{{ $partecipante->b_disabile ? 'Si' : 'No' }}</td>
                                                    <td>{{ $partecipante->t_r_provincia }}</td>
                                                    <td class="text-right">
                                                        <a href="{{ route('simulatore.showDettaglioPartecipante', [$SimulatorPlayer->id, $percorso->id, $partecipante->id]) }}" class="btn btn-default green">
                                                            <span class="glyphicon glyphicon-pencil"></span>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
