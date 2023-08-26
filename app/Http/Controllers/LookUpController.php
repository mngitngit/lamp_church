<?php

namespace App\Http\Controllers;

use App\Imports\LookUpImport;
use App\Models\LookUp;
use App\Models\Registration;
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
        $this->middleware('auth', ['except' => ['show', 'index', 'store']]);
    }

    public function index(Request $request)
    {
        $lookUp = LookUp::select();

        if ($request->lastname) {
            $lookUp = $lookUp->where('lastname', 'LIKE', "%$request->lastname%");
        }

        if ($request->localChurch) {
            $lookUp = $lookUp->where('local_church', $request->localChurch);
        }

        if ($lookUp->count() === 0) {
            return response()->json(['error' => 'Data not found. Please reach out to your local coordinator.'], 500);
        }


        return $lookUp->orderBy('firstname', 'ASC')->get();
    }

    /**
     * Return delegate record.
     *
     * @param  String $awtaNumber
     * @return \App\Models\LookUp
     */
    public function show($awtaNumber)
    {
        $lookUp = LookUp::where('lamp_card_number', $awtaNumber)->orWhere('old_lamp_card_number', $awtaNumber)->first();

        if (!$lookUp) {
            return response()->json(['error' => 'Data not found. Please reach out to your local coordinator.'], 404);
        }

        $isRegistered = Registration::where('uuid', $lookUp->lamp_card_number)->first();

        if ($isRegistered) {
            return response()->json(['error' => 'Sorry, this AWTA Card number is already registered.'], 500);
        }

        return $lookUp;
    }

    public function upload(Request $request)
    {
        request()->validate([
            'lookup' => 'required|mimes:xlx,xls,xlsx|max:2048'
        ]);

        FacadesExcel::import(new LookUpImport, $request->file('lookup'));
        return back()->with('massage', 'User Imported Successfully');
    }

    public function upload_view()
    {
        return view('lookup.create');
    }
}
