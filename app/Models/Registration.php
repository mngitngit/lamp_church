<?php

namespace App\Models;

use Attribute;
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
        'fullname',
        'facebook_name',
        'registration_type',
        'local_church',
        'country',
        'category',
        'rate',
        'payment_status',
        'other_details',
        'attending_option',
        'with_awta_card',
        'with_accommodation',
        'mode_of_transpo',
        'priority_dates',
        'can_book',
        'can_book_rate',
        'can_book_days',
        'rebooking_limit'
    ];

    public static function boot() {
        parent::boot();
        
        self::creating(function ($model) {
            $payment_config = Rates::where('category', $model->category)
                ->where('attending_option', $model->attending_option)
                ->first();

            $model->rate = $payment_config->rate;
            $model->can_book_rate = $payment_config->can_book_rate;
        });

        self::updating(function ($model) {
            $payment_config = Rates::where('category', $model->category)
                ->where('attending_option', $model->attending_option)
                ->first();

            $model->rate = $payment_config->rate;
            $model->can_book_rate = $payment_config->can_book_rate;

            self::logActivity('updated the registration details of ' . $model->fullname, $model->fullname);
        });

        self::deleting(function ($model) {
            self::logActivity('deleted the registration details of ' . $model->fullname, $model->fullname);
        });
    }

    /**
     * Get the payments for the delegate.
     */
    public function payments()
    {
        return $this->hasMany(Payment::class, 'registration_uuid', 'uuid');
    }

    /**
     * Get the booking for the delegate.
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class, 'registration_uuid', 'uuid');
    }

    /**
     * Get the attendance for the delegate.
     */
    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'registration_uuid', 'uuid');
    }

    /**
     * Get the rebooking activities for the delegate.
     */
    public function rebooking_activities()
    {
        return $this->hasMany(RebookingActivities::class, 'registration_uuid', 'uuid');
    }

    private function logActivity($description, $delegate_name) {
        if (auth()->user()) {
            auth()->user()->activities()->create([
                'description' => $description,
                'delegate_name' => $delegate_name 
            ]);
        }
    }
}
