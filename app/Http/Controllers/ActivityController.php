<?php

namespace App\Http\Controllers;

use App\Http\Resources\ActivityResource;
use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index(Request $request) {
        $activities = Activity::with('user');

        return view('activities.index', [
            'activities' => ActivityResource::collection($activities->get())->all()
        ]);
    }
}