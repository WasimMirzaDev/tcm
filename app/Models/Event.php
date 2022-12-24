<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;
    
    public function category() {
        return $this->belongsTo(EventCategory::class, 'category_id');
    }

}
