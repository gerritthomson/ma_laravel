<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    //
    public function selects(){
        return $this->belongsToMany('App\Select', 'sectionselects')->withTimestamps();
    }

    public function children(){
        $a=3;
        return $this->hasMany('App\Section', 'parent_id' );
//        return $this->hasMany('App\Section', 'Sections','parentId')->withTimestamps();
    }
    public function parentSections(){
        return $this->belongsTo(self::class, 'parent_id');
//        return $this->hasMany('App\Section', 'Sections','parentId')->withTimestamps();
    }
}
