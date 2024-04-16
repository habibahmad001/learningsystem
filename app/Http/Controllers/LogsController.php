<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App;
use App\Http\Requests;
use App\Logs;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Storage;
use DB;
use Auth;

class LogsController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index()
    {

    	$data['logs']   			= Logs::all();
    	$data['active_class']   	= 'logs';
    	$data['sub_active_class']   = 'logs';
    	$data['title']          	= getPhrase('admin_logs');
    	// return view('users.roles.list-roles', $data);

          $view_name = getTheme().'::logs.list';
        return view($view_name, $data);
		
    }


    /**
     * This method returns the datatables data to view
     * @return [type] [description]
     */
    public function getDatatable()
    {

        if (!checkRole(getUserGrade(2)))
        {
            prepareBlockUserMessage();
            return back();
        }

        $records = Logs::select(['id', 'user_id', 'operation_id', 'table_name', 'message'])
            ->orderBy('updated_at', 'desc');


        return Datatables::of($records)
            ->addColumn('check_course', function ($records) {

                $link_data1 = '<input name="checkbox_course[]" type="checkbox" class="delete_check" id="delcheck_'.$records->id.'"    value="'.$records->id.'">';

                return $link_data1;
            })
            ->editColumn('user_name', function($records)
            {
                return GetUserOnID($records->user_id)->first_name . " " . GetUserOnID($records->user_id)->last_name . " #$records->user_id (" . GetRoleOnID(GetUserOnID($records->user_id)->role_id)->display_name . ")";
            })
            ->editColumn('effected_item', function($records)
            {
                return $records->table_name . ": " . $records->operation_id;
            })
            ->editColumn('message', function($records)
            {
                return $records->message;
            })
            ->addColumn('action', function ($records) {

                $link_data = '<div class="dropdown more">
                        <a id="dLabel" type="button" class="more-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-dots-vertical"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dLabel">
                            <li><a href="'.URL_LOGS_VIEW.'/'.$records->id.'"><i class="fa fa-pencil"></i>'.getPhrase("view").'</a></li>
                            <li><a href="'.URL_LOGS_DELETE.'/'.$records->id.'"><i class="fas fa-times"></i>'.getPhrase("delete").'</a></li>';
                return $link_data;
            })

            ->rawColumns([ 'check_course','user_name', 'action', 'effected_item', 'message'])
            ->removeColumn('updated_at')
            ->removeColumn('id')
            ->make();

    }

    public function view(Logs $id)
    {

        $data['logs']               = $id;
        $data['active_class']       = 'logs';
        $data['title']              = getPhrase('view_log');
        $data['sub_active_class']   = 'logs';

        $data['records']         	= $data['logs'];

        $view_name = getTheme().'::logs.add-edit';
        return view($view_name, $data);

    }

    public function delete($id)
    {
         Logs::destroy($id);

         flash('success','Record_has_been_removed', 'error');
         return redirect('logs');
    }
}
