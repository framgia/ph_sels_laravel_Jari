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
            <div class='panel panel-default'>
                <h2>Add a choice</h2>
                
                <form method="POST" action="/question/storeChoice">
                    {{ csrf_field() }}
                    <div>Which question does it belong to?</div>
                    <input type= "text" name="question" placeholder="question">
                    
                    <div></br>Please input choice:</div>
                    
                    <input type= "text" name="choice" placeholder="Choice">

                    <input type="hidden" id="isCorrect" name="isCorrect" value=0 />
                    </br>
                    <input type="checkbox" id="isCorrect" name="isCorrect" value=1 />
                    <label class="checkbox-inline" >Is this the correct answer?</label>

                    <div>
                        <br>
                        <button type="submit" class="button is-link btn btn-success">Add Choice</button>
                    </div>
                </form>
                </h2>
            </div>
        </div>
    </div>
@endsection
