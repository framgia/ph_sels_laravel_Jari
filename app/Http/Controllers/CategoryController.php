<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    public function create()
    {
        return view('category.create');
    }

    public function store()
    {
        $attributes = request()->validate([
            'title'=> ['required','min:3'],
            'description' => ['required', 'min:3']
        ]);

        Category::create($attributes);
        
        return redirect('/category/edit');
    }

    public function change()
    {
        $categories = Category::all();

        return view('category.show',compact('categories')); 
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $category->title = request('title');
        $category->description = request('description');
        
        $category->save();
        return redirect('/category/edit');
    }

    public function destroy($id)
    {
        Category::find($id)->delete();
        
        return redirect('/category/edit');
    }

    public function addQuestion()
    {

        return view('category/addQuestion');
    }

    public function storeQuestion(Request $request)
    {
        $title=$request->get('title');

        $category= Category::where('title','=',$title)->first();
        
        if($category==null){

            return redirect('/home');
        }
        else{
            $categoryId = $category->id;
            Question::create([
                'term'=> $request->get('question'),
                'category_id'=>  $categoryId,
            ]);
        }

        return redirect('/home');
    }

    public function addChoice()
    {

        return view('category/addChoice');
    }

    public function storeChoice(Request $request)
    {
        $question=$request->get('question');

        $question= Question::where('term','=',$question)->first();

        if($question==null){

            return redirect('/home');
        }
        else{
            $questionId = $question->id;
            Choices::create([
                'word'=> $request->get('choice'),
                'question_id'=>  $questionId,
                'isCorrect'=> $request->get('isCorrect'),
            ]);
        }

        return redirect('/home');
    }
}
