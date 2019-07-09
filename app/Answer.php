<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Choices;

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

    public function getAnswers($lessonId)
    {
        $answers = Answer::where('lesson_id','=',$lessonId)->get();

        $collection1 = $answers->map(function($item,$key){
            $choice = Choices::where('id','=',(int)$item->choice_id)->first();
            return $choice;
        });

        return $collection1;

    }

    public function getAnswerId($answers)
    {
        $answerCollection = $answers->map(function($item,$key){
            return $item->choice_id;
        });   
        
        return $answerCollection;
    }

    public function getCorrectAnswers($answerCollection)
    {
        $correctAnswers = $answerCollection->map(function($item,$key){
            $choice = Choices::find($item);
            if($choice->isCorrect ==1){
                return $choice->word;
            }
        });

        return $correctAnswers;
    }

    public function getQuestions($answerCollection)
    {
        $questionCollection = $answerCollection->map(function($item,$key){
            $choice = Choices::find($item);
            if($choice->isCorrect ==1){
                return $choice->question;
            }
        });

        return $questionCollection;
    }

}
