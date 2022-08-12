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
     * Get the payments for the delegate.
     */
    public function payments()
    {
        return $this->hasMany(Payment::class, 'registration_uuid', 'uuid');
    }
}
