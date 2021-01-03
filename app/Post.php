<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function comments() {
        return $this->hasMany('App\Comment');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function page() {
        return $this->belongsTo('App\Page');
    }

    public function tag() {
        return $this->morphOne(Tag::class, 'taggable');
    }
}
