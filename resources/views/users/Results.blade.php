@extends('layouts.app')
@push('scripts')
    <script src="{{ asset('js/disableBack.js')}}"></script>
@endpush
@push('styles')
    <link href="{{ asset('css/results.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class='container'>
    @if(\Session::has('error'))
    <div class='alert alert-danger'>
        {{\Session::get('error')}}
    </div>
    @endif
    <div class="container">
        <div class='row'>
            <div class="col">
                <h2>{{ $title }} was already completed.</h2>
            </div>
            <div class="col"><h2>Result: {{ $score }} of {{ $question->count() }} </h2></div>
        </div>
        <form method="POST" action= "/results/store">
            @csrf
            <input type="hidden" id="lessonId" name="lessonId" value={{$lessonId}} />
            <input type="hidden" id="categoryId" name="categoryId" value={{$categoryId}} />
            <input type="hidden" id="score" name="score" value={{$score}} />
            <input type="hidden" id="questionCount" name="questionCount" value={{$question->count()}} />
            
            <div class="row">
                <div class='col-md-4 col-md-offset-4'>
                    <input type="hidden" id="collection" name="collection" value={{$question}} />
                    <h3>Questions</h3>
                    @for ($i = 0; $i <$question->count(); $i++)
                        {{$collection[$i]}}<br>
                    @endfor
                </div>
                <div class='col-md-4 col-md-offset-8'>
                    <h3>Your answers</h3>
                    @for ($i = 0; $i <$question->count(); $i++)
                        @if($collection1[$i]->isCorrect==1)
                            {{$collection1[$i]->word}}     O<br>
                        @elseif($collection1[$i]->isCorrect==0)
                        {{$collection1[$i]->word}}     X<br>
                        @endif
                    @endfor
                </div>
            <div>
        </form>
        <br>
    </div>
@endsection