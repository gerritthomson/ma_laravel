<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    //
    public function options(){
        return $this->belongsToMany('App\Option', 'answeroptions')->withPivot('value');
    }
    public function scene(){
        return $this->belongsTo('App\Scene');
    }
}
