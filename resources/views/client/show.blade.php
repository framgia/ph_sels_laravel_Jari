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
                <div class='panel-heading'>{{ auth()->user()->name }}</div>
                <h1>Clients</h1>
                <button type="submit" onclick=window.location='{{ url("/client/create") }}' class="button is-link btn btn-success">Create Client</button>
            </div>
        </div>   
    </div> 
            
    <br/>
    <div class='row border-top  border-bottom mb-4 p-1  '>
        <div class='col-sm-2'>
            <label class="label" for="name">Name</label>
        </div>

        <div class='col-sm-2'>
            <label class="label" for="email">Email</label>
        </div>

        <div class='col-sm-2'>
            <label class="label" for="Password">Password</label>
        </div>

        <div class='col-sm-2'>
            <label class="label" for="admin">Registered as Admin?</label>
        </div>
    </div>
</div>

@foreach ($clients as $client)
<div class='container mb-3'>
    
        <form class = "form-horizontal" method="POST" action= "/client/{{$client->id}}">
            @method('PATCH')
            @csrf
            <div class='row'>
                <div class = 'col-sm-2'>
                    <input type="text" class="input" name="name" placeholder="Name" value="{{ $client->name }}">
                </div>

                <div class = 'col-sm-2'>
                    <input name="email" class="input" placeholder="Email" value="{{ $client->email }}"></input>
                </div>

                <div class = 'col-sm-2'>
                    <input name="password" class="input" placeholder="Password" value="{{ $client->password }}"></input>
                </div>

                <div class = 'col-sm-2'>
                    <input type="hidden" id="{{ $client->id }}" name="admin" value=0 />
                    <input type="checkbox" id=" {{ $client->id }}" name="admin" value=1  @if($client->isAdmin) checked=checked @endif></input>
                </div>

                <div class='btn-group'>
                <div class = 'col-sm-2'>
                    <div>
                        <button type="submit" class="button is-link btn btn-primary">Update Client</button>
                    </div>
                </div>
                
            </div>
        </form>
        
        <form class = "form-horizontal" method="POST" action= "/client/destroy/{{$client->id}}">
            @method('DELETE')
            @csrf
                <div class="col-sm-2">
                    <div class="control">
                        <button type="submit" class="button is-link btn btn-danger">Delete Client</button>
                    </div>
                </div>
        </form>
    </div> 
</div>
@endforeach

@endsection
