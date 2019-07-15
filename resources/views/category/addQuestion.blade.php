@extends('layouts.app')
@section('content')
<div class='container'>
    @if(\Session::has('error'))
    <div class='alert alert-danger'>
        {{\Session::get('error')}}
    </div>
    @endif
    <div class='row'>
        <div class='col-md-8 col-md-offset-2'>
            <h1 class='panel panel-default'>
                <h1>Add question</h1>

                <form method="POST" action="/question/storeQuestion">
                    {{ csrf_field() }}
                    <div>What is the category?</div>
                    <input type= "text" name="title" placeholder="Category Title" >
                    
                    <div> <br/>What is the question?</div>
                    <input type= "text" name="question" placeholder="Question" >

                    <div>
                        </br>
                        <button type="submit" class="button is-link btn btn-success">Add Question</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
@endsection
