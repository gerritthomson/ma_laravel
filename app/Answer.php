<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    //
    public function options(){
        return $this->hasMany('App\Option');
    }
}
