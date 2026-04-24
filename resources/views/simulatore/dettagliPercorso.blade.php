@extends('layouts.regione')

@section('content')
    <div class="page-content-wrapper">
        <div class="page-content" style="background-color: #f5f5f5!important;">
            @include('simulatore.menuPercorso')
            <hr>
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
                                <td style="width:1%;padding-right:1rem;white-space:nowrap;">Titolo / Denominazione del
                                    percorso</td>
                                <td><strong>{{ $percorso->formazione->titolo }}</strong></td>
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
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-archive"></i>Dettaglio Percorso
                            </div>
                        </div>
                        <div class="portlet-body">
                            <form method="POST" action="https://fse.regione.sicilia.it/avvisoPOC/pe/189/detail/2684"
                                accept-charset="UTF-8"><input name="_token" type="hidden"
                                    value="LThRShcEdk9UxInaZ6o0eKZZvr9fyXzIKbBX4xPn">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <strong>
                                            <h3> Sede di erogazione del percorso </h3>
                                        </strong>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                        <div class="form-group">
                                            <label for="soindirizzo" class="control-label">Indirizzo</label>
                                            <label for="soindirizzo" class="form-control" disabled="">VIA G.
                                                ROMITA</label>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-1 col-lg-1">
                                        <div class="form-group">
                                            <label for="soindirizzon" class="control-label">N. civico</label>
                                            <label for="soindirizzon" class="form-control" disabled="">2</label>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                                        <div class="form-group">
                                            <label for="soindirizzocap" class="control-label">CAP</label>
                                            <label for="soindirizzocap" class="form-control" disabled="">93100</label>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                        <div class="form-group">
                                            <label for="soindirizzocitta" class="control-label">Città</label>
                                            <label for="soindirizzocitta" class="form-control"
                                                disabled="">Caltanissetta</label>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                                        <div class="form-group">
                                            <label for="soindirizzoprov" class="control-label">Provincia</label>
                                            <label for="soindirizzoprov" class="form-control"
                                                disabled="">Caltanissetta</label>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <strong>
                                            <h3>Caratteristiche del percorso </h3>
                                        </strong>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                                        <div class="form-group">
                                            <label for="totale_mesi_percorso" class="required">Totale Massimo Mesi
                                                Percorso</label>
                                            <input class="form-control required" disabled="" name="totale_mesi_percorso"
                                                type="text" value="6" id="totale_mesi_percorso">
                                            <input name="totale_mesi_percorso" type="hidden" value="6"
                                                id="totale_mesi_percorso">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                                        <div class="form-group">
                                            <label for="data_avvio_prevista" class="required">Data avvio prevista</label>
                                            <input class="form-control required date-picker-chiusura"
                                                name="data_avvio_prevista" type="text" value=""
                                                id="data_avvio_prevista">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                                        <div class="form-group">
                                            <label for="data_fine_prevista" class="required">Data fine prevista</label>
                                            <input class="form-control required date-picker-fine"
                                                name="data_fine_prevista" type="text" value=""
                                                id="data_fine_prevista">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                                        <div class="form-group">
                                            <label for="allievi_massimi" class="control-label">Capienza aula
                                                effettiva</label>

                                            <input class="form-control" disabled="" name="allievi_massimi"
                                                type="number" value="10" id="allievi_massimi">
                                            <input name="allievi_massimi" type="hidden" value="10"
                                                id="allievi_massimi">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                        <div class="form-group">
                                            <label for="i_giornate_edizione" class="control-label">Numero di giornate
                                                minime (Giornata formativa di 8 ore)</label>
                                            <input class="form-control" disabled="" type="number"
                                                name="i_giornate_edizione" value="70" id="i_giornate_edizione">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                        <div class="form-group">
                                            <label for="i_giornate_edizione" class="control-label">Numero di giornate
                                                massime (Giornata formativa di 4 ore)</label>
                                            <input class="form-control" disabled="" type="number"
                                                name="i_giornate_edizione" value="139" id="i_giornate_edizione">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                        <div class="form-group">
                                            <label for="importo_finanziamenti" class="control-label">Importo totale
                                                finanziamenti PO FSE 2014-2020 e PR FSE+ Sicilia 2021-2027 ricevuti</label>
                                            <input step="0.01" class="form-control" name="importo_finanziamenti"
                                                type="number" id="importo_finanziamenti">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                                        <div class="form-group">
                                            <label for="giornate_aula_previste" class="control-label">Numero di giornate
                                                previste(aula + stage)</label>
                                            <input class="form-control" type="number" name="giornate_aula_previste"
                                                id="giornate_aula_previste">

                                        </div>
                                    </div>

                                </div>
                                <!--                     <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                            <div class="form-group">



                            </div>
                        </div>-->
                                <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                                    <div class="form-group" style="margin-top: 25px;">
                                        <input class="btn btn-large blue" type="submit" value="Salva">
                                        <a href="https://fse.regione.sicilia.it/avvisoPOC/pe/aV9kb21hbmRhX2lkPTE4OQ==/detail/aV9lZGl6aW9uZV9pZD0yNjg0"
                                            class="btn btn-warning">Annulla</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class=" col-xs-12 col-sm-12 col-md-12 col-lg-12 text-right mb-3">

                </div>






            </div>
        </div>
        <!-- END PAGE CONTENT-->
    </div>
    </div>
@endsection
