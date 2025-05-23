<?php

namespace App\Models\ChurchCRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $connection = 'mysql_secondary';
    protected $table = 'person_per';
}
