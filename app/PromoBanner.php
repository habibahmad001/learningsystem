<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PromoBanner extends Model
{
    protected $table = "promobanner";
    protected $dates = ['created_at','updated_at'];

    protected $fillable = [
        'id', 'content_type', 'content_area', 'content_status', 'content_link', 'bannerBG'
    ];
}
