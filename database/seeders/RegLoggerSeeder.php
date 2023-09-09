<?php

namespace Database\Seeders;

use App\Enums\BookingStatus;
use App\Models\Registration;
use Illuminate\Database\Seeder;

class RegLoggerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $registrations = Registration::where('booking_status', BookingStatus::Cancelled)->get();

        foreach ($registrations as $registration) {
            $registration->updateBookingActivities($registration->uuid, $registration->booking_activities, array('Booking cancelled due to unsettled payment.'));
        }
    }
}
