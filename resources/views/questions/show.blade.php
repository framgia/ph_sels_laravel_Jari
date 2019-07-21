@extends('layouts.app')
@section('content')
@if(\Session::has('error'))
<div class='alert alert-danger'>
    {{\Session::get('error')}}
</div>
@endif
<div class='container'>
    <div class='row-md-2'>
        <div class='col-md-8 col-md-offset-2'>
            <div class='panel panel-default'>
                <div class='panel-heading'>{{ auth()->user()->name }}</div>
                <h1>Questions</h1>
                <button type="submit" onclick=window.location='{{ url("/question/create") }}' class="button is-link btn btn-success">Create Question</button>
            </div>
        </div>   
    </div> 
            
    <br/>
    <div class='row border-top  border-bottom mb-4 p-1  '>
        <div class='col-sm-2'>
            <label class="label" for="name">Term</label>
        </div>

        <div class='col-sm-2'>
            <label class="label" for="email">Name of category</label>
        </div>

    </div>
</div>

@foreach ($questions as $question)
<div class='container mb-3'>
    
        <form class = "form-horizontal" method="POST" action= "/question/{{$question->id}}">
            @method('PATCH')
            @csrf
            <div class='row'>
                <div class = 'col-sm-2'>
                    <input type="text" class="input" name="name" placeholder="Name" value="{{ $question->term }}">
                </div>

                <div class = 'col-sm-2'>

                    <select id="categoryId" name="categoryId" placeholder="Category Name" required >
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->title}}</option>
                        @endforeach
                    </select>
                </div>

                <div class='btn-group'>
                <div class = 'col-sm-2'>
                    <div>
                        <button type="submit" class="button is-link btn btn-primary">Update Question</button>
                    </div>
                </div>
                
            </div>
        </form>
        
        <form class = "form-horizontal" method="POST" action= "/question/destroy/{{$question->id}}">
            @method('DELETE')
            @csrf
                <div class="col-sm-2">
                    <div class="control">
                        <button type="submit" class="button is-link btn btn-danger">Delete Question</button>
                    </div>
                </div>
        </form>
    </div> 
</div>
@endforeach

@endsection
