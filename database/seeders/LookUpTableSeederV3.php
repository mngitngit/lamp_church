<?php

namespace Database\Seeders;

use App\Models\LookUp;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class LookUpTableSeederV3 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LookUp::insert([
            ['awta_card_number'=>'SMPL00001','email'=>'','firstname'=>'sample','lastname'=>'sample','facebook_name'=>'sample sample','registration_type'=>'Member','category'=>'Adult','local_church'=>'Dasmarinas','country'=>'Philippines','created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['awta_card_number'=>'SMPL00002','email'=>'','firstname'=>'sample','lastname'=>'sample','facebook_name'=>'sample sample','registration_type'=>'Member','category'=>'Adult','local_church'=>'Dasmarinas','country'=>'Philippines','created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['awta_card_number'=>'SMPL00003','email'=>'','firstname'=>'sample','lastname'=>'sample','facebook_name'=>'sample sample','registration_type'=>'Member','category'=>'Adult','local_church'=>'Dasmarinas','country'=>'Philippines','created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['awta_card_number'=>'SMPL00004','email'=>'','firstname'=>'sample','lastname'=>'sample','facebook_name'=>'sample sample','registration_type'=>'Member','category'=>'Adult','local_church'=>'Dasmarinas','country'=>'Philippines','created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['awta_card_number'=>'SMPL00005','email'=>'','firstname'=>'sample','lastname'=>'sample','facebook_name'=>'sample sample','registration_type'=>'Member','category'=>'Adult','local_church'=>'Dasmarinas','country'=>'Philippines','created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['awta_card_number'=>'SMPL00006','email'=>'','firstname'=>'sample','lastname'=>'sample','facebook_name'=>'sample sample','registration_type'=>'Member','category'=>'Adult','local_church'=>'Dasmarinas','country'=>'Philippines','created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['awta_card_number'=>'SMPL00007','email'=>'','firstname'=>'sample','lastname'=>'sample','facebook_name'=>'sample sample','registration_type'=>'Member','category'=>'Adult','local_church'=>'Dasmarinas','country'=>'Philippines','created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['awta_card_number'=>'SMPL00008','email'=>'','firstname'=>'sample','lastname'=>'sample','facebook_name'=>'sample sample','registration_type'=>'Member','category'=>'Adult','local_church'=>'Dasmarinas','country'=>'Philippines','created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['awta_card_number'=>'SMPL00009','email'=>'','firstname'=>'sample','lastname'=>'sample','facebook_name'=>'sample sample','registration_type'=>'Member','category'=>'Adult','local_church'=>'Dasmarinas','country'=>'Philippines','created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
        ]);
    }
}
