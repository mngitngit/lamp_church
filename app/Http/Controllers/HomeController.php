<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;
use App\Http\Resources\RegistrationResource;

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
        // dd(auth()->user()->load(['permissions']));
        $registration = Registration::withSum('payments', 'amount');
        // dd($registration->get()[0]);
        if ($request->search) {
            $registration
            ->where('fullname', 'LIKE', "%$request->search%")
            ->orWhere('uuid', 'LIKE', "%$request->search%");
        }

        $registration = $registration->paginate(10);

        $registration->map(function($item) {
            $item->priority_dates = implode(', ', json_decode($item->priority_dates));
        });

        return view('home', [
            'registrations' => $registration,
            'search' => $request->search
        ]);
    }
}
