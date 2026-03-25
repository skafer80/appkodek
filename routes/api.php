<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ComuneController;
use App\Http\Controllers\Api\ModuloConoscenzaController;
use Illuminate\Support\Facades\Storage;

Route::get('/comuni', [ComuneController::class, 'getComuniByProvincia'])->name('api.comuni');

Route::get('/modulo-conoscenza/{id}', [ModuloConoscenzaController::class, 'show'])->name('api.modulo_conoscenza.show');

Route::post('/modulo-conoscenza', [ModuloConoscenzaController::class, 'store']);

Route::post('/moduloother', [ModuloConoscenzaController::class, 'storeOther']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/test-qnap', function () {
    try {
        Storage::disk('qnap')->put("test_laravel.txt", "Funziona! " . now());
        return "File creato con successo sul NAS!";
    } catch (\Exception $e) {
        return "Errore: " . $e->getMessage();
    }
});
