<?php

namespace App\Enums;

abstract class PaymentStatus
{
    const Unsettled = 'Unsettled';
    const Partial = 'Partial';
    const Paid = 'Paid';
    const Free = 'Free';
}
