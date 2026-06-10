<?php

namespace App\Http\Controllers\Agendly;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AgendlyLoginController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Agendly/LoginPage');
    }
}
