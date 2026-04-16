<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\clickController;
use App\Http\Controllers\allenamentoController;
use App\Http\Controllers\datiProgettazioneController;
use App\Http\Controllers\provaDatiController;

Route::get('/click', [clickController::class, 'index'])->name('click.index');
//Route::get('/click/{id}', [clickController::class, 'show'])->name('click.show');
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
Route::get('/progettazione', [datiProgettazioneController::class, 'datiProgettazione'])->name('progettazione.dati');
Route::get('/progettazione/stampa/{classeId}', [datiProgettazioneController::class, 'stampaClasse'])->name('progettazione.stampa');

Route::get('/provadati', [provaDatiController::class, 'datiProgettazione'])->name('provadati.dati');
Route::get('/provadati/stampa/{classeId}', [provaDatiController::class, 'stampaClasse'])->name('provadati.stampa');


/* Route::get('/allenamento', [allenamentoController::class, 'index'])->name('allenamento.index');
Route::get('/allenamento/{id}', [allenamentoController::class, 'show'])->name('allenamento.show');
Route::post('/allenamento', [allenamentoController::class, 'store'])->name('allenamento.store');
Route::get('/allenamento/classe/{id}', [allenamentoController::class, 'showClasse'])->name('allenamento.showClasse');
Route::get('/allenamento/create/{id}', [allenamentoController::class, 'createDestinatario'])->name('allenamento.createDestinatario');
Route::post('/allenamento/storeDestinatario', [allenamentoController::class, 'storeDestinatario'])->name('allenamento.storeDestinatario');
Route::get('/allenamento/getModulo/{id}', [allenamentoController::class, 'getModulo'])->name('allenamento.getModulo');
Route::post('/allenamento/editModulo', [allenamentoController::class, 'editModuli'])->name('allenamento.editModuli');
Route::get('/allenamento/moduli/{id}', [allenamentoController::class, 'showModuli'])->name('allenamento.showModuli'); */

//Route::view('/', 'welcome')->name('home');

Route::redirect('/', '/click')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';
