<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class EntiSediClassiController extends Controller
{
    public function execute(Request $request)
    {
        $classeId = $request->classeId;
        $response = Http::get('https://kodek.it/api/enti-sedi-classi');

        return response()->json($response->json());
    }
}
