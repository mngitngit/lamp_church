<?php

namespace App\Http\Controllers;

use App\Exports\ExportRegistration;
use App\Models\Registration;
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
        return Registration::create([
            'uuid' => $request->awtaCardNumber ?: $this->generateGuestId(),
            'email' => $request->email,
            'firstname' => $request->firstName,
            'lastname' => $request->lastName,
            'facebook_name' => $request->facebookName,
            'registration_type' => $request->registrationType,
            'local_church' => $request->localChurch,
            'country' => $request->country,
            'category' => $request->category,
            'attending_option' => $request->attendingOption,
            'other_details' => '{}',
        ]);
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
