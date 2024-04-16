<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{

    protected $table = "certificates";
    protected $dates = ['created_at','updated_at'];
     protected $fillable = ['user_id', 'course_id','user_name','user_email','user_phone','reed_course_name','certificate_code','course_type','certificate_file','generated_date','payment_type','status'];

//    protected $fillable = [
//        'id', 'user_id', 'course_id', 'std_tel', 'std_dob', 'std_adInfo', 'std_address', 'std_address2', 'std_city', 'std_zipcode', 'std_country', 'img', 'card_name', 'card_number', 'card_cvv', 'card_expm', 'card_expy', 'payment_method', 'cost', 'status'
//    ];

    //
}
