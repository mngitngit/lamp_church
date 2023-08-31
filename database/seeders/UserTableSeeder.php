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
            ['name' => 'Uzzhel Entierro', 'email' => 'uentierro@lampawta.com', 'password' => Hash::make('admin126')],
            ['name' => 'Rose Dalawangbayan', 'email' => 'dalawangbayan@lampawta.com', 'password' => Hash::make('123456')],
            ['name' => 'Jaymee Birot', 'email' => 'jbirot@lampawta.com', 'password' => Hash::make('123456')],
            ['name' => 'Kim Remoticado', 'email' => 'kremoticado@lampawta.com', 'password' => Hash::make('123456')],
            ['name' => 'Maria Lourdes Elomina', 'email' => 'melomina@lampawta.com', 'password' => Hash::make('123456')],
            ['name' => 'Sharmane Pensol', 'email' => 'spensol@lampawta.com', 'password' => Hash::make('123456')],
            ['name' => 'Maila Gomez', 'email' => 'mgomez@lampawta.com', 'password' => Hash::make('123456')],
            ['name' => 'Glorie Ann Uy', 'email' => 'guy@lampawta.com', 'password' => Hash::make('123456')],
            ['name' => 'Joana Catchan', 'email' => 'jcatchan@lampawta.com', 'password' => Hash::make('123456')],
            ['name' => 'Aizelle Bernardo', 'email' => 'abernardo@lampawta.com', 'password' => Hash::make('123456')],
            ['name' => 'Maegan Malayao', 'email' => 'mmalayao@lampawta.com', 'password' => Hash::make('123456')],
            ['name' => 'Gabriel James Meija', 'email' => 'gmejia@lampawta.com', 'password' => Hash::make('123456')],
            ['name' => 'Christine Cabantog', 'email' => 'ccabantog@lampawta.com', 'password' => Hash::make('123456')],
            ['name' => 'Victorie Cabero', 'email' => 'vcabero@lampawta.com', 'password' => Hash::make('123456')],
            ['name' => 'April Joy Balane', 'email' => 'abalane@lampawta.com', 'password' => Hash::make('123456')],
            ['name' => 'Kazandra Valentin', 'email' => 'kvalentin@lampawta.com', 'password' => Hash::make('123456')],
            ['name' => 'Ma.  Jerriper Oviedo', 'email' => 'joviedo@lampawta.com', 'password' => Hash::make('123456')],
            ['name' => 'Mark Dale Martizano', 'email' => 'mmartizano@lampawta.com', 'password' => Hash::make('123456')],
            ['name' => 'Yhin Meneses', 'email' => 'ymeneses@lampawta.com', 'password' => Hash::make('123456')],
            ['name' => 'Jivvi De Vera', 'email' => 'jdevera@lampawta.com', 'password' => Hash::make('123456')],
            ['name' => 'Monica Allera', 'email' => 'mallera@lampawta.com', 'password' => Hash::make('123456')],
            ['name' => 'Marj Frianeza', 'email' => 'mfrianeza@lampawta.com', 'password' => Hash::make('123456')],
            ['name' => 'Evangeline Rose Montecillo', 'email' => 'emontecillo@lampawta.com', 'password' => Hash::make('123456')],
            ['name' => 'Alma Tiamsing', 'email' => 'atiamsing@lampawta.com', 'password' => Hash::make('123456')],
            ['name' => 'Karen Alvarez', 'email' => 'kalvarez@lampawta.com', 'password' => Hash::make('123456')],
            ['name' => 'Louie Elomina', 'email' => 'lelomina@lampawta.com', 'password' => Hash::make('123456')],
            ['name' => 'Sheena Gomez', 'email' => 'sgomez@lampawta.com', 'password' => Hash::make('123456')],
            ['name' => 'Irish Princess Uy', 'email' => 'iuy@lampawta.com', 'password' => Hash::make('123456')],
            ['name' => 'Jayka Mirasol', 'email' => 'jmirasol@lampawta.com', 'password' => Hash::make('123456')],
            ['name' => 'Marcela Barnachea', 'email' => 'mbarnachea@lampawta.com', 'password' => Hash::make('123456')],
            ['name' => 'Mark Gabriel Belmonte', 'email' => 'mbelmonte@lampawta.com', 'password' => Hash::make('123456')],
            ['name' => 'Karissa Melchor', 'email' => 'kmelchor@lampawta.com', 'password' => Hash::make('123456')],
            ['name' => 'Nanchee Bibal', 'email' => 'nbibal@lampawta.com', 'password' => Hash::make('123456')],
            ['name' => 'Viah Sarceda', 'email' => 'vsarceda@lampawta.com', 'password' => Hash::make('123456')],
            ['name' => 'Allyzza Ombiga Bibal', 'email' => 'abibal@lampawta.com', 'password' => Hash::make('123456')],
            ['name' => 'Charisse Sisles', 'email' => 'csisles@lampawta.com', 'password' => Hash::make('123456')],
            ['name' => 'Regine Lamirez Salico', 'email' => 'rsalico@lampawta.com', 'password' => Hash::make('123456')],
            ['name' => 'Stephanie Lamirez', 'email' => 'slamirez@lampawta.com', 'password' => Hash::make('123456')],
            ['name' => 'Melanie Ngitngit', 'email' => 'mela@lampawta.com', 'password' => Hash::make('admin123')],
            ['name' => 'Ann Jose', 'email' => 'ajose@lampawta.com', 'password' => Hash::make('admin123')],
            ['name' => 'Jake Patrick Imperial', 'email' => 'jimperial@lampawta.com', 'password' => Hash::make('admin123')],
            ['name' => 'John Michael Robles', 'email' => 'jrobles@lampawta.com', 'password' => Hash::make('admin123')],
            ['name' => 'Bryan Sta Rosa', 'email' => 'bstarosa@lampawta.com', 'password' => Hash::make('admin123')],
            ['name' => 'Klaud-Cuasay Laureano', 'email' => 'klaureano@lampawta.com', 'password' => Hash::make('admin123')],
            ['name' => 'Key Sarmiento Garcia', 'email' => 'keygarcia@lampawta.com', 'password' => Hash::make('admin123')],
        ]);
    }
}
