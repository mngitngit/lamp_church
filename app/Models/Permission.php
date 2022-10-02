<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = [
        'can_edit_delegate',
        'can_delete_delegate',
        'can_delete_payment',
        'can_export_registrations',
        'can_edit_delegate_config'
    ];
}
