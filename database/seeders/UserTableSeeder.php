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
            ['name' => 'Alex Cello', 'email' => 'acello@lampawta.online', 'password' => Hash::make('admin123')],
            ['name' => 'Linda Valetin', 'email' => 'lvalentin@lampawta.online', 'password' => Hash::make('admin124')],
            ['name' => 'Dhazle de Vera', 'email' => 'ddevera@lampawta.online', 'password' => Hash::make('admin125')],
            ['name' => 'Uzzhel Entierro', 'email' => 'uentierro@lampawta.online', 'password' => Hash::make('admin126')],
            ['name' => 'Rose Dalawangbayan', 'email' => 'dalawangbayan@lampawta.online', 'password' => Hash::make('123456')],
            ['name' => 'Jaymee Birot', 'email' => 'jbirot@lampawta.online', 'password' => Hash::make('123456')],
            ['name' => 'Kim Remoticado', 'email' => 'kremoticado@lampawta.online', 'password' => Hash::make('123456')],
            ['name' => 'Maria Lourdes Elomina', 'email' => 'melomina@lampawta.online', 'password' => Hash::make('123456')],
            ['name' => 'Sharmane Pensol', 'email' => 'spensol@lampawta.online', 'password' => Hash::make('123456')],
            ['name' => 'Maila Gomez', 'email' => 'mgomez@lampawta.online', 'password' => Hash::make('123456')],
            ['name' => 'Glorie Ann Uy', 'email' => 'guy@lampawta.online', 'password' => Hash::make('123456')],
            ['name' => 'Joana Catchan', 'email' => 'jcatchan@lampawta.online', 'password' => Hash::make('123456')],
            ['name' => 'Aizelle Bernardo', 'email' => 'abernardo@lampawta.online', 'password' => Hash::make('123456')],
            ['name' => 'Maegan Malayao', 'email' => 'mmalayao@lampawta.online', 'password' => Hash::make('123456')],
            ['name' => 'Gabriel James Meija', 'email' => 'gmejia@lampawta.online', 'password' => Hash::make('123456')],
            ['name' => 'Christine Cabantog', 'email' => 'ccabantog@lampawta.online', 'password' => Hash::make('123456')],
            ['name' => 'Victorie Cabero', 'email' => 'vcabero@lampawta.online', 'password' => Hash::make('123456')],
            ['name' => 'April Joy Balane', 'email' => 'abalane@lampawta.online', 'password' => Hash::make('123456')],
            ['name' => 'Kazandra Valentin', 'email' => 'kvalentin@lampawta.online', 'password' => Hash::make('123456')],
            ['name' => 'Ma.  Jerriper Oviedo', 'email' => 'joviedo@lampawta.online', 'password' => Hash::make('123456')],
            ['name' => 'Mark Dale Martizano', 'email' => 'mmartizano@lampawta.online', 'password' => Hash::make('123456')],
            ['name' => 'Yhin Meneses', 'email' => 'ymeneses@lampawta.online', 'password' => Hash::make('123456')],
            ['name' => 'Jivvi De Vera', 'email' => 'jdevera@lampawta.online', 'password' => Hash::make('123456')],
            ['name' => 'Monica Allera', 'email' => 'mallera@lampawta.online', 'password' => Hash::make('123456')],
            ['name' => 'Melanie Ngitngit', 'email' => 'mela@lampawta.online', 'password' => Hash::make('admin123')],
            ['name' => 'Ann Jose', 'email' => 'ajose@lampawta.online', 'password' => Hash::make('admin123')],
            ['name' => 'Jake Patrick Imperial', 'email' => 'jimperial@lampawta.online', 'password' => Hash::make('admin123')],
            ['name' => 'John Michael Robles', 'email' => 'jrobles@lampawta.online', 'password' => Hash::make('admin123')],
            ['name' => 'Bryan Sta Rosa', 'email' => 'bstarosa@lampawta.online', 'password' => Hash::make('admin123')],
            ['name' => 'Klaud-Cuasay Laureano', 'email' => 'klaureano@lampawta.online', 'password' => Hash::make('admin123')],
            ['name' => 'Key Sarmiento Garcia', 'email' => 'keygarcia@lampawta.online', 'password' => Hash::make('admin123')],
        ]);
    }
}
