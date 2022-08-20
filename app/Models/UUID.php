<?php

namespace App\Models;

class UUID
{
    public static function issue($localChurch) {
        $range = AvailableUuid::where('local_church', $localChurch)->first();

        return $range->next();
    }
}
