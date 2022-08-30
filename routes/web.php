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

Route::get('/',[App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/registration', [App\Http\Controllers\RegistrationController::class, 'create'])->name('registration');
Route::get('/registration/validate', [App\Http\Controllers\RegistrationController::class, 'index'])->name('registration.validate');
Route::post('/registration', [App\Http\Controllers\RegistrationController::class, 'store'])->name('registration.store');
Route::get('/registration/{id}', [App\Http\Controllers\RegistrationController::class, 'show'])->name('registration.show');
Route::get('/registration/{id}/edit', [App\Http\Controllers\RegistrationController::class, 'edit'])->name('registration.edit');
Route::post('/registration/{id}/update', [App\Http\Controllers\RegistrationController::class, 'update'])->name('registration.update');
Route::get('/registrations/export', [App\Http\Controllers\RegistrationController::class, 'export'])->name('registration.export');

Route::get('/lookup', [App\Http\Controllers\LookUpController::class, 'index'])->name('lookup.index');
Route::get('/lookup/{id}', [App\Http\Controllers\LookUpController::class, 'show'])->name('lookup.show');
Route::get('/payments/{id}/create', [App\Http\Controllers\PaymentController::class, 'create'])->name('payments.create');
Route::post('/payments/{id}', [App\Http\Controllers\PaymentController::class, 'store'])->name('payments.store');