<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;

class AdminController extends Controller
{
    public function create()
    {
        return view('client.create');
    }

    public function store(Request $request)
    {
        $attributes = ([
            'name' => $request->get('name'),
            'email' => $request->get('name'),
            'password' => Hash::make($request->get('password')),
            'isAdmin' => $request->get('admin'),
        ]);

        User::create($attributes);
        
        return redirect('/client/edit');
    }

    public function change()
    {
        $clients = User::all();

        return view('client.show',compact('clients')); 
    }

    public function edit($id)
    {
        $client = User::findOrFail($id);
        $client->name = request('name');
        $client->email = request('email');
        $client->password = request('password');

        $client->save();
        return redirect('/client/edit');
    }

    public function destroy($id)
    {
        User::find($id)->delete();
        
        return redirect('/client/edit');
    } 
}
