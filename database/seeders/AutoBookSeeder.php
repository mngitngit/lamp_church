<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Registration;
use Illuminate\Database\Seeder;

class AutoBookSeeder extends Seeder
{
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $bookMe = array(
            ['uuid'=>'LPDA00007', 'name'=>'Maila Gomez', 'local_church'=>'Dasmarinas', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPDA00008', 'name'=>'Sheena mae Neri', 'local_church'=>'Dasmarinas', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPDA00012', 'name'=>'Elmer Navarro', 'local_church'=>'Dasmarinas', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPDA00013', 'name'=>'Edith Navarro', 'local_church'=>'Dasmarinas', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPDA00014', 'name'=>'Samantha Navarro', 'local_church'=>'Dasmarinas', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPDA00015', 'name'=>'Shuck Navarro', 'local_church'=>'Dasmarinas', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPDA00016', 'name'=>'Shanon Navarro', 'local_church'=>'Dasmarinas', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPDA00017', 'name'=>'Danilo Montemayor', 'local_church'=>'Dasmarinas', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPDA00019', 'name'=>'Disah Montemayor', 'local_church'=>'Dasmarinas', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPDA00020', 'name'=>'Danine Monte mayor', 'local_church'=>'Dasmarinas', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPDA00021', 'name'=>'Daryl Valles', 'local_church'=>'Dasmarinas', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPDA00023', 'name'=>'Tricia mae Largo', 'local_church'=>'Dasmarinas', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPDA00024', 'name'=>'Rolly Fresco', 'local_church'=>'Dasmarinas', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPDA00027', 'name'=>'Dianne Baltazar', 'local_church'=>'Dasmarinas', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPDA00028', 'name'=>'Myka Baltazar', 'local_church'=>'Dasmarinas', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPDA00031', 'name'=>'Franz Ashley Lianza', 'local_church'=>'Dasmarinas', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPDA00033', 'name'=>'Ellah Jerish Velasco', 'local_church'=>'Dasmarinas', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPDA00034', 'name'=>'Jamica Rocero', 'local_church'=>'Dasmarinas', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPDA00035', 'name'=>'Neria Angeles', 'local_church'=>'Dasmarinas', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPDA00036', 'name'=>'Almira Lianza', 'local_church'=>'Dasmarinas', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPDA00037', 'name'=>'Nathan Lianza', 'local_church'=>'Dasmarinas', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPDA00038', 'name'=>'Abasia Gabrielle Lianza', 'local_church'=>'Dasmarinas', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPDA00039', 'name'=>'Anjeanette Fernandez', 'local_church'=>'Dasmarinas', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPDA00041', 'name'=>'Amy Fernandez', 'local_church'=>'Dasmarinas', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPDA00042', 'name'=>'Brendan Valles', 'local_church'=>'Dasmarinas', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPDA00043', 'name'=>'Rutchel Borromeo', 'local_church'=>'Dasmarinas', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPDA00044', 'name'=>'Desire Valles', 'local_church'=>'Dasmarinas', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPDA00045', 'name'=>'Barbario Valles', 'local_church'=>'Dasmarinas', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPDA00046', 'name'=>'Arthur Fernandez', 'local_church'=>'Dasmarinas', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPDA00051', 'name'=>'Shekinah jem Velasco', 'local_church'=>'Dasmarinas', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPDA00052', 'name'=>'Jerielle Velasco', 'local_church'=>'Dasmarinas', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPDA00053', 'name'=>'Princess Neri', 'local_church'=>'Dasmarinas', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPDA00055', 'name'=>'Rommel Melgazo', 'local_church'=>'Dasmarinas', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPDA00056', 'name'=>'Florifes Melgazo', 'local_church'=>'Dasmarinas', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPDA00063', 'name'=>'Angel Fernandez', 'local_church'=>'Dasmarinas', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPDA00070', 'name'=>'Sharina Pensol', 'local_church'=>'Dasmarinas', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPDA00071', 'name'=>'Sonia Pensol', 'local_church'=>'Dasmarinas', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPDA00073', 'name'=>'Terence Claire Largo', 'local_church'=>'Dasmarinas', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPDA00110', 'name'=>'Kurt Ahron Joaquin', 'local_church'=>'Dasmarinas', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPDA00111', 'name'=>'Johnrex esponilla', 'local_church'=>'Dasmarinas', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPDA00112', 'name'=>'Johnrey M.esponilla', 'local_church'=>'Dasmarinas', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPDA00114', 'name'=>'Reyse esponilla', 'local_church'=>'Dasmarinas', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPDA00138', 'name'=>'Mary ann Ellis', 'local_church'=>'Dasmarinas', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPDA00145', 'name'=>'Dareem Jost Tolentino', 'local_church'=>'Dasmarinas', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPDA00146', 'name'=>'Juanito esponilla', 'local_church'=>'Dasmarinas', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPIS00001', 'name'=>'Fatima Trinidad', 'local_church'=>'Isabela', 'day_1'=>'N', 'day_2'=>'Y', 'day_3'=>'Y', 'day_4'=>'N'],
            ['uuid'=>'LPIS00002', 'name'=>'Charry May Trinidad', 'local_church'=>'Isabela', 'day_1'=>'N', 'day_2'=>'Y', 'day_3'=>'Y', 'day_4'=>'N'],
            ['uuid'=>'LPIS00003', 'name'=>'Kings Lee Aeron Yu', 'local_church'=>'Isabela', 'day_1'=>'N', 'day_2'=>'Y', 'day_3'=>'Y', 'day_4'=>'N'],
            ['uuid'=>'LPIS00004', 'name'=>'Oswaldo Larugal', 'local_church'=>'Isabela', 'day_1'=>'N', 'day_2'=>'Y', 'day_3'=>'Y', 'day_4'=>'N'],
            ['uuid'=>'LPIS00005', 'name'=>'Nenita Larugal', 'local_church'=>'Isabela', 'day_1'=>'N', 'day_2'=>'Y', 'day_3'=>'Y', 'day_4'=>'N'],
            ['uuid'=>'LPIS00006', 'name'=>'Ralph Jayson Ochoa', 'local_church'=>'Isabela', 'day_1'=>'N', 'day_2'=>'Y', 'day_3'=>'Y', 'day_4'=>'N'],
            ['uuid'=>'LPIS00007', 'name'=>'Pauline Bautista', 'local_church'=>'Isabela', 'day_1'=>'N', 'day_2'=>'Y', 'day_3'=>'Y', 'day_4'=>'N'],
            ['uuid'=>'LPIS00008', 'name'=>'Nicole Cabaccan', 'local_church'=>'Isabela', 'day_1'=>'N', 'day_2'=>'Y', 'day_3'=>'Y', 'day_4'=>'N'],
            ['uuid'=>'LPIS00011', 'name'=>'John Garo', 'local_church'=>'Isabela', 'day_1'=>'N', 'day_2'=>'Y', 'day_3'=>'Y', 'day_4'=>'N'],
            ['uuid'=>'LPIS00012', 'name'=>'John Paul Fernandez', 'local_church'=>'Isabela', 'day_1'=>'N', 'day_2'=>'Y', 'day_3'=>'Y', 'day_4'=>'N'],
            ['uuid'=>'LPIS00013', 'name'=>'Cherry Pabigayan', 'local_church'=>'Isabela', 'day_1'=>'N', 'day_2'=>'Y', 'day_3'=>'Y', 'day_4'=>'N'],
            ['uuid'=>'LPIS00014', 'name'=>'Serina Rapat', 'local_church'=>'Isabela', 'day_1'=>'N', 'day_2'=>'Y', 'day_3'=>'Y', 'day_4'=>'N'],
            ['uuid'=>'LPIS00016', 'name'=>'Irish Princess Uy', 'local_church'=>'Isabela', 'day_1'=>'N', 'day_2'=>'Y', 'day_3'=>'Y', 'day_4'=>'N'],
            ['uuid'=>'LPIS00017', 'name'=>'Joana Marie Macuray', 'local_church'=>'Isabela', 'day_1'=>'N', 'day_2'=>'Y', 'day_3'=>'Y', 'day_4'=>'N'],
            ['uuid'=>'LPIS00018', 'name'=>'Manilyn Macuray', 'local_church'=>'Isabela', 'day_1'=>'N', 'day_2'=>'Y', 'day_3'=>'Y', 'day_4'=>'N'],
            ['uuid'=>'LPIS00019', 'name'=>'Ferrel Andres', 'local_church'=>'Isabela', 'day_1'=>'N', 'day_2'=>'Y', 'day_3'=>'Y', 'day_4'=>'N'],
            ['uuid'=>'LPIS00020', 'name'=>'Rudy Trinidad', 'local_church'=>'Isabela', 'day_1'=>'N', 'day_2'=>'Y', 'day_3'=>'Y', 'day_4'=>'N'],
            ['uuid'=>'LPIS00021', 'name'=>'Zyron Kyle Pontillas', 'local_church'=>'Isabela', 'day_1'=>'N', 'day_2'=>'Y', 'day_3'=>'Y', 'day_4'=>'N'],
            ['uuid'=>'LPIS00022', 'name'=>'Ahmad Macapasir', 'local_church'=>'Isabela', 'day_1'=>'N', 'day_2'=>'Y', 'day_3'=>'Y', 'day_4'=>'N'],
            ['uuid'=>'LPIS00023', 'name'=>'Jenny Mae Culalabe', 'local_church'=>'Isabela', 'day_1'=>'N', 'day_2'=>'Y', 'day_3'=>'Y', 'day_4'=>'N'],
            ['uuid'=>'LPIS00024', 'name'=>'Shirlon Valdez', 'local_church'=>'Isabela', 'day_1'=>'N', 'day_2'=>'Y', 'day_3'=>'Y', 'day_4'=>'N'],
            ['uuid'=>'LPIS00026', 'name'=>'Janine Marie Macdon', 'local_church'=>'Isabela', 'day_1'=>'N', 'day_2'=>'Y', 'day_3'=>'Y', 'day_4'=>'N'],
            ['uuid'=>'LPIS00027', 'name'=>'Jan Mico Macdon', 'local_church'=>'Isabela', 'day_1'=>'N', 'day_2'=>'Y', 'day_3'=>'Y', 'day_4'=>'N'],
            ['uuid'=>'LPIS00028', 'name'=>'Iluminada Larugal', 'local_church'=>'Isabela', 'day_1'=>'N', 'day_2'=>'Y', 'day_3'=>'Y', 'day_4'=>'N'],
            ['uuid'=>'LPIS00029', 'name'=>'Nicole Larugal', 'local_church'=>'Isabela', 'day_1'=>'N', 'day_2'=>'Y', 'day_3'=>'Y', 'day_4'=>'N'],
            ['uuid'=>'LPIS00030', 'name'=>'Mark Jiroh Galiza', 'local_church'=>'Isabela', 'day_1'=>'N', 'day_2'=>'Y', 'day_3'=>'Y', 'day_4'=>'N'],
            ['uuid'=>'LPIS00031', 'name'=>'Mary Rose Domingo', 'local_church'=>'Isabela', 'day_1'=>'N', 'day_2'=>'Y', 'day_3'=>'Y', 'day_4'=>'N'],
            ['uuid'=>'LPIS00034', 'name'=>'Jan Nicolai Macdon', 'local_church'=>'Isabela', 'day_1'=>'N', 'day_2'=>'Y', 'day_3'=>'Y', 'day_4'=>'N'],
            ['uuid'=>'LPIS00035', 'name'=>'Joshua Trinidad', 'local_church'=>'Isabela', 'day_1'=>'N', 'day_2'=>'Y', 'day_3'=>'Y', 'day_4'=>'N'],
            ['uuid'=>'LPIS00038', 'name'=>'Jennifer Lacaste', 'local_church'=>'Isabela', 'day_1'=>'N', 'day_2'=>'Y', 'day_3'=>'Y', 'day_4'=>'N'],
            ['uuid'=>'LPIS00040', 'name'=>'Hannah Grace Dizon', 'local_church'=>'Isabela', 'day_1'=>'N', 'day_2'=>'Y', 'day_3'=>'Y', 'day_4'=>'N'],
            ['uuid'=>'LPIS00041', 'name'=>'Arlene Trinidad', 'local_church'=>'Isabela', 'day_1'=>'N', 'day_2'=>'Y', 'day_3'=>'Y', 'day_4'=>'N'],
            ['uuid'=>'LPIS00042', 'name'=>'Rodolfo Trinidad', 'local_church'=>'Isabela', 'day_1'=>'N', 'day_2'=>'Y', 'day_3'=>'Y', 'day_4'=>'N'],
            ['uuid'=>'LPIS00047', 'name'=>'Jan Danielle Macdon', 'local_church'=>'Isabela', 'day_1'=>'N', 'day_2'=>'Y', 'day_3'=>'Y', 'day_4'=>'N'],
            ['uuid'=>'LPIS00049', 'name'=>'Tricha May Co', 'local_church'=>'Isabela', 'day_1'=>'N', 'day_2'=>'Y', 'day_3'=>'Y', 'day_4'=>'N'],
            ['uuid'=>'LPIS00050', 'name'=>'Gina Co', 'local_church'=>'Isabela', 'day_1'=>'N', 'day_2'=>'Y', 'day_3'=>'Y', 'day_4'=>'N'],
            ['uuid'=>'LPIS00051', 'name'=>'Sharon Ochoa', 'local_church'=>'Isabela', 'day_1'=>'N', 'day_2'=>'Y', 'day_3'=>'Y', 'day_4'=>'N'],
            ['uuid'=>'LPIS00052', 'name'=>'Cherie Ann Valdez', 'local_church'=>'Isabela', 'day_1'=>'N', 'day_2'=>'Y', 'day_3'=>'Y', 'day_4'=>'N'],
            ['uuid'=>'LPIS00053', 'name'=>'Genesis Miranda', 'local_church'=>'Isabela', 'day_1'=>'N', 'day_2'=>'Y', 'day_3'=>'Y', 'day_4'=>'N'],
            ['uuid'=>'LPIS00054', 'name'=>'Jewel Dane Gabriel', 'local_church'=>'Isabela', 'day_1'=>'N', 'day_2'=>'Y', 'day_3'=>'Y', 'day_4'=>'N'],
            ['uuid'=>'LPIS00055', 'name'=>'Anthony Jacinto Alagao', 'local_church'=>'Isabela', 'day_1'=>'N', 'day_2'=>'Y', 'day_3'=>'Y', 'day_4'=>'N'],
            ['uuid'=>'LPTA00006', 'name'=>'Marjessa Santana Alcibar', 'local_church'=>'Tarlac', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPTA00007', 'name'=>'Susan santana', 'local_church'=>'Tarlac', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPTA00008', 'name'=>'Marie Jezzel Santana', 'local_church'=>'Tarlac', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPTA00009', 'name'=>'Marjelyn Manalo', 'local_church'=>'Tarlac', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPTA00012', 'name'=>'Judea Tud', 'local_church'=>'Tarlac', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPTA00013', 'name'=>'Teresita Encarnacion', 'local_church'=>'Tarlac', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPTA00014', 'name'=>'Leonor Alcibar', 'local_church'=>'Tarlac', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPTA00015', 'name'=>'Juanito Encarnacion', 'local_church'=>'Tarlac', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPTA00016', 'name'=>'Jannele Dialino', 'local_church'=>'Tarlac', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPTA00018', 'name'=>'Mark Ong', 'local_church'=>'Tarlac', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPTA00019', 'name'=>'Vilma Ong', 'local_church'=>'Tarlac', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPTA00020', 'name'=>'Ed Ong', 'local_church'=>'Tarlac', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPTA00022', 'name'=>'Kimberlyn Alcibar Franco', 'local_church'=>'Tarlac', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPTA00023', 'name'=>'Veronica Cunanan', 'local_church'=>'Tarlac', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPTA00025', 'name'=>'Allen Francisco Laquindanum', 'local_church'=>'Tarlac', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPTA00026', 'name'=>'Paulcarlos Casupanan', 'local_church'=>'Tarlac', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPTA00031', 'name'=>'Mark Jerald T. Santana', 'local_church'=>'Tarlac', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPTA00032', 'name'=>'Carmen Mangrobang', 'local_church'=>'Tarlac', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPTA00033', 'name'=>'Crystal Go', 'local_church'=>'Tarlac', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPTA00034', 'name'=>'Joseph Alcibar', 'local_church'=>'Tarlac', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPTA00036', 'name'=>'Michaelcasupanan', 'local_church'=>'Tarlac', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPTA00040', 'name'=>'Jomarie Tagalog', 'local_church'=>'Tarlac', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPTA00041', 'name'=>'John Robert Lu', 'local_church'=>'Tarlac', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPTA00042', 'name'=>'Jharianney Sydney Dialino', 'local_church'=>'Tarlac', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPTA00043', 'name'=>'Jhanel Santos Manalo', 'local_church'=>'Tarlac', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPTA00044', 'name'=>'Hazel Bianca Garcia', 'local_church'=>'Tarlac', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPTA00045', 'name'=>'Joseph bayron', 'local_church'=>'Tarlac', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPTA00049', 'name'=>'Editha Dialino', 'local_church'=>'Tarlac', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPTA00050', 'name'=>'Reymon Manalo', 'local_church'=>'Tarlac', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPTA00051', 'name'=>'Carla Calaber', 'local_church'=>'Tarlac', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPTA00052', 'name'=>'Jenro John Puno', 'local_church'=>'Tarlac', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPTA00059', 'name'=>'Marie Stella Casupanan', 'local_church'=>'Tarlac', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPTA00060', 'name'=>'Harvey Mangrobang', 'local_church'=>'Tarlac', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPTA00061', 'name'=>'Alfred Tiamzon', 'local_church'=>'Tarlac', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPTA00062', 'name'=>'Mark Gabriel Belmonte', 'local_church'=>'Tarlac', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPTA00063', 'name'=>'Marnie Sebastian', 'local_church'=>'Tarlac', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPTA00067', 'name'=>'Jasmin Laza', 'local_church'=>'Tarlac', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPTA00069', 'name'=>'Marn Garcia', 'local_church'=>'Tarlac', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPTA00072', 'name'=>'Kallil Marin', 'local_church'=>'Tarlac', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPTA00073', 'name'=>'Merry Julianne Marin', 'local_church'=>'Tarlac', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPTA00076', 'name'=>'Luisa Palaganas Catap', 'local_church'=>'Tarlac', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPTA00077', 'name'=>'Aezel Cortez Gutierrez', 'local_church'=>'Tarlac', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPTA00083', 'name'=>'Remedios Lu', 'local_church'=>'Tarlac', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPTA00086', 'name'=>'Maria Luisa Laquindanum', 'local_church'=>'Tarlac', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPTA00087', 'name'=>'Princess Cunanan', 'local_church'=>'Tarlac', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPTA00094', 'name'=>'Sienna Ong', 'local_church'=>'Tarlac', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPTA00095', 'name'=>'KIa an Tundayag Lu', 'local_church'=>'Tarlac', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPTA00097', 'name'=>'Jan Wilson Sicat', 'local_church'=>'Tarlac', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPTA00098', 'name'=>'Maria Elaiza Garcia', 'local_church'=>'Tarlac', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPTA00099', 'name'=>'Theresa Belmonte', 'local_church'=>'Tarlac', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPTA00101', 'name'=>'Mark Joseph Belmonte', 'local_church'=>'Tarlac', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPTA00102', 'name'=>'Vilma Estigoy', 'local_church'=>'Tarlac', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPTA00103', 'name'=>'Jessamae Moldero', 'local_church'=>'Tarlac', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPTA00105', 'name'=>'Riza Mae Laquindanum', 'local_church'=>'Tarlac', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPTA00109', 'name'=>'Zarah Guillermo', 'local_church'=>'Tarlac', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPTA00110', 'name'=>'Krystal Jade Agpangan', 'local_church'=>'Tarlac', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPTA00111', 'name'=>'Althea Mae Malaqui Estavillo', 'local_church'=>'Tarlac', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPTA00112', 'name'=>'Joana Ericka Estavillo', 'local_church'=>'Tarlac', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPTA00113', 'name'=>'Kristina Cassandra Estavillo', 'local_church'=>'Tarlac', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPTA00114', 'name'=>'Noel Guillermo', 'local_church'=>'Tarlac', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPTA00118', 'name'=>'Rafael Cayabyab Tapulayan', 'local_church'=>'Tarlac', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPTA00119', 'name'=>'Gerard Austria Mangacu', 'local_church'=>'Tarlac', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPTA00121', 'name'=>'Jacob Sicat', 'local_church'=>'Tarlac', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPTA00130', 'name'=>'Neil Distrito', 'local_church'=>'Tarlac', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPTA00137', 'name'=>'Nino Laquindanum', 'local_church'=>'Tarlac', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPTA00139', 'name'=>'Nina Dela Cruz', 'local_church'=>'Tarlac', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPTA00140', 'name'=>'Ethan Pasion', 'local_church'=>'Tarlac', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPTA00143', 'name'=>'Judy Ann Marin', 'local_church'=>'Tarlac', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPTA00144', 'name'=>'Errol Marin', 'local_church'=>'Tarlac', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPTA00145', 'name'=>'Paula Sotto', 'local_church'=>'Tarlac', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPTA00146', 'name'=>'Aris Sicat', 'local_church'=>'Tarlac', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPTA00150', 'name'=>'Nicole Garcia', 'local_church'=>'Tarlac', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPTA00152', 'name'=>'Shaira shane', 'local_church'=>'Tarlac', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
            ['uuid'=>'LPTA00159', 'name'=>'Nicholas Gozum', 'local_church'=>'Tarlac', 'day_1'=>'N', 'day_2'=>'N', 'day_3'=>'Y', 'day_4'=>'Y'],
        );

        foreach ($bookMe as $data) {
            $this->command->info('-------- booking member ----------');
            
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
                        'slot_id' => $x,
                        'local_church' => $data['local_church']
                    ]);
                }
            }

            Booking::insert($dateToBeBooked);

            $this->command->info('Booked Day(s): ' . $booked_log);
            $this->command->info('------------- done ---------------');
        }
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
