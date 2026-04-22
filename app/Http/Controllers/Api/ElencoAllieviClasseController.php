<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ElencoAllieviClasseController extends Controller
{
    public function execute(Request $request)
    {
        if (! in_array($request->ip(), ['93.95.216.134', '93.95.216.134'])) {
            Log::info('API elenco-allievi-classe request', [
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'classeId' => $request->classeId,
            ]);
        }
        $classeId = $request->classeId;
        $response = Http::get('https://www.kodek.it/api/elenco-allievi-classe/'.$classeId);

        return response()->json($response->json());
    }
}
