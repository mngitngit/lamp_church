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
        
        if ($request->search) {
            $registration
            ->where('fullname', 'LIKE', "%$request->search%")
            ->orWhere('uuid', 'LIKE', "%$request->search%");
        }

        return view('home', [
            'registrations' => RegistrationResource::collection($registration->get())->all(),
            'search' => $request->search
        ]);
    }
}
