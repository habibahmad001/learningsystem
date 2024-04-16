<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CorporateEmail extends Model
{
    protected $table = "corporateEmail";
    protected $dates = ['created_at','updated_at'];

    protected $fillable = [
        'id', 'f_name', 'l_name', 'c_name', 'n_delegates', 'c_address', 'city', 'cs_region', 'zip_code', 'country', 'email', 'contact', 'training', 'expected', 'methods', 'message', 'status'
    ];
}
