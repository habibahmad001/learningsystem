<?php

namespace App;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Post extends Model
{
    //
    protected $table= "posts";
    use SoftDeletes;
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

    protected $dispatchesEvents=[
        'created'=>Events\PostCreated::class
    ];

    public static function getRecordWithSlug($slug)
    {
        return Post::where('slug', '=', $slug)->first();
    }


    public function user()
    {
        return $this->belongsTo('App\User')->withDefault();
    }

    public function author()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
    public function category(){
        return $this->belongsTo('App\PostCategory','category_id','id');
    }


}
