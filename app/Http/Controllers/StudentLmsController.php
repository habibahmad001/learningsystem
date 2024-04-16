<?php
namespace App\Http\Controllers;
use \App;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\LmsCategory;
use App\LmsContent;
use App\LmsSeries;
use App\Wishlist;
use Yajra\Datatables\Datatables;
use DB;
use Auth;
use Image;
use ImageSettings;
use File;
use Response;
class StudentLmsController extends Controller
{
     public function __construct()
    {
    	$this->middleware('auth');
    }


     /**
     * Listing method
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
      if(checkRole(getUserGrade(8)))
      {
        return back();
      }
        $data['active_class']       = 'my-courses';
        $data['title']              = 'LMS'.' '.getPhrase('categories');
        $data['layout']              = getLayout();
        $data['categories']         = [];
        $user = Auth::user();
        $interested_categories      = null;
        if($user->settings)
        {
          $interested_categories =  json_decode($user->settings)->user_preferences;
        }
        
        if($interested_categories)    {
         if(count($interested_categories->lms_categories))
        $data['categories']         = Lmscategory::
                                      whereIn('id',(array) $interested_categories->lms_categories)
                                      ->paginate(getRecordsPerPage());
        }
        
        $data['user'] = $user;
        // return view('student.lms.categories', $data);

              $view_name = getTheme().'::student.lms.categories';
        return view($view_name, $data);

    }

    public function viewCategoryItems($slug)
    {
        $record = LmsCategory::getRecordWithSlug($slug); 

        
        if($isValid = $this->isValidRecord($record))
          return redirect($isValid); 

         $data['active_class']       = 'my-courses';
         $data['user']               = Auth::user();
        $data['title']              = 'LMS'.' '.getPhrase('series');
        $data['layout']             = getLayout();
        $data['series']             = LmsSeries::where('lms_category_id','=',$record->id)
                                        ->where('start_date','<=',date('Y-m-d'))
                                        ->where('end_date','>=',date('Y-m-d'))        
                                        ->paginate(getRecordsPerPage());
        // return view('student.lms.lms-series-list', $data);



            $view_name = getTheme().'::student.lms.lms-series-list';
        return view($view_name, $data);
    }

    /**
     * This method displays the list of series available
     * @return [type] [description]
     */
    public function courses()
    {
//        if(checkRole(getUserGrade(8)))
//      {
//        return back();
//      }
        $data['record']         	= FALSE;
        $data['active_class']       = 'my-courses';
        $data['title']              = 'LMS'.' '.getPhrase('series');
        $data['layout']             = getLayout();
        $data['series']             = [];

    $user = Auth::user();
   /* $interested_categories      = null;
    if($user->settings)
    {
      $interested_categories =  json_decode($user->settings)->user_preferences;
    }
    if($interested_categories){*/
   // if(count($interested_categories->lms_categories))
       // Product::with('skus')->get();
      //  $data['series']             = App\User::with('courses')->where('id','==',$user)->paginate(getRecordsPerPage());
    //}
    $data['user']               = $user;




       $data['series']=$user->courses;
    // return view('student.lms.lms-series-list', $data);
 //dd($user->courses);
      $view_name = getTheme().'::student.lms.lms-series-list';
        return view($view_name, $data);
        
    }

    public function wishlists()
    {
        if(checkRole(getUserGrade(7)))
        {
//            return back();
            return redirect()->back();
        }
        $data['record']         	= FALSE;
        $data['active_class']       = 'wishlists';
        $data['title']              = 'My Wishlists';
        $data['layout']             = getLayout();
        $data['series']             = [];

        $user = Auth::user();

        $data['user']               = $user;



        //exit(Auth::user());
        // $data['series']=$user->wishlists;
        // DB::enableQueryLog();
        $data['series'] = Wishlist::join('lmsseries', 'wishlists.course_id', '=', 'lmsseries.id')
                                                        ->select('*')
                                                        ->where('wishlists.user_id', '=', Auth::user()->id)
                                                        ->orderBy('lmsseries.id', 'desc')
                                                        ->get();
        // $query = DB::getQueryLog();
        // print_r($query);
        // exit(print_r($data['series']));
        // return view('student.lms.lms-series-list', $data);
        //dd($user->courses);
        $view_name = getTheme().'::student.lms.wishlists';
        return view($view_name, $data);

    }

    public function storeReview(Request $request)
    {
        if(!checkRole(getUserGrade(5)))
        {
            prepareBlockUserMessage();
            return back();
        }

//dd($request);
$user_id=Auth::user()->id;
        $record=App\Review::where('course_id', '=', $request->course_id)
            ->where('user_id', '=', $user_id)
            ->first();
 if(!$record) {
     $record = new App\Review();
 }


        $record->course_id 				= $request->course_id;
        $record->rating 				= $request->stars_rating;
        $record->comment 				= $request->description;
        $record->review_title 				= $request->review_title;
        $record->approved 				= 1;



        $record->user_id 	= $user_id;
        $record->save();
        //echo $record->id;

        flash('success','record_updated_successfully', 'success');
         return redirect(URL_STUDENT_LMS_SERIES);
    }

    public function storeComment(Request $request)
    {
        $record = new App\Comment();

        $record->course_id = $request->course_id;
        $record->section_id = $request->section_id;
        $record->content_id = $request->content_id;
        $record->comment = $request->message;
        $record->course_title = $request->course_title;
        $record->course_slug= $request->course_slug;
$user=Auth::user();
        if($user) {
            $record->user_id = $user->id;
        }
        $record->save();
        //  DB::commit();
        $section=App\LmsSeriesSections::where('id', '=', $request->section_id)->first();
        $content=App\LmsContent::where('id', '=', $request->content_id)->first();

        sendEmail('contentcomment', array('name'=> $user->name,
            'to_email' => $user->email,
            'phone' => $user->phone,
            'send_to' => 'admin',
            'slug' => $request->course_slug,
            'section' => $section->section_name,
            'content' => $content->title,
            'subject' => $request->course_title,
            'message' => $request->message,'url' => BASE_PATH ));


        return response()->json(['success'=>true,'title'=>'Congratulations!', 'message'=>'Thanks! Our team will contact you soon']);

    }

    public function series()
    {
        if(checkRole(getUserGrade(8)))
      {
        return back();
      }

        $data['active_class']       = 'my-courses';
        $data['title']              = 'LMS'.' '.getPhrase('series');
        $data['layout']             = getLayout();
        $data['series']             = [];

    $user = Auth::user();
    $interested_categories      = null;
    if($user->settings)
    {
      $interested_categories =  json_decode($user->settings)->user_preferences;
    }
    if($interested_categories){
    if(count($interested_categories->lms_categories))
        $data['series']             = LmsSeries::
                                        where('start_date','<=',date('Y-m-d'))
                                        ->where('end_date','>=',date('Y-m-d'))
                                        ->whereIn('lms_category_id',(array) $interested_categories->lms_categories)
                                        ->paginate(getRecordsPerPage());
    }
    $data['user']               = $user;

    // return view('student.lms.lms-series-list', $data);

      $view_name = getTheme().'::student.lms.lms-series-list';
        return view($view_name, $data);

    }

      /**
     * This method displays all the details of selected exam series
     * @param  [type] $slug [description]
     * @return [type]       [description]
     */
    public function viewItem($slug, $content_slug='')
    {



//        if(checkRole(getUserGrade(8)))
//        {
//            return back();
//        }
        $record = LmsSeries::getRecordWithSlug($slug); 

        if($isValid = $this->isValidRecord($record))
          return redirect($isValid);  
        $content_record = FALSE;
        if($content_slug) {
          $content_record = LmsContent::getRecordWithSlug($content_slug);
          if($isValid = $this->isValidRecord($content_record))
          return redirect($isValid);  
        }


        if($content_record){
            if($record->is_paid) {
            if(!isItemPurchased( $record->id, 'lms'))
            {
                prepareBlockUserMessage();
                return back();
            }
        }
        }

     //   dd($slug.'-|||||||||||||||||-'.$content_slug);


        $lms_series=$record;
        $lms_sections = App\LmsSeriesSections::where('lmsseries_id',$lms_series->id)->get();
        $contents     = $lms_series->viewContents(9);
        $sections     = $lms_series->viewSections(9);

         $data['lms_series']     = $lms_series;
         $data['contents']     = $contents;
        //$data['sections']     = $lms_series->sections;
        $data['sections']     = $sections;
        $data['lms_sections']     = $lms_sections;
        $data['awardingbody']     = $lms_series->accreditedby;
        $data['announsments'] = App\Announcement::where('course_id','=',$lms_series->id)->get();
//        $data['awardingbody']$reports = ReportReview::where('course_id','=',$lms_series->id)->get();
        $data['questions'] = App\Question::where('course_id','=',$lms_series->id)->get();
        $data['coursequestions'] = $data['questions'];
        $data['assignment'] = App\Assignment::where('course_id','=',$lms_series->id)->where('user_id', Auth::User()->id)->get();
        $data['certificate'] = App\Certificate::where('course_id','=',$lms_series->id)->where('user_id', Auth::User()->id)->first();

        $data['active_class']       = 'my-courses';
        $data['pay_by']             = '';
        $data['title']              = $record->title;
        $data['item']               = $record;
        $data['content_record']     = $content_record;
    
        $data['layout']              = getLayout();

       // return view('student.lms.series-view-item', $data);
       // dd($data);
          $view_name = getTheme().'::student.lms.series-view-item';
        return view($view_name, $data);
    }

    public function verifyPaidItem($slug, $content_slug)
    {

      if(!checkRole(getUserGrade(5)))
      { 
        prepareBlockUserMessage();
        return back();
      }
        $record = LmsSeries::getRecordWithSlug($slug); 
        
        if($isValid = $this->isValidRecord($record))
          return redirect($isValid);  
       
          $content_record = LmsContent::getRecordWithSlug($content_slug);
          
          if($isValid = $this->isValidRecord($content_record))
          return redirect($isValid);  
     
         if($content_record){

            if($record->is_paid) {
              
            if(!isItemPurchased($record->id, 'lms'))
            {
                return back();
            }
            else{
             
             $pathToFile= "public/uploads/lms/content"."/".$content_record->file_path;
              
              return Response::download($pathToFile);

            }
          }

          else{
            $pathToFile= "public/uploads/lms/content"."/".$content_record->file_path;
              
              return Response::download($pathToFile);
          }
        }
        else{
          flash('Ooops','File Does Not Exit','overlay');
          return back();
        }


    }

    public function content(Request $request, $req_content_type)
    {
    	$content_type = $this->getRequestContentType($req_content_type);
    	$category = FALSE;

    	$query = LmsContent::where('content_type', '=', $content_type)
    						->where('is_approved',1);

    	if($request->has('category')){
    		$category = $request->category;
    		$category_record = Lmscategory::getRecordWithSlug($category);
    		$query->where('category_id',$category_record->id);
    	}
    	
    	$data['category'] = $category;
    	$data['content_type'] = $req_content_type;

    	$data['list'] = $query->get();
    	// dd($data['list']);
    	$data['active_class']       = 'my-courses';
        $data['title']              = $req_content_type;
        $data['categories']         = Lmscategory::all();
        // return view('student.lms.content-categories', $data);

              $view_name = getTheme().'::student.lms.content-categories';
        return view($view_name, $data);
    }

    public function getRequestContentType($type)
    {
    	if($type == 'video-course' || $type == 'video-courses')
    		return 'vc';
    	if($type == 'community-links')
    		return 'cl';
    	return 'sm';
    }

    public function getContentTypeFullName($type)
    {
    	if($type=='sm')
    		return 'study-materal';
    	if($type=='vc')
    		return 'video-courses';
    	return 'community-links';
    }

    public function showContent($slug)
    {

    	$record = Lmscontent::getRecordWithSlug($slug);
    	if($isValid = $this->isValidRecord($record))
    		return redirect($isValid);


    	$data['active_class']       = 'my-courses';
	    $data['title']              = $record->title;
	    $data['category']           = $record->category;
	    $data['record']             = $record;
	    
	    $data['content_type'] 		= $this->getContentTypeFullName($record->content_type);
 		$data['series'] 			= array();
 		if($record->is_series){
 			$parent_id = $record->id;
 			
 			if($record->parent_id != 0)
 				$parent_id = $record->parent_id;
 			$data['series'] 		= LmsContent::where('parent_id', $parent_id)->get();
 		}
 		
		// return view('student.lms.show-content', $data); 

     $view_name = getTheme().'::student.lms.show-content';
        return view($view_name, $data);


    	 

    }

     public function isValidRecord($record)
    {
    	if ($record === null) {

    		flash('Ooops...!', getPhrase("page_not_found"), 'error');
   			return $this->getRedirectUrl();
		}

		return FALSE;
    }

    public function getReturnUrl()
    {
    	return URL_LMS_CONTENT;
    }
    public function getRedirectUrl()
    {
        return URL_LMS_CONTENT;
    }
    

}
