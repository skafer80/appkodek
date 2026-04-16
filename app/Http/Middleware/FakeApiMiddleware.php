<?php

namespace App\Http\Middleware;

use App\Services\ClassiApiService;
use App\Services\DatiClasseApiService;
use App\Services\Fake\ClassiApiServiceFake;
use App\Services\Fake\DatiClasseApiServiceFake;
use App\Services\Fake\ModuliApiServiceFake;
use App\Services\Fake\PersonaleApiServiceFake;
use App\Services\Fake\StudentiApiServiceFake;
use App\Services\ModuliApiService;
use App\Services\PersonaleApiService;
use App\Services\StudentiApiService;
use Closure;
use Illuminate\Http\Request;

class FakeApiMiddleware
{
    public function handle(Request $request, Closure $next): mixed
    {
        // Aggiorna il flag di sessione in base alla route visitata
        if ($request->is('provadati*')) {
            session(['fake_api_mode' => true]);
        } elseif ($request->is('progettazione*')) {
            session(['fake_api_mode' => false]);
        }

        // Se la sessione ha il flag attivo, sostituisce i servizi reali con i fake
        // (vale anche per le richieste AJAX di Livewire /livewire/update)
        if (session('fake_api_mode')) {
            app()->bind(ClassiApiService::class, ClassiApiServiceFake::class);
            app()->bind(DatiClasseApiService::class, DatiClasseApiServiceFake::class);
            app()->bind(ModuliApiService::class, ModuliApiServiceFake::class);
            app()->bind(PersonaleApiService::class, PersonaleApiServiceFake::class);
            app()->bind(StudentiApiService::class, StudentiApiServiceFake::class);
        }

        return $next($request);
    }
}
