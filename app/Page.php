<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    public function users() {
        return $this->belongsToMany('App\User');
    }

    public function posts() {
        return $this->hasMany('App\Post');
    }

    public function creator() {
        return $this->hasOne('App\User');
    }
}
