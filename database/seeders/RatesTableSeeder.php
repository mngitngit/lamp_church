<?php

namespace Database\Seeders;

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
                'attending_option' => 'Hybrid',
                'description' => 'Member (Hybrid)',
                'rate' => 900,
                'can_book_rate' => 500
            ], [
                'category' => 'Adult',
                'attending_option' => 'Online',
                'description' => 'Member (Online)',
                'rate' => 100,
                'can_book_rate' => 0
            ], [
                'category' => 'Kids',
                'attending_option' => 'Hybrid',
                'description' => 'Member age 5 - 8 yrs old (Hybrid)',
                'rate' => 500,
                'can_book_rate' => 250
            ], [
                'category' => 'Kids',
                'attending_option' => 'Online',
                'description' => 'Member age 5 - 8 yrs old (Online)',
                'rate' => 50,
                'can_book_rate' => 0
            ], [
                'category' => 'Free',
                'attending_option' => 'Hybrid',
                'description' => 'Visitor & Member 0 - 4 yrs old (Hybrid)',
                'rate' => 0,
                'can_book_rate' => 0
            ], [
                'category' => 'Free',
                'attending_option' => 'Online',
                'description' => 'Visitor & Member 0 - 4 yrs old (Online)',
                'rate' => 0,
                'can_book_rate' => 0
            ]
        ]);
    }
}
