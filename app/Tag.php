<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table= "tags";

    public function category()
    {
        return $this->belongsTo('App\TagCategory', 'type','slug');
    }
    public static function getRecordWithID($id)
    {
        return Tag::where('id', '=', $id)->first();
    }

}
