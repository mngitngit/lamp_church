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
use App\Models\Slots;
use App\Models\UUID;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class RegistrationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'create', 'store', 'show']]);
    }

    public function index(Request $request)
    {
        $registration = Registration::where('firstname', $request->firstName)
            ->where('lastname', $request->lastName)
            ->where('local_church', $request->localChurch)
            ->first();

        if ($registration) {
            return response()->json(['error' => 'This delegate from ' . $request->localChurch . ' is already registered.'], 500);
        }

        $lookup = LookUp::where('firstname', $request->firstName)
            ->where('lastname', $request->lastName)
            ->where('local_church', $request->localChurch)
            ->first();

        if ($lookup) {
            return response()->json(['error' => 'This delegate from ' . $request->localChurch . ' has already been issued with an AWTA card number.'], 500);
        }
    }

    /**
     * Show the form for creating a new registration.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('registration.create', [
            'slots' => Slots::where('registration_type', 'Member')->get()
        ]);
    }

    /**
     * Store a newly created registration in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        switch ($request->step_1['withAwtaCard']) {
            case 'none': // None, I’m a new member.
                $details = array_merge($request->step_1, $request->step_2, $request->step_3);

                $email = $details['email'];
                $firstname = $details['firstName'];
                $lastname = $details['lastName'];
                $fullname = $details['firstName'] . ' ' . $details['lastName'];
                $facebook = $details['facebookName'];
                $registration_type = $details['registrationType'];
                $local_church = $details['localChurch'];
                $country = $details['country'];
                $category = $details['category'];
                $attending_option = $details['attendingOption'];
                $with_awta_card = $details['withAwtaCard'];
                $awta_card_number = '--';
                break;

            case 'lost': // Yes, but I lost it.
                $details = array_merge($request->step_1, $request->step_2, $request->step_3);

                $lookup = LookUp::where('lamp_card_number', $details['selected'])->first();

                $email = $lookup['email'];
                $firstname = $lookup['firstname'];
                $lastname = $lookup['lastname'];
                $fullname = $lookup['firstname'] . ' ' . $lookup['lastname'];
                $facebook = $lookup['facebook_name'];
                $registration_type = $details['registrationType'];
                $local_church = $details['localChurch'];
                $country = $details['country'];
                $category = $details['category'];
                $attending_option = $details['attendingOption'];
                $with_awta_card = $details['withAwtaCard'];
                $awta_card_number = $details['selected'];
                break;

            case 'yes': // Yes, and I still have it.
                $details = array_merge($request->step_1, $request->step_3);

                $email = $details['found']['email'];
                $firstname = $details['found']['firstName'];
                $lastname = $details['found']['lastName'];
                $fullname = $details['found']['firstName'] . ' ' . $details['found']['lastName'];
                $facebook = $details['found']['facebookName'];
                $registration_type = $details['registrationType'];
                $local_church = $details['found']['localChurch'];
                $country = $details['found']['country'];
                $category = $details['found']['category'];
                $attending_option = $details['attendingOption'];
                $with_awta_card = $details['withAwtaCard'];
                $awta_card_number = $details['awtaCardNumber'];
                break;
        }

        if ($registration_type === 'Guest') {
            $uuid = $this->generateGuestId();
        } else {
            $uuid = UUID::issue();
        }

        $registration = Registration::create([
            'uuid' => $uuid,
            'email' => $email,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'fullname' => $fullname,
            'facebook_name' => $facebook,
            'registration_type' => $registration_type,
            'local_church' => $local_church,
            'country' => $country,
            'category' => $category,
            'attending_option' => $attending_option,
            'with_awta_card' => $with_awta_card
        ]);

        if ($registration_type === 'Member') {
            $lookup = LookUp::where('lamp_card_number', $awta_card_number)->first();

            // checking if the member is in the master list
            if ($lookup) {
                // setting new awta card number
                $lookup->update([
                    'lamp_card_number' => $registration->uuid,
                    'old_lamp_card_number' => $lookup->lamp_card_number,
                    'is_registered' => true,
                ]);
            } else {
                // insert member to master list if not existing
                LookUp::create([
                    'lamp_card_number' => $registration->uuid,
                    'old_lamp_card_number' => $awta_card_number,
                    'email' => $email,
                    'firstname' => $firstname,
                    'lastname' => $lastname,
                    'facebook_name' => ($firstname) . ' ' . ($lastname),
                    'registration_type' => 'Member',
                    'category' => $category,
                    'local_church' => $local_church,
                    'country' => $country,
                    'is_registered' => true
                ]);
            }
        }

        $registration = $this->updatePaymentStatus($registration->uuid, false);

        if ($attending_option === 'Hybrid') {
            $this->book($registration, $request->step_3['booked']);
        }

        return $registration;
    }

    /**
     * show registration ticket.
     *
     * @param  String $uuid
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        $registration = Registration::where('uuid', $uuid)->first();

        $dates = $registration->bookings()->with('slot')->get()->toArray();

        $booked_dates = array_map(function ($date) {
            return $date['slot']['event_date'];
        }, $dates);

        return view('registration.show', [
            'registration' => $registration,
            'booked_dates' => $booked_dates
        ]);
    }

    public function update($uuid, Request $request)
    {
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
            'can_book' => $request->canBook,
            'can_book_rate' => $request->bookingRate,
            'can_book_days' => $request->canBookDays,
            'rebooking_limit' => $request->rebookingLimit
        ]);

        if (!$request->canBook) {
            $registration->bookings()->delete();
        }

        return $this->updatePaymentStatus($uuid, false);
    }

    public function edit($uuid)
    {
        return view('registration.edit', [
            'registration' => Registration::where('uuid', $uuid)->first()
        ]);
    }

    public function export()
    {
        return Excel::download(new ExportRegistration, 'registrations_' . TIME() . '.csv');
    }

    public function destroy($uuid)
    {
        $lookup = LookUp::where('lamp_card_number', $uuid)->first();

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
