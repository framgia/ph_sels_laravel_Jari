<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Category;

class QuestionController extends Controller
{
    public function create()
    {
        $categories = Category::all();
        return view('questions.create',compact('categories'));
    }

    public function store(Request $request)
    {
        
        $attributes = ([
            'term' => $request->get('term'),
            'category_id' => $request->get('categoryId'),
        ]);

        Question::create($attributes);
        
        return redirect('/question/edit');
    }

    public function change()
    {
        $questions = Question::all();
        $categories = Category::all();
        return view('questions.show',compact('questions','categories')); 
    }

    public function edit($id)
    {

        $question = Question::findOrFail($id);
        $question->term = request('term');
        $question->category_id = request('categoryId');

        $question->save();
        return redirect('/question/edit');
    }

    public function destroy($id)
    {
        Question::find($id)->delete();
        
        return redirect('/question/edit');
    } 
}
