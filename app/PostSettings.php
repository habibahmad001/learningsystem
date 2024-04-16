<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostSettings extends Model
{
   ////////////////////////////
    // Exam upload options //
    ////////////////////////////
    protected  $settings = array(
     'categoryImagepath'     	=> "public/uploads/blog/categories/",
        'contentImagepath'     	=> "public/uploads/blog/article/",
        'defaultCategoryImage'     => "default.png",
     'seriesImagepath'          => "public/uploads/blog/",
     'seriesThumbImagepath'     => "public/uploads/blog/thumb/",
     'defaultCategoryImage'     => "default.png",
     'imageSize'                => 700,
     'examMaxFileSize'          => 10000,
     'topper_percentage'        => 40
     );


    /**
     * This method returns the settings related to Library System
     * @param  boolean $key [For specific setting ]
     * @return [json]       [description]
     */
    public function getSettings($key = FALSE)
    {
    	if($key && array_key_exists($key,$settings))
    		return json_encode($this->settings[$key]);
    	return json_encode($this->settings);
    }

}
