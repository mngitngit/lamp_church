<?php

namespace App\Http\Controllers;

use App\Enums\AttendingOption;
use App\Enums\PaymentStatus;
use App\Exports\ExportRegistration;
use App\Models\Attendance;
use App\Models\Booking;
use App\Models\LookUp;
use App\Models\Payment;
use App\Models\Registration;
use App\Models\Slots;
use App\Models\UUID;
use App\Notifications\Registered;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Notification as FacadesNotification;
use Maatwebsite\Excel\Facades\Excel;

class RegistrationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'create', 'store', 'show', 'update']]);
    }

    public function index(Request $request)
    {
        $isBulk = $request->isBulk === 'true';
        if ($isBulk) {
            $errors = [];

            foreach ($request->data as $key => $value) {
                $value = json_decode($value);

                if (!$value->firstName) {
                    $errors[$key]['firstName'] = 'First Name is required.';
                }

                if (!$value->lastName) {
                    $errors[$key]['lastName'] = 'Last Name is required.';
                }

                if (!$value->clusterGroup) {
                    $errors[$key]['clusterGroup'] = 'Cluster Group is required.';
                }

                if (!$value->localChurch) {
                    $errors[$key]['localChurch'] = 'Local Church is required.';
                }

                if (!$value->country) {
                    $errors[$key]['country'] = 'Country is required.';
                }

                if (count($value->booked) === 0) {
                    $errors[$key]['booked'] = 'Select preferred dates.';
                }

                if (!array_key_exists($key, $errors)) {
                    $validation = $this->checkIfAlreadyRegistered((object) [
                        'firstName' => $value->firstName,
                        'lastName' => $value->lastName,
                        'localChurch' => $value->localChurch
                    ]);

                    if ($validation && array_key_exists('error', $validation)) {
                        $errors[$key]['invalid'] = $validation['error'];
                    }
                }
            }

            if (count($errors) > 0) {
                return response()->json(['errors' => $errors], 500);
            }
        } else {
            $validation = $this->checkIfAlreadyRegistered($request);

            if (array_key_exists('error', $validation)) {
                return response()->json(['error' => $validation['error']], 500);
            }
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
        // member registration
        if ($request->step_1['registrationType'] === 'Member') {
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
                    $cluster_group = $details['clusterGroup'];
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
                    $cluster_group = $details['clusterGroup'];
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
                    $cluster_group = $details['clusterGroup'];
                    $awta_card_number = $details['awtaCardNumber'];
                    break;
            }

            $uuid = UUID::issue();

            $registration = Registration::create([
                'uuid' => $uuid,
                'email' => $email,
                'firstname' => $firstname,
                'lastname' => $lastname,
                'fullname' => $fullname,
                'facebook_name' => $facebook,
                'registration_type' => $registration_type,
                'local_church' => $local_church,
                'cluster_group' => $cluster_group,
                'country' => $country,
                'category' => $category,
                'attending_option' => $attending_option,
                'with_awta_card' => $with_awta_card,
                'notes' => [],
                'activities' => [],
                'booking_activities' => []
            ]);

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

            if ($attending_option === AttendingOption::Hybrid) {
                $this->book($registration, $request->step_3['booked']);
            }

            $registration = $this->updatePaymentStatus($registration->uuid, false);

            // if ($registration->attending_option === AttendingOption::Hybrid) {
            $this->notify($registration->id);
            // }

            return $registration->uuid;
        } else { // guest registration
            if ($request->step_1['attendingOption'] === AttendingOption::Hybrid) {
                $registered = [];

                foreach ($request->step_2['guests'] as $key => $value) {
                    $uuid = $this->generateGuestId();

                    $details = (object) $value;

                    $registration = Registration::create([
                        'uuid' => $uuid,
                        'email' => $details->email,
                        'firstname' => $details->firstName,
                        'lastname' => $details->lastName,
                        'fullname' => $details->firstName . ' ' . $details->lastName,
                        'facebook_name' => $details->facebookName,
                        'registration_type' => 'Guest',
                        'local_church' => $details->localChurch,
                        'cluster_group' => $details->clusterGroup,
                        'country' => $details->country,
                        'category' => PaymentStatus::Free,
                        'attending_option' => AttendingOption::Hybrid,
                        'with_awta_card' => 'none',
                        'notes' => [],
                        'activities' => [],
                        'booking_activities' => []
                    ]);

                    $this->book($registration, $details->booked);

                    $registration = $this->updatePaymentStatus($registration->uuid, false);

                    $registered[] = $registration->uuid;
                }

                return $registered;
            } else {
                $uuid = $this->generateGuestId();

                $details = (object) $request->step_2;

                $registration = Registration::create([
                    'uuid' => $uuid,
                    'email' => $details->email,
                    'firstname' => $details->firstName,
                    'lastname' => $details->lastName,
                    'fullname' => $details->firstName . ' ' . $details->lastName,
                    'facebook_name' => $details->facebookName,
                    'registration_type' => 'Guest',
                    'local_church' => $details->localChurch,
                    'cluster_group' => $details->clusterGroup,
                    'country' => $details->country,
                    'category' => PaymentStatus::Free,
                    'attending_option' => AttendingOption::Online,
                    'with_awta_card' => 'none',
                    'notes' => [],
                    'activities' => [],
                    'booking_activities' => []
                ]);

                $registration = $this->updatePaymentStatus($registration->uuid, false);

                return $registration->uuid;
            }
        }
    }

    /**
     * show registration ticket.
     *
     * @param  String $uuid
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $uuid = explode(',', $request->id);

        $registration = (array) Registration::with('bookings', 'bookings.slot')->whereIn('uuid', $uuid)->get()->toArray();

        $registration = array_map(function ($data) {
            $data['booked_dates'] = array_map(function ($dates) {
                return $dates['slot']['event_date'];
            }, $data['bookings']);

            return $data;
        }, $registration);

        return view('registration.show', [
            'registration' => $registration
        ]);
    }

    public function update($uuid, Request $request)
    {
        $registration = Registration::where('uuid', $uuid)->first();

        if (isset($request->avail_new_lamp_id)) {
            $registration->update([
                'avail_new_lamp_id' => $request->avail_new_lamp_id,
            ]);
        } else {
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
                'can_book_rate' => $request->bookingRate,
                'can_book_days' => $request->canBookDays,
                'rate' => $request->rate,
                'rebooking_limit' => $request->rebookingLimit,
                'visitor_to_member' => $request->visitorToMember ? date('Y-m-d', strtotime($request->visitorToMember)) : NULL
            ]);
        }

        if ($request->notes) {
            $registration->updateStaffNotes($registration->uuid, $registration->notes, array($request->notes));
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

        Payment::where('registration_uuid', $uuid)->delete();

        Attendance::where('registration_uuid', $uuid)->delete();

        return Registration::where('uuid', $uuid)->first()->delete();
    }

    public function test_mail()
    {
        $registration = Registration::with('bookings', 'bookings.slot')->withSum('payments', 'amount')->find(24);

        FacadesNotification::route('mail', [
            $registration->email => $registration->fullname,
        ])->notify(new Registered($registration));

        dd($registration);
    }
}
