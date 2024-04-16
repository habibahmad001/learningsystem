<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App;
use App\Http\Requests;
use App\Lmscategory;
use App\LmsContent;

use Yajra\Datatables\Datatables;
use DB;
use Auth;
use Image;
use ImageSettings;
use File;
use Exception;
use Illuminate\Support\Facades\Storage;

class LmsContentController extends Controller
{
    
    public function __construct()
    {
    	$this->middleware('auth');
    }

    protected  $examSettings;

    public function setSettings()
    {
        $this->examSettings = getSettings('lms');
    }

    public function getSettings()
    {
        return $this->examSettings;
    }

    /**
     * Course listing method
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
       if(!checkRole(getUserGrade(2)))
      {
        prepareBlockUserMessage();
        return back();
      }
        $data['active_class']       = 'lms';
        $data['title']              = 'LMS'.' '.getPhrase('content');
        $data['layout']              = getLayout();
    	// return view('lms.lmscontents.list', $data);

          $view_name = getTheme().'::lms.lmscontents.list';
        return view($view_name, $data);
    }

    /**
     * This method returns the datatables data to view
     * @return [type] [description]
     */
    public function getDatatable()
    {
      if(!checkRole(getUserGrade(2)))
      {
        prepareBlockUserMessage();
        return back();
      }
        $role = getRole();

        if($role=="instructor" ){
            $records = LmsContent::join('subjects', 'lmscontents.subject_id', '=', 'subjects.id')
//                ->join('lmsseries', 'lmsseries.id', '=', 'lmsseries_data.lmsseries_id')
                ->select(['lmscontents.title','lmscontents.image','lmscontents.content_type', 'subjects.subject_title','lmscontents.slug', 'lmscontents.id','lmscontents.updated_at' ])
                ->orderBy('updated_at','desc')
            ;
            $records = $records->where('record_added_by', Auth::user()->id);
        }else{

    $records = LmsContent::join('subjects', 'lmscontents.subject_id', '=', 'subjects.id')
    		->select(['lmscontents.title','lmscontents.image','lmscontents.content_type', 'subjects.subject_title','lmscontents.slug', 'lmscontents.id','lmscontents.updated_at' ])
            ->orderBy('updated_at','desc')
            ;
        }


        $this->setSettings();
        return Datatables::of($records)
            ->addColumn('check_course', function ($records) {

                $link_data1 = '<input name="checkbox_course[]" type="checkbox" class="delete_check" id="delcheck_'.$records->id.'"    value="'.$records->id.'">';

                return $link_data1;
            })
            ->addColumn('action', function ($records) {
            $extra = '<div class="dropdown more">
                        <a id="dLabel" type="button" class="more-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-dots-vertical"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dLabel">
                            <li><a href="'.URL_LMS_CONTENT_EDIT.$records->slug.'"><i class="fa fa-pencil"></i>'.getPhrase("edit").'</a></li>';
                            $temp = "";
                             if(checkRole(getUserGrade(1))){
                    $temp = '<li><a href="javascript:void(0);" onclick="deleteRecord(\''.$records->slug.'\');"><i class="fa fa-trash"></i>'. getPhrase("delete").'</a></li>';
                        }
                        $extra .= $temp.'</ul></div>';
                    return $extra;
            })
            ->rawColumns(['title','image','action','check_course'])
        ->removeColumn('id')
        ->removeColumn('updated_at')
        ->removeColumn('slug')
        ->editColumn('image', function($records){
            $image_path = IMAGE_PATH_UPLOAD_LMS_DEFAULT;
            
            if($records->image)
            $image_path = IMAGE_PATH_UPLOAD_LMS_CONTENTS.$records->image;    

            return '<img src="'.$image_path.'" height="100" width="100" />';
        })
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
    	$data['record']         	= FALSE;
    	$data['active_class']       = 'lms';
    	$data['subjects']       	= array_pluck(App\Subject::all(), 'subject_title', 'id');
        $data['title']              = getPhrase('add_content');
    	$data['layout']              = getLayout();

    	// return view('lms.lmscontents.add-edit', $data);
         $view_name = getTheme().'::lms.lmscontents.add-edit';
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
    	$record = LmsContent::getRecordWithSlug($slug);
    	if($isValid = $this->isValidRecord($record))
    		return redirect($isValid);

    	$data['record']         	= $record;
    	$data['title']       		= getPhrase('edit').' '.$record->title;
    	$data['active_class']       = 'lms';
    	$data['subjects']           = array_pluck(App\Subject::all(), 'subject_title', 'id');
    	$data['settings']           = json_encode($record);
        $data['layout']              = getLayout();
    	// return view('lms.lmscontents.add-edit', $data);
          $view_name = getTheme().'::lms.lmscontents.add-edit';
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
      if(!checkRole(getUserGrade(2)))
      {
        prepareBlockUserMessage();
        return back();
      }

    	$record = LmsContent::getRecordWithSlug($slug);
		  $rules = [
         'subject_id'                   => 'bail|required|integer' ,
         'title'                        => 'bail|required|max:260' ,
         'content_type'                 => 'bail|required',
         'code'                         => 'bail|required|unique:lmscontents,code,'.$record->id,
        ];
        $file_path = $record->file_path;
        switch ($request->content_type) {
            case 'url':
            case 'video_url':
            case 'audio_url':
            case 'iframe':
                    if($request->file_path)
                        $file_path = $request->file_path;
                break;
            case 'file' :
                   if($request->file_path)
                    $file_path = $request->lms_file;
                break;
            case 'video' :
                    if($request->file_path)
                    $file_path = $request->lms_file;
                break;
            case 'audio' :
                    if($request->file_path)
                    $file_path = $request->lms_file;
                break;
        }
         
        
        $this->validate($request, $rules);
         DB::beginTransaction();
       try{
       //$name = $request->title;
        //if($name != $record->title)
          //  $record->slug = str_slug($name);
      
    	$name  						=  $request->title;
		 $record->title              = $name;
       
        $record->subject_id         = $request->subject_id;
        $record->code               = $request->code;
        $record->content_type       = $request->content_type;
           if($request->video_length){
               $record->video_length       = $request->video_length;
           }
           if($request->preview){
               $record->preview       = $request->preview;
           }
           if($request->download_allowed){
               $record->download_allowed       = $request->download_allowed;
           }else{
               $record->download_allowed=0;
           }

        $record->file_path          = $file_path;
        $record->description        = $request->description;
        $record->record_updated_by  = Auth::user()->id;

           /********* log it **********/
           $oldData = $record;
           if($record->save()) {
               $oldData    =   [];
               $oldData["user_id"]         =   Auth::user()->id;
               $oldData["operation_id"]    =   $record->id;
               $oldData["table_name"]      =   "LmsContent";
               $oldData["message"]         =   "Record Updated: " . $record->id;
               $oldData["data_json"]       =   json_encode($oldData);
               $oldData["model_json"]      =   json_encode(array("ID" => $record->id, "Table" => "LmsContent", "Action" => "Record Updated", "created_at" => date("Y-m-d H:i:s"), "updated_at" => date("Y-m-d H:i:s")));


               App\Logs::CreateLog((object)$oldData);
           }
           /********* log it **********/
         $file_name = 'image';
        if ($request->hasFile($file_name))
        {

            $rules = array( $file_name => 'mimes:jpeg,jpg,png,gif|max:100000' );
            $this->validate($request, $rules);
            $this->setSettings();
            $examSettings = $this->getSettings();
            $path = $examSettings->contentImagepath;
            $this->deleteFile($record->image, $path);

              $record->image      = $this->processUpload($request, $record,$file_name);

              $record->save();
        }

         $file_name = 'lms_file';
        if ($request->hasFile($file_name))
        {

            $this->setSettings();
            $examSettings = $this->getSettings();
            $path = $examSettings->contentImagepath;
            $this->deleteFile($record->file_path, $path);

              $record->file_path      = $this->processUpload($request, $record,$file_name, FALSE);
              
              $record->save();
        }
        DB::commit();
        flash('success','record_updated_successfully', 'success');

    }  catch(Exception $e)
     {
        DB::rollBack();
       if(getSetting('show_foreign_key_constraint','module'))
       {

          flash('oops...!',$e->errorInfo, 'error');
       }
       else {
          flash('oops...!','improper_data_file_submitted', 'error');
       }
     }
    	return redirect(URL_LMS_CONTENT);
    }

    /**
     * This method adds record to DB
     * @param  Request $request [Request Object]
     * @return void
     */
    public function store(Request $request)
    {
    //print_r($_FILES);

    //dd($request);


       if(!checkRole(getUserGrade(2)))
      {
        prepareBlockUserMessage();
        return back();
      }
    	 
	    $rules = [
         'subject_id'          	        => 'bail|required|integer' ,
         'title'          	   			=> 'bail|required|max:260' ,
         'content_type'                 => 'bail|required',
         'code'                         => 'bail|required|unique:lmscontents',
        
        ];
        $file_path = '';
        switch ($request->content_type) {
            case 'url':
            case 'video_url':
            case 'audio_url':
            case 'iframe':
                    $rules['file_path'] = 'bail|required';
                    $file_path = $request->file_path;
                break;
            case 'file' :
                     $rules['lms_file'] = 'bail|required';
                    $file_path = $request->lms_file;
                break;
            case 'video' :

                      $rules['lms_file'] = 'bail|required';
                    $file_path = $request->lms_file;
                break;
            case 'audio' :
                    $rules['lms_file'] = 'bail|required';
                    $file_path = $request->lms_file;
                break;
            case 'iframe' : 
                    $rules['file_path'] = 'bail|required';
                    $file_path = $request->file_path;
        }



        $customMessages = [
            'required' => 'The :attribute field is required.'
        ];
        $this->validate($request, $rules,$customMessages);
     DB::beginTransaction();
       try{
            $record = new LmsContent();
            $name  						=  $request->title;
            $record->title 				= $name;

//
//            $slug=str_slug($name);
//            $record2 = LmsContent::getRecordWithSlug($slug);
//
//            if($isValid = $this->isValidRecord($record2))
//               $slug=$slug.'-'.rand(1,20);
//
//            $record->slug 				= $slug;
            $record->subject_id         = $request->subject_id;
            $record->code               = $request->code;
            $record->content_type 		= $request->content_type==null?'':$request->content_type;
            if($request->video_length){
               $record->video_length       = $request->video_length;
            }
           if($request->preview){
               $record->preview       = $request->preview;
           }
            if($request->download_allowed){
                $record->download_allowed       = $request->download_allowed;
            }else{
                $record->download_allowed=0;
            }
            $record->file_path 		   = $file_path;
            $record->description		= $request->description==null?'':$request->description;
            $record->record_updated_by 	= Auth::user()->id;
            $record->record_added_by 	= Auth::user()->id;


           /********* log it **********/
           $oldData = $record;
           if($record->save()) {
               $oldData    =   [];
               $oldData["user_id"]         =   Auth::user()->id;
               $oldData["operation_id"]    =   $record->id;
               $oldData["table_name"]      =   "LmsContent";
               $oldData["message"]         =   "Record Inserted: " . $record->id;
               $oldData["data_json"]       =   json_encode($oldData);
               $oldData["model_json"]      =   json_encode(array("ID" => $record->id, "Table" => "LmsContent", "Action" => "Record Inserted", "created_at" => date("Y-m-d H:i:s"), "updated_at" => date("Y-m-d H:i:s")));


               App\Logs::CreateLog((object)$oldData);
           }
           /********* log it **********/
            $file_name = 'image';
        if ($request->hasFile($file_name))
        {

            $rules = array( $file_name => 'mimes:jpeg,jpg,png,gif|max:5000' );
            $customMessages = [
                'required' => 'The :attribute field is required.'
            ];
            $this->validate($request, $rules,$customMessages);

		    $this->setSettings();
            $examSettings = $this->getSettings();
	        $path = $examSettings->contentImagepath;
	        $this->deleteFile($record->image, $path);

              $record->image      = $this->processUpload($request, $record,$file_name);
              $record->save();
        }

         $file_name = 'lms_file';
        if ($request->hasFile($file_name))
        {

             $rules = array( $file_name => 'mimes:pdf|max:20000' );
              $this->validate($request, $rules);
            $customMessages = [
                'required' => 'The :attribute field is required.'
            ];
            $this->validate($request, $rules,$customMessages);
		    $this->setSettings();
            $examSettings = $this->getSettings();
	        $path = $examSettings->contentImagepath;
	        $this->deleteFile($record->file_path, $path);

              $record->file_path      = $this->processUpload($request, $record, $file_name, FALSE);
              $record->save();
        }

         DB::commit();
        flash('success','record_added_successfully', 'success');

    }
     catch( Exception $e)
     {
        DB::rollBack();
       if(getSetting('show_foreign_key_constraint','module'))
       {

          flash('oops...!',$e->errorInfo, 'error');
       }
       else {
          flash('oops...!','improper_data_file_submitted '.$e->getMessage(), 'error');
       }
     }
        
 	return redirect(URL_LMS_CONTENT);
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
        $record = LmsContent::where('slug', $slug)->first();
        $this->setSettings();
        try{
            if(!env('DEMO_MODE')) {
                $examSettings = $this->getSettings();
                $path = $examSettings->contentImagepath;
                $this->deleteFile($record->image, $path);
                if($record->file_path!='')
                    $this->deleteFile($record->file_path, $path);
                $record->delete();
                /********* log it **********/
                $oldData = $record;
                $oldData    =   [];
                $oldData["user_id"]         =   Auth::user()->id;
                $oldData["operation_id"]    =   $record->id;
                $oldData["table_name"]      =   "LmsContent";
                $oldData["message"]         =   "Record Deleted: " . $record->id;
                $oldData["data_json"]       =   json_encode($oldData);
                $oldData["model_json"]      =   json_encode(array("ID" => $record->id, "Table" => "LmsContent", "Action" => "Record Deleted", "created_at" => date("Y-m-d H:i:s"), "updated_at" => date("Y-m-d H:i:s")));


                App\Logs::CreateLog((object)$oldData);
                /********* log it **********/
            }
            
            $response['status'] = 1;
            $response['message'] = getPhrase('category_deleted_successfully');
        }
        catch (\Illuminate\Database\QueryException $e) {
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
        $records = LmsContent::whereIn('id', $id_array);
        try{
            if(!env('DEMO_MODE')) {
                foreach ($records as $record){
                $examSettings = $this->getSettings();
                $path = $examSettings->contentImagepath;
                $this->deleteFile($record->image, $path);
                if($record->file_path!='')
                    $this->deleteFile($record->file_path, $path);
                }
                $records->delete();
                /********* log it **********/
                $oldData = $record;
                $oldData    =   [];
                $oldData["user_id"]         =   Auth::user()->id;
                $oldData["operation_id"]    =   $record->id;
                $oldData["table_name"]      =   "LmsContent";
                $oldData["message"]         =   "Record Deleted: " . $record->id;
                $oldData["data_json"]       =   json_encode($oldData);
                $oldData["model_json"]      =   json_encode(array("ID" => $record->id, "Table" => "LmsContent", "Action" => "Record Deleted", "created_at" => date("Y-m-d H:i:s"), "updated_at" => date("Y-m-d H:i:s")));


                App\Logs::CreateLog((object)$oldData);
                /********* log it **********/

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

    public function isValidRecord($record)
    {
    	if ($record === null) {

    		flash('Ooops...!', getPhrase("page_not_found"), 'error');
   			return $this->getReturnUrl();
		}

		return FALSE;
    }

    public function getReturnUrl()
    {
    	return URL_LMS_CONTENT;
    }

     public function deleteFile($record, $path, $is_array = FALSE)
    {
        if(env('DEMO_MODE')) {
            return ;
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
     public function processUpload(Request $request, $record, $file_name, $is_image = TRUE)
     {

        if(env('DEMO_MODE')) {
            return 'demo';
        }

         
         if ($request->hasFile($file_name)) {
          $settings = $this->getSettings();
          $destinationPath      = $settings->contentImagepath;
          $path = $_FILES[$file_name]['name'];
          $ext = pathinfo($path, PATHINFO_EXTENSION);

          $fileName = $record->id.'-'.$file_name.'.'.$ext;
             $file=$request->file($file_name);
             if(env('FILESYSTEM_DRIVER')=='s3'){

                 $filePath = 'lms/content/' . $fileName;
                 Storage::disk('s3')->put($filePath, file_get_contents($file));
                 if($is_image) {
                     $image_normal = Image::make($file->getRealPath())->fit($settings->imageSize);
                     uploadToS3($image_normal, 'lms/content/', $fileName);
                 }
             }else {
                 $file->move($destinationPath, $fileName);
                 if($is_image){

                     //Save Normal Image with 300x300
                     Image::make($destinationPath.$fileName)->fit($settings->imageSize)->save($destinationPath.$fileName);
                 }
             }

         return $fileName;
        }
        
     }
}
