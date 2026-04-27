@extends('layouts.regione')

@section('content')
    @php
        $tariffaFasciaA = 164.53;
        $tariffaFasciaB = 131.63;
        $tariffaFasciaC = 82.27;
        $ucsDocentiStage = 12340.50;
        $oreTotaliAttese = 404;

        $totaleUcsFasciaA = $orePresunteFasciaA * $tariffaFasciaA;
        $totaleUcsFasciaB = $orePresunteFasciaB * $tariffaFasciaB;
        $totaleUcsFasciaC = $orePresunteFasciaC * $tariffaFasciaC;
        $totaleUcsDocentiAulaFad = $totaleUcsFasciaA + $totaleUcsFasciaB + $totaleUcsFasciaC;
        $totaleComplessivo = $totaleUcsDocentiAulaFad + $ucsDocentiStage;
        $totaleOreInserite = $orePresunteFasciaA + $orePresunteFasciaB + $orePresunteFasciaC;
    @endphp

    <div class="page-content-wrapper">
        <div class="page-content" style="background-color: #f5f5f5!important;">

            <a href="{{ route('simulatore.showDettagliPercorso', [$SimulatorPlayer->id, $percorso->id]) }}"
                class="d-inline-block mb-5 p-2 bg-blue underline-off-i"><i class="fa fa-long-arrow-left" "="" aria-hidden=" true"></i>&nbsp;Indietro</a>

            @if ($errors->has('ore_totali'))
                <div class="alert alert-danger">
                    {{ $errors->first('ore_totali') }}
                </div>
            @endif


    <div class="portlet box blue">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-graduation-cap"></i> Distribuzione ore docenza aula/FAD
            </div>
        </div>
        <div class="portlet-body">

            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th colspan="4" style="text-align:center ">Fasce professionali docenti</th>
                    </tr>
                    <tr>
                        <th> Livello EQF - Ore aula/FAD</th>
                        <th>A</th>
                        <th>B</th>
                        <th>C</th>
                    </tr>
                </thead>
                <tbody>

                    <tr class="odd gradeX">
                        <td>EQF: 3 - Ore aula corso/FAD: 404</td>
                        <td>
                            Ore minime da inserire: 162 (40%)<br>
                            Ore massime da inserire: 202 (50%)<br>
                        </td>
                        <td>Ore massime da inserire: 242 (60%)</td>
                        <td>Ore massime da inserire: 101 (25%)</td>
                    </tr>

                    <form method="post" action="{{ route('simulatore.memorizzaDatiEconomici', [$SimulatorPlayer->id, $percorso->id]) }}">
                        @csrf
                        <tr class="odd gradeX">
                            <td><strong>Ore presunte aula + FAD</strong></td>
                            <td><input id="ore_presunte_fascia_a" min="162" max="202" class="form-control required" required="required" name="ore_presunte_fascia_a" type="number" value="{{ $orePresunteFasciaA }}"></td>
                            <td><input id="ore_presunte_fascia_b" min="0" max="242" class="form-control required" required="required" name="ore_presunte_fascia_b" type="number" value="{{ $orePresunteFasciaB }}"></td>
                            <td><input id="ore_presunte_fascia_c" min="0" max="101" class="form-control required" required="required" name="ore_presunte_fascia_c" type="number" value="{{ $orePresunteFasciaC }}"></td>
                        </tr>
                        <tr>
                            <td colspan="4" class="text-right">
                                <strong>Totale ore inserite: <span id="totale-ore">{{ $totaleOreInserite }}</span>/{{ $oreTotaliAttese }}</strong>
                                <span id="vincolo-ore-msg" class="text-muted" style="margin-left:10px;"></span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4" class="text-center"><button id="btn-salva-datieconomici" class="btn blue" type="submit"><i class="fa fa-check-circle"></i>&nbsp;Salva</button></td>
                        </tr>
                    </form>

                </tbody>
            </table>

        </div>
    </div>


    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <h4 class="page-title">
            Dati economici - Riferimento Edizione ED2684
                </h4>
    </div>

    <table class="table table-condensed table-bordered table-striped">
        <tbody><tr>
            <th>Id Corso</th>
            <th>Id Edizione</th>
            <th>UCS docenti aula/FAD</th>
            <th>UCS docenti stage</th>
            <th>UCS discenti aula/FAD</th>
            <th>UCS discenti stage</th>
            <th rowspan="2" class="h4 text-center align-middle shadow">
                <b>Totale</b> <span id="totale-complessivo">{{ number_format($totaleComplessivo, 2, ',', '.') }}</span>
            </th>
        </tr>
        <tr>
            <td>CS1326</td>
            <td>ED2684</td>
            <td>
                Fascia A: <span id="ucs-fascia-a">{{ number_format($totaleUcsFasciaA, 2, ',', '.') }}</span> (<span id="formula-fascia-a">164,53*{{ $orePresunteFasciaA }}</span>)<br>
                Fascia B: <span id="ucs-fascia-b">{{ number_format($totaleUcsFasciaB, 2, ',', '.') }}</span> (<span id="formula-fascia-b">131,63*{{ $orePresunteFasciaB }}</span>)<br>
                Fascia C: <span id="ucs-fascia-c">{{ number_format($totaleUcsFasciaC, 2, ',', '.') }}</span> (<span id="formula-fascia-c">82,27*{{ $orePresunteFasciaC }}</span>)
            </td>
            <td id="ucs-docenti-stage">{{ number_format($ucsDocentiStage, 2, ',', '.') }}</td>
            <td>0,00</td>
            <td>0,00</td>
        </tr>
    </tbody></table>



                    <!-- END PAGE CONTENT-->
                </div>
            </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            var TARIFFA_A = 164.53;
            var TARIFFA_B = 131.63;
            var TARIFFA_C = 82.27;
            var UCS_DOCENTI_STAGE = 12340.50;
            var ORE_TOTALI_ATTESE = 404;

            function toNumber(value) {
                var parsed = parseInt(value, 10);
                return isNaN(parsed) ? 0 : parsed;
            }

            function formatItNumber(value) {
                return new Intl.NumberFormat('it-IT', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                }).format(value);
            }

            function aggiornaRiepilogoEconomico() {
                var oreA = toNumber($('#ore_presunte_fascia_a').val());
                var oreB = toNumber($('#ore_presunte_fascia_b').val());
                var oreC = toNumber($('#ore_presunte_fascia_c').val());

                var totaleOre = oreA + oreB + oreC;
                var ucsA = oreA * TARIFFA_A;
                var ucsB = oreB * TARIFFA_B;
                var ucsC = oreC * TARIFFA_C;
                var totaleDocentiAulaFad = ucsA + ucsB + ucsC;
                var totaleComplessivo = totaleDocentiAulaFad + UCS_DOCENTI_STAGE;

                $('#totale-ore').text(totaleOre);
                $('#ucs-fascia-a').text(formatItNumber(ucsA));
                $('#ucs-fascia-b').text(formatItNumber(ucsB));
                $('#ucs-fascia-c').text(formatItNumber(ucsC));
                $('#formula-fascia-a').text('164,53*' + oreA);
                $('#formula-fascia-b').text('131,63*' + oreB);
                $('#formula-fascia-c').text('82,27*' + oreC);
                $('#totale-complessivo').text(formatItNumber(totaleComplessivo));

                var $msgVincoloOre = $('#vincolo-ore-msg');
                var $btnSalva = $('#btn-salva-datieconomici');

                if (totaleOre === ORE_TOTALI_ATTESE) {
                    $msgVincoloOre
                        .text('Vincolo ore rispettato.')
                        .removeClass('text-danger text-muted')
                        .addClass('text-success');
                    $btnSalva.prop('disabled', false);
                } else if (totaleOre < ORE_TOTALI_ATTESE) {
                    $msgVincoloOre
                        .text('Mancano ' + (ORE_TOTALI_ATTESE - totaleOre) + ' ore per arrivare a 404.')
                        .removeClass('text-success text-muted')
                        .addClass('text-danger');
                    $btnSalva.prop('disabled', true);
                } else {
                    $msgVincoloOre
                        .text('Superate di ' + (totaleOre - ORE_TOTALI_ATTESE) + ' ore rispetto a 404.')
                        .removeClass('text-success text-muted')
                        .addClass('text-danger');
                    $btnSalva.prop('disabled', true);
                }
            }

            $('#ore_presunte_fascia_a, #ore_presunte_fascia_b, #ore_presunte_fascia_c').on('input change', aggiornaRiepilogoEconomico);

            aggiornaRiepilogoEconomico();
        });
    </script>
@endsection
