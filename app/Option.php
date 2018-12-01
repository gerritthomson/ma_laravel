<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    //
    public function select(){
        return $this->belongsTo('App\Select');
    }

    public function submissions(){
        return $this->belongsToMany('App\Submission', 'submission_option')->withTimestamps();
    }
}
