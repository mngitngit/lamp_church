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
                'rate' => 1000
            ], [
                'category' => 'Kids',
                'rate' => 500
            ], [
                'category' => 'Free',
                'rate' => 0
            ]
        ]);
    }
}
