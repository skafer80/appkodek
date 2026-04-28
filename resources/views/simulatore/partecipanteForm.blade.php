@extends('layouts.regione')

@section('content')
    <div class="page-content-wrapper">
        <div class="page-content" style="background-color: #f5f5f5!important;">
            @include('simulatore.menuPercorso')
            <hr>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-right">
                <div class="btn-group">
                    <a href="{{ route('simulatore.showPartecipanti', [$SimulatorPlayer->id, $percorso->id]) }}" class="btn default">Torna indietro</a>
                    <button type="submit" form="partecipante-form" class="btn blue">
                        <i class="fa fa-check-circle"></i>&nbsp;Salva
                    </button>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">&nbsp;</div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-user"></i>{{ isset($partecipante) ? 'Dettagli partecipante' : 'Nuovo partecipante' }}
                        </div>
                    </div>
                    <div class="portlet-body">
                        @if (isset($partecipante))
                            <form id="delete-partecipante-form" method="POST" action="{{ route('simulatore.eliminaPartecipante', [$SimulatorPlayer->id, $partecipante->id]) }}" style="display:none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        @endif

                        <form id="partecipante-form" method="POST" action="{{ route('simulatore.memorizzaPartecipante', [$SimulatorPlayer->id, $percorso->id]) }}" accept-charset="UTF-8" class="form-horizontal form-row-seperated">
                            @csrf
                            @if (isset($partecipante))
                                <input name="partecipante_id" type="hidden" value="{{ $partecipante->id }}">
                            @endif

                            @if (!isset($partecipante) && !empty($captchaImageDataUri))
                                <fieldset>
                                    <legend class="bold text-center">CODICE DI CONTROLLO</legend>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                                            <img src="{{ $captchaImageDataUri }}" alt="Captcha" style="width:250px;outline:solid 2px black;">
                                            <br>
                                            <br>
                                            <b>DIGITA I CARATTERI VISUALIZZATI SOPRA</b>
                                            <br>
                                            <b class="text-danger">RISPETTANDO MAIUSCOLO/MINUSCOLO</b>
                                            <br>
                                            <br>
                                            <input
                                                type="text"
                                                name="captcha_code"
                                                class="text-center"
                                                style="text-transform:none!important;width:250px;padding:9px;border:solid 2px black;"
                                                placeholder="Digita i caratteri sopra"
                                                value="{{ old('captcha_code') }}"
                                                required
                                            >
                                        </div>
                                    </div>
                                </fieldset>

                                <br>
                                <br>
                            @endif

                            <fieldset>
                                <legend class="bold">Dati Anagrafici</legend>
                                <div class="row">
                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <label for="t_codice_fiscale" class="control-label required">Codice Fiscale</label>
                                        <input class="form-control required" placeholder="Codice Fiscale" required name="t_codice_fiscale" type="text" id="t_codice_fiscale" maxlength="16" value="{{ old('t_codice_fiscale', $partecipante->t_codice_fiscale ?? '') }}">
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <label for="b_disabile" class="control-label required">Disabile/Categoria protetta</label>
                                        <select class="form-control" required id="b_disabile" name="b_disabile">
                                            <option value="N" @selected(old('b_disabile', isset($partecipante) ? ($partecipante->b_disabile ? 'Y' : 'N') : 'N') === 'N')>No</option>
                                            <option value="Y" @selected(old('b_disabile', isset($partecipante) ? ($partecipante->b_disabile ? 'Y' : 'N') : 'N') === 'Y')>Si</option>
                                        </select>
                                    </div>
                                </div>
                            </fieldset>

                            <br>

                            <fieldset>
                                <legend class="bold">Dati residenza</legend>
                                <div class="row">
                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <label for="t_r_provincia" class="control-label required">Provincia</label>
                                        <select class="form-control required" required id="t_r_provincia" name="t_r_provincia">
                                            <option value="" selected>Seleziona un valore</option>
                                            @foreach ($province as $sigla)
                                                <option value="{{ $sigla }}" @selected(old('t_r_provincia', $partecipante->t_r_provincia ?? '') === $sigla)>{{ $sigla }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <label for="t_r_comune" class="control-label required">Comune</label>
                                        <select class="form-control required" required id="t_r_comune" name="t_r_comune" data-selected="{{ old('t_r_comune', $partecipante->t_r_comune ?? '') }}">
                                            <option value="" selected>Seleziona Provincia</option>
                                        </select>
                                    </div>
                                </div>
                            </fieldset>

                            <br>

                            <fieldset>
                                <legend class="bold">Dati domicilio - <span class="text-danger">Compilare se il domicilio e diverso dalla residenza</span></legend>
                                <div class="row">
                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <label for="t_d_provincia" class="control-label">Provincia</label>
                                        <select class="form-control" id="t_d_provincia" name="t_d_provincia">
                                            <option value="" selected>Seleziona un valore</option>
                                            @foreach ($province as $sigla)
                                                <option value="{{ $sigla }}" @selected(old('t_d_provincia', $partecipante->t_d_provincia ?? '') === $sigla)>{{ $sigla }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <label for="t_d_comune" class="control-label">Comune</label>
                                        <select class="form-control" id="t_d_comune" name="t_d_comune" data-selected="{{ old('t_d_comune', $partecipante->t_d_comune ?? '') }}">
                                            <option value="" selected>Seleziona Provincia</option>
                                        </select>
                                    </div>
                                </div>
                            </fieldset>

                            <br>

                            <fieldset>
                                <legend class="bold">Condizione occupazionale</legend>
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        @php
                                            $condizione = (string) old('i_tipo_condizione_occupazionale_id', $partecipante->i_tipo_condizione_occupazionale_id ?? '10');
                                        @endphp
                                        <div class="radio" style="margin-bottom:10px;">
                                            <label style="display:block;line-height:1.4;"><input id="i_tipo_condizione_occupazionale_id8" name="i_tipo_condizione_occupazionale_id" type="radio" value="8" @checked($condizione === '8')> 01 Inoccupato</label>
                                        </div>
                                        <div class="radio" style="margin-bottom:10px;">
                                            <label style="display:block;line-height:1.4;"><input id="i_tipo_condizione_occupazionale_id10" name="i_tipo_condizione_occupazionale_id" type="radio" value="10" @checked($condizione === '10')> 03 Disoccupato</label>
                                        </div>
                                        <div class="radio">
                                            <label style="display:block;line-height:1.4;"><input id="i_tipo_condizione_occupazionale_id12" name="i_tipo_condizione_occupazionale_id" type="radio" value="12" @checked($condizione === '12')> 05 Inattivo</label>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>

                            <div class="row" style="margin-top: 20px;">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-right">
                                    @if (isset($partecipante))
                                        <button type="submit" form="delete-partecipante-form" class="btn btn-danger" style="margin-right: 8px;" onclick="return confirm('Sei sicuro di voler eliminare questo partecipante?')">Elimina</button>
                                    @endif
                                    <button class="btn btn-large blue" type="submit">
                                        <i class="fa fa-check-circle"></i>&nbsp;Salva
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        jQuery(document).ready(function() {
            var comuniBySigla = @json($comuniBySigla);

            function fillComuni(siglaSelector, comuneSelector) {
                var sigla = $(siglaSelector).val();
                var $comune = $(comuneSelector);
                var selected = $comune.data('selected') || '';

                $comune.empty();
                $comune.append('<option value="">Seleziona Provincia</option>');

                if (!sigla || !comuniBySigla[sigla]) {
                    return;
                }

                $.each(comuniBySigla[sigla], function(_, comune) {
                    var isSelected = selected === comune ? ' selected' : '';
                    $comune.append('<option value="' + comune + '"' + isSelected + '>' + comune + '</option>');
                });

                $comune.data('selected', '');
            }

            $('#t_r_provincia').on('change', function() {
                fillComuni('#t_r_provincia', '#t_r_comune');
            });

            $('#t_d_provincia').on('change', function() {
                fillComuni('#t_d_provincia', '#t_d_comune');
            });

            fillComuni('#t_r_provincia', '#t_r_comune');
            fillComuni('#t_d_provincia', '#t_d_comune');
        });
    </script>
@endsection
