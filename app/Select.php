<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Option;

class Select extends Model
{
    //
    public function options(){
        return $this->hasMany(Option::class);
    }
    public function sections(){
        return $this->belongsToMany('App\Section', 'sectionselect')->withTimestamps();
    }
}
