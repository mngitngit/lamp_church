<?php

namespace App\Exports;

use App\Models\Attendance;
use App\Models\ExportHistory;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\ExportAttendanceResource;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportAttendance implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        ExportHistory::create([
            'type' => 'attendances',
            'user_id' => Auth::user()->id
        ]);
        
        return ExportAttendanceResource::collection(
            Attendance::with('registration', 'slot')->get()
        );
    }

    public function headings(): array
    {
        return array(
            'ID',
            'Event Date',
            'Date and Time',
            'First Name',
            'Last Name',
            'Registration Type',
            'Local Church',
            'Cluster Group',
            'Attendance'
        );
    }
}
