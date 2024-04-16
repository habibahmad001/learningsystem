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

class EnquiryController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    /**
     * [popup listing method]
     * @return [type] [description]
     */
    public function index($slug = "all")
    {
        if (!checkRole(getUserGrade(2)))
        {
            prepareBlockUserMessage();
            return back();
        }

        $data['slug']                = $slug;

        $data['active_class']       = 'enquiries';
        $data['title']              = getPhrase('enquiries_list');
        $data['layout']             = getLayout();


        $view_name = getTheme().'::enquires.list';
        return view($view_name, $data);
    }

    public function getDatatable($slug = "all")
    {
        $sfilter = "all";

        if($slug == "contact")
            $sfilter = "Contact Us";
        else if($slug == "course_enquiry")
            $sfilter = "Course Enquiry";
        else if($slug == "general")
            $sfilter = "General";
        else if($slug == "presale")
            $sfilter = "Presale";
        else if($slug == "technical")
            $sfilter = "Technical";
        else if($slug == "other")
            $sfilter = "Other";
        else
            $sfilter = "General";

        if($slug == "all")
        {
            $records = App\Enquiry::select(['id', 'name', 'email', 'created_at', 'enquiry_type'])
                ->orderBy('updated_at', 'desc');

        } else {

            $records = App\Enquiry::select(['id', 'name', 'email', 'created_at', 'enquiry_type'])
                ->where('enquiry_type', $sfilter)
                ->orderBy('updated_at', 'desc');
        }

        $dta = Datatables::of($records)

            ->editColumn('id_#', function($records)
            {
                return ucfirst($records->id);
            })

            ->editColumn('name', function($records)
            {
                return ucfirst($records->name);
            })

            ->editColumn('email', function($records)
            {
                return ucfirst($records->email);
            })

            ->editColumn('enquiry_type', function($records)
            {
                return ucfirst($records->enquiry_type);
            })

            ->editColumn('enquiry_date', function($records)
            {
                return ucfirst(date("F j, Y", strtotime($records->created_at)));
            })

            ->editColumn('view_enquiry', function($records)
            {
                return '<a href="'.URL_ENQUIRIES_VIEW.$records->id.'"><i class="fa fa-eye"></i> '.getPhrase("view").'</a>';
            })

            ->rawColumns(['name','email','view_enquiry','enquiry_date','enquiry_type'])
            ->removeColumn('action');
        return $dta->make();
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
    	$data['active_class']       = 'popup';
    	$data['title']              = getPhrase('create_page');
    	// return view('pages.add-edit', $data);
         $view_name = getTheme().'::popup.add-edit';
        return view($view_name, $data);
    }


    public function store(Request $request)
    {
        if (!checkRole(getUserGrade(2)))
        {
            prepareBlockUserMessage();
            return back();
        }

        $PromoPopup                = new App\PromoPopup();

        $promotion_type = "";
        if($request->promotion_type == "text") {
            $promotion_type = "'promotiontext' => 'required',";
        } else if($request->promotion_type == "video") {
            $promotion_type = "'promotionvideo' => 'required',";
        } else if($request->promotion_type == "iframe") {
            $promotion_type = "'promotioniframe' => 'required',";
        }

        $promotiondisplay = "";
        if($request->promotiondisplay == "course") {
            $promotiondisplay = "'coursename' => 'required'";
        } else if($request->promotiondisplay == "homeandcourse") {
            $promotiondisplay = "'coursename' => 'required'";
        } else if($request->promotiondisplay == "custom") {
            $promotiondisplay = "'customurl' => 'required'";
        }

        $rules = [
            'promotionname'          => 'required',
            'promotion_type'         => 'required',
            'promotiondisplay'       => 'required',
            'psd'                    => 'required',
            'ped'                    => 'required',
            'active_status'          => 'required',
            $promotion_type . $promotiondisplay

        ];

        $customMessages = [
            'required' => 'The :attribute field is required.'
        ];

        //Validate the overall request
        $this->validate($request, $rules, $customMessages);
        $PromoPopup->PromotionName  = $request->promotionname;
        $PromoPopup->PromotionType  = $request->promotion_type;
        $PromoPopup->PromotionStatus  = $request->active_status;
        $PromoPopup->PromotionDisplay  = $request->promotiondisplay;
        $PromoPopup->PromotionStart  = $request->psd;
        $PromoPopup->PromotionEnd  = $request->ped;
        if(isset($request->imglinkfield) && $request->imglinkfield != "") {
            $PromoPopup->imglink  = $request->imglinkfield;
        }
        if($request->promotion_type == "text") {
            $PromoPopup->PromotionContent  = $request->promotiontext;
        } else if($request->promotion_type == "video") {
            $PromoPopup->PromotionContent  = $request->promotionvideo;
        } else if($request->promotion_type == "iframe") {
            $PromoPopup->PromotionContent  = $request->promotioniframe;
        } else if($request->promotion_type == "image") {
            /************ Image Upload ***********/
            if (!empty($request->file('img'))) {
                $PopupImage = $request->file('img');
                $PopupImage_new_name = rand() . '.' . $PopupImage->getClientOriginalExtension();
                $PromoPopup->PromotionContent = $PopupImage_new_name;

                if (env('FILESYSTEM_DRIVER') == 's3') {
                    $filePath = 'lms/PopupIMG/' . $PopupImage_new_name;
                    Storage::disk('s3')->put($filePath, file_get_contents($PopupImage));
                } else {
                    if (!empty($request->file('img'))) {
                        (file_exists('public/uploads/PopupIMG/' . $PromoPopup->PromotionContent)) ? unlink('public/uploads/PopupIMG/' . $PromoPopup->PromotionContent) : "";
                    }
                    $PopupImage->move('public/uploads/PopupIMG', $PopupImage_new_name);
                }
            }
            /************ Image Upload ***********/
        }

        if($request->promotiondisplay == "course") {
            $PromoPopup->PromotionCourses  = json_encode(implode(',', $request->coursename));
        } else if($request->promotiondisplay == "homeandcourse") {
            $PromoPopup->PromotionCourses  = json_encode(implode(',', $request->coursename));
        } else if($request->promotiondisplay == "custom") {
            $PromoPopup->PromotionCustom  = $request->customurl;
        }

        $saved              = $PromoPopup->save();

        if ($saved) {
            flash('success','record_added_successfully', 'success');
            return redirect(URL_PROMOPOPUP);
        } else {
            flash('Ooops...!', getPhrase("page_not_found"), 'error');
            return redirect(URL_PROMOPOPUP);
        }
    }

    public function view($id)
    {
      	if (!checkRole(getUserGrade(2)))
      	{
        	prepareBlockUserMessage();
        	return back();
      	}

    	$record = App\Enquiry::find($id);

    	if($isValid = $this->isValidRecord($record))
    		return redirect($isValid);

    	$data['record']       		= $record;
    	$data['active_class']     	= 'popup';
    	$data['settings']       	= FALSE;
      	$data['title']            = getPhrase('edit_page');
    	// return view('pages.add-edit', $data);
         $view_name = getTheme().'::enquires.add-edit';
        return view($view_name, $data);
    }

    public static function getRecordWithSlug($slug)
    {
        return App\PromoPopup::where('slug', '=', $slug)->first();
    }


    public function update(Request $request, $id)
    {

        if (!checkRole(getUserGrade(2)))
        {
        	prepareBlockUserMessage();
        	return back();
        }

        $PromoPopup                = App\PromoPopup::find($id);

        $promotion_type = "";
        if($request->promotion_type == "text") {
           $promotion_type = "'promotiontext' => 'required',";
        } else if($request->promotion_type == "video") {
            $promotion_type = "'promotionvideo' => 'required',";
        } else if($request->promotion_type == "iframe") {
            $promotion_type = "'promotioniframe' => 'required',";
        }

        $promotiondisplay = "";
        if($request->promotiondisplay == "course") {
            $promotiondisplay = "'coursename' => 'required'";
        } else if($request->promotiondisplay == "homeandcourse") {
            $promotiondisplay = "'coursename' => 'required'";
        } else if($request->promotiondisplay == "custom") {
            $promotiondisplay = "'customurl' => 'required'";
        }

        $rules = [
            'promotionname'          => 'required',
            'promotion_type'         => 'required',
            'promotiondisplay'       => 'required',
            'psd'                    => 'required',
            'ped'                    => 'required',
            'active_status'          => 'required',
            $promotion_type . $promotiondisplay

        ];

        $customMessages = [
            'required' => 'The :attribute field is required.'
        ];

        //Validate the overall request
        $this->validate($request, $rules, $customMessages);
        $PromoPopup->PromotionName  = $request->promotionname;
        $PromoPopup->PromotionType  = $request->promotion_type;
        $PromoPopup->PromotionStatus  = $request->active_status;
        $PromoPopup->PromotionDisplay  = $request->promotiondisplay;
        $PromoPopup->PromotionStart  = $request->psd;
        $PromoPopup->PromotionEnd  = $request->ped;
        if(isset($request->imglinkfield) && $request->imglinkfield != "") {
            $PromoPopup->imglink  = $request->imglinkfield;
        }
        if($request->promotion_type == "text") {
            $PromoPopup->PromotionContent  = $request->promotiontext;
        } else if($request->promotion_type == "video") {
            $PromoPopup->PromotionContent  = $request->promotionvideo;
        } else if($request->promotion_type == "iframe") {
            $PromoPopup->PromotionContent  = $request->promotioniframe;
        } else if($request->promotion_type == "image") {
            /************ Image Upload ***********/
            if (!empty($request->file('img'))) {
                $PopupImage = $request->file('img');
                $PopupImage_new_name = rand() . '.' . $PopupImage->getClientOriginalExtension();
                $PromoPopup->PromotionContent = $PopupImage_new_name;

                if (env('FILESYSTEM_DRIVER') == 's3') {
                    $filePath = 'lms/PopupIMG/' . $PopupImage_new_name;
                    Storage::disk('s3')->put($filePath, file_get_contents($PopupImage));
                } else {
                    if (!empty($request->file('img'))) {
                        (file_exists('public/uploads/PopupIMG/' . $PromoPopup->PromotionContent)) ? unlink('public/uploads/PopupIMG/' . $PromoPopup->PromotionContent) : "";
                    }
                    $PopupImage->move('public/uploads/PopupIMG', $PopupImage_new_name);
                }
            }
            /************ Image Upload ***********/
        }

        if($request->promotiondisplay == "course") {
            $PromoPopup->PromotionCourses  = json_encode(implode(',', $request->coursename));
        } else if($request->promotiondisplay == "homeandcourse") {
            $PromoPopup->PromotionCourses  = json_encode(implode(',', $request->coursename));
        } else if($request->promotiondisplay == "custom") {
            $PromoPopup->PromotionCustom  = $request->customurl;
        }

        $saved              = $PromoPopup->save();

        if ($saved) {
            flash('success','record_added_successfully', 'success');
            return redirect(URL_PROMOPOPUP);
        } else {
            flash('Ooops...!', getPhrase("page_not_found"), 'error');
            return redirect(URL_PROMOPOPUP);
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
        $record = App\PromoPopup::where('slug', $slug)->first();

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
        $records_obj = App\PromoPopup::whereIn('id', $id_array);
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
    	return URL_PROMOPOPUP;
    }
}
