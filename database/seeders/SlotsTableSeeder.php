<?php

namespace Database\Seeders;

use App\Models\Slots;
use Illuminate\Database\Seeder;

class SlotsTableSeeder extends Seeder
{
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Slots::truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        Slots::insert([
            [
                'event_date' => date("Y-m-d", strtotime("12/27/2023")),
                'seat_count' => 600,
                'registration_type' => 'Member',
                'updated_at' => NOW(),
                'created_at' => NOW()
            ],

            [
                'event_date' => date("Y-m-d", strtotime("12/28/2023")),
                'seat_count' => 600,
                'registration_type' => 'Member',
                'updated_at' => NOW(),
                'created_at' => NOW()
            ],
            [
                'event_date' => date("Y-m-d", strtotime("12/29/2023")),
                'seat_count' => 600,
                'registration_type' => 'Member',
                'updated_at' => NOW(),
                'created_at' => NOW()
            ],
            [
                'event_date' => date("Y-m-d", strtotime("12/30/2023")),
                'seat_count' => 600,
                'registration_type' => 'Member',
                'updated_at' => NOW(),
                'created_at' => NOW()
            ],
            [
                'event_date' => date("Y-m-d", strtotime("12/27/2023")),
                'seat_count' => 175,
                'registration_type' => 'Guest',
                'updated_at' => NOW(),
                'created_at' => NOW()
            ],
            [
                'event_date' => date("Y-m-d", strtotime("12/28/2023")),
                'seat_count' => 175,
                'registration_type' => 'Guest',
                'updated_at' => NOW(),
                'created_at' => NOW()
            ],
            [
                'event_date' => date("Y-m-d", strtotime("12/29/2023")),
                'seat_count' => 175,
                'registration_type' => 'Guest',
                'updated_at' => NOW(),
                'created_at' => NOW()
            ],
            [
                'event_date' => date("Y-m-d", strtotime("12/30/2023")),
                'seat_count' => 175,
                'registration_type' => 'Guest',
                'updated_at' => NOW(),
                'created_at' => NOW()
            ]
        ]);
    }
}
