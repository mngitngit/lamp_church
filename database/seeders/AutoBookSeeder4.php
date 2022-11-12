<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Registration;
use Illuminate\Database\Seeder;

class AutoBookSeeder4 extends Seeder
{
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $bookMe = array(
            ['uuid'=>'GUEST0507', 'name'=>'Joshua Tadem', 'local_church'=>'Binan', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'N', 'day_4'=>'N'],
            ['uuid'=>'GUEST0508', 'name'=>'Abraham Apilado', 'local_church'=>'Binan', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'N', 'day_4'=>'N'],
            ['uuid'=>'GUEST0509', 'name'=>'Mary Apilado', 'local_church'=>'Binan', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'N', 'day_4'=>'N'],
            ['uuid'=>'GUEST0510', 'name'=>'Jonathan Parayno', 'local_church'=>'Binan', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'N'],
            ['uuid'=>'GUEST0511', 'name'=>'Lester Perez', 'local_church'=>'Binan', 'day_1'=>'N', 'day_2'=>'Y', 'day_3'=>'N', 'day_4'=>'N'],
            ['uuid'=>'GUEST0512', 'name'=>'Hexard Kyle Calimlim', 'local_church'=>'Binan', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'N'],
            ['uuid'=>'GUEST0513', 'name'=>'Mary Ant Noga', 'local_church'=>'Binan', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'N'],
            ['uuid'=>'GUEST0514', 'name'=>'Eugene Panaligan', 'local_church'=>'Binan', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'N', 'day_4'=>'N'],
            ['uuid'=>'GUEST0515', 'name'=>'Grace  Cañete', 'local_church'=>'Binan', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'N', 'day_4'=>'N'],
            ['uuid'=>'GUEST0516', 'name'=>'Rico  Cañete', 'local_church'=>'Binan', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'N', 'day_4'=>'N'],
            ['uuid'=>'GUEST0517', 'name'=>'Alliah  Bonifacio', 'local_church'=>'Binan', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'N', 'day_4'=>'N'],
            ['uuid'=>'GUEST0518', 'name'=>'Shawn Panaligan', 'local_church'=>'Binan', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'N', 'day_4'=>'N'],
            ['uuid'=>'GUEST0519', 'name'=>'Jermaine Camacho', 'local_church'=>'Binan', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'N', 'day_4'=>'N'],
            ['uuid'=>'GUEST0520', 'name'=>'Frincess De jesus', 'local_church'=>'Binan', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'N', 'day_4'=>'N'],
            ['uuid'=>'GUEST0521', 'name'=>'Allan Cagalingan', 'local_church'=>'Binan', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'N', 'day_4'=>'N'],
            ['uuid'=>'GUEST0522', 'name'=>'Raizhan Jhoy  Bato', 'local_church'=>'Binan', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'N', 'day_4'=>'N'],
            ['uuid'=>'GUEST0523', 'name'=>'Reign Marien Bato', 'local_church'=>'Binan', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'N', 'day_4'=>'N'],
            ['uuid'=>'GUEST0524', 'name'=>'Gemma Sarmiento', 'local_church'=>'Binan', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'N', 'day_4'=>'N'],
            ['uuid'=>'GUEST0525', 'name'=>'Jun Sarmiento', 'local_church'=>'Binan', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'N', 'day_4'=>'N'],
            ['uuid'=>'GUEST0526', 'name'=>'Antonio  Mamauag', 'local_church'=>'Muntinlupa', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'N', 'day_4'=>'N'],
            ['uuid'=>'GUEST0527', 'name'=>'Jay Mamauag', 'local_church'=>'Muntinlupa', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'N', 'day_4'=>'N'],
            ['uuid'=>'GUEST0528', 'name'=>'Julie anne De los Santos', 'local_church'=>'Muntinlupa', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'N', 'day_4'=>'N'],
            ['uuid'=>'GUEST0529', 'name'=>'Stephen De los Santos', 'local_church'=>'Muntinlupa', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'N', 'day_4'=>'N'],
            ['uuid'=>'GUEST0530', 'name'=>'Sean Julienne De los Santos', 'local_church'=>'Muntinlupa', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'N', 'day_4'=>'N'],
            ['uuid'=>'GUEST0531', 'name'=>'Sophia Juliana De los Santos', 'local_church'=>'Muntinlupa', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'N', 'day_4'=>'N'],
            ['uuid'=>'GUEST0532', 'name'=>'Marlon Vivar', 'local_church'=>'Muntinlupa', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'N', 'day_4'=>'N'],
            ['uuid'=>'GUEST0533', 'name'=>'Lovely Joy  Pilapil', 'local_church'=>'Muntinlupa', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'N', 'day_4'=>'N'],
            ['uuid'=>'GUEST0534', 'name'=>'Ivafer Sison', 'local_church'=>'Muntinlupa', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'N', 'day_4'=>'N'],
            ['uuid'=>'GUEST0535', 'name'=>'Michelle Gan', 'local_church'=>'Muntinlupa', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'GUEST0536', 'name'=>'Julliah Marie Escaro', 'local_church'=>'Muntinlupa', 'day_1'=>'Y', 'day_2'=>'Y', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'GUEST0537', 'name'=>'Jayne Meagan Escaro', 'local_church'=>'Muntinlupa', 'day_1'=>'Y', 'day_2'=>'Y', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'GUEST0538', 'name'=>'Berlita Palabrica', 'local_church'=>'Muntinlupa', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'GUEST0539', 'name'=>'Eunice Cenina', 'local_church'=>'Muntinlupa', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'GUEST0540', 'name'=>'Irish Cenina', 'local_church'=>'Muntinlupa', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'GUEST0541', 'name'=>'Lexus Cenina', 'local_church'=>'Muntinlupa', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'GUEST0542', 'name'=>'Cyrus Cenina', 'local_church'=>'Muntinlupa', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'GUEST0543', 'name'=>'Mitch Mendova', 'local_church'=>'Muntinlupa', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'GUEST0544', 'name'=>'Johnny  Laureano', 'local_church'=>'Muntinlupa', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'N', 'day_4'=>'N'],
            ['uuid'=>'GUEST0545', 'name'=>'Manolito Asis', 'local_church'=>'Muntinlupa', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'N', 'day_4'=>'N'],
            ['uuid'=>'GUEST0546', 'name'=>'Cristina Ayap', 'local_church'=>'Muntinlupa', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'N', 'day_4'=>'N'],
            ['uuid'=>'GUEST0547', 'name'=>'Wilma Evangelista', 'local_church'=>'Muntinlupa', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'N', 'day_4'=>'N'],
            ['uuid'=>'GUEST0548', 'name'=>'Choleta Evangelista', 'local_church'=>'Muntinlupa', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'N', 'day_4'=>'N'],
            ['uuid'=>'GUEST0549', 'name'=>'Francisco Erwin', 'local_church'=>'Muntinlupa', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'N', 'day_4'=>'N'],
            ['uuid'=>'GUEST0550', 'name'=>'Francisco Marion', 'local_church'=>'Muntinlupa', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'N', 'day_4'=>'N'],
            ['uuid'=>'GUEST0551', 'name'=>'Jasmin Placido', 'local_church'=>'Pateros', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'N', 'day_4'=>'N'],
            ['uuid'=>'GUEST0552', 'name'=>'Disalyn Bongat', 'local_church'=>'Pateros', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'N', 'day_4'=>'N'],
            ['uuid'=>'GUEST0553', 'name'=>'Gino Eugenio', 'local_church'=>'Pateros', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'N', 'day_4'=>'N'],
            ['uuid'=>'GUEST0554', 'name'=>'Blue Millan', 'local_church'=>'Pateros', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'N', 'day_4'=>'N'],
            ['uuid'=>'GUEST0555', 'name'=>'Ryu Dy', 'local_church'=>'Pateros', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'N', 'day_4'=>'N'],
            ['uuid'=>'GUEST0556', 'name'=>'Jem Lipumano', 'local_church'=>'Pateros', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'N', 'day_4'=>'N'],
            ['uuid'=>'GUEST0557', 'name'=>'Luiz Acedillo', 'local_church'=>'Pateros', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'N', 'day_4'=>'N'],
            ['uuid'=>'GUEST0558', 'name'=>'Kyler Chua', 'local_church'=>'Pateros', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'N', 'day_4'=>'N'],
            ['uuid'=>'GUEST0559', 'name'=>'Jana Mariele Reyes', 'local_church'=>'Pateros', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'N', 'day_4'=>'N'],
            ['uuid'=>'GUEST0560', 'name'=>'Jessana Michelle Reyes', 'local_church'=>'Pateros', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'N', 'day_4'=>'N'],
            ['uuid'=>'GUEST0561', 'name'=>'Marian Gregorio', 'local_church'=>'Pateros', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'N', 'day_4'=>'N'],
            ['uuid'=>'GUEST0562', 'name'=>'Shanalyn Cristobal', 'local_church'=>'Pateros', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'N', 'day_4'=>'N'],
            ['uuid'=>'GUEST0563', 'name'=>'Maylin Ditablan', 'local_church'=>'Pateros', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'N', 'day_4'=>'N'],
            ['uuid'=>'GUEST0564', 'name'=>'Gerald Baluis', 'local_church'=>'Pateros', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'N', 'day_4'=>'N'],
            ['uuid'=>'GUEST0565', 'name'=>'Roger Abad', 'local_church'=>'Pateros', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'N', 'day_4'=>'N'],
            ['uuid'=>'GUEST0566', 'name'=>'Jane Maravilla', 'local_church'=>'Pateros', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'N', 'day_4'=>'N'],
            ['uuid'=>'GUEST0567', 'name'=>'Jack Adriel Remoticado', 'local_church'=>'Binan', 'day_1'=>'Y', 'day_2'=>'N', 'day_3'=>'N', 'day_4'=>'Y'],
            ['uuid'=>'GUEST0568', 'name'=>'Yui Nozomi Montanez', 'local_church'=>'Binan', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'N'],
            ['uuid'=>'GUEST0569', 'name'=>'Matty Flores', 'local_church'=>'Muntinlupa', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'GUEST0570', 'name'=>'Matthew Laurence Ditablan', 'local_church'=>'Pateros', 'day_1'=>'Y', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'N'],
            ['uuid'=>'GUEST0571', 'name'=>'Yumi  Alayon', 'local_church'=>'Binan', 'day_1'=>'N', 'day_2'=>'Y', 'day_3'=>'N', 'day_4'=>'N'],
            ['uuid'=>'GUEST0572', 'name'=>'Kian Roy Santillan', 'local_church'=>'Muntinlupa', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'GUEST0573', 'name'=>'Sid Sison', 'local_church'=>'Muntinlupa', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'GUEST0574', 'name'=>'Ivian Sison', 'local_church'=>'Muntinlupa', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'GUEST0575', 'name'=>'PD  Sison', 'local_church'=>'Muntinlupa', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'GUEST0576', 'name'=>'Rhizzalyn Lumabas', 'local_church'=>'Muntinlupa', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'GUEST0577', 'name'=>'Amadeo Gabriel Lumabas', 'local_church'=>'Muntinlupa', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'GUEST0578', 'name'=>'Elaine Palabrica', 'local_church'=>'Muntinlupa', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'GUEST0579', 'name'=>'Zyra Mae Diaz', 'local_church'=>'Muntinlupa', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'GUEST0580', 'name'=>'John Dave Arestores', 'local_church'=>'Muntinlupa', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'GUEST0581', 'name'=>'Reah Jen Eludo', 'local_church'=>'Muntinlupa', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'GUEST0582', 'name'=>'Freya Aguirre', 'local_church'=>'Muntinlupa', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'N', 'day_4'=>'N'],
            ['uuid'=>'GUEST0583', 'name'=>'Skylar Asis', 'local_church'=>'Muntinlupa', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'GUEST0584', 'name'=>'Margaux Lauren Ditablan', 'local_church'=>'Pateros', 'day_1'=>'Y', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'N'],
            ['uuid'=>'GUEST0585', 'name'=>'Rayah Tanay', 'local_church'=>'Pateros', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'N', 'day_4'=>'N'],
            ['uuid'=>'GUEST0586', 'name'=>'Jacob Trinidad', 'local_church'=>'Isabela', 'day_1'=>'N', 'day_2'=>'Y', 'day_3'=>'Y', 'day_4'=>'N'],
            ['uuid'=>'GUEST0587', 'name'=>'Joan Agustin', 'local_church'=>'Isabela', 'day_1'=>'N', 'day_2'=>'Y', 'day_3'=>'Y', 'day_4'=>'N'],
            ['uuid'=>'GUEST0588', 'name'=>'Mateo Trinidad', 'local_church'=>'Isabela', 'day_1'=>'N', 'day_2'=>'Y', 'day_3'=>'Y', 'day_4'=>'N'],
            ['uuid'=>'GUEST0589', 'name'=>'Ricard Vincent Uy', 'local_church'=>'Isabela', 'day_1'=>'N', 'day_2'=>'Y', 'day_3'=>'Y', 'day_4'=>'N'],
            ['uuid'=>'GUEST0590', 'name'=>'Mark Angelo Valdez', 'local_church'=>'Isabela', 'day_1'=>'N', 'day_2'=>'Y', 'day_3'=>'Y', 'day_4'=>'N'],
            ['uuid'=>'GUEST0591', 'name'=>'Reden Gabuyo', 'local_church'=>'Isabela', 'day_1'=>'N', 'day_2'=>'Y', 'day_3'=>'Y', 'day_4'=>'N'],
            ['uuid'=>'GUEST0592', 'name'=>'Mc Bien Agustin', 'local_church'=>'Isabela', 'day_1'=>'N', 'day_2'=>'Y', 'day_3'=>'Y', 'day_4'=>'N'],
            ['uuid'=>'GUEST0593', 'name'=>'Miggy Molina', 'local_church'=>'Isabela', 'day_1'=>'N', 'day_2'=>'Y', 'day_3'=>'Y', 'day_4'=>'N'],
            ['uuid'=>'GUEST0594', 'name'=>'Mar Jayson Manzano', 'local_church'=>'Isabela', 'day_1'=>'N', 'day_2'=>'Y', 'day_3'=>'Y', 'day_4'=>'N'],
        );

        foreach ($bookMe as $data) {
            $this->command->info('---------------- booking guest (newly registered) ---------------');
            
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
            $this->command->info('------------------------------ done -----------------------------');
        }
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
