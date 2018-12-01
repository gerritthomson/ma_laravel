<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    //
    public function user(){
        return $this->hasOne('App\User');
    }
    public function question(){
        return $this->hasOne('App\Question');
    }

    public function options(){
        return $this->belongsToMany('App/Option', 'submission_options')->withTimestamps();
    }

}
