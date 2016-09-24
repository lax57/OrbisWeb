<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    public function words()
    {
        return $this->hasMany('App\Word');
    }

    public function courses()
    {
        return $this->hasMany('App\Course');
    }
}
