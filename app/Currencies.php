<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Currencies extends Model
{
    protected $table = 'currencies';


    public static function getRecordWithID($id)
    {
        return Currencies::where('id', '=', $id)->first();
    }
    public function country(){
        return $this->belongsTo('App\Country','country_id','id');
    }

}
