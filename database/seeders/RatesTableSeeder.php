<?php

namespace Database\Seeders;

use App\Enums\AttendingOption;
use App\Enums\PaymentStatus;
use App\Models\Rates;
use Illuminate\Database\Seeder;

class RatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Rates::insert([
            [
                'category' => 'Adult',
                'attending_option' => AttendingOption::Hybrid,
                'description' => 'Member (Hybrid)',
                'rate' => 900,
                'can_book_rate' => 450
            ], [
                'category' => 'Adult',
                'attending_option' => AttendingOption::Online,
                'description' => 'Member (Online)',
                'rate' => 100,
                'can_book_rate' => 100
            ], [
                'category' => 'Kids',
                'attending_option' => AttendingOption::Hybrid,
                'description' => 'Member age 5 - 8 yrs old (Hybrid)',
                'rate' => 450,
                'can_book_rate' => 225
            ], [
                'category' => 'Kids',
                'attending_option' => AttendingOption::Online,
                'description' => 'Member age 5 - 8 yrs old (Online)',
                'rate' => 50,
                'can_book_rate' => 50
            ], [
                'category' => PaymentStatus::Free,
                'attending_option' => AttendingOption::Hybrid,
                'description' => 'Visitor & Member 0 - 4 yrs old (Hybrid)',
                'rate' => 0,
                'can_book_rate' => 0
            ], [
                'category' => PaymentStatus::Free,
                'attending_option' => AttendingOption::Online,
                'description' => 'Visitor & Member 0 - 4 yrs old (Online)',
                'rate' => 0,
                'can_book_rate' => 0
            ]
        ]);
    }
}
