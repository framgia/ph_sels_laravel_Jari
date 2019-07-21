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
        </div>   
    </div> 

    <h1>Create a new client</h1>
    <form method="POST" action="/client/store">
        @csrf
        <div class ="field">
            <label class="label" for="client">Client Name</label>
            <br/>
            
            <input type= "text" name="name" placeholder="Name" value="{{old('name')}}">
        </div>
        <br/>
        <div class="field">
            <label name="label" for="email">Email</label>
            <br/>
            <input type="text" name ="email" placeholder="Email" value="{{old('email')}}"></input>
        </div>    
        </br>
        <div class="field">
            <label for="password">Password</label>
            </br>
            <input id="password" type="password" name="password" required >
      
        </div>
        </br>
        <div class="field">
            <input type="hidden" id="admin" name="admin" value=0 />
            <input type="checkbox" id="admin" name="admin" value=1 />Register as Admin?
        </div>

        <div>
            <button type="submit" class="button is-link btn btn-success">Create Client</button>
        </div>
        <!-- @if ($errors->any())
        <div class= "notification is-danger">
        
            <ul>

                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        
        </div>
        @endif -->
    </form>
@endsection
