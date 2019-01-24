<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Scene extends Model
{
    //
    public function video(){
        return $this->hasOne("App\Video");
    }
    public function question(){
        return $this->belongsTo('App\Question');
    }

    public function sections(){
        return $this->belongsToMany('App\Section');
    }
}
