<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceivedHG extends Model
{
    use HasFactory;

    protected $fillable = [
        'registration_uuid',
        'slot_id',
        'local_church',
        'registration_type'
    ];
}
