<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public function users()
    {
        return $this->belongsToMany('App\User')->withPivot('course_progress');
    }

    public function language()
    {
        return $this->belongsTo('App\Language');
    }

    public function lessons()
    {
        return $this->hasMany('App\Lesson');
    }

    public function repetitions()
    {
        return $this->hasMany('App\Repetition');
    }

    public function words()
    {
        return $this->hasManyThrough('App\Word', 'App\Lesson');
    }

}
