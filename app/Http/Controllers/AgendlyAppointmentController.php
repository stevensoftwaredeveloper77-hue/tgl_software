<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\AgendlyAppointments;

class AgendlyAppointmentController extends Controller
{

    public function index(Request $request)
    {
        $appointments = AgendlyAppointments::get();

        return Inertia::render('Appointment/AdminAppointment', compact('appointments'));
    }

    public function store(Request $request)
    {
        AgendlyAppointments::create([
            'customer_user_id'          =>       $request->customer_user_id,
            'business_user_id'          =>       $request->business_user_id,
            'state_id'                  =>       1,
            'date'                      =>       $request->date,
            'hour'                      =>       $request->hour,
        ]);
    }
}
