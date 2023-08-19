<?php

namespace App\Http\Controllers;

use App\Enums\BookingStatus;
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
        $this->middleware('auth', ['except' => ['create', 'index', 'show', 'update']]);
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
            'slots' => Slots::where('registration_type', $registration->registration_type)->get(),
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
    public function show($uuid)
    {
        $registration = Registration::with('bookings', 'bookings.slot')->where('uuid', $uuid)->first();

        $registration->booked_dates = array_map(function ($dates) {
            return $dates['slot']['event_date'];
        }, $registration->bookings->toArray());

        return view('booking.show', [
            'registration' => $registration
        ]);
    }

    public function update($uuid, Request $request)
    {
        $registration = Registration::withSum('payments', 'amount')->where('uuid', $uuid)->first();

        if ($registration->is_booking_bypassed) {
            return response()->json(['error' => 'This delegate is a church worker and is already booked for the entire AWTA days.'], 500);
        }

        $new_booked_dates = $request->all()['dates'];

        $old_booked_dates = array_column($registration->bookings()->get()->toArray(), 'slot_id');

        $limit = $registration->rebooking_limit;

        $hasPermission = auth()->user() ? auth()->user()->permissions->can_edit_delegate : false;

        // considered paid if partially paid
        $paid = $registration->payment_status === 'Paid' || floatval($registration->can_book_rate) <= floatval($registration->payments_sum_amount);

        $hasChanges = false;

        // has changes if old vs new booked dates are different
        if ($new_booked_dates != $old_booked_dates) {
            $hasChanges = true;
        }

        // has changes if paid
        if ($new_booked_dates == $old_booked_dates && $paid && ($registration->booking_status === BookingStatus::Pending || $registration->booking_status === BookingStatus::Cancelled)) {
            $hasChanges = true;
        }

        // if no changes or admin, booking limit wont be deducted
        $limit = !$hasChanges || $hasPermission ? $limit : $limit - 1;

        // delete current bookings
        $registration->bookings()->delete();

        // set default booking status based on its initial value
        $booking_status = $registration->booking_status;

        // set booking status as confirmed if has changes and is paid
        if ($hasChanges && $paid) {
            $booking_status = BookingStatus::Confirmed;
        }

        // set booking status as pending if has changes but not yet paid
        if ($hasChanges && !$paid) {
            $booking_status = BookingStatus::Pending;
        }

        foreach ($request->dates as $date) {
            $taken = Booking::where('slot_id', $date)->count();
            $slot = Slots::where('id', $date)->first();
            $remaining = $slot->seat_count - $taken;

            if ($remaining > 0) {
                // update booking status, deduct to rebooking limit
                $registration->update([
                    'booking_status' => $booking_status,
                    'rebooking_limit' => $limit
                ]);

                // store bookings
                $registration->bookings()->create([
                    'registration_uuid' => $registration->uuid,
                    'slot_id' => $date,
                    'local_church' => $registration->local_church,
                    'status' => $booking_status
                ]);

                // add activity to registration
                if ($hasChanges && !auth()->user()) {
                    $dates = array_map(function ($date) {
                        return $date['slot']['event_date'];
                    }, $registration->bookings()->with('slot')->get()->toArray());

                    $registration->updateBookingActivities($registration->uuid, $registration->booking_activities, array($registration->fullname . ' rebooked for ' . implode(', ', $dates)));
                }
            } else {
                return response()->json(['error' => 'Sorry, no remaining seats left. Please refresh the page and try again.'], 500);
            }
        }

        $this->logActivity($old_booked_dates, $new_booked_dates, $uuid);

        return $registration->bookings()->with(['slot'])->get();
    }

    public function index(Request $request)
    {
        $registration = Registration::with('bookings', 'bookings.slot')
            ->where('uuid', $request->referenceNumber)
            ->where('lastname', $request->lastName)
            ->where('local_church', $request->localChurch)
            ->withSum('payments', 'amount')
            ->first();

        if (!$registration) {
            return response()->json(['error' => 'Not found. Please check the details and try again.'], 500);
        }

        if ($registration->is_booking_bypassed) {
            return response()->json(['error' => 'This delegate is a church worker and is already booked for the entire AWTA days.'], 500);
        }

        if ($registration->rebooking_limit <= 0) {
            return response()->json(['error' => 'Already reached rebooking limit.'], 500);
        }

        if ($registration->attending_option !== 'Hybrid') {
            return response()->json(['error' => 'Delegate is not registered for hybrid.'], 500);
        }

        $registration->booked_dates = array_map(function ($dates) {
            return $dates['slot']['event_date'];
        }, $registration->bookings->toArray());

        return [
            'delegate' => $registration,
            'slots' => Slots::where('registration_type', $registration->registration_type)->get(),
        ];
    }

    public function logActivity($old_booked_dates, $new_booked_dates, $uuid)
    {
        if ($new_booked_dates != $old_booked_dates) {
            $registration = Registration::where('uuid', $uuid)->first();

            $dates = array_map(function ($item) {
                return $item['slot']['event_date'];
            }, $registration->bookings()->with('slot')->get()->toArray());

            if (count($old_booked_dates) > 0 && count($new_booked_dates) > 0) {
                $message = "This delegate " . (auth()->user() ? "was rebooked by " . auth()->user()->name : "rebooked") . " to " . implode(', ', $dates) . ".";
            } elseif (count($old_booked_dates) === 0 && count($new_booked_dates) > 0) {
                $message = "This delegate " . (auth()->user() ? "booked by " . auth()->user()->name : "booked") . " for " . implode(', ', $dates) . ".";
            } elseif (count($old_booked_dates) > 0 && count($new_booked_dates) === 0) {
                $message = "This delegate's " . (auth()->user() ? "booked dates were removed by " . auth()->user()->name : "booked dates were removed.");
            }

            RebookingActivities::create([
                'registration_uuid' => $uuid,
                'description' => $message
            ]);
        }
    }
}
