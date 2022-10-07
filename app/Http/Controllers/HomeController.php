<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;
use App\Http\Resources\RegistrationResource;
use App\Models\Slots;

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

            $dates = $item->bookings()->with('slot')->get()->toArray();

            $item->booked_dates = array_map(function($date) {
               return $date['slot']['event_date'];
            }, $dates);
        });

        $slot = Slots::with('bookings')->get()->map(function ($slot) {
            $booked = $slot->bookings->groupBy('local_church')->map(function($lc) {
                return $lc->count();
            });

            $slot['booked_per_church'] = $booked;
            
            return $slot;
        });

        return view('home', [
            'registrations' => $registration,
            'search' => $request->search,
            'slots' => $slot
        ]);
    }
}
