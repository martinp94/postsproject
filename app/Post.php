<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'body','user_id', 'tags'];


    public function author()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function votes()
    {
        return $this->hasMany('App\Vote');
    }
}
