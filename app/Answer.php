<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = [
        'answer','choice_id' ,'lesson_id','question_id'
    ];

    public function getChoices()
    {
        return $this->belongsTo('App\Choices','choice_id');  
    }

    public function getQuestion()
    {
        return $this->belongsTo('App\Question','question_id');  
    }

    public function lesson()
    {
        return $this->belongsTo('App\Lesson');
    }

    public function createAnswer($data)
    {
        Answer::create([
            'choice_id' => $data['choice_id'],
            'question_id' =>$data['question_id'],
            'lesson_id' => $data['lesson_id'],
        ]);
    }
}
