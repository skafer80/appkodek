@extends('layouts.regione')

@section('content')
    <div class="page-content-wrapper">
        <div class="page-content" style="background-color: #f5f5f5!important;">

            <a href="{{ route('propostaformatica.showDettagliPercorso', $percorso->id) }}"
                class="d-inline-block mb-5 p-2 bg-blue underline-off-i"><i class="fa fa-long-arrow-left" "="" aria-hidden=" true"></i>&nbsp;Indietro</a>


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

                    <form method="post" action="https://fse.regione.sicilia.it/avvisoPOC/pe/ore-presunte"></form>
                        <input type="hidden" name="_token" value="LThRShcEdk9UxInaZ6o0eKZZvr9fyXzIKbBX4xPn" autocomplete="off">                    <input type="hidden" name="id_edizione" value="eyJpdiI6InBZbHp4eXRJVW9CUGxQeWJNdVNKQ3c9PSIsInZhbHVlIjoiR01QVjk3TVdJWU1lWFJNcjhDVmtOZz09IiwibWFjIjoiNDZiNTUzODc5NmY5ODQ0Y2UxOTc2MDY3YWZmZjE4ZWQ3N2Y5YWIwODc1MjRiN2MwNGM2NDllYTBmMDQxMWE2YiIsInRhZyI6IiJ9">
                        <tr class="odd gradeX">
                            <td><strong>Ore presunte aula + FAD</strong></td>
                            <td><input min="162" max="202" class="form-control required" required="required" name="ore_presunte_fascia_a" type="number" value="0"></td>
                            <td><input min="0" max="242" class="form-control required" required="required" name="ore_presunte_fascia_b" type="number" value="0"></td>
                            <td><input min="0" max="101" class="form-control required" required="required" name="ore_presunte_fascia_c" type="number" value="0"></td>
                        </tr>
                        <tr>
                            <td colspan="4" class="text-center"><button class="btn blue" type="submit"><i class="fa fa-check-circle"></i>&nbsp;Salva</button></td>
                        </tr>


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
                <b>Totale</b> 12.340,50
            </th>
        </tr>
        <tr>
            <td>CS1326</td>
            <td>ED2684</td>
            <td>
                Fascia A: 0,00 (164,53*0)<br>
                Fascia B: 0,00 (131,63*0)<br>
                Fascia C: 0,00 (82,27*0)
            </td>
            <td>12.340,50</td>
            <td>0,00</td>
            <td>0,00</td>
        </tr>
    </tbody></table>



                    <!-- END PAGE CONTENT-->
                </div>
            </div>
@endsection
