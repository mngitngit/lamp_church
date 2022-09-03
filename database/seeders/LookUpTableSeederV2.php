<?php

namespace Database\Seeders;

use App\Models\LookUp;
use Illuminate\Database\Seeder;

class LookUpTableSeederV2 extends Seeder
{
    public function run()
    {
        LookUp::insert([
            ['awta_card_number'=>'LPMU00023','email'=>'','firstname'=>'Eusebia Jonalyn','lastname'=>'Cauton','facebook_name'=>'JowellnJoy Cauton','registration_type'=>'Member','category'=>'Adult','local_church'=>'Dasmarinas','country'=>'Philippines','created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['awta_card_number'=>'LPMU00255','email'=>'','firstname'=>'Patrick John','lastname'=>'Cauton','facebook_name'=>'JowellnJoy Cauton','registration_type'=>'Member','category'=>'Adult','local_church'=>'Dasmarinas','country'=>'Philippines','created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['awta_card_number'=>'LPMU00256','email'=>'','firstname'=>'Kurt Justin','lastname'=>'Cauton','facebook_name'=>'JowellnJoy Cauton','registration_type'=>'Member','category'=>'Adult','local_church'=>'Dasmarinas','country'=>'Philippines','created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
        ]);
    }
}
