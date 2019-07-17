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

    <h1>Create a new category</h1>
    <form method="POST" action="/category/store">
        @csrf
        <div class ="field">
            <label class="label" for="title">Category Title</label>
            <br/>
            
            <input type= "text" name="title" placeholder="Category Title" value="{{old('title')}}" >
        </div>
        <br/>
        <div class="field">
            <label name="label" for="description" >Category Description</label>
            <br/>
            <textarea name ="description" placeholder="Category description" ></textarea>
        </div>
        
        <div>
            <button type="submit" class="button is-link btn btn-success">Create Category</button>
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
