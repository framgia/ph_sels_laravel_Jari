@extends('layouts.app')
@section('content')
@if(\Session::has('error'))
<div class='alert alert-danger'>
    {{ \Session::get('error') }}
</div>
@endif
<div class='container'>
    <div class='row'>
        <div class='col-4'> 
            <div class = "row">
                <img  src="{{asset(auth()->user()->profile_image) }}" class="rounded mx-auto d-block" id ="profilePic" width="40%" height="auto"/>
            </div>
            <div class='row justify-content-center mt-4 mx-auto'>
                <div class="col-4 border-bottom border-dark">
                    <h3>{{ $name }}</h3>
                    </br>
                    <div class='row-4'>
                        <h3>{{ $user->email }}</h3>
                    </div>
                </div>
         
            </div>

            <div class='container'>
                <div class='row justify-content-center mt-2 mx-auto'>
                    <div class= 'col justify-content-right mt-4'>
                        <div class= "col col-md-offset-2  mx-auto">{{ $user->followers()->count() }}<br>
                        <a  href="{{ URL::to('/user/follow/') }}">Followers</a></div>
                    </div>
                    <div class='col justify-content-center mt-4 '>
                        <div class=' mx-auto'>{{ $user->followings()->count() }}<br>
                        <a  href="{{ URL::to('/user/following/') }}">Followings</a></div>
                    </div>
                </div> 
            </div>   

            @if($user->name!=auth()->user()->name)
                @if($flag)
                    <div class='row justify-content-center mt-4'>
                        <button class="btn btn-outline-primary" onclick="window.location='{{ url($user->id.'/unfollow') }}'">Unfollow User</a></button>
                    </div>
                @else
                <div class='row justify-content-center mt-4'>
                        <button class="btn btn-primary" onclick="window.location='{{ url('/profile/'.$user->id.'/follow') }}'">Follow User</button>
                    </div>
                @endif
            @endif

            <div class='row justify-content-center mt-4'>
                <div>Learned {{ $wordsLearned }} words</div>
            </div>
        </div>
        <div class='col-md border border-dark border-2 shadow p-3 mb-5 bg-white rounded'>
            <div class='row border-bottom'>
                <h1 class="mt-2 ml-2">Activities</h1>
            </div>
            @foreach($allActivities->take(4) as $activity)
                @if($activity->action_type=='App\Follower')
                    <div class="mt-4">
                        <img src="{{asset($activity->user->profile_image) }}" class="rounded-circle" />
                        {{ $activity->user->name }}
                        {{ $activity->content }}
                    </div>
                    <br>
                @elseif($activity->action_type=='App\Lesson')
                    <div class="mt-4 mr-2 ml-2 mb-2 border border-light rounded">
                        <img src="{{asset($activity->user->profile_image) }}" class="rounded-circle" />
                        {{ $activity->user->name }}
                        {{ $activity->content }}
                    </div>
                    <br>
                @endif
            @endforeach
        </div>
    </div>
</div>
@endsection