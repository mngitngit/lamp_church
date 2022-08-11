<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LookUp extends Model
{
    use HasFactory;

    protected $fillable = [
        'awta_card_number',
        'email',
        'firstname',
        'lastname',
        'facebook_name',
        'registration_type',
        'local_church',
        'category',
        'country'
    ];
}
