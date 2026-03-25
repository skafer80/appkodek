<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Domain\Students\StudentDomain;

use Illuminate\Http\Request;
use App\Models\Student\Student;

class StatoStudenteController extends Controller
{

    public function check(Request $request)
    {
        $cf = strtoupper($request->cf);

        $studentDomain = app(StudentDomain::class);
        $student = Student::where('cf', $cf)->first();

        if (!$student) {
            return response()->json([
                'libero' => true,
                'classe' => ''
            ]);
        } else {
            $disponibilita = $studentDomain->getDisponibilita($student);
        }


        return response()->json([
            'libero' => $disponibilita->libero,
            'classe' => $disponibilita->classe
        ]);
    }
}
