<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Workforce\DeterminaOreTotaliService;

use Illuminate\Http\Request;
use App\Models\Person;

class CodiceFiscaleController extends Controller
{

    public function check(Request $request)
    {
        $cf = strtoupper($request->cf);
        $notice_id = $request->notice_id;

        $person = Person::where('cf', $cf)->first();
        $exists = $person !== null;
        $hasTeacherAttendance = false;

        if($exists) {
            $hasTeacherAttendance = $person->teacherAttendances()->exists()
                || $person->groupTeacherAttendances()->exists()
                || $person->tutorAttendances()->exists()
                || $person->sostegnoAttendances()->exists();
        }

        return response()->json([
            'anagrafica_presente' => $exists,
            'ha_ore' => $hasTeacherAttendance
        ]);
    }
}


/*
$url = 'https://kodek.it/api/verifica-codice-fiscale/'. $cf;

$json = file_get_contents($url);
$datiJson = json_decode($json, true);

if ($datiJson['esiste'] ?? false) {
    echo "Esiste\n";
}

if ($datiJson['ha_ore'] ?? false) {
    echo "Ha ore\n";
}

*/
