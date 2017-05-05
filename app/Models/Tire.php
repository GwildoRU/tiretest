<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tire extends Model
{
    public function shops()
    {
        return $this->belongsToMany('App\Models\Shop')->withPivot('tires_count');
    }
}
