<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ModuloConoscenzaController extends Controller
{
    public function show($id)
    {
        return response()->json([
            'data' => [
                'id' => $id,
                't_denominazione_conoscenza' => 'Titolo modulo fittizio',
                'ore_conoscenza' => 0,
                'ore_fad_conoscenza' => 0,
                'ore_stage_conoscenza' => 5,
                'b_competenza_trasversale' => 'N', // oppure 'Y'
                't_competenze_correlate' => '1,2,3'
            ]
        ]);
    }

    public function store(Request $request)
    {


        $data = $request->all();
        $logEntry = [
            'timestamp' => date('Y-m-d H:i:s'),
            'data' => $data
        ];

        $filePath = public_path('dati.json');
        $log = [];
        if (file_exists($filePath)) {
            $content = file_get_contents($filePath);
            $log = json_decode($content, true) ?? [];
        }
        $log[] = $logEntry;
        file_put_contents($filePath, json_encode($log, JSON_PRETTY_PRINT));

        return response()->json([
            'data' => [
                'i_ore' => $data['ore_conoscenza'] ?? 0,
                'i_ore_fad' => $data['ore_fad_conoscenza'] ?? 0,
                'i_ore_stage' => $data['ore_stage_conoscenza'] ?? 0,

            ]
        ]);
    }

    public function storeOther(Request $request)
{
    $data = $request->all();

    return response()->json([
        'data' => [
            'id' => $data['id'] ?? rand(1000, 9999),
            't_denominazione' => $data['t_denominazione'] ?? 'Denominazione fittizia',
            'i_ore' => $data['i_ore'] ?? 0,
            'i_ore_fad' => $data['i_ore_fad'] ?? 0,
        ]
    ]);
}
}
