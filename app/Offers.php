<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offers extends Model
{
    protected $table= "spaicaloffers";
    protected $dates = ['created_at','updated_at'];

    protected $fillable = [
        'id', 'offer_name', 'offer_keys', 'offer_Activate', 'offer_status', 'slug', 'offer_Type', 'url', 'avatar', 'mobavatar', 'contentarea', 'introText', 'Cat', 'NoOfCourse', 'price', 'PercentAge'
    ];
}
