<?php

namespace App\Http\Controllers;

use App\Enums\RegistrationType;
use App\Imports\LookUpImport;
use App\Models\LookUp;
use App\Models\Booking;
use App\Models\Registration;
use App\Models\Event;
use App\Models\ChurchCRM\Finder;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\Facades\Excel as FacadesExcel;

class LookUpController extends Controller
{
    /**
     * Methods to bypass authentication.
     * Methods: Show
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show', 'index', 'validation', 'store', 'upload', 'upload_view', 'edit']]);
    }

    /**
     * Return all lookup data
     *
     * @param  String $awtaNumber
     * @return \App\Models\LookUp
     */
    public function index(Event $event, Request $request)
    {
        $search = json_decode($request->search);

        $lookUp = LookUp::with(['registrations' => function ($query) use ($event) {
            $query->where('event_id', $event->id);
        }]);

        // if ($search->registration_status != '') {
        //     $lookUp = $lookUp->where('is_registered', (int) $search->registration_status);
        // }

        if ($search->local_church) {
            $lookUp = $lookUp->where('local_church', $search->local_church);
        }

        if ($search->keyword) {
            $lookUp = $lookUp->where('fullname', 'LIKE', "%$search->keyword%")
                ->orWhere('lamp_id', 'LIKE', "%$search->keyword%");
        }

        $lookUp = $lookUp->paginate(10);

        return $lookUp;
    }

    /**
     * Checking if record exists in the lookup data
     * Checking by Last Name & Local Church
     *
     * @param  Request $request
     * @return \App\Models\LookUp
     */
    public function validation(Event $event, Request $request)
    {
        if ('Y' === env('ENABLE_INTEGRATION')) {
            $col_local_church = env('CHURCHCRM_LOCAL_CHURCH_COL');
            $lookUps = Finder::with('person')
                ->where($col_local_church, $request->localChurch)
                ->whereHas('person', function ($query) use ($request) {
                    $query->where('per_LastName', 'LIKE', "%{$request->lastname}%");
                })
                ->get();
        } else {
            $lookUps = LookUp::select();

            if ($request->lastname) {
                $lookUps = $lookUps->where('lastname', 'LIKE', "%$request->lastname%");
            }
    
            if ($request->localChurch) {
                $lookUps = $lookUps->where('local_church', $request->localChurch);
            }

            $lookUps = $lookUps->orderBy('firstname', 'ASC')->get();
        }

        if ($lookUps->count() === 0) {
            return response()->json(['error' => 'Data not found. Please reach out to your local coordinator.'], 500);
        }

        if ('Y' === env('ENABLE_INTEGRATION')) {
            $data = [];
            $col_lamp_id = env('CHURCHCRM_LAMP_ID_COL');
            $col_local_church = env('CHURCHCRM_LOCAL_CHURCH_COL');
            $col_cluster_group = env('CHURCHCRM_CLUSTER_GROUP_COL');
            foreach ($lookUps as $lookUp) {
                $data[] = [
                    "lamp_id" => $lookUp->$col_lamp_id,
                    "old_lamp_card_number" => $lookUp->$col_lamp_id,
                    "email" => $lookUp->per_Email,
                    "firstname" => $lookUp->person->per_FirstName,
                    "lastname" => $lookUp->person->per_LastName,
                    "fullname" => $lookUp->person->per_FirstName .' '. $lookUp->person->per_LastName,
                    "facebook_name" => "",
                    "registration_type" => "Member",
                    "local_church" => $lookUp->$col_local_church,
                    "cluster_group" => $lookUp->$col_cluster_group,
                    "country" => $lookUp->person->per_Country,
                    "category" => "Adult",
                    "can_book_days" => $event->member_booking_limit,
                    "avail_new_lamp_id" => null,
                    "is_registered" => is_null(Registration::where('event_id', $event->id)->where('uuid', $lookUp->$col_lamp_id)->first()) ? 0 : 1
                ];
            }

            return $data;
        }

        return $lookUps;
    }

    /**
     * Return delegate record.
     *
     * @param  String $awtaNumber
     * @return \App\Models\LookUp
     */
    public function show(Event $event, $awtaNumber)
    {
        if ('Y' === env('ENABLE_INTEGRATION')) {
            $lookUp = Finder::where(env('CHURCHCRM_LAMP_ID_COL'), $awtaNumber)->with('person')->first();
        } else {
            $lookUp = LookUp::where('lamp_id', $awtaNumber)->first();
        }
        
        if (!$lookUp) {
            return response()->json(['error' => 'Data not found. Please reach out to your local coordinator.'], 404);
        }

        $isRegistered = Registration::where('event_id', $event->id)->where('uuid', $awtaNumber)->first();

        if ($isRegistered) {
            return response()->json(['error' => 'Sorry, this LAMP ID number is already registered.'], 500);
        }

        if ('Y' === env('ENABLE_INTEGRATION')) {
            $col_lamp_id = env('CHURCHCRM_LAMP_ID_COL');
            $col_local_church = env('CHURCHCRM_LOCAL_CHURCH_COL');
            $col_cluster_group = env('CHURCHCRM_CLUSTER_GROUP_COL');
            $data = [
                "lamp_id" => $lookUp->$col_lamp_id,
                "old_lamp_card_number" => $lookUp->$col_lamp_id,
                "email" => $lookUp->per_Email,
                "firstname" => $lookUp->person->per_FirstName,
                "lastname" => $lookUp->person->per_LastName,
                "fullname" => $lookUp->person->per_FirstName .' '. $lookUp->person->per_LastName,
                "facebook_name" => "",
                "registration_type" => "Member",
                "local_church" => $lookUp->$col_local_church,
                "cluster_group" => $lookUp->$col_cluster_group,
                "country" => $lookUp->person->per_Country,
                "category" => "Adult",
                "can_book_days" => $event->member_booking_limit,
                "avail_new_lamp_id" => null
            ];
    
            return $data;
        }

        return $lookUp;
    }

    /**
     * Bulk upload via excel
     *
     * @param  Request $request
     * @return String
     */
    public function upload(Request $request)
    {
        request()->validate([
            'lookup' => 'required|mimes:xlx,xls,xlsx|max:2048'
        ]);

        FacadesExcel::import(new LookUpImport, $request->file('lookup'));

        return back()->with('massage', 'User Imported Successfully');
    }

    /**
     * Upload via excel view
     *
     * @return View
     */
    public function upload_view()
    {
        return view('lookup.upload');
    }

    /**
     * Edit lookup data view
     *
     * @return View
     */
    public function edit($awtaNumber)
    {
        return view('lookup.edit', [
            'lookup' => LookUp::where('lamp_id', $awtaNumber)->first()
        ]);
    }

    /**
     * Update lookup data
     *
     * @param  String $awtaNumber
     * @param  Request $request
     * @return View
     */
    public function update($awtaNumber, Request $request)
    {
        $lookup = LookUp::where('lamp_id', $awtaNumber)->first();

        $lookup->update([
            'email' => $request->email,
            'firstname' => $request->firstName,
            'lastname' => $request->lastName,
            'fullname' => $request->firstName . ' ' . $request->lastName,
            'facebook_name' => $request->facebookName,
            'local_church' => $request->localChurch,
            'country' => $request->country,
            'category' => $request->category,
            'can_book_days' => $request->canBookDays,
            'cluster_group' => $request->clusterGroup
        ]);

        $registration = Registration::where('uuid', $awtaNumber)->first();

        if ($registration) { // if has registration
            $registration->update([
                'email' => $request->email,
                'firstname' => $request->firstName,
                'lastname' => $request->lastName,
                'fullname' => $request->firstName . ' ' . $request->lastName,
                'facebook_name' => $request->facebookName,
                'local_church' => $request->localChurch,
                'country' => $request->country,
                'category' => $request->category,
                'can_book_days' => $request->canBookDays,
                'cluster_group' => $request->clusterGroup
            ]);

            // if has booking
            $registration->bookings()->update([
                'local_church' => $request->localChurch,
            ]);
        }

        return view('lookup.edit', [
            'lookup' => $lookup
        ]);
    }

    /**
     * Create lookup view
     *
     * @return View
     */
    public function create()
    {
        return view('lookup.create');
    }

    /**
     * Store lookup data
     *
     * @param  String $awtaNumber
     * @param  Request $request
     * @return View
     */
    public function store(Request $request)
    {
        $lookUp = LookUp::where('lamp_id', $request->lampIDNumber)->first();

        if ($lookUp) {
            return response()->json(['error' => 'LAMP ID number already exists.'], 422);
        }

        $lookUp = LookUp::where('fullname', $request->firstName . ' ' . $request->lastName)->first();

        if ($lookUp) {
            return response()->json(['error' => 'Data already exists.'], 422);
        }

        $lookUp = LookUp::create([
            'lamp_id' => $request->lampIDNumber,
            'email' => $request->email,
            'firstname' => $request->firstName,
            'lastname' => $request->lastName,
            'fullname' => $request->firstName . ' ' . $request->lastName,
            'facebook_name' => $request->facebookName,
            'registration_type' => RegistrationType::Member,
            'local_church' => $request->localChurch,
            'country' => $request->country,
            'category' => $request->category,
            'can_book_days' => $request->canBookDays,
        ]);

        return view('lookup.create', [
            'lookup' => $lookUp
        ]);
    }
}
