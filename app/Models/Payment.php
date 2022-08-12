<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'registration_uuid',
        'amount',
        'user_id'
    ];

    /**
     * Append custom columns to the model
     * 
     * @var array
     */
    protected $appends = ['user_name'];

    /**
     * Define the type column to every Item object instance
     * 
     * @return string
     */
    public function getUserNameAttribute()
    {
        return User::find($this->user_id)->name;
    }

    /**
     * Get the delegate that owns the payment.
     */
    public function registration()
    {
        return $this->belongsTo(Registration::class);
    }
}
