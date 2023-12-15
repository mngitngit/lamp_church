<?php

namespace App\Exports;

use App\Models\Attendance;
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
