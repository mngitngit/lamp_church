<?php

namespace Database\Seeders;

use App\Models\AvailableUuid;
use App\Models\LookUp;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AvailableUUIDsTableSeeder extends Seeder
{
    public function run()
    {
        AvailableUuid::insert([
            [
                'local_church' => 'Binan',
                'prefix' => 'LPBI',
                'start' => 214,
                'end' => 10000,
                'cursor' => 214
            ],
            [
                'local_church' => 'Canlubang',
                'prefix' => 'LPCA',
                'start' => 433,
                'end' => 10000,
                'cursor' => 433
            ],
            [
                'local_church' => 'Dasmarinas',
                'prefix' => 'LPDA',
                'start' => 133,
                'end' => 10000,
                'cursor' => 133
            ],
            [
                'local_church' => 'DC Cruz',
                'prefix' => 'LPDC',
                'start' => 175,
                'end' => 10000,
                'cursor' => 175
            ],
            [
                'local_church' => 'Granada',
                'prefix' => 'LPGR',
                'start' => 92,
                'end' => 10000,
                'cursor' => 92
            ],
            [
                'local_church' => 'Isabela',
                'prefix' => 'LPIS',
                'start' => 55,
                'end' => 10000,
                'cursor' => 55
            ],
            [
                'local_church' => 'Muntinlupa',
                'prefix' => 'LPMU',
                'start' => 543,
                'end' => 10000,
                'cursor' => 543
            ],
            [
                'local_church' => 'Pateros',
                'prefix' => 'LPPA',
                'start' => 109,
                'end' => 10000,
                'cursor' => 109
            ],
            [
                'local_church' => 'Tarlac',
                'prefix' => 'LPTA',
                'start' => 127,
                'end' => 10000,
                'cursor' => 127
            ],
            [
                'local_church' => 'Valenzuela',
                'prefix' => 'LPVA',
                'start' => 57,
                'end' => 10000,
                'cursor' => 57
            ]
        ]);
    }
}
   