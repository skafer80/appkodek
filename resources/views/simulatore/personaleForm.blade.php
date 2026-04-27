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
                    <a href="{{ route('simulatore.showPersonale', [$SimulatorPlayer->id, $percorso->id]) }}" class="btn default">Torna indietro</a>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">&nbsp;</div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-user"></i>{{ isset($personale) ? 'Dettagli personale non docente' : 'Aggiungi personale non docente' }}
                        </div>
                    </div>
                    <div class="portlet-body">
                        @if (isset($personale))
                            <form id="delete-personale-form" method="POST" action="{{ route('simulatore.eliminaPersonale', [$SimulatorPlayer->id, $personale->id]) }}" style="display:none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        @endif

                        <form method="POST" action="{{ route('simulatore.memorizzaDettagliPersonale', [$SimulatorPlayer->id, $percorso->id]) }}" accept-charset="UTF-8">
                            @csrf
                            @if (isset($personale))
                                <input name="personale_id" type="hidden" value="{{ $personale->id }}">
                            @endif

                            @if (!isset($personale) && !empty($captchaImageDataUri))
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

                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="nome" class="control-label required">Nome</label>
                                        <input class="form-control required" name="nome" type="text" value="{{ old('nome', $personale->nome ?? '') }}" id="nome" required>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="cognome" class="control-label required">Cognome</label>
                                        <input class="form-control required" name="cognome" type="text" value="{{ old('cognome', $personale->cognome ?? '') }}" id="cognome" required>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="cf" class="control-label required">Codice Fiscale</label>
                                        <input class="form-control required" name="cf" type="text" value="{{ old('cf', $personale->cf ?? '') }}" id="cf" required>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="telefono" class="control-label required">Telefono</label>
                                        <input class="form-control required" name="telefono" type="text" value="{{ old('telefono', $personale->telefono ?? '') }}" id="telefono" required>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label for="email" class="control-label required">Email</label>
                                        <input class="form-control required" name="email" type="email" value="{{ old('email', $personale->email ?? '') }}" id="email" required>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label for="data_nascita" class="control-label required">Data di nascita</label>
                                        <input class="form-control date-picker required" name="data_nascita" type="text" value="{{ old('data_nascita', isset($personale) ? \Carbon\Carbon::parse($personale->data_nascita)->format('d/m/Y') : '') }}" id="data_nascita" required>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                                    <div class="form-group">
                                        <label for="ruolo" class="control-label required">Ruolo</label>
                                        <select class="form-control required" id="ruolo" name="ruolo" required>
                                            <option value="">Seleziona una opzione</option>
                                            @foreach (['Direttore di progetto', 'Responsabile amministrativo', 'Tutor', 'REO', 'Altro personale di supporto'] as $ruolo)
                                                <option value="{{ $ruolo }}" @selected(old('ruolo', $personale->ruolo ?? '') === $ruolo)>{{ $ruolo }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                                    <div class="form-group">
                                        <label for="esterno" class="control-label required">Personale esterno</label>
                                        <select class="form-control required" id="esterno" name="esterno" required>
                                            <option value="">Seleziona una opzione</option>
                                            <option value="Y" @selected(old('esterno', isset($personale) ? ($personale->esterno ? 'Y' : 'N') : '') === 'Y')>SI</option>
                                            <option value="N" @selected(old('esterno', isset($personale) ? ($personale->esterno ? 'Y' : 'N') : '') === 'N')>NO</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-right">
                                    @if (isset($personale))
                                        <button type="submit" form="delete-personale-form" class="btn btn-danger" style="margin-right: 8px;" onclick="return confirm('Sei sicuro di voler eliminare questo personale?')">Elimina</button>
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
        $(document).ready(function() {
            $('.date-picker').datepicker({
                format: 'dd/mm/yyyy',
                autoclose: true,
                todayHighlight: true
            });
        });
    </script>
@endsection
