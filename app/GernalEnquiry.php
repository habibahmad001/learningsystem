<?php

namespace App;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

use Illuminate\Database\Eloquent\Model;

class GernalEnquiry extends Model
{
    use HasSlug;

    protected $table= "lmsgernalenquiry";
    protected $dates = ['created_at','updated_at'];
    public $timestamps = true;

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    protected $fillable = [
        'id', 'title', 'slug', 'user_id', 'content_type', 'content_data', 'status'
    ];
}
