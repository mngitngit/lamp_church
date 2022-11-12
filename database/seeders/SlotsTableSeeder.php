<?php

namespace Database\Seeders;

use App\Models\Slots;
use Illuminate\Database\Seeder;

class SlotsTableSeeder extends Seeder
{
    public function run()
    {
        Slots::insert([
            [
                'event_date' => date("Y-m-d", strtotime("12/26/2022")),
                'seat_count' => 500
            ],
            [
                'event_date' => date("Y-m-d", strtotime("12/27/2022")),
                'seat_count' => 500
            ],
            [
                'event_date' => date("Y-m-d", strtotime("12/28/2022")),
                'seat_count' => 500
            ],
            [
                'event_date' => date("Y-m-d", strtotime("12/29/2022")),
                'seat_count' => 500
            ]
        ]);
    }
}
