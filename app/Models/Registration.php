<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'email',
        'firstname',
        'lastname',
        'facebook_name',
        'registration_type',
        'local_church',
        'country',
        'category',
        'other_details'
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    // protected static function booted()
    // {
    //     // This code will be called every time a new user is inserted into the system
    //     static::created(function ($registration) {
    //         $registration->uuid = '1';
    //         $registration->save();
    //     });
    // }
}
