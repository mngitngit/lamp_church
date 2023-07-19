<?php

namespace Database\Seeders;

use App\Enums\RegistrationType;
use App\Models\Registration;
use Illuminate\Database\Seeder;

class registerGuests extends Seeder
{
    public function run()
    {
        $register = array(
            [
                'firstname' => 'Joshua',
                'lastname' => 'Tadem',
                'registration_type' => 'Guest',
                'local_church' => 'Binan',
                'category' => 'Adult'
            ],
            [
                'firstname' => 'Abraham',
                'lastname' => 'Apilado',
                'registration_type' => 'Guest',
                'local_church' => 'Binan',
                'category' => 'Adult'
            ],
            [
                'firstname' => 'Mary',
                'lastname' => 'Apilado',
                'registration_type' => 'Guest',
                'local_church' => 'Binan',
                'category' => 'Adult'
            ],
            [
                'firstname' => 'Jonathan',
                'lastname' => 'Parayno',
                'registration_type' => 'Guest',
                'local_church' => 'Binan',
                'category' => 'Adult'
            ],
            [
                'firstname' => 'Lester',
                'lastname' => 'Perez',
                'registration_type' => 'Guest',
                'local_church' => 'Binan',
                'category' => 'Adult'
            ],
            [
                'firstname' => 'Hexard Kyle',
                'lastname' => 'Calimlim',
                'registration_type' => 'Guest',
                'local_church' => 'Binan',
                'category' => 'Adult'
            ],
            [
                'firstname' => 'Mary Ant',
                'lastname' => 'Noga',
                'registration_type' => 'Guest',
                'local_church' => 'Binan',
                'category' => 'Adult'
            ],
            [
                'firstname' => 'Eugene',
                'lastname' => 'Panaligan',
                'registration_type' => 'Guest',
                'local_church' => 'Binan',
                'category' => 'Adult'
            ],
            [
                'firstname' => 'Grace ',
                'lastname' => 'Cañete',
                'registration_type' => 'Guest',
                'local_church' => 'Binan',
                'category' => 'Adult'
            ],
            [
                'firstname' => 'Rico ',
                'lastname' => 'Cañete',
                'registration_type' => 'Guest',
                'local_church' => 'Binan',
                'category' => 'Adult'
            ],
            [
                'firstname' => 'Alliah ',
                'lastname' => 'Bonifacio',
                'registration_type' => 'Guest',
                'local_church' => 'Binan',
                'category' => 'Adult'
            ],
            [
                'firstname' => 'Shawn',
                'lastname' => 'Panaligan',
                'registration_type' => 'Guest',
                'local_church' => 'Binan',
                'category' => 'Adult'
            ],
            [
                'firstname' => 'Jermaine',
                'lastname' => 'Camacho',
                'registration_type' => 'Guest',
                'local_church' => 'Binan',
                'category' => 'Adult'
            ],
            [
                'firstname' => 'Frincess',
                'lastname' => 'De jesus',
                'registration_type' => 'Guest',
                'local_church' => 'Binan',
                'category' => 'Adult'
            ],
            [
                'firstname' => 'Allan',
                'lastname' => 'Cagalingan',
                'registration_type' => 'Guest',
                'local_church' => 'Binan',
                'category' => 'Adult'
            ],
            [
                'firstname' => 'Raizhan Jhoy',
                'lastname' => 'Bato',
                'registration_type' => 'Guest',
                'local_church' => 'Binan',
                'category' => 'Adult'
            ],
            [
                'firstname' => 'Reign Marien',
                'lastname' => 'Bato',
                'registration_type' => 'Guest',
                'local_church' => 'Binan',
                'category' => 'Adult'
            ],
            [
                'firstname' => 'Gemma',
                'lastname' => 'Sarmiento',
                'registration_type' => 'Guest',
                'local_church' => 'Binan',
                'category' => 'Adult'
            ],
            [
                'firstname' => 'Jun',
                'lastname' => 'Sarmiento',
                'registration_type' => 'Guest',
                'local_church' => 'Binan',
                'category' => 'Adult'
            ],
            [
                'firstname' => 'Antonio ',
                'lastname' => 'Mamauag',
                'registration_type' => 'Guest',
                'local_church' => 'Muntinlupa',
                'category' => 'Adult'
            ],
            [
                'firstname' => 'Jay',
                'lastname' => 'Mamauag',
                'registration_type' => 'Guest',
                'local_church' => 'Muntinlupa',
                'category' => 'Adult'
            ],
            [
                'firstname' => 'Julie anne',
                'lastname' => 'De los Santos',
                'registration_type' => 'Guest',
                'local_church' => 'Muntinlupa',
                'category' => 'Adult'
            ],
            [
                'firstname' => 'Stephen',
                'lastname' => 'De los Santos',
                'registration_type' => 'Guest',
                'local_church' => 'Muntinlupa',
                'category' => 'Adult'
            ],
            [
                'firstname' => 'Sean Julienne',
                'lastname' => 'De los Santos',
                'registration_type' => 'Guest',
                'local_church' => 'Muntinlupa',
                'category' => 'Adult'
            ],
            [
                'firstname' => 'Sophia Juliana',
                'lastname' => 'De los Santos',
                'registration_type' => 'Guest',
                'local_church' => 'Muntinlupa',
                'category' => 'Adult'
            ],
            [
                'firstname' => 'Marlon',
                'lastname' => 'Vivar',
                'registration_type' => 'Guest',
                'local_church' => 'Muntinlupa',
                'category' => 'Adult'
            ],
            [
                'firstname' => 'Lovely Joy ',
                'lastname' => 'Pilapil',
                'registration_type' => 'Guest',
                'local_church' => 'Muntinlupa',
                'category' => 'Adult'
            ],
            [
                'firstname' => 'Ivafer',
                'lastname' => 'Sison',
                'registration_type' => 'Guest',
                'local_church' => 'Muntinlupa',
                'category' => 'Adult'
            ],
            [
                'firstname' => 'Michelle',
                'lastname' => 'Gan',
                'registration_type' => 'Guest',
                'local_church' => 'Muntinlupa',
                'category' => 'Adult'
            ],
            [
                'firstname' => 'Julliah Marie',
                'lastname' => 'Escaro',
                'registration_type' => 'Guest',
                'local_church' => 'Muntinlupa',
                'category' => 'Adult'
            ],
            [
                'firstname' => 'Jayne Meagan',
                'lastname' => 'Escaro',
                'registration_type' => 'Guest',
                'local_church' => 'Muntinlupa',
                'category' => 'Adult'
            ],
            [
                'firstname' => 'Berlita',
                'lastname' => 'Palabrica',
                'registration_type' => 'Guest',
                'local_church' => 'Muntinlupa',
                'category' => 'Adult'
            ],
            [
                'firstname' => 'Eunice',
                'lastname' => 'Cenina',
                'registration_type' => 'Guest',
                'local_church' => 'Muntinlupa',
                'category' => 'Adult'
            ],
            [
                'firstname' => 'Irish',
                'lastname' => 'Cenina',
                'registration_type' => 'Guest',
                'local_church' => 'Muntinlupa',
                'category' => 'Adult'
            ],
            [
                'firstname' => 'Lexus',
                'lastname' => 'Cenina',
                'registration_type' => 'Guest',
                'local_church' => 'Muntinlupa',
                'category' => 'Adult'
            ],
            [
                'firstname' => 'Cyrus',
                'lastname' => 'Cenina',
                'registration_type' => 'Guest',
                'local_church' => 'Muntinlupa',
                'category' => 'Adult'
            ],
            [
                'firstname' => 'Mitch',
                'lastname' => 'Mendova',
                'registration_type' => 'Guest',
                'local_church' => 'Muntinlupa',
                'category' => 'Adult'
            ],
            [
                'firstname' => 'Johnny ',
                'lastname' => 'Laureano',
                'registration_type' => 'Guest',
                'local_church' => 'Muntinlupa',
                'category' => 'Adult'
            ],
            [
                'firstname' => 'Manolito',
                'lastname' => 'Asis',
                'registration_type' => 'Guest',
                'local_church' => 'Muntinlupa',
                'category' => 'Adult'
            ],
            [
                'firstname' => 'Cristina',
                'lastname' => 'Ayap',
                'registration_type' => 'Guest',
                'local_church' => 'Muntinlupa',
                'category' => 'Adult'
            ],
            [
                'firstname' => 'Wilma',
                'lastname' => 'Evangelista',
                'registration_type' => 'Guest',
                'local_church' => 'Muntinlupa',
                'category' => 'Adult'
            ],
            [
                'firstname' => 'Choleta',
                'lastname' => 'Evangelista',
                'registration_type' => 'Guest',
                'local_church' => 'Muntinlupa',
                'category' => 'Adult'
            ],
            [
                'firstname' => 'Francisco',
                'lastname' => 'Erwin',
                'registration_type' => 'Guest',
                'local_church' => 'Muntinlupa',
                'category' => 'Adult'
            ],
            [
                'firstname' => 'Francisco',
                'lastname' => 'Marion',
                'registration_type' => 'Guest',
                'local_church' => 'Muntinlupa',
                'category' => 'Adult'
            ],
            [
                'firstname' => 'Jasmin',
                'lastname' => 'Placido',
                'registration_type' => 'Guest',
                'local_church' => 'Pateros',
                'category' => 'Adult'
            ],
            [
                'firstname' => 'Disalyn',
                'lastname' => 'Bongat',
                'registration_type' => 'Guest',
                'local_church' => 'Pateros',
                'category' => 'Adult'
            ],
            [
                'firstname' => 'Gino',
                'lastname' => 'Eugenio',
                'registration_type' => 'Guest',
                'local_church' => 'Pateros',
                'category' => 'Adult'
            ],
            [
                'firstname' => 'Blue',
                'lastname' => 'Millan',
                'registration_type' => 'Guest',
                'local_church' => 'Pateros',
                'category' => 'Adult'
            ],
            [
                'firstname' => 'Ryu',
                'lastname' => 'Dy',
                'registration_type' => 'Guest',
                'local_church' => 'Pateros',
                'category' => 'Adult'
            ],
            [
                'firstname' => 'Jem',
                'lastname' => 'Lipumano',
                'registration_type' => 'Guest',
                'local_church' => 'Pateros',
                'category' => 'Adult'
            ],
            [
                'firstname' => 'Luiz',
                'lastname' => 'Acedillo',
                'registration_type' => 'Guest',
                'local_church' => 'Pateros',
                'category' => 'Adult'
            ],
            [
                'firstname' => 'Kyler',
                'lastname' => 'Chua',
                'registration_type' => 'Guest',
                'local_church' => 'Pateros',
                'category' => 'Adult'
            ],
            [
                'firstname' => 'Jana Mariele',
                'lastname' => 'Reyes',
                'registration_type' => 'Guest',
                'local_church' => 'Pateros',
                'category' => 'Adult'
            ],
            [
                'firstname' => 'Jessana Michelle',
                'lastname' => 'Reyes',
                'registration_type' => 'Guest',
                'local_church' => 'Pateros',
                'category' => 'Adult'
            ],
            [
                'firstname' => 'Marian',
                'lastname' => 'Gregorio',
                'registration_type' => 'Guest',
                'local_church' => 'Pateros',
                'category' => 'Adult'
            ],
            [
                'firstname' => 'Shanalyn',
                'lastname' => 'Cristobal',
                'registration_type' => 'Guest',
                'local_church' => 'Pateros',
                'category' => 'Adult'
            ],
            [
                'firstname' => 'Maylin',
                'lastname' => 'Ditablan',
                'registration_type' => 'Guest',
                'local_church' => 'Pateros',
                'category' => 'Adult'
            ],
            [
                'firstname' => 'Gerald',
                'lastname' => 'Baluis',
                'registration_type' => 'Guest',
                'local_church' => 'Pateros',
                'category' => 'Adult'
            ],
            [
                'firstname' => 'Roger',
                'lastname' => 'Abad',
                'registration_type' => 'Guest',
                'local_church' => 'Pateros',
                'category' => 'Adult'
            ],
            [
                'firstname' => 'Jane',
                'lastname' => 'Maravilla',
                'registration_type' => 'Guest',
                'local_church' => 'Pateros',
                'category' => 'Adult'
            ],
            [
                'firstname' => 'Jack Adriel',
                'lastname' => 'Remoticado',
                'registration_type' => 'Guest',
                'local_church' => 'Binan',
                'category' => 'Kids'
            ],
            [
                'firstname' => 'Yui Nozomi',
                'lastname' => 'Montanez',
                'registration_type' => 'Guest',
                'local_church' => 'Binan',
                'category' => 'Kids'
            ],
            [
                'firstname' => 'Matty',
                'lastname' => 'Flores',
                'registration_type' => 'Guest',
                'local_church' => 'Muntinlupa',
                'category' => 'Kids'
            ],
            [
                'firstname' => 'Matthew Laurence',
                'lastname' => 'Ditablan',
                'registration_type' => 'Guest',
                'local_church' => 'Pateros',
                'category' => 'Kids'
            ],
            [
                'firstname' => 'Yumi ',
                'lastname' => 'Alayon',
                'registration_type' => 'Guest',
                'local_church' => 'Binan',
                'category' => 'Kids'
            ],
            [
                'firstname' => 'Kian Roy',
                'lastname' => 'Santillan',
                'registration_type' => 'Guest',
                'local_church' => 'Muntinlupa',
                'category' => 'Kids'
            ],
            [
                'firstname' => 'Sid',
                'lastname' => 'Sison',
                'registration_type' => 'Guest',
                'local_church' => 'Muntinlupa',
                'category' => 'Kids'
            ],
            [
                'firstname' => 'Ivian',
                'lastname' => 'Sison',
                'registration_type' => 'Guest',
                'local_church' => 'Muntinlupa',
                'category' => 'Kids'
            ],
            [
                'firstname' => 'PD ',
                'lastname' => 'Sison',
                'registration_type' => 'Guest',
                'local_church' => 'Muntinlupa',
                'category' => 'Kids'
            ],
            [
                'firstname' => 'Rhizzalyn',
                'lastname' => 'Lumabas',
                'registration_type' => 'Guest',
                'local_church' => 'Muntinlupa',
                'category' => 'Kids'
            ],
            [
                'firstname' => 'Amadeo Gabriel',
                'lastname' => 'Lumabas',
                'registration_type' => 'Guest',
                'local_church' => 'Muntinlupa',
                'category' => 'Kids'
            ],
            [
                'firstname' => 'Elaine',
                'lastname' => 'Palabrica',
                'registration_type' => 'Guest',
                'local_church' => 'Muntinlupa',
                'category' => 'Kids'
            ],
            [
                'firstname' => 'Zyra Mae',
                'lastname' => 'Diaz',
                'registration_type' => 'Guest',
                'local_church' => 'Muntinlupa',
                'category' => 'Kids'
            ],
            [
                'firstname' => 'John Dave',
                'lastname' => 'Arestores',
                'registration_type' => 'Guest',
                'local_church' => 'Muntinlupa',
                'category' => 'Kids'
            ],
            [
                'firstname' => 'Reah Jen',
                'lastname' => 'Eludo',
                'registration_type' => 'Guest',
                'local_church' => 'Muntinlupa',
                'category' => 'Kids'
            ],
            [
                'firstname' => 'Freya',
                'lastname' => 'Aguirre',
                'registration_type' => 'Guest',
                'local_church' => 'Muntinlupa',
                'category' => 'Kids'
            ],
            [
                'firstname' => 'Skylar',
                'lastname' => 'Asis',
                'registration_type' => 'Guest',
                'local_church' => 'Muntinlupa',
                'category' => 'Kids'
            ],
            [
                'firstname' => 'Margaux Lauren',
                'lastname' => 'Ditablan',
                'registration_type' => 'Guest',
                'local_church' => 'Pateros',
                'category' => 'Kids'
            ],
            [
                'firstname' => 'Rayah',
                'lastname' => 'Tanay',
                'registration_type' => 'Guest',
                'local_church' => 'Pateros',
                'category' => 'Kids'
            ],
            [
                'firstname' => 'Jacob',
                'lastname' => 'Trinidad',
                'registration_type' => 'Guest',
                'local_church' => 'Isabela',
                'category' => 'Kids'
            ],
            [
                'firstname' => 'Joan',
                'lastname' => 'Agustin',
                'registration_type' => 'Guest',
                'local_church' => 'Isabela',
                'category' => 'Kids'
            ],
            [
                'firstname' => 'Mateo',
                'lastname' => 'Trinidad',
                'registration_type' => 'Guest',
                'local_church' => 'Isabela',
                'category' => 'Kids'
            ],
            [
                'firstname' => 'Ricard Vincent',
                'lastname' => 'Uy',
                'registration_type' => 'Guest',
                'local_church' => 'Isabela',
                'category' => 'Kids'
            ],
            [
                'firstname' => 'Mark Angelo',
                'lastname' => 'Valdez',
                'registration_type' => 'Guest',
                'local_church' => 'Isabela',
                'category' => 'Kids'
            ],
            [
                'firstname' => 'Reden',
                'lastname' => 'Gabuyo',
                'registration_type' => 'Guest',
                'local_church' => 'Isabela',
                'category' => 'Kids'
            ],
            [
                'firstname' => 'Mc Bien',
                'lastname' => 'Agustin',
                'registration_type' => 'Guest',
                'local_church' => 'Isabela',
                'category' => 'Kids'
            ],
            [
                'firstname' => 'Miggy',
                'lastname' => 'Molina',
                'registration_type' => 'Guest',
                'local_church' => 'Isabela',
                'category' => 'Kids'
            ],
            [
                'firstname' => 'Mar Jayson',
                'lastname' => 'Manzano',
                'registration_type' => 'Guest',
                'local_church' => 'Isabela',
                'category' => 'Kids'
            ],
        );

        foreach ($register as $data) {
            $this->command->info('-------- registering guest ----------');

            $uuid = $this->generateGuestId();

            $this->command->info('Guest #: ' . $uuid);
            $this->command->info('Full Name: ' . ($data['firstname']) . ' ' . ($data['lastname']));
            $this->command->info('Local Church: ' . $data['local_church']);

            Registration::create([
                'uuid' => $uuid,
                'email' => '',
                'firstname' => $data['firstname'],
                'lastname' => $data['lastname'],
                'fullname' => ($data['firstname']) . ' ' . ($data['lastname']),
                'facebook_name' => '',
                'registration_type' => $data['registration_type'],
                'local_church' => $data['local_church'],
                'country' => 'Philippines',
                'category' => $data['category'],
                'attending_option' => 'Hybrid',
                'with_awta_card' => 'none',
            ]);

            $this->command->info('--------------- done ----------------');
        }
    }

    function generateGuestId()
    {
        $lastGuestId = Registration::select('uuid')->where('registration_type', RegistrationType::Guest)->orderBy('id', 'desc')->first();

        if ($lastGuestId) {
            $number = last(explode("GUEST", $lastGuestId['uuid'])); //explode the string to get the number part, last is a laravel helper
        } else {
            $number = 0;
        }
        $new = str_pad(intval($number) + 1, 4, 0, STR_PAD_LEFT); //increment the number by 1 and pad with 0 in left.

        $prefix = "GUEST";

        return $prefix . $new;
    }
}
