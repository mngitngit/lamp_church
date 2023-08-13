<?php

namespace App\Models;

class UUID
{
    public static function issue()
    {
        $range = AvailableUuid::where('year', config('settings.year'))->first();

        return $range->next();
    }
}
