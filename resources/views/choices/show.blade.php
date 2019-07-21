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
                <h1>Choices</h1>
                <button type="submit" onclick=window.location='{{ url("/choice/create") }}' class="button is-link btn btn-success">Create Client</button>
            </div>
        </div>   
    </div>           
    <br/>
    <div class='row border-top  border-bottom mb-4 p-1  '>
        <div class = 'col-sm-2'>
            <label class="label" for="question">Question</label>
        </div>

        <div class='col-sm-2'>
            <label class="label" for="word">Word</label>
        </div>

        <div class='col-sm-2'>
            <label class="label" for="isCorrect">Correct Answer?</label>
        </div>
    </div>
</div>

@foreach ($choices as $choice)
<div class='container mb-3'>
    
        <form class = "form-horizontal" method="POST" action= "/choice/{{$choice->id}}">
            @method('PATCH')
            @csrf
            <div class='row'>
                <div class = 'col-sm-2'>
                    <select id="question_id" name="question_id" placeholder="Question" required >
                        @foreach($questions as $question)
                            <option value="{{$question->id}}">{{$choice->question->term}}</option>
                        @endforeach
                    </select>
                </div>

                <div class = 'col-sm-2'>
                    <input name="word" class="input" placeholder="word" value="{{ $choice->word }}"></input>
                </div>

                <div class = 'col-sm-2'>
                    <input type="hidden" id="{{ $choice->id }}" name="isCorrect" value=0 />
                    <input type="checkbox" id=" {{ $choice->id }}" name="isCorrect" value=1  @if($choice->isCorrect) checked=checked @endif></input>
                </div>

                <div class='btn-group'>
                <div class = 'col-sm-2'>
                    <div>
                        <button type="submit" class="button is-link btn btn-primary">Update Choice</button>
                    </div>
                </div>
                
            </div>
        </form>
        
        <form class = "form-horizontal" method="POST" action= "/choice/destroy/{{$choice->id}}">
            @method('DELETE')
            @csrf
                <div class="col-sm-2">
                    <div class="control">
                        <button type="submit" class="button is-link btn btn-danger">Delete Choice</button>
                    </div>
                </div>
        </form>
    </div> 
</div>
@endforeach

@endsection
