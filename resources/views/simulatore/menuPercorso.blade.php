            <div class="row text-right">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="btn-group rounded">

                        <a href="{{ route('simulatore.showPercorsi', [$SimulatorPlayer->id, $percorso->formazione_id]) }}"
                            class="btn default ">Elenco edizioni</a>
                        <!--<a href="" class="btn default">Torna all'elenco iscritti</a>-->
                        <a href="{{ route('simulatore.showDettagliPercorso', [$SimulatorPlayer->id, $percorso->id]) }}"
                            class="btn blue">Dettaglio</a>&nbsp;
                        <a href="{{ route('simulatore.showPartecipanti', [$SimulatorPlayer->id, $percorso->id]) }}"
                            class="btn blue">Partecipanti</a>&nbsp;
                        <a href="{{ route('simulatore.showPersonale', [$SimulatorPlayer->id, $percorso->id]) }}"
                            class="btn blue">Personale non docente</a>&nbsp;


                        <a href="{{ route('simulatore.showStage', [$SimulatorPlayer->id, $percorso->id]) }}"
                            class="btn blue">Stage</a>&nbsp;

                        <a href="{{ route('simulatore.showDatiEconomici', [$SimulatorPlayer->id, $percorso->id]) }}"
                            class="btn yellow">Dati economici</a>&nbsp;
                        <a href="{{ route('simulatore.showVerifica', [$SimulatorPlayer->id, $percorso->id]) }}"
                            class="btn red">Verifica e conferma P.E.</a>&nbsp;

                    </div>
                </div>
            </div>
