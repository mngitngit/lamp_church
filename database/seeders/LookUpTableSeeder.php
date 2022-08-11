<?php

namespace Database\Seeders;

use App\Models\LookUp;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class LookUpTableSeeder extends Seeder
{
    public function run()
    {
        LookUp::insert([
            [
                'awta_card_number' => 'LPBI00022',
                'email' => 'crisannj7@gmail.com',
                'firstname' => 'Cris Ann',
                'lastname' => 'Jose',
                'facebook_name' => 'Ann Jose',
                'registration_type' => 'Member',
                'category' => 'Adult',
                'local_church' => 'Binan',
                'country' => 'Philippines',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'awta_card_number' => 'LPBI00010',
                'email' => 'alexcellojr1992@gmail.com',
                'firstname' => 'Alexander Jr',
                'lastname' => 'Cello',
                'facebook_name' => 'Alex Cello',
                'registration_type' => 'Member',
                'category' => 'Adult',
                'local_church' => 'Binan',
                'country' => 'Philippines',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'awta_card_number' => 'LPMU00199',
                'email' => 'melanie.ngitngit@yahoo.com',
                'firstname' => 'Melanie',
                'lastname' => 'Ngitngit',
                'facebook_name' => 'Melanie Ngitngit',
                'registration_type' => 'Member',
                'category' => 'Adult',
                'local_church' => 'Muntinlupa',
                'country' => 'Philippines',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'awta_card_number' => 'LPBI00039',
                'email' => 'keysarmiento94@gmail.com',
                'firstname' => 'Key Ann',
                'lastname' => 'Garcia',
                'facebook_name' => 'Key Sarmiento Garcia',
                'registration_type' => 'Member',
                'category' => 'Adult',
                'local_church' => 'Binan',
                'country' => 'Philippines',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'awta_card_number' => 'LPBI00004',
                'email' => 'dhazle07@gmail.com',
                'firstname' => 'de Vera',
                'lastname' => 'Dhazle',
                'facebook_name' => 'Dhazle de Vera ',
                'registration_type' => 'Member',
                'category' => 'Adult',
                'local_church' => 'Binan',
                'country' => 'Philippines',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'awta_card_number' => 'LPMU00272',
                'email' => 'jakeimperial28@gmail.com',
                'firstname' => 'Jake Patrick',
                'lastname' => 'Imperial',
                'facebook_name' => 'Jake Patrick Imperial',
                'registration_type' => 'Member',
                'category' => 'Adult',
                'local_church' => 'Muntinlupa',
                'country' => 'Philippines',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'awta_card_number' => 'LPPA00044',
                'email' => 'majerriper@gmail.com',
                'firstname' => 'Ma Jerriper',
                'lastname' => 'Oviedo',
                'facebook_name' => 'MrsJep Oviedo ',
                'registration_type' => 'Member',
                'category' => 'Adult',
                'local_church' => 'Pateros',
                'country' => 'Philippines',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'awta_card_number' => 'LPCA00095',
                'email' => 'malou.elomina@gmail.com',
                'firstname' => 'Maria Lourdes',
                'lastname' => 'Elomina',
                'facebook_name' => 'Malou Paulo Elomina',
                'registration_type' => 'Member',
                'category' => 'Adult',
                'local_church' => 'Canlubang',
                'country' => 'Philippines',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'awta_card_number' => 'LPMU00064',
                'email' => 'gaudencio.lingamen111@gmail.com',
                'firstname' => 'Gaudencio III',
                'lastname' => 'Lingamen',
                'facebook_name' => 'Gaudencio Lingamen III',
                'registration_type' => 'Member',
                'category' => 'Adult',
                'local_church' => 'Muntinlupa',
                'country' => 'Philippines',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'awta_card_number' => 'LPPA00001',
                'email' => 'amor_val@yahoo.com',
                'firstname' => 'Amor',
                'lastname' => 'Abad',
                'facebook_name' => 'Amor V Abad',
                'registration_type' => 'Member',
                'category' => 'Adult',
                'local_church' => 'Pateros',
                'country' => 'Philippines',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'awta_card_number' => 'LPMU00041',
                'email' => 'juliepearldiaz@gmail.com',
                'firstname' => 'Julie Pearl',
                'lastname' => 'Diaz',
                'facebook_name' => 'Julie Pearl Diaz',
                'registration_type' => 'Member',
                'category' => 'Adult',
                'local_church' => 'Muntinlupa',
                'country' => 'Philippines',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'awta_card_number' => 'LPMU00016',
                'email' => 'aizellelaureano06@gmail.com',
                'firstname' => 'Aizelle Rose',
                'lastname' => 'Bernardo',
                'facebook_name' => 'Aizelle Rose Laureano-Bernardo',
                'registration_type' => 'Member',
                'category' => 'Adult',
                'local_church' => 'Muntinlupa',
                'country' => 'Philippines',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'awta_card_number' => 'LPMU00022',
                'email' => 'christineannecabantog@gmail.com',
                'firstname' => 'Christine Anne',
                'lastname' => 'Cabantog',
                'facebook_name' => 'Christine Anne',
                'registration_type' => 'Member',
                'category' => 'Adult',
                'local_church' => 'Muntinlupa',
                'country' => 'Philippines',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'awta_card_number' => 'LPMU00195',
                'email' => 'mejia.gabrieljames@gmail.com',
                'firstname' => 'Gabriel James',
                'lastname' => 'Mejia',
                'facebook_name' => 'James Mejia',
                'registration_type' => 'Member',
                'category' => 'Adult',
                'local_church' => 'Muntinlupa',
                'country' => 'Philippines',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'awta_card_number' => 'LPMU00158',
                'email' => 'malayaomaegan05@gmail.com',
                'firstname' => 'Maegan',
                'lastname' => 'Malayao',
                'facebook_name' => 'Maegan Malayao',
                'registration_type' => 'Member',
                'category' => 'Adult',
                'local_church' => 'Muntinlupa',
                'country' => 'Philippines',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'awta_card_number' => 'LPIS00015',
                'email' => 'glorieann.uy@gmail.com',
                'firstname' => 'Glorie Ann',
                'lastname' => 'Uy',
                'facebook_name' => 'Glorie Ann Uy',
                'registration_type' => 'Member',
                'category' => 'Adult',
                'local_church' => 'Isabela',
                'country' => 'Philippines',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'awta_card_number' => 'LPMU00030',
                'email' => 'kazma223130@gmail.com',
                'firstname' => 'Linda',
                'lastname' => 'Valentin',
                'facebook_name' => 'Linda Valentin',
                'registration_type' => 'Member',
                'category' => 'Adult',
                'local_church' => 'Muntinlupa',
                'country' => 'Philippines',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'awta_card_number' => 'LPBI00084',
                'email' => 'rosedbayan@gmail.com',
                'firstname' => 'Rosa',
                'lastname' => 'Dalawangbayan',
                'facebook_name' => 'Rose Dalawangbayan',
                'registration_type' => 'Member',
                'category' => 'Adult',
                'local_church' => 'Binan',
                'country' => 'Philippines',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'awta_card_number' => 'LPBI00027',
                'email' => 'kimberlynavora@gmail.com',
                'firstname' => 'Kimberly',
                'lastname' => 'Remoticado',
                'facebook_name' => 'Kim Navora-Remoticado',
                'registration_type' => 'Member',
                'category' => 'Adult',
                'local_church' => 'Binan',
                'country' => 'Philippines',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'awta_card_number' => 'LPBI00017',
                'email' => 'johnmichaelrobles42@gmail.com',
                'firstname' => 'John Michael',
                'lastname' => 'Robles',
                'facebook_name' => 'John Michael Robles',
                'registration_type' => 'Member',
                'category' => 'Adult',
                'local_church' => 'Binan',
                'country' => 'Philippines',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'awta_card_number' => 'LPBI00018',
                'email' => 'jaymeedilla@gmail.com',
                'firstname' => 'Jaymee Rose',
                'lastname' => 'Birot',
                'facebook_name' => 'Jaymee Dilla-Birot',
                'registration_type' => 'Member',
                'category' => 'Adult',
                'local_church' => 'Binan',
                'country' => 'Philippines',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'awta_card_number' => 'LPGR00002',
                'email' => 'uzzhellamirez@ymail.com',
                'firstname' => 'Uzzhel',
                'lastname' => 'Entierro',
                'facebook_name' => 'Uzzhel Lamirez-Entierro ',
                'registration_type' => 'Member',
                'category' => 'Adult',
                'local_church' => 'Granada',
                'country' => 'Philippines',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'awta_card_number' => 'LPBI00130',
                'email' => 'abram.frianeza@gmail.com',
                'firstname' => 'Abram Kristian',
                'lastname' => 'Frianeza',
                'facebook_name' => 'Abram Frianeza',
                'registration_type' => 'Member',
                'category' => 'Adult',
                'local_church' => 'Binan',
                'country' => 'Philippines',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'awta_card_number' => 'LPMU00032',
                'email' => 'kimsheenac@gmail.com',
                'firstname' => 'Kim Sheena',
                'lastname' => 'Imperial',
                'facebook_name' => 'Kim Cuasay-Imperial',
                'registration_type' => 'Member',
                'category' => 'Adult',
                'local_church' => 'Muntinlupa',
                'country' => 'Philippines',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'awta_card_number' => 'LPMU00111',
                'email' => 'bryanst.rose@gmail.com',
                'firstname' => 'Bryan',
                'lastname' => 'Sta. Rosa',
                'facebook_name' => 'Bryan Starosa',
                'registration_type' => 'Member',
                'category' => 'Adult',
                'local_church' => 'Muntinlupa',
                'country' => 'Philippines',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'awta_card_number' => 'LPMU00092',
                'email' => 'roxanneadevarufo@gmail.com',
                'firstname' => 'Roxanne',
                'lastname' => 'Rufo',
                'facebook_name' => 'Roxanne Adeva Rufo',
                'registration_type' => 'Member',
                'category' => 'Adult',
                'local_church' => 'Muntinlupa',
                'country' => 'Philippines',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'awta_card_number' => 'LPMU00097',
                'email' => 'ikit.santillan@gmail.com',
                'firstname' => 'Cecilia',
                'lastname' => 'Santillan',
                'facebook_name' => 'Cecilia Labrador-Santillan',
                'registration_type' => 'Member',
                'category' => 'Adult',
                'local_church' => 'Muntinlupa',
                'country' => 'Philippines',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'awta_card_number' => 'LPMU00244',
                'email' => 'karen.agapay.tan@gmail.com',
                'firstname' => 'Karen',
                'lastname' => 'Tan',
                'facebook_name' => 'Keng Tan',
                'registration_type' => 'Member',
                'category' => 'Adult',
                'local_church' => 'Muntinlupa',
                'country' => 'Philippines',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'awta_card_number' => 'LPMU00230',
                'email' => 'kristinetud26@gmail.com',
                'firstname' => 'Karl Lorenz',
                'lastname' => 'Tud',
                'facebook_name' => 'Karl Lorenz',
                'registration_type' => 'Member',
                'category' => 'Adult',
                'local_church' => 'Muntinlupa',
                'country' => 'Philippines',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'awta_card_number' => 'LPMU00031',
                'email' => 'cuasayklaudine@gmail.com',
                'firstname' => 'Klaudine Allyanna',
                'lastname' => 'Laureano',
                'facebook_name' => 'Klaudine Cuasay-Laureano',
                'registration_type' => 'Member',
                'category' => 'Adult',
                'local_church' => 'Muntinlupa',
                'country' => 'Philippines',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'awta_card_number' => 'LPMU00093',
                'email' => 'michael.salumbides@gmail.com',
                'firstname' => 'Michael',
                'lastname' => 'Salumbides',
                'facebook_name' => 'Mike Salumbides',
                'registration_type' => 'Member',
                'category' => 'Adult',
                'local_church' => 'Muntinlupa',
                'country' => 'Philippines',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'awta_card_number' => 'LPMU00038',
                'email' => 'nildevera2693@gmail.com',
                'firstname' => 'Janelo',
                'lastname' => 'de Vera',
                'facebook_name' => 'Nil de Vera',
                'registration_type' => 'Member',
                'category' => 'Adult',
                'local_church' => 'Muntinlupa',
                'country' => 'Philippines',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]
        ]);
    }
}
