<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{

    /**
     * Convert the model instance to an array.
     *
     * @return array
     */


    protected $table = 'answers';
    
    protected $fillable = ['instructor_id', 'ans_user_id', 'ques_user_id', 'course_id', 'question_id', 'answer', 'status',];

    public function user()
    {
      return $this->belongsTo('App\User', 'ans_user_id','id');
    }
    
    public function courses()
    {
    	return $this->belongsTo('App\LmsSeries','course_id','id');
    }

    public function question()
    {
    	return $this->belongsTo('App\Question','question_id','id');
    }
}
