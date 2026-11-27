<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;


class EntiSediClassiController extends Controller
{
    public function execute(Request $request)
    {
        if (!in_array($request->ip(), ['93.95.216.134', '93.95.216.134'])) {
            Log::info('API enti-sedi-classi request', [
                'ip' => $request->ip(),
                'ips' => $request->ips(), // utile con proxy/load balancer
                'user_agent' => $request->userAgent(),
                'method' => $request->method(),
                'path' => $request->path(),
                'full_url' => $request->fullUrl(),
                'referer' => $request->header('referer'),
                'origin' => $request->header('origin'),
                'accept_language' => $request->header('accept-language'),
                'x_forwarded_for' => $request->header('x-forwarded-for'),
                'host' => $request->getHost(),
            ]);
        }

        $token = (string) config('services.kodek_export.token');
        $requestHttp = Http::acceptJson();

        if ($token !== '') {
            $requestHttp = $requestHttp
                ->withToken($token)
                ->withHeaders(['X-Kodek-Token' => $token]);
        }

        $response = $requestHttp->get('https://www.kodek.it/api/enti-sedi-classi');

        return response()->json($response->json(), $response->status());
    }
}
