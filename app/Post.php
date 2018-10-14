<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    //
    protected $fillable = [
        'id', 'title', 'body','user_id',
    ];
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function comments(){
        return $this->morphMany('App\Comment' ,  'commentable');
    }
    public function tags(){
        return $this->belongsToMany('App\Tag');
    }
}
