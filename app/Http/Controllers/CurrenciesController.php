<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App;
use App\Http\Requests;
use App\Currencies;
use Yajra\Datatables\Datatables;
use DB;
use Auth;
use Illuminate\Support\Facades\Validator;

class CurrenciesController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

     /**
     * [faqcategories listing method]
     * @return [type] [description]
     */
    public function index()
    {
        if (!checkRole(getUserGrade(2)))
        {
        	prepareBlockUserMessage();
        	return back();
        }

        $data['active_class']     = 'currencies';
        $data['title']            = getPhrase('Currencies');
    	// return view('faq-categories.list', $data);
        $view_name = getTheme().'::currencies.list';
        return view($view_name, $data);
    }

     /**
     * This method returns the datatables data to view
     * @return [type] [description]
     */
    public function getDatatable($slug = '')
    {
        if (!checkRole(getUserGrade(2)))
        {
        	prepareBlockUserMessage();
        	return back();
        }

        $records = array();
 
        $records = Currencies::with('country')->select(['country_id','currency_type','currency_symbol','currency_short','affected_from','rate','status','id'])
            			->orderBy('updated_at', 'desc');
             

        return Datatables::of($records)

        ->addColumn('action', function ($records) {
         
          $link_data = '<div class="dropdown more">
                        <a id="dLabel" type="button" class="more-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-dots-vertical"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dLabel">
                            <li><a href="'.URL_CURRENCIES_EDIT.$records->id.'"><i class="fa fa-pencil"></i>'.getPhrase("edit").'</a></li>';
                            
                           $temp = '';
                           if(checkRole(getUserGrade(1))) {
                    $temp .= ' <li><a href="javascript:void(0);" onclick="deleteRecord(\''.$records->id.'\');"><i class="fa fa-trash"></i>'. getPhrase("delete").'</a></li>';
                      }
                    
                    $temp .='</ul></div>';

                    $link_data .=$temp;
            return $link_data;
            })
            ->editColumn('currency_short', function($records)
            {
                return $records->currency_short.' (<i class="'.$records->currency_symbol.'"></i>)';
            })
            ->editColumn('country_id', function($records)
            {
                return $records->country->nicename;
            })
        ->editColumn('status', function($records)
        {
            return ($records->status == 'Active') ? '<i class="fa fa-check text-success"></i>' : '<i class="fa fa-times text-danger"></i>';
        })
            ->rawColumns([ 'country_id','currency_short','status','action'])
            ->removeColumn('slug')
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
    	$data['active_class']       = 'currencies';
    	$data['title']              = getPhrase('create_currency');
        $countries = array_pluck(App\Country::all(), 'nicename', 'id');
        $data['countries']     = $countries;
       // dd($data);
        $view_name = getTheme().'::currencies.add-edit';
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
         'country_id'    => 'bail|required',
         'currency_type'    => 'bail|required',
         'currency_short'    => 'bail|required',
         'currency_symbol'    => 'bail|required',
         'affected_from'    => 'bail|required',
            'rate'    => 'bail|required'
        ];

        $customMessages = [
            'required' => 'The :attribute field is required.'
        ];

        $this->validate($request, $rules,$customMessages);

        $record = new Currencies();

 		$record->country_id 			= $request->country_id;
		$record->currency_type 			= $request->currency_type;
		$record->currency_short 			= $request->currency_short;
		$record->currency_symbol			= $request->currency_symbol;
		$record->affected_from			= $request->affected_from;
        $record->rate			= $request->rate;
        $record->status				= $request->status;
        $record->record_updated_by  = Auth::user()->id;
        $record->save();

        flash('success','record_added_successfully', 'success');
    	return redirect(URL_CURRENCIES);
    }


    public function edit($slug)
    {
      	if (!checkRole(getUserGrade(2)))
      	{
        	prepareBlockUserMessage();
        	return back();
      	}

    	$record = Currencies::getRecordWithID($slug);

    	if($isValid = $this->isValidRecord($record))
    		return redirect($isValid);


    	$data['record']       		= $record;
    	$data['active_class']     	= 'currencies';
    	$data['settings']       	= FALSE;
      	$data['title']            = getPhrase('edit_currencies');
        $countries = array_pluck(App\Country::all(), 'nicename', 'id');
        $data['countries']     = $countries;
         $view_name = getTheme().'::currencies.add-edit';
        return view($view_name, $data);
    }


    public function update(Request $request, $slug)
    {
    	
        if (!checkRole(getUserGrade(2)))
        {
        	prepareBlockUserMessage();
        	return back();
        }

    	$record = Currencies::getRecordWithID($slug);

    	if($isValid = $this->isValidRecord($record))
    		return redirect($isValid);


        $rules = [
            'country_id'    => 'bail|required',
            'currency_type'    => 'bail|required',
            'currency_short'    => 'bail|required',
            'currency_symbol'    => 'bail|required',
            'affected_from'    => 'bail|required',
            'rate'    => 'bail|required'
        ];

        $customMessages = [
            'required' => 'The :attribute field is required.'
        ];

        $this->validate($request, $rules,$customMessages);


        /**
        * Check if the title of the record is changed, 
        * if changed update the slug value based on the new title
        */

        $record->country_id 			= $request->country_id;
        $record->currency_type 			= $request->currency_type;
        $record->currency_short 			= $request->currency_short;
        $record->currency_symbol			= $request->currency_symbol;
        $record->affected_from			= $request->affected_from;
        $record->rate			= $request->rate;
        $record->status				= $request->status;
        $record->record_updated_by  = Auth::user()->id;
        $record->save();


        flash('success','record_updated_successfully', 'success');
    	return redirect(URL_CURRENCIES);
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
        $record = Currencies::where('id', $slug)->first();
 		try{
            if(!env('DEMO_MODE')) {
                $record->delete();
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
    	return URL_CURRENCIES;
    }
}
