<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExportHistory;

class ExportHistoryController extends Controller
{
    public function index(Request $request) {
        $history = ExportHistory::query();

        if ($request->type) {
            $history = $history->where('type', $request->type);
        }

        return $history->get();
    }
}
