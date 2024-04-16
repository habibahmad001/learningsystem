<?php

namespace App;
use Illuminate\Support\Facades\App;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use DB;

class LmsSeries extends Model
{


   protected $table = 'lmsseries';
   use HasSlug;
    use \Spatie\Tags\HasTags;

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
        return LmsSeries::where('slug', '=', $slug)->first();
    }

    /**
     * This method lists all the items available in selected series
     * @return [type] [description]
     */
    public function contents(){
    return $this->belongsToMany('App\LmsContent', 'lmsseries_data', 'lmsseries_id', 'lmscontent_id');
}
    public function getContents()
    {
        return DB::table('lmsseries_data')
          ->join('lmscontents', 'lmscontents.id', '=', 'lmscontent_id')
            ->where('lmsseries_id', '=', $this->id)->get();
    }


    public static function getFreeSeries($limit=0)
    {
        
        $records  = LmsSeries::where('show_in_front',1)
                                ->groupby('lms_category_id')
                                ->inRandomOrder()
                                ->pluck('lms_category_id')
                                ->toArray();
        if($limit > 0){
            
          $lms_cats  = LmsCategory::whereIn('id',$records)->limit(10)->get();
        }
        else{

          $lms_cats  = LmsCategory::whereIn('id',$records)->get();

        }
        return $lms_cats;                      

    }


    public function viewContents($limit= '')
{

    $contents_data   = LmsSeriesData::where('lmsseries_id',$this->id)
        ->pluck('lmscontent_id')
        ->toArray();

    if($contents_data){

        if($limit!=''){

            $contents  = LmsContent::whereIn('id',$contents_data)->paginate($limit);
        }else{
            $contents  = LmsContent::whereIn('id',$contents_data)->get();

        }

        if($contents)
            return $contents;

        return FALSE;

    }

    return FALSE;


}

    public function viewSections($limit= '')
    {

        $contents_data   = LmsSeriesData::where('lmsseries_id',$this->id)
            ->pluck('section_id')
            ->toArray();

        if($contents_data){

            if($limit!=''){

                $contents  = LmsSeriesSections::whereIn('id',$contents_data)->paginate($limit);
            }else{
                $contents  = LmsSeriesSections::whereIn('id',$contents_data)->get();

            }

            if($contents)
                return $contents;

            return FALSE;

        }

        return FALSE;


    }
    public function sections()
    {
        return $this->hasMany('App\LmsSeriesSections', 'lmsseries_id');
    }

//    public function exams()
//    {
//        return $this->belongsToMany('App\Quiz', 'lmsseries_exams',
//            'lmsseries_id', 'exam_quiz_id');
//    }

    public function exams()
    {
//        return $this->belongsToMany('App\Quiz', 'lmsseries_exams',
//            'lmsseries_id', 'exam_quiz_id')
//            ->withPivot('exam_type', 'section_id')
//            ->withTimestamps();

        return DB::table('lmsseries_exams')
            ->join('quizzes', 'quizzes.id', '=', 'exam_quiz_id')
            ->select('quizzes.*','lmsseries_exams.exam_type' )
            ->where('lmsseries_id', '=', $this->id)
            ->where('section_id', '=', 0)
            ->get();
       // return $this->hasMany('App\LmsSeriesExams', 'lmsseries_id');
    }
    public function instructor()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function getinstructor($uid)
    {
        return \App\User::where('id', $uid)->first();
    }

    public function accreditedby()
    {
        return $this->belongsTo('App\AwardingBodies', 'accredited_by');
    }

    public function level()
    {
        return $this->belongsTo('App\LmsLevel', 'level_id');
    }

    public function reviews()
    {
        return $this->hasMany('App\Review', 'course_id');
    }

    public function userReviews()
    {
        return $this->belongsToMany('App\User', 'reviews',
            'course_id', 'user_id')
            ->withPivot('rating', 'comment', 'review_title')
            ->withTimestamps();
    }
    public function usersEnrolled()
    {
        return $this->belongsToMany('App\User', 'user_courses',
            'item_id', 'user_id')
            ->withPivot('item_name', 'item_price')
            ->withTimestamps();
    }
}
