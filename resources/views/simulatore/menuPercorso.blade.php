            <div class="row text-right">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="btn-group rounded">

                        <a href="{{ route('simulatore.showPercorsi', [$SimulatorPlayer->id, $percorso->formazione_id]) }}"
                            class="btn default ">Elenco edizioni</a>
                        <!--<a href="" class="btn default">Torna all'elenco iscritti</a>-->
                        <a href="{{ route('simulatore.showDettagliPercorso', [$SimulatorPlayer->id, $percorso->id]) }}"
                            class="btn blue">Dettaglio</a>&nbsp;
                        <a href="https://fse.regione.sicilia.it/avvisoPOC/pe/aV9kb21hbmRhX2lkPTE4OQ==/allievi/aV9lZGl6aW9uZV9pZD0yNjg0"
                            class="btn blue">Partecipanti</a>&nbsp;
                        <a href="{{ route('simulatore.showPersonale', [$SimulatorPlayer->id, $percorso->id]) }}"
                            class="btn blue">Personale non docente</a>&nbsp;


                        <a href="{{ route('simulatore.showStage', [$SimulatorPlayer->id, $percorso->id]) }}"
                            class="btn blue">Stage</a>&nbsp;

                        <a href="{{ route('simulatore.showDatiEconomici', [$SimulatorPlayer->id, $percorso->id]) }}"
                            class="btn yellow">Dati economici</a>&nbsp;
                        <a href="https://fse.regione.sicilia.it/avvisoPOC/pe/verificaeconferma/eyJpdiI6IlJLNklaL0NsQ1YvZEtkRktldzVESFE9PSIsInZhbHVlIjoiZnpuWk01TnJYUHJoTFQ3NE90VHhjdz09IiwibWFjIjoiNDFiNDY3ZTY4MzNlZWI1NTE2MzU0ZDQxNjczMjRlMDYxOThhZmY3MmRmODExOGRiYzI4OWQxY2EwYTFhMWI0NSIsInRhZyI6IiJ9/eyJpdiI6IkNHNU4zMUJFNFNYNEJqWnJNa0krY0E9PSIsInZhbHVlIjoiYWZrbTBvaDdaaDJOVUtkSWFHWkpXdz09IiwibWFjIjoiY2IzNTZlNzQwMmIwNTJjMjM2ZTY2N2Q0MzA3Njg5ZjQ2MTk5OTdlNTNlOTc3MTM5Mzk1NjgwMTM0MmQ0N2JkYyIsInRhZyI6IiJ9"
                            class="btn red">Verifica e conferma P.E.</a>&nbsp;

                    </div>
                </div>
            </div>
