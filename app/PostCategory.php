<?php

namespace App;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model
{
    protected $table = "posts_categories";
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
        return PostCategory::where('slug', '=', $slug)->first();
    }

    /**
     * Lists the list of quizes related to the selected category
     * @return [type] [description]
     */
   /* public function posts()
    {
        
        return $this->getQuizzes()
        ->where('start_date','<=',date('Y-m-d'))
        ->where('end_date','>=',date('Y-m-d'))
        ->where('total_questions','>','0')
        ->get();

        
    }*/

    public function getPosts()
    {
        return $this->hasMany('App\Post', 'category_id');

    }



}
