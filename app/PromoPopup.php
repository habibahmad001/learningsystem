<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PromoPopup extends Model
{
    protected $table = "promopopup";
    protected $dates = ['created_at','updated_at', 'PromotionStart', 'PromotionEnd'];

    protected $fillable = [
        'id', 'PromotionName', 'PromotionType', 'PromotionContent', 'PromotionStatus', 'PromotionDisplay', 'PromotionCustom', 'imglink', 'PromotionCourses'
    ];
}
