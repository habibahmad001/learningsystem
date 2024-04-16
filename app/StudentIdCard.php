<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentIdCard extends Model
{
    protected $table = "studentidcard";
    protected $dates = ['created_at','updated_at'];

    protected $fillable = [
        'id', 'f_name', 'std_email', 'std_tel', 'std_dob', 'std_adInfo', 'std_address', 'std_address2', 'std_city', 'std_zipcode', 'std_country', 'img', 'payment_method', 'cost', 'status'
    ];
}
