<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DatiClasseController extends Controller
{
    public function execute(Request $request)
    {
        $classeId = $request->classeId;

        $response = Http::get('https://app.kodek.it/test/dati-classe-' . $classeId . '.json');
        /* $response = Http::get('https://www.kodek.it/api/dati-classe/' . $classeId); */

        return response()->json($response->json());
    }
}
