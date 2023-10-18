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
                'cluster_group',
                'country',
                'category',
                'attending_option',
                'with_awta_card',
                'avail_new_lamp_id',
                'rate',
                'payment_status',
                'booking_status',
                'medical_assistance_needed',
                'visitor_to_member'
            ))
                ->withSum('payments', 'amount', 'old_uuid')
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
            'Cluster Group',
            'Country',
            'Category',
            'Attending Option',
            'with AWTA Card number?',
            'will avail new LAMP ID?',
            'Booked Dates',
            'Booking Status',
            'Attended Dates',
            'Rate',
            'Payment Status',
            'Total Amount Paid',
            'Medical Assistance Needed',
            'Visitor to Member',
            'Old AWTA Card Number'
        );
    }
}
