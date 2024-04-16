<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table= "reviews";

    public static function getRecordWithId($slug)
    {
        return Review::where('id', '=', $slug)->first();
    }

    public function user()
    {
        return $this->belongTo('App\User', 'id', 'user_id');
    }

    public function event()
    {
        return $this->belongTo('App\LmsSeries', 'id', 'course_id');
    }


    //
}
