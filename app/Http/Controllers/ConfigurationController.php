<?php

namespace App\Http\Controllers;

use App\Models\AvailableUuid;
use App\Models\Rates;
use App\Models\Slots;
use App\Models\User;
use Illuminate\Http\Request;

class ConfigurationController extends Controller
{
    public function show() {
        return view('config.show', [
            'rates' => Rates::all(),
            'availables' => AvailableUuid::all(),
            'slots' => Slots::all(),
            'users' => User::all()
        ]);
    }
}
