<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $fillable = [
        'score', 'lesson_id', 'user_id'
    ];

    public function lesson()
    {
        return $this->belongsTo('App\Lesson');
    }
}
