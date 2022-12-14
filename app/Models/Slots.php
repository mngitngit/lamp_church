<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slots extends Model
{
    use HasFactory;

    protected $appends = ['available', 'taken', 'percentage'];

    protected $casts = [
        'event_date'  => 'date:F d',
    ];

    public function getAvailableAttribute() {
        $taken = Booking::where('slot_id', $this->id)->count();
        return $this->seat_count - $taken;

    }

    public function getTakenAttribute() {
        $taken = Booking::where('slot_id', $this->id)->count();
        return $taken;
    }

    public function getPercentageAttribute() {
        $taken = Booking::where('slot_id', $this->id)->count();
        return number_format(($taken / $this->seat_count) * 100, 2, '.', '');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'slot_id', 'id');
    }
}
