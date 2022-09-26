<?php

namespace App\Exports;

use App\Models\Registration;
use App\Http\Resources\ExportRegistrationResource;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportRegistration implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {

        return ExportRegistrationResource::collection(
                Registration::select(array(
                    'created_at',
                    'uuid',
                    'email',
                    'firstname',
                    'lastname',
                    'facebook_name',
                    'registration_type',
                    'local_church',
                    'country',
                    'category',
                    'attending_option',
                    'with_awta_card',
                    'with_accommodation',
                    'mode_of_transpo',
                    'priority_dates',
                    'rate',
                    'payment_status',
                ))
                ->withSum('payments', 'amount')
                ->get()
        );
    }

    public function headings(): array
    {
        return array(
            'Date Registered',
            'ID',
            'Email',
            'First Name',
            'Last Name',
            'Facebook Name',
            'Registration Type',
            'Local Church',
            'Country',
            'Category',
            'Attending Option',
            'with AWTA Card number?',
            'with Accommodation?',
            'Mode of Transportation',
            'Preffered Dates for',
            'Booked Dates',
            'Rate',
            'Payment Status',
            'Total Amount Paid'
        );
    }
}
