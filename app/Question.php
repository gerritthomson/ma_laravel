<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    //
    public function sections(){
        return $this->hasMany('App\Section');
    }

    public function scenes(){
        return $this->hasMany('App\Scene');
    }
}
