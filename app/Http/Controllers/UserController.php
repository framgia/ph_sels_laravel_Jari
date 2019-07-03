<?php

namespace App\Http\Controllers;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Question;
use App\User;
use App\Category;
use App\Choices;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('check', ['only' => ['followUser','unFollowUser']]);
    }

    public function displayList()
    {
        $users = User::all();

        return view('users.DispUsers',compact('users')); 
    }
    
    public function show(User $userId)
    {
       
        $followers = $userId->followers;
        $followings = $userId->followings;
    }
    
    public function displayProfile(User $userId)
    {
        
        return view('users.DispProf',compact('userId')); 
    }

    public function followUser(User $profileId)
    {
        $currentUser = Auth::user();

        $profileId->followers()->attach($currentUser->id);
        return redirect()->back()->with('success', 'Successfully followed the user.');
    }

    public function unFollowUser(User $profileId)
    {
        
        $profileId->followers()->detach(auth()->user()->id);
        return redirect()->back()->with('success', 'Successfully unfollowed the user.');
    }
}
