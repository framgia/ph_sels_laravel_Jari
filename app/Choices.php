<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Choices extends Model
{
    protected $fillable = [
        'word', 'question_id', 'isCorrect'
    ];

    public function question()
    {
        return $this->belongsTo('App\Question');

    }
    public function getAnswer()
    {
       
        return $this->hasOne('App\Answer','choice_id');
    }

}
