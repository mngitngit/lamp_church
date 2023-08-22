<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/registration', [App\Http\Controllers\RegistrationController::class, 'create'])->name('registration');
Route::get('/registration/validate', [App\Http\Controllers\RegistrationController::class, 'index'])->name('registration.validate');

// registration
Route::post('/registration', [App\Http\Controllers\RegistrationController::class, 'store'])->name('registration.store');
Route::get('/registration/ticket', [App\Http\Controllers\RegistrationController::class, 'show'])->name('registration.show');
Route::get('/registration/{id}/edit', [App\Http\Controllers\RegistrationController::class, 'edit'])->name('registration.edit');
Route::post('/registration/{id}/update', [App\Http\Controllers\RegistrationController::class, 'update'])->name('registration.update');
Route::delete('/registration/{id}/delete', [App\Http\Controllers\RegistrationController::class, 'destroy'])->name('registration.delete');

// export
Route::get('/registrations/export', [App\Http\Controllers\RegistrationController::class, 'export'])->name('registration.export');
Route::get('/registrations/test_mail', [App\Http\Controllers\RegistrationController::class, 'test_mail'])->name('registration.test');

// lookup
Route::get('/lookup', [App\Http\Controllers\LookUpController::class, 'index'])->name('lookup.index');
Route::get('/lookup/{id}', [App\Http\Controllers\LookUpController::class, 'show'])->name('lookup.show');

// payments
Route::get('/payments/{id}/create', [App\Http\Controllers\PaymentController::class, 'create'])->name('payments.create');
Route::delete('/payments/{id}/delete', [App\Http\Controllers\PaymentController::class, 'destroy'])->name('payments.delete');
Route::post('/payments/{id}', [App\Http\Controllers\PaymentController::class, 'store'])->name('payments.store');

// activities
Route::get('/activities', [App\Http\Controllers\ActivityController::class, 'index'])->name('activities');

// attendance
Route::get('/attendance', [App\Http\Controllers\AttendanceController::class, 'index'])->name('attendance.index');
Route::get('/attendance/{id}', [App\Http\Controllers\AttendanceController::class, 'show'])->name('attendance.show');
Route::post('/attendance', [App\Http\Controllers\AttendanceController::class, 'store'])->name('attendance.store');

// booking
Route::get('/booking', [App\Http\Controllers\BookingController::class, 'create'])->name('booking.create');
Route::get('/booking/validate', [App\Http\Controllers\BookingController::class, 'index'])->name('booking.index');
Route::get('/booking/{id}', [App\Http\Controllers\BookingController::class, 'show'])->name('booking.show');
Route::get('/booking/{id}/edit', [App\Http\Controllers\BookingController::class, 'edit'])->name('booking.edit');
Route::post('/booking/{id}/update', [App\Http\Controllers\BookingController::class, 'update'])->name('booking.update');

// config
Route::get('/config', [App\Http\Controllers\ConfigurationController::class, 'show'])->name('configurations');
