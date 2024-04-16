<?php

namespace App;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use App\Faq;

class FaqCategory extends Model
{
    protected $table="faqcategories";
    use HasSlug;

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('category')
            ->saveSlugsTo('slug');
    }

    public static function getRecordWithSlug($slug)
    {
        return FaqCategory::where('slug', '=', $slug)->first();
    }

    public function getFaqs()
    {
    	return $this->hasMany(Faq::class, 'category_id', 'id');
    }
}
