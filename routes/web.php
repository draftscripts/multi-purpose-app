<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Livewire\Admin\Appointments\CreateAppointment;
use App\Http\Livewire\Admin\Appointments\EditAppointment;
use App\Http\Livewire\Admin\Appointments\ListAppointments;
use App\Http\Livewire\Admin\Users\ListUsers;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('admin/dashboard', DashboardController::class)->name('admin.dashboard');
Route::get('admin/users', ListUsers::class)->name('admin.users');
Route::get('admin/appointments', ListAppointments::class)->name('admin.appointments');
Route::get('admin/appointments/create', CreateAppointment::class)->name('admin.appointments.create');
Route::get('admin/appointments/{appointment}/edit', EditAppointment::class)->name('admin.appointments.edit');
