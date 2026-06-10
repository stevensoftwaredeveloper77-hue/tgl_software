<?php

namespace App\Http\Controllers\Agendly;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AgendlyController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Agendly/LandingPage');
    }
}
