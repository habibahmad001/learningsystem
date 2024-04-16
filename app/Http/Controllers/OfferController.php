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

class OfferController extends Controller
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

        $data['active_class']     = 'marketingbanner';
        $data['title']            = getPhrase('Special Offers');
    	// return view('pages.list', $data);
        $view_name = getTheme().'::offers.list';
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

        $records = App\Offers::select(['id', 'offer_type', 'offer_name', 'url', 'PercentAge', 'offer_Activate', 'price', 'offer_status', 'slug'])
            			->orderBy('updated_at', 'desc');


        return Datatables::of($records)
            ->addColumn('check_course', function ($records) {

                $link_data1 = '<input name="checkbox_course[]" type="checkbox" class="delete_check" id="delcheck_'.$records->id.'"    value="'.$records->id.'">';

                return $link_data1;
            })
            ->editColumn('name', function($records)
            {
                return $records->offer_name;
            })
            ->editColumn('link', function($records)
            {
                return "<a href='".PREFIX."offers/".$records->url."' target='_blank'>Link</a>";
            })
            ->editColumn('price', function($records)
            {
                return ($records->offer_type == "percentage") ? $records->PercentAge . "%" : $records->price;
            })
            ->addColumn('action', function ($records) {

          $link_data = '<div class="dropdown more">
                        <a id="dLabel" type="button" class="more-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-dots-vertical"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dLabel">
                            <li><a href="'.URL_OFFER_EDIT.$records->slug.'"><i class="fa fa-pencil"></i>'.getPhrase("edit").'</a></li>';

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
            return ($records->offer_Activate == "Active") ? '<i class="fa fa-check text-success"></i>' : '<i class="fa fa-times text-danger"></i>';
//            return $records->offer_Activate;
        })
            ->rawColumns([ 'status','offer_name', 'link', 'action','check_course'])
            ->removeColumn('slug')
            ->removeColumn('updated_at')
        ->removeColumn('id')
        ->make();

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

            if($request->bgtype == "bgcolour") {
                $PromoBanner->bannerBG  = json_encode(array("BackgroundType" => $request->bgtype, "BackgroundContent" => $request->background_colour));
            } else {
                /************ Image Upload ***********/
                if(!empty($request->file('background_img'))) {
                    if(json_decode($PromoBanner->bannerBG, true)["BackgroundType"] == "bgimg") {
                        (file_exists('public/uploads/promobanner/BG/' . json_decode($PromoBanner->bannerBG, true)["BackgroundContent"])) ? unlink('public/uploads/promobanner/BG/' . json_decode($PromoBanner->bannerBG, true)["BackgroundContent"]) : "";
                    }
                    $PromoBGImage = $request->file('background_img');
                    $PromoBGImage_new_name = rand() . '.' . $PromoBGImage->getClientOriginalExtension();
                    $BGIMGName  = $PromoBGImage_new_name;
                    $PromoBGImage->move('public/uploads/promobanner/BG', $BGIMGName);
                }
                /************ Image Upload ***********/
                $PromoBanner->bannerBG  = json_encode(array("BackgroundType" => $request->bgtype, "BackgroundContent" => (isset($BGIMGName)) ? $BGIMGName : ""));
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
            if(!empty($request->file('img'))) {
                $PromoImage = $request->file('img');
                $PromoImage_new_name = rand() . '.' . $PromoImage->getClientOriginalExtension();
                $PromoBanner->content_area  = $PromoImage_new_name;
                $PromoImage->move('public/uploads/promobanner', $PromoImage_new_name);
            }
            /************ Image Upload ***********/
            $PromoBanner->content_status  = $request->img_status;
            $PromoBanner->content_link  = $request->img_link;
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
    	$data['active_class']       = 'marketingbanner';
    	$data['title']              = getPhrase('create_page');
    	// return view('pages.add-edit', $data);
         $view_name = getTheme().'::offers.add-edit';
        return view($view_name, $data);
    }


    public function store(Request $request)
    {
        if (!checkRole(getUserGrade(2)))
        {
            prepareBlockUserMessage();
            return back();
        }

        $Offer                = new App\Offers();

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
        $Offer->showall  = $request->showall;
        $Offer->contentarea  = $request->contentareafield;
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

        /************ mobile Image Upload ***********/
        if (!empty($request->file('mobimg'))) {
            $OffermobImage = $request->file('mobimg');
            $OffermobImage_new_name = rand() . '.' . $OffermobImage->getClientOriginalExtension();
            $Offer->mobavatar = $OffermobImage_new_name;

            if (env('FILESYSTEM_DRIVER') == 's3') {
                $filePath = 'lms/series/offerbanner/' . $OffermobImage_new_name;
                Storage::disk('s3')->put($filePath, file_get_contents($OffermobImage));
            } else {
                if (!empty($request->file('mobimg'))) {
                    (file_exists('public/uploads/offerbanner/' . $Offer->mobavatar)) ? unlink('public/uploads/offerbanner/' . $Offer->mobavatar) : "";
                }
                $OffermobImage->move('public/uploads/offerbanner', $OffermobImage_new_name);
            }
        }
        /************ mobile Image Upload ***********/


        $saved              = $Offer->save();

        if ($saved) {
            flash('success','record_added_successfully', 'success');
            return redirect(URL_OFFER);
        } else {
            flash('Ooops...!', getPhrase("page_not_found"), 'error');
            return redirect(URL_OFFER);
        }
    }
 


    public function edit($slug)
    {
      	if (!checkRole(getUserGrade(2)))
      	{
        	prepareBlockUserMessage();
        	return back();
      	}

    	$record = $this->getRecordWithSlug($slug);

    	if($isValid = $this->isValidRecord($record))
    		return redirect($isValid);


    	$data['record']       		= $record;
    	$data['active_class']     	= 'offer';
    	$data['settings']       	= FALSE;
      	$data['title']            = getPhrase('edit_page');
    	// return view('pages.add-edit', $data);
         $view_name = getTheme().'::offers.add-edit';
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
        $Offer->showall  = $request->showall;
        $Offer->contentarea  = $request->contentareafield;
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

        /************ mobile Image Upload ***********/
        if (!empty($request->file('mobimg'))) {
            $OffermobImage = $request->file('mobimg');
            $OffermobImage_new_name = rand() . '.' . $OffermobImage->getClientOriginalExtension();
            $Offer->mobavatar = $OffermobImage_new_name;

            if (env('FILESYSTEM_DRIVER') == 's3') {
                $filePath = 'lms/series/offerbanner/' . $OffermobImage_new_name;
                Storage::disk('s3')->put($filePath, file_get_contents($OffermobImage));
            } else {
                if (!empty($request->file('mobimg'))) {
                    (file_exists('public/uploads/offerbanner/' . $Offer->mobavatar)) ? unlink('public/uploads/offerbanner/' . $Offer->mobavatar) : "";
                }
                $OffermobImage->move('public/uploads/offerbanner', $OffermobImage_new_name);
            }
        }
        /************ mobile Image Upload ***********/


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
        $record = App\Offers::where('slug', $slug)->first();

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
        $records_obj = App\Offers::whereIn('id', $id_array);
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
