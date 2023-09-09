<?php

namespace Database\Seeders;

use App\Enums\AttendingOption;
use App\Models\Registration;
use Illuminate\Database\Seeder;

class RegLoggerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $registrations = Registration::where('attending_option', AttendingOption::Hybrid)->get();

        foreach ($registrations as $registration) {
            $registration->update([
                'booked_date' => $registration->created_at
            ]);
        }
    }
}
