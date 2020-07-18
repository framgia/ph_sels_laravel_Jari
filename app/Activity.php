<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
            'content'=> ' learned ' . $data['score'] . ' out of ' . $data['questionCount'] . ' words from ' .  $data['title'] ,
        ]);
    }
}
