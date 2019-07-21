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
        </div>   
    </div> 

    <h1>Create a new question</h1>
    <form method="POST" action="/question/store">
        @csrf
        <div class ="field">
            <label class="label" for="client">Term</label>
            <br/>
            
            <input type= "text" name="term" placeholder="Term">
        </div>  
        </br>
        <div class="field">
            <label for="title">Category</label>
            </br>
            <select id="categoryId" name="categoryId" required >
                @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->title}}</option>
                @endforeach
            </select>
        </div>
        </br>
        <div>
            <button type="submit" class="button is-link btn btn-success">Create Question</button>
        </div>
        <!-- @if ($errors->any())
        <div class= "notification is-danger">
        
            <ul>

                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        
        </div>
        @endif -->
    </form>
@endsection
