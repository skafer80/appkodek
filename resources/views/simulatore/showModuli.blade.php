@extends('layouts.regione')

@section('content')
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <div class="page-content" style="background-color: #f5f5f5!important;">

            <div class="portlet">

                <div class="portlet-title">
                    <div class="col-md-3 text-left">
                        <ol class="breadcrumb">
                            <a href="{{ route('simulatore.index', $SimulatorPlayer->id) }}" class="btn blue btn-sm"><i class="fa fa-long-arrow-left fa-5x""
                                    aria-hidden=" true"></i>&nbsp;Indietro</a>
                        </ol>
                    </div>
                    <div class="col-md-12 text-center">
                        <h2>Progettazione Esecutiva 5 </h2>
                        <h3>Istanza di inserimento al CatalogoId: 579&nbsp; Titolo: Formare per lavorare</h3>
                        <h4>Percorso 5598: Operatore socio assistenziale</h4>
                    </div>
                </div>
                {{--                 @if ($player->end_time)
                    <div class="bg-success">
                        <p>E' stato raggiunto il numero minimo di Destinatari 15, ci sei stato
                            <strong>{{ floor($player->tempo / 60) }} minuti e {{ $player->tempo % 60 }}
                                secondi</strong>
                        </p>
                        <a href="{{ route('click.index') }}" class="btn btn-primary">Torna alla classifica</a>
                    </div>
                @endif --}}

                <div class="portlet-body">
                    <div class="bg-white border-1 p-3">
                        <h4 class="bold"><i class="fa fa-bars fa-1x" aria-hidden="true"></i> Moduli formativi
                            del
                            profilo selezionato</h4>
                        Per poter confermare la domanda occorre:
                        <ul>
                            <li>La durata complessiva delle ore dei moduli, escluse le ore delle competenze
                                trasversali, deve essere pari alle ore aula del percorso.</li>
                            <li>La durata complessiva delle ore FAD dei moduli, escluse le competenze trasversali,
                                deve essere pari o inferiore al 25% delle ore aula del percorso.</li>
                            <li>La durata complessiva delle ore stage dei moduli deve essere pari alle ore stage del
                                percorso.</li>
                        </ul>
                    </div>
                </div>

            </div>


            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="bg-black-75-i text-white">
                        <tr>
                            <th></th>
                            <th></th>
                            <th>ORE AULA</th>
                            <th>DI CUI IN FAD</th>
                            <th>ORE STAGE</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="informationsources">



                        @foreach ($moduliRaggruppati as $gruppo)
                            <tr>
                                <th>MD{{ $gruppo['categoria']->id }}</th>
                                <th>{{ $gruppo['categoria']->nome }}</th>
                                <th>{{ $gruppo['totale_ore_aula_moduli'] }}</th>
                                <th>{{ $gruppo['totale_ore_fad_moduli'] }}</th>
                                <th>70</th>
                                <th></th>
                            </tr>

                            @foreach ($gruppo['moduli'] as $modulo)
                                <tr id="is-{{ $modulo->id }}">
                                    <td class="text-right"><i
                                            class="fa fa-level-up fa-rotate-90 me-3"></i>{{ $modulo->id }}</td>
                                    <td class="ps-5-i">{{ $modulo->nome }}</td>
                                    <td>{{ $modulo->ore_aula_utente }}</td>
                                    <td>{{ $modulo->ore_fad_utente }}</td>

                                    <td>-</td>
                                    <td class="text-right">
                                        <button class="btn btn-sm btn-warning editinformationconoscenza"
                                                data-href="{{ route('simulatore.getModulo', [$SimulatorPlayer->id, 'id' => $modulo->id]) }}"><span
                                                    class="glyphicon glyphicon-pencil"></span></button>
                                    </td>
                                </tr>
                            @endforeach


                            <tr class="bg-grey-50-i">
                                <td></td>
                                <th class="text-right">Totale Modulo MD{{ $gruppo['categoria']->id }}</th>
                                {{--                                 @php
                                    $warning = 'bg-green';
                                    if (
                                        $subjects->where('gruppo', $gruppo['categoria']->id)->sum('ore_conoscenza') != 192 ||
                                        $subjects->where('gruppo', $gruppo['categoria']->id)->sum('ore_fad_conoscenza') != 0
                                    ) {
                                        $warning = 'bg-red';
                                    }
                                @endphp --}}
                                <th class="shadow">{{ $gruppo['totale_ore_aula'] }}</th>
                                <th class="shadow">{{ $gruppo['totale_ore_fad'] }}</th>

                                <th class="bg-green shadow">70</th>
                                <td></td>
                            </tr>


            </div>
            @endforeach



            <tr class="bg-black-75-i text-white">
                <td></td>
                <th class="text-right">Totale (escluso le competenze trasversali)</th>
                {{--                 @php
                    $warning = 'bg-green';
                    if ($subjects->sum('ore_conoscenza') != 350 || $subjects->sum('ore_fad_conoscenza') != 0) {
                        $warning = 'bg-red';
                    }
                @endphp --}}
                {{--                 <th class="{{ $warning }} shadow">
                    {{ $subjects->where('gruppo', 36348)->sum('ore_conoscenza') }}</th>
                <th class="{{ $warning }} shadow">
                    {{ $subjects->where('gruppo', 36348)->sum('ore_fad_conoscenza') }}</th>

                <th class="bg-green shadow">280</th> --}}
                <th class="shadow">{{ $totaleOreAula }}</th>
                <th class="shadow">{{ $totaleOreFad }}</th>
                <th></th>
                <td></td>
            </tr>
            </tbody>
            </table>
        </div>

        {{--         @if ($player->end_time)
            <div class="bg-success">
                <p>E' stato raggiunto il numero minimo di Destinatari 15, ci sei stato
                    <strong>{{ floor($player->tempo / 60) }} minuti e {{ $player->tempo % 60 }}
                        secondi</strong>
                </p>
                <a href="{{ route('click.index') }}" class="btn btn-primary">Torna alla classifica</a>
            </div>
        @endif --}}

        <div id="informationSourceModal" class="modal fade" tabindex="-1" role="dialog"
            aria-labelledby="informationSourceModalLabel">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="informationSourceModalLabel">Modifica modulo</h4>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('simulatore.editModuli', $SimulatorPlayer->id) }}" accept-charset="UTF-8"
                            id="informationSourceForm">
                            @csrf
                            <input name="id_corso" type="hidden" value="5598">
                            <input name="formazione_id" type="hidden" value="{{ $id }}">
                            <input name="player_id" type="hidden" value="{{ $SimulatorPlayer->id }}">
                            <input name="id" type="hidden" value="-1">
                            <div class="form-group">
                                <label for="t_denominazione_conoscenza" class="control-label">TITOLO
                                    MODULO</label>
                                <input class="form-control" disabled placeholder="Titolo modulo"
                                    name="t_denominazione_conoscenza" type="text" value=""
                                    id="t_denominazione_conoscenza">
                            </div>
                            <div class="form-group">
                                <label for="i_ore" class="control-label">ORE AULA</label>
                                <input class="form-control required" id="i_ore_prova" name="ore_conoscenza" type="number"
                                    value="">
                            </div>
                            <div class="form-group">
                                <label for="i_ore_fad" class="control-label">DI CUI IN FAD</label>
                                <input class="form-control required" id="ore_fad_conoscenza" name="ore_fad_conoscenza"
                                    type="number" value="">
                            </div>

                        </form>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" form="informationSourceForm" class="btn blue">Salva</button>
                        <button type="button" class="btn yellow" data-dismiss="modal">Annulla</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- END PAGE CONTENT-->
    </div>
    </div>
    <!-- END CONTENT -->
@endsection

@section('scripts')
    <script>
        jQuery(function($) {
            /** start information source **/
            $('#addinformationsource').on('click', function() {
                $('#informationSourceModal').modal('show');
                return false;
            });
            $('.editinformationsource').live('click', function() {
                var href = $(this).attr('data-href');
                $.ajax({
                    url: href,
                    type: "GET",
                    success: function(data, textStatus, jqXHR) {

                        $("#informationSourceForm input[name='id']").val(data.data.id);
                        $("#informationSourceForm input[name='t_denominazione']").val(data.data
                            .t_denominazione);
                        $("#informationSourceForm input[name='i_ore']").val(data.data.i_ore);
                        $("#informationSourceForm input[name='i_ore_fad']").val(data.data
                            .i_ore_fad);
                        $("#informationSourceForm input[name='i_ore_stage']").val(data.data
                            .i_ore_stage);

                        if (data.data.b_competenza_trasversale === "Y") {
                            $("#informationSourceForm input[name='i_ore']").prop("disabled",
                                true);
                            $("#informationSourceForm input[name='i_ore_stage']").prop(
                                "disabled", true);
                        } else {
                            $("#informationSourceForm input[name='i_ore']").prop("disabled",
                                false);
                            $("#informationSourceForm input[name='i_ore_stage']").prop(
                                "disabled", false);
                        }

                        if (data.data.t_competenze_correlate != null && data.data
                            .t_competenze_correlate != "") {
                            data.data.t_competenze_correlate.split(",").forEach(function(key,
                                value) {
                                $("#informationSourceForm input[name='competenze[]'][value=" +
                                    key + "]").click();
                            });
                        }

                        $('#informationSourceModal').modal('show');


                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        //console.log(errorThrown);
                    }
                });

                return false;
            });
            $('.editinformationconoscenza').live('click', function() {
                var href = $(this).attr('data-href');
                // Recupera il titolo della materia dalla seconda colonna della riga corrente
                var titoloMateria = $(this).closest('tr').find('td').eq(1).text().trim();

                $.ajax({
                    url: href,
                    type: "GET",
                    success: function(data, textStatus, jqXHR) {

                        $("#informationSourceForm input[name='id']").val(data.data.id);
                        $("#informationSourceForm input[name='t_denominazione_conoscenza']")
                            .val(data.data.t_denominazione_conoscenza);
                        $("#informationSourceForm input[name='ore_conoscenza']").val(data.data
                            .ore_conoscenza);
                        $("#informationSourceForm input[name='ore_fad_conoscenza']").val(data
                            .data.ore_fad_conoscenza);
                        $("#informationSourceForm input[name='ore_stage_conoscenza']").val(data
                            .data.ore_stage_conoscenza);

                        if (data.data.b_competenza_trasversale === "Y") {
                            $("#informationSourceForm input[name='i_ore']").prop("disabled",
                                true);
                            $("#informationSourceForm input[name='i_ore_stage']").prop(
                                "disabled", true);
                        } else {
                            $("#informationSourceForm input[name='i_ore']").prop("disabled",
                                false);
                            $("#informationSourceForm input[name='i_ore_stage']").prop(
                                "disabled", false);
                        }

                        if (data.data.t_competenze_correlate != null && data.data
                            .t_competenze_correlate != "") {
                            data.data.t_competenze_correlate.split(",").forEach(function(key,
                                value) {
                                $("#informationSourceForm input[name='competenze[]'][value=" +
                                    key + "]").click();
                            });
                        }

                        // Imposta il titolo del modal con il nome della materia
                        $("#informationSourceForm input[name='t_denominazione_conoscenza']")
                            .val(titoloMateria);

                        $('#informationSourceModal').modal('show');
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        //console.log(errorThrown);
                    }
                });

                return false;
            });

            $('.delinformationsource').live('click', function() {
                var href = $(this).attr('data-href');
                var id = $(this).attr('data-id');
                // alert(href);
                $.ajax({
                    url: href,
                    type: "DELETE",
                    success: function(data, textStatus, jqXHR) {
                        if (data.data == true) {
                            $('#is-' + id).remove();
                            // alert('Modulo correttamente eliminato');
                            // location.reload();
                        } else {
                            alert(
                                'Non è possibile aggiornare la domanda perchè in stato CONFERMATA o il dato non esiste'
                            );
                            location.reload();
                        }

                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        //console.log(errorThrown);
                    }
                });

                return false;
            });
            $('#informationSourceModal').on('hidden.bs.modal', function() {
                $("#informationSourceForm input[name='competenze[]']:checked").click();
                $('#informationSourceForm').trigger("reset");
                $("#informationSourceForm input[name='id']").val('-1');
            });
            // SALVATAGGIO DEI MODULI
            $('#saveinformationsource').on('click', function() {
                var form = $('#informationSourceForm');
                var formData = $(form).serializeArray();
                var formURL = $(form).attr("action");

                var formMethod = $(form).attr("method");
                $.ajax({
                    url: formURL,
                    type: formMethod,
                    data: formData,
                    success: function(data, textStatus, jqXHR) {
                        if (data.data != false) {
                            var ore = data.data.i_ore ? data.data.i_ore : '0';
                            var orefad = data.data.i_ore_fad ? data.data.i_ore_fad : '0';
                            var orestage = data.data.i_ore_stage ? data.data.i_ore_stage : '0';
                            $('#informationSourceModal').modal('hide');
                            location.reload();
                        } else {
                            alert(data.data);
                            return;
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        //console.log(errorThrown);
                    }
                });
            });


            /** end information source **/
        });
    </script>
@endsection
