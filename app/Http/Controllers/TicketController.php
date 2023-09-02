<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show']]);
    }

    public function show($uuid)
    {
        $registration = Registration::with('bookings', 'bookings.slot')->where('uuid', $uuid)->first();

        $registration->booked_dates = array_map(function ($dates) {
            return $dates['slot']['event_date'];
        }, $registration->bookings->toArray());

        return view('ticket.show', [
            'registration' => $registration
        ]);
    }

    public function edit($id)
    {
        $registration = Registration::with('bookings', 'bookings.slot')->find($id);

        $registration->booked_dates = array_map(function ($dates) {
            return $dates['slot']['event_date'];
        }, $registration->bookings->toArray());

        return view('ticket.edit', [
            'registration' => $registration
        ]);
    }
}
