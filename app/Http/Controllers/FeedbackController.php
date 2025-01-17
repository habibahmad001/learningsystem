<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use \App;
use App\Feedback;
use Yajra\Datatables\Datatables;
use DB;
use Auth;
class FeedbackController extends Controller
{
     public function __construct()
    {
    	$this->middleware('auth');
     

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

        $data['active_class'] = 'feedback';
        $data['layout']       = getLayout();
        $data['title']        = getPhrase('feed_backs');
    	  // return view('feedbacks.list', $data);
         $view_name = getTheme().'::feedbacks.list';
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

        $records = array();


            $records = Feedback::join('users', 'users.id','=','feedbacks.user_id')
            ->select(['title', 'image','users.name','feedbacks.subject','description','feedbacks.slug', 'feedbacks.id', 'feedbacks.updated_at'])
            ->orderBy('updated_at', 'desc');

        return Datatables::of($records)
        ->addColumn('action', function ($records) {
         
          $link_data = '<div class="dropdown more">
                        <a id="dLabel" type="button" class="more-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-dots-vertical"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dLabel">
                           <li><a href="'.URL_FEEDBACK_VIEW.$records->slug.'"><i class="fa fa-eye"></i>'.getPhrase("view").'</a></li>
                           <li><a href="' . URL_FEEDBACK_EDIT . $records->slug . '"><i class="fa fa-pencil"></i>' . getPhrase("edit") . '</a></li>';
                           
                            
                           $temp = '';
                           if(checkRole(getUserGrade(1))) {
                    $temp .= '<li><a href="javascript:void(0);" onclick="deleteRecord(\''.$records->slug.'\');"><i class="fa fa-trash"></i>'. getPhrase("delete").'</a></li>';
                      }
                    
                    $temp .='</ul></div>';


                    $link_data .=$temp;
            return $link_data;
            })
        ->editColumn('title', function($records)
        {
        	return '<a href="'.URL_FEEDBACK_VIEW.$records->slug.'">'.$records->title.'</a>';
        })
        ->editColumn('image', function($records)
        {
          $image = getProfilePath($records->image);

            return '<img src="'.$image.'" height="60" width="60"  />';
        })
            ->rawColumns(['title', 'image', 'action'])
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
      
//      if(checkRole(getUserGrade(2)))
//      {
//        return back();
//      }
      
    	$data['record']         	= FALSE;
    	$data['layout']         	= getLayout();
    	$data['active_class']       = 'feedback';
      	$data['title']              = getPhrase('give_feedback');
        $data['users'] = array_pluck(App\User::all(), 'name', 'id');
        $user_id 	= Auth::user()->id;
        if(getRole($user_id)=='student'){
            $data['user_id'] 	= $user_id;
        }else{
            $data['user_id'] 	= null;
        }
        $data['user_id'] 	= Auth::user()->id;
    	// return view('feedbacks.add-edit', $data);
        $view_name = getTheme().'::feedbacks.add-edit';
        return view($view_name, $data);
    }

     /**
     * This method adds record to DB
     * @param  Request $request [Request Object]
     * @return void
     */

    public function edit($slug)
    {
        if (!checkRole(getUserGrade(2))) {
            prepareBlockUserMessage();
            return back();
        }
        $record = Feedback::getRecordWithSlug($slug);
        if ($isValid = $this->isValidRecord($record))
            return redirect($isValid);

        $data['record'] = $record;
        $data['title'] = getPhrase('edit');
        $data['active_class'] = 'feedbacks';
        $data['users'] = array_pluck(App\User::all(), 'name', 'id');
        $data['settings'] = json_encode($record);

        $data['user_id'] 	= Auth::user()->id;
        $data['layout'] = getLayout();
        $view_name = getTheme() . '::feedbacks.add-edit';
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
//        if (!checkRole(getUserGrade(2))) {
//            prepareBlockUserMessage();
//            return back();
//        }

        $record = Feedback::getRecordWithSlug($slug);
        $rules = [
            'title'          	   	   => 'bail|required|max:240' ,
            'subject'          	   => 'bail|required|max:240' ,
            'description'             => 'bail|required' ,
        ];


        $this->validate($request, $rules);
        DB::beginTransaction();
        try {

            $this->validate($request, $rules);
             $name  						=  $request->title;
            $record->title 				= $name;
            //$record->slug 				= str_slug($name);
            $record->subject			= $request->subject;
            $record->description		= $request->description;
            $record->user_id			= $request->user_id;

            //$record->user_id			= Auth::user()->id;
            $record->save();




            DB::commit();
            flash('success', 'record_updated_successfully', 'success');

        } catch (Exception $e) {
            DB::rollBack();
            if (getSetting('show_foreign_key_constraint', 'module')) {

                flash('oops...!', $e->errorInfo, 'error');
            } else {
                flash('oops...!', 'improper_data_file_submitted', 'error');
            }
        }
        return redirect(URL_FEEDBACKS);
    }



    public function store(Request $request)
    {
      

	    $rules = [
         'title'          	   	   => 'bail|required|max:240' ,
         'subject'          	   => 'bail|required|max:240' ,
         'description'             => 'bail|required' ,
          ];
          // dd($request);
        $this->validate($request, $rules);
        $record = new Feedback();
      	$name  						=  $request->title;
		$record->title 				= $name;
       	//$record->slug 				= str_slug($name);
        $record->subject			= $request->subject;
        $record->description		= $request->description;
        $record->user_id			= $request->user_id;

        //$record->user_id			= Auth::user()->id;
        $record->save();
     
        flash('success','feedback_submitted_successfully', 'success');
    	return redirect(URL_FEEDBACK_SEND);
    }

    public function details($slug)
    {
    
    	$record = Feedback::where('slug','=',$slug)->first();
    
    	if($isValid = $this->isValidRecord($record))
    		return redirect($isValid);

    	$data['record']         	= $record;
    	$data['layout']         	= getLayout();
    	$data['active_class']       = 'feedback';
      	$data['title']              = getPhrase('feedback_details');
    	// return view('feedbacks.details', $data);
      $view_name = getTheme().'::feedbacks.details';
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
       if(!checkRole(getUserGrade(2)))
      {
        return URL_FEEDBACK_SEND;
      }
      return URL_FEEDBACK_VIEW;
    	
    }

    public function delete($slug)
    {
     if(!checkRole(getUserGrade(2)))
      {
        prepareBlockUserMessage();
        return back();
      }
	 $record = Feedback::where('slug', $slug)->first();
    
    if(!env('DEMO_MODE')) {
	     $record->delete();
    }

	 $response['status'] = 1;
     $response['message'] = getPhrase('deleted_successfully');
        return json_encode($response);
    }

}
