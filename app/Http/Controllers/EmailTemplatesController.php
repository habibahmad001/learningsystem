<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\EmailTemplate;
use Yajra\Datatables\Datatables;
use DB;
use Auth;

class EmailTemplatesController extends Controller
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

        $data['active_class']       = 'master_settings';
        $data['title']              = getPhrase('email_templates');
    	// return view('emails.templates.list', $data);
         $view_name = getTheme().'::emails.templates.list';
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

         $records = EmailTemplate::select([
         	'title', 'subject', 'type', 'from_email', 'from_name', 'id','slug'])
         ->orderBy('updated_at', 'DESC');
       
        return Datatables::of($records)
            ->addColumn('action', function ($records) {
         

            return '<div class="dropdown more">
                        <a id="dLabel" type="button" class="more-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-dots-vertical"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dLabel">
                            <li><a href="'.URL_EMAIL_TEMPLATES_EDIT.'/'.$records->slug.'"><i class="fa fa-pencil"></i>'.getPhrase("edit").'</a></li>
                            <li><a href="'.URL_EMAIL_TEMPLATES_VIEW.'/'.$records->id.'"><i class="fa fa-search"></i>'.getPhrase("preview").'</a></li>
                            <li><a href="'.URL_EMAIL_TEMPLATES_DUPLICATE.'/'.$records->id.'"><i class="fa fa-pencil"></i>'.getPhrase("duplicate").'</a></li>
                        
                        </ul>
                    </div>';
            })
            ->rawColumns([ 'action'])
        ->removeColumn('id')
        ->removeColumn('slug')
        
        ->make();
    }

    /**
     * This method loads the create view
     * @return void
     */

    public function duplicate($id)
    {
        $record = EmailTemplate::find($id);
        $newRecord = $record->replicate();
        $newRecord->slug = $record->slug.'-copy';
        $newRecord->title = $record->title.'_copy';
        $newRecord->save();

        $data['active_class']       = 'master_settings';
        $data['title']              = getPhrase('email_templates');

        $view_name = getTheme().'::emails.templates.list';
        return view($view_name, $data);


    }



    public function create()
    {
        if(!checkRole(getUserGrade(2)))
      {
        prepareBlockUserMessage();
        return back();
      }

    	$data['record']         	= FALSE;
    	$data['active_class']       = 'master_settings';
    	$data['title']              = getPhrase('create_template');
    	// return view('emails.templates.add-edit', $data);
         $view_name = getTheme().'::emails.templates.add-edit';
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
    	$record = EmailTemplate::getRecordWithSlug($slug);
    	if($isValid = $this->isValidRecord($record))
    		return redirect($isValid);

    	$data['record']       		= $record;
    	$data['active_class']       = 'master_settings';
    	$data['title']              = getPhrase('edit_template');
    	// return view('emails.templates.add-edit', $data);
           $view_name = getTheme().'::emails.templates.add-edit';
        return view($view_name, $data);
    }


    public function view($id)
    {
        if(!checkRole(getUserGrade(2)))
        {
            prepareBlockUserMessage();
            return back();
        }
        $record = EmailTemplate::find($id);
        if($isValid = $this->isValidRecord($record))
            return redirect($isValid);

        $data['record']       		= $record;
        $data['active_class']       = 'master_settings';
        $data['title']              = getPhrase('view_template');
        // return view('emails.templates.add-edit', $data);
        $view_name = getTheme().'::emails.templates.view';
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

    	$record = EmailTemplate::getRecordWithSlug($slug);
		 $rules = [
         'title'          	   => 'bail|required|max:130' ,
         'subject'             => 'bail|required|max:230' ,
         'from_email'          => 'bail|email|required|max:130' ,
         'from_name'           => 'bail|required|max:130' ,
             'content'             => 'bail|required' ,
            ];
         /**
        * Check if the title of the record is changed, 
        * if changed update the slug value based on the new title
        */
       $name = $request->title;
        if($name != $record->title)
            $record->slug = str_slug($name);
      
       //Validate the overall request
        $this->validate($request, $rules);
        $record->title 			    = $name;
    	$record->content			= $request->content;
     
        $record->subject			= $request->subject;
        $record->from_email			= $request->from_email;
        $record->from_name			= $request->from_name;
        $record->record_updated_by 	= Auth::user()->id;
 		$record->save();

        flash('success','record_updated_successfully', 'success');
    	return redirect(URL_EMAIL_TEMPLATES);
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
            'title'          	   => 'bail|required|max:130' ,
            'subject'             => 'bail|required|max:230' ,
            'from_email'          => 'bail|email|required|max:130' ,
            'from_name'           => 'bail|required|max:130' ,
         'content'             => 'bail|required' ,
            ];
        $this->validate($request, $rules);
        $record = new EmailTemplate();
      	$name  						=  $request->title;
		$record->title 			    = $name;
       	$record->slug 				= str_slug($name);
        $record->content			= $request->content;
        $record->type				= $request->type;
        $record->subject			= $request->subject;
        $record->from_email			= $request->from_email;
        $record->from_name			= $request->from_name;
        $record->record_updated_by 	= Auth::user()->id;
        $record->save();
        flash('success','record_added_successfully', 'success');
    	return redirect(URL_EMAIL_TEMPLATES);
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
    	return URL_EMAIL_TEMPLATES;
    }
   
}
