<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Login', [
            'canResetPassword' => Route::has('password.request'),
            'status' => session('status'),
        ]);
    }

    /**
     * Handle an incoming authentication request.
     */
    // public function store(LoginRequest $request): RedirectResponse
    // {
    //     $request->authenticate();
    //     $request->session()->regenerate();
    //     return redirect()->intended(route('dashboard', absolute: false));
    // }

    public function store(LoginRequest $request): RedirectResponse
{
    $request->authenticate();

    $request->session()->regenerate();

    /** @var \App\Models\User $user */ // <--- Esto le dice al editor exactamente qué métodos tiene el usuario
    $user = auth()->user();

    // 2. Evaluamos el rol y definimos la ruta de destino
    // Usamos 'match' para que el código sea limpio y moderno
    $url = match (true) {
        $user->hasRole('admin')   => route('dashboard'),
        $user->hasRole('negocio') => route('agendly.business.index'),
        $user->hasRole('cliente') => route('agendly.client.index'),
        default                   => route('dashboard'), // Ruta por defecto
    };

    // 3. Redirigimos a la URL destinada o a nuestra variable $url
    return redirect()->intended($url);
}

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function agendlyLogout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/agendly');
    }
}
