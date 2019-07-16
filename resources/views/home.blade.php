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
        <div class='col-md-8 col-md-offset-2'>
            <div class='panel panel-default'>
                <div class=container>
                    <div class='row'>
                        <div class='col-md-5'>
                        <img class="img-thumbnail" src="{{asset(auth()->user()->profile_image) }}" id ="profilePic"/>
                        <div class='panel-heading'>Dashboard</div>
                        <div class='panel-heading'>{{auth()->user()->name}}</div>
                    
                        @if(auth()->user()->isAdmin == 1)
                            <div class='panel-body'>
                                <a href="{{url('admin/routes')}}">Admin</a><br>
                                <a href="{{url('category/show')}}">View Categories</a><br>
                                <a href="{{url('question/addQuestion')}}">Add Question</a><br>
                                <a href="{{url('question/addChoice')}}">Add Choice</a><br>
                        @else       
                            <div class='panel-heading'>Learned {{ App\Lesson::where('user_id','=',auth()->user()->id)->get()->count() }} lessons</div>        
                            <div class='panel-heading'>Learned {{ $wordsLearned }} words</div>   
                            <div class='panel-body'>
                                <a href="{{url('user/userProfile')}}">Profile</a><br>
                                <a href="{{url('user/displayList')}}">Users</a><br>
                                <a href="{{url('user/wordsLearned')}}">Words Learned</a><br>
                                <a href="{{url('user/lessons')}}">Lessons</a><br>
                            </div>
                    </div>
                    <div class='col-md-7'>
                            <div><h2>Activities</h2></div>
                            
                                <br>
                                @foreach($allActivities->take(6) as $activity)
                                    
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
        </div>
    </div>
@endsection
