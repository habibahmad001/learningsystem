<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Auth;
use DB;
use \App;

class PaymentCourses extends Model
{
	protected $table = 'payments_courses';


    public static function getRecordWithSlug($slug)
    {
        return PaymentCourses::where('payment_slug', '=', $slug)->first();
    }
    
}
