@extends('layouts.app')
@push('styles')
    <link href="{{ asset('css/card.css') }}" rel="stylesheet">
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
                <h1><div class='panel-heading'>Lessons</div></h1>
                    @foreach ($categories as $category)
                        <form method="GET" action= "/makeLesson/{{$category->id}}" class="card card-1"> 
                            @csrf
                            <div class="card-body d-flex flex-column align-items-start">
                                <h2><strong class="d-inline-block mb-2 text-primary">{{ $category->title }}</strong></h2>

                                <div class="field">
                                    <p class="card-text mb-auto">{{ $category->description }}</p>
                                </div>
                            
                                <div class="field">
                                    <div class="control">
                                        <button type="submit" >Start</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
