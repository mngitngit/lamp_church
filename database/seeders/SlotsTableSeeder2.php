<?php

namespace Database\Seeders;

use App\Models\Slots;
use Illuminate\Database\Seeder;
use DB;

class SlotsTableSeeder2 extends Seeder
{
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Slots::truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        Slots::insert([
            [
                'event_date' => date("Y-m-d", strtotime("12/27/2022")),
                'seat_count' => 600,
                'registration_type' => 'Member',
                'updated_at' => NOW(),
                'created_at' => NOW()
            ],

            [
                'event_date' => date("Y-m-d", strtotime("12/28/2022")),
                'seat_count' => 600,
                'registration_type' => 'Member',
                'updated_at' => NOW(),
                'created_at' => NOW()
            ],
            [
                'event_date' => date("Y-m-d", strtotime("12/29/2022")),
                'seat_count' => 600,
                'registration_type' => 'Member',
                'updated_at' => NOW(),
                'created_at' => NOW()
            ],
            [
                'event_date' => date("Y-m-d", strtotime("12/30/2022")),
                'seat_count' => 600,
                'registration_type' => 'Member',
                'updated_at' => NOW(),
                'created_at' => NOW()
            ],
            [
                'event_date' => date("Y-m-d", strtotime("12/27/2022")),
                'seat_count' => 175,
                'registration_type' => 'Guest',
                'updated_at' => NOW(),
                'created_at' => NOW()
            ],
            [
                'event_date' => date("Y-m-d", strtotime("12/28/2022")),
                'seat_count' => 175,
                'registration_type' => 'Guest',
                'updated_at' => NOW(),
                'created_at' => NOW()
            ],
            [
                'event_date' => date("Y-m-d", strtotime("12/29/2022")),
                'seat_count' => 175,
                'registration_type' => 'Guest',
                'updated_at' => NOW(),
                'created_at' => NOW()
            ],
            [
                'event_date' => date("Y-m-d", strtotime("12/30/2022")),
                'seat_count' => 175,
                'registration_type' => 'Guest',
                'updated_at' => NOW(),
                'created_at' => NOW()
            ]
        ]);
    }
}
