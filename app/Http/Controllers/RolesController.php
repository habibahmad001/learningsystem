<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App;
use App\Http\Requests;
use App\Role;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Storage;
use DB;
use Auth;

class RolesController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index()
    {

    	$data['roles']   			= Role::all();
    	$data['active_class']   	= 'users';
    	$data['sub_active_class']   = 'roles';
    	$data['title']          	= getPhrase('user_roles');
    	// return view('users.roles.list-roles', $data);

          $view_name = getTheme().'::users.roles.list';
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

        $records = Role::select(['id', 'name', 'display_name', 'description'])
            ->orderBy('updated_at', 'desc');


        return Datatables::of($records)
            ->addColumn('check_course', function ($records) {

                $link_data1 = '<input name="checkbox_course[]" type="checkbox" class="delete_check" id="delcheck_'.$records->id.'"    value="'.$records->id.'">';

                return $link_data1;
            })
            ->editColumn('role_title', function($records)
            {
                return $records->display_name;
            })
            ->editColumn('slug', function($records)
            {
                return $records->name;
            })
            ->editColumn('description', function($records)
            {
                return $records->description;
            })
            ->addColumn('action', function ($records) {

                $link_data = '<div class="dropdown more">
                        <a id="dLabel" type="button" class="more-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-dots-vertical"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dLabel">
                            <li><a href="'.URL_ROLES_EDIT.'/'.$records->id.'"><i class="fa fa-pencil"></i>'.getPhrase("edit").'</a></li>
                            <li><a href="'.URL_ROLES_DELETE.'/'.$records->id.'"><i class="fas fa-times"></i>'.getPhrase("delete").'</a></li>';
                return $link_data;
            })

            ->rawColumns([ 'name','display_name', 'action', 'check_course'])
            ->removeColumn('updated_at')
            ->removeColumn('id')
            ->make();

    }

    public function addRole()
    {

        $data['record']         	= FALSE;

        $data['active_class']       = 'users';
        $data['title']              = getPhrase('add_role');
        $data['sub_active_class']   = 'roles';

        // return view('users.roles.add-roles', $data);

         $view_name = getTheme().'::users.roles.add-edit';
        return view($view_name, $data);


    }


    public function edit(Role $id)
    {
        
        $data['role']               = $id;
        $data['active_class']       = 'users';
        $data['title']              = getPhrase('edit_role');
        $data['sub_active_class']   = 'roles';

        $data['record']         	= $data['role'];

        $view_name = getTheme().'::users.roles.add-edit';
        return view($view_name, $data);

    }

    public function update(Request $request)
    {
        $role = Role::find($request->id);

        $columns = array(
            'name'          => 'bail|required|max:20',
            'description'  => 'required'

        );
        $messsages = array(
            'name.required'=>'Role title is required',
            'description.required'=>'Role description is required'
        );

        $this->validate($request,$columns,$messsages);

        $role->name = str_replace(' ', '_', strtolower($request->name));
        $role->display_name = $request->name;
        $role->description = $request->description;

        if($request->is_admin) {
            $role->role_permission = NULL;
        } else {
            if(count($request->permi) > 0) {
                $role->role_permission = json_encode($request->permi);
            }
        }

        $role->save();

        flash('success','record_updated_successfully', 'success');
        return redirect('roles');
    }

    public function store(Request $request)
    {

        $columns = array(
            'name'          => 'bail|required|unique:roles|max:20',
            'description'  => 'required'

        );
        $messsages = array(
            'name.required'=>'Role title is required',
            'description.required'=>'Role description is required',
            'name.unique'=>'Role should be unique!'
        );

        $this->validate($request,$columns,$messsages);
        
        $role = new Role();
        $role->name = str_replace(' ', '_', strtolower($request->name));
        $role->display_name = $request->name;
        $role->description = $request->description;

        if($request->is_admin) {

        } else {
            if(count($request->permi) > 0) {
                $role->role_permission = json_encode($request->permi);
            }
        }

        $role->save();
      
        flash('success','Record_added_successfully', 'success');
    	return redirect('roles');
    }

    public function delete($id)
    {
         Role::destroy($id);

         flash('success','Record_has_been_removed', 'error');
         return redirect('roles');
    }
}
