<?php

namespace App\Models;

class UUID
{
    public static function issue()
    {
        $range = AvailableUuid::where('year', env("YEAR"))->first();

        return $range->next();
    }
}
