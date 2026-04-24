<!DOCTYPE html>
<!-- saved from url=(0052)https://fse.regione.sicilia.it/avvisoPOC/scegli-ente -->
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Avviso 1/2026 POC 2014-2020 </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="description">
    <meta content="" name="author">
    <meta name="csrf-token" content="LThRShcEdk9UxInaZ6o0eKZZvr9fyXzIKbBX4xPn">

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="{{ asset('regione/css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('regione/font-awesome.min.css') }}">
    <link href="{{ asset('regione/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('regione/uniform.default.css') }}" rel="stylesheet" type="text/css">
    <!-- END GLOBAL MANDATORY STYLES --> <!-- BEGIN PAGE LEVEL STYLES -->
    <link rel="stylesheet" type="text/css" href="{{ asset('regione/clockface.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('regione/datepicker.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('regione/bootstrap-timepicker.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('regione/colorpicker.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('regione/daterangepicker-bs3.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('regione/datetimepicker.css') }}">
    <!-- END PAGE LEVEL STYLES --> <!-- BEGIN THEME STYLES -->
    <link href="{{ asset('regione/style-metronic.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('regione/style.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('regione/style-responsive.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('regione/plugins.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('regione/default.css') }}" rel="stylesheet" type="text/css" id="style_color">
    <link href="{{ asset('regione/custom.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('regione/animate.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('regione/DT_bootstrap.css') }}"> <!-- END THEME STYLES -->
    <link rel="shortcut icon" href="https://fse.regione.sicilia.it/avvisoPOC/images/favicon.ico">

</head>

<body class="page-header-fixed" style="background-color: #f5f5f5!important;">

    <!-- BEGIN HEADER -->

    <style type="text/css">
        header {
            margin-bottom: 2rem;
            padding: 0;
            background-color: #fff;
            box-shadow: 0 0 10px #ccc;
        }

        header * {
            color: #000;
        }

        header *:hover {
            color: #000 !important;
        }
    </style>

    <header>
        <div class="container-fluid">
            <div class="row pt-4 pe-4 pb-4 ps-4">
                <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">

                    <a href="https://fse.regione.sicilia.it/avvisoPOC/home"
                        style="white-space:nowrap;display:inline-block;text-decoration:none;line-height:2rem;">
                        <img id="logo-regione-siciliana" src="{{ asset('regione/logo-regione-siciliana.png') }}"
                            style="display:inline-block;height:4rem;margin:0 0.5rem 0 0;">
                        <span style="display:inline-block;vertical-align:middle;font-size:16px;">Regione Siciliana<br><i
                                style="display:block;font-size:12px;vertical-align:bottom;">Catalogo Regionale
                                dell'Offerta Formativa</i></span>
                        <i class="fa fa-home ms-5 text-warning"></i>&nbsp;</a><a
                        href="https://fse.regione.sicilia.it/avvisoPOC/home" class="d-inline-block text-warning">Elenco
                        corsi</a>

                </div>
                <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 text-center" style="line-height:4rem;">
                    <a href="https://fse.regione.sicilia.it/avvisoPOC/scegli-ente" class="btn green radius-1-i">Cambia
                        soggetto proponente</a>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 text-right" style="line-height:4rem;">
                    <span class="d-inline-block ms-3">Accesso delegato</span>
                    <a href="https://fse.regione.sicilia.it/avvisoPOC/logout"
                        class="d-inline-block ms-3 text-danger text-truncate"
                        title="VGROUP ONLUS">Disconnetti</a>&nbsp;<i class="me-3 fa fa-sign-out text-danger"></i>
                </div>
            </div>
            <div class="row" style="border-top:solid 1px rgb(240,240,240);">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                </div>
            </div>
        </div>

    </header>


    <!-- END HEADER -->
    <div class="page-container" style="margin-top:0;padding-top:0px;background-color: #f5f5f5!important;">

        <style>
            .page-content {
                margin-left: 0px;
            }
        </style>

        <!-- BEGIN CONTENT -->
        @yield('content')

        <!-- END CONTENT -->
    </div>
    <!-- END PAGE -->


    <!-- BEGIN FOOTER -->

    <!-- END FOOTER -->

    <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
    <!-- BEGIN CORE PLUGINS -->
    <script src="{{ asset('regione/jquery-3.6.1.min.js.download') }}" type="text/javascript"></script>
    <script src="{{ asset('regione/jquery-migrate-1.4.1.min.js.download') }}" type="text/javascript"></script>
    <script src="{{ asset('regione/bootstrap.min.js.download') }}" type="text/javascript"></script>
    <script src="{{ asset('regione/bootstrap2-typeahead.min.js.download') }}" type="text/javascript"></script>
    <script src="{{ asset('regione/bootstrap-hover-dropdown.min.js.download') }}" type="text/javascript"></script>
    <script src="{{ asset('regione/jquery.slimscroll.min.js.download') }}" type="text/javascript"></script>
    <script src="{{ asset('regione/jquery.blockui.min.js.download') }}" type="text/javascript"></script>
    <script src="{{ asset('regione/jquery.cokie.min.js.download') }}" type="text/javascript"></script>
    <script src="{{ asset('regione/jquery.uniform.min.js.download') }}" type="text/javascript"></script> <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script type="text/javascript" src="{{ asset('regione/bootstrap-datepicker.js.download') }}"></script>
    <script type="text/javascript" src="{{ asset('regione/bootstrap-datepicker.it.js.download') }}"></script>
    <script type="text/javascript" src="{{ asset('regione/bootstrap-timepicker.min.js.download') }}"></script>
    <script type="text/javascript" src="{{ asset('regione/clockface.js.download') }}"></script>
    <script type="text/javascript" src="{{ asset('regione/moment.min.js.download') }}"></script>
    <script type="text/javascript" src="{{ asset('regione/daterangepicker.js.download') }}"></script>
    <script type="text/javascript" src="{{ asset('regione/bootstrap-colorpicker.js.download') }}"></script>
    <script type="text/javascript" src="{{ asset('regione/bootstrap-datetimepicker.min.js.download') }}"></script> <!-- END PAGE LEVEL PLUGINS --> <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{ asset('regione/app.js.download') }}"></script>
    <script src="{{ asset('regione/components-pickers.js.download') }}"></script>
    <script type="text/javascript" src="{{ asset('regione/jquery.dataTables.js.download') }}"></script> <!-- END PAGE LEVEL SCRIPTS -->
    @yield('scripts')
    <!-- END JAVASCRIPTS -->

</body>

</html>
