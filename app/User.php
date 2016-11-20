<?php

namespace App;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class User extends Model implements Authenticatable
{
    use \Illuminate\Auth\Authenticatable;

    public function courses()
    {
        return $this->belongsToMany('App\Course')->withPivot('course_progress');
    }

    public function repetitions()
    {
        return $this->hasMany('App\Repetition');
    }
}
