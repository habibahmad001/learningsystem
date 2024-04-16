<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Assignment;
use Auth;
use App\LmsSeries;
use DB;
use Image;
use ImageSettings;
use File;
use Illuminate\Support\Facades\Storage;
class AssignmentController extends Controller
{

    protected  $examSettings;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function setSettings()
    {
        $this->examSettings = getSettings('lms');
    }

    public function getSettings()
    {
        return $this->examSettings;
    }

    public function submit(Request $request, $id) {





//        $record = new Assignment();
//        $name  						=  $request->title;
//        $record->title 				= $name;
//        $record->slug 				= str_slug($name);
//        $record->subject_id         = $request->subject_id;
//        $record->code               = $request->code;
//        $record->content_type 		= $request->content_type;
//
//        $record->file_path 		   = $file_path;
//        $record->description		= $request->description;
//        $record->record_updated_by 	= Auth::user()->id;
//
//
//        $record->save();
        $record = Assignment::create([
                'user_id' => Auth::User()->id,
                'instructor_id' => $request->instructor_id,
                'course_id' => $id,
                'chapter_id' => $request->course_chapters,
                'title' => $request->title,
                'type' => 0
            ]
        );

        $file_name = 'assignment';
        if ($request->hasFile($file_name))
        {

            // $rules = array( $file_name => 'mimes:jpeg,jpg,png,gif|max:10000' );
            // $this->validate($request, $rules);
            $this->setSettings();
            $examSettings = $this->getSettings();
            $path = $examSettings->contentImagepath;
            $this->deleteFile($record->file_path, $path);

            $record->assignment      = $this->processUpload($request, $record, $file_name, FALSE);
            $record->save();
        }

        DB::commit();
        //   flash('success','Assignment is Submitted Successfully', 'success');

         return back()->with('success','Assignment is Submitted Successfully');

    }

    public function index() 
    {

        $data['active_class']       = 'lms';
        $data['title'] = getPhrase('Assignments');
        $assignment = Assignment::all();
        $data['assignment']=$assignment;

        return view(getTheme() . '::lms.assignment.index',$data);


    }

    public function show($id)
    {
        $assign = Assignment::find($id);
        $data['active_class']       = 'lms';
        $data['title'] = getPhrase('Assignments');
        $data['assign']=$assign;
        return view(getTheme() . '::lms.assignment.view',$data);
    }

    public function update(Request $request, $id)
    {
        // return 'fvbnm';

        $data = Assignment::findorfail($id);
        $maincourse = LmsSeries::findorfail($request->course_id);
        $input['type'] = $request->type;
        

        if(isset($request->type))
        {
            
            Assignment::where('id', $id)
                    ->update(['rating' => $request->rating, 'type' => 1]);
            
        }
        else
        { 
            
            Assignment::where('id', $id)
                    ->update(['rating' => NULL, 'type' => 0]);
            
        }

        

        return redirect()->route('course.show',$maincourse->id);

    }

    public function destroy($id)
    {

        $assign = Assignment::find($id);

        if($assign->assignment != null)
        {
                
            $image_file = @file_get_contents(public_path().'/files/assignment/'.$assign->assignment);

            if($image_file)
            {
                unlink(public_path().'/files/assignment/'.$assign->assignment);
            }
        }

        Assignment::where('id', $id)->delete();
        return back()->with('delete','Assignment is Deleted');
    }

    public function delete_old($id)
    {

        $assign = Assignment::find($id);

        if($assign->assignment != null)
        {
                
            $image_file = @file_get_contents(public_path().'/files/assignment/'.$assign->assignment);

            if($image_file)
            {
                unlink(public_path().'/files/assignment/'.$assign->assignment);
            }
        }

        Assignment::where('id', $id)->delete();
        return back()->with('delete','Assignment is Deleted');
    }


    public function view()
    {

        if(Auth::user()->role == "admin") 
        {
            $courses = LmsSeries::get();
        }
        else{
            $courses = LmsSeries::where('user_id', Auth::user()->id)->get();
        }


        $data['active_class']       = 'lms';
        $data['title'] = getPhrase('Assignments');

        $data['courses']=$courses;

        return view(getTheme() . '::lms.assignment.course',$data);

    }


    public function assignment($id)
    {
        $assignment = Assignment::where('course_id', $id)->get();

        $data['active_class']       = 'lms';
        $data['title'] = getPhrase('Assignments');

        $data['assignment']=$assignment;

        return view(getTheme() . '::lms.assignment.index',$data);

    }

    public function delete($id)
    {

//        if(!checkRole(getUserGrade(3)))
//        {
//            prepareBlockUserMessage();
//            return back();
//        }
        $record = Assignment::find($id);
      //  dd($record);

      //  $record = Assignment::where('slug', $slug)->first();
        $this->setSettings();
        try{
            if(!env('DEMO_MODE')) {
                $examSettings = $this->getSettings();
                $path = $examSettings->contentImagepath;
                $this->deleteFile($record->image, $path);
                if($record->file_path!='')
                    $this->deleteFile($record->file_path, $path);
                $record->delete();
            }

            $response['status'] = 1;
            $response['message'] = getPhrase('assignment_deleted_successfully');
        }
        catch (\Illuminate\Database\QueryException $e) {
            $response['status'] = 0;
            if(getSetting('show_foreign_key_constraint','module'))
                $response['message'] =  $e->errorInfo;
            else
                $response['message'] =  getPhrase('this_record_is_in_use_in_other_modules');
        }
//        return json_encode($response);
        return back()->with('delete','Assignment is Deleted');
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
            return $this->getRedirectUrl();
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
            $destinationPath      = $settings->seriesAssignmentpath;
            $path = $_FILES[$file_name]['name'];
            $ext = pathinfo($path, PATHINFO_EXTENSION);

            $fileName = $record->id.'-'.$file_name.'.'.$ext;
            $file=$request->file($file_name);


            if(env('FILESYSTEM_DRIVER')=='s3'){

                $filePath = 'lms/series/assignments/' . $fileName;
                Storage::disk('s3')->put($filePath, file_get_contents($file));


            }else{
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
