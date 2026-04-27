@extends('layouts.regione')

@section('content')
    <div class="page-content-wrapper">
        <div class="page-content" style="background-color: #f5f5f5!important;">
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet">
                        <!--BEGIN SAVE MENU -->
                        <div class="portlet-title">



                            <div class="col-md-12 text-center">

                                <a href="{{ route('simulatore.index', $SimulatorPlayer->id) }}"
                                    class="d-block absolute p-2 bg-blue underline-off-i"><i class="fa fa-long-arrow-left" "="" aria-hidden=" true"></i>&nbsp;Indietro</a>

                                <h2> Progettazione Esecutiva </h2>


                                <h3> Istanza di inserimento al Catalogo
                                    Id: 189&nbsp;
                                    Titolo: POC BRISKET 2026
                                </h3>
                            </div>
                        </div>
                        <!--END SAVE MENU -->
                        <!--BEGIN EDIT FORM -->
                        <div class="portlet-body">
                            <div class="col-md-12">
                                <p>
                                DI SEGUITO È POSSIBILE PROCEDERE ALLA SCELTA TRA I PERCORSI FORMATIVI INSERITI A CATALOGO, QUELLO PER IL QUALE SI VUOLE COMPILARE LA PROGETTAZIONE ESECUTIVA

                                </p>
                            </div>
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="tab_content">
                                            <div class="tab-pane" id="tab_1">
                                                <div class="portlet box green">
                                                    <div class="portlet-title">
                                                        <div class="caption">
                                                            <i class="fa fa-user-md zoom-1_4" title="Dati del soggetto proponente."></i>Percorsi della proposta formativa
                                                        </div>
                                                        <div class="tools">
                                                        </div>
                                                    </div>
                                                    <div class="portlet-body XXX_form_XXX p-5">

                                                        <table class="table table-bordered
                                                   table-striped table-responsive
                                                   table-condensed table-ricerca" id="xxxtabella_percorsi_della_proposta_formativa">
                                                            <thead>
                                                                <tr>
                                                                    <th>Percorso</th>
                                                                    <th>Profilo</th>
                                                                    <th>Ore Complessive</th>
                                                                    <th>Localizzazione sede didattica</th>
                                                                    <th>Provincia</th>
                                                                    <th class="text-center" style="width:1%;white-space:nowrap;">

                                                                    </th>
                                                                    <th class="text-center" style="width:1%;white-space:nowrap;"></th>
                                                                    <th class="text-center" style="width:1%;white-space:nowrap;">

                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                            <>

                                    @foreach ($percorsi as $percorso)
                                        <tr>
                                            <td style="vertical-align:middle;">{{ $percorso->nome }}</td>
                                            <td style="vertical-align:middle;">{{ $percorso->formazione->nome }}</td>
                                            <td style="vertical-align:middle;">{{ $percorso->totale_ore }}</td>
                                            <td style="vertical-align:middle;">{{ $percorso->indirizzo }}
                                                {{ $percorso->numero_civico }} {{ $percorso->citta }}</td>
                                            <td style="vertical-align:middle;">{{ $percorso->provincia }}</td>

                                            <td style="vertical-align:middle;" class="text-center">
                                                <div class="btn-group">
                                                    <!-- ($dBandoSelezione[$rr->id]['b_termini_validi_presentazione_pe'] dipende dalle date `data_init_pe`, `data_end_pe` -->
                                                    <a href="{{ route('simulatore.showDettagliPercorso', [$SimulatorPlayer->id, $percorso->id]) }}" class="btn blue radius-1-i">
                                                        <i class="fa fa-pencil zoom-1_4"></i>
                                                    </a>
                                                </div>
                                            </td>
                                            <td style="vertical-align:middle;white-space:nowrap;" "="">

                                                <a href=""
                                                    class="btn yellow d-block radius-1-i" target="_blank">
                                                    Bozza P.E.
                                                </a>
                                                </td>
                                                <td style="text-wrap:nowrap;vertical-align:middle;">
                                                    <button type="button" class="d-block w-100 btn btn-danger radius-1-i disabled"
                                                        title="Per richiedere la risorsa, completare e firmare la PE">Richiedi</button>
                                                </td>
                                                </tr>
                                        @endforeach

                                        </table>
                            </div>


                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
    </div>
    <!--END EDIT FORM -->
    </div>
    </div>
    </div>
    </div>

@endsection
