<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SectionSelect extends Model
{
    //
    public function section(){
        return $this-hasOne('App\Section');
    }
    public function select(){
        return $this->hasOne('App\Select');
    }
}
