<?php

namespace Database\Seeders;

use App\Models\LookUp;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class LookUpTableSeederV4 extends Seeder
{
    public function run()
    {
        LookUp::insert([
            ['lamp_card_number' => 'LPMU00490', 'email' => '', 'firstname' => 'Ana Marie', 'lastname' => 'Agustin', 'facebook_name' => '', 'registration_type' => 'Member', 'category' => 'Adult', 'local_church' => 'Muntinlupa', 'country' => 'Philippines', 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['lamp_card_number' => 'LPMU00491', 'email' => '', 'firstname' => 'Tricia May', 'lastname' => 'Cagaoan', 'facebook_name' => '', 'registration_type' => 'Member', 'category' => 'Adult', 'local_church' => 'Muntinlupa', 'country' => 'Philippines', 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['lamp_card_number' => 'LPMU00548', 'email' => '', 'firstname' => 'Mariah', 'lastname' => 'Solver', 'facebook_name' => '', 'registration_type' => 'Member', 'category' => 'Adult', 'local_church' => 'Muntinlupa', 'country' => 'Philippines', 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['lamp_card_number' => 'LPMU00549', 'email' => '', 'firstname' => 'Rizaldy', 'lastname' => 'Lumabas', 'facebook_name' => '', 'registration_type' => 'Member', 'category' => 'Adult', 'local_church' => 'Muntinlupa', 'country' => 'Philippines', 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['lamp_card_number' => 'LPMU00550', 'email' => '', 'firstname' => 'Lolita', 'lastname' => 'Lumabas', 'facebook_name' => '', 'registration_type' => 'Member', 'category' => 'Adult', 'local_church' => 'Muntinlupa', 'country' => 'Philippines', 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['lamp_card_number' => 'LPMU00551', 'email' => '', 'firstname' => 'Christine Joy', 'lastname' => 'Santos', 'facebook_name' => '', 'registration_type' => 'Member', 'category' => 'Adult', 'local_church' => 'Muntinlupa', 'country' => 'Philippines', 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['lamp_card_number' => 'LPMU00552', 'email' => '', 'firstname' => 'Julieta', 'lastname' => 'Tolentino', 'facebook_name' => '', 'registration_type' => 'Member', 'category' => 'Adult', 'local_church' => 'Muntinlupa', 'country' => 'Philippines', 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['lamp_card_number' => 'LPMU00553', 'email' => '', 'firstname' => 'Maxine', 'lastname' => 'Custodio', 'facebook_name' => '', 'registration_type' => 'Member', 'category' => 'Adult', 'local_church' => 'Muntinlupa', 'country' => 'Philippines', 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['lamp_card_number' => 'LPMU00554', 'email' => '', 'firstname' => 'Ella', 'lastname' => 'Custodio', 'facebook_name' => '', 'registration_type' => 'Member', 'category' => 'Adult', 'local_church' => 'Muntinlupa', 'country' => 'Philippines', 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')]
        ]);
    }
}
