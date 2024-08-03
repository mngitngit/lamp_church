<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvailableUuid extends Range
{
    use HasFactory;

    public function scopeAvailable($query)
    {
        return $query
            ->where('year', config('settings.year'))
            ->whereRaw('available_uuids.cursor <= available_uuids.end')->first();
    }
}
