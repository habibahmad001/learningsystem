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

class PromoBannerController extends Controller
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

//        if (!checkRole(getUserGrade(2)))
//        {
//        	prepareBlockUserMessage();
//        	return back();
//        }
//
//        $records = array();
//
//        $records = Page::select(['id','name','status','slug'])
//            			->orderBy('updated_at', 'desc');
//
//
//        return Datatables::of($records)
//            ->addColumn('check_course', function ($records) {
//
//                $link_data1 = '<input name="checkbox_course[]" type="checkbox" class="delete_check" id="delcheck_'.$records->id.'"    value="'.$records->id.'">';
//
//                return $link_data1;
//            })
//            ->editColumn('name', function($records)
//            {
//                return '<a target="_blank" href="'.URL_PAGE.$records->slug.'">'.$records->name.'</a>';
//            })
//            ->addColumn('action', function ($records) {
//
//          $link_data = '<div class="dropdown more">
//                        <a id="dLabel" type="button" class="more-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
//                            <i class="mdi mdi-dots-vertical"></i>
//                        </a>
//                        <ul class="dropdown-menu" aria-labelledby="dLabel">
//                            <li><a href="'.URL_PAGES_EDIT.$records->slug.'"><i class="fa fa-pencil"></i>'.getPhrase("edit").'</a></li>';
//
//                           $temp = '';
//                           if(checkRole(getUserGrade(1))) {
//                    $temp .= ' <li><a href="javascript:void(0);" onclick="1``+6666666(\''.$records->slug.'\');"><i class="fa fa-trash"></i>'. getPhrase("delete").'</a></li>';
//                      }
//
//                    $temp .='</ul></div>';
//
//                    $link_data .=$temp;
//            return $link_data;
//            })
//        ->editColumn('status', function($records)
//        {
//            return ($records->status == 1) ? '<i class="fa fa-check text-success"></i>' : '<i class="fa fa-times text-danger"></i>';
//        })
//            ->rawColumns([ 'status','name', 'action','check_course'])
//            ->removeColumn('slug')
//            ->removeColumn('updated_at')
//        ->removeColumn('id')
//        ->make();

    }

    public function PromoBanner() {

        $data['record']         	= FALSE;
        $data['active_class']     = 'marketingbanner';
        $data['title']            = getPhrase('Top Bar Strip');
        $data['Promo']            = App\PromoBanner::find(1);
        $view_name = getTheme().'::promobanner.add-edit';
        return view($view_name, $data);
    }

    public function UpdatePromo(Request $request) {


        $id                         = 1;
        $PromoBanner                = App\PromoBanner::find($id);


        if($PromoBanner->content_type == "imagecontent") {
            if(!empty($request->file('img'))) {
                (file_exists('public/uploads/promobanner/' . $PromoBanner->content_area)) ? unlink('public/uploads/promobanner/' . $PromoBanner->content_area) : "";
            }
        }

        $PromoBanner->content_type  = $request->contenttype;

        if($request->contenttype == "textcontent") {
            $BGvalid    =   "";
            if($request->bgtype == "bgcolour") {
                $BGvalid    =   "'background_colour'=> 'required',";
            }

            $rules = [
                'area'                      => 'required',
                'content_status'            => 'required',
                $BGvalid
            ];

            $customMessages = [
                'required' => 'The :attribute field is required.'
            ];

            //Validate the overall request
            $this->validate($request, $rules, $customMessages);

            $PromoBanner->content_area  = $request->area;
            $PromoBanner->content_status  = $request->content_status;
            $PromoBanner->content_link  = $request->content_link;
            $PromoBanner->timmer  = $request->timmer;

            if($request->bgtype == "bgcolour") {
                $PromoBanner->bannerBG  = json_encode(array("BackgroundType" => $request->bgtype, "BackgroundContent" => $request->background_colour, 'textcolour' => $request->textcolourfield));
            } else {
                /************ Image Upload ***********/
                if (!empty($request->file('background_img'))) {
                    $PromoBGImage1 = $request->file('background_img');
                    $PromoBGImage_new_name = rand() . '.' . $PromoBGImage1->getClientOriginalExtension();
                    $BGIMGName  = $PromoBGImage_new_name;

                    if (env('FILESYSTEM_DRIVER') == 's3') {
                        $filePath = 'promobanner/BG/' . $PromoBGImage_new_name;
                        Storage::disk('s3')->put($filePath, file_get_contents($PromoBGImage1));
                    } else {
                        if (!empty($request->file('img'))) {
                            (file_exists('public/uploads/promobanner/BG/' . $PromoBanner->content_area)) ? unlink('public/uploads/promobanner/BG/' . $PromoBanner->content_area) : "";
                        }
                        $PromoBGImage1->move('public/uploads/promobanner/BG/', $PromoBGImage_new_name);
                    }
                }
                /************ Image Upload ***********/


                /************ Image Upload ***********/
                if (!empty($request->file('mobile_img'))) {
                    $PromoBGmobImage1 = $request->file('mobile_img');
                    $PromoBGmobImage_new_name = rand() . '.' . $PromoBGmobImage1->getClientOriginalExtension();
                    $PromoBanner->mobile_img  = $PromoBGmobImage_new_name;

                    if (env('FILESYSTEM_DRIVER') == 's3') {
                        $filePath = 'promobanner/BG/' . $PromoBGmobImage_new_name;
                        Storage::disk('s3')->put($filePath, file_get_contents($PromoBGmobImage1));
                    } else {
                        if (!empty($request->file('img'))) {
                            (file_exists('public/uploads/promobanner/BG/' . $PromoBanner->mobile_img)) ? unlink('public/uploads/promobanner/BG/' . $PromoBanner->mobile_img) : "";
                        }
                        $PromoBGmobImage1->move('public/uploads/promobanner/BG/', $PromoBGmobImage_new_name);
                    }
                }
                /************ Image Upload ***********/
                $PromoBanner->bannerBG  = json_encode(array("BackgroundType" => $request->bgtype, "BackgroundContent" => (isset($BGIMGName)) ? $BGIMGName : json_decode($PromoBanner->bannerBG, true)["BackgroundContent"]));
            }

        } else {
            $rules = [
                'img_status'            => 'required',
            ];

            $customMessages = [
                'required' => 'The :attribute field is required.'
            ];

            //Validate the overall request
            $this->validate($request, $rules, $customMessages);

            /************ Image Upload ***********/
            if (!empty($request->file('img'))) {
                $PromoBGImage = $request->file('img');
                $PromoBGImage_new_name = rand() . '.' . $PromoBGImage->getClientOriginalExtension();
                $PromoBanner->content_area  = $PromoBGImage_new_name;

                if (env('FILESYSTEM_DRIVER') == 's3') {
                    $filePath = 'promobanner/' . $PromoBGImage_new_name;
                    Storage::disk('s3')->put($filePath, file_get_contents($PromoBGImage));
                } else {
                    if (!empty($request->file('img'))) {
                        (file_exists('public/uploads/promobanner/' . $PromoBanner->content_area)) ? unlink('public/uploads/promobanner/' . $PromoBanner->content_area) : "";
                    }
                    $PromoBGImage->move('public/uploads/promobanner/', $PromoBGImage_new_name);
                }
            }
            /************ Image Upload ***********/

            /************ Image Upload ***********/
            if (!empty($request->file('mobile_img'))) {
                $PromoBGmobImage1 = $request->file('mobile_img');
                $PromoBGmobImage_new_name = rand() . '.' . $PromoBGmobImage1->getClientOriginalExtension();
                $PromoBanner->mobile_img  = $PromoBGmobImage_new_name;

                if (env('FILESYSTEM_DRIVER') == 's3') {
                    $filePath = 'promobanner/BG/' . $PromoBGmobImage_new_name;
                    Storage::disk('s3')->put($filePath, file_get_contents($PromoBGmobImage1));
                } else {
                    if (!empty($request->file('img'))) {
                        (file_exists('public/uploads/promobanner/BG/' . $PromoBanner->mobile_img)) ? unlink('public/uploads/promobanner/BG/' . $PromoBanner->mobile_img) : "";
                    }
                    $PromoBGmobImage1->move('public/uploads/promobanner/BG/', $PromoBGmobImage_new_name);
                }
            }
            /************ Image Upload ***********/

            $PromoBanner->content_status  = $request->img_status;
            $PromoBanner->content_link  = $request->img_link;
            $PromoBanner->timmer  = $request->timmer;
            $PromoBanner->bannerBG  = "IMGUPLOAD";
        }


        $saved              = $PromoBanner->save();

        if ($saved) {
            flash('success','record_added_successfully', 'success');
            return redirect(URL_PROMOBANNER_ADD);
        } else {
            flash('Ooops...!', getPhrase("page_not_found"), 'error');
            return redirect(URL_PROMOBANNER_ADD);
        }


    }

    /**** Marketing Banner *****/
    public function MarketingBanner() {

        $data['record']         	= FALSE;
        $data['active_class']     = 'marketingbanner';
        $data['title']            = getPhrase('Promotional Section');
        $data['Promo']            = App\PromoBanner::find(2);
        $view_name = getTheme().'::marketingbanner.add-edit';
        return view($view_name, $data);
    }

    public function UpdateMarketingPromo(Request $request) {


        $id                         = 2;
        $PromoBanner                = App\PromoBanner::find($id);

        $PromoBanner->content_type  = "marketting";

        $rules = [
            'img_status'            => 'required',
        ];

        $customMessages = [
            'required' => 'The :attribute field is required.'
        ];

        //Validate the overall request
        $this->validate($request, $rules, $customMessages);

        /************ Image Upload ***********/
        if (!empty($request->file('img'))) {
            $PromoImage = $request->file('img');
            $PromoImage_new_name = rand() . '.' . $PromoImage->getClientOriginalExtension();
            $PromoBanner->content_area = $PromoImage_new_name;

            if (env('FILESYSTEM_DRIVER') == 's3') {
                $filePath = 'lms/series/markettingbanner/' . $PromoImage_new_name;
                Storage::disk('s3')->put($filePath, file_get_contents($PromoImage));
            } else {
                if (!empty($request->file('img'))) {
                    (file_exists('public/uploads/markettingbanner/' . $PromoBanner->content_area)) ? unlink('public/uploads/markettingbanner/' . $PromoBanner->content_area) : "";
                }
                $PromoImage->move('public/uploads/markettingbanner', $PromoImage_new_name);
            }
        }
        /************ Image Upload ***********/
        $PromoBanner->content_status  = $request->img_status;
        $PromoBanner->content_link  = $request->img_link;
        $PromoBanner->bannerBG  = "IMGUPLOAD";


        $saved              = $PromoBanner->save();

        if ($saved) {
            flash('success','record_added_successfully', 'success');
            return redirect(URL_MARKETTINGBANNER_ADD);
        } else {
            flash('Ooops...!', getPhrase("page_not_found"), 'error');
            return redirect(URL_MARKETTINGBANNER_ADD);
        }


    }

    public static function getBanner() {
        return App\PromoBanner::find(2);
    }
    /**** Marketing Banner *****/


    /**** All Course Banner *****/
    public function AllCourseBanner() {

        $data['record']         	= FALSE;
        $data['active_class']     = 'marketingbanner';
        $data['title']            = getPhrase('all_course_section');
        $data['Promo']            = App\PromoBanner::find(3);
        $view_name = getTheme().'::marketingbanner.allcourse.add-edit';
        return view($view_name, $data);
    }

    public function UpdateAllCourse(Request $request) {


        $id                         = 3;
        $PromoBanner                = App\PromoBanner::find($id);

        $PromoBanner->content_type  = "allcourse";

        $rules = [
            'img_status'            => 'required',
        ];

        $customMessages = [
            'required' => 'The :attribute field is required.'
        ];

        //Validate the overall request
        $this->validate($request, $rules, $customMessages);

        $content_area   =   [];
        /************ Main Banner Upload ***********/
        if (!empty($request->file('img'))) {
            $PromoImage = $request->file('img');
            $PromoImage_new_name = rand() . '.' . $PromoImage->getClientOriginalExtension();
            $content_area["Main_Banner"] = $PromoImage_new_name;

            if (env('FILESYSTEM_DRIVER') == 's3') {
                $filePath = 'lms/series/allcourse/' . $PromoImage_new_name;
                Storage::disk('s3')->put($filePath, file_get_contents($PromoImage));
            } else {
                if (!empty($request->file('img'))) {
                    (file_exists('public/uploads/allcourse/' . json_decode($PromoBanner->content_area, true)["Main_Banner"])) ? unlink('public/uploads/allcourse/' . json_decode($PromoBanner->content_area, true)["Main_Banner"]) : "";
                }
                $PromoImage->move('public/uploads/allcourse', $PromoImage_new_name);
            }
        } else {
            $content_area["Main_Banner"] = json_decode($PromoBanner->content_area, true)["Main_Banner"];
        }
        /************ Main Banner Upload ***********/


        /************ Mobile Banner Upload ***********/
        if (!empty($request->file('mimg'))) {
            $PromoImage = $request->file('mimg');
            $PromoImage_new_name = rand() . '.' . $PromoImage->getClientOriginalExtension();
            $content_area["Mobile_Banner"] = $PromoImage_new_name;

            if (env('FILESYSTEM_DRIVER') == 's3') {
                $filePath = 'lms/series/allcourse/' . $PromoImage_new_name;
                Storage::disk('s3')->put($filePath, file_get_contents($PromoImage));
            } else {
                if (!empty($request->file('mimg'))) {
                    (file_exists('public/uploads/allcourse/' . json_decode($PromoBanner->content_area, true)["Mobile_Banner"])) ? unlink('public/uploads/allcourse/' . json_decode($PromoBanner->content_area, true)["Mobile_Banner"]) : "";
                }
                $PromoImage->move('public/uploads/allcourse', $PromoImage_new_name);
            }
        } else {
            $content_area["Mobile_Banner"] = json_decode($PromoBanner->content_area, true)["Mobile_Banner"];
        }
        /************ Mobile Banner Upload ***********/


        $PromoBanner->content_area = json_encode($content_area);
        $PromoBanner->content_status  = $request->img_status;
        $PromoBanner->content_link  = $request->img_link;
        $PromoBanner->bannerBG  = "IMGUPLOAD";


        $saved              = $PromoBanner->save();

        if ($saved) {
            flash('success','record_added_successfully', 'success');
            return redirect(URL_ALLCOURSE);
        } else {
            flash('Ooops...!', getPhrase("page_not_found"), 'error');
            return redirect(URL_ALLCOURSE);
        }


    }
    /**** All Course Banner *****/

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
//	    if (!checkRole(getUserGrade(2)))
//	    {
//	        prepareBlockUserMessage();
//	        return back();
//	    }
//
//	    $rules = [
//         'name'        => 'bail|required|max:50',
//         'content'     => 'bail|required'
//        ];
//
//        $this->validate($request, $rules);
//
//        $record = new Page();
//
//        $name  					= $request->name;
//        $slug=str_slug($name);
//        $record = Page::getRecordWithSlug($slug);
//
//        if($isValid = $this->isValidRecord($record))
//            $slug=$slug.'-'.rand(1,20);
//
//
//		$record->name 			= $name;
//       	$record->slug 			= $slug;
//        $record->content		= $request->content;
//        $record->status			= $request->status;
//        $record->save();
//
//        flash('success','record_added_successfully', 'success');
//    	return redirect(URL_PAGES);
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

//        if (!checkRole(getUserGrade(2)))
//        {
//        	prepareBlockUserMessage();
//        	return back();
//        }
//
//    	$record = Page::getRecordWithSlug($slug);
//
//    	if($isValid = $this->isValidRecord($record))
//    		return redirect($isValid);
//
//
//		$rules = [
//         'name'        => 'bail|required|max:50',
//         'content'     => 'bail|required'
//        ];
//
//        //Validate the overall request
//        $this->validate($request, $rules);
//
//
//        /**
//        * Check if the title of the record is changed,
//        * if changed update the slug value based on the new title
//        */
//        $name = $request->name;
//        if($name != $record->name)
//            $record->slug = str_slug($name);
//
//
//
//        $record->name           = $name;
//        $record->content   		= $request->content;
//        $record->status         = $request->status;
//        $record->save();
//
//        flash('success','record_updated_successfully', 'success');
//    	return redirect(URL_PAGES);
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


    /******** Subscribed Users *********/
    public function SubscribedListing()
    {
        if (!checkRole(getUserGrade(2)))
        {
            prepareBlockUserMessage();
            return back();
        }

        /********* Send Email Functionality *******/
        if(isset($_REQUEST['id']) && $_REQUEST['id'] != "") {
            $resdata = App\UserSubscription::find($_REQUEST['id']);

            if($resdata->first_name) {
                sendEmail('subscription_emails', array('first_name'=> ($resdata->first_name) ? $resdata->first_name : explode("@", $resdata->email)[0],
                    'send_to' => 'user',
                    'email' => $resdata->email,
                    'to_email' => $resdata->email,
                    'datedata' => date("F j, Y", strtotime($resdata->created_at)),
                    'url' => url('/') ));
            } else {
                sendEmail('subscription_ack', array('email'=> $resdata->email,
                    'to_email' => $resdata->email,'url' => BASE_PATH ));
            }
            return redirect(URL_SUBSCRIBED);

        }
        /********* Send Email Functionality *******/

        $data['active_class']     = 'SubscribedUsers';
        $data['title']            = getPhrase('subscribed_users');
        // return view('pages.list', $data);
        $view_name = getTheme().'::subscribed.list';
        return view($view_name, $data);
    }


    /**
     * This method returns the datatables data to view
     * @return [type] [description]
     */
    public function getDatatableSubscribed()
    {

        if (!checkRole(getUserGrade(2)))
        {
            prepareBlockUserMessage();
            return back();
        }

        $records = array();

        $records = App\UserSubscription::select(['id','first_name','status','email','created_at'])
            ->orderBy('updated_at', 'desc');


        return Datatables::of($records)
            ->editColumn('sr_#', function($records)
            {
                return $records->id;
            })
            ->editColumn('name', function($records)
            {
                return $records->first_name;
            })
            ->editColumn('email', function($records)
            {
                return $records->email;
            })
            ->editColumn('subscribed_at', function($records)
            {
                return date("F j, Y", strtotime($records->created_at));
            })
            ->editColumn('status', function($records)
            {
                return ($records->status == 1) ? '<i class="fa fa-check text-success"></i>' : '<i class="fa fa-times text-danger"></i>';
            })
            ->addColumn('action', function ($records) {

                return "<button class=\"btn btn-sm btn-primary button\" onclick='javascript:window.location.href=\"".URL_SUBSCRIBED."?id=$records->id\"'>Send Email</button>";
            })
            ->rawColumns([ 'status','name', 'action','action'])
            ->removeColumn('slug')
            ->removeColumn('updated_at')
            ->removeColumn('id')
            ->make();

    }
    /******** Subscribed Users *********/


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
