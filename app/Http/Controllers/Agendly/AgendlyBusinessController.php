<?php

namespace App\Http\Controllers\Agendly;

use Inertia\Inertia;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\AgendlyBusiness;
use App\Models\AgendlyAppointments;
use App\Http\Controllers\Controller;
use App\Models\AgendlyBusinessCategory;
use App\Models\AgendlyBussinessSettings;

class AgendlyBusinessController extends Controller
{
    public function index(Request $request)
    {
        $userId = auth()->id();

        $business = AgendlyBusiness::where('user_id', $userId)->first();

        $businessAppointments = AgendlyAppointments::where('business_user_id', $userId)->get();

        return Inertia::render('Agendly/Business/BusinessDashboard', compact('businessAppointments'));
    }

    public function showBusinessConfiguration(Request $request)
    {
        $businessSettings = AgendlyBussinessSettings::where('user_id', auth()->id())->first();

        return Inertia::render('Agendly/Business/BusinessAvailability', compact('businessSettings'));
    }

    public function showBusinessProfile(Request $request)
    {
        $user = User::with('business')->find(auth()->id());
        $businessCategories = AgendlyBusinessCategory::get();
        
        return Inertia::render('Agendly/Business/BusinessProfile', compact('user', 'businessCategories'));
    }

    public function updateAppointmentState(Request $request)
    {
        $appointment = AgendlyAppointments::where('id', $request->appointmentId)->first();

        $appointment->update([
            'state_id' => $request->stateId
        ]);
    }
}
