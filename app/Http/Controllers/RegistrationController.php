<?php

namespace App\Http\Controllers;

use App\Exports\ExportRegistration;
use App\Models\AvailableUuid;
use App\Models\LookUp;
use App\Models\Rates;
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
        
        if ($request->withAwtaCard === 'yes') {
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
            'attending_option' => $request->attendingOption
        ]);

        $lookup = LookUp::where('awta_card_number', $request->awtaCardNumber)->first();
        if ($lookup) {
            $lookup->update([
                'is_registered' => true
            ]);
        }

        $this->updatePaymentStatus($registration->uuid);

        return $registration;
    }

    /**
     * show registration ticket.
     *
     * @param  String $uuid
     * @return \Illuminate\Http\Response
     */
    public function show($uuid) {
        return view('registration.show', [
            'registration' => Registration::where('uuid', $uuid)->first()
        ]);
    }

    public function export(){
        return Excel::download(new ExportRegistration, 'registrations_'.TIME().'.csv');
    }
}
