@extends('layouts.regione')

@section('content')
    <div class="page-content-wrapper">
        <div class="page-content" style="background-color: #f5f5f5!important;">

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-right">
                <div class="btn-group">
                    <a href="{{ route('simulatore.showStage', [$SimulatorPlayer->id, 'id' => $percorso->id]) }}"
                        class="btn default">Torna indietro</a>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    &nbsp;
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-calendar"></i>Aggiungi Impresa/Ente
                        </div>
                    </div>
                    <div class="portlet-body">

                        <form method="POST"
                            action="{{ route('simulatore.memorizzaDettagliImpresa', [$SimulatorPlayer->id, $percorso->id]) }}"
                            accept-charset="UTF-8">
                            @csrf
                            <div class="row">

                                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                                    <div class="form-group">
                                        <label for="t_denominazione_impresa" class="control-label required">Denominazione
                                            completa</label>
                                        <input class="form-control date-picker-custom required" required=""
                                            name="t_denominazione_impresa" type="text" value=""
                                            id="t_denominazione_impresa">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                                    <div class="form-group">
                                        <label for="t_piva_impresa" class="control-label required">PIVA</label>
                                        <input class="form-control required" required="" name="t_piva_impresa"
                                            type="text" value="" id="t_piva_impresa">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                                    <div class="form-group">
                                        <label for="i_allievi_previsti" class="control-label required">Numero allievi
                                            ospitabili</label>
                                        <input class="form-control required" maxlength="1" min="1" step="1"
                                            pattern="[1-8]{1}" required="" name="i_allievi_previsti" type="number"
                                            value="" id="i_allievi_previsti">
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <p class="p-0 bold h3">Indirizzo completo sede legale</p>
                                    <hr>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                                    <div class="form-group">
                                        <label for="sede_legale_provincia" class="control-label required">Provincia</label>
                                        <select name="sede_legale_provincia" data-url="https://app.kodek.it/api/comuni"
                                            required="required" class="w-100 form-control required">
                                            <option>...</option>
                                            <option value="AG">Agrigento</option>
                                            <option value="AL">Alessandria</option>
                                            <option value="AN">Ancona</option>
                                            <option value="AO">Aosta</option>
                                            <option value="AP">Ascoli Piceno</option>
                                            <option value="AQ">L'Aquila</option>
                                            <option value="AR">Arezzo</option>
                                            <option value="AT">Asti</option>
                                            <option value="AV">Avellino</option>
                                            <option value="BA">Bari</option>
                                            <option value="BG">Bergamo</option>
                                            <option value="BI">Biella</option>
                                            <option value="BL">Belluno</option>
                                            <option value="BN">Benevento</option>
                                            <option value="BO">Bologna</option>
                                            <option value="BR">Brindisi</option>
                                            <option value="BS">Brescia</option>
                                            <option value="BT">Barletta-Andria-Trani</option>
                                            <option value="BZ">Bolzano</option>
                                            <option value="CA">Cagliari</option>
                                            <option value="CB">Campobasso</option>
                                            <option value="CE">Caserta</option>
                                            <option value="CH">Chieti</option>
                                            <option value="CI">Carbonia-Iglesias</option>
                                            <option value="CL">Caltanissetta</option>
                                            <option value="CN">Cuneo</option>
                                            <option value="CO">Como</option>
                                            <option value="CR">Cremona</option>
                                            <option value="CS">Cosenza</option>
                                            <option value="CT">Catania</option>
                                            <option value="CZ">Catanzaro</option>
                                            <option value="EE">ESTERO</option>
                                            <option value="EN">Enna</option>
                                            <option value="FC">ForlÃ¬-Cesena</option>
                                            <option value="FE">Ferrara</option>
                                            <option value="FG">Foggia</option>
                                            <option value="FI">Firenze</option>
                                            <option value="FM">Fermo</option>
                                            <option value="FR">Frosinone</option>
                                            <option value="GE">Genova</option>
                                            <option value="GO">Gorizia</option>
                                            <option value="GR">Grosseto</option>
                                            <option value="IM">Imperia</option>
                                            <option value="IS">Isernia</option>
                                            <option value="KR">Crotone</option>
                                            <option value="LC">Lecco</option>
                                            <option value="LE">Lecce</option>
                                            <option value="LI">Livorno</option>
                                            <option value="LO">Lodi</option>
                                            <option value="LT">Latina</option>
                                            <option value="LU">Lucca</option>
                                            <option value="MB">Monza e della Brianza</option>
                                            <option value="MC">Macerata</option>
                                            <option value="ME">Messina</option>
                                            <option value="MI">Milano</option>
                                            <option value="MN">Mantova</option>
                                            <option value="MO">Modena</option>
                                            <option value="MS">Massa-Carrara</option>
                                            <option value="MT">Matera</option>
                                            <option value="NA">Napoli</option>
                                            <option value="NO">Novara</option>
                                            <option value="NU">Nuoro</option>
                                            <option value="OG">Ogliastra</option>
                                            <option value="OR">Oristano</option>
                                            <option value="OT">Olbia-Tempio</option>
                                            <option value="PA">Palermo</option>
                                            <option value="PC">Piacenza</option>
                                            <option value="PD">Padova</option>
                                            <option value="PE">Pescara</option>
                                            <option value="PG">Perugia</option>
                                            <option value="PI">Pisa</option>
                                            <option value="PN">Pordenone</option>
                                            <option value="PO">Prato</option>
                                            <option value="PR">Parma</option>
                                            <option value="PT">Pistoia</option>
                                            <option value="PU">Pesaro e Urbino</option>
                                            <option value="PV">Pavia</option>
                                            <option value="PZ">Potenza</option>
                                            <option value="RA">Ravenna</option>
                                            <option value="RC">Reggio Calabria</option>
                                            <option value="RE">Reggio Emilia</option>
                                            <option value="RG">Ragusa</option>
                                            <option value="RI">Rieti</option>
                                            <option value="RM">Roma</option>
                                            <option value="RN">Rimini</option>
                                            <option value="RO">Rovigo</option>
                                            <option value="SA">Salerno</option>
                                            <option value="SI">Siena</option>
                                            <option value="SO">Sondrio</option>
                                            <option value="SP">La Spezia</option>
                                            <option value="SR">Siracusa</option>
                                            <option value="SS">Sassari</option>
                                            <option value="SU">Sud Sardegna</option>
                                            <option value="SV">Savona</option>
                                            <option value="TA">Taranto</option>
                                            <option value="TE">Teramo</option>
                                            <option value="TN">Trento</option>
                                            <option value="TO">Torino</option>
                                            <option value="TP">Trapani</option>
                                            <option value="TR">Terni</option>
                                            <option value="TS">Trieste</option>
                                            <option value="TV">Treviso</option>
                                            <option value="UD">Udine</option>
                                            <option value="VA">Varese</option>
                                            <option value="VB">Verbano-Cusio-Ossola</option>
                                            <option value="VC">Vercelli</option>
                                            <option value="VE">Venezia</option>
                                            <option value="VI">Vicenza</option>
                                            <option value="VR">Verona</option>
                                            <option value="VS">Medio Campidano</option>
                                            <option value="VT">Viterbo</option>
                                            <option value="VV">Vibo Valentia</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                                    <div class="form-group">
                                        <label for="sede_legale_comune" class="control-label required">Comune</label>

                                        <select class="form-control required" required="required" id="sede_legale_comune"
                                            name="sede_legale_comune">
                                            <option value="" selected="selected">Seleziona Provincia</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="sede_legale_indirizzo"
                                            class="control-label required">Indirizzo</label>
                                        <input class="form-control required" required="required"
                                            name="sede_legale_indirizzo" type="text" value=""
                                            id="sede_legale_indirizzo">
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                                    <div class="form-group">
                                        <label for="sede_legale_civico" class="control-label required">N° civico</label>
                                        <input class="form-control required" required="required"
                                            name="sede_legale_civico" type="text" value=""
                                            id="sede_legale_civico">
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <p class="p-0 bold h3">Indirizzo completo sede operativa (se diversa da sede legale)
                                    </p>
                                    <hr>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                                    <div class="form-group">
                                        <label for="sede_operativa_provincia" class="control-label">Provincia</label>
                                        <select name="sede_operativa_provincia" data-url="https://app.kodek.it/api/comuni"
                                            class="w-100 form-control">
                                            <option>...</option>
                                            <option value="AG">Agrigento</option>
                                            <option value="AL">Alessandria</option>
                                            <option value="AN">Ancona</option>
                                            <option value="AO">Aosta</option>
                                            <option value="AP">Ascoli Piceno</option>
                                            <option value="AQ">L'Aquila</option>
                                            <option value="AR">Arezzo</option>
                                            <option value="AT">Asti</option>
                                            <option value="AV">Avellino</option>
                                            <option value="BA">Bari</option>
                                            <option value="BG">Bergamo</option>
                                            <option value="BI">Biella</option>
                                            <option value="BL">Belluno</option>
                                            <option value="BN">Benevento</option>
                                            <option value="BO">Bologna</option>
                                            <option value="BR">Brindisi</option>
                                            <option value="BS">Brescia</option>
                                            <option value="BT">Barletta-Andria-Trani</option>
                                            <option value="BZ">Bolzano</option>
                                            <option value="CA">Cagliari</option>
                                            <option value="CB">Campobasso</option>
                                            <option value="CE">Caserta</option>
                                            <option value="CH">Chieti</option>
                                            <option value="CI">Carbonia-Iglesias</option>
                                            <option value="CL">Caltanissetta</option>
                                            <option value="CN">Cuneo</option>
                                            <option value="CO">Como</option>
                                            <option value="CR">Cremona</option>
                                            <option value="CS">Cosenza</option>
                                            <option value="CT">Catania</option>
                                            <option value="CZ">Catanzaro</option>
                                            <option value="EE">ESTERO</option>
                                            <option value="EN">Enna</option>
                                            <option value="FC">ForlÃ¬-Cesena</option>
                                            <option value="FE">Ferrara</option>
                                            <option value="FG">Foggia</option>
                                            <option value="FI">Firenze</option>
                                            <option value="FM">Fermo</option>
                                            <option value="FR">Frosinone</option>
                                            <option value="GE">Genova</option>
                                            <option value="GO">Gorizia</option>
                                            <option value="GR">Grosseto</option>
                                            <option value="IM">Imperia</option>
                                            <option value="IS">Isernia</option>
                                            <option value="KR">Crotone</option>
                                            <option value="LC">Lecco</option>
                                            <option value="LE">Lecce</option>
                                            <option value="LI">Livorno</option>
                                            <option value="LO">Lodi</option>
                                            <option value="LT">Latina</option>
                                            <option value="LU">Lucca</option>
                                            <option value="MB">Monza e della Brianza</option>
                                            <option value="MC">Macerata</option>
                                            <option value="ME">Messina</option>
                                            <option value="MI">Milano</option>
                                            <option value="MN">Mantova</option>
                                            <option value="MO">Modena</option>
                                            <option value="MS">Massa-Carrara</option>
                                            <option value="MT">Matera</option>
                                            <option value="NA">Napoli</option>
                                            <option value="NO">Novara</option>
                                            <option value="NU">Nuoro</option>
                                            <option value="OG">Ogliastra</option>
                                            <option value="OR">Oristano</option>
                                            <option value="OT">Olbia-Tempio</option>
                                            <option value="PA">Palermo</option>
                                            <option value="PC">Piacenza</option>
                                            <option value="PD">Padova</option>
                                            <option value="PE">Pescara</option>
                                            <option value="PG">Perugia</option>
                                            <option value="PI">Pisa</option>
                                            <option value="PN">Pordenone</option>
                                            <option value="PO">Prato</option>
                                            <option value="PR">Parma</option>
                                            <option value="PT">Pistoia</option>
                                            <option value="PU">Pesaro e Urbino</option>
                                            <option value="PV">Pavia</option>
                                            <option value="PZ">Potenza</option>
                                            <option value="RA">Ravenna</option>
                                            <option value="RC">Reggio Calabria</option>
                                            <option value="RE">Reggio Emilia</option>
                                            <option value="RG">Ragusa</option>
                                            <option value="RI">Rieti</option>
                                            <option value="RM">Roma</option>
                                            <option value="RN">Rimini</option>
                                            <option value="RO">Rovigo</option>
                                            <option value="SA">Salerno</option>
                                            <option value="SI">Siena</option>
                                            <option value="SO">Sondrio</option>
                                            <option value="SP">La Spezia</option>
                                            <option value="SR">Siracusa</option>
                                            <option value="SS">Sassari</option>
                                            <option value="SU">Sud Sardegna</option>
                                            <option value="SV">Savona</option>
                                            <option value="TA">Taranto</option>
                                            <option value="TE">Teramo</option>
                                            <option value="TN">Trento</option>
                                            <option value="TO">Torino</option>
                                            <option value="TP">Trapani</option>
                                            <option value="TR">Terni</option>
                                            <option value="TS">Trieste</option>
                                            <option value="TV">Treviso</option>
                                            <option value="UD">Udine</option>
                                            <option value="VA">Varese</option>
                                            <option value="VB">Verbano-Cusio-Ossola</option>
                                            <option value="VC">Vercelli</option>
                                            <option value="VE">Venezia</option>
                                            <option value="VI">Vicenza</option>
                                            <option value="VR">Verona</option>
                                            <option value="VS">Medio Campidano</option>
                                            <option value="VT">Viterbo</option>
                                            <option value="VV">Vibo Valentia</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                                    <div class="form-group">
                                        <label for="sede_operativa_comune" class="control-label">Comune</label>

                                        <select class="form-control" id="sede_operativa_comune"
                                            name="sede_operativa_comune">
                                            <option value="" selected="selected">Seleziona Provincia</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="sede_operativa_indirizzo" class="control-label">Indirizzo</label>
                                        <input class="form-control" name="sede_operativa_indirizzo" type="text"
                                            value="" id="sede_operativa_indirizzo">
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                                    <div class="form-group">
                                        <label for="sede_operativa_civico" class="control-label">N° civico</label>
                                        <input class="form-control" name="sede_operativa_civico" type="text"
                                            value="" id="sede_operativa_civico">
                                    </div>
                                </div>


                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-right">
                                    <div class="form-group">
                                        <input class="btn blue btn-large" type="submit" value="Salva">
                                        <a href="" class="btn btn-warning">Annulla</a>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

        </div>

        <script type="module">
            jQuery(document).ready(function() {

                $(document).on("getComuniListFromProvincia", function(event, url, caller, target) {
                    var $url = url;
                    var $caller = caller;
                    var $target = target;
                    var $provincia_selezionata = $("select[name='" + $caller + "']").find("option:selected")
                        .val();
                    var $comune_selezionato = $("select[name='" + $target + "']").find("option:selected").val();
                    $("select[name='" + $target + "']").find("option").remove(); // Azzero le opzioni
                    if ($.trim($provincia_selezionata) != "") {
                        $.ajax({
                            url: $url,
                            type: "GET",
                            data: {
                                "option": $provincia_selezionata
                            },
                            success: function(data, textStatus, jqXHR) {
                                $.each(data, function(key, value) {
                                    $("select[name='" + $target + "']").append(
                                        '<option value="' + value.t_denominazione +
                                        '">' + value.t_denominazione + '</option>');

                                });
                                $("select[name='" + $target + "']").find('option[value="' +
                                    $comune_selezionato + '"]').attr("selected", true);

                            },
                            error: function(jqXHR, textStatus, errorThrown) {}
                        });
                    }
                });

                jQuery("select[name=sede_legale_provincia]").on("change load", function() {
                    var $url = $(this).data("url");
                    var $caller = "sede_legale_provincia";
                    var $target = "sede_legale_comune";
                    $(document).trigger("getComuniListFromProvincia", [$url, $caller, $target]);
                });

                jQuery("select[name=sede_operativa_provincia]").on("change load", function() {
                    var $url = $(this).data("url");
                    var $caller = "sede_operativa_provincia";
                    var $target = "sede_operativa_comune";
                    $(document).trigger("getComuniListFromProvincia", [$url, $caller, $target]);
                });
            });
        </script>

        <!-- END PAGE CONTENT-->
    </div>
    </div>
@endsection
