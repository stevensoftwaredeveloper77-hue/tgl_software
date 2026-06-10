<?php

namespace App\Http\Controllers\Agendly;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\AgendlyBusiness;
use App\Http\Controllers\Controller;
use App\Models\AgendlyAppointments;
use App\Models\AgendlyBusinessCategory;
use App\Models\AgendlyBussinessSettings;

class AgendlyClientController extends Controller
{
    public function index(Request $request)
    {
        $businesses = AgendlyBusiness::get();
        $businessCategories = AgendlyBusinessCategory::get();

        return Inertia::render('Agendly/Client/ClientExplore', compact('businesses', 'businessCategories'));
    }

    public function showBusinessDetail($id)
    {
        $business = AgendlyBusiness::with('category')->findOrFail($id);
        $businessSettings = AgendlyBussinessSettings::where('user_id', $business->user_id)->first();

        return Inertia::render('Agendly/Client/ClientBusinessDetail',compact('business', 'businessSettings'));
    }

    public function storeAppointment(Request $request)
    {
        $userId = auth()->id();

        AgendlyAppointments::create([
            'customer_user_id'          =>       $userId,
            'business_user_id'          =>       $request->businessId,
            'reason'                    =>       $request->reason,
            'date'                      =>       $request->date,
            'hour'                      =>       $request->hour,
            'state_id'                  =>       1
        ]);
    }

    public function showAppointments(Request $request)
    {
        $userId = auth()->id();

        $clientAppointments = AgendlyAppointments::where('customer_user_id', $userId)->get();

        return Inertia::render('Agendly/Client/ClientAppointments', compact('clientAppointments'));
    }

    public function showProfile()
    {
        return Inertia::render('Agendly/Client/ClientProfile');

    }
}
