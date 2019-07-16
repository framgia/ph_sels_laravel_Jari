<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Activity;
use App\Lesson;
use App\Answer;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'isAdmin','profile_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function followers()
    {
        return $this->belongsToMany(User::class, 'followers', 'leader_id', 'follower_id')->withTimestamps();
    }

    public function followings()
    {
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'leader_id')->withTimestamps();
    }

    public function getId()
    {
        return $this->id;
    }

    public function answer()
    {
        
        return $this->hasManyThrough('App\Answer','App\Lesson','user_id', 'lesson_id');
    }

    public function lesson()
    {
     
        return $this->hasMany('App\Lesson');
    }

    public function activity()
    {
        return $this->hasMany('App\Activity');
    }

    public function category()
    {
  
        return $this->hasManyThrough('App\Category','App\Lesson','user_id', 'lesson_id');
    }

    public function getImageAttribute()
    {
        return $this->profile_image;
    }
}
