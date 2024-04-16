<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiscussionAnswer extends Model
{
    protected $table= "answers";

    public static function getRecordWithId($slug)
    {
        return DiscussionAnswer::where('id', '=', $slug)->first();
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
