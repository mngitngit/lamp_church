<?php

namespace App\Http\Controllers;

use App\Enums\PaymentStatus;
use App\Models\Attendance;
use App\Models\Booking;
use App\Models\Registration;
use App\Models\Slots;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Cast\Object_;

class AttendanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show', 'store']]);
    }

    public function index(Request $request)
    {
        $local_churches = explode(',', env('LOCAL_CHURCHES'));

        $slots = Slots::where('registration_type', 'Member')->where('id', env('SLOT_ID_TODAY_MEMBER'))->get();
        $attendance_count = [];

        foreach ($slots as $slot) {
            $slot = (object) $slot;
            $count = [];

            $member = Slots::where('event_date', $slot['event_date'])->where('registration_type', 'Member')->first();
            $guest = Slots::where('event_date', $slot['event_date'])->where('registration_type', 'Guest')->first();

            foreach ($local_churches as $local_church) {
                $array = [];

                $array['local_church'] = $local_church;
                $array['count'] = array(
                    'member' => array(
                        'total' => DB::table('bookings')
                            ->where('local_church', $local_church)
                            ->where('slot_id', $member->id)
                            ->count(),
                        'attended' => DB::table('attendances')
                            ->where('local_church', $local_church)
                            ->where('slot_id', $member->id)
                            ->count(),
                    ),
                    'guest' => array(
                        'total' => DB::table('bookings')
                            ->where('local_church', $local_church)
                            ->where('slot_id', $guest->id)
                            ->count(),
                        'attended' => DB::table('attendances')
                            ->where('local_church', $local_church)
                            ->where('slot_id', $guest->id)
                            ->count(),
                    )
                );

                array_push($count, $array);
            }

            $slot['count'] = $count;

            $slot['event_date'] = date_format($slot['event_date'], 'F d');

            array_push($attendance_count, $slot);
        }

        return view('attendance.index', [
            'count' => json_encode($attendance_count)
        ]);
    }

    public function show($uuid, Request $request)
    {
        if (!$uuid) {
            return response()->json(['error' => 'Please enter AWTA Card/Guest number.'], 500);
        }

        $registration = Registration::where('uuid', $uuid)->first();

        if (!$registration) {
            return response()->json(['error' => 'Not found. Please check the number and try again.'], 500);
        }

        $slot_id = $registration->registration_type === 'Member' ? env('SLOT_ID_TODAY_MEMBER') : env('SLOT_ID_TODAY_GUEST');

        $isBooked = $registration->bookings()->where('slot_id', $slot_id)->first();

        if (!$isBooked) {
            return response()->json(['error' => 'This delegate is not booked for today.'], 500);
        }

        if ($registration->attending_option !== 'Hybrid') {
            return response()->json(['error' => 'This delegate is not registered for hybrid.'], 500);
        }

        if ($registration->payment_status != PaymentStatus::Paid && $registration->payment_status != PaymentStatus::Free) {
            return response()->json(['error' => 'This delegate has remaining balance. Please reach out to your local coordinator.'], 500);
        }

        $dates = $registration->bookings()->with(['slot'])->get()->pluck('slot');

        $booked_dates = array_column($dates->toArray(), 'event_date');

        return [
            'delegate' => $registration,
            'bookings' => $registration->bookings()->with(['slot'])->get(),
            'booked_dates' => $booked_dates,
            'attended' => !empty($registration->attendances()->where('slot_id', $slot_id)->first())
        ];
    }

    public function store(Request $request)
    {
        $registration = Registration::where('uuid', $request->details['uuid'])->first();

        $slot_id = $registration->registration_type === 'Member' ? env('SLOT_ID_TODAY_MEMBER') : env('SLOT_ID_TODAY_GUEST');

        $attendance = Attendance::where('registration_uuid', $request->details['uuid'])->where('slot_id', $slot_id)->first();

        if (!$attendance) {
            return Attendance::create([
                'registration_uuid' => $request->details['uuid'],
                'slot_id' => $slot_id,
                'local_church' => $request->details['local_church']
            ]);
        }

        return $attendance;
    }
}
