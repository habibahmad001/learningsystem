<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App;
use App\Http\Requests;
use App\LmsLevel;
use App\LmsSettings;
use Yajra\Datatables\Datatables;
use DB;
use Auth;
use Image;
use ImageSettings;
use File;

class LmsLevelsController extends Controller
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
        $data['title']              = 'LMS'.' '.getPhrase('levels');
        $data['layout']              = getLayout();
        // return view('lms.lmslevels.list', $data);

        $view_name = getTheme().'::lms.lmslevels.list';
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

        $records = LmsLevel::select([
            'name', 'id','slug']);
        $this->setSettings();
        return Datatables::of($records)
            ->addColumn('action', function ($records) {


                return '<div class="dropdown more">
                        <a id="dLabel" type="button" class="more-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-dots-vertical"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dLabel">
                            <li><a href="'.URL_LMS_LEVELS_EDIT.$records->slug.'"><i class="fa fa-pencil"></i>'.getPhrase("edit").'</a></li>
                            
                            <li><a href="javascript:void(0);" onclick="deleteRecord(\''.$records->slug.'\');"><i class="fa fa-trash"></i>'. getPhrase("delete").'</a></li>
                        </ul>
                    </div>';
            })
            ->rawColumns(['action'])
            ->removeColumn('id')
            ->removeColumn('slug')

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
        $data['title']              = getPhrase('create_level');
        // return view('lms.lmslevels.add-edit', $data);

        $view_name = getTheme().'::lms.lmslevels.add-edit';
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
        $record = LmsLevel::getRecordWithSlug($slug);
        if($isValid = $this->isValidRecord($record))
            return redirect($isValid);

        $data['record']       		= $record;
        $data['active_class']       = 'lms';
        $data['title']              = getPhrase('edit_level');
        // return view('lms.lmslevels.add-edit', $data);
        $view_name = getTheme().'::lms.lmslevels.add-edit';
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
        $record = LmsLevel::getRecordWithSlug($slug);


        $rules = [
            'name'          	   => 'bail|required|max:60' ,
        ];
        /**
         * Check if the title of the record is changed,
         * if changed update the slug value based on the new title
         */
        $name = $request->name;
        if($name != $record->name)
            $record->slug = str_slug($name,TRUE);

        //Validate the overall request
        $this->validate($request, $rules);
        $record->name 			= $name;
        $record->record_updated_by 	= Auth::user()->id;
        /********* log it **********/
        $oldData = $record;
        if($record->save()) {
            $oldData    =   [];
            $oldData["user_id"]         =   Auth::user()->id;
            $oldData["operation_id"]    =   $record->id;
            $oldData["table_name"]      =   "LmsLevel";
            $oldData["message"]         =   "Record Updated: " . $record->id;
            $oldData["data_json"]       =   json_encode($oldData);
            $oldData["model_json"]      =   json_encode(array("ID" => $record->id, "Table" => "LmsLevel", "Action" => "Record Updated", "created_at" => date("Y-m-d H:i:s"), "updated_at" => date("Y-m-d H:i:s")));


            App\Logs::CreateLog((object)$oldData);
        }
        /********* log it **********/


        flash('success','record_updated_successfully', 'success');
        return redirect(URL_LMS_LEVELS);
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
            'name'          	   => 'bail|required|max:60' ,
        ];
        $this->validate($request, $rules);
        $record = new LmsLevel();
        $name  						=  $request->name;
        $record->name 			= $name;
        $record->slug 				= str_slug($name,TRUE);
        $record->record_updated_by 	= Auth::user()->id;
        /********* log it **********/
        $oldData = $record;
        if($record->save()) {
            $oldData    =   [];
            $oldData["user_id"]         =   Auth::user()->id;
            $oldData["operation_id"]    =   $record->id;
            $oldData["table_name"]      =   "LmsLevel";
            $oldData["message"]         =   "Record Inserted: " . $record->id;
            $oldData["data_json"]       =   json_encode($oldData);
            $oldData["model_json"]      =   json_encode(array("ID" => $record->id, "Table" => "LmsLevel", "Action" => "Record Inserted", "created_at" => date("Y-m-d H:i:s"), "updated_at" => date("Y-m-d H:i:s")));


            App\Logs::CreateLog((object)$oldData);
        }
        /********* log it **********/


        flash('success','record_added_successfully', 'success');
        return redirect(URL_LMS_LEVELS);
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
        $record = LmsLevel::where('slug', $slug)->first();

        try{

            $record->delete();

            /********* log it **********/
            $oldData = $record;
            $oldData    =   [];
            $oldData["user_id"]         =   Auth::user()->id;
            $oldData["operation_id"]    =   $record->id;
            $oldData["table_name"]      =   "LmsLevel";
            $oldData["message"]         =   "Record Deleted: " . $record->id;
            $oldData["data_json"]       =   json_encode($oldData);
            $oldData["model_json"]      =   json_encode(array("ID" => $record->id, "Table" => "LmsLevel", "Action" => "Record Deleted", "created_at" => date("Y-m-d H:i:s"), "updated_at" => date("Y-m-d H:i:s")));


            App\Logs::CreateLog((object)$oldData);
            /********* log it **********/

            $response['status'] = 1;
            $response['message'] = getPhrase('level_deleted_successfully');
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
        return URL_LMS_LEVELS;
    }



}
