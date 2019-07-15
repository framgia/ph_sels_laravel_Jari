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
                <h1>Categories</h1>
                <button type="submit" onclick=window.location='{{ url("/category/create") }}' class="button is-link btn btn-success">Create Category</button>
            </div>
        </div>   
    </div> 
            
    <br/>
    <div class='row border-top  border-bottom mb-4 p-1  '>
        <div class='col-sm-2'>
            <label class="label" for="title">Title</label>
        </div>

        <div class='col-sm-2'>
            <label class="label" for="description">Description</label>
        </div>
    </div>
</div>

@foreach ($categories as $category)
<div class='container'>
    
        <form class = "form-horizontal" method="POST" action= "/category/{{$category->id}}">
            @method('PATCH')
            @csrf
            <div class='row'>
                <div class = 'col-sm-2'>
                    <input type="text" class="input" name="title" placeholder="Title" value="{{ $category->title }}">
                </div>

                <div class = 'col-sm-2'>
                    <textarea name="description" class="textarea">{{ $category->description }}</textarea>
                </div>

                <div class='btn-group'>
                <div class = 'col-sm-2'>
                    <div>
                        <button type="submit" class="button is-link btn btn-primary">Update Category</button>
                    </div>
                </div>
                
            </div>
        </form>
        
        <form class = "form-horizontal" method="POST" action= "/category/destroy/{{$category->id}}">
            @method('DELETE')
            @csrf
                <div class="col-sm-2">
                    <div class="control">
                        <button type="submit" class="button is-link btn btn-danger">Delete Category</button>
                    </div>
                </div>
        </form>
    </div> 
</div>
@endforeach

@endsection
