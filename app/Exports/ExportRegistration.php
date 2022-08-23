<?php

namespace App\Exports;

use App\Models\Registration;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportRegistration implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Registration::select(array(
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
            'rate',
            'payment_status',
        ))
        ->withSum('payments', 'amount')
        ->get();
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
            'Rate',
            'Payment Status',
            'Total Amount Paid'
        );
    }
}
