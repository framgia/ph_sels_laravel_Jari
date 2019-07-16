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
                @foreach ($users as $user)
                    @if($user->isAdmin==0)
                        @if($user->id!=auth()->user()->id)
                            <a href="{{ URL::to('/user/viewProfile/' . $user->id) }}"> {{$user->name}}</a><br>
                        @endif
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@endsection
