<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;

class ReceivedHGController extends Controller
{
    public function show($uuid, Request $request)
    {
        if (!$request->api_key) {
            return response()->json(['error' => 'API key is required.'], 403);
        }

        if (is_null($uuid)) {
            return response()->json(['error' => 'LAMP ID/Guest code is required.'], 422);
        }

        $registration = Registration::select('uuid', 'email', 'fullname', 'registration_type', 'local_church', 'cluster_group', 'country', 'attending_option')->where('uuid', $uuid)->first();

        if (!$registration) {
            return response()->json(['error' => 'Delegate not found.'], 422);
        }

        return $registration;
    }
}
