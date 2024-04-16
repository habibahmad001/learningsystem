<?php
namespace App\Http\Controllers;
use \App;
use Illuminate\Http\Request;
use PHPUnit\Framework\Exception;
use App\Http\Requests;
use App\AwardingBodies;
use Yajra\Datatables\Datatables;
use DB;
use Auth;
use Image;
use ImageSettings;
use File;

class AwardingBodiesController extends Controller
{

    public function __construct()
    {
    	$this->middleware('auth');


    }

    protected  $postSettings;

    public function setPostSettings()
    {
        $this->postSettings = getSettings('lms');
        //$path = $examSettings->awardingbodyImagepath;
        //$this->postSettings = getPostSettings();
    }

    public function getPostSettings()
    {
        return $this->postSettings;
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

        $data['active_class']       = 'awarding bodies';
        $data['title']              = getPhrase('awarding_bodies');

         $view_name = getTheme().'::lms.lmsawardingbodies.list';
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

         $records = AwardingBodies::select([
         	'name', 'image', 'description','id','slug'])
         ->orderBy('updated_at', 'desc');
         $this->setPostSettings();
        // dd($records);
        return Datatables::of($records)
        ->addColumn('action', function ($records) {

         $link_data = '<div class="dropdown more">
                        <a id="dLabel" type="button" class="more-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-dots-vertical"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dLabel">
                            <li><a href="'.URL_LMS_AWARDINGBODIES_EDIT.'/'.$records->slug.'"><i class="fa fa-pencil"></i>'.getPhrase("edit").'</a></li>';


        $temp = '';
        if(checkRole(getUserGrade(1))) {
        $temp .= '<li><a href="javascript:void(0);" onclick="deleteRecord(\''.$records->slug.'\');"><i class="fa fa-trash"></i>'. getPhrase("delete").'</a></li>';
        }
        $temp .='</ul></div>';

        $link_data = $link_data.$temp;
            return $link_data;
            })
        ->removeColumn('id')
        ->removeColumn('slug')
        ->editColumn('image', function($records){
            $settings = $this->getPostSettings();
            $path = $settings->awardingbodyImagepath;
            $image = $path.$settings->defaultCategoryImage;
            if($records->image)
                $image = $path.$records->image;
            return '<img src="'.$image.'" height="50" />';
        })
          ->rawColumns(['image','action'])
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
    	$data['active_class']       = 'awardingbodies';
    	$data['title']              = getPhrase('create_awarding_body');
    	// return view('lms.lmsawardingbodies.add-edit', $data);

           $view_name = getTheme().'::lms.lmsawardingbodies.add-edit';
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

    	$record = AwardingBodies::getRecordWithSlug($slug);
    	if($isValid = $this->isValidRecord($record))
    		return redirect($isValid);

    	$data['record']       		= $record;
    	$data['active_class']       = 'awardingbody';
    	$data['title']              = getPhrase('edit_awarding_body');
    	// return view('lms.lmsawardingbodies.add-edit', $data);

          $view_name = getTheme().'::lms.lmsawardingbodies.add-edit';
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

    	$record = AwardingBodies::getRecordWithSlug($slug);
		$rules = [
         'name'          => 'bail|required|max:60',
          'catimage'         => 'bail|mimes:png,jpg,jpeg|max:10000'
          ];
         /**
        * Check if the title of the record is changed,
        * if changed update the slug value based on the new title
        */
       $name = $request->name;
        if($name != $record->name)
            $record->slug = str_slug($name);

       //Validate the overall request
       $this->validate($request, $rules);
    	$record->name 			= $name;
        $record->description		= $request->description;
        $record->record_updated_by 	= Auth::user()->id;
        /********* log it **********/
        $oldData = $record;
        if($record->save()) {
            $oldData    =   [];
            $oldData["user_id"]         =   Auth::user()->id;
            $oldData["operation_id"]    =   $record->id;
            $oldData["table_name"]      =   "AwardingBodies";
            $oldData["message"]         =   "Record Updated: " . $record->id;
            $oldData["data_json"]       =   json_encode($oldData);
            $oldData["model_json"]      =   json_encode(array("ID" => $record->id, "Table" => "AwardingBodies", "Action" => "Record Updated", "created_at" => date("Y-m-d H:i:s"), "updated_at" => date("Y-m-d H:i:s")));


            App\Logs::CreateLog((object)$oldData);
        }
        /********* log it **********/
 		 $file_name = 'catimage';
 		if ($request->hasFile($file_name))
        {

             $rules = array( $file_name => 'mimes:jpeg,jpg,png,gif|max:10000' );
              $this->validate($request, $rules);
            $path = IMAGE_PATH_UPLOAD_LMS_AWARDING_BODIES;
//            $this->setPostSettings();
//            $postSettings = $this->getPostSettings();
//            $path = $postSettings->awardingbodyImagepath;
              $this->deleteFile($record->image, $path);
              $record->image      = $this->processUpload($request, $record,$file_name);
              $record->save();
        }

        flash('success','record_updated_successfully', 'success');
    	return redirect(URL_LMS_AWARDINGBODIES);
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
// catimage
        try {
	    $rules = [
         'name'          	   => 'bail|required|max:160' ,
         'catimage'                => 'bail|mimes:png,jpg,jpeg|max:10000'
            ];
        $this->validate($request, $rules);
        $record = new AwardingBodies();
      	$name  						=  $request->name;
		$record->name 			= $name;
       	$record->slug 				= str_slug($name);
        $record->description		= $request->description;
        $record->record_updated_by 	= Auth::user()->id;
        /********* log it **********/
        $oldData = $record;
        if($record->save()) {
            $oldData    =   [];
            $oldData["user_id"]         =   Auth::user()->id;
            $oldData["operation_id"]    =   $record->id;
            $oldData["table_name"]      =   "AwardingBodies";
            $oldData["message"]         =   "Record Inserted: " . $record->id;
            $oldData["data_json"]       =   json_encode($oldData);
            $oldData["model_json"]      =   json_encode(array("ID" => $record->id, "Table" => "AwardingBodies", "Action" => "Record Inserted", "created_at" => date("Y-m-d H:i:s"), "updated_at" => date("Y-m-d H:i:s")));


            App\Logs::CreateLog((object)$oldData);
        }
        /********* log it **********/
        $file_name = 'catimage';
        if ($request->hasFile($file_name))
        {

            $rules = array( $file_name => 'mimes:jpeg,jpg,png,gif|max:10000' );
            $this->validate($request, $rules);
		    $this->setPostSettings();
            $postSettings = $this->getPostSettings();
	        $path = $postSettings->awardingbodyImagepath;
	        $this->deleteFile($record->image, $path);

              $record->image      = $this->processUpload($request, $record,$file_name);
              $record->save();
        }
        }

//catch exception
        catch(\Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }
        flash('success','record_added_successfully', 'success');
    	return redirect(URL_LMS_AWARDINGBODIES);
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
        $record = AwardingBodies::where('slug', $slug)->first();

        try{
            $this->setPostSettings();

            //$examSettings = $this->getSettings();
            $path = IMAGE_PATH_UPLOAD_LMS_AWARDING_BODIES;
            $r =  $record;
            if(!env('DEMO_MODE')) {
                $record->delete();
                $this->deleteFile($r->image, $path);

                /********* log it **********/
                $oldData = $record;
                $oldData    =   [];
                $oldData["user_id"]         =   Auth::user()->id;
                $oldData["operation_id"]    =   $record->id;
                $oldData["table_name"]      =   "AwardingBodies";
                $oldData["message"]         =   "Record Deleted: " . $record->id;
                $oldData["data_json"]       =   json_encode($oldData);
                $oldData["model_json"]      =   json_encode(array("ID" => $record->id, "Table" => "AwardingBodies", "Action" => "Record Deleted", "created_at" => date("Y-m-d H:i:s"), "updated_at" => date("Y-m-d H:i:s")));


                App\Logs::CreateLog((object)$oldData);
                /********* log it **********/
            }

            $response['status'] = 1;
            $response['message'] = getPhrase('awarding_body_deleted_successfully');
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



 /*   public function delete($slug)
    {
         if(!checkRole(getUserGrade(2)))
        {
          prepareBlockUserMessage();
          return back();
        }

        $record = AwardingBodies::where('slug', $slug)->first();
            try{
            if(!env('DEMO_MODE')) {
                $this->setPostSettings();
                $postSettings = $this->getPostSettings();
                $path = $postSettings->awardingbodyImagepath;
                $this->deleteFile($record->image, $path);
                $record->delete();
            }
            $response['status'] = 1;
            $response['message'] = getPhrase('awarding_body_deleted_successfully');

       } catch ( \Illuminate\Database\QueryException $e) {
                 $response['status'] = 0;
           if(getSetting('show_foreign_key_constraint','module'))
            $response['message'] =  $e->errorInfo;
           else
            $response['message'] =  getPhrase('this_record_is_in_use_in_other_modules');
       }
       return json_encode($response);

    }*/

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
    	return URL_LMS_AWARDINGBODIES;
    }

     public function deleteFile($record, $path, $is_array = FALSE)
    {
         if(env('DEMO_MODE')) {
        return ;
       }

        $files = array();
        $files[] = $path.$record;
        File::delete($files);
    }

     /**
     * This method process the image is being refferred
     * by getting the settings from ImageSettings Class
     * @param  Request $request   [Request object from user]
     * @param  [type]  $record    [The saved record which contains the ID]
     * @param  [type]  $file_name [The Name of the file which need to upload]
     * @return [type]             [description]
     */
     public function processUpload(Request $request, $record, $file_name)
     {
         if(env('DEMO_MODE')) {
        return ;
       }

         if ($request->hasFile($file_name)) {
             $this->setPostSettings();
             $postSettings = $this->getPostSettings();

             $path = $postSettings->awardingbodyImagepath;

          $destinationPath      = $path;

          $fileName = $record->id.'-'.$file_name.'.'.$request->$file_name->guessClientExtension();
             if(env('FILESYSTEM_DRIVER')=='s3'){
                 $file=$request->file($file_name);
                 $image_normal = Image::make($file->getRealPath())->fit(125);

                 uploadToS3($image_normal,'lms/awardingbodies/',$fileName);
             }else{
                 $request->file($file_name)->move($destinationPath, $fileName);

                 //Save Normal Image with 300x300
                 Image::make($destinationPath.$fileName)->save($destinationPath.$fileName);
//          Image::make($destinationPath.$fileName)->fit($postSettings->imageSize)->save($destinationPath.$fileName);

             }
          return $fileName;
        }
     }
}
