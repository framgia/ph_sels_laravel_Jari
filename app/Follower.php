<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Follower;

class Follower extends Model
{
    public function actions()
    {
        return $this->morphMany('App\Activity', 'action');
       
    }

    public function user()
    {
        return $this->hasMany('App\User','follower_id');
       
    }
}
