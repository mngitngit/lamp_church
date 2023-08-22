<?php

namespace App\Http\Controllers;

use App\Enums\BookingStatus;
use App\Enums\PaymentStatus;
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
                'status' => $registration->payment_status === PaymentStatus::Paid || $registration->payment_status === PaymentStatus::Free ? BookingStatus::Confirmed : BookingStatus::Pending
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
            $parameters['payment_status'] = PaymentStatus::Paid;
        }

        if ($balance > 0.0 && count($registration->payments) > 0) {
            $parameters['payment_status'] = PaymentStatus::Partial;
        }

        if ($balance == 0.0 && count($registration->payments) == 0) {
            $parameters['payment_status'] = PaymentStatus::Free;
        }

        if ($balance > 0.0 && count($registration->payments) == 0) {
            $parameters['payment_status'] = PaymentStatus::Unsettled;
        }

        if ($auto_enable_booking && $registration->attending_option === 'Hybrid') {
            if ($totalAmountPaid >= $canBookRate) {
                if ($registration->booking_status === BookingStatus::Pending) {
                    Booking::where('registration_uuid', $uuid)->update([
                        'status' => BookingStatus::Confirmed
                    ]);

                    $registration->update([
                        'booking_status' => BookingStatus::Confirmed
                    ]);
                }
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
}
