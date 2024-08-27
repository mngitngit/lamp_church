<?php

namespace App\Http\Controllers;

use App\Enums\AttendingOption;
use App\Enums\PaymentStatus;
use App\Enums\RegistrationType;
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
use App\Models\AvailableUuid;

class RegistrationController extends Controller
{
    public function __construct()
    {
        $auth_exeptions = ['validation', 'store', 'show', 'update', 'create'];
        
        $this->middleware('auth', ['except' => $auth_exeptions]);
    }

    public function index(Request $request)
    {
        $search = json_decode($request->search);

        $registration = Registration::withSum('payments', 'amount');

        if ($search->payment_status) {
            $registration = $registration->where('payment_status', '=', $search->payment_status);
        }

        if ($search->booking_status) {
            $registration = $registration->where('booking_status', '=', $search->booking_status);
        }

        if ($search->registration_type) {
            $registration = $registration->where('registration_type', '=', $search->registration_type);
        }

        if ($search->attending_option) {
            $registration = $registration->where('attending_option', '=', $search->attending_option);
        }

        if ($search->category) {
            $registration = $registration->where('category', '=', $search->category);
        }

        if ($search->local_church) {
            $registration = $registration->where('local_church', '=', $search->local_church);
        }

        if ($search->keyword) {
            $registration = $registration->where('fullname', 'LIKE', "%$search->keyword%")
                ->orWhere('uuid', 'LIKE', "%$search->keyword%");
        }

        $registration = $registration->paginate(10);

        $registration->map(function ($item) {
            $booked_dates = $item->bookings()->with('slot')->get()->toArray();

            $item->booked_dates = array_map(function ($date) {
                return $date['slot']['event_date'];
            }, $booked_dates);

            $attended_dates = $item->attendances()->with('slot')->get()->toArray();

            $item->attended_dates = array_map(function ($date) {
                return $date['slot']['event_date'];
            }, $attended_dates);
        });

        return $registration;
    }

    public function validation(Request $request)
    {
        $isBulk = $request->isBulk === 'true';
        $booked = [];
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

                $booked = array_unique(array_merge($booked, $value->booked));
            }

            // check all slot if available
            $booking_error = [];
            $availability = [];
            foreach ($booked as $slot_id) {
                $slot = Slots::where('id', $slot_id)->first();
                
                if ($slot->available <= 0) {
                    $booking_error[] = $slot_id;
                }

                $availability[] = $slot->available;
            }
            
            // loop on all reg if has error with slot availability
            foreach ($request->data as $key => $value) {
                $value = json_decode($value);

                if (count(array_intersect($value->booked, $booking_error)) > 0) {
                    $errors[$key]['booked'] = 'Some dates are already taken. Please refresh the page and try again.';
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
        if (env('CLOSE_REGISTRATION') == true) {
            return view('registration.closed');
        }

        return view('registration.create', [
            'slots' => [
                'member' => Slots::where('registration_type', RegistrationType::Member)->get(),
                'guest' => Slots::where('registration_type', RegistrationType::Guest)->get()
            ]
        ]);
    }

    public function new() {
        return view('registration.create', [
            'slots' => [
                'member' => Slots::where('registration_type', RegistrationType::Member)->get(),
                'guest' => Slots::where('registration_type', RegistrationType::Guest)->get()
            ]
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
            $uuid = null;

            switch ($request->step_1['withAwtaCard']) {
                case 'none': // None, I’m a new member.
                    $details = array_merge($request->step_1, $request->step_2, $request->step_3);

                    $uuid = UUID::issue();
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
                    $assistance = $details['specificMedicalAssistance'];
                    $can_book_days = config('settings.member_booking_limit');
                    $awta_card_number = '--';
                    break;

                case 'lost': // Yes, but I don’t have it.
                    $details = array_merge($request->step_1, $request->step_2, $request->step_3);

                    $lookup = LookUp::where('lamp_card_number', $details['selected'])->first();

                    $uuid = is_null($lookup['old_lamp_card_number']) ? UUID::issue() : $lookup['lamp_card_number'];
                    $email = $details['email'];
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
                    $assistance = $details['specificMedicalAssistance'];
                    $can_book_days = $lookup['can_book_days'];
                    break;

                case 'yes': // Yes, and I still have it.
                    $details = array_merge($request->step_1, $request->step_3);

                    $uuid = is_null($details['found']['oldAwtaCardNumber']) ? UUID::issue() : $details['awtaCardNumber'];
                    $email = $details['email'];
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
                    $assistance = $details['specificMedicalAssistance'];
                    $can_book_days = $details['found']['canBookDays'];
                    break;
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
                'cluster_group' => $cluster_group,
                'country' => $country,
                'category' => $category,
                'attending_option' => $attending_option,
                'with_awta_card' => $with_awta_card,
                'medical_assistance_needed' => $assistance,
                'can_book_days' => $can_book_days,
                'notes' => [],
                'activities' => [],
                'booking_activities' => []
            ]);

            $registration->additional_data()->create([
                'has_viewed_ticket' => NULL
            ]);

            $lookup = LookUp::where('lamp_card_number', $awta_card_number)->first();

            // checking if the member is in the master list
            if ($lookup) {
                $update = [
                    'is_registered' => true
                ];

                if (is_null($lookup['old_lamp_card_number'])) {
                    $update['lamp_card_number'] =  $registration->uuid;
                    $update['old_lamp_card_number'] = $lookup->lamp_card_number;
                }
                // setting new LAMP ID number
                $lookup->update($update);
            } else {
                // insert member to master list if not existing
                LookUp::create([
                    'lamp_card_number' => $registration->uuid,
                    'old_lamp_card_number' => $awta_card_number,
                    'email' => $email,
                    'firstname' => $firstname,
                    'lastname' => $lastname,
                    'fullname' => $firstname . ' ' . $lastname,
                    'facebook_name' => $facebook,
                    'registration_type' => 'Member',
                    'category' => $category,
                    'local_church' => $local_church,
                    'country' => $country,
                    'can_book_days' => config('settings.member_booking_limit'),
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
                        'medical_assistance_needed' => $details->specificMedicalAssistance,
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

        $registration = (array) Registration::with('bookings', 'bookings.slot', 'additional_data', 'lookup')->whereIn('uuid', $uuid)->get()->toArray();

        $registration = array_map(function ($data) {
            $data['booked_dates'] = array_map(function ($dates) {
                return $dates['slot']['event_date'];
            }, $data['bookings']);
            $data['avail_new_lamp_id'] = $data['lookup']['avail_new_lamp_id'] ?? NULL;
            $data['has_viewed_ticket'] = $data['additional_data']['has_viewed_ticket'] ?? NULL;

            return $data;
        }, $registration);
        
        return view('registration.show', [
            'registration' => $registration
        ]);
    }

    public function update($uuid, Request $request)
    {
        $registration = Registration::where('uuid', $uuid)->first();

        if (isset($request->avail_new_lamp_id)) { // save answer for newly registered members
            $registration->lookup()->update([
                'lamp_card_number' => $uuid,
                'avail_new_lamp_id' => $request->avail_new_lamp_id,
            ]);

            $registration->additional_data()->update([
                'registration_uuid' => $uuid,
                'has_viewed_ticket' => NOW(),
            ]);
        } elseif (isset($request->mark_as_viewed)) { // mark as viewed for guests
            $registration->additional_data()->updateOrCreate([
                'registration_uuid' => $uuid,
                'has_viewed_ticket' => NOW(),
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
                'visitor_to_member' => $request->visitorToMember ? date('Y-m-d', strtotime($request->visitorToMember)) : NULL,
            ]);

            if ($registration->registration_type === 'Member') {
                $registration->lookup()->updateOrCreate([
                    'lamp_card_number' => $uuid,
                    'avail_new_lamp_id' => $request->availNewLAMPID,
                ]);
            }
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

    public function resend_mail($id)
    {
        $registration = Registration::find($id);

        $registration->updateActivities($registration->uuid, $registration->activities, array(
            'resent email notification'
        ));

        $this->notify($id);
    }
}
