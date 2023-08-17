<?php

namespace App\Http\Controllers;

use App\Enums\BookingStatus;
use App\Enums\RegistrationType;
use App\Models\Booking;
use App\Models\LookUp;
use App\Models\Registration;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        $charactersLength = strlen($characters);

        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    function generateGuestId()
    {
        $lastGuestId = Registration::select('uuid')->where('registration_type', RegistrationType::Guest)->orderBy('id', 'desc')->first();

        if ($lastGuestId) {
            $number = last(explode("GUEST", $lastGuestId['uuid'])); //explode the string to get the number part, last is a laravel helper
        } else {
            $number = 0;
        }
        $new = str_pad(intval($number) + 1, 4, 0, STR_PAD_LEFT); //increment the number by 1 and pad with 0 in left.

        $prefix = "GUEST";

        return $prefix . $new;
    }

    function book($registration, $bookings)
    {
        foreach ($bookings as $booking) {
            Booking::create([
                'registration_uuid' => $registration['uuid'],
                'slot_id' => $booking,
                'local_church' => $registration['local_church'],
                'status' => $registration->payment_status === 'Paid' ? 'Confirmed' : 'Pending'
            ]);
        }
    }

    function updatePaymentStatus($uuid, $auto_enable_booking)
    {
        $registration = Registration::where('uuid', $uuid)->first();

        $balance = floatval($registration->rate);

        $canBookRate = floatval($registration->can_book_rate);

        $totalAmountPaid = floatval(array_sum(array_column($registration->payments->toArray(), 'amount')));

        $balance -= $totalAmountPaid;

        $parameters = array();

        if ($balance <= 0.0 && count($registration->payments) > 0) {
            $parameters['payment_status'] = 'Paid';
        }

        if ($balance > 0.0 && count($registration->payments) > 0) {
            $parameters['payment_status'] = 'Partial';
        }

        if ($balance == 0.0 && count($registration->payments) == 0) {
            $parameters['payment_status'] = 'Free';
        }

        if ($balance > 0.0 && count($registration->payments) == 0) {
            $parameters['payment_status'] = 'Unsettled';
        }

        if ($auto_enable_booking && $registration->attending_option === 'Hybrid') {
            if ($totalAmountPaid >= $canBookRate && !$registration->is_booking_bypassed) {
                $parameters['can_book'] = true;

                Booking::where('registration_uuid', $uuid)->update([
                    'status' => BookingStatus::Confirmed
                ]);
            }
        }

        $registration->update($parameters);

        return $registration;
    }

    function checkIfAlreadyRegistered($request)
    {
        $registration = Registration::where('firstname', $request->firstName)
            ->where('lastname', $request->lastName)
            ->where('local_church', $request->localChurch)
            ->first();

        if ($registration) {
            return ['error' => 'This delegate from ' . $request->localChurch . ' is already registered.'];
        }

        $lookup = LookUp::where('firstname', $request->firstName)
            ->where('lastname', $request->lastName)
            ->where('local_church', $request->localChurch)
            ->first();

        if ($lookup) {
            return ['error' => 'This delegate from ' . $request->localChurch . ' has already been issued with an AWTA card number.'];
        }

        return [];
    }

    function updateStaffNotes($uuid, $details, array $messages)
    {
        $notes = json_decode($details, true);

        foreach ($messages as $message) {
            $notes[] = [
                'user' => auth()->user()->name,
                'message' => $message,
                'timestamp' => date('M d, Y h:i A')
            ];
        }

        $registration = Registration::where('uuid', $uuid)->update([
            'notes' => $notes
        ]);

        return $registration;
    }

    function updateActivites($uuid, $details, array $messages)
    {
        $activities = json_decode($details, true);

        foreach ($messages as $message) {
            $activities[] = [
                'user' => auth()->user()->name,
                'message' => $message,
                'timestamp' => date('M d, Y h:i A')
            ];
        }

        $registration = Registration::where('uuid', $uuid)->update([
            'activities' => $activities
        ]);

        return $registration;
    }
}
