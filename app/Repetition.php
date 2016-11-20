<?php

namespace App;
use App\Word;

use Illuminate\Database\Eloquent\Model;

class Repetition extends Model
{
    public function course()
    {
        return $this->belongsTo('App\Course');
    }

    public function word()
    {
        return $this->hasOne('App\Word');
    }

    public function excercise()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
