<?php

use App\Enums\BookingStatus;
use App\Models\Registration;
use App\Enums\AttendingOption;
use App\Notifications\Registered;
use App\Notifications\Reminder;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Notification;

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
Artisan::command('send-out-event-reminder', function () {
    $this->comment('---------------------------------- ' . \Carbon\Carbon::today() . ' ---------------------------------');
    $registrations = Registration::where('attending_option', AttendingOption::Hybrid)->where('id', '>', 2551)->get();
    
    foreach ($registrations as $registration) {
        if ($registration->email != '') {
            Notification::route('mail', [
                $registration->email => $registration->fullname,
            ])->notify(new Reminder($registration));

            $this->comment($registration->id . ' - sent reminder to ' . $registration->fullname . ' - ' . $registration->email);
        } else {
            $this->comment($registration->id . ' - reminder not sent for ' . $registration->fullname . ' - [no email address provided]');
        }
    }
    $this->comment('---------------------------------- end ---------------------------------');
});


Artisan::command('cancel-bookings', function () {
    $this->comment('---------------------------------- ' . \Carbon\Carbon::today() . ' ---------------------------------');
    $date = \Carbon\Carbon::today()->subDays(7);

    // get all registrations that have not been paid for more than seven days since they were booked
    $registrations = Registration::withSum('payments', 'amount')->where('booked_date', '<=', $date)->where('booking_status', BookingStatus::Pending)->get();

    foreach ($registrations as $registration) {
        if (floatval($registration->can_book_rate) > floatval($registration->payments_sum_amount)) {
            $registration->bookings()->update([
                'status' => BookingStatus::Cancelled
            ]);

            $registration->update([
                'booking_status' => BookingStatus::Cancelled
            ]);

            $registration = Registration::with('bookings', 'bookings.slot')->withSum('payments', 'amount')->find($registration->id);

            if ($registration->email) {
                Notification::route('mail', [
                    $registration->email => $registration->fullname,
                ])->notify(new Registered($registration));
            }

            $registration->updateBookingActivities($registration->uuid, $registration->booking_activities, array('Booking cancelled due to unsettled payment.'));

            $this->comment('[' . $registration->uuid . '] ' . $registration->fullname . '\'s booking is now cancelled. Date Booked: ' . $registration->booked_date);
        }
    }

    if (count($registrations) === 0) {
        $this->comment('No expired booking found.');
    }
})->purpose('Booking cancellation for unsettled registrations');
