<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AwardingBodies extends Model
{
    protected $table = 'accredited_by';

 

    public static function getRecordWithSlug($slug)
    {
        return AwardingBodies::where('slug', '=', $slug)->first();
    }

//    public function contents()
//    {
//        return $this->hasMany('App\LmsContent', 'level_id');
//    }
}
