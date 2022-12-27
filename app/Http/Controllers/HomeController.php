<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;
use App\Http\Resources\RegistrationResource;
use App\Models\Slots;
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
        $registration = Registration::withSum('payments', 'amount');

        if ($request->search) {
            $registration
            ->where('fullname', 'LIKE', "%$request->search%")
            ->orWhere('uuid', 'LIKE', "%$request->search%");
        }

        $registration = $registration->paginate(10);

        $registration->map(function($item) {
            $item->priority_dates = implode(', ', json_decode($item->priority_dates));

            $booked_dates = $item->bookings()->with('slot')->get()->toArray();

            $item->booked_dates = array_map(function($date) {
               return $date['slot']['event_date'];
            }, $booked_dates);

            $attended_dates = $item->attendances()->with('slot')->get()->toArray();

            $item->attended_dates = array_map(function($date) {
                return $date['slot']['event_date'];
             }, $attended_dates);
        });

        $slots_members = Slots::where('registration_type', 'Member')->with('bookings')->get()->map(function ($slot) {
            $booked = $slot->bookings->groupBy('local_church')->map(function($lc) {
                return $lc->count();
            });

            $slot['booked_per_church'] = $booked;
            
            return $slot;
        });

        $slots_guests = Slots::where('registration_type', 'Guest')->with('bookings')->get()->map(function ($slot) {
            $booked = $slot->bookings->groupBy('local_church')->map(function($lc) {
                return $lc->count();
            });

            $slot['booked_per_church'] = $booked;
            
            return $slot;
        });

        $local_churches = explode('|', env('LOCAL_CHURCHES'));

        $slots = Slots::where('registration_type', 'Member')->get();
        $attendance_count = [];

        foreach ($slots as $slot) {
            $slot = (Object) $slot;
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

        return view('home', [
            'registrations' => $registration,
            'search' => $request->search,
            'slots' => [
                'members' => $slots_members,
                'guests' => $slots_guests
            ],
            'count' => json_encode($attendance_count)
        ]);
    }
}
