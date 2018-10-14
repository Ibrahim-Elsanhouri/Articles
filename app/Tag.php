<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //
    public function comments(){
        return $this->morphMany('App\Comment' ,  'commentable');
    }
    public function posts(){
        return $this->belongsToMany('App\Post');

    }
   
}
