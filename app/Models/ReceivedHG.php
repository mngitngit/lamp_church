<?php

namespace App\Models;

use App\Models\Slots;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceivedHG extends Model
{
    use HasFactory;

    protected $fillable = [
        'registration_uuid',
        'slot_id',
        'local_church',
        'registration_type',
        'notes'
    ];

    /**
     * Get the delegate that owns the payment.
     */
    public function slot()
    {
        return $this->belongsTo(Slots::class, 'slot_id', 'id');
    }
}
