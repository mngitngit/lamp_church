<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistrationAdditionalData extends Model
{
    use HasFactory;

    protected $fillable = [
        'registration_id',
        'has_viewed_ticket'
    ];
}
