<?php

namespace App\Http\Controllers;
use \App;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use Yajra\Datatables\Datatables;
use DB;
use Auth;


class ParentsController extends Controller
{
     public function __construct()
    {
         $currentUser = \Auth::user();
      
      
      $this->middleware('auth');
    
    }
    
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
     public function index()
     {
       
       $user = getUserWithSlug();

      if(!checkRole(getUserGrade(7)))
      {
        prepareBlockUserMessage();
        return back();
      }

       if(!isEligible($user->slug))
        return back();
 
       $data['records']      = FALSE;
       $data['user']       = $user;
       $data['title']        = getPhrase('children');
       $data['active_class'] = 'children';
       $data['layout']       = getLayout();
       // return view('parent.list-users', $data);

        $view_name = getTheme().'::parent.list-users';
        return view($view_name, $data);     
     }

     /**
     * This method returns the datatables data to view
     * @return [type] [description]
     */
    
    public function getDatatable($slug)
    {
        $records = array();
        $user = getUserWithSlug($slug);
        
        $records = User::select(['name', 'email', 'image', 'slug', 'id'])->where('parent_id', '=', $user->id)->get();
            


        return Datatables::of($records)
        ->addColumn('action', function ($records) {
         $buy_package = '';
        
          if(!isSubscribed('main',$records->slug)==1)
           // $buy_package =    '<li><a href="'.URL_SUBSCRIBE.$records->slug.'"><i class="fa fa-credit-card"></i>'.getPhrase("buy_package").'</a></li>';


            return '<div class="dropdown more">
                        <a id="dLabel" type="button" class="more-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-dots-vertical"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dLabel">
                           <li><a href="'.URL_USERS_EDIT.$records->slug.'"><i class="fa fa-pencil"></i>'.getPhrase("edit").'</a></li>

                        </ul>
                    </div>';
            })
            
         ->editColumn('name', function($records)
         {
          return '<a href="'.URL_USER_DETAILS.$records->slug.'" title="'.$records->name.'">'.ucfirst($records->name).'</a>';
         })       
         ->editColumn('image', function($records){
            return '<img src="'.getProfilePath($records->image).'"  />';
        })
         ->removeColumn('slug')
         ->removeColumn('id')

        ->make();
    }

    public function certificates($slug="website") {
        $data['active_class']     = 'certificates';
        $data['title']            = getPhrase('Certificate Listing');
        $data['slug']            = $slug;
        // return view('pages.list', $data);
        $view_name = getTheme().'::student.certificate.list';
        return view($view_name, $data);
    }

    public function getcertDatatable($slug="website")
    {

        $records = array();
        $user=Auth::user();
        if(getRoleData($user->role_id)=='admin' || getRoleData($user->role_id)=='owner') {
            if($slug=="website" || $slug=="") {
                $records = App\Certificate::select(['id', 'user_name', 'course_id', 'user_email', 'user_phone', 'course_type', 'delivery_fee', 'certificate_code', 'certificate_file'])

                   // ->where('course_type', 'free')->orWhere('course_type', 'paid')

                    ->orderBy('updated_at', 'desc');
            }else{
                $records = App\Certificate::select(['id', 'user_name', 'course_id', 'user_email', 'user_phone', 'course_type', 'delivery_fee', 'certificate_code', 'certificate_file'])
                    ->where('course_type', 'reed')
                    ->orderBy('updated_at', 'desc');
            }

        }else{

            $records = App\Certificate::select(['id', 'user_name', 'user_email', 'course_type', 'user_phone', "course_id", 'delivery_fee', 'certificate_code', 'certificate_file'])
                ->where("user_id", $user->id)

                //->where('course_type','free')->orWhere('course_type','paid')
                ->orderBy('updated_at', 'desc');
            //->get();
            //dd($records);
        }



        return Datatables::of($records)
            ->addColumn('check_course', function ($records) {

               // $link_data1 = '<input name="checkbox_course[]" type="checkbox" class="delete_check" id="delcheck_'.$records->id.'"    value="'.$records->id.'">';

                return $link_data1=$records->id;
            })
            ->editColumn('course_name', function($records)
            {
                if($records->course_type!="reed") {
                    return '<a href="' . PREFIX . 'course/' . $this->CheckCourseType($records->course_id)->slug . '">#' . $records->course_id . '-' . ucfirst($this->CheckCourseType($records->course_id)->title) . '</a>';
                }else{
                    return $records->course_id;
                }
            })
            ->editColumn('email', function($records)
            {
                return ucfirst($records->user_email);
            })
            ->editColumn('price', function($records)
            {
                return getCurrencyCode().ucfirst($records->delivery_fee);
            })

            ->editColumn('certificate_code',function($records){

                return '<a target="_blank" href="'.CERTIFICATE_PATH.$records->certificate_file.'">'.$records->certificate_code.'</a>';
            })

            ->editColumn('action',function($records){
                $user=Auth::user();
                if($records->course_type == 'free'){
                    $action= '<li><a href="'.PREFIX.'certificate_fee/'.$records->course_id.'"><i class="fas fa-stamp"></i> '.getPhrase("order").'</a></li>';

                    if(getRoleData($user->role_id)=='admin' || getRoleData($user->role_id)=='owner') {
                        $action.='<li><a href="'.URL_STUDENT_CERTIFICATES_VIEW.$records->id.'"><i class="fa fa-eye"></i> '.getPhrase("view").'</a></li>';
                        $action.='<li><a href="javascript:void(0)" onclick="regeneratepdf('.$records->id.')"><i class="fa fa-eye"></i> '.getPhrase("regenerate Certificate").'</a></li>';
                    }

                }
                else{
                    $action= '<li><a href="'.URL_STUDENT_CERTIFICATES_VIEW.$records->id.'"><i class="fa fa-eye"></i> '.getPhrase("view").'</a></li>';
                    $action.= '<li><a href="'.PREFIX.'certificate_fee/'.$records->course_id.'"><i class="fas fa-stamp"></i> '.getPhrase("order_for_print").'</a></li>';
                    if(getRoleData($user->role_id)=='admin' || getRoleData($user->role_id)=='owner') {
                        $action.='<li><a href="javascript:void(0)" onclick="regeneratepdf('.$records->id.')"><i class="fa fa-eye"></i> '.getPhrase("regenerate Certificate").'</a></li>';
                    }
                }

                $link_data = '<div class="dropdown more">
                        <a id="dLabel" type="button" class="more-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-dots-vertical"></i>
                        </a>
                        <ul class="dropdown-menu  dropdown-menu-right" aria-labelledby="dLabel">';

                $temp = $action;

                $temp .='</ul></div>';

                $link_data .=$temp;
                return $link_data;




                })

            ->rawColumns([ 'course_name','email', 'phone_#', 'price', 'certificate_code','payment_type', 'check_course', 'action'])
            ->removeColumn('slug')
            ->removeColumn('updated_at')
            ->removeColumn('id')
            ->make();

    }

    public function view($id)
    {

        $record = App\Certificate::find($id);

        $data['record']       		= $record;
        $data['active_class']     	= 'certificate';
        $data['settings']       	= FALSE;
        $data['title']            = getPhrase('view_page');

        $view_name = getTheme().'::student/certificate.add-edit';
        return view($view_name, $data);
    }



    function CheckCourseType($ID){
        return App\LmsSeries::where("id", $ID)->first();
    }


    public function childrenAnalysis()
    {
       
       $user = getUserWithSlug();

      if(!checkRole(getUserGrade(7)))
      {
        prepareBlockUserMessage();
        return back();
      }

       if(!isEligible($user->slug))
        return back();
 
       $data['records']      = FALSE;
       $data['user']       = $user;
       $data['title']        = getPhrase('children_analysis');
       $data['active_class'] = 'analysis';
       $data['layout']       = getLayout();
       // return view('parent.list-users', $data);

        $view_name = getTheme().'::parent.list-users';
        return view($view_name, $data);     
    }
}
