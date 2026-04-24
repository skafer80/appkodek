@extends('layouts.regione')

@section('content')
    <div class="page-content-wrapper">
        <div class="page-content" style="background-color: #f5f5f5!important;">
            @include('simulatore.menuPercorso')
            <hr>

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <h4 class="page-title">
                    Progettazione esecutiva - Riferimento Edizione ED2684

                </h4>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <table class="table table-bordered table-responsive table-condensed">
                        <tbody>
                            <tr>
                                <td style="width:1%;padding-right:1rem;white-space:nowrap;">Titolo / Denominazione del
                                    percorso</td>
                                <td><strong>Tecnico meccatronico delle autoriparazioni</strong></td>
                            </tr>
                            <tr>
                                <td>Allievi minimi / Allievi massimi:</td>
                                <td> <strong>8 / 10

                                    </strong>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    Allievi disabili inseriti
                                </td>
                                <td>
                                    <strong class="text-success">0</strong>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Numero massimo allievi disabili
                                </td>
                                <td>
                                    <strong> 2</strong>
                                </td>
                            </tr>
                            <!--                <tr>
                        <td>Numero giornate min /Numero giornate max</td>
                        <td><strong>

                            /
                            </strong> </td>
                    </tr>-->
                            <!--                <tr>
                        <td>Data Inizio Bando di selezione: </td>
                        <td><strong>
                                </strong></td>
                    </tr>-->
                            <!--<tr>
                        <td> Data termine compilazione P.E: </td>
                        <td>   <strong></strong></td>
                    </tr>-->
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row">
                <form method="POST"
                    action="https://fse.regione.sicilia.it/avvisoPOC/pe/aV9kb21hbmRhX2lkPTE4OQ==/convenzioni/aV9lZGl6aW9uZV9pZD0yNjg0"
                    accept-charset="UTF-8"><input name="_token" type="hidden"
                        value="LThRShcEdk9UxInaZ6o0eKZZvr9fyXzIKbBX4xPn">
                    <input id="isEditablePe" name="isEditablePe" type="hidden" value="1">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="portlet box red">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-file"></i>Dettaglio STAGE
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                                        <div class="form-group">
                                            <label for="giornate_stage" class="required">Ore Stage</label>
                                            <input class="form-control required" disabled="" name="giornate_stage"
                                                type="text" value="150" id="giornate_stage">

                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                                        <div class="form-group">
                                            <label for="d_avvio_stage" class="required">Data avvio prevista</label>
                                            <input class="form-control required date-picker-chiusura" name="d_avvio_stage"
                                                type="text" value="" id="d_avvio_stage">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                                        <div class="form-group">
                                            <label for="d_fine_stage" class="required">Data fine prevista</label>
                                            <input class="form-control required date-picker-fine" name="d_fine_stage"
                                                type="text" value="" id="d_fine_stage">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 col-md-128">
                                        <h3 class="help">Giornate di stage previste considerando la durata formativa
                                            minima di 4 ore e massima di 8 ore giornaliere</h3>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="col-lg-3 col-md-3">
                                            <div class="form-group">
                                                <label for="_valoregiornatemin" class="control-label">Numero giornate
                                                    minimo</label>
                                                <input class="form-control required" disabled=""
                                                    name="_valoregiornatemin" type="text" value="19"
                                                    id="_valoregiornatemin">
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3">
                                            <div class="form-group">
                                                <label for="_valoregiornatemax" class="control-label">Numero giornate
                                                    massimo</label>
                                                <input class="form-control required" disabled=""
                                                    name="_valoregiornatemax" type="text" value="38"
                                                    id="_valoregiornatemax">
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-lg-3">
                                            <div class="form-group">
                                                <label for="giornate_stage" class="required">Giornate Stage</label>
                                                <input class="form-control required" type="number" min="19"
                                                    max="38" name="i_giornate_stage" value="0">

                                            </div>
                                        </div>
                                        <div class="col-md-3 col-lg-3 text-right">
                                            <div class="form-group">
                                                <input class="btn btn-large blue" type="submit" value="Salva">
                                                <a href="https://fse.regione.sicilia.it/avvisoPOC/pe/aV9kb21hbmRhX2lkPTE4OQ==/convenzioni/aV9lZGl6aW9uZV9pZD0yNjg0"
                                                    class="btn btn-warning">Annulla</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>



                        </div>


                    </div>
                </form>
            </div>
            <div class=" col-xs-12 col-sm-12 col-md-12 col-lg-12 text-right mb-3">
                <div class="btn-group">
                    <a href="{{ route('propostaformatica.showImpresa', ['id' => $percorso->id]) }}"
                        class="btn blue"> <i class="fa fa-plus"></i> Aggiungi Impresa/Ente</a>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-certificate"></i>Imprese/Enti
                            </div>
                        </div>
                        <div class="portlet-body">

                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <table class="table table-condensend table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>Denominazione</th>
                                                <th>Partita IVA</th>
                                                <th>Sede legale</th>
                                                <th>Sede operativa</th>
                                                <th>Numero Allievi Stagisti Previsti</th>
                                                <th width="200px"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan="5">Nessun elemento</td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>





            <!-- END PAGE CONTENT-->
        </div>
    </div>
@endsection
