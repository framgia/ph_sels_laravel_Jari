<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Activity extends Model
{
    protected $fillable = [
        'action_id','action_type','user_id','content'
    ];

    public function user()
    {

        return $this->belongsTo('App\User');
    }

    public function createActivity($data)
    {
        Activity::create([
            'action_id'=> $data['action_id'],
            'action_type'=>"App\Lesson",
            'user_id'=> $data['user_id'],
            'content'=> ' learned ' . $data['score'] . ' out of ' . $data['questionCount'] . ' from ' .  $data['title'] ,
        ]);
    }

    public function createActivityFollower()
    {
        $currentUser = Auth::user();
        $lastId= DB::table('followers')->orderBy('created_at','desc')->first()->id;
        $followedUser = $currentUser->followings->last()->name;

        Activity::create([
            'action_id'=> $lastId,
            'action_type'=> "App\Follower",
            'user_id'=> $currentUser->id,
            'content'=> ' followed ' . $followedUser,
        ]);
    }   
}
