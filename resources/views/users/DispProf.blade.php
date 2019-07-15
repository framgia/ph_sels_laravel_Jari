@extends('layouts.app')
@section('content')
@if(\Session::has('error'))
<div class='alert alert-danger'>
    {{\Session::get('error')}}
</div>
@endif
<div class='container'>

    <div class='row'>
        
        <div class='panel panel-default'>
            <div class='panel-heading'>Dashboard</div>

        </div>
    </div>
    <div class='row'>
        <div class='col-md-4 col-md-offset-4'>
            <div>{{$name}}</div>
            <a href="{{ URL::to('/profile/'.$user->id.'/follow') }}"> Follow User</a><br>
            <a href="{{ URL::to($user->id.'/unfollow') }}"> Unfollow User</a><br>
        </div>
        <div class='col-md-7'>
            <div><h2>Activities</h2></div>
                <br>
                @foreach($allActivities->take(6) as $activity)
                    @if($activity->action_type=='App\Follower')
                        {{$activity->user->name}}
                        {{$activity->content}}
                        <br>
                    
                    @elseif($activity->action_type=='App\Lesson')
                        {{$activity->user->name}} 
                        {{$activity->content}}
                        <br>
                    @endif
                @endforeach
 
        </div>
    </div>
    <div class='row'>
        <div class='..col-md-2 col-md-offset-2'>
            {{$user->followers()->count()}}<div>Followers</div>
        </div>
        <div class='.col-md-2 col-md-offset-8'>
            {{$user->followings()->count()}}<div>Following</div>
        </div>
    </div>
    </div>
</div>
@endsection