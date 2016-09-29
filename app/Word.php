<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Word extends Model
{
    public function translations()
    {
        return $this->hasMany('App\Translation','word_from_id');
    }

    public function language()
    {
        return $this->belongsTo('App\Language');
    }

    public function lessons()
    {
        return $this->belongsToMany('App\Lesson');
    }

    public function hasRepetition($user_id,$course_id)
    {
        $repetition = Repetition::where('course_id', $course_id)->where('excercise_id', $this->id)->where('excercise_type', 'App\Word')->where('user_id', $user_id)->get()->first();
        return $repetition === null ? false : true;
    }

    public function repetitions()
    {
        return $this->morphMany('App\Repetition', 'excercise');
    }
}
