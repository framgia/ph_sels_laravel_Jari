<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'term', 'category_id'
    ];

    public function getChoices()
    {
        return $this->hasMany('App\Choices');
    }

    public function getCount()
    {
        return $this->hasMany('App\Choices')->count();
    }

    public function getAnswers()
    {
        return $this->hasMany('App\Answer');
    }
}
