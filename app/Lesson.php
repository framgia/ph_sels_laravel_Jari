<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $fillable = [
        'score','category_id','user_id'
    ];

    public function actions()
    {
        return $this->morphMany('App\Activity', 'action');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function answer()
    {
        return $this->hasMany('App\Answer','lesson_id');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
