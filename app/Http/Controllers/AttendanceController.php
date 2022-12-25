<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Booking;
use App\Models\Registration;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',['except'=>['index', 'show', 'store']]);
    }

    public function index(Request $request) {
        return view('attendance.index');
    }

    public function show($uuid, Request $request) {
        if (! $uuid) {
            return response()->json(['error' => 'Please enter AWTA Card/Guest number.'], 500);
        }

        $registration = Registration::where('uuid', $uuid)->first();

        if (! $registration) {
            return response()->json(['error' => 'Not found. Please check the number and try again.'], 500);
        }

        $isBooked = $registration->bookings()->where('slot_id', $request->slot_id)->first();

        if (!$isBooked) {
            return response()->json(['error' => 'This delegate is not booked for today.'], 500);
        }

        if ($registration->attending_option !== 'Hybrid') {
            return response()->json(['error' => 'This delegate is not registered for hybrid.'], 500);
        }

        if ($registration->payment_status != 'Paid' && $registration->payment_status != 'Free') {
            return response()->json(['error' => 'This delegate has remaining balance. Please reach out to your local coordinator.'], 500);
        }

        $dates = $registration->bookings()->with(['slot'])->get()->pluck('slot');

        $booked_dates = array_column($dates->toArray(), 'event_date');

        return [
            'delegate' => $registration,
            'bookings' => $registration->bookings()->with(['slot'])->get(),
            'booked_dates' => $booked_dates,
            'attended' => !empty($registration->attendances()->where('slot_id', $request->slot_id)->first())
        ];
    }

    public function store(Request $request) {
        return Attendance::create([
            'registration_uuid' => $request->details['uuid'],
            'slot_id' => $request->slot_id,
            'local_church' => $request->details['local_church']
        ]);
    }
}
