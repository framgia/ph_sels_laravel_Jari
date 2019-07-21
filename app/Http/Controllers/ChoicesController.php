<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Choices;

class ChoicesController extends Controller
{
    public function create()
    {
        $choices = Choices::all();
        return view('choices.create',compact('choices'));
    }

    public function store(Request $request)
    {
        
        $attributes = ([
            'term' => $request->get('term'),
            'category_id' => $request->get('categoryId'),
        ]);

        Choices::create($attributes);
        
        return redirect('/choice/edit');
    }

    public function change()
    {
        $choices = Choices::all();
        $questions = Question::all();
  
        return view('choices.show',compact('choices','questions')); 
    }

    public function edit($id)
    {
        $choice = Choices::findOrFail($id);
        $choice->question_id = request('question_id');
        $choice->word = request('word');
        $choice->isCorrect = request('isCorrect');

        $choice->save();
        return redirect('/choice/edit');
    }

    public function destroy($id)
    {
        Choices::find($id)->delete();
        
        return redirect('/choice/edit');
    } 
}
