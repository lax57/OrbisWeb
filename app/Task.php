<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public function lesson()
    {
        return $this->belongsTo('App\Lesson');
    }

    public function hasRepetition($user_id,$course_id)
    {
        $repetition = Repetition::where('course_id', $course_id)->where('excercise_id', $this->id)->where('excercise_type', 'App\Task')->where('user_id', $user_id)->get()->first();
        return $repetition === null ? false : true;
    }

    public function repetitions()
    {
        return $this->morphMany('App\Repetition', 'excercise');
    }
}
