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
        return $this->hasOne('App\Question');
    }
}
