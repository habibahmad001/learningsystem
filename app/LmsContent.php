<?php

namespace App;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use App\LmsSeriesData;
class LmsContent extends Model
{
    protected $table = 'lmscontents';

    use HasSlug;

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public static function getRecordWithSlug($slug)
    {
        return LmsContent::where('slug', '=', $slug)->first();
    }

    public static function getSectionWithContentId($id)
    {
        return LmsSeriesData::where('lmscontent_id', '=', $id)->first();
    }


    public function category()
    {
        return $this->belongsTo('App\Lmscategory', 'category_id');
    }


}
