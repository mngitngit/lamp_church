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
            'payment_status'
        ))
        ->with('rate')
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
            'Payment Status',
            'Rate',
            'Total Amount Paid'
        );
    }
}
