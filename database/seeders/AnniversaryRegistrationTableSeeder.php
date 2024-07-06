<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Registration;
use App\Enums\AttendingOption;

class AnniversaryRegistrationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $register = array(
            [
                'uuid' => 'LAMP00001',
                'firstname' => 'Joshua',
                'lastname' => 'Tadem',
                'registration_type' => 'Guest',
                'local_church' => 'Binan',
                'category' => 'Adult',
                'cluster_group' => 'SAMPLE'
            ],
        );

        foreach ($register as $data) {
            $this->command->info('-------- registering guest ----------');

            $this->command->info('Full Name: ' . ($data['firstname']) . ' ' . ($data['lastname']));
            $this->command->info('Local Church: ' . $data['local_church']);

            $registration = Registration::create([
                'uuid' => $data['uuid'], 
                'email' => '',
                'firstname' => $data['firstname'],
                'lastname' => $data['lastname'],
                'fullname' => ($data['firstname']) . ' ' . ($data['lastname']),
                'facebook_name' => '',
                'registration_type' => $data['registration_type'],
                'local_church' => $data['local_church'],
                'cluster_group' => $data['cluster_group'],
                'country' => 'Philippines', 
                'category' => $data['category'], 
                'attending_option' => AttendingOption::Hybrid,
                'rate' => 0, 
                'payment_status' => 'Paid', 
                'booking_status' => 'Confirmed', 
                'with_awta_card' => 'yes',
                'can_book_rate' => 0, 
                'can_book_days' => 1, 
                'rebooking_limit' => 7, 
                'is_booking_bypassed' => 0, 
                'avail_new_lamp_id' => 'no', 
                'visitor_to_member' => null, 
                'medical_assistance_needed' => 'N/A', 
                'notes' => [], 
                'activities' => [], 
                'booking_activities' => [], 
                'booked_date' => null, 
                'is_received_hg' => null 
            ]);

            $registration->bookings()->create([
                'registration_uuid' => $registration->uuid,
                'slot_id' => 5,
                'local_church' => $registration->local_church,
                'status' => 'Confirmed'
            ]);

            $this->command->info('--------------- done '. $registration->id .' ----------------');
        }
    }
}
