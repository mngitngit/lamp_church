<?php

namespace App\Enums;

abstract class BookingStatus
{
    const Pending = 'Pending Payment';
    const Confirmed = 'Confirmed';
    const Cancelled = 'Cancelled';
}
