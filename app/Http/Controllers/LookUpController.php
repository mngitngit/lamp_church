<?php

namespace App\Http\Controllers;

use App\Models\LookUp;
use App\Models\Registration;
use Illuminate\Http\Request;

class LookUpController extends Controller
{
    /**
     * Methods to bypass authentication.
     * Methods: Show
     */ 
    public function __construct()
    {
        $this->middleware('auth',['except'=>['show']]);
    }

    /**
     * Return delegate record.
     *
     * @param  String $awtaNumber
     * @return \App\Models\LookUp
     */
    public function show($awtaNumber)
    {
        $lookUp = LookUp::where('awta_card_number', $awtaNumber)->first();

        if (! $lookUp) {
            return response()->json(['error' => 'Data not found. Please reach out to your local coordinator.'], 404);
        }

        $isRegistered = Registration::where('uuid', $awtaNumber)->first();

        if ($isRegistered) {
            return response()->json(['error' => 'Sorry, this AWTA Card number is already registered.'], 500);
        }

        return $lookUp;
    }
}
