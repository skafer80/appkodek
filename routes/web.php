<?php

use App\Http\Controllers\allenamentoController;
use App\Http\Controllers\clickController;
use App\Http\Controllers\datiProgettazioneController;
use App\Http\Controllers\provaDatiController;
use App\Http\Controllers\simulatore\HomeController;
use App\Http\Controllers\simulatore\propostaFormaticaController;
use App\Http\Controllers\simulatore\memorizzaController;
use Illuminate\Support\Facades\Route;

Route::get('/click', [clickController::class, 'index'])->name('click.index');
// Route::get('/click/{id}', [clickController::class, 'show'])->name('click.show');
Route::post('/click', [clickController::class, 'store'])->name('click.store');
Route::get('/click/classe/{id}', [clickController::class, 'showClasse'])->name('click.showClasse');
Route::get('/click/create/{id}', [clickController::class, 'createDestinatario'])->name('click.createDestinatario');
Route::post('/click/storeDestinatario', [clickController::class, 'storeDestinatario'])->name('click.storeDestinatario');
Route::get('/click/moduloconoscenza/{id}', [clickController::class, 'getModulo'])->name('click.getModulo');
Route::post('/click/editModulo', [clickController::class, 'editModuli'])->name('click.editModuli');
Route::get('/click/moduli/{id}', [clickController::class, 'showModuli'])->name('click.showModuli');
Route::get('/click/classePersonale/{id}', [clickController::class, 'showClassePersonale'])->name('click.showClassePersonale');
Route::get('/click/createPersonale/{id}', [clickController::class, 'createPersonale'])->name('click.createPersonale');
Route::post('/click/storePersonale', [clickController::class, 'storePersonale'])->name('click.storePersonale');
Route::get('/eweb/config', [clickController::class, 'ewebShow'])->name('click.eweb');
Route::get('/eweb/enti', [clickController::class, 'ewebEnti'])->name('click.ewebEnti');
Route::get('/click/tabella-selezione', [clickController::class, 'tabellaSelezione'])->name('click.tabellaSelezione');

Route::get('/progettazione3006', [datiProgettazioneController::class, 'datiProgettazione'])->name('progettazione.dati');
Route::get('/progettazione3006/stampa/{classeId}', [datiProgettazioneController::class, 'stampaClasse'])->name('progettazione.stampa');

Route::get('/provadati', [provaDatiController::class, 'datiProgettazione'])->name('provadati.dati');
Route::get('/provadati/stampa/{classeId}', [provaDatiController::class, 'stampaClasse'])->name('provadati.stampa');

Route::get('/allenamento', [allenamentoController::class, 'index'])->name('allenamento.index');
Route::get('/allenamento/{id}', [allenamentoController::class, 'show'])->name('allenamento.show');
Route::post('/allenamento', [allenamentoController::class, 'store'])->name('allenamento.store');
Route::get('/allenamento/classe/{id}', [allenamentoController::class, 'showClasse'])->name('allenamento.showClasse');
Route::get('/allenamento/create/{id}', [allenamentoController::class, 'createDestinatario'])->name('allenamento.createDestinatario');
Route::post('/allenamento/storeDestinatario', [allenamentoController::class, 'storeDestinatario'])->name('allenamento.storeDestinatario');
Route::get('/allenamento/getModulo/{id}', [allenamentoController::class, 'getModulo'])->name('allenamento.getModulo');
Route::post('/allenamento/editModulo', [allenamentoController::class, 'editModuli'])->name('allenamento.editModuli');
Route::get('/allenamento/moduli/{id}', [allenamentoController::class, 'showModuli'])->name('allenamento.showModuli');

// Route::view('/', 'welcome')->name('home');

// Route::redirect('/', '/click')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});
Route::prefix('play/{SimulatorPlayer}')->group(function () {
    Route::get('/simulatore', [propostaFormaticaController::class, 'index'])->name('simulatore.index');
    Route::get('/simulatore/moduli/{id}', [propostaFormaticaController::class, 'showModuli'])->name('simulatore.showModuli');
    Route::get('/simulatore/getModulo/{id}', [propostaFormaticaController::class, 'getModulo'])->name('simulatore.getModulo');
    Route::post('/simulatore/editModulo', [propostaFormaticaController::class, 'editModuli'])->name('simulatore.editModuli');
    Route::get('/simulatore/percorsi/{id}', [propostaFormaticaController::class, 'showPercorsi'])->name('simulatore.showPercorsi');
    Route::get('/simulatore/dettagli-percorso/{id}', [propostaFormaticaController::class, 'showDettagliPercorso'])->name('simulatore.showDettagliPercorso');
    Route::get('/simulatore/dati-economici/{id}', [propostaFormaticaController::class, 'showDatiEconomici'])->name('simulatore.showDatiEconomici');
    Route::get('/simulatore/stage/{id}', [propostaFormaticaController::class, 'showStage'])->name('simulatore.showStage');
    Route::get('/simulatore/personale/{id}', [propostaFormaticaController::class, 'showPersonale'])->name('simulatore.showPersonale');
    Route::get('/simulatore/personale/{id}/nuovo', [propostaFormaticaController::class, 'showCreatePersonale'])->name('simulatore.showCreatePersonale');
    Route::get('/simulatore/personale/{id}/dettaglio/{personale}', [propostaFormaticaController::class, 'showDettaglioPersonale'])->name('simulatore.showDettaglioPersonale');
    Route::get('/simulatore/impresa/{id}', [propostaFormaticaController::class, 'showImpresa'])->name('simulatore.showImpresa');

    Route::post('/simulatore/memorizza-dettagli-percorso/{classroom}', [memorizzaController::class, 'dettagliPercorso'])->name('simulatore.memorizzaDettagliPercorso');
    Route::post('/simulatore/memorizza-dettagli-stage/{classroom}', [memorizzaController::class, 'dettagliStage'])->name('simulatore.memorizzaDettagliStage');
    Route::post('/simulatore/memorizza-personale/{classroom}', [memorizzaController::class, 'dettagliPersonale'])->name('simulatore.memorizzaDettagliPersonale');
    Route::post('/simulatore/memorizza-impresa/{classroom}', [memorizzaController::class, 'dettagliImpresa'])->name('simulatore.memorizzaDettagliImpresa');
    Route::post('/simulatore/dati-economici/{classroom}', [memorizzaController::class, 'dettagliDatiEconomici'])->name('simulatore.memorizzaDatiEconomici');

    Route::delete('/simulatore/elimina-personale/{personale}', [memorizzaController::class, 'eliminaPersonale'])->name('simulatore.eliminaPersonale');
    Route::delete('/simulatore/elimina-impresa/{impresa}', [memorizzaController::class, 'eliminaImpresa'])->name('simulatore.eliminaImpresa');
});

/*
Route::get('/simulatore', [propostaFormaticaController::class, 'index'])->name('simulatore.index');
Route::get('/simulatore/moduli/{id}', [propostaFormaticaController::class, 'showModuli'])->name('simulatore.showModuli');
Route::get('/simulatore/percorsi/{id}', [propostaFormaticaController::class, 'showPercorsi'])->name('simulatore.showPercorsi');
Route::get('/simulatore/dettagli-percorso/{id}', [propostaFormaticaController::class, 'showDettagliPercorso'])->name('simulatore.showDettagliPercorso');
Route::get('/simulatore/dati-economici/{id}', [propostaFormaticaController::class, 'showDatiEconomici'])->name('simulatore.showDatiEconomici');
Route::get('/simulatore/stage/{id}', [propostaFormaticaController::class, 'showStage'])->name('simulatore.showStage');
Route::get('/simulatore/impresa/{id}', [propostaFormaticaController::class, 'showImpresa'])->name('simulatore.showImpresa');
*/

Route::get('/', [HomeController::class, 'index'])->name('simulatore.home');

require __DIR__.'/settings.php';
