<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LmsSettings extends Model
{
     protected  $settings = array(
     'awardingbodyImagepath'    => UPLOADS."lms/awardingbodies/",
     'categoryImagepath'        => UPLOADS."lms/categories/",
     'contentImagepath'     	=> UPLOADS."lms/content/",
     'seriesVideopath'          => UPLOADS."lms/series/videos/",
     'seriesAssignmentpath'     => UPLOADS."lms/series/assignments/",
     'markettingbanner'         => UPLOADS."lms/series/markettingbanner/",
     'allcourse'                => UPLOADS."lms/series/allcourse/",
     'offerbanner'              => UPLOADS."lms/series/offerbanner/",
     'seriesImagepath'          => UPLOADS."lms/series/",
     'seriesThumbImagepath'     => UPLOADS."lms/series/thumb/",
     'seriesWidgetImagepath'    => UPLOADS."lms/series/widget/",
     'defaultCategoryImage'     => "default.png",
     'imageSize'                => 700,
     'examMaxFileSize'          => 10000,
     'content_types'            => array(
                                    'file' => 'File',
                                    'video' => 'Video File',
                                    'audio' => 'Audio File',
//                                    'video_url' => 'Video URL',
                                    'iframe' => 'Iframe',
                                    'audio_url' => 'Audio URL',
                                    'url' => 'URL'
                                    )
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
