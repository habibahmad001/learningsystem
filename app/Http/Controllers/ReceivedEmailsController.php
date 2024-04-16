<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App;
use App\Http\Requests;
use App\Page;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Storage;
use DB;
use Auth;

class ReceivedEmailsController extends Controller
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

        $data['active_class']     = 'ID Card';
        $data['title']            = getPhrase('Studen Id Card');
    	// return view('pages.list', $data);
        $view_name = getTheme().'::receivedemails.list';
        return view($view_name, $data);
    }


    public function Corporate()
    {
        if (!checkRole(getUserGrade(2)))
        {
            prepareBlockUserMessage();
            return back();
        }

        $data['active_class']     = 'Corporate';
        $data['title']            = getPhrase('Corporate Emails');
        // return view('pages.list', $data);
        $view_name = getTheme().'::receivedemails.corporate';
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

        $records = App\StudentIdCard::select(['id', 'f_name', 'std_email', 'std_tel', 'cost'])
            			->orderBy('updated_at', 'desc');


        return Datatables::of($records)
            ->addColumn('check_course', function ($records) {

                $link_data1 = '<input name="checkbox_course[]" type="checkbox" class="delete_check" id="delcheck_'.$records->id.'"    value="'.$records->id.'">';

                return $link_data1;
            })
            ->editColumn('name', function($records)
            {
                return $records->f_name;
            })
            ->editColumn('email', function($records)
            {
                return $records->std_email;
            })
            ->editColumn('telephone_no', function($records)
            {
                return $records->std_tel;
            })
            ->editColumn('cost', function($records)
            {
                return $records->cost;
            })
            ->addColumn('action', function ($records) {

          $link_data = '<div class="dropdown more">
                        <a id="dLabel" type="button" class="more-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-dots-vertical"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dLabel">
                            <li><a href="'.URL_STUDENT_ID_EDIT.$records->id.'"><i class="fa fa-eye"></i>'.getPhrase("view").'</a></li>';

                           $temp = '';

                    $temp .='</ul></div>';

                    $link_data .=$temp;
            return $link_data;
            })
        ->editColumn('status', function($records)
        {
            return ($records->offer_Activate == "Active") ? '<i class="fa fa-check text-success"></i>' : '<i class="fa fa-times text-danger"></i>';
//            return $records->offer_Activate;
        })
            ->rawColumns([ 'name','email', 'telephone_no', 'action', 'cost','check_course'])
            ->removeColumn('slug')
            ->removeColumn('updated_at')
        ->removeColumn('id')
        ->make();

    }


    public function CorporategetDatatable()
    {

        if (!checkRole(getUserGrade(2)))
        {
            prepareBlockUserMessage();
            return back();
        }

        $records = array();

        $records = App\CorporateEmail::select(['id', 'f_name', 'l_name', 'email', 'contact', 'created_at'])
            ->orderBy('updated_at', 'desc');


        return Datatables::of($records)
            ->editColumn('id_#', function($records)
            {
                return $records->id;
            })
            ->editColumn('name', function($records)
            {
                return $records->f_name . " " . $records->l_name;
            })
            ->editColumn('email', function($records)
            {
                return $records->email;
            })
            ->editColumn('telephone_no', function($records)
            {
                return $records->contact;
            })
            ->editColumn('received_at', function($records)
            {
                return date("d F Y", strtotime($records->created_at));
            })
            ->addColumn('action', function ($records) {

                $link_data = '<div class="dropdown more">
                        <a id="dLabel" type="button" class="more-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-dots-vertical"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dLabel">
                            <li><a href="'.URL_CORPORATE_EDIT.$records->id.'"><i class="fa fa-eye"></i>'.getPhrase("view").'</a></li>';

                $temp = '';

                $temp .='</ul></div>';

                $link_data .=$temp;
                return $link_data;
            })
            ->editColumn('status', function($records)
            {
                return ($records->offer_Activate == "Active") ? '<i class="fa fa-check text-success"></i>' : '<i class="fa fa-times text-danger"></i>';
//            return $records->offer_Activate;
            })
            ->rawColumns([ 'name','email', 'telephone_no', 'action'])
            ->removeColumn('slug')
            ->removeColumn('updated_at')
            ->removeColumn('id')
            ->make();

    }


    public function Edit($id)
    {
      	if (!checkRole(getUserGrade(2)))
      	{
        	prepareBlockUserMessage();
        	return back();
      	}

    	$record = App\StudentIdCard::find($id);

    	if($isValid = $this->isValidRecord($record))
    		return redirect($isValid);


    	$data['record']       		= $record;
    	$data['active_class']     	= 'Studen Id Card';
    	$data['settings']       	= FALSE;
      	$data['title']            = getPhrase('edit_page');
    	// return view('pages.add-edit', $data);
         $view_name = getTheme().'::receivedemails.add-edit';
        return view($view_name, $data);
    }


    public function CorporateEdit($id)
    {
        if (!checkRole(getUserGrade(2)))
        {
            prepareBlockUserMessage();
            return back();
        }

        $record = App\CorporateEmail::find($id);

        if($isValid = $this->isValidRecord($record))
            return redirect($isValid);


        $data['record']       		= $record;
        $data['active_class']     	= 'Corporate';
        $data['settings']       	= FALSE;
        $data['title']              = getPhrase('view_page');
        // return view('pages.add-edit', $data);
        $view_name = getTheme().'::receivedemails.add-edit';
        return view($view_name, $data);
    }

    public static function getRecordWithSlug($slug)
    {
        return App\Offers::where('slug', '=', $slug)->first();
    }


    public function update(Request $request, $slug)
    {

        if (!checkRole(getUserGrade(2)))
        {
        	prepareBlockUserMessage();
        	return back();
        }

    	$record = $this->getRecordWithSlug($slug);

        $Offer                = App\Offers::find($record->id);

        if($request->offer_type == "package") {
           $pvalid = "'price' => 'required'";
        } else {
            $pvalid = "'pagee' => 'required',";
            $pvalid .= "'percentage_type' => 'required'";
        }

        $rules = [
            'offername'               => 'required',
            'coursename'              => 'required',
            'offer_type'              => 'required',
            'url'                     => 'required',
            'introText'               => 'required',
            'cat'                     => 'required',
            'noofcourse'              => 'required',
            $pvalid

        ];

        $customMessages = [
            'required' => 'The :attribute field is required.'
        ];

        //Validate the overall request
        $this->validate($request, $rules, $customMessages);
        $Offer->offer_name  = $request->offername;
        $Offer->offer_keys  = json_encode(implode(',', $request->coursename));
        $Offer->offer_Activate  = $request->active_status;
        $Offer->offer_Type  = $request->offer_type;
        $Offer->url  = strtolower(str_replace(' ', '-', $request->url));
        $Offer->introText  = $request->introText;
        $Offer->Cat  = json_encode(implode(',', $request->cat));
        $Offer->NoOfCourse  = $request->noofcourse;
        if($request->offer_type == "package") {
            $Offer->price  = $request->price;
        } else {
            $Offer->PercentAge  = $request->pagee;
            $Offer->PercentageType  = $request->percentage_type;
        }
        $Offer->slug  = strtolower(str_replace(' ', '-', $request->offername));

        /************ Image Upload ***********/
        if (!empty($request->file('img'))) {
            $OfferImage = $request->file('img');
            $OfferImage_new_name = rand() . '.' . $OfferImage->getClientOriginalExtension();
            $Offer->avatar = $OfferImage_new_name;

            if (env('FILESYSTEM_DRIVER') == 's3') {
                $filePath = 'lms/series/offerbanner/' . $OfferImage_new_name;
                Storage::disk('s3')->put($filePath, file_get_contents($OfferImage));
            } else {
                if (!empty($request->file('img'))) {
                    (file_exists('public/uploads/offerbanner/' . $Offer->avatar)) ? unlink('public/uploads/offerbanner/' . $Offer->avatar) : "";
                }
                $OfferImage->move('public/uploads/offerbanner', $OfferImage_new_name);
            }
        }
        /************ Image Upload ***********/


        $saved              = $Offer->save();

        if ($saved) {
            flash('success','record_added_successfully', 'success');
            return redirect(URL_OFFER);
        } else {
            flash('Ooops...!', getPhrase("page_not_found"), 'error');
            return redirect(URL_OFFER);
        }
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
        $record = App\CorporateEmail::where('slug', $slug)->first();

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
        $records_obj = App\CorporateEmail::whereIn('id', $id_array);
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
    	return URL_OFFER;
    }
}
