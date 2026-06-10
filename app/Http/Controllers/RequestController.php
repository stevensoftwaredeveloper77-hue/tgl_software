<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Customer;
use App\Models\RequestType;
use Illuminate\Http\Request;
use App\Models\Request As CustomerRequest;

class RequestController extends Controller
{
    public function index(Request $request)
    {
        $requests = CustomerRequest::leftjoin('request_types', 'requests.request_type_id', 'request_types.id')
        ->leftjoin('customers', 'requests.customer_id', 'customers.id')
        ->select('requests.*', 'request_types.name AS requestType', 'customers.name', 'customers.last_name')
        ->get();

        $requestTypes = RequestType::select('request_types.id AS id', 'request_types.name AS description')->get();
        $customers = Customer::selectRaw("id, CONCAT(name, ' ', last_name) AS description")->get();

        return Inertia::render('Request/AdminRequest', compact('requests', 'requestTypes', 'customers'));
    }

    public function store(Request $request)
    {
        CustomerRequest::create([
            'customer_id'               =>       $request->customer_id,
            'request_type_id'           =>       $request->request_type_id,
            'message'                   =>       $request->message,
            'date'                      =>       $request->date,
        ]);
    }

    public function update(Request $request, $requestId)
    {

        $request = CustomerRequest::find($requestId);
        
        $request->customer_id           =   $request->customer_id;
        $request->message               =   $request->message;
        $request->request_type_id       =   $request->request_type_id;
        $request->date                  =   $request->date;

        $request->save();
    }

    public function delete(Request $request)
    {
        $request = CustomerRequest::find($request->requestId);
        $request->delete();

        $requests = CustomerRequest::leftjoin('request_types', 'requests.request_type_id', 'request_types.id')
        ->leftjoin('customers', 'requests.customer_id', 'customers.id')
        ->select('requests.*', 'request_types.name AS requestType', 'customers.name', 'customers.last_name')
        ->get();

        return $requests;
    }
}
