<?php

namespace Database\Seeders;

use App\Models\Rates;
use App\Models\Registration;
use Illuminate\Database\Seeder;

class RegistrationAutoBookingSeeder extends Seeder
{
    public function run()
    {
        $registrations = Registration::where('attending_option', 'Hybrid')->get();

        foreach ($registrations as $registration) {
            $totalAmountPaid = floatval(array_sum(array_column($registration->payments->toArray(), 'amount')));
            
            $payment_config = Rates::where('category', $registration->category)
                ->where('attending_option', $registration->attending_option)
                ->first();

            $canBookRate = $payment_config->can_book_rate;

            $registration->can_book = false; 
            $registration->can_book_rate = 0;
            $registration->can_book_days = 0; 

            if ($totalAmountPaid >= $canBookRate) {
                $registration->can_book = true; 
                $registration->can_book_rate = $canBookRate; 
                $registration->can_book_days = 2; 
            }

            $registration->save();
        }
    }
}
