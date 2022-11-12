<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Registration;
use Illuminate\Database\Seeder;

class AutoBookSeeder3 extends Seeder
{
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $bookMe = array(
            ['uuid'=>'GUEST0001', 'name'=>'Lilac Madison Emague', 'local_church'=>'Muntinlupa', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'GUEST0002', 'name'=>'Rod Cornelio Tiamsing', 'local_church'=>'Canlubang', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'N', 'day_4'=>'N'],
            ['uuid'=>'GUEST0009', 'name'=>'Jon Adriel Canonigo', 'local_church'=>'Binan', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'N'],
            ['uuid'=>'GUEST0017', 'name'=>'Alonzo Bernardo', 'local_church'=>'Muntinlupa', 'day_1'=>'Y', 'day_2'=>'Y', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'GUEST0024', 'name'=>'Chrisha Mae Estigoy', 'local_church'=>'Tarlac', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'GUEST0036', 'name'=>'Mikeilla Asis', 'local_church'=>'Muntinlupa', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'GUEST0037', 'name'=>'Zildjan Flores', 'local_church'=>'Muntinlupa', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'GUEST0047', 'name'=>'Kaleb Roy Santillan', 'local_church'=>'Muntinlupa', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'GUEST0049', 'name'=>'Arianne Erich Passion', 'local_church'=>'Tarlac', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'GUEST0056', 'name'=>'Yentro Brei Padayao', 'local_church'=>'Canlubang', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'N', 'day_4'=>'N'],
            ['uuid'=>'GUEST0063', 'name'=>'Zed Isaiah Garcia', 'local_church'=>'Canlubang', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'N', 'day_4'=>'N'],
            ['uuid'=>'GUEST0064', 'name'=>'Hayley Zackiyah Garcia', 'local_church'=>'Canlubang', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'N', 'day_4'=>'N'],
            ['uuid'=>'GUEST0075', 'name'=>'Audison  Oxeniola', 'local_church'=>'Muntinlupa', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'GUEST0076', 'name'=>'Jhon Ralph  Camarador', 'local_church'=>'Muntinlupa', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'N', 'day_4'=>'Y'],
            ['uuid'=>'GUEST0077', 'name'=>'Nico Adrean Camarador', 'local_church'=>'Muntinlupa', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'N', 'day_4'=>'Y'],
            ['uuid'=>'GUEST0111', 'name'=>'Ghad Lorenz  Madali', 'local_church'=>'Muntinlupa', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'GUEST0119', 'name'=>'Arman  Fernandez', 'local_church'=>'Dasmarinas', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'GUEST0130', 'name'=>'Yhuann May Hondanero', 'local_church'=>'Canlubang', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'N', 'day_4'=>'N'],
            ['uuid'=>'GUEST0142', 'name'=>'Miyoko Kendal  Flores', 'local_church'=>'Binan', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'GUEST0154', 'name'=>'Daniel Andril Franco', 'local_church'=>'Tarlac', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'GUEST0157', 'name'=>'Keisha Mei Guillermo ', 'local_church'=>'Tarlac', 'day_1'=>'N', 'day_2'=>'Y', 'day_3'=>'Y', 'day_4'=>'N'],
            ['uuid'=>'GUEST0158', 'name'=>'Keizell Guillermo ', 'local_church'=>'Tarlac', 'day_1'=>'N', 'day_2'=>'Y', 'day_3'=>'Y', 'day_4'=>'N'],
            ['uuid'=>'GUEST0182', 'name'=>'Darlene Doncansil', 'local_church'=>'Canlubang', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'N', 'day_4'=>'N'],
            ['uuid'=>'GUEST0183', 'name'=>'Greyson Rimando', 'local_church'=>'Muntinlupa', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'GUEST0189', 'name'=>'Cristina Amaris Bien', 'local_church'=>'Canlubang', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'N', 'day_4'=>'N'],
            ['uuid'=>'GUEST0190', 'name'=>'Cassiopeia Amara Bien', 'local_church'=>'Canlubang', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'N', 'day_4'=>'N'],
            ['uuid'=>'GUEST0194', 'name'=>'Jedidiah Tocio', 'local_church'=>'Canlubang', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'N', 'day_4'=>'N'],
            ['uuid'=>'GUEST0213', 'name'=>'CAYENE ARCIAGA', 'local_church'=>'Canlubang', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'N', 'day_4'=>'N'],
            ['uuid'=>'GUEST0215', 'name'=>'ARIANE ARCIAGA', 'local_church'=>'Canlubang', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'N', 'day_4'=>'N'],
            ['uuid'=>'GUEST0219', 'name'=>'Martina Victoria San Miguel', 'local_church'=>'Pateros', 'day_1'=>'Y', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'N'],
            ['uuid'=>'GUEST0259', 'name'=>'Ayr Shyra Balasanos', 'local_church'=>'Canlubang', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'N', 'day_4'=>'N'],
            ['uuid'=>'GUEST0261', 'name'=>'Myel Borromeo', 'local_church'=>'Dasmarinas', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'GUEST0262', 'name'=>'Just-Ann Ellis', 'local_church'=>'Dasmarinas', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'GUEST0263', 'name'=>'Kristine Ellis', 'local_church'=>'Dasmarinas', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'GUEST0320', 'name'=>'Cherlyn Jade Coma', 'local_church'=>'Canlubang', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'N', 'day_4'=>'N'],
            ['uuid'=>'GUEST0330', 'name'=>'keisha vijar', 'local_church'=>'Canlubang', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'N', 'day_4'=>'N'],
            ['uuid'=>'GUEST0339', 'name'=>'Lukas Gideon Bulatao', 'local_church'=>'Canlubang', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'N', 'day_4'=>'N'],
            ['uuid'=>'GUEST0354', 'name'=>'Izhie Nicole Pantaleon', 'local_church'=>'Canlubang', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'N', 'day_4'=>'N'],
            ['uuid'=>'GUEST0395', 'name'=>'Giusseppe Mari Boligor', 'local_church'=>'Canlubang', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'N', 'day_4'=>'N'],
            ['uuid'=>'GUEST0399', 'name'=>'Jose Miguel Ganapin', 'local_church'=>'Canlubang', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'N', 'day_4'=>'N'],
            ['uuid'=>'GUEST0411', 'name'=>'Ethan Amolar', 'local_church'=>'Canlubang', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'N', 'day_4'=>'N'],
            ['uuid'=>'GUEST0414', 'name'=>'Eurhis Artonio Valdellon', 'local_church'=>'Pateros', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'N', 'day_4'=>'N'],
            ['uuid'=>'GUEST0415', 'name'=>'Ziah Zienette Valdellon', 'local_church'=>'Pateros', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'N', 'day_4'=>'N'],
            ['uuid'=>'GUEST0423', 'name'=>'Carla Denise Alvarez', 'local_church'=>'Canlubang', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'N', 'day_4'=>'N'],
            ['uuid'=>'GUEST0424', 'name'=>'Carl Joshua Alvarez', 'local_church'=>'Canlubang', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'N', 'day_4'=>'N'],
        );

        foreach ($bookMe as $data) {
            $this->command->info('---------------- booking guest (kids) ---------------');
            
            Booking::where('registration_uuid', $data['uuid'])->delete();

            $registration = Registration::where('uuid', $data['uuid'])->where('attending_option', 'Online')->first();

            if ($registration) {
                $registration->update(['attending_option' => 'Hybrid', 'can_book' => true]);
            }

            $this->command->info('Guest #: ' . $data['uuid'] . ' Full Name: ' . $data['name']);

            $dateToBeBooked = [];
            $booked_log = 'Booked Day(s): ';
            for ($x = 1; $x <= 4; $x++) {
                if ($data['day_' . $x] === 'Y') {
                    $booked_log .= 'Day ' . $x . ' ';
                    array_push($dateToBeBooked, [
                        'registration_uuid' => $data['uuid'],
                        'slot_id' => $x + 4,
                        'local_church' => $data['local_church']
                    ]);
                }
            }

            Booking::insert($dateToBeBooked);

            $this->command->info('Booked Day(s): ' . $booked_log);
            $this->command->info('-------------------------- done ----------------------');
        }
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
