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
        'user_id',
        'date_paid'
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

    /**
     * Get the payment's date.
     *
     * @param  string  $value
     * @return string
     */
    public function getDatePaidAttribute($value)
    {
        return date_format(date_create($value), "M d, Y");
    }
}
