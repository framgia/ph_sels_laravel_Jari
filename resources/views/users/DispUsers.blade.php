@extends('layouts.app')
@section('content')
<div class='container'>
    @if(\Session::has('error'))
    <div class='alert alert-danger'>
    {{\Session::get('error')}}
    </div>
    @endif

    <!-- <div class='row'>
        <div class='col-md-8 col-md-offset-2'>
            <div class='panel panel-default'>
            <div class='panel-heading'><h4>Dashboard</h4></div>
                @foreach ($users as $user)
                    @if($user->isAdmin==0)
                        @if($user->id!=auth()->user()->id)

                            <h5><a href="{{ URL::to('/user/viewProfile/' . $user->id) }}"> {{$user->name}}</a></h5><br>
                        @endif
                    @endif
                @endforeach
            </div>
        </div>
    </div> -->

    <div class='container'>
        <div class='row-md-2'>
            <div class='col-md-8 col-md-offset-2'>
                <div class='panel panel-default'>
                    <h1>Users</h1>
                </div>
            </div>   
        </div> 
                
        <br/>
        <div class='row border-top  border-bottom mb-4 p-1  '>
            <div class='col-sm-2'>
                <label class="label" for="title">Avatar</label>
            </div>
            <div class='col-sm-2'>
                <label class="label" for="title">Name</label>
            </div>

            <div class='col-sm-2'>
                <label class="label" for="description">Email</label>
            </div>
        </div>
    </div>

    <div class='container border'>
        @foreach($users as $user)
            @if($user->isAdmin==0)
                @if($user->id!=auth()->user()->id)
                <div class='row mt-2 mb-2'>
                    <div class = 'col-sm-2'>
                        <img src="{{asset($user->profile_image) }}" class="rounded-circle" />
                    </div>

                    <div class = 'col-sm-2 mt-4'>
                        <a href="{{ URL::to('/user/viewProfile/' . $user->id) }}">{{$user->name}}</a>
                    </div>

                    <div class = 'col-sm-2 mt-4'>
                        {{$user->email}}
                    </div>
                </div>
                @endif
            @endif

        @endforeach
    </div>

@endsection
