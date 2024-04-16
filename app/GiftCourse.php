<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GiftCourse extends Model
{
    protected $table= "giftcourse";
    protected $dates = ['created_at','updated_at'];

    protected $fillable = [
        'id', 'giftfname', 'giftemail', 'giftdate', 'giftmessage', 'course_id', 'user_id_to', 'user_id_from', 'status'
    ];


    public function course()
    {
        return $this->belongsTo('App\Course','course_id','id');
    }
}
