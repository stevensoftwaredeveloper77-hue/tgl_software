<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $customers = Customer::get();

        return Inertia::render('Customer/AdminCustomer', compact('customers'));
    }

    public function store(Request $request)
    {
        Customer::create([
            'name'              =>       $request->name,
            'last_name'         =>       $request->last_name,
            'phone'             =>       $request->phone,
            'email'             =>       $request->email
        ]);
    }

    public function update(Request $request, $customerId)
    {

        $customer = Customer::find($customerId);
        
        $customer->name               =   $request->name;
        $customer->last_name          =   $request->last_name;
        $customer->phone              =   $request->phone;
        $customer->email              =   $request->email;

        $customer->save();
    }

    public function delete(Request $request)
    {
        $customer = Customer::find($request->customerId);
        $customer->delete();

        $customers = Customer::get();
        
        return $customers;
    }
}
