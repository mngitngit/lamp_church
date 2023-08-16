<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();

        $administrators = [
            'Alex Cello',
            'Linda Valetin',
            'Dhazle de Vera',
            'Uzzhel Entierro',
            'Melanie Ngitngit',
            'Ann Jose',
            'Jake Patrick Imperial',
            'Abram Frianeza',
            'John Michael Robles',
            'Klaud-Cuasay Laureano',
            'Bryan Sta Rosa'
        ];

        foreach ($users as $user) {
            $isAdmin = in_array($user->name, $administrators);

            $user->permissions()->create([
                'can_edit_delegate' => $isAdmin,
                'can_delete_delegate' => $isAdmin,
                'can_delete_payment' => $isAdmin,
                'can_edit_delegate_config' => $isAdmin,
                'can_export_registrations' => true,
                'can_view_registrations' => true
            ]);
        }
    }
}
