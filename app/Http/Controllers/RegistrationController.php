<?php

namespace App\Http\Controllers;

use App\Exports\ExportRegistration;
use App\Models\Attendance;
use App\Models\AvailableUuid;
use App\Models\Booking;
use App\Models\LookUp;
use App\Models\Payment;
use App\Models\Rates;
use App\Models\RebookingActivities;
use App\Models\Registration;
use App\Models\UUID;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class RegistrationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',['except'=>['index','create','store','show']]);
    }

    public function index(Request $request)
    {
        $registration = Registration::where('firstname', $request->firstName)
        ->where('lastname', $request->lastName)
        ->where('local_church', $request->localChurch)
        ->first();
        
        if ($registration) {
            return response()->json(['error' => 'This delegate from '. $request->localChurch .' is already registered.'], 500);
        }

        $lookup = LookUp::where('firstname', $request->firstName)
        ->where('lastname', $request->lastName)
        ->where('local_church', $request->localChurch)
        ->first();

        if ($lookup) {
            return response()->json(['error' => 'This delegate from '. $request->localChurch .' has already been issued with an AWTA card number.'], 500);
        }
    }

    /**
     * Show the form for creating a new registration.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('registration.create');
    }

    /**
     * Store a newly created registration in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->withAwtaCard === 'none') {
            $uuid = UUID::issue($request->localChurch);
        }
        
        if ($request->withAwtaCard === 'yes' || $request->withAwtaCard === 'lost') {
            $uuid = $request->awtaCardNumber;
        }

        if ($request->registrationType === 'Guest') {
            $uuid = $this->generateGuestId();
        }

        $registration = Registration::create([
            'uuid' => $uuid,
            'email' => $request->email,
            'firstname' => $request->firstName,
            'lastname' => $request->lastName,
            'fullname' => ($request->firstName) . ' ' . ($request->lastName),
            'facebook_name' => $request->facebookName,
            'registration_type' => $request->registrationType,
            'local_church' => $request->localChurch,
            'country' => $request->country,
            'category' => $request->category,
            'attending_option' => $request->attendingOption,
            'with_awta_card' => $request->withAwtaCard,
            'with_accommodation' => $request->withAccommodation,
            'mode_of_transpo' => $request->modeOfTranspo,
            'priority_dates' => json_encode($request->priorityDates)
        ]);

        $lookup = LookUp::where('awta_card_number', $request->awtaCardNumber)->first();
        if ($lookup) {
            $lookup->update([
                'is_registered' => true
            ]);
        }

        $this->updatePaymentStatus($registration->uuid, false);

        return $registration;
    }

    /**
     * show registration ticket.
     *
     * @param  String $uuid
     * @return \Illuminate\Http\Response
     */
    public function show($uuid) {
        $registration = Registration::where('uuid', $uuid)->first();

        $dates = $registration->bookings()->with('slot')->get()->toArray();

        $booked_dates = array_map(function($date) {
            return $date['slot']['event_date'];
        }, $dates);

        return view('registration.show', [
            'registration' => $registration,
            'booked_dates' => $booked_dates
        ]);
    }

    public function update($uuid, Request $request) {
        $registration = Registration::where('uuid', $uuid)->first();
        
        $registration->update([
            'email' => $request->email,
            'firstname' => $request->firstName,
            'lastname' => $request->lastName,
            'fullname' => $request->firstName . ' ' . $request->lastName,
            'facebook_name' => $request->facebookName,
            'local_church' => $request->localChurch,
            'country' => $request->country,
            'category' => $request->category,
            'attending_option' => $request->attendingOption,
            'with_awta_card' => $request->withAwtaCard,
            'with_accommodation' => $request->withAccommodation ?? false,
            'mode_of_transpo' => $request->modeOfTranspo,
            'priority_dates' => json_encode($request->priorityDates),
            'can_book' => $request->canBook,
            'can_book_rate' => $request->bookingRate,
            'can_book_days' => $request->canBookDays,
            'rebooking_limit' => $request->rebookingLimit
        ]);

        if (! $request->canBook) {
            $registration->bookings()->delete();
        }

        return $this->updatePaymentStatus($uuid, false);
    }

    public function edit($uuid) {
        return view('registration.edit', [
            'registration' => Registration::where('uuid', $uuid)->first()
        ]);
    }

    public function export(){
        return Excel::download(new ExportRegistration, 'registrations_'.TIME().'.csv');
    }

    public function destroy($uuid) {
        $lookup = LookUp::where('awta_card_number', $uuid)->first();

        if ($lookup) {
            $lookup->update([
                'is_registered' => false
            ]);
        }

        Booking::where('registration_uuid', $uuid)->delete();

        RebookingActivities::where('registration_uuid', $uuid)->delete();

        Payment::where('registration_uuid', $uuid)->delete();

        Attendance::where('registration_uuid', $uuid)->delete();
        
        return Registration::where('uuid', $uuid)->first()->delete();
    }
}
