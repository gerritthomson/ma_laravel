<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    //
    public function options(){
        return $this->belongsToMany('App\Option', 'answer_options')->withPivot('value');
    }
    public function scene(){
        return $this->belongsTo('App\Scene');
    }
}
