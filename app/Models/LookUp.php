<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LookUp extends Model
{
    use HasFactory;

    protected $primaryKey = 'lamp_card_number';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'lamp_card_number',
        'old_lamp_card_number',
        'email',
        'firstname',
        'lastname',
        'fullname',
        'facebook_name',
        'registration_type',
        'local_church',
        'category',
        'country',
        'is_registered',
        'local_church',
        'can_book_days'
    ];
}
