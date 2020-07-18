<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Result;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $allActivities = collect();
        $followingActivities =collect();
        $user = Auth()->user();
        $userActivities = Auth()->user()->activity;
        $followings = $user->followings;

        if($user->followings){
            foreach($followings as $following){
                foreach($following->activity as $activity){
                    $allActivities->push($activity);
                }
            }
        }

        foreach($userActivities as $userActivity){

            $allActivities->push($userActivity);
        }

        $wordsLearned = 0;
        $currentUserId = auth()->user()->id;
        $results= Result::where('user_id','=',$currentUserId )->get();
        for($i=0;$i<$results->count();$i++){
            $wordsLearned = $wordsLearned+ $results[$i]->score;
        }

        return view('home',compact('allActivities','wordsLearned'));
    }
    public function admin()
    {
        return view('admin'); 
    }
}
