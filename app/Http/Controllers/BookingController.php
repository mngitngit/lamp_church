<?php

namespace App\Http\Controllers;

use App\Http\Resources\RebookingActivityResource;
use App\Models\Booking;
use App\Models\Rates;
use App\Models\RebookingActivities;
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

    public function edit($uuid)
    {
        $registration = Registration::where('uuid', $uuid)->first();

        return view('booking.edit', [
            'booked_dates' => $registration->bookings()->with(['slot'])->get(),
            'slots' => Slots::all(),
            'uuid' => $uuid,
            'can_book_days' => $registration->can_book_days,
            'rebooking_activities' => $registration->rebooking_activities,
        ]);
    }

    /**
     * show booking ticket.
     *
     * @param  String $uuid
     * @return \Illuminate\Http\Response
     */
    public function show($uuid) {
        $registration = Registration::where('uuid', $uuid)->first();

        $dates = $registration->bookings()->with(['slot'])->get()->toArray();

        $booked_dates = array_map(function($date) {
            return $date['slot']['event_date'];
        }, $dates);

        return view('booking.show', [
            'registration' => $registration,
            'booked_dates' => $booked_dates
        ]);
    }

    public function update($uuid, Request $request)
    {
        $registration = Registration::where('uuid', $uuid)->first();

        $new_booked_dates = $request->all()['dates'];

        $old_booked_dates = array_column($registration->bookings()->get()->toArray(), 'slot_id');

        $limit = $registration->rebooking_limit;

        $hasPermission = auth()->user() ? auth()->user()->permissions->can_edit_delegate : false;

        $registration->rebooking_limit = $new_booked_dates == $old_booked_dates || $hasPermission ? $limit : $limit -1;

        $registration->bookings()->delete();

        foreach($request->dates as $date) {
            $taken = Booking::where('slot_id', $date)->count();
            $slot = Slots::where('id', $date)->first();
            $remaining = $slot->seat_count - $taken;

            if ($remaining > 0) {
                $registration->bookings()->create([
                    'registration_uuid' => $registration->uuid,
                    'slot_id' => $date,
                    'local_church' => $registration->local_church
                ]);
            } else {
                return response()->json(['error' => 'Sorry, no remaining seats left. Please refresh the page and try again.'], 500);
            }
        }

        $registration->save();

        $this->logActivity($old_booked_dates, $new_booked_dates, $uuid);

        return $registration->bookings()->with(['slot'])->get();
    }

    public function index(Request $request) {
        $registration = Registration::where('uuid', $request->referenceNumber)
            ->where('lastname', $request->lastName)
            ->where('local_church', $request->localChurch)
            ->withSum('payments', 'amount')
            ->first();
        
        if (! $registration) {
            return response()->json(['error' => 'Not found. Please check the details and try again.'], 500);
        }

        if ($registration->rebooking_limit <= 0) {
            return response()->json(['error' => 'Already reached rebooking limit.'], 500);
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

    public function logActivity($old_booked_dates, $new_booked_dates, $uuid) {
        if ($new_booked_dates != $old_booked_dates) {
            $registration = Registration::where('uuid', $uuid)->first();

            $dates = array_map(function ($item) {
                return $item['slot']['event_date'];
            }, $registration->bookings()->with('slot')->get()->toArray());

            if (count($old_booked_dates) > 0 && count($new_booked_dates) > 0) {
                $message = "This delegate " . (auth()->user() ? "was rebooked by " . auth()->user()->name : "rebooked") . " to " . implode(', ', $dates) . ".";
            } elseif (count($old_booked_dates) === 0 && count($new_booked_dates) > 0) {
                $message = "This delegate " . (auth()->user() ? "booked by " . auth()->user()->name : "booked") . " for " . implode(', ', $dates) . ".";
            }elseif (count($old_booked_dates) > 0 && count($new_booked_dates) === 0) {
                $message = "This delegate's " . (auth()->user() ? "booked dates were removed by " . auth()->user()->name : "booked dates were removed.");
            }
            
            RebookingActivities::create([
                'registration_uuid' => $uuid,
                'description' => $message
            ]);
        }
    }
}
