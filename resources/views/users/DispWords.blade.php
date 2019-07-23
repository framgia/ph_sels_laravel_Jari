@extends('layouts.app')
@section('content')
<div class='container'>
    @if(\Session::has('error'))
    <div class='alert alert-danger'>
        {{ \Session::get('error') }}
    </div>
    @endif
    <div class='row'>
        <div class='col-md-5 col-md-offset-2'>
            <div class='panel panel-default'>
                <div class='panel-heading'>Dashboard</div>
                <div>{{ $name }}</div>
                <div>Learned {{ $wordsLearned }} words</div>
                <br>
                <br>
            </div>
        </div>
        <h3>Words Learned</h3>
    </div>
    <div class="col">
    <div class="row">
        <div class="col-md-3 offset-md-4">
            @foreach($correctAnswers as $correctAnswer)
                <h1>{{ $correctAnswer }}</h1>
            @endforeach
        </div>
        <div class="col-md-3 ">
            @foreach($questionCollection as $question)
                <h1>{{ $question['term'] }}</h1>
            @endforeach
        </div>
    </div>
    </div>
@endsection