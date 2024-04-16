<?php

namespace App;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;

class TagCategory extends Model
{
    protected $table= "tag_categories";
    use HasSlug;

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('category')
            ->saveSlugsTo('slug');
    }

    public static function getRecordWithSlug($slug)
    {
        return TagCategory::where('slug', '=', $slug)->first();
    }

}
