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
    <div class='row'>
        <div class='col-md-8 col-md-offset-2'>
            <div class='panel panel-default'>
                <div class='panel-heading'><h2>Question<h2></div>
                    <form method="POST" action="{{route('quiz.store')}}">
                        @csrf   
                        @foreach($questions as $question)
                        <input type="hidden" id="currentPage" name="currentPage" value="{{$currentPage}}" />
                        <input type="hidden" id="lessonId" name="lessonId" value="{{$lessonId}}" />
                        <input type="hidden" id="categoryId" name="categoryId" value="{{$categoryId}}" />
                        <div class="row">
                        <input type="hidden" id="id" name="id" value="{{$question->id}}" />
                            <h1><div class="column">{{$question->term}}</div></h1>
                            <br><br>
                            <div class="column">
                                @foreach($question->getChoices as $choice)
                                    <h4>
                                    <input type="radio" id="{{$choice->id}}" name="choices" value="{{$choice->id}}" required/>
                                    {{$choice->word}}</h4>
                                    <br>
                                @endforeach
                            </div>
                        </div>  
                        @endforeach
                        <input type="hidden" id="nextPage" name="nextPage" value="{{$questions->nextPageUrl()}}" />
                        <br>
                        <button type="submit"> NEXT</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
