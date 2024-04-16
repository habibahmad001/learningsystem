<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LmsLevel extends Model
{
    protected $table = 'lmslevels';

 

    public static function getRecordWithSlug($slug)
    {
        return LmsLevel::where('slug', '=', $slug)->first();
    }

    public function courses() {

        $pros= $this->hasMany('App\LmsSeries', 'level_id', 'id');
        return $pros;
    }

//    public function contents()
//    {
//        return $this->hasMany('App\LmsContent', 'level_id');
//    }
}
