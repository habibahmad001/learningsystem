<?php

namespace App;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use App\LmsSeries;

class LmsCategory extends Model
{
    protected $table = 'lmscategories';
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
        return LmsCategory::where('slug', '=', $slug)->first();
    }

    public function contents()
    {
        return $this->hasMany('App\LmsContent', 'category_id');
    }
    public function children()
    {
        return $this->hasMany('App\LmsCategory', 'parent_id');
    }

    // recursive, loads all descendants
    public function childrenRecursive()
    {
        return $this->children()->with('childrenRecursive');
        // which is equivalent to:
        // return $this->hasMany('Survey', 'parent')->with('childrenRecursive);
    }

// parent
    public function parentCategory()
    {
        return $this->belongsTo('App\LmsCategory','parent_id');
    }

// all ascendants
    public function parentRecursive()
    {
        return $this->parentCategory()->with('parentRecursive');
    }
    public function products() {
//        $pros= LmsSeries::where([['status','=', 1],['lms_category_id','=', $this->id]])
//            ->orWhere([['status','=', 1],['lms_parent_category_id','=', $this->id]])
//            ->get();

       $pros= $this->hasMany('App\LmsSeries', 'lms_parent_category_id', 'id')->where('lmsseries.status','=',1);

        return $pros;
    }
       public function products2() {
        $pros= $this->hasMany('App\LmsSeries', 'lms_category_id', 'id')->where('lmsseries.status','=',1);

        return $pros;
    }
    public function countCourses() {
        $pros= $this->hasMany('App\LmsSeries', 'lms_parent_category_id', 'id')->where('lmsseries.status','=',1);

        return $pros;
    }


    public function childrenRecursiveIds() {
        return  $this->childrenRecursive()->pluck('id');
    }

    /*public function productsRecursive() {
        $products = App\LmsSeries::whereIn('lms_category_id', $category_ids)->get();

        return $products;
    }*/

}
