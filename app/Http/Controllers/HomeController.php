<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;
use App\Http\Resources\RegistrationResource;
use App\Models\LookUp;
use App\Models\Slots;
use App\Models\Attendance;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the registration dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $slots_members = Slots::where('registration_type', 'Member')->with('bookings')->get()->map(function ($slot) {
            $booked = $slot->bookings->groupBy('local_church')->map(function ($lc) {
                return $lc->count();
            });

            $slot['booked_per_church'] = $booked;

            return $slot;
        });

        $slots_guests = Slots::where('registration_type', 'Guest')->with('bookings')->get()->map(function ($slot) {
            $booked = $slot->bookings->groupBy('local_church')->map(function ($lc) {
                return $lc->count();
            });

            $slot['booked_per_church'] = $booked;

            return $slot;
        });

        $local_churches = explode(',', env('LOCAL_CHURCHES'));

        $slots = Slots::where('registration_type', 'Member')->get();
        $attendance_count = [];

        foreach ($slots as $slot) {
            $slot = (object) $slot;
            $count = [];

            $member = Slots::where('event_date', $slot['event_date'])->where('registration_type', 'Member')->first();
            $guest = Slots::where('event_date', $slot['event_date'])->where('registration_type', 'Guest')->first();

            $guest_overall_total = 0;
            $guest_overall_attended = 0;
            $member_overall_total = 0;
            $member_overall_attended = 0;

            foreach ($local_churches as $local_church) {
                $array = [];

                $member_total = DB::table('bookings')
                    ->where('local_church', $local_church)
                    ->where('slot_id', $member->id)
                    ->count();

                $member_attended = DB::table('attendances')
                    ->where('local_church', $local_church)
                    ->where('slot_id', $member->id)
                    ->count();

                $guest_total = DB::table('bookings')
                    ->where('local_church', $local_church)
                    ->where('slot_id', $guest->id)
                    ->count();

                $guest_attended = DB::table('attendances')
                    ->where('local_church', $local_church)
                    ->where('slot_id', $guest->id)
                    ->count();

                $guest_overall_total += $guest_total;
                $guest_overall_attended += $guest_attended;

                $member_overall_total += $member_total;
                $member_overall_attended += $member_attended;

                $array['local_church'] = $local_church;
                $array['count'] = array(
                    'member' => array(
                        'total' => $member_total,
                        'attended' => $member_attended,
                    ),
                    'guest' => array(
                        'total' => $guest_total,
                        'attended' => $guest_attended,
                    )
                );

                array_push($count, $array);
            }

            $slot['count'] = $count;
            $slot['overall'] = [
                'member' => [
                    'attended' => $member_overall_attended,
                    'total' => $member_overall_total
                ],
                'guest' => [
                    'attended' => $guest_overall_attended,
                    'total' => $guest_overall_total
                ]
            ];

            $slot['event_date'] = date_format($slot['event_date'], 'F d');

            array_push($attendance_count, $slot);
        }

        $overall = [];

        foreach ($local_churches as $local_church) {
            $count = [];
            $count['local_church'] = $local_church;
            $count['count'] = [
                'member' => [
                    'attended' => DB::table('attendances')
                        ->whereIn('slot_id', array(1, 2, 3, 4))
                        ->where('local_church', $local_church)
                        ->count(DB::raw('DISTINCT registration_uuid')),
                    'total' => DB::table('bookings')
                        ->whereIn('slot_id', array(1, 2, 3, 4))
                        ->where('local_church', $local_church)
                        ->count(DB::raw('DISTINCT registration_uuid'))
                ],
                'guest' => [
                    'attended' => DB::table('attendances')
                        ->whereIn('slot_id', array(5, 6, 7, 8))
                        ->where('local_church', $local_church)
                        ->count(DB::raw('DISTINCT registration_uuid')),
                    'total' => DB::table('bookings')
                        ->whereIn('slot_id', array(5, 6, 7, 8))
                        ->where('local_church', $local_church)
                        ->count(DB::raw('DISTINCT registration_uuid'))
                ]
            ];

            $overall[] = $count;
        }

        $overall_total = [
            'member' => [
                'attended' => DB::table('attendances')
                    ->whereIn('slot_id', array(1, 2, 3, 4))
                    ->count(DB::raw('DISTINCT registration_uuid')),
                'total' => DB::table('bookings')
                    ->whereIn('slot_id', array(1, 2, 3, 4))
                    ->count(DB::raw('DISTINCT registration_uuid'))
            ],
            'guest' => [
                'attended' => DB::table('attendances')
                    ->whereIn('slot_id', array(5, 6, 7, 8))
                    ->count(DB::raw('DISTINCT registration_uuid')),
                'total' => DB::table('bookings')
                    ->whereIn('slot_id', array(5, 6, 7, 8))
                    ->count(DB::raw('DISTINCT registration_uuid'))
            ]
        ];

        // set tab value
        $tab = 0;
        if ($request->type === 'registration') $tab = 0;
        if ($request->type === 'lookup') $tab = 1;
        return view('home', [
            'search' => $request->search,
            'type' => $request->type,
            'slots' => [
                'members' => $slots_members,
                'guests' => $slots_guests
            ],
            'slots_list' => json_encode(Slots::all()),
            'count' => json_encode($attendance_count),
            'overall' => json_encode($overall),
            'overall_total' => json_encode($overall_total),
            'tab' => $tab
        ]);
    }
}
