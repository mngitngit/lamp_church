<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        User::insert([
            ['name' => 'Berj Batitis', 'email' => 'berj@lampawta.com', 'password' => Hash::make('admin123')],
            ['name' => 'Melanie Ngitngit', 'email' => 'mela@lampawta.com', 'password' => Hash::make('admin123')],
        ]);
    }
}
