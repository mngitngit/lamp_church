<?php

namespace App\Models\ChurchCRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Finder extends Model
{
    protected $connection = 'mysql_secondary';
    protected $table = 'person_custom';

    public function person() {
        return $this->hasOne(Person::class, 'per_ID', 'per_ID');
    }
}
