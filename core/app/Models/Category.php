<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function scopeActive()
    {
    	return $this->where('status',1);
    }

    public function subcategories()
    {
    	return $this->hasMany(SubCategory::class);
    }
}
