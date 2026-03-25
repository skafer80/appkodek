<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ElencoAllieviClasseController;
use App\Http\Controllers\Api\ElencoModuliClasseController;
use App\Http\Controllers\Api\ComuneController;




Route::get('/elenco-allievi-classe/{classeId}', [ElencoAllieviClasseController::class, 'execute']);
Route::get('/elenco-moduli-classe/{classeId}', [ElencoModuliClasseController::class, 'execute']);

Route::get('/comuni', [ComuneController::class, 'getComuniByProvincia'])->name('api.comuni');
