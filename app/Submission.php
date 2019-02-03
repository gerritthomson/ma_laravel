<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Option;

class Submission extends Model
{
    //
    public function user(){
        return $this->hasOne('App\User');
    }
    public function scene(){
        return $this->belongsTo('App\Scene');
    }

    public function options(){
        return $this->belongsToMany('App\Option', 'submission_options');
    }

}
