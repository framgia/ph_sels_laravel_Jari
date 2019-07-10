<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Result;
use App\Category;
use App\Activity;

class ResultsController extends Controller
{
    public function storeResults(Request $request)
    {
        $title = Category::find($request->categoryId)->title;
        
        $userId = Auth()->user()->id;

        Result::create([
            'score'=> $request->input('score'),
            'lesson_id'=>$request->input('lessonId'),
            'user_id'=>$userId,
        ]);
      
        (new Activity)->createActivity(([
            'score' =>$request->input('score'),
            'action_id'=>$request->input('lessonId'),
            'user_id'=>$userId,
            'questionCount'=>$request->input('questionCount'),
            'title'=>$title,
        ]));
        
        return redirect('/home');
    }
}
