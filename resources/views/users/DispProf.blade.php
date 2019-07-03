@extends('layouts.app')
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
                <div class='panel-heading'>Dashboard</div>
                    
                    <a href="{{ URL::to('/profile/'.$userId->id.'/follow') }}"> Follow User</a><br>
                    <a href="{{ URL::to($userId->id.'/unfollow') }}"> Unfollow User</a><br>

                    <div>Followers</div>{{$userId->followers()->count()}}
                    <div>Following</div>{{$userId->followings()->count()}}
            </div>
        </div>
    </div>
@endsection