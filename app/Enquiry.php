<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use App\UserSubscription;

class Enquiry extends Model
{
    protected $table = 'enquires';

    protected $fillable = ['Countrys', 'Subscribed'];

    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }

    public function courses()
    {
    	return $this->belongsTo('App\Course','course_id','id');
    }

    public static function insertSubscription($receivedData = '')
    {
        if(UserSubscription::where('email', $receivedData->email)->first()) {
            return false;
        }
        $UserSubscription               = new UserSubscription();

        $UserSubscription->first_name   = $receivedData->name;
        $UserSubscription->email        = $receivedData->email;

        if($UserSubscription->save())
            return true;
        else
            return false;
    }


}
