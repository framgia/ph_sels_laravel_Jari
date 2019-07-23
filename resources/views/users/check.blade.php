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
        <h2>Results Page</h2>
        <form method="POST" action= "/results/store">
            @csrf
            <input type="hidden" id="lessonId" name="lessonId" value={{$lessonId}} />
            <input type="hidden" id="categoryId" name="categoryId" value={{$categoryId}} />
            <button type="submit">HOME</button>
            <input type="hidden" id="score" name="score" value={{$score}} />
            <input type="hidden" id="questionCount" name="questionCount" value={{$questions->count()}} />
            <div>Your score is {{ $score }} out of {{ $questions->count() }}: </div>
            <div class="row">
                <div class='col-md-4 col-md-offset-4'>
                    <input type="hidden" id="collection" name="collection" value={{$questions}} />
                    <h3>Questions</h3>
                    
                    @for ($i = 0; $i <$questions->count(); $i++)
                        {{ $collection[$i] }}<br>
                    @endfor
                   
                </div>
                <div class='col-md-4 col-md-offset-8'>
                    <h3>Your answers</h3>
                    @for ($i = 0; $i <$questions->count(); $i++)
                        
                        @if($collection1[$i]->isCorrect==1)
                            {{ $collection1[$i]->word }}     O<br>
                        @elseif($collection1[$i]->isCorrect==0)
                            {{ $collection1[$i]->word }}     X<br>
                        @endif
                    @endfor
                    
                </div>
            <div>
        </form>
        <br>
    </div>
@endsection