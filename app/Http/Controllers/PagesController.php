<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App;
use App\Http\Requests;
use App\Page;
use Yajra\Datatables\Datatables;
use DB;
use Auth;

class PagesController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    /**
     * [pages listing method]
     * @return [type] [description]
     */
    public function index()
    {
        if (!checkRole(getUserGrade(2)))
        {
        	prepareBlockUserMessage();
        	return back();
        }

        $data['active_class']     = 'pages';
        $data['title']            = getPhrase('pages');
    	// return view('pages.list', $data);
        $view_name = getTheme().'::pages.list';
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

        $records = array();
 
        $records = Page::select(['id','name','status','slug'])
            			->orderBy('updated_at', 'desc');


        return Datatables::of($records)
            ->addColumn('check_course', function ($records) {

                $link_data1 = '<input name="checkbox_course[]" type="checkbox" class="delete_check" id="delcheck_'.$records->id.'"    value="'.$records->id.'">';

                return $link_data1;
            })
            ->editColumn('name', function($records)
            {
                return '<a target="_blank" href="'.URL_PAGE.$records->slug.'">'.$records->name.'</a>';
            })
            ->addColumn('action', function ($records) {
         
          $link_data = '<div class="dropdown more">
                        <a id="dLabel" type="button" class="more-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-dots-vertical"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dLabel">
                            <li><a href="'.URL_PAGES_EDIT.$records->slug.'"><i class="fa fa-pencil"></i>'.getPhrase("edit").'</a></li>';
                            
                           $temp = '';
                           if(checkRole(getUserGrade(1))) {
                    $temp .= ' <li><a href="javascript:void(0);" onclick="deleteRecord(\''.$records->slug.'\');"><i class="fa fa-trash"></i>'. getPhrase("delete").'</a></li>';
                      }
                    
                    $temp .='</ul></div>';

                    $link_data .=$temp;
            return $link_data;
            })
        ->editColumn('status', function($records)
        {
            return ($records->status == 1) ? '<i class="fa fa-check text-success"></i>' : '<i class="fa fa-times text-danger"></i>';
        })
            ->rawColumns([ 'status','name', 'action','check_course'])
            ->removeColumn('slug')
            ->removeColumn('updated_at')
        ->removeColumn('id')
        ->make();

    }



     /**
     * This method loads the create view
     * @return void
     */
    public function create()
    {
        if (!checkRole(getUserGrade(2)))
        {
        	prepareBlockUserMessage();
        	return back();
        }

    	$data['record']         	= FALSE;
    	$data['active_class']       = 'pages';
    	$data['title']              = getPhrase('create_page');
    	// return view('pages.add-edit', $data);
         $view_name = getTheme().'::pages.add-edit';
        return view($view_name, $data);
    }


    public function store(Request $request)
    {
	    if (!checkRole(getUserGrade(2)))
	    {
	        prepareBlockUserMessage();
	        return back();
	    }

	    $rules = [
         'name'        => 'bail|required|max:50',
         'content'     => 'bail|required'
        ];

        $this->validate($request, $rules);

        $record = new Page();

//        $name  					= $request->name;
//        $slug=str_slug($name);
//        $record2 = Page::getRecordWithSlug($slug);
//
//        if($isValid = $this->isValidRecord($record2))
//            $slug=$slug.'-'.rand(1,20);
//

		$record->name 			= $request->name;
      // 	$record->slug 			= $slug;
        $record->content		= $request->content;
        $record->status			= $request->status;
        $record->save();

        flash('success','record_added_successfully', 'success');
    	return redirect(URL_PAGES);
    }
 


    public function edit($slug)
    {
      	if (!checkRole(getUserGrade(2)))
      	{
        	prepareBlockUserMessage();
        	return back();
      	}

    	$record = Page::getRecordWithSlug($slug);

    	if($isValid = $this->isValidRecord($record))
    		return redirect($isValid);


    	$data['record']       		= $record;
    	$data['active_class']     	= 'pages';
    	$data['settings']       	= FALSE;
      	$data['title']            = getPhrase('edit_page');
    	// return view('pages.add-edit', $data);
         $view_name = getTheme().'::pages.add-edit';
        return view($view_name, $data);
    }


    public function update(Request $request, $slug)
    {
    	//dd($request);

        if (!checkRole(getUserGrade(2)))
        {
        	prepareBlockUserMessage();
        	return back();
        }

    	$record = Page::getRecordWithSlug($slug);

    	if($isValid = $this->isValidRecord($record))
    		return redirect($isValid);


		$rules = [
         'name'        => 'bail|required|max:50',
         'content'     => 'bail|required'
        ];

        //Validate the overall request
        $this->validate($request, $rules);


        /**
        * Check if the title of the record is changed, 
        * if changed update the slug value based on the new title
        */
        $name = $request->name;
//        if($name != $record->name)
//            $record->slug = str_slug($name);
//
//

        $record->name           = $name;
        $record->content   		= $request->content;
        $record->status         = $request->status;
        $record->save();

        flash('success','record_updated_successfully', 'success');
    	return redirect(URL_PAGES);
    }


    public function delete($slug)
    {
        if (!checkRole(getUserGrade(2)))
        {
        	prepareBlockUserMessage();
        	return back();
        }

       /**
       * Delete the page 
       * @var [type]
       */
        $record = Page::where('slug', $slug)->first();

        try {
            if (!env('DEMO_MODE')) {
                $record->delete();
            }
            $response['status'] = 1;
            $response['message'] = getPhrase('record_deleted_successfully');
        }
        catch ( \Illuminate\Database\QueryException $e) {

            $response['status']  = 0;
	        $response['message'] =  getPhrase('record_not_deleted');
        }
        return json_encode($response);
    }
    public function deleteMultiple(Request $request)
    {
        if (!checkRole(getUserGrade(2))) {
            prepareBlockUserMessage();
            return back();
        }
        //$record = Post::where('slug', $slug)->first();
        $id_array = $request->input('deleteids_arr');
        $records_obj = Page::whereIn('id', $id_array);
        try {
            if (!env('DEMO_MODE')) {

                $records_obj->delete();
            }

            $response['status'] = 1;
            $response['message'] = getPhrase('post_deleted_successfully');
        } catch (\Illuminate\Database\QueryException $e) {
            $response['status'] = 0;
            if (getSetting('show_foreign_key_constraint', 'module'))
                $response['message'] = $e->errorInfo;
            else
                $response['message'] = getPhrase('this_record_is_in_use_in_other_modules');
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
    	return URL_PAGES;
    }
}
