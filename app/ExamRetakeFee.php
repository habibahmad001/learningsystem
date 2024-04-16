<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExamRetakeFee extends Model
{

    protected $table = "exam_retake_fee";

    public static function checkRetakeFee($courseid, $quizid, $userid)
    {
        $coupon_record = ExamRetakeFee::where('course_id', '=', $courseid)
            ->where('quiz_id','=',$quizid)
            ->where('user_id','=',$userid)
            ->where('attempt_status','=','no')
            ->first();
        if(!$coupon_record)
            return FALSE;
        else{
            return true;
        }


    }
}
