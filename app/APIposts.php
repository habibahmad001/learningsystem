<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;

class APIposts extends Model
{

    public $timestamps = true;

    protected $table = 'postsapi';

    protected $dates = ['created_at','updated_at'];

	protected $fillable = ['id', 'title', 'description', 'img'];

}