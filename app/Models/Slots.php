<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slots extends Model
{
    use HasFactory;

    protected $appends = ['available'];

    public function getAvailableAttribute() {
        $taken = Booking::where('slot_id', $this->id)->count();
        return $this->seat_count - $taken;

    }
}
