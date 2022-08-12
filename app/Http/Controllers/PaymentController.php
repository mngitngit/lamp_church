<?php

namespace App\Http\Controllers;

use App\Http\Resources\PaymentResource;
use App\Models\Registration;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Show the form for creating a new registration.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($uuid) {
        $registration = Registration::where('uuid', $uuid)->with('payments')->first();

        return view('payments.create', [
            'registration' => $registration,
            'balance' => number_format(array_sum(
                array_column(
                    $registration->payments->toArray(), 
                    'amount'
                )
            ), 2, ',', ' '),
            'uuid' => $uuid
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

        return view('payments.show', [
            'registration' => $registration,
            'balance' => number_format(array_sum(
                array_column(
                    $registration->payments->toArray(), 
                    'amount'
                )
            ), 2, ',', ' '),
            'uuid' => $uuid
        ]);
    }
}
