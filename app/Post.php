<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'body','user_id', 'tags', 'reply_to'];


    public function author()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function votes()
    {
        return $this->hasMany('App\Vote');
    }

    public function comments()
    {
    	return $this->hasMany('App\Post', 'reply_to', 'id');
    }

    public function repliedTo()
    {
        return $this->belongsTo('App\Post', 'reply_to', 'id');
    }
}
