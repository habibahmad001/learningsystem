<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Auth;
use DB;
use \App;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserCourses extends Model
{
	protected $table = 'user_courses';
    use SoftDeletes;

    public static function getRecordWithSlug($slug)
    {
        return UserCourses::where('payment_slug', '=', $slug)->first();
    }


//    public function enrolledusers(){
//        return $this->belongsTo(User::class,'user_id')->select(array('name', 'email'));
//    }

//    public function enrolledcourses(){
//        return $this->belongsTo(LmsSeries::class,'item_id');
//    }
    public function enrolledusers(){
        return $this->belongsTo('App\User', 'user_id');
    }
    public function enrolledcourses(){
        return $this->belongsTo('App\LmsSeries', 'item_id');
    }


    public function payment(){
        return $this->belongsTo('App\Payment','payment_slug','slug');
    }

    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }

    public function courses()
    {
        return $this->belongsTo('App\LmsSeries','item_id','id');
    }

}
