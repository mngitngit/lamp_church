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
        'is_paid',
        'other_details',
        'attending_option'
    ];

    /**
     * Append custom columns to the model
     * 
     * @var array
     */
    protected $appends = ['rate'];

        /**
     * Define the type column to every Item object instance
     * 
     * @return string
     */
    public function getRateAttribute()
    {
        return Rates::where('category', $this->category)
                ->where('attending_option', $this->attending_option)
                ->first()
                ->rate;
    }

    /**
     * Get the payments for the delegate.
     */
    public function payments()
    {
        return $this->hasMany(Payment::class, 'registration_uuid', 'uuid');
    }

    public function rate()
    {
        return $this->hasOne(Rates::class, 'category', 'category');
    }
}
