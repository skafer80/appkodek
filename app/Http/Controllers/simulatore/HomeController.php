<?php

namespace App\Http\Controllers\simulatore;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('simulatore.home');
    }
}
