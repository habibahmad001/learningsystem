<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use \App;
use App\Subject;
use App\LmsSeries;
use App\LmsSeriesSections;
use App\LmsLevel;
use function MongoDB\BSON\toJSON;
use Yajra\Datatables\Datatables;
use DB;
use Auth;
use Image;
use ImageSettings;
use File;
use Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class LmsSeriesController extends Controller
{
	 public function __construct()
    {
    	$this->middleware('auth');
     

    }

    /**
     * Course listing method
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function index($slug='')
    {
      if(!checkRole(getUserGrade(2)))
      {
        prepareBlockUserMessage();
        return back();
      }

        $data['active_class']       = 'lms';
        $data['title']              = 'LMS'.' '.getPhrase('courses');
    	// return view('lms.lmsseries.list', $data);
        $data['layout'] = getLayout();
        if($slug!=''){
            $data['slug'] = $slug;
        }else{
            $data['slug']=null;
        }

          $view_name = getTheme().'::lms.lmsseries.list';
        return view($view_name, $data);
    }


    /**
     * This method returns the datatables data to view
     * @return [type] [description]
     */
    public function getDatatable($slug='')
    {

      if(!checkRole(getUserGrade(2)))
      {
        prepareBlockUserMessage();
        return back();
      }

        $records = array();



            $records = LmsSeries::select(['title', 'image', 'status', 'cost', 'discount_price', 'is_paid', 'validity',  'total_items','slug', 'id', 'updated_at'])
            ->orderBy('updated_at', 'desc');
        $role = getRole();
        if($role=="instructor" ){
                $records = $records->where('user_id', Auth::user()->id);
            }

        if($slug!="all"){
            $records = $records->where('user_id', $slug);
        }




        return Datatables::of($records)
            ->addColumn('check_course', function ($records) {

                 $link_data1 = '<input name="checkbox_course[]" type="checkbox" class="delete_check" id="delcheck_'.$records->id.'"   value="'.$records->id.'">';

                return $link_data1;
            })
        ->addColumn('action', function ($records) {
         
          $link_data = '<div class="dropdown more">
                        <a id="dLabel" type="button" class="more-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-dots-vertical"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dLabel">
                           <li><a href="'.URL_LMS_SERIES_ADDSECTIONS.$records->slug.'"><i class="fa fa-pencil"></i>'.getPhrase("Manage_sections").'</a></li>
                            <li><a href="'.URL_LMS_SERIES_UPDATE_SERIES.$records->slug.'"><i class="fa fa-spinner"></i>'.getPhrase("manage_contents").'</a></li>
                            <li><a href="'.URL_LMS_SERIES_UPDATE_EXAMS.$records->slug.'"><i class="fa fa-spinner"></i>'.getPhrase("manage_exams").'</a></li>
                            <li><a href="'.URL_LMS_SERIES_EDIT.$records->slug.'"><i class="fa fa-pencil"></i>'.getPhrase("edit").'</a></li>';

                           $temp = '';
                           if(checkRole(getUserGrade(1))) {
                               $temp .= ' <li><a href="javascript:void(0);" onclick="deleteRecord(\''.$records->slug.'\');"><i class="fa fa-trash"></i>'. getPhrase("delete").'</a></li>';
                           }
                    
                    $temp .='</ul></div>';


                    $link_data .=$temp;
            return $link_data;
            })
        ->editColumn('title', function($records)
        {
        	return '<a target="_blank" href="'.URL_VIEW_LMS_CONTENTS.$records->slug.'">'.$records->title.'</a>';
        })
        ->editColumn('image', function($records)
        {
          $image_path = IMAGE_PATH_UPLOAD_LMS_DEFAULT;
          if($records->image)
            $image_path = IMAGE_PATH_UPLOAD_LMS_SERIES_THUMB.$records->image;

            return '<img src="'.$image_path.'" height="35"   />';
        })
        ->editColumn('cost', function($records)
        {
           return ($records->is_paid) ? $records->cost : '-';
        })
        ->editColumn('validity', function($records)
        {
           return ($records->is_paid) ? $records->validity : '-';
        })
        ->editColumn('status', function($records)
        {
            return ($records->status) ? '<span class="label label-success">'.getPhrase('active') .'</span>' : '<span class="label label-danger">'.getPhrase('inactive').'</span>';
        })

         ->editColumn('show_in_front', function($records)
        {
            return ($records->show_in_front) ? '<span class="label label-success">'.getPhrase('yes') .'</span>' : '<span class="label label-info">'.getPhrase('no').'</span>';
        })
            ->rawColumns(['title','image','cost','validity','status','show_in_front','action','check_course'])
        ->removeColumn('id')
        ->removeColumn('slug')
        ->removeColumn('updated_at')
        ->make();
    }

    /**
     * This method loads the create view
     * @return void
     */
    public function create()
    {
      if(!checkRole(getUserGrade(2)))
      {
        prepareBlockUserMessage();
        return back();
      }
        $data['accredited_bodies']=DB::table('accredited_by')->get();

    	$data['record']         	= FALSE;
    	$data['active_class']       = 'lms';
        $data['categories']       	= array_pluck(App\LmsCategory::where('parent_id',0)->orderBy('category', 'ASC')->get(),'category', 'id');
        $data['levels']       	= array_pluck(App\LmsLevel::all(),'name', 'id');
        $data['accredited_bodies']=  array_pluck(App\AwardingBodies::all(),'name', 'id');
        $data['instructors']=  array_pluck(App\User::where('role_id',7)->get(),'name', 'id');

        $data['title']              = getPhrase('add_course');
        $data['layout']              = getLayout();
    	// return view('lms.lmsseries.add-edit', $data);
       $view_name = getTheme().'::lms.lmsseries.add-edit';
        return view($view_name, $data);
    }

    /**
     * This method loads the edit view based on unique slug provided by user
     * @param  [string] $slug [unique slug of the record]
     * @return [view with record]       
     */
    public function edit($slug)
    {
      if(!checkRole(getUserGrade(2)))
      {
        prepareBlockUserMessage();
        return back();
      }

    	$record = LmsSeries::getRecordWithSlug($slug);

    	if($isValid = $this->isValidRecord($record))
    		return redirect($isValid);

         $data['record']       	  = $record;
    	$data['active_class']     = 'lms';
    	$data['settings']         = FALSE;
        //$data['sections']       	= json_encode(App\LmsSeriesSections::where('lmsseries_id', $record->id)->get(),true);
        $data['categories']       	= array_pluck(App\LmsCategory::where('parent_id',0)->get(),'category', 'id');
        $data['levels']       	= array_pluck(App\LmsLevel::all(),'name', 'id');
        $data['accredited_bodies']=  array_pluck(App\AwardingBodies::all(),'name', 'id');
        $data['title']            = getPhrase('edit_course');
        $data['instructors']=  array_pluck(App\User::where('role_id',7)->get(),'name', 'id');
    	// return view('lms.lmsseries.add-edit', $data);
         $view_name = getTheme().'::lms.lmsseries.add-edit';
        return view($view_name, $data);
    }

    /**
     * Update record based on slug and reuqest
     * @param  Request $request [Request Object]
     * @param  [type]  $slug    [Unique Slug]
     * @return void
     */
    public function update(Request $request, $slug)
    {
       // dd($request);
//      if(!checkRole(getUserGrade(2)))
//      {
//        prepareBlockUserMessage();
//        return back();
//      }



        $rules = [
            'title'          	   => 'bail|required|max:230' ,
            'lms_parent_category_id'          	   => 'bail|required' ,
            'lms_category_id'          	   => 'bail|required' ,
            'level_id'          	   => 'bail|required' ,
            'validity'          	   => 'bail|required' ,
            'completion_certificate'          	   => 'bail|required' ,
            'show_in_front'          	   => 'bail|required' ,
            'status'          	   => 'bail|required' ,
            'accredited_by'          	   => 'bail|required' ,

        ];
        $customMessages = [
            'required' => 'The :attribute field is required.',
            'max' => 'The :attribute has size/length issue.',
        ];


        $this->validate($request, $rules,$customMessages);


    	$record = LmsSeries::getRecordWithSlug($slug);
       $name = $request->title;


        if($request->has('show_in_front')){

//          if($request->is_paid == 1 && $request->show_in_front == 1){
//
//            flash('Ooops...!','home_page_series_must_be_free_type_series','overlay');
//            return back();
//          }
//          else{

            $record->show_in_front   = $request->show_in_front;

//          }
          
        }
         $record->title 				= $name;
    	$record->sub_title 				= $request->sub_title;

        $record->is_paid			= $request->is_paid;

            $record->lms_parent_category_id = $request->lms_parent_category_id;

        if($request->lms_category_id) {
                $record->lms_category_id			= $request->lms_category_id;
        }
        $record->level_id	= $request->level_id;
        $record->user_id	= $request->user_id;
        $record->course_code= $request->course_code;

        $record->validity		= $request->validity;
        $record->cost				= 0;
        if($request->is_paid) {
        	$record->cost			= $request->cost;
            $record->discount_price			= $request->discount_price;
        }

        $record->total_items		= $request->total_items;


        $record->description		= $request->description;
        $record->why_consider_nla		= $request->why_consider_nla;
        $record->what_will_i_learn		= $request->what_will_i_learn;
        $record->entry_requirements	= $request->entry_requirements;
        $record->who_should_attend   = $request->who_should_attend;
        $record->method_of_assessment   = $request->method_of_assessment;
        $record->certification   = $request->certification;
        $record->other_information   = $request->other_information;
        $record->number_of_students   = $request->number_of_students;
        $record->number_of_reviews  = $request->number_of_reviews;
        $record->number_of_modules   = $request->number_of_modules;
        $record->certificate_title   = $request->certificate_title;
        $record->assesment   = $request->assesmentfield;
        $record->pdf   = $request->pdffield;
        if($request->setpopularfield) {
            $record->setpopular   = $request->setpopularfield;
        }
        $record->learning_hours   = $request->learning_hoursfield;
        $record->videoattach   = $request->videofield;
        if(isset($request->keyf)) {
            $record->features   = $request->featuresfield;
        }


        /************ Image Upload ***********/
        if (!empty($request->file('certificatefield'))) {
            $CertificateImage = $request->file('certificatefield');
            $CertificateImage_new_name = rand() . '.' . $CertificateImage->getClientOriginalExtension();
            $record->certificate = $CertificateImage_new_name;

            if (env('FILESYSTEM_DRIVER') == 's3') {
                $filePath = 'lms/certificate/' . $CertificateImage_new_name;
                Storage::disk('s3')->put($filePath, file_get_contents($CertificateImage));
            } else {
                if (!empty($request->file('certificatefield'))) {
                    (file_exists('public/uploads/certificate/' . $record->certificate)) ? unlink('public/uploads/certificate/' . $record->certificate) : "";
                }
                $CertificateImage->move('public/uploads/certificate', $CertificateImage_new_name);
            }
        }
        /************ Image Upload ***********/


        /************ Course FAQs ***********/
        if($request->faqs) {
            //$faqarr = array(array("question", "answer"), array("question", "answer"), array("question", "answer"));
            $faqarr = array();
            $faqs = array();

            foreach($request->question as $key=>$ques) {
                unset($faqs);
                $faqs[] = $ques;
                $faqs[] = $request->answer[$key];
                $faqarr[] = $faqs;
            }
            $record->faqs = json_encode($faqarr);
            //exit(print_r(json_decode($record->faqs)));
        } else {
            $record->faqs = NULL;
        }
        /************ Course FAQs ***********/



        $record->start_date   = $request->start_date;
        $record->status   = $request->status;
        $record->end_date   = $request->end_date;
        $record->completion_certificate   = $request->completion_certificate;
        $record->accredited_by   = $request->accredited_by;
        $record->course_tags   = $request->course_tags;
        $record->record_updated_by 	= Auth::user()->id;

        /********* log it **********/
        $oldData = $record;
        if($record->save()) {
            $oldData    =   [];
            $oldData["user_id"]         =   Auth::user()->id;
            $oldData["operation_id"]    =   $record->id;
            $oldData["table_name"]      =   "LmsSeries";
            $oldData["message"]         =   "Record Updated: " . $record->id;
            $oldData["data_json"]       =   json_encode($oldData);
            $oldData["model_json"]      =   json_encode(array("ID" => $record->id, "Table" => "LmsSeries", "Action" => "Record Updated", "created_at" => date("Y-m-d H:i:s"), "updated_at" => date("Y-m-d H:i:s")));


            App\Logs::CreateLog((object)$oldData);
        }
        /********* log it **********/
        if($request->course_tags!=null){
            $tags = explode(",", $request->course_tags);
            $record->attachTags($tags,'courses');
        }
        $file_name = 'image';
        if ($request->hasFile($file_name))
        {
            $rules = array( $file_name => 'mimes:jpeg,jpg,png,gif|max:1000000' );
            $this->validate($request, $rules);
            $examSettings = getSettings('lms');
            $path = $examSettings->seriesImagepath;
            $this->deleteFile($record->image, $path);
            $record->image      = $this->processUpload($request, $record,$file_name);
            $record->save();
        }
        $file_name = 'video';
        if ($request->hasFile($file_name))
        {
            $rules = array( $file_name => 'mimes:flv,avi,webm,mkv,mov,mp4|max:900000000' );
            $this->validate($request, $rules);
            $examSettings = getSettings('lms');
            $path = $examSettings->seriesImagepath;
            $this->deleteFile($record->video, $path);
            $record->video      = $this->processUploadVideo($request, $record,$file_name);
            $record->save();
        }


        flash('success','record_updated_successfully', 'success');
    	return redirect(URL_LMS_SERIES);
    }

    /**
     * This method adds record to DB
     * @param  Request $request [Request Object]
     * @return void
     */
    public function store(Request $request)
    {
      if(!checkRole(getUserGrade(2)))
      {
        prepareBlockUserMessage();
        return back();
      }


        $rules = [
            'title'          	   => 'bail|required|max:230' ,
            'lms_parent_category_id'          	   => 'bail|required' ,
            'lms_category_id'          	   => 'bail|required' ,
            'level_id'          	   => 'bail|required' ,
            'validity'          	   => 'bail|required' ,
            'completion_certificate'          	   => 'bail|required' ,
            'show_in_front'          	   => 'bail|required' ,
            'status'          	   => 'bail|required' ,
            'accredited_by'          	   => 'bail|required' ,

        ];
        $customMessages = [
            'required' => 'The :attribute field is required.',
            'image.max' => 'The :attribute has size/length issue.',
            'image.dimensions' => 'The image must be at least 500 width and 500 height'
        ];


        $this->validate($request, $rules,$customMessages);


        /*
                $rules = [
                 'title'          	   => 'bail|required|max:230' ,
                 'lms_parent_category_id'          	   => 'bail|required' ,
                 'lms_category_id'          	   => 'bail|required' ,
                 'level_id'          	   => 'bail|required' ,
                 'validity'          	   => 'bail|required' ,
                 'completion_certificate'          	   => 'bail|required' ,
                 'show_in_front'          	   => 'bail|required' ,
                 'status'          	   => 'bail|required' ,
                 'accredited_by'          	   => 'bail|required' ,
                 'image' => 'mimes:jpeg,jpg,png,gif|required|max:10000|dimensions:min_width=500,min_height=500' // max 10000kb

                  ];
                  // dd($request);
                $customMessages = [
                    'required' => 'The :attribute field is required.'
                ];
                $this->validate($request, $rules,$customMessages);*/

        $record = new LmsSeries();

         if($request->has('show_in_front')){

//          if($request->is_paid == 1 && $request->show_in_front == 1){
//
//            flash('Ooops...!','home_page_series_must_be_free_type_series','overlay');
//            return back();
//          }
//          else{

            $record->show_in_front   = $request->show_in_front;
//          }

        }
      	$name  						    =  $request->title;
        $record->title 				= $name;
//        $record->slug 				= str_slug($name);
        $record->is_paid			= $request->is_paid;
        $record->validity		= $request->validity;
        $record->lms_parent_category_id	= $request->lms_parent_category_id;
        if($request->lms_category_id) {
            $record->lms_category_id			= $request->lms_category_id;
        }else{
            $record->lms_category_id=0;
        }
//        $record->lms_category_id	= $request->lms_category_id;

        $record->level_id	= $request->level_id;
        $record->user_id	= Auth::user()->id;
        $record->sub_title	= $request->sub_title;
        $record->course_code= $request->course_code;

        $record->cost				= 0;
        if($request->is_paid) {
        	$record->cost			= $request->cost;
            $record->discount_price			= $request->discount_price;
    	}
        $record->total_items		= $request->total_items;

        $record->status   = $request->status;
        $record->description		= $request->description;
        $record->why_consider_nla		= $request->why_consider_nla;
        $record->what_will_i_learn		= $request->what_will_i_learn;

        $record->entry_requirements	= $request->entry_requirements;
        $record->who_should_attend   = $request->who_should_attend;
        $record->method_of_assessment   = $request->method_of_assessment;
        $record->certification   = $request->certification;
        $record->other_information   = $request->other_information;

        $record->number_of_students   = $request->number_of_students;
        if(isset($request->number_of_reviews))
            $record->number_of_reviews  = $request->number_of_reviews;
        else
            $record->number_of_reviews  = 0;

        if(isset($request->number_of_modules))
            $record->number_of_modules   = $request->number_of_modules;
        else
            $record->number_of_modules   = 0;
        $record->certificate_title   = $request->certificate_title;

        $record->assesment   = $request->assesmentfield;
        $record->pdf   = $request->pdffield;
        if($request->setpopularfield) {
            $record->setpopular   = $request->setpopularfield;
        }
        $record->learning_hours   = $request->learning_hoursfield;
        $record->videoattach   = $request->videofield;
        if(isset($request->keyf)) {
            $record->features   = $request->featuresfield;
        }

        /************ Image Upload ***********/
        if (!empty($request->file('certificatefield'))) {
            $CertificateImage = $request->file('certificatefield');
            $CertificateImage_new_name = rand() . '.' . $CertificateImage->getClientOriginalExtension();
            $record->certificate = $CertificateImage_new_name;

            if (env('FILESYSTEM_DRIVER') == 's3') {
                $filePath = 'lms/certificate/' . $CertificateImage_new_name;
                Storage::disk('s3')->put($filePath, file_get_contents($CertificateImage));
            } else {
                if (!empty($request->file('certificatefield'))) {
                    (file_exists('public/uploads/certificate/' . $record->certificate)) ? unlink('public/uploads/certificate/' . $record->certificate) : "";
                }
                $CertificateImage->move('public/uploads/certificate', $CertificateImage_new_name);
            }
        }
        /************ Image Upload ***********/

        /************ Course FAQs ***********/
        if($request->faqs) {
            //$faqarr = array(array("question", "answer"), array("question", "answer"), array("question", "answer"));
            $faqarr = array();
            $faqs = array();

            foreach($request->question as $key=>$ques) {
                unset($faqs);
                $faqs[] = $ques;
                $faqs[] = $request->answer[$key];
                $faqarr[] = $faqs;
            }
            $record->faqs = json_encode($faqarr);
            //exit(print_r(json_decode($record->faqs)));
        } else {
            $record->faqs = NULL;
        }
        /************ Course FAQs ***********/

        $record->start_date   = $request->start_date;
        $record->end_date   = $request->end_date;
        $record->completion_certificate   = $request->completion_certificate;
        $record->accredited_by   = $request->accredited_by;

        $record->record_updated_by 	= Auth::user()->id;
        /********* log it **********/
        $oldData = $record;
        if($record->save()) {
            $oldData    =   [];
            $oldData["user_id"]         =   Auth::user()->id;
            $oldData["operation_id"]    =   $record->id;
            $oldData["table_name"]      =   "LmsSeries";
            $oldData["message"]         =   "Record Inserted: " . $record->id;
            $oldData["data_json"]       =   json_encode($oldData);
            $oldData["model_json"]      =   json_encode(array("ID" => $record->id, "Table" => "LmsSeries", "Action" => "Record Inserted", "created_at" => date("Y-m-d H:i:s"), "updated_at" => date("Y-m-d H:i:s")));


            App\Logs::CreateLog((object)$oldData);
        }
        /********* log it **********/

        if($request->course_tags!=null){
            $tags = explode(",", $request->course_tags);
            $record->attachTags($tags,'courses');
        }


        $file_name = 'image';
        if ($request->hasFile($file_name))
        {
            $rules = array( $file_name => 'mimes:jpeg,jpg,png,gif|max:10000' );
            $this->validate($request, $rules);
		    $examSettings = getSettings('lms');
	        $path = $examSettings->seriesImagepath;
	        $this->deleteFile($record->image, $path);
            $record->image      = $this->processUpload($request, $record,$file_name);
              $record->save();
        }
        $file_name = 'video';
        if ($request->new_video)
        {
            $record->video      = $request->new_video;
            $record->save();
        }
        flash('success','record_added_successfully', 'success');
    	return redirect(URL_LMS_SERIES);
    }

    public function deleteFile($record, $path, $is_array = FALSE)
    {
      if(env('DEMO_MODE')) {
        return;
      }
        $files = array();
        $files[] = $path.$record;
        if(env('FILESYSTEM_DRIVER')=='s3'){
            Storage::delete($files);
        }else{
            File::delete($files);
        }

    }

    /**
     * This method process the image is being refferred
     * by getting the settings from ImageSettings Class
     * @param  Request $request   [Request object from user]
     * @param  [type]  $record    [The saved record which contains the ID]
     * @param  [type]  $file_name [The Name of the file which need to upload]
     * @return [type]             [description]
     */


     public function processUpload(Request $request, $record, $file_name){

      if(env('DEMO_MODE')) {
        return 'demo';
      }
         if ($request->hasFile($file_name)) {
          $examSettings = getSettings('lms');
            
            $imageObject = new ImageSettings();

          $destinationPath            = $examSettings->seriesImagepath;
          $destinationPathThumb       = $examSettings->seriesThumbImagepath;
          $destinationPathWidget       = $examSettings->seriesWidgetImagepath;

          $fileName = $record->id.'-'.$file_name.'.'.$request->$file_name->guessClientExtension();

             if(env('FILESYSTEM_DRIVER')=='s3'){
                 $file=$request->file($file_name);
                 $image_normal = Image::make($file->getRealPath())->fit($examSettings->imageSize);
                 $image_widget= Image::make($file->getRealPath())->fit($imageObject->getWidgetSize());
                 $image_thumb = Image::make($file->getRealPath())->fit($imageObject->getThumbnailSize());

                 uploadToS3($image_normal,'lms/series/',$fileName);
                 uploadToS3($image_widget,'lms/series/widget/',$fileName);
                 uploadToS3($image_thumb,'lms/series/thumb/',$fileName);
             }else {

                 $request->file($file_name)->move($destinationPath, $fileName);
                 //Save Normal Image with 300x300
                 Image::make($destinationPath . $fileName)->fit($examSettings->imageSize)->save($destinationPath . $fileName);
                 Image::make($destinationPath . $fileName)->fit($imageObject->getWidgetSize())->save($destinationPathWidget . $fileName);
                 Image::make($destinationPath . $fileName)->fit($imageObject->getThumbnailSize())->save($destinationPathThumb . $fileName);
             }

             return $fileName;

        }
     }


    public function processUploadVideo(Request $request, $record, $file_name)
    {
        if(env('DEMO_MODE')) {
            return 'demo';
        }
        if ($request->hasFile($file_name)) {
            $examSettings = getSettings('lms');

            $imageObject = new ImageSettings();

            $destinationPath            = $examSettings->seriesVideopath;

            $fileName = time().'-'.$file_name.'.'.$request->$file_name->guessClientExtension();

            if(env('FILESYSTEM_DRIVER')=='s3'){
                $file=$request->file($file_name);
                $filePath = 'lms/series/videos/' . $fileName;
                Storage::disk('s3')->put($filePath, fopen($file,'r+'));


            }else {

                $request->file($file_name)->move($destinationPath, $fileName);
                //Save Normal Image with 300x300
                Image::make($destinationPath . $fileName)->save($destinationPath . $fileName);
             }

            return $fileName;

        }
    }



    /**
     * Delete Record based on the provided slug
     * @param  [string] $slug [unique slug]
     * @return Boolean 
     */
    public function delete($slug)
    {
      if(!checkRole(getUserGrade(2)))
      {
        prepareBlockUserMessage();
        return back();
      }
      /**
       * Delete the questions associated with this quiz first
       * Delete the quiz
       * @var [type]
       */

        $record = LmsSeries::where('slug', $slug)->first();
        if(!$record)
        {
          $response['status'] = 0;
          $response['message'] = getPhrase('invalid_record');  
           return json_encode($response);
        }

        try{
        if(!env('DEMO_MODE')) {

            /********* log it **********/
            $oldData = $record;
            $oldData    =   [];
            $oldData["user_id"]         =   Auth::user()->id;
            $oldData["operation_id"]    =   $record->id;
            $oldData["table_name"]      =   "LmsSeries";
            $oldData["message"]         =   "Record Deleted: " . $record->id;
            $oldData["data_json"]       =   json_encode($oldData);
            $oldData["model_json"]      =   json_encode(array("ID" => $record->id, "Table" => "LmsSeries", "Action" => "Record Deleted", "created_at" => date("Y-m-d H:i:s"), "updated_at" => date("Y-m-d H:i:s")));


            App\Logs::CreateLog((object)$oldData);
            /********* log it **********/
          $record->delete();
        }
        $response['status'] = 1;
        $response['message'] = getPhrase('data_deleted_successfully');
      }
      catch ( \Illuminate\Database\QueryException $e) {
                 $response['status'] = 0;
           if(getSetting('show_foreign_key_constraint','module'))
            $response['message'] =  $e->errorInfo;
           else
            $response['message'] =  getPhrase('this_record_is_in_use_in_other_modules');
       }
       return json_encode($response);

    }


    public function deleteMultiple(Request $request)
    {

      $id_array = $request->input('deleteids_arr');


        //$id_array = $request->deleteids_arr;
        $record = LmsSeries::whereIn('id', $id_array);
        try{
            if(!env('DEMO_MODE')) {
                /********* log it **********/
                $oldData = $record;
                $oldData    =   [];
                $oldData["user_id"]         =   Auth::user()->id;
                $oldData["operation_id"]    =   $record->id;
                $oldData["table_name"]      =   "LmsSeries";
                $oldData["message"]         =   "Record Deleted: " . $record->id;
                $oldData["data_json"]       =   json_encode($oldData);
                $oldData["model_json"]      =   json_encode(array("ID" => $record->id, "Table" => "LmsSeries", "Action" => "Record Deleted", "created_at" => date("Y-m-d H:i:s"), "updated_at" => date("Y-m-d H:i:s")));


                App\Logs::CreateLog((object)$oldData);
                /********* log it **********/
                $record->delete();
            }
            $response['status'] = 1;
            $response['message'] = getPhrase('data_deleted_successfully');
        }
        catch ( \Illuminate\Database\QueryException $e) {
            $response['status'] = 0;
            if(getSetting('show_foreign_key_constraint','module'))
                $response['message'] =  $e->errorInfo;
            else
                $response['message'] =  getPhrase('this_record_is_in_use_in_other_modules');
        }
        return json_encode($response);


    }

    public function publishMultiple(Request $request)
    {
        $id_array = $request->input('deleteids_arr');


        try{
            if(!env('DEMO_MODE')) {


                 LmsSeries::whereIn('id', $id_array)->update(['status' => 1]);

                /********* log it **********/
//                $oldData    =   [];
//                $oldData["user_id"]         =   Auth::user()->id;
//                $oldData["operation_id"]    =   $id_array;
//                $oldData["table_name"]      =   "LmsSeries";
//                $oldData["message"]         =   "Multiple Record Published: " . $id_array;
//                $oldData["data_json"]       =   json_encode(array("IDs" => $id_array, "Table" => "LmsSeries", "Action" => "Multiple Record Published", "created_at" => date("Y-m-d H:i:s"), "updated_at" => date("Y-m-d H:i:s")));
//                $oldData["model_json"]      =   json_encode(array("IDs" => $id_array, "Table" => "LmsSeries", "Action" => "Multiple Record Published", "created_at" => date("Y-m-d H:i:s"), "updated_at" => date("Y-m-d H:i:s")));
//
//
//                App\Logs::CreateLog((object)$oldData);
                /********* log it **********/

            }
            $response['status'] = 1;
            $response['message'] = getPhrase('data_updated_successfully');
        }
        catch ( \Illuminate\Database\QueryException $e) {
            $response['status'] = 0;
            if(getSetting('show_foreign_key_constraint','module'))
                $response['message'] =  $e->errorInfo;
            else
                $response['message'] =  getPhrase('this_record_is_in_use_in_other_modules');
        }
        return json_encode($response);


    }

    public function unpublishMultiple(Request $request)
    {
        //dd($request);

        $id_array = $request->input('deleteids_arr');


        try{
            if(!env('DEMO_MODE')) {


                LmsSeries::whereIn('id', $id_array)->update(['status' => 0]);

                /********* log it **********/
//                $oldData    =   [];
//                $oldData["user_id"]         =   Auth::user()->id;
//                $oldData["operation_id"]    =   $id_array;
//                $oldData["table_name"]      =   "LmsSeries";
//                $oldData["message"]         =   "Multiple Record UnPublished: " . $id_array;
//                $oldData["data_json"]       =   json_encode(array("IDs" => $id_array, "Table" => "LmsSeries", "Action" => "Multiple Record UnPublished", "created_at" => date("Y-m-d H:i:s"), "updated_at" => date("Y-m-d H:i:s")));
//                $oldData["model_json"]      =   json_encode(array("IDs" => $id_array, "Table" => "LmsSeries", "Action" => "Multiple Record UnPublished", "created_at" => date("Y-m-d H:i:s"), "updated_at" => date("Y-m-d H:i:s")));
//
//
//                App\Logs::CreateLog((object)$oldData);
                /********* log it **********/

            }
            $response['status'] = 1;
            $response['message'] = getPhrase('data_updated_successfully');
        }
        catch ( \Illuminate\Database\QueryException $e) {
            $response['status'] = 0;
            if(getSetting('show_foreign_key_constraint','module'))
                $response['message'] =  $e->errorInfo;
            else
                $response['message'] =  getPhrase('this_record_is_in_use_in_other_modules');
        }
        return json_encode($response);


    }

    public function editSections($slug)
    {
//        if(!checkRole(getUserGrade(2)))
//        {
//            prepareBlockUserMessage();
//            return back();
//        }

        $record = LmsSeries::getRecordWithSlug($slug);

       // dd($record);
        if($isValid = $this->isValidRecord($record))
            return redirect($isValid);
        $data['record']       	  = $record;
        $data['active_class']     = 'lms';
        $data['settings']         = FALSE;

        $sectionsjson=json_encode(App\LmsSeriesSections::where('lmsseries_id', $record->id)->get(),true);
        $sectionsjson=addslashes($sectionsjson);
//        $data['sections']= str_replace("'", "\'", $sectionsjson);
        $data['sections']= $sectionsjson;
        $data['categories']       	= array_pluck(App\LmsCategory::all(),'category', 'id');
        $data['levels']       	= array_pluck(App\LmsLevel::all(),'name', 'id');
        $data['title']            = getPhrase('add_course_sections');
        // return view('lms.lmsseries.add-edit', $data);
       //dd($data);
        $view_name = getTheme().'::lms.lmsseries.add-sections';
        return view($view_name, $data);
    }

    /**
     * Update record based on slug and reuqest
     * @param  Request $request [Request Object]
     * @param  [type]  $slug    [Unique Slug]
     * @return void
     */

    public function storeSections(Request $request, $slug)
    {
        if(!checkRole(getUserGrade(2)))
        {
            prepareBlockUserMessage();
            return back();
        }



        $record_c = LmsSeries::getRecordWithSlug($slug);
        $rules = ['title'      => 'bail|required|max:230'];
        /**
         * Check if the title of the record is changed,
         * if changed update the slug value based on the new title
         */
        $course_id = $record_c->id;

        //Validate the overall request
        //$this->validate($request, $rules);

        $record = new LmsSeriesSections();

        $record->section_name 				= $request->section_name;
        $record->lmsseries_id 				= $course_id;



        $record->record_updated_by 	= Auth::user()->id;
        /********* log it **********/
        $oldData = $record;
        if($record->save()) {
            $oldData    =   [];
            $oldData["user_id"]         =   Auth::user()->id;
            $oldData["operation_id"]    =   $record->id;
            $oldData["table_name"]      =   "LmsSeriesSections";
            $oldData["message"]         =   "Record Inserted: " . $record->id;
            $oldData["data_json"]       =   json_encode($oldData);
            $oldData["model_json"]      =   json_encode(array("ID" => $record->id, "Table" => "LmsSeriesSections", "Action" => "Record Inserted", "created_at" => date("Y-m-d H:i:s"), "updated_at" => date("Y-m-d H:i:s")));


            App\Logs::CreateLog((object)$oldData);
        }
        /********* log it **********/
        echo $record->id;

        flash('success','record_updated_successfully', 'success');
        //return redirect(URL_LMS_SERIES);
    }



    public function updateSections(Request $request, $slug)
    {
        if(!checkRole(getUserGrade(2)))
        {
            prepareBlockUserMessage();
            return back();
        }



        $record_c = LmsSeries::getRecordWithSlug($slug);
        $rules = ['title'      => 'bail|required|max:230'];
        /**
         * Check if the title of the record is changed,
         * if changed update the slug value based on the new title
         */
        $course_id = $record_c->id;

        //Validate the overall request
        //$this->validate($request, $rules);

        $record = LmsSeriesSections::find($request->id);

        $record->section_name 				= $request->section_name;
        $record->lmsseries_id 				= $course_id;



        $record->record_updated_by 	= Auth::user()->id;
        /********* log it **********/
        $oldData = $record;
        if($record->save()) {
            $oldData    =   [];
            $oldData["user_id"]         =   Auth::user()->id;
            $oldData["operation_id"]    =   $record->id;
            $oldData["table_name"]      =   "LmsSeriesSections";
            $oldData["message"]         =   "Record Updated: " . $record->id;
            $oldData["data_json"]       =   json_encode($oldData);
            $oldData["model_json"]      =   json_encode(array("ID" => $record->id, "Table" => "LmsSeriesSections", "Action" => "Record Updated", "created_at" => date("Y-m-d H:i:s"), "updated_at" => date("Y-m-d H:i:s")));


            App\Logs::CreateLog((object)$oldData);
        }
        /********* log it **********/


        flash('success','record_updated_successfully', 'success');
        //return redirect(URL_LMS_SERIES);
    }


    public function deleteSections($slug)
    {
        if(!checkRole(getUserGrade(2)))
        {
            prepareBlockUserMessage();
            return back();
        }
        /**
         * Delete the questions associated with this quiz first
         * Delete the quiz
         * @var [type]
         */
        //
        //if($record_data){

        //}

        $record = LmsSeriesSections::where('id', $slug)->first();
       // $record = LmsSeriesSections::destroy($slug);
        if(!$record)
        {
            $response['status'] = 0;
            $response['message'] = getPhrase('invalid_record');
            return json_encode($response);
        }

        try{
            //
            if(!env('DEMO_MODE')) {
                /********* log it **********/
                $oldData = $record;
                $oldData    =   [];
                $oldData["user_id"]         =   Auth::user()->id;
                $oldData["operation_id"]    =   $record->id;
                $oldData["table_name"]      =   "LmsSeriesSections";
                $oldData["message"]         =   "Record Deleted: " . $record->id;
                $oldData["data_json"]       =   json_encode($oldData);
                $oldData["model_json"]      =   json_encode(array("ID" => $record->id, "Table" => "LmsSeriesSections", "Action" => "Record Deleted", "created_at" => date("Y-m-d H:i:s"), "updated_at" => date("Y-m-d H:i:s")));


                App\Logs::CreateLog((object)$oldData);
                /********* log it **********/
                 $record->delete($slug);

                    $record_data = App\LmsSeriesData::where('section_id', $slug)->delete();
                   // $record_data->delete();

            }
            $response['status'] = 1;
            $response['message'] = getPhrase('record_deleted_successfully');
        }
        catch ( \Illuminate\Database\QueryException $e) {
            $response['status'] = 0;
            if(getSetting('show_foreign_key_constraint','module'))
                $response['message'] =  $e->errorInfo;
            else
                $response['message'] =  getPhrase('this_record_is_in_use_in_other_modules');
        }
        return json_encode($response);

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
    	return URL_LMS_SERIES;
    }

    public function getRedirectUrl()
    {
        return URL_LMS_SERIES;
    }
    /**
     * Returns the list of subjects based on the requested subject
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function getSeries(Request $request)
    {

    	$category_id 	= $request->category_id;
    	$items 			= App\LmsContent::where('subject_id','=',$category_id)
                     
    				        ->get();
    	return json_encode(array('items'=>$items));
    }
    
    /**
     * Updates the questions in a selected quiz
     * @param  [type] $slug [description]
     * @return [type]       [description]
     */
    public function updateSectionContents($slug,$secid)
    {


        if(!checkRole(getUserGrade(2)))
        {
            prepareBlockUserMessage();
            return back();
        }

        /**
         * Get the Quiz Id with the slug
         * Get the available questions from questionbank_quizzes table
         * Load view with this data
         */
        $record = LmsSeries::getRecordWithSlug($slug);
        $contents=$record->contents()->where('section_id',$secid)->get();
//        foreach ($contents as $content){
//            echo $content->title;
//            echo "<br>";
//        }
//        exit;

        $data['contents']         	= $contents;
        $data['record']         	= $record;
        $data['active_class']       = 'lms';
        $data['right_bar']          = TRUE;
        $data['right_bar_path']     = 'lms.lmsseries.right-bar-update-lmslist';
        $data['categories']       	= array_pluck(App\Subject::all(),'subject_title', 'id');
        $data['course_sections']       	= array_pluck(App\LmsSeriesSections::where('lmsseries_id', $record->id)->get(),'section_name','id');
        $data['settings']           = FALSE;
        $previous_records = array();
        if($record->total_items > 0)
        {
            $series = DB::table('lmsseries_data')
                ->where('lmsseries_id', '=', $record->id)
                ->get();

            foreach($series as $r)
            {
                $temp = array();
                $temp['id'] 	= $r->lmscontent_id;
                $section_details = App\LmsSeriesSections::where('id', '=', $r->section_id)->first();
                $series_details = App\LmsContent::where('id', '=', $r->lmscontent_id)->first();
                // dd($series_details);
                if($section_details){
                    $temp['section_name'] = $section_details->section_name;
                }
                $temp['content_type'] = $series_details->content_type;
                $temp['section_id'] = $r->section_id;
                $temp['code'] 		 = $series_details->code;
                $temp['title'] 		 = $series_details->title;

                array_push($previous_records, $temp);
            }
            $settings['contents'] = $previous_records;

            $data['settings']           = json_encode($settings);
        }


        $data['exam_categories']       	= array_pluck(App\QuizCategory::all(),
            'category', 'id');

        // $data['categories']       	= array_pluck(QuizCategory::all(), 'category', 'id');
        $data['title']              = getPhrase('update_series_for').' '.$record->title;
        // return view('lms.lmsseries.update-list', $data);

        $view_name = getTheme().'::lms.lmsseries.update-list';
        return view($view_name, $data);

    }



    public function updateSeries($slug)
    {

       if(!checkRole(getUserGrade(2)))
       {
            prepareBlockUserMessage();
            return back();
        }

    	/**
    	 * Get the Quiz Id with the slug
    	 * Get the available questions from questionbank_quizzes table
    	 * Load view with this data
    	 */
		$record = LmsSeries::getRecordWithSlug($slug); 
    	$data['record']         	= $record;
    	$data['active_class']       = 'lms';
        $data['right_bar']          = TRUE;
        $data['right_bar_path']     = 'lms.lmsseries.right-bar-update-lmslist';
        $data['categories']       	= array_pluck(App\Subject::all(),'subject_title', 'id');
        $data['course_sections']       	= array_pluck(App\LmsSeriesSections::where('lmsseries_id', $record->id)->get(),'section_name','id');
        $data['settings']           = FALSE;
        $previous_records = array();
        if($record->total_items > 0)
        {
            $series = DB::table('lmsseries_data')
                            ->where('lmsseries_id', '=', $record->id)
                            ->get();
            
            foreach($series as $r)
            {
                $temp = array();
                $temp['id'] 	= $r->lmscontent_id;
                $section_details = App\LmsSeriesSections::where('id', '=', $r->section_id)->first();
                $series_details = App\LmsContent::where('id', '=', $r->lmscontent_id)->first();
                // dd($series_details);
                if($section_details){
                    $temp['section_name'] = $section_details->section_name;
                }
                $temp['content_type'] = $series_details->content_type;
                $temp['section_id'] = $r->section_id;
                $temp['code'] 		 = $series_details->code;
                $temp['title'] 		 = $series_details->title;
                
                array_push($previous_records, $temp);
            }
            $settings['contents'] = $previous_records;

        $data['settings']           = json_encode($settings);
        }
        
        
    	$data['exam_categories']       	= array_pluck(App\QuizCategory::all(), 
    									'category', 'id');

    	// $data['categories']       	= array_pluck(QuizCategory::all(), 'category', 'id');
    	$data['title']              = getPhrase('update_series_for').' '.$record->title;
    	// return view('lms.lmsseries.update-list', $data);

         $view_name = getTheme().'::lms.lmsseries.update-list';
        return view($view_name, $data);

    }

    public function storeSeries(Request $request, $slug)
    {	
    	
        if(!checkRole(getUserGrade(2)))
        {
            prepareBlockUserMessage();
            return back();
        }

        $lms_series = LmsSeries::getRecordWithSlug($slug); 

        $lmsseries_id  = $lms_series->id;
        $contents  	= json_decode($request->saved_series);
        //dd($contents);
        $contents_to_update = array();
        foreach ($contents as $record) {
            $temp = array();
            $temp['lmscontent_id'] = $record->id;
            $temp['lmsseries_id'] = $lmsseries_id;
            $temp['section_id'] = $record->section_id;
            $temp['created_at'] = \Carbon\Carbon::now()->toDateTimeString();
            $temp['updated_at'] = \Carbon\Carbon::now()->toDateTimeString();
            array_push($contents_to_update, $temp);
            
        }
        $lms_series->total_items = count($contents);
        if(!env('DEMO_MODE')) {
        //Clear all previous questions
        DB::table('lmsseries_data')->where('lmsseries_id', '=', $lmsseries_id)->delete();
        //Insert New Questions
        DB::table('lmsseries_data')->insert($contents_to_update);
          $lms_series->save();
        }
        flash('success','record_updated_successfully', 'success');
        return redirect(URL_LMS_SERIES);
    }

    /**
     * This method lists all the available exam series for students
     * 
     * @return [type] [description]
     */
    public function listExams()
    {
        $data['active_class']       = 'exams';
        $data['title']              = getPhrase('exam_series');
        $data['series']         = LmsSeries::paginate((new App\GeneralSettings())->getPageLength());
        $data['layout']              = getLayout();
       // return view('student.exams.exam-series-list', $data);

         $view_name = getTheme().'::student.exams.exam-series-list';
        return view($view_name, $data);


    }

    /**
     * This method displays all the details of selected exam series
     * @param  [type] $slug [description]
     * @return [type]       [description]
     */


    public function getExams(Request $request)
    {
        $series_id=0;
        $category_id 	= $request->category_id;
        $series_id 	= $request->series_id;
        $exam_series_type='';
        if ($request->has('series_id')){
            $items = App\Quiz::distinct()
                ->join('examseries_data', 'quizzes.id', '=', 'examseries_data.quiz_id')
                ->where('examseries_data.examseries_id', '=',$series_id)
                ->orderBy('quizzes.updated_at', 'desc')
                ->get();
           // $items 			= App\Quiz::where('category_id','=',$category_id)->get();
            $exam_series= App\ExamSeries::
            where('category_id','=',$category_id)
                ->where('id','=',$series_id)->first();
           // dd($exam_series);
            $exam_series_type=$exam_series->exam_type;
        }else{
            $items 			= App\Quiz::where('category_id','=',$category_id)->get();
            $exam_series= App\ExamSeries::where('category_id','=',$category_id)->get();
        }

//        $series_return = "";
//        foreach ($exam_series as $series) {
//            $series_return .= "<option value='$series->id'>$series->title</option>";
//        }
        return json_encode(array('items'=>$items,'exam_series'=>$exam_series,'exam_series_type'=>$exam_series_type,'exam_series_id'=>$series_id));
    }

    /**
     * Updates the questions in a selected quiz
     * @param  [type] $slug [description]
     * @return [type]       [description]
     */
    public function updateExams($slug)
    {

        if(!checkRole(getUserGrade(2)))
        {
            prepareBlockUserMessage();
            return back();
        }

        /**
         * Get the Quiz Id with the slug
         * Get the available questions from questionbank_quizzes table
         * Load view with this data
         */
        $record = LmsSeries::getRecordWithSlug($slug);
        $data['record']         	= $record;
        $data['active_class']       = 'lms';
        $data['right_bar']          = TRUE;
        $data['right_bar_path']     = 'lms.lmsseries.right-bar-update-exams';
        $data['settings']           = FALSE;
        $previous_records = array();
        if($record->total_items > 0)
        {
            $series = DB::table('lmsseries_exams')
                ->where('lmsseries_id', '=', $record->id)
                ->get();

            foreach($series as $r)
            {
                $temp = array();
                $temp['id'] 	= $r->exam_quiz_id;
                $exam_details = App\Quiz::where('id', '=', $r->exam_quiz_id)->first();
                //$series_details = App\LmsContent::where('id', '=', $r->lmscontent_id)->first();
               //   dd($exam_details);
               /* if($exam_details){
                    $temp['section_name'] = $exam_details->section_name;
                }*/
                $temp['exam_type'] = $r->exam_type;
                $temp['section_id'] = $r->section_id;
                $temp['lmsseries_id'] = $r->lmsseries_id;
                $temp['exam_series_id'] = $r->exam_series_id;
                $temp['exam_type'] = $r->exam_type;
                $temp['dueration']=$exam_details['dueration'];
                $temp['quiz_id']=$exam_details['id'];
                $temp['title']=$exam_details['title'];
                $temp['total_marks']=$exam_details['total_marks'];

                array_push($previous_records, $temp);
            }
            $settings['contents'] = $previous_records;
            //dd($settings);
            $data['settings']           = json_encode($settings);
        }
        $data['course_sections']       	= array_pluck(App\LmsSeriesSections::where('lmsseries_id', $record->id)->get(),'section_name','id');

        $exam_cats=App\QuizCategory::with('examSeries')->get();

        $data['exam_cats']       	= $exam_cats;
        $data['exam_categories']       	= array_pluck($exam_cats,'category', 'id');
//        $data['exam_categories']       	= array_pluck(App\ExamSeries::all(),'category', 'id');

       // dd($data['exam_categories'] );
        // $data['categories']       	= array_pluck(QuizCategory::all(), 'category', 'id');
        $data['title']              = getPhrase('update_exams_for').' '.$record->title;
        // return view('lms.lmsseries.update-list', $data);

        $view_name = getTheme().'::lms.lmsseries.update-exams';
        return view($view_name, $data);

    }

    public function storeExams(Request $request, $slug)
    {

        if(!checkRole(getUserGrade(2)))
        {
            prepareBlockUserMessage();
            return back();
        }

        $lms_series = LmsSeries::getRecordWithSlug($slug);

        $lmsseries_id  = $lms_series->id;
        $contents  	= json_decode($request->saved_series);
 //dd($contents);

        $contents_to_update = array();
        foreach ($contents as $record) {
            $temp = array();
            $temp['exam_quiz_id'] = $record->quiz_id;
            $temp['exam_type'] = $record->exam_type;
            $temp['record_updated_by'] = Auth::user()->id;
            $temp['lmsseries_id'] = $lmsseries_id;
            $temp['section_id'] = $record->section_id;
            $temp['exam_series_id'] = $record->exam_series_id;
            $temp['created_at'] = \Carbon\Carbon::now()->toDateTimeString();
            $temp['updated_at'] = \Carbon\Carbon::now()->toDateTimeString();
            array_push($contents_to_update, $temp);

        }
        //$lms_series->total_items = count($contents);
        if(!env('DEMO_MODE')) {
            //Clear all previous questions
            DB::table('lmsseries_exams')->where('lmsseries_id', '=', $lmsseries_id)->delete();
            //Insert New Questions
            DB::table('lmsseries_exams')->insert($contents_to_update);
            $lms_series->save();
        }
        flash('success','record_updated_successfully', 'success');
        return redirect(URL_LMS_SERIES);
    }



    public function viewItem($slug)
    {

        $record = LmsSeries::getRecordWithSlug($slug); 
        
        if($isValid = $this->isValidRecord($record))
          return redirect($isValid);  

        $data['active_class']       = 'exams';
        $data['pay_by']             = '';
        $data['title']              = $record->title;
        $data['item']               = $record;
         $data['right_bar']          = TRUE;
          $data['right_bar_path']     = 'student.exams.exam-series-item-view-right-bar';
        $data['right_bar_data']     = array(
                                            'item' => $record,
                                            );
        $data['layout']              = getLayout();
       // return view('student.exams.exam-series-view-item', $data);

        $view_name = getTheme().'::student.exams.exam-series-view-item';
        return view($view_name, $data);



    }

    /**
     * This method prepares the json data to be inserted in place of options
     * by processing the image information and other attributes
     * @param  [type] $request [request sent by the user]
     * @param  [type] $record  [the record which was saved to DB]
     * @return [type]          [description]
     */
    public function prepareSections($request, $record)
    {

        $options    = $request->sections;
        $list       = array();


        /**
         * Loop the total options selected by user
         * and process each option by checking wether the image
         * has been uploaded or not
         * After this loop multiple objects will be created based on
         * the no. of options(total_answers) selected by user
         * Each object contains 3 properties
         * 1) option_value : stores the text submitted as option
         * 2) has_file     : stores if this particular option has any file
         * 3) file_name    : stores the name of file uploaded
         */
        for($index = 0; $index < $request->total_sections; $index++)
        {
            /**
             * The $answers variable is used when user edit any question
             * It will contain the previous option values
             * As it is under for loop, every option property will be checked
             * by comparing wether the file is submitted for this particular object
             * If submitted it will delete the old file and overwrite with new file
             * @var [type]
             */
            $sections = json_decode($record->sections);

            $spl_char   = ['\t','\n','\b','\c','\r','\'','\\','\$','\"',"'"];
            $list[$index]['section_value']   = str_replace($spl_char,'',$sections[$index]);



        }

        return json_encode($list);
    }
function getsubcategory(Request $request) {
    $id = $request->id;
    $categories  = App\LmsCategory::where('parent_id', $id)->get();

    $categories_return = "";
    foreach ($categories as $category) {
        $categories_return .= "<option value='$category->id'>$category->category</option>";
    }
    return response()->json($categories_return, 200);
}

    function getCourseTags___old() {


        //$lms=LmsSeries::all();
        $str="";
        $tags=App\Tag::select('name')->where('type','=','courses')->get();

//        $someArray = json_decode($tags, true);
//        print_r($someArray);        // Dump all data of the Array
//        $tags=$someArray[0]["name"];

        $str="{";
        $str.="source: [";
         foreach ($tags as $tag) {
            $someArray = json_decode($tag, true);
            $str2= $someArray["name"];
             $str2=json_decode($str2,true);
            $str .= "'".$str2['en']."',";
        }
       // $tags=json_decode($tags);
        $str=rtrim($str, ", ");
        $str.="]";
        $str.="}";

        //dd($str);
        return $str;
    }


    function getCourseTags() {


        //$lms=LmsSeries::all();
        $str="";
        $tags=App\Tag::select('name','id')->where('type','=','courses')->get();

//        $someArray = json_decode($tags, true);
//        print_r($someArray);        // Dump all data of the Array
//        $tags=$someArray[0]["name"];
        $someArray=array();
        $str="";
         //$str.="[";
        foreach ($tags as $tag) {
            $someArray = json_decode($tag, true);
            $str2= $someArray["name"];
            $str2=json_decode($str2,true);
             $str .= $str2['en'].",";

    }
        // $tags=json_decode($tags);
        $str=rtrim($str, ", ");
           //$str.=[$str];
        //$arr=array_push($someArray,$str);
       // echo $str;
       //print_r($arr);
        return $str;
    }


    public function uploadnewVideo(Request $request){

    $file_name = 'video';
    if ($request->hasFile($file_name)) {
        {
            $record = '';
            $name = $this->processUploadVideo($request, $record, $file_name);
        }

        return response()->json(['success' => $name]);
    }

}
public function uploadVideo(Request $request,$id){
    $record = LmsSeries::find($id);
    if($record){

        $file_name = 'video';
        if ($request->hasFile($file_name))
        {
            $examSettings = getSettings('lms');
            $path = $examSettings->seriesImagepath;
            $this->deleteFile($record->video, $path);
            $record->video      = $this->processUploadVideo($request, $record,$file_name);
            $record->save();
        }

    }
    return response()->json(['success'=> $record->video]);
}
public function deleteVideo(Request $request,$id){
    $record = LmsSeries::find($id);
    $examSettings = getSettings('lms');
    $path = $examSettings->seriesImagepath;
    $this->deleteFile($record->video, $path);
    $record->video = '';
    $record->save();
    return response()->json(['success'=>$request->filename]);
}
public function deletenewVideo(Request $request,$name){
    $examSettings = getSettings('lms');
    $path = $examSettings->seriesImagepath;
    $this->deleteFile($name, $path);
    return response()->json(['success'=>$name]);
}



}
