<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\GuestController;
use  App\Http\Controllers\VictimController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\JobProfileController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AI\VirtualAgentController;
use App\Http\Controllers\Agendly\AgendlyController;
use App\Http\Controllers\Agendly\AgendlyLoginController;
use App\Http\Controllers\Agendly\AgendlyClientController;
use App\Http\Controllers\Agendly\AgendlyBusinessController;
use App\Http\Controllers\Agendly\AgendlyRegisterUserController;
use App\Http\Controllers\Agendly\AgendlyBussinessSettingsController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


//Guest
Route::post('guest/request/store', [GuestController::class, 'storeRequest'])->name('guest.request.store');
Route::post('guest/appointment/store', [GuestController::class, 'storeAppointment'])->name('guest.appointment.store');

Route::post('/agent/chat', [VirtualAgentController::class, 'chat'])->name('agent.chat');
Route::get('developer/profile', [JobProfileController::class, 'index'])->name('developer.profile.index');

Route::middleware('auth', 'role:admin')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Customers
    Route::get('/customer', [CustomerController::class, 'index'])->name('customer.index');
    Route::post('/customer/store', [CustomerController::class, 'store'])->name('customer.store');
    Route::post('/customer/delete', [CustomerController::class, 'delete'])->name('customer.delete');
    Route::post('/customer/update/{id}', [CustomerController::class, 'update'])->name('customer.update');

    // Appointments
    Route::get('/appointment', [AppointmentController::class, 'index'])->name('appointment.index');
    Route::post('/appointment/store', [AppointmentController::class, 'store'])->name('appointment.store');
    Route::post('/appointment/delete', [AppointmentController::class, 'delete'])->name('appointment.delete');
    Route::post('/appointment/update/{id}', [AppointmentController::class, 'update'])->name('appointment.update');

    // Requests
    Route::get('/request', [RequestController::class, 'index'])->name('request.index');
    Route::post('/request/store', [RequestController::class, 'store'])->name('request.store');
    Route::post('/request/delete', [RequestController::class, 'delete'])->name('request.delete');
    Route::post('/request/update/{id}', [RequestController::class, 'update'])->name('request.update');
});

//Contact
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');


//Agendly
Route::get('/agendly', [AgendlyController::class, 'index'])->name('agendly.index');
Route::get('/agendly/login', [AgendlyLoginController::class, 'index'])->name('agendly.login.index');
Route::get('/agendly/register', [AgendlyRegisterUserController::class, 'index'])->name('agendly.register.index');
Route::post('/agendly/register/store', [AgendlyRegisterUserController::class, 'store'])->name('agendly.register.store');
Route::post('/agendly/register/update', [AgendlyRegisterUserController::class, 'updateProfileBusiness'])->name('agendly.resgister.update');

// Business Auth
Route::middleware(['auth', 'role:negocio'])->group(function () {
    Route::get('/agendly/business', [AgendlyBusinessController::class, 'index'])->name('agendly.business.index');
    Route::get('/agendly/business/configuration', [AgendlyBusinessController::class, 'showBusinessConfiguration'])->name('agendly.business.show');
    Route::get('/agendly/business/profile', [AgendlyBusinessController::class, 'showBusinessProfile'])->name('agendly.business.show');

    Route::post('/agendly/business/settings/store', [AgendlyBussinessSettingsController::class, 'store'])->name('agendly.business.settings.store');
});

// Client Auth
Route::middleware(['auth', 'role:cliente'])->group(function () {
    Route::get('/agendly/client', [AgendlyClientController::class, 'index'])->name('agendly.client.index');
    Route::get('/agendly/client/profile', [AgendlyClientController::class, 'showProfile'])->name('agendly.client.profile');
    Route::get('/agendly/client/appointment/show', [AgendlyClientController::class, 'showAppointments'])->name('agendly.client.appointment.show');
    Route::post('/agendly/client/appointment/store', [AgendlyClientController::class, 'storeAppointment'])->name('agendly.client.appointment.store');
    Route::post('/agendly/client/appointment/update/state', [AgendlyClientController::class, 'updateAppointmentState'])->name('agendly.client.appointment.state.update');
    Route::get('/agendly/client/business/{id}', [AgendlyClientController::class, 'showBusinessDetail'])->name('agendly.client.showBusinessDetail');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
});


require __DIR__ . '/auth.php';
