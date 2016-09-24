<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}
