<?php

namespace App\Models;

class UUID
{
    public static function issue()
    {
        $range = AvailableUuid::available();

        return $range->next();
    }
}
