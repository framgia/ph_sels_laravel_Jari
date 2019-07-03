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
                    <a href="{{ URL::to('/user/' . $user->id) }}"> {{$user->name}}</a><br>
                @endforeach
            </div>
        </div>
    </div>
@endsection
