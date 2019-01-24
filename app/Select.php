<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Option;

class Select extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['label','value'];
    //
    public function options(){
        return $this->hasMany(Option::class);
    }
    public function sections(){
        return $this->belongsToMany('App\Section', 'sectionselect')->withTimestamps();
    }
}
