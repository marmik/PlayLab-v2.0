<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    public function episode(){
    	return $this->belongsTo(Episode::class);
    }

    public function item(){
    	return $this->belongsTo(Item::class);
    }
}
