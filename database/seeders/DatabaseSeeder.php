<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RatesTableSeeder::class,
            AvailableUUIDsTableSeeder::class,
            LookUpTableSeeder::class,
            UserTableSeeder::class,
            PermissionsTableSeeder::class,
            SlotsTableSeeder::class
        ]);
    }
}
