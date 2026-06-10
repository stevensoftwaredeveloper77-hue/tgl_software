<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Customer;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\AppointmentType;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        $appointments = Appointment::leftjoin('appointment_types', 'appointments.appointment_type_id', 'appointment_types.id')
        ->leftjoin('customers', 'appointments.customer_id', 'customers.id')
        ->select('appointments.*', 'appointment_types.name AS appointmentType', 'customers.name', 'customers.last_name')
        ->get();

        $appointmentTypes = AppointmentType::select('appointment_types.id AS id', 'appointment_types.name AS description')->get();
        $customers = Customer::selectRaw("id, CONCAT(name, ' ', last_name) AS description")->get();

        return Inertia::render('Appointment/AdminAppointment', compact('appointments', 'appointmentTypes', 'customers'));
    }

    public function store(Request $request)
    {
        Appointment::create([
            'customer_id'               =>       $request->customer_id,
            'appointment_type_id'       =>       $request->appointment_type_id,
            'message'                   =>       $request->message,
            'date'                      =>       $request->date,
            'hour'                      =>       $request->hour,
        ]);
    }

    public function update(Request $request, $appointmentId)
    {

        $appointment = Appointment::find($appointmentId);
        
        $appointment->customer_id           =   $request->customer_id;
        $appointment->message               =   $request->message;
        $appointment->appointment_type_id   =   $request->appointment_type_id;
        $appointment->date                  =   $request->date;
        $appointment->hour                  =   $request->hour;

        $appointment->save();
    }

    public function delete(Request $request)
    {
        $appointment = Appointment::find($request->appointmentId);
        $appointment->delete();

        $appointments = Appointment::leftjoin('appointment_types', 'appointments.appointment_type_id', 'appointment_types.id')
        ->leftjoin('customers', 'appointments.customer_id', 'customers.id')
        ->select('appointments.*', 'appointment_types.name AS appointmentType', 'customers.name', 'customers.last_name')
        ->get();

        return $appointments;
    }
}
