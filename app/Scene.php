<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Answer;

class Scene extends Model
{
    //
    public function video(){
        return $this->belongsTo("App\Video");
    }
    public function question(){
        return $this->belongsTo('App\Question');
    }

    public function sections(){
        return $this->belongsToMany('App\Section');
    }

    public function answers(){
        return $this->hasMany('App\Answer');
    }

    public function submissions(){
        return $this->hasMany('App\Submission');
    }
}
