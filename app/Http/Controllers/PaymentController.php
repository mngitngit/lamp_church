<?php

namespace App\Http\Controllers;

use App\Http\Resources\PaymentResource;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    /**
     * Show the form for creating a new registration.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($uuid) {
        $registration = Registration::where('uuid', $uuid)->with('payments')->first();

        $balance = floatval($registration->rate);
        $balance-= floatval(array_sum(array_column($registration->payments->toArray(), 'amount')));
        
        return view('payments.create', [
            'registration' => $registration,
            'balance' => $balance,
            'uuid' => $uuid,
            'user' => Auth::user()
        ]);
    }

    /**
     * show payments.
     *
     * @param  String $uuid
     * @return \Illuminate\Http\Response
     */
    public function show($uuid) {
        $registration = Registration::where('uuid', $uuid)->with('payments')->first();
        
        $balance = floatval($registration->rate);
        $balance-= floatval(array_sum(array_column($registration->payments->toArray(), 'amount')));

        return view('payments.show', [
            'registration' => $registration,
            'balance' => $balance,
            'uuid' => $uuid
        ]);
    }

    /**
     * store payments.
     *
     * @param  String $uuid
     * @param  Object $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $uuid) {
        $registration = Registration::where('uuid', $uuid)->first();

        $registration->payments()->create([
            'amount' => $request->amount,
            'user_id' => Auth::user()->id,
            'date_paid' => date("Y-m-d", strtotime($request->date))
        ]);
        
        return $this->updatePaymentStatus($uuid);
    }
}
