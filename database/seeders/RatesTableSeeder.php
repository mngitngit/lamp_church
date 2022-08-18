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
                'rate' => 1000
            ], [
                'category' => 'Adult',
                'attending_option' => 'Online',
                'rate' => 100
            ], [
                'category' => 'Kids',
                'attending_option' => 'Hybrid',
                'rate' => 500
            ], [
                'category' => 'Kids',
                'attending_option' => 'Online',
                'rate' => 50
            ], [
                'category' => 'Free',
                'attending_option' => 'Hybrid',
                'rate' => 0
            ], [
                'category' => 'Free',
                'attending_option' => 'Online',
                'rate' => 0
            ]
        ]);
    }
}
