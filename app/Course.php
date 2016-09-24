<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function language()
    {
        return $this->belongsTo('App\Language');
    }
}
