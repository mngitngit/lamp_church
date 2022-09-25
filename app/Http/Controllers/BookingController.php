<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Rates;
use App\Models\Registration;
use App\Models\Slots;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',['except'=>['create', 'index', 'show', 'update']]);
    }

    public function create()
    {
        return view('booking.create');
    }

    public function show($uuid)
    {
        $registration = Registration::where('uuid', $uuid)->first();

        return view('booking.show', [
            'booked_dates' => $registration->bookings()->with(['slot'])->get(),
            'slots' => Slots::all(),
            'uuid' => $uuid,
            'can_book_days' => $registration->can_book_days
        ]);
    }

    public function update($uuid, Request $request)
    {
        $registration = Registration::where('uuid', $uuid)->first();
        $registration->bookings()->delete();

        foreach($request->dates as $date) {
            $taken = Booking::where('slot_id', $date)->count();
            $slot = Slots::where('id', $date)->first();
            $remaining = $slot->seat_count - $taken;

            if ($remaining > 0) {
                $registration->bookings()->create([
                    'registration_uuid' => $registration->uuid,
                    'slot_id' => $date
                ]);
            } else {
                return response()->json(['error' => 'Sorry, no remaining seats left. Please refresh the page and try again.'], 500);
            }
        }

        return $registration->bookings()->with(['slot'])->get();
    }

    public function index(Request $request) {
        $registration = Registration::where('uuid', $request->referenceNumber)
            ->where('firstname', $request->firstName)
            ->where('lastname', $request->lastName)
            ->where('local_church', $request->localChurch)
            ->withSum('payments', 'amount')
            ->first();
        
        if (! $registration) {
            return response()->json(['error' => 'Not found. Please check the details and try again.'], 500);
        }

        if ($registration->attending_option !== 'Hybrid') {
            return response()->json(['error' => 'Delegate is not registered for hybrid.'], 500);
        }

        $rate = Rates::where('category', $registration->category)->where('attending_option', $registration->attending_option)->first();

        if ($registration->can_book) {
            return [
                'delegate' => $registration,
                'bookings' => $registration->bookings()->with(['slot'])->get(),
                'slots' => Slots::all(),
            ];
        }

        if (floatval($rate->can_book_rate) > floatval($registration->payments_sum_amount)) {
            return response()->json(['error' => 'Partial payment is required. Please reach out to your local coordinator for other details.'], 500);
        }

        if (floatval($rate->can_book_rate) <= floatval($registration->payments_sum_amount)) {
            $registration->can_book = true;
            $registration->save();

            return response()->json(['error' => 'Please try again.'], 500);
        }

        return response()->json(['error' => 'An error occured. Please report this issue to your local coordinator for other details.'], 500);
    }
}
