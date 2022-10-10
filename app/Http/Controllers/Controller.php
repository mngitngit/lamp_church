<?php

namespace App\Http\Controllers;

use App\Enums\RegistrationType;
use App\Models\Registration;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        $charactersLength = strlen($characters);

        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    function generateGuestId() {
        $lastGuestId = Registration::select('uuid')->where('registration_type', RegistrationType::Guest)->orderBy('id','desc')->first();
        
        if ($lastGuestId) {
            $number = last(explode("GUEST",$lastGuestId['uuid'])); //explode the string to get the number part, last is a laravel helper
        } else {
            $number = 0;
        }
        $new = str_pad(intval($number) + 1, 4, 0, STR_PAD_LEFT); //increment the number by 1 and pad with 0 in left.

        $prefix = "GUEST";

        return $prefix . $new;
    }

    function updatePaymentStatus($uuid, $auto_enable_booking) {
        $registration = Registration::where('uuid', $uuid)->first();

        $balance = floatval($registration->rate);

        $canBookRate = floatval($registration->can_book_rate);

        $totalAmountPaid = floatval(array_sum(array_column($registration->payments->toArray(), 'amount')));

        $balance-= $totalAmountPaid;

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
            }
        }

        $registration->update($parameters);

        return $registration;
    }
}
