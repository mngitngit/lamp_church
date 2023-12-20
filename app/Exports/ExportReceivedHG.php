<?php

namespace App\Exports;

use App\Models\ReceivedHG;
use App\Models\ExportHistory;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\ExportReceivedHGResource;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportReceivedHG implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        ExportHistory::create([
            'type' => 'received hg',
            'user_id' => Auth::user()->id
        ]);
        
        return ExportReceivedHGResource::collection(
            ReceivedHG::with('registration', 'slot')->get()
        );
    }

    public function headings(): array
    {
        return array(
            'ID',
            'Date Received HG',
            'First Name',
            'Last Name',
            'Registration Type',
            'Local Church',
            'Cluster Group',
            'Altar Worker'
        );
    }
}
