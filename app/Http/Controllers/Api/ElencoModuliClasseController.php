<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ElencoModuliClasseController extends Controller
{
    public function execute(Request $request)
    {

        $classeId = $request->classeId;

        $response = Http::get('https://www.kodek.it/api/elenco-moduli-classe/' . $classeId);

        return response()->json($response->json());
    }
}
