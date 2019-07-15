@extends('layouts.app')
@push('styles')
    <link href="{{ asset('css/results.css') }}" rel="stylesheet">
@endpush
@section('content')
@if(\Session::has('error'))
<div class='alert alert-danger'>
    {{\Session::get('error')}}
</div>
@endif
<div class='container'>
        <div class='row'>
            <div class='.col-sm-2'>
                <div class='panel-heading'><h4>Dashboard</h4></div>
            </div>
        </div>
        <div class='row'>
            <div class='.col-md-2'> 
                <img class="img-thumbnail" src="{{asset(auth()->user()->profile_image) }}" id ="profilePic"/>
            </div>
            <div class='col col-md-2'> 
                @if(auth()->user()->isAdmin == 1)
                    <div>{{auth()->user()->name}}</div>
                    <div class='panel-body'>
                        <a href="{{url('category/edit')}}">Show Categories</a><br>
                        <a href="{{url('question/addQuestion')}}">Add Question</a><br>
                        <a href="{{url('question/addChoice')}}">Add Choice</a><br>
                @else 
                    <div>{{auth()->user()->name}}</div>
                    <div><a href="{{url('user/wordsLearned')}}">Learned {{ $wordsLearned }} words</a></div>   
                    <div>Learned {{ App\Lesson::where('user_id','=',auth()->user()->id)->get()->count() }} lessons</div>  
                    <div class='panel-body'>
                    </div>
            </div>
            <div class='col-md border border-dark border-2 shadow p-3 mb-5 bg-white rounded'>
            <div class='row border-bottom'>
                <h1 class="mt-2 ml-2">Activities</h1>
            </div>
                    @foreach($allActivities->take(4) as $activity)
                        @if($activity->action_type=='App\Follower')
                            <div>
                                <img src="{{asset($activity->user->profile_image) }}" class="rounded-circle" />
                                {{ $activity->user->name }}
                                {{ $activity->content }}
                            </div>
                            <br>                                  
                        @elseif($activity->action_type=='App\Lesson')
                            <div>
                                <img src="{{asset($activity->user->profile_image) }}" class="rounded-circle" />
                                {{ $activity->user->name }}
                                {{ $activity->content }}
                            </div>
                            <br> 
                        @endif
                    @endforeach
                @endif
            </div>
        </div>
        </div>
    </div>
 </div>
@endsection
