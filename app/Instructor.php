<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Instructor extends Model
{
    use HasSlug;
	protected $table = 'instructors';
	
    protected $fillable = [ 'user_id', 'fname', 'lname', 'email', 'dob', 'mobile', 'gender', 'detail', 'subject', 'file', 'image', 'uname', 'designation', 'rating', 'reviews', 'students', 'ncourses', 'introduction', 'baddress', 'status', ];
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['fname','lname'])
            ->saveSlugsTo('username');
    }
    public function courses()
    {
        return $this->hasMany('App\LmsSeries','user_id');

    }

    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    } 
}
