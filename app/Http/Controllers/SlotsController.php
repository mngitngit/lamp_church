<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slots;

class SlotsController extends Controller
{
    public function index() {
        return view('slots.index', [
            'slots' => Slots::all()
        ]);
    }

    public function store(Request $request) {
        $slot = Slots::find($request->selected['id']);

        if (empty($slot)) {
            return response()->json(['error' => 'Slot not found.'], 422);
        }

        $activities = $slot->activities;

        array_unshift($activities, [
            'user' => auth()->user()->name ?? '',
            'message' => $request->notes,
            'timestamp' => date('M d, Y h:i A')
        ]);

        $slot = $slot->update([
            'seat_count' => $slot->seat_count + $request->additional_count,
            'activities' => $activities
        ]);

        return $slot;
    }
}
