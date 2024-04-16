<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{

    /**
     * Convert the model instance to an array.
     *
     * @return array
     */


    protected $table = 'questions';

    protected $fillable = [
        'course_id', 'user_id', 'instructor_id', 'question', 'status'
    ];

    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }
    
    public function courses()
    {
    	return $this->belongsTo('App\LmsSeries','course_id','id');
    }

    public function instructor()
    {
      return $this->belongsTo('App\User','instructor_id','id');
    }

    public static function scopeSearch($query, $searchTerm)
    {
        return $query->where('question', 'like', '%' .$searchTerm. '%');
    }
}
