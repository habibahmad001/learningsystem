<?php

namespace App;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use App\FaqCategory;

class Faq extends Model
{
    use HasSlug;

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('question')
            ->saveSlugsTo('slug');
    }

    public static function getRecordWithSlug($slug)
    {
        return Faq::where('slug', '=', $slug)->first();
    }

    public function getFaqCategory()
    {
    	return $this->belongsTo(FaqCategory::class, 'category_id');
    }

    public static function getFaqCategories()
    {
    	return FaqCategory::where('status', 1)->pluck('category', 'id');
    }
}
