<?php

namespace Database\Seeders;

use App\Enums\AttendingOption;
use App\Enums\RegistrationType;
use App\Models\Registration;
use Illuminate\Database\Seeder;

class RegisterGuests2 extends Seeder
{
    public function run()
    {
        $register = array(
            ['uuid' => 'to register', 'firstname' => 'Lydia', 'lastname' => 'Laugico', 'registration_type' => 'Guest', 'local_church' => 'Muntinlupa', 'category' => 'Adult'],
            ['uuid' => 'to register', 'firstname' => 'Malou', 'lastname' => 'Samarita', 'registration_type' => 'Guest', 'local_church' => 'Muntinlupa', 'category' => 'Adult'],
            ['uuid' => 'to register', 'firstname' => 'Puring', 'lastname' => 'Samarita', 'registration_type' => 'Guest', 'local_church' => 'Muntinlupa', 'category' => 'Adult'],
            ['uuid' => 'to register', 'firstname' => 'Devina Gracia', 'lastname' => 'Mercado', 'registration_type' => 'Guest', 'local_church' => 'Canlubang', 'category' => 'Adult'],
            ['uuid' => 'to register', 'firstname' => 'Margarett', 'lastname' => 'Olivarez', 'registration_type' => 'Guest', 'local_church' => 'Canlubang', 'category' => 'Adult'],
            ['uuid' => 'to register', 'firstname' => 'Annah Alvinez', 'lastname' => 'Sarvida', 'registration_type' => 'Guest', 'local_church' => 'Canlubang', 'category' => 'Adult'],
            ['uuid' => 'to register', 'firstname' => 'Hanze Zyradj', 'lastname' => 'Olivarez', 'registration_type' => 'Guest', 'local_church' => 'Canlubang', 'category' => 'Adult'],
            ['uuid' => 'to register', 'firstname' => 'Michael ', 'lastname' => 'Abuel', 'registration_type' => 'Guest', 'local_church' => 'Canlubang', 'category' => 'Adult'],
            ['uuid' => 'to register', 'firstname' => 'Jessabel', 'lastname' => 'Hermoso', 'registration_type' => 'Guest', 'local_church' => 'Canlubang', 'category' => 'Adult'],
            ['uuid' => 'to register', 'firstname' => 'Kristine Joy ', 'lastname' => 'Navales', 'registration_type' => 'Guest', 'local_church' => 'Canlubang', 'category' => 'Adult'],
            ['uuid' => 'to register', 'firstname' => 'Rosarn Angelica', 'lastname' => 'Flores', 'registration_type' => 'Guest', 'local_church' => 'Canlubang', 'category' => 'Adult'],
            ['uuid' => 'to register', 'firstname' => 'John Errol', 'lastname' => 'Pamatmat', 'registration_type' => 'Guest', 'local_church' => 'Canlubang', 'category' => 'Adult'],
            ['uuid' => 'to register', 'firstname' => 'Emjay', 'lastname' => 'Higa', 'registration_type' => 'Guest', 'local_church' => 'Canlubang', 'category' => 'Adult'],
            ['uuid' => 'to register', 'firstname' => 'John Rayne ', 'lastname' => 'Dela Rosa', 'registration_type' => 'Guest', 'local_church' => 'Canlubang', 'category' => 'Adult'],
            ['uuid' => 'to register', 'firstname' => 'John Wayne', 'lastname' => 'Dela Rosa', 'registration_type' => 'Guest', 'local_church' => 'Canlubang', 'category' => 'Adult'],
            ['uuid' => 'to register', 'firstname' => 'Alma', 'lastname' => 'Tate', 'registration_type' => 'Guest', 'local_church' => 'Canlubang', 'category' => 'Adult'],
            ['uuid' => 'to register', 'firstname' => 'Bench Kharzon ', 'lastname' => 'Tatel', 'registration_type' => 'Guest', 'local_church' => 'Canlubang', 'category' => 'Adult'],
            ['uuid' => 'to register', 'firstname' => 'Richard ', 'lastname' => 'Mendoza', 'registration_type' => 'Guest', 'local_church' => 'Canlubang', 'category' => 'Adult'],
            ['uuid' => 'to register', 'firstname' => 'Jessy ', 'lastname' => 'Segui', 'registration_type' => 'Guest', 'local_church' => 'Canlubang', 'category' => 'Adult'],
            ['uuid' => 'to register', 'firstname' => 'Rhoda', 'lastname' => 'Nequinto', 'registration_type' => 'Guest', 'local_church' => 'Canlubang', 'category' => 'Adult'],
            ['uuid' => 'to register', 'firstname' => 'Daniel Sison', 'lastname' => 'Lance', 'registration_type' => 'Guest', 'local_church' => 'Canlubang', 'category' => 'Adult'],
            ['uuid' => 'to register', 'firstname' => 'Lance Nathan', 'lastname' => 'Nequinto', 'registration_type' => 'Guest', 'local_church' => 'Canlubang', 'category' => 'Adult'],
            ['uuid' => 'to register', 'firstname' => 'Matthew', 'lastname' => 'Amador', 'registration_type' => 'Guest', 'local_church' => 'Canlubang', 'category' => 'Adult'],
            ['uuid' => 'to register', 'firstname' => 'Juancho', 'lastname' => 'Gutierrez', 'registration_type' => 'Guest', 'local_church' => 'Canlubang', 'category' => 'Adult'],
            ['uuid' => 'to register', 'firstname' => 'Jommer', 'lastname' => 'Mancion', 'registration_type' => 'Guest', 'local_church' => 'Canlubang', 'category' => 'Adult'],
            ['uuid' => 'to register', 'firstname' => 'Merlita', 'lastname' => 'Areglado', 'registration_type' => 'Guest', 'local_church' => 'Canlubang', 'category' => 'Adult'],
            ['uuid' => 'to register', 'firstname' => 'Elaissa ', 'lastname' => 'Passion', 'registration_type' => 'Guest', 'local_church' => 'Tarlac', 'category' => 'Adult'],
        );

        foreach ($register as $data) {
            $this->command->info('-------- registering guest ----------');

            $uuid = $data['uuid'] == 'to register' ? $this->generateGuestId() : $data['uuid'];

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
                'attending_option' => AttendingOption::Hybrid,
                'with_awta_card' => 'none',
                'can_book' => true
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
