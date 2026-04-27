@extends('layouts.regione') {{-- o il layout che stai usando --}}

@section('content')
    <div class="page-content-wrapper">
        <div class="page-content" style="background-color: #f5f5f5!important;">
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet">
                        <!--BEGIN SAVE MENU -->
                        <div class="portlet-title">

                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                                <h2 style="text-transform:uppercase">BRISKET ONLUS

                                    <br>PROGETTAZIONE ESECUTIVA - FASE 2


                                </h2>


                                <h3 class="mt-0 lh-4">
                                    Istanza di inserimento al Catalogo (Id: 1900)<br>
                                    Titolo: POC BRISKET 2026<br>
                                    <strong>
                                        Dati Confermati:
                                        <span style="color:red;">Istanza Inviata e Firmata </span>
                                        il 26/03/2026 16:10:40
                                    </strong>
                                    <br><br>



                                </h3>
                            </div>












                        </div>
                        <!--END SAVE MENU -->
                        <hr>
                        <!--BEGIN EDIT FORM -->

                        <div class="portlet-body">
                            <div class="col-md-12">
                                <p>
                                    DI SEGUITO È POSSIBILE PROCEDERE ALLA SCELTA TRA I PERCORSI FORMATIVI INSERITI A
                                    CATALOGO, QUELLO PER IL QUALE SI VUOLE COMPILARE LA PROGETTAZIONE ESECUTIVA

                                </p>
                            </div>
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="tab_content">
                                            <div class="tab-pane" id="tab_1">
                                                <div class="portlet box blue">
                                                    <div class="portlet-title">
                                                        <div class="caption">
                                                            <i class="fa fa-user-md zoom-1_4"
                                                                title="Dati del soggetto proponente."></i>Corsi della
                                                            proposta formativa
                                                        </div>
                                                        <div class="tools">
                                                        </div>
                                                    </div>
                                                    <div class="portlet-body XXX_form_XXX p-5">
                                                        <table
                                                            class="td-middle table table-bordered table-striped table-responsive table-condensed table-ricerca">
                                                            <thead>
                                                                <tr>
                                                                    <th>Id</th>
                                                                    <th>Titolo</th>
                                                                    <th>Area Professionale</th>
                                                                    <th>SottoArea Professionale</th>
                                                                    <th class="text-nowrap">Livello EQF</th>
                                                                    <th class="text-nowrap">Nr. Percorsi</th>
                                                                    <th>Percorsi confermati</th>

                                                                    <th class="text-center">
                                                                        <p
                                                                            class="m-0 p-0 lh-2 text-1-i text-left text-nowrap">
                                                                            <i class="fa fa-eye text-success"></i> <span
                                                                                class="text-success">In lettura</span><br>
                                                                            <i class="fa fa-pencil text-primary"></i> <span
                                                                                class="text-primary">Da completare</span>
                                                                        </p>
                                                                        <hr class="mt-2 mb-0 p-0">
                                                                        <p></p>
                                                                        Moduli
                                                                    </th>

                                                                    <th class="text-nowrap">Percorsi</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                                @foreach ($formazione as $row)
                                                                    <tr class="align-middle">
                                                                        <td>{{ $row->id }}</td>
                                                                        <td>
                                                                            {{ $row->titolo }}
                                                                        </td>
                                                                        <td>{{ $row->area }}</td>
                                                                        <td>{{ $row->sotto_area }}</td>
                                                                        <td>2</td>
                                                                        <td>5</td>
                                                                        <td>1</td>

                                                                        <td class="text-center">

                                                                            <a href="{{ route('simulatore.showModuli', [$SimulatorPlayer->id, $row->id]) }}"
                                                                                title="Sezione moduli formativi completata correttamente e non modificabile perchè almeno un percorso è stato confermato"
                                                                                class="btn default green radius-1-i">
                                                                                <i class="fa fa-eye zoom-1_4"></i>
                                                                            </a>

                                                                        </td>

                                                                        <td class="text-center">
                                                                            <a href="{{ route('simulatore.showPercorsi', [$SimulatorPlayer->id, $row->id]) }}"
                                                                                title="Accedi all&#39;elenco dei percorsi relativi al corso 1238"
                                                                                class="btn default purple radius-2-i">
                                                                                <i class="fa fa-map-marker zoom-1_4"></i>
                                                                            </a>
                                                                        </td>

                                                                    </tr>
                                                                @endforeach


                                                            </tbody>
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
        @endsection
