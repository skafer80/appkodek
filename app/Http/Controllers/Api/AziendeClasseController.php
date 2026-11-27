<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AziendeClasseController extends Controller
{
    public function execute(Request $request): JsonResponse
    {
        $response = Http::get("https://www.kodek.it/api/aziende-classe/{$request->classeId}");

        return response()->json($response->throw()->json());
    }
}
