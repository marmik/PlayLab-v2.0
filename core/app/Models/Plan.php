<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    public function scopeActive()
    {
        return $this->where('status', 1);
    }
}
