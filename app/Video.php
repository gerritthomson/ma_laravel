<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    //
    public function scenes(){
        return $this->belongsToMany('App\Scene');
    }
}
