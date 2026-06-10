<?php

namespace App\Http\Controllers\Agendly;

use Inertia\Inertia;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\AgendlyBusiness;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Models\AgendlyBusinessCategory;

class AgendlyRegisterUserController extends Controller
{
    public function index(Request $request)
    {
        $businessCategories = AgendlyBusinessCategory::select('agendly_business_categories.id AS id', 'agendly_business_categories.name AS description')->get();

        return Inertia::render('Agendly/RegisterPage', compact('businessCategories'));
    }

    public function store(Request $request): RedirectResponse
    {

        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|string|lowercase|email|max:255|unique:'.User::class,
        //     'password' => ['required', 'confirmed', Rules\Password::defaults()],
        // ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if ($request->role == 'cliente') {
            $user->assignRole('cliente');
        }

        if ($request->role == 'negocio') {
            $user->assignRole('negocio');

            AgendlyBusiness::create([
                'user_id'               => $user->id,
                'name'                  => $request->business_name,
                'description'           => $request->business_description,
                'address'               => $request->business_address,
                'phone'                 => $request->business_phone,
                'email'                 => $request->email,
                'category_id'           => $request->business_category_id
            ]);
        }

        event(new Registered($user));

        Auth::login($user);

        return $request->role == 'cliente' ? redirect(route('agendly.client.index', absolute: false)) : redirect(route('agendly.business.index', absolute: false));
    }



    public function updateProfileBusiness(Request $request)
    {
        $user = Auth::user();

        $user->update([
            'name'  => $request->name,
            'email' => $request->email,
        ]);

        Auth::user()->business()->update([
            'name'        => $request->business_name,
            'description' => $request->business_description,
            'address'     => $request->business_address,
            'phone'       => $request->business_phone,
            'email'       => $request->email,
            'category_id' => $request->business_category_id
        ]);
    }
}
