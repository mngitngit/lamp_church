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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/registration', [App\Http\Controllers\RegistrationController::class, 'create'])->name('registration');
Route::post('/registration', [App\Http\Controllers\RegistrationController::class, 'store'])->name('registration.store');
Route::get('/registration/{id}', [App\Http\Controllers\RegistrationController::class, 'show'])->name('registration.show');
Route::get('/lookup/{id}', [App\Http\Controllers\LookUpController::class, 'show'])->name('lookup.show');
Route::get('/payments/{id}', [App\Http\Controllers\PaymentController::class, 'show'])->name('payments.show');
Route::get('/payments/{id}/create', [App\Http\Controllers\PaymentController::class, 'create'])->name('payments.create');