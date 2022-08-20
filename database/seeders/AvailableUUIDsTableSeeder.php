<?php

namespace Database\Seeders;

use App\Models\AvailableUUID;
use App\Models\LookUp;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AvailableUUIDsTableSeeder extends Seeder
{
    public function run()
    {
        AvailableUUID::insert([
            [
                'local_church' => 'Binan',
                'prefix' => 'LPBI',
                'start' => 1000,
                'end' => 10000,
                'cursor' => 1000
            ],
            [
                'local_church' => 'Cadiz',
                'prefix' => 'LPCD',
                'start' => 1000,
                'end' => 10000,
                'cursor' => 1000
            ],
            [
                'local_church' => 'Canlubang',
                'prefix' => 'LPCA',
                'start' => 1000,
                'end' => 10000,
                'cursor' => 1000
            ],
            [
                'local_church' => 'Dasmarinas',
                'prefix' => 'LPDA',
                'start' => 1000,
                'end' => 10000,
                'cursor' => 1000
            ],
            [
                'local_church' => 'DC Cruz',
                'prefix' => 'LPDC',
                'start' => 1000,
                'end' => 10000,
                'cursor' => 1000
            ],
            [
                'local_church' => 'Granada',
                'prefix' => 'LPGR',
                'start' => 1000,
                'end' => 10000,
                'cursor' => 1000
            ],
            [
                'local_church' => 'Iloilo',
                'prefix' => 'LPIL',
                'start' => 1000,
                'end' => 10000,
                'cursor' => 1000
            ],
            [
                'local_church' => 'Isabela',
                'prefix' => 'LPIS',
                'start' => 1000,
                'end' => 10000,
                'cursor' => 1000
            ],
            [
                'local_church' => 'Muntinlupa',
                'prefix' => 'LPMU',
                'start' => 1000,
                'end' => 10000,
                'cursor' => 1000
            ],
            [
                'local_church' => 'Pateros',
                'prefix' => 'LPPA',
                'start' => 1000,
                'end' => 10000,
                'cursor' => 1000
            ],
            [
                'local_church' => 'Tarlac',
                'prefix' => 'LPTA',
                'start' => 1000,
                'end' => 10000,
                'cursor' => 1000
            ]
        ]);
    }
}
   