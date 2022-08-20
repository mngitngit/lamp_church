<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

abstract class Range extends Model
{
    public function next()
    {
        return tap($this->prefix . str_pad($this->cursor, 5, '0', STR_PAD_LEFT), function () {
            $this->increment('cursor');
        });
    }
}