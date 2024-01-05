<?php

namespace App\Http\Controllers;

use App\Models\ReceivedHG;
use App\Models\Registration;
use App\Models\Slots;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportReceivedHG;

class ReceivedHGController extends Controller
{
    public function index(Request $request) {
        $search = json_decode($request->search);

        $receivedHG = ReceivedHG::with('registration', 'slot');

        if ($search->local_church) {
            $receivedHG = $receivedHG->where('local_church', $search->local_church);
        }

        if ($search->keyword) {
            $receivedHG = $receivedHG->whereRelation('registration', 'fullname', 'LIKE', "%$search->keyword%")
                ->orWhereRelation('registration', 'uuid', 'LIKE', "%$search->keyword%");
        }

        $receivedHG = $receivedHG->paginate(10);

        return $receivedHG;
    }

    public function show($uuid, Request $request)
    {
        if (!$request->api_key) {
            return response()->json(['error' => 'API key is required.'], 403);
        }

        if ($request->api_key !== config('settings.api_key')) {
            return response()->json(['error' => 'API key is invalid.'], 403);
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

    public function store($uuid, Request $request)
    {
        if (is_null($uuid)) {
            return response()->json(['error' => 'LAMP ID/Guest code is required.'], 422);
        }

        $registration = Registration::where('uuid', $uuid)->first();

        if (!$registration) {
            return response()->json(['error' => 'Delegate not found.'], 422);
        }

        $received = ReceivedHG::where('registration_uuid', $uuid)->first();

        if ($received) {
            return response()->json(['error' => 'This delegate has record already.'], 422);
        }

        if (!$registration) {
            return response()->json(['error' => 'Delegate not found.'], 422);
        }

        if (!$request->day) {
            return response()->json(['error' => 'Please select AWTA day.'], 422);
        }

        if (!$request->notes || $request->notes == '') {
            return response()->json(['error' => 'Please add notes.'], 422);
        }

        $slots = config('settings.slots_allotment')[$request->day];

        if ($registration->registration_type === 'Member') {
            $slot_id = $slots[0];
        } else {
            $slot_id = $slots[1];
        }

        $hg = ReceivedHG::create([
            'registration_uuid' => $registration->uuid,
            'slot_id' => $slot_id,
            'local_church' => $registration->local_church,
            'registration_type' => $registration->registration_type,
            'notes' => $request->notes
        ]);

        $slot = Slots::find($slot_id)->getOriginal('event_date');

        $registration->update([
            'is_received_hg' => date_format($slot, 'Y-m-d')
        ]);

        return response()->json([
            'success' => 'Successfully Recorded!',
            'data' => $hg
        ], 422);
    }

    public function export() {
        return Excel::download(new ExportReceivedHG, 'received_hg_' . TIME() . '.csv');
    }

    public function destroy($id) {
        $record = ReceivedHG::find($id);

        $record->delete();
    }
}
