<?php

namespace App\Http\Controllers;

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

    function updatePaymentStatus($uuid) {
        $registration = Registration::where('uuid', $uuid)->first();

        $balance = floatval($registration->rate);
        $balance-= floatval(array_sum(array_column($registration->payments->toArray(), 'amount')));

        if ($balance <= 0.0) {
            $registration->update([
                'is_paid' => true
            ]);
        }

        return $registration;
    }
}
