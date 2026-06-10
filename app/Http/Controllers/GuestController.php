<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\Request as CustomerRequest;

class GuestController extends Controller
{
    public function storeAppointment(Request $request)
    {
        $customer = $request->customer;
        $customerId = $this->storeCustomer($customer);

        Appointment::create([
            'customer_id'               =>       $customerId,
            'appointment_type_id'       =>       $request->appointment_type_id,
            'message'                   =>       $request->message,
            'date'                      =>       $request->date,
            'hour'                      =>       $request->hour
        ]);

    }

    public function storeRequest(Request $request)
    {
        $customer = $request->customer;
        $date = now()->format('Y-m-d');
        $customerId = $this->storeCustomer($customer);


        CustomerRequest::create([
            'customer_id'               =>       $customerId,
            'request_type_id'           =>       $request->request_type_id,
            'message'                   =>       $request->message,
            'date'                      =>       $date
        ]);

    }

    public function storeCustomer($customer)
    {
        $newCustomer = Customer::create([
            'name'              =>       $customer['first_name'],
            'last_name'         =>       $customer['last_name'],
            'phone'             =>       $customer['phone'],
            'email'             =>       $customer['email']
        ]);

        return $newCustomer->id;
    }
}
