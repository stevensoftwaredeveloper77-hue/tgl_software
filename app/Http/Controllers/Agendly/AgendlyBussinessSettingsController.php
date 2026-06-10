<?php

namespace App\Http\Controllers\Agendly;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\AgendlyBussinessSettings;

class AgendlyBussinessSettingsController extends Controller
{
    public function store(Request $request)
    {

        // dd($request);
        $validated = $request->validate([
            'availability' => 'required|array',
            'availability.*.active' => 'required|boolean',
            'availability.*.start' => 'required|string',
            'availability.*.end' => 'required|string',
            'duration' => 'required|integer|min:1',
        ]);

        AgendlyBussinessSettings::updateOrCreate(
            ['user_id' => Auth::id()], 
            [
                'availability' => $validated['availability'],
                'duration' => $validated['duration'],
            ]
        );
    }
}
