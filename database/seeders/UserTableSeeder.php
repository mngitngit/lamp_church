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
            ['name' => 'Alex Cello', 'email' => 'acello@lampawta.com', 'password' => Hash::make('admin123')],
            ['name' => 'Linda Valetin', 'email' => 'lvalentin@lampawta.com', 'password' => Hash::make('admin124')],
            ['name' => 'Dhazle de Vera', 'email' => 'ddevera@lampawta.com', 'password' => Hash::make('admin125')],
            ['name' => 'Melanie Ngitngit', 'email' => 'mela@lampawta.com', 'password' => Hash::make('admin123')],
            ['name' => 'Ann Jose', 'email' => 'ajose@lampawta.com', 'password' => Hash::make('admin123')],
            ['name' => 'Jake Patrick Imperial', 'email' => 'jimperial@lampawta.com', 'password' => Hash::make('admin123')],
            ['name' => 'John Michael Robles', 'email' => 'jrobles@lampawta.com', 'password' => Hash::make('admin123')],
            ['name' => 'Bryan Sta Rosa', 'email' => 'bstarosa@lampawta.com', 'password' => Hash::make('admin123')],
            ['name' => 'Key Sarmiento Garcia', 'email' => 'keygarcia@lampawta.com', 'password' => Hash::make('admin123')],

            ['name' => 'Marj Frianeza', 'email' => 'mfrianeza@lampawta.com', 'password' => Hash::make('awta2024')],
            ['name' => 'Rose Dalawangbayan', 'email' => 'dalawangbayan@lampawta.com', 'password' => Hash::make('awta2024')],
            ['name' => 'Monica Castillo', 'email' => 'mcastillo@lampawta.com', 'password' => Hash::make('awta2024')],
            ['name' => 'Ma. Jerriper Oviedo', 'email' => 'joviedo@lampawta.com', 'password' => Hash::make('awta2024')],
            ['name' => 'Aizelle Bernardo', 'email' => 'abernardo@lampawta.com', 'password' => Hash::make('awta2024')],
            ['name' => 'Mark Dale Martizano', 'email' => 'mmartizano@lampawta.com', 'password' => Hash::make('awta2024')],
            ['name' => 'Joana Catchan', 'email' => 'jcatchan@lampawta.com', 'password' => Hash::make('awta2024')],
            ['name' => 'Malou Benitez', 'email' => 'mbenitez@lampawta.com', 'password' => Hash::make('awta2024')],
            ['name' => 'Sharmane Pensol', 'email' => 'spensol@lampawta.com', 'password' => Hash::make('awta2024')],
            ['name' => 'Maila Gomez', 'email' => 'mgomez@lampawta.com', 'password' => Hash::make('awta2024')],
            ['name' => 'Christine Francisco', 'email' => 'cfranciscog@lampawta.com', 'password' => Hash::make('awta2024')],
            ['name' => 'Gabriel James Meija', 'email' => 'gmejia@lampawta.com', 'password' => Hash::make('awta2024')],
            ['name' => 'Malou Elomina', 'email' => 'melomina@lampawta.com', 'password' => Hash::make('awta2024')],
            ['name' => 'Karen Alvarez', 'email' => 'kalvarez@lampawta.com', 'password' => Hash::make('awta2024')],
            ['name' => 'Alma Tiamsing', 'email' => 'atiamsing@lampawta.com', 'password' => Hash::make('awta2024')],
            ['name' => 'Jaymee Birot', 'email' => 'jbirot@lampawta.com', 'password' => Hash::make('awta2024')],
            ['name' => 'Edel Ain Ebro', 'email' => 'eaebro@lampawta.com', 'password' => Hash::make('awta2024')],
            ['name' => 'Evangeline Rose Montecillo', 'email' => 'emontecillo@lampawta.com', 'password' => Hash::make('awta2024')],
            ['name' => 'Nanchee Bibal', 'email' => 'nbibal@lampawta.com', 'password' => Hash::make('awta2024')],
            ['name' => 'Stephanie Lamirez', 'email' => 'slamirez@lampawta.com', 'password' => Hash::make('awta2024')],
        ]);
    }
}
