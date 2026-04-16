<?php

namespace App\Http\Controllers;

use App\Services\ClassiApiService;
use App\Services\DatiClasseApiService;
use App\Services\ModuliApiService;
use App\Services\PersonaleApiService;
use App\Services\StudentiApiService;
use Illuminate\Http\Request;
use Throwable;

class provaDatiController extends Controller
{
    public function datiProgettazione(Request $request)
    {
        return view('provadati.dati');
    }

    public function stampaClasse(
        int $classeId,
        ClassiApiService $classiApiService,
        StudentiApiService $studentiApiService,
        ModuliApiService $moduliApiService,
        DatiClasseApiService $datiClasseApiService,
        PersonaleApiService $personaleApiService
    ) {
        $enteSelezionato = '';
        $classeMeta = null;

        try {
            $enti = $classiApiService->getClassi();
            foreach ($enti as $ente) {
                foreach ($ente->classi as $classe) {
                    if ((int) $classe->id === $classeId) {
                        $enteSelezionato = $ente->ente;
                        $classeMeta = $classe;
                        break 2;
                    }
                }
            }
        } catch (Throwable $e) {
            //
        }

        $studenti = [];
        try {
            $studenti = $studentiApiService->getStudenti($classeId)->studenti ?? [];
        } catch (Throwable $e) {
            $studenti = [];
        }

        $moduli = [];
        try {
            $moduli = $moduliApiService->getModuli($classeId)->moduli ?? [];
        } catch (Throwable $e) {
            $moduli = [];
        }

        $datiClasse = null;
        try {
            $datiClasse = $datiClasseApiService->getDatiClasse($classeId);
        } catch (Throwable $e) {
            $datiClasse = null;
        }

        $personale = [];
        if ($enteSelezionato !== '') {
            try {
                $personale = $personaleApiService->getPersonaleByEnte($enteSelezionato)->personale ?? [];
            } catch (Throwable $e) {
                $personale = [];
            }
        }

        return view('progettazione.stampa-classe', [
            'classeId'        => $classeId,
            'enteSelezionato' => $enteSelezionato,
            'classeMeta'      => $classeMeta,
            'studenti'        => $studenti,
            'moduli'          => $moduli,
            'datiClasse'      => $datiClasse,
            'personale'       => $personale,
            'generatedAt'     => now(),
        ]);
    }
}
