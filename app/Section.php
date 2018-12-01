<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    //
    public function selects(){
        return $this->belongsToMany('App\Select', 'sectionselect')->withTimestamps();
    }
}
