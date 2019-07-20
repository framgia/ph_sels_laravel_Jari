@extends('layouts.app')
@section('content')
@if(\Session::has('error'))
<div class='alert alert-danger'>
    {{\Session::get('error')}}
</div>
@endif
<div class='container'>
    <div class='row-md-2'>
        <div class='col-md-8 col-md-offset-2'>
            <div class='panel panel-default'>
                <h1>Followers</h1>
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
    @foreach($followers as $follower)

        <div class='row mt-2 mb-2'>
            <div class = 'col-sm-2'>
                <img src="{{asset($follower->profile_image) }}" class="rounded-circle" />
            </div>

            <div class = 'col-sm-2 mt-4'>
                {{$follower->name}}
            </div>

            <div class = 'col-sm-2 mt-4'>
                {{$follower->email}}
            </div>
        </div>
    @endforeach
</div>
@endsection