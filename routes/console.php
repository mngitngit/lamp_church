<?php

use App\Enums\BookingStatus;
use App\Models\Registration;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('cancel-bookings', function () {
    $this->comment('---------------------------------- ' . \Carbon\Carbon::today() . ' ---------------------------------');
    $date = \Carbon\Carbon::today()->subDays(8);

    // get all registrations that have not been paid for more than seven days since they were booked
    $registrations = Registration::where('created_at', '<=', $date)->where('booking_status', BookingStatus::Pending)->get();

    foreach ($registrations as $registration) {
        $registration->bookings()->update([
            'status' => BookingStatus::Cancelled
        ]);

        $registration->update([
            'booking_status' => BookingStatus::Cancelled
        ]);

        $this->comment('[' . $registration->uuid . '] ' . $registration->fullname . '\'s booking is now cancelled. Date Registered: ' . $registration->created_at);
    }

    if (count($registrations) === 0) {
        $this->comment('No expired booking found.');
    }
})->purpose('Booking cancellation for unsettled registrations');
