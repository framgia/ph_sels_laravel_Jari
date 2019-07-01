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
        
        return redirect('/home');
        
    }

    public function show()
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
        return redirect('/category/show');
    }

    public function destroy($id)
    {
        Category::find($id)->delete();
        
        return redirect('/category/show');
    }

    

}
