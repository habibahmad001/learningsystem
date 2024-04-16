<?php

namespace App\Http\Controllers;
use App\ExamSeries;
use App\GernalEnquiry;
use App\Wishlist;
use function Couchbase\defaultDecoder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use \App;
use \App\UserSubscription;
use \App\Quiz;
use \App\User;
use \App\Page;
use Auth;
use \App\LmsSeries;
use DB;
//use Response;
use Socialite;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Paypal;
use \App\Payment;
use Exception;
use Darryldecode\Cart\CartCondition;
use Illuminate\Support\Facades\Mail;
use App\Exports\PaymentsExport;
use Maatwebsite\Excel\Facades\Excel;
use Validator;
use Illuminate\Support\Facades\Cache;
use Cmgmyr\Messenger\Models\Thread;
//use Stevebauman\Location\Facades\Location;


class SiteController extends Controller
{

    public $discounts=false;
    public $snow=false;

    public function __construct()
    {

        if(getSetting('show_discounted_price', 'site_settings'))
        {
            $this->discounts  = true;
        }else{
            $this->discounts  = false;
        }


        if(getSetting('show_snow_effect', 'site_settings'))
        {
            $this->snow  = true;
        } 


        $current_theme            = getDefaultTheme();
        //dd(getSetting('copyrights', 'site_settings'));
        $data['home_title']       = getThemeSetting('home_page_title',$current_theme);
        $data['home_link']        = getThemeSetting('home_page_link',$current_theme);
        $data['home_image']       = getThemeSetting('home_page_image',$current_theme);
        $data['home_back_image']  = getThemeSetting('home_page_background_image',$current_theme);
        $data['facebook_link']  = getSetting('facebook_link', 'site_settings');
        $data['twitter_link']  = getSetting('twitter_link','site_settings');
        $data['instagram_link']  = getSetting('instagram_link','site_settings');
        $data['linkedin_link1']  = getSetting('linkedin_link','site_settings');
        session()->put("data",$data);

        //dd($data);
    }

    public function index()
    {

//        $data=session()->get("data.facebook_link");
//        $data = Cache::get('settings');
//        $var = array();
//        $var = json_decode($data, true);
//        dd($var['site_settings']['site_title']['value']);
        //  echo getSetting('copyrights', 'site_settings');
        //$userId = 12;
        //\Cart::session($userId);

//    if(env('DB_DATABASE')!=''){

        try {

            //setcookie("activetab", "", time() - 3600);

            $data['key'] = 'home';

            $data['active_class'] = 'home';
            $data['snow'] =$this->snow;
//        $categories           = App\QuizCategory::getShowFrontCategories(8);
//        $data['categories']   = $categories;
//
//        if(count($categories) > 0 ){
//
//          $firstOne        = $categories[0];
//          $quizzes         = Quiz::where('category_id',$firstOne->id)
//                                 ->where('show_in_front',1)
//                                 ->where('total_marks','>',0)
//                                 ->limit(6)
//                                 ->get();
//
//          $data['quizzes'] = $quizzes;
//          // dd($quizzes);
//        }

//         $lms_cates  = LmsSeries::getFreeSeries(12);
//
//         if(count($lms_cates) > 0){
//
//            $firstlmsOne  = $lms_cates[0];
//           /*  $firstSeries  = LmsSeries::where('show_in_front',1)
//                 ->where('total_items','>',0)
//                 ->orderBy('created_at', 'desc')
//                 ->limit(8)
//                 ->get();*/
//            $firstSeries  = LmsSeries::where('status',1)
//                                       ->orderBy('created_at', 'desc')
//                                       ->limit(10)
//                                       ->get();
//
//            $data['lms_cates']  = $lms_cates;
//            $data['lms_series'] = $firstSeries;
//         }


            $cartCollection = \Cart::getContent();
            // $cartCollection->count();
            $cartTotalQuantity = \Cart::getTotalQuantity();
            $total = \Cart::getTotal();
            $data['total_quantity']     = $cartTotalQuantity;
            $data['total_amount']     = $total;
            $data['total_items']     = $cartCollection->count();

            $data['cart_contents']     = $cartCollection;
            $data['posts']     =cache()->remember('home-posts',60*60*60*60,function(){
                return App\Post::with('category')->where('featured','=',1)->where('status','=','Active')->orderBy('created_at', 'DESC')->get();
            });
//        $data['popular_courses']     = Page::select('content')->where('slug','popular-courses')->get();

            //  $data['lms_allcats']  = $lms_allcats;

            $data['discounts']  = $this->discounts;

            //testimonies
            $data['testimonies'] =
                cache()->remember('testimonies',60*60*60*60,function(){
                return App\Feedback::join('users', 'users.id','=','feedbacks.user_id')
                    ->select(['feedbacks.title','feedbacks.description','users.name','users.image'])
                    ->where('feedbacks.read_status', 1)
                    ->orderBy('feedbacks.updated_at', 'desc')
                    ->get();

            });

            //$data['trending']= LmsSeries::where('status','=', 1)->inRandomOrder()->limit(15)->get();
            $data['trending']      =
                cache()->remember('trending',60*60*60*60,function() {
                    return LmsSeries::where('status','=', 1)
                        ->whereIn('slug',['gardening-and-landscaping','legal-secretary','daily-make-up','mastering-psychology','photoshop-illustrator-cc-become-a-professional-logo-designer','mastering-counselling','mastering-childcare-with-nutrition','microsoft-excel-2019-beginners','email-marketing-mastery-the-ultimate-guide-to-online-business'])->get();
                });



         /*   $lms_series_def=
                cache()->remember('default_cat',60*60*60*60,function() {
                   return LmsSeries::where([['status', '=', 1], ['lms_parent_category_id', '=', 25], ['setpopular', '=', "yes"]])
                        ->orWhere([['status', '=', 1], ['lms_category_id', '=', 25], ['setpopular', '=', "yes"]])
                        ->groupBy('id')
                        ->inRandomOrder()
                        ->limit(10)
                        ->get();
                });*/

            $lms_series_def = LmsSeries::with('accreditedby','reviews')
                ->where([['status','=', 1],['lms_parent_category_id','=',25],['setpopular','=', "yes"]])
                ->orWhere([['status','=', 1],['lms_category_id','=',25],['setpopular','=', "yes"]])
                //->inRandomOrder()
                ->limit(10)
                ->orderBy("id", "desc")
                ->get();

//            $lms_series_def=
//                cache()->remember('default_cat',60*60*60*60,function() {
//                    return LmsSeries::with('accreditedby','reviews')->where([['status','=', 1],['lms_parent_category_id','=',25],['setpopular','=', "yes"]])
//                        ->orWhere([['status','=', 1],['lms_category_id','=',25],['setpopular','=', "yes"]])
//                        //->inRandomOrder()
//                        ->limit(10)
//                        ->get();
//                });

//            $lms_series_def=
//                cache()->remember('default_cat',60*60*60*60,function() {
//                    return LmsSeries::with('accreditedby','reviews')->where([['status','=', 1],['lms_parent_category_id','=',25],['setpopular','=', "yes"]])
//                        ->orWhere([['status','=', 1],['lms_category_id','=',25],['setpopular','=', "yes"]])
//                        //->inRandomOrder()
//                        ->limit(10)
//                        ->get();
//                });




            $data['default_cat']=$lms_series_def;

            $view_name = getTheme().'::site.index';
            return view($view_name, $data);

        }catch (Exception $e) {

            // return view('200');
            return redirect( URL_UPDATE_DATABASE );
        }

    }

    public function ContactPost(Request $request) {

        /******* Form Validation *****/
        $rules = [
            'name' => 'required',
            'email' => 'required|email',
            'subject'=>'required',
            'phone'=>'required',
            'msg'=>'required|max:250'
        ];

        $customMessages = [
            'required' => 'The :attribute field is required.'
        ];

        $this->validate($request, $rules, $customMessages);
        /******* Form Validation *****/


        /********* Email ***********/
        $name     = $request->name;
        $email    = $request->email;
        $subject  = $request->subject;
        $phone    = $request->phone;
        $msg      = $request->msg;


        $adminemail = "habibahmed001@gmail.com";
        // $adminemail = "info@nextlearnacademy.com";
        $view_name = getTheme().'::emails.ContactUs';

        Mail::send($view_name, ['name' => $name, 'userenamil' => $email, 'subject' => $subject, 'phone' => $phone, 'msg' => $msg], function($message)  use ($adminemail){
            $message->to($adminemail);
            $message->subject("Contact Us form new request!!!");
        });
        /********* Email ***********/
        toastr()->success('Email has been submitted, Thanks!');
        return redirect()->back()->with('message', 'Email has been submitted, Thanks!');

    }

    public function EnquiryPost(Request $request) {

        /******* Form Validation *****/
        $rules = [
            'first_name' => 'required',
            'customRadio' => 'required',
            'phone'=>'required',
            'email'=>'required|email',
            'country'=>'required',
            'cname'=>'required',
            'msg'=>'required|max:250'
        ];

        $customMessages = [
            'required' => 'The :attribute field is required.'
        ];

        $this->validate($request, $rules, $customMessages);
        /******* Form Validation *****/


        /********* Email ***********/
        $name         = $request->first_name;
        $customRadio  = $request->customRadio;
        $phone        = $request->phone;
        $email        = $request->email;
        $country      = $request->country;
        $cname        = $request->cname;
        $sub          = $request->sub;
        $agree        = $request->agree;
        $msg          = $request->msg;


        $adminemail = "habibahmed001@gmail.com";
        // $adminemail = "info@nextlearnacademy.com";
        $view_name = getTheme().'::emails.Enquiry';

        Mail::send($view_name, ['name' => $name, 'customRadio' => $customRadio, 'userenamil' => $email, 'phone' => $phone, 'country' => $country, 'cname' => $cname, 'sub' => $sub, 'msg' => $msg], function($message)  use ($adminemail){
            $message->to($adminemail);
            $message->subject("You receive new enquiry form request!!!");
        });
        /********* Email ***********/
        //session()->flash('message', 'Email has been submitted, Thanks!');
        toastr()->success('Email has been submitted, Thanks!');
        return redirect()->back()->with('message', 'Email has been submitted, Thanks!');
    }




    // return view('system-emails.site.subscription');
    //}
    /**
     * This method will load the static pages
     * @param  string $key [description]
     * @return [type]      [description]
     */
    public function sitePages($key='privacy-policy')
    {

        $available_pages = ['privacy-policy', 'terms-conditions','about-us','courses','pattren','pricing','syllabus'];
        if(!in_array($key, $available_pages))
        {
            pageNotFound();
            return back();
        }
        $data['title']        = ucfirst(getPhrase($key));
        if($key == 'about-us'){

            $data['title']        = getPhrase('about_us');
        }
        elseif($key == 'privacy-policy'){
            $data['title']        = getPhrase('privacy_policy');

        }
        elseif($key == 'terms-conditions'){
            $data['title']        = getPhrase('terms_conditions');

        }
        $data['key']          = $key;
        $data['active_class'] = $key;


        $data['edit_url']    = URL_VIEW_THEME_SETTINGS.getTheme();
        //dd($data);
        if(checkRole(getUserGrade(3)))  {
            $data['display_edit']    = true;

        }else{
            $data['display_edit']    = false;
        }

        // return view('site.dynamic-view', $data);


        $view_name = getTheme().'::site.dynamic-view';
        return view($view_name, $data);

    }


    /**
     * This method save the subscription email
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function saveSubscription(Request $request)
    {


        $email  = $request->useremail;
        $record   = UserSubscription::where('email',$email)->first();
        if(!$record){
            $new_record   = new UserSubscription();
            $new_record->email  = $email;
            $new_record->save();
            sendEmail('subscription_ack', array('email'=> $email,
                'to_email' => $email,'url' => BASE_PATH ));

            sendEmail('subscription_admin', array('email'=> $email,
                'to_email' => $email,'send_to' => 'admin','url' => BASE_PATH ));

            return json_encode(array('status'=>'ok'));
        }
        else{
            sendEmail('subscription_ack', array('email'=> $email,
                'to_email' => $email,'url' => BASE_PATH ));
            $record->status  = 1;
            $record->save();
            // return json_encode(array('status'=>'existed'));
            return json_encode(array('status'=>'ok'));
        }

    }

    /**
     * This method display the all fornt end exam categories
     * and exams
     * @param  string $value [description]
     * @return [type]        [description]
     */
    public function frontAllExamCats($slug='')
    {


        $data['key'] = 'home';

        $data['active_class'] = 'practice_exams';
        $categories           = App\QuizCategory::getShowFrontCategories();
        $data['categories']   = $categories;
        $quizzes  = array();

        if($categories && !$slug)
        {

            $firstOne        = $categories[0];
            $quizzes         = Quiz::where('category_id',$firstOne->id)
                ->where('show_in_front',1)
                ->where('total_marks','>',0)
                ->paginate(9);

            $data['title']  = ucfirst($firstOne->category);
        }
        if($categories && $slug){

            $category  = App\QuizCategory::where('slug',$slug)->first();
            $quizzes   = Quiz::where('category_id',$category->id)
                ->where('show_in_front',1)
                ->where('total_marks','>',0)
                ->paginate(9);

            $data['title']  = ucfirst($category->category);

        }

        $data['quizzes']   = $quizzes;
        $data['quiz_slug'] = $slug;

        $view_name = getTheme().'::site.allexam_categories';
        return view($view_name, $data);


    }

    /**
     * View all front end lms categories and series
     * @param  string $slug [description]
     * @return [type]       [description]
     *
     */


    public function frontSearchCourses(Request $request)
    {
        try{

        $cartCollection = \Cart::getContent();
        $cartTotalQuantity = \Cart::getTotalQuantity();
        $total = \Cart::getTotal();
        $data['total_quantity']     = $cartTotalQuantity;
        $data['total_amount']     = $total;
        $data['total_items']     = $cartCollection->count();;
        $data['cart_contents']     = $cartCollection;

        $data['key'] = 'home';
        $data['active_class'] = 'lms';
        $data['title'] = 'All Courses';



        $levels= $request->input('levels');
        $price_str= $request->input('price');
            if($price_str=="free")
                $price =str_replace("free","0",$price_str);
            elseif($price_str=="discounted")
                $price =str_replace("discounted","2,3",$price_str);
            else
                $price=$price_str;
        $materials= $request->input('materials');
        $rating= $request->input('rating');
        $duration= $request->input('duration');
        $search_term= $request->input('search_term');
        $last_filter= $request->input('last_filter');
        $sort= $request->input('sort');

        if($search_term=='all' || $search_term==''){
            if(env('APP_CACHE')){
                $all_series      = LmsSeries::where("status","=",1);
                $count_series = Cache::rememberForever('count_series', function () {
                    return LmsSeries::where('status', '=', 1)
                        ->get();
                });
            }else{
                $all_series      = LmsSeries::where("status","=",1);
                $count_series = LmsSeries::where('status', '=', 1)
                    ->get();
             }



        }else{

            $all_series      = LmsSeries::where('title', 'Like','%'.$search_term.'%')
                ->where("status","=",1);
            $count_series      = LmsSeries::where('title', 'Like','%'.$search_term.'%')
                ->where("status","=",1)->get();
        }

        $data['count_series']   = $count_series;

        if($levels!="") {
            $all_series= $all_series->whereIn('level_id', explode(',',$levels));
        }
        if($price!="") {
            $all_series= $all_series->whereIn('is_paid', explode(',',$price));
        }

//        if($sort!="") {
//            $all_series= $all_series->whereIn('is_paid', explode(',',$price));
//        }

        if($materials!="") {
            $idsArr = explode(',',$materials);
            $all_series= $all_series->whereIn('course_tags',$idsArr);
        }

        if($rating!="") {

//
//            if(env('APP_CACHE')){
//
//                $cids = Cache::rememberForever('cids', function ($rating) {
//                    return App\Review::select('course_id')->groupBy('course_id')
//                        ->having(DB::raw('AVG(rating)'), '>=', $rating);
//                });
//                $all_series= $all_series->whereIn('id', $cids);
//            }else{

                $cids=App\Review::select('course_id')->groupBy('course_id')
                    ->having(DB::raw('AVG(rating)'), '>=', $rating);
                $all_series= $all_series->whereIn('id', $cids);
//            }


        }

        if($duration!="") {
            $arr=explode('-',$duration);
            $start=(int)$arr[0]*60;
            $end=(int)$arr[1]*60;

            $vid_duration = DB::table('lmscontents')
                ->join('lmsseries_data', 'lmscontents.id', '=', 'lmsseries_data.lmscontent_id')
                ->select('lmsseries_data.lmsseries_id')
                ->groupBy('lmsseries_data.lmsseries_id')
                ->having(DB::raw('SUM(lmscontents.video_length)'), '>', $start )
                ->having(DB::raw('SUM(lmscontents.video_length)'), '<=', $end);

            $all_series= $all_series->whereIn('id', $vid_duration);
        }

        //$all_series= $all_series->paginate(20);
        $all_series= $all_series->paginate(24);

        $all_series->appends(['levels' => $levels]);
        $all_series->appends(['price' => $price_str]);
        $all_series->appends(['materials' => $materials]);
        $all_series->appends(['rating' => $rating]);
        $all_series->appends(['duration' => $duration]);
        $all_series->appends(['search_term' => $search_term]);
        $all_series->appends(['sort' => $sort]);

        if(isset($search_term)){
            $data['title']  = ucfirst($search_term);
            $data['lms_cat_slug'] = $request->search_term;
        }else{
            $data['title'] = 'Search Results ';
            $data['lms_cat_slug']="";
        }


        $data['all_series']   = $all_series;
        $data['discounts']  = $this->discounts;
        $data['ptitle'] ="";
        $data['plink']  ="";
            if(env('APP_CACHE')){
                $free_series = Cache::rememberForever('free_series', function () {
                    return LmsSeries::where('status','=', 1)->where('is_paid','=', 0)->paginate(24);
                });
            }else{
                $free_series      = LmsSeries::where('status','=', 1)->where('is_paid','=', 0)->paginate(24);

            }
            $free_series->appends(['levels' => $levels]);
            $free_series->appends(['price' => $price_str]);
            $free_series->appends(['materials' => $materials]);
            $free_series->appends(['rating' => $rating]);
            $free_series->appends(['duration' => $duration]);
            $free_series->appends(['search_term' => $search_term]);
            $free_series->appends(['sort' => $sort]);

            if(env('APP_CACHE')){
                $disc_series = Cache::rememberForever('disc_series', function () {
                    return LmsSeries::where('status','=', 1)->where('is_paid','>', 1)->OrderBy("updated_at", "desc")->paginate(24);
                });
            }else{
                $disc_series      = LmsSeries::where('status','=', 1)->where('is_paid','>', 1)->OrderBy("updated_at", "desc")->paginate(24);

            }
            $disc_series->appends(['levels' => $levels]);
            $disc_series->appends(['price' => $price_str]);
            $disc_series->appends(['materials' => $materials]);
            $disc_series->appends(['rating' => $rating]);
            $disc_series->appends(['duration' => $duration]);
            $disc_series->appends(['search_term' => $search_term]);
            $disc_series->appends(['sort' => $sort]);

            if(env('APP_CACHE')){
                $popular_series = Cache::rememberForever('popular_series', function () {
                    return LmsSeries::where('status','=', 1)->where('setpopular','=', 'yes')->paginate(24);
                });
            }else{
                $popular_series   = LmsSeries::where('status','=', 1)->where('setpopular','=', 'yes')->paginate(24);

            }

            $popular_series->appends(['levels' => $levels]);
            $popular_series->appends(['sort' => $sort]);
            $popular_series->appends(['materials' => $materials]);
            $popular_series->appends(['rating' => $rating]);
            $popular_series->appends(['duration' => $duration]);
            $popular_series->appends(['search_term' => $search_term]);



            if(env('APP_CACHE')){
                $new_series = Cache::rememberForever('new_series', function () {
                    return LmsSeries::where('status','=', 1)->where('is_paid','=', 1)->OrderBy("updated_at", "desc")->limit(24)->get();
                });
            }else{
                $new_series       = LmsSeries::where('status','=', 1)->where('is_paid','=', 1)->OrderBy("updated_at", "desc")->limit(24)->get();

            }

            if(env('APP_CACHE')){
                $levels = Cache::rememberForever('levels', function () {
                    return \App\LmsLevel::with('courses')->select(['name','id','slug','count'])->orderBy('name','ASC')->get();
                });
            }else{
                $levels      = \App\LmsLevel::with('courses')->select(['name','id','slug','count'])->orderBy('name','ASC')->get();

            }
            $data['levels']  = $levels;
            $data['free_series']  = $free_series;
        $data['popular_series']  = $popular_series;
        $data['disc_series']  = $disc_series;
        $data['new_series']  = $new_series;

        $view_name = getTheme().'::site.searchcourses';

        return view($view_name, $data);

        } catch (Throwable $e) {
            report($e);
            return false;
        }

    }

    public function browseData($slug='',Request $request)
    {

        try{


            $cartCollection = \Cart::getContent();
            $cartTotalQuantity = \Cart::getTotalQuantity();
            $total = \Cart::getTotal();
            $data['total_quantity']     = $cartTotalQuantity;
            $data['total_amount']     = $total;
            $data['total_items']     = $cartCollection->count();;
            $data['cart_contents']     = $cartCollection;

        $subcats= $request->input('subcats');
        $levels= $request->input('levels');
            $price_str= $request->input('price');
            if($price_str=="free")
                $price =str_replace("free","0",$price_str);
            elseif($price_str=="discounted")
                $price =str_replace("discounted","2,3",$price_str);
            else
                $price=$price_str;
        $materials= $request->input('materials');
        $rating= $request->input('rating');
        $duration= $request->input('duration');
        $last_filter= $request->input('last_filter');

        $data['key'] = 'home';

        $data['active_class'] = 'lms';
        $lms_cates            = array();
        $lms_cates            = LmsSeries::getFreeSeries();

        $all_series           = array();

        if(count($lms_cates) && !$slug)
        {

            $firstOne        = $lms_cates[0];

            if(env('APP_CACHE')){
                $all_series = Cache::rememberForever('all_series', function ($firstOne) {
                    return LmsSeries::where([['status','=', 1],['lms_category_id','=', $firstOne->id]])
                        ->orWhere([['status','=', 1],['lms_parent_category_id','=', $firstOne->id]])
                        ->paginate(9);
                });
            }else{
                $all_series      = LmsSeries::where([['status','=', 1],['lms_category_id','=', $firstOne->id]])
                    ->orWhere([['status','=', 1],['lms_parent_category_id','=', $firstOne->id]])
                    ->paginate(9);
            }




            $data['title']  = ucfirst($firstOne->category);

        }

        if($slug)
        {
            $category     = App\LmsCategory::where('slug',$slug)->first();
            if(!$category){
                return abort(404);
            }else {
                if ($category->parent_id != 0) {
                    $parent_cat = App\LmsCategory::where('id', $category->parent_id)->first();
                    return redirect('/courses/' . $parent_cat->slug . '?subcats=' . $category->id);
                    //courses/accounting-finance?subcats=115
                }
            }

            if($subcats!=""){
                $child_cats     = App\LmsCategory::where('parent_id',$category->id)
                    ->whereIn('id', explode(',',$subcats))->get();
            }else{
                $child_cats     = App\LmsCategory::where('parent_id',$category->id)->get();
            }

            $data['lms_cates']    = $child_cats;

            if($subcats!="") {
//                if(env('APP_CACHE')){
//                    $all_series = Cache::rememberForever('all_series', function ($subcats) {
//                        return LmsSeries::where('status', '=', 1)
//                            ->whereIn('lms_category_id', explode(',',$subcats));
//                    });
//
//                    $count_series = Cache::rememberForever('count_series', function ($subcats) {
//                        return LmsSeries::where('status', '=', 1)
//                            ->whereIn('lms_category_id', explode(',',$subcats));
//                    });
//
//
//                }else{

                    $all_series = LmsSeries::where('status', '=', 1)
                        ->whereIn('lms_category_id', explode(',',$subcats));
                    $count_series = LmsSeries::where('status', '=', 1)
                        ->whereIn('lms_category_id', explode(',',$subcats));
             //   }


            }else{
                /*$all_series = LmsSeries::where([['status', '=', 1], ['lms_category_id', '=', $category->id]])
                    ->orWhere([['status', '=', 1], ['lms_parent_category_id', '=', $category->id]]);
                $count_series = LmsSeries::where([['status', '=', 1], ['lms_category_id', '=', $category->id]])
                    ->orWhere([['status', '=', 1], ['lms_parent_category_id', '=', $category->id]])
                    ->get();*/


                    $all_series = LmsSeries::where('status', '=', 1)->where('lms_parent_category_id', '=', $category->id);
                    $count_series = LmsSeries::where('status', '=', 1)->where('lms_parent_category_id', '=', $category->id);



            }

//            if(env('APP_CACHE')){
//                $levels = Cache::rememberForever('levels', function () {
//                    return \App\LmsLevel::with('courses')->select(['name','id','slug','count'])->orderBy('name','ASC')->get();
//                });
//            }else{
             //   $levels      = \App\LmsLevel::with('courses')->select(['name','id','slug','count'])->orderBy('name','ASC')->get();

            //}
         //   $data['levels']  = $levels;


            if($levels!="") {
                $all_series= $all_series->whereIn('level_id', explode(',',$levels));
                if($last_filter!='levels') {
                    $count_series = $count_series->whereIn('level_id', explode(',', $levels));
                }
            }
            if($price!="") {
                $all_series= $all_series->whereIn('is_paid', explode(',',$price));
                if($last_filter!='price') {
                    $count_series = $count_series->whereIn('is_paid', explode(',', $price));
                }
            }

            if($materials!="") {
                $idsArr = explode(',',$materials);
                $all_series= $all_series->whereIn('course_tags',$idsArr);
                if($last_filter!='materials') {
                    $count_series = $count_series->whereIn('course_tags', $idsArr);
                }
            }

            if($rating!="") {
               /* if(env('APP_CACHE')){
                    $cids = Cache::rememberForever('cids', function ($rating) {
                        return App\Review::select('course_id')->groupBy('course_id')
                            ->having(DB::raw('AVG(rating)'), '>=', $rating);
                    });

                    $all_series= $all_series->whereIn('id', $cids);

                    $count_series = $count_series->whereIn('id', $cids);
                }else{*/
                    $cids=App\Review::select('course_id')->groupBy('course_id')
                        ->having(DB::raw('AVG(rating)'), '>=', $rating);

                    $all_series= $all_series->whereIn('id', $cids);

                    //if($last_filter!='rating') {
                    $count_series = $count_series->whereIn('id', $cids);
                    //}
                //}



            }

            if($duration!="") {
                $arr=explode('-',$duration);
                $start=(int)$arr[0]*60;
                $end=(int)$arr[1]*60;

                $vid_duration = DB::table('lmscontents')
                    ->join('lmsseries_data', 'lmscontents.id', '=', 'lmsseries_data.lmscontent_id')
                    ->select('lmsseries_data.lmsseries_id')
                    ->groupBy('lmsseries_data.lmsseries_id')
                    ->having(DB::raw('SUM(lmscontents.video_length)'), '>', $start )
                    ->having(DB::raw('SUM(lmscontents.video_length)'), '<=', $end);




                $all_series= $all_series->whereIn('id', $vid_duration);

                if($last_filter!='duration') {
                    $count_series = $count_series->whereIn('id', $vid_duration);
                }

            }


            //$all_series= $all_series->paginate(20);
            $data['count_series']   = $count_series->get();
            $all_series= $all_series->paginate(24);
            //subcats=&levels=&price=&materials=&rating=4&duration=
            $all_series->appends(['subcats' => $subcats]);
            $all_series->appends(['levels' => $levels]);
            $all_series->appends(['price' => $price_str]);
            $all_series->appends(['materials' => $materials]);
            $all_series->appends(['rating' => $rating]);
            $all_series->appends(['duration' => $duration]);


            $data['title']  = ucfirst($category->category);
            if($category->parent_id !=0){
                $pcategory     = App\LmsCategory::where('id',$category->parent_id)->first();
                $ptitle=ucfirst($pcategory->category);
                $plink=$pcategory->slug;

            }else{

                $ptitle = ucfirst($category->category);
                $plink= $category->slug;

            }
            $data['ptitle'] =$ptitle;
            $data['plink']  =$plink;
            $data['description']  =$category->description;
        }else{

            $data['ptitle'] ="";
            $data['plink']  ="";
            $data['description'] = "";
        }

        //dd($all_series);
        $data['all_series']   = $all_series;
        $data['lms_cat_slug'] = $slug;
        $data['discounts']  = $this->discounts;
       //     $data['category'] = $category;
       // $data['paid']  = $paid;
       // $data['discounted']  = $discounted;
          //  dd($data);
        $view_name = getTheme().'::site.alllms_categories';
        return view($view_name, $data);

        } catch (Throwable $e) {
            report($e);

            return false;
        }
    }


    public function xml_facebook_feed() {
        $allseries      = LmsSeries::where('status','=', 1)->get();

        $data['key'] = 'home';

        $data['active_class'] = 'lms';




        $data['title']  = 'Facebook Feed Data';


        $data['allseries']   = $allseries;

        $view_name = getTheme().'::site.facebook_feed';
        return view($view_name, $data);


    }
    public function autocomplete(Request $request)
    {
        $data = LmsSeries::where("title","LIKE","%{$request->input('query')}%")->where("status","=",1)->get();

        return response()->json($data);
    }
    var $query="";
    public function fetchCourses(Request $request)
    {
        $user_id="0";
        if(Auth::check()){
            $user_id=Auth::user()->id;
        }
        $query=$request->input('query');
        $data= LmsSeries::with('accreditedby','reviews')->where([['status','=', 1],['lms_parent_category_id','=',$query],['setpopular','=', "yes"]])
            ->orWhere([['status','=', 1],['lms_category_id','=',$query],['setpopular','=', "yes"]])
            //->inRandomOrder()
            ->limit(10)
            ->get();

        // dd($data);
        $widget="";
        foreach($data as $series) {
           // $widget .=  view('admin.careers.datatable.actions', compact('career','seotool'));
            $widgt_id=$series->id.'_'.rand(0,20);
            $widget .= '<div class=" col-xs-6 col-sm-6 col-md-15 col-lg-15"   >';
            $widget .= '<div class="course-box newCourse"  data-toggle="popover" data-id="'.$widgt_id.'" data-container="body" data-html="true">';
            $widget .= '<div class="header__btns">';
            $widget .='<a href="javascript:void(0);" class="addToWishlist" onclick="addToWishlist('.$user_id.',' . $series->id . ');" data-purpose="toggle-wishlist" data-course="'.$series->id.'" class="dsk_btns wish__btn">';
            if(App\Http\Controllers\SiteController::CourseIsWishlisted($series->id)) {
                $widget .='<i class="fa fa-heart"></i>';
            } else {
                $widget .='<i class="fa fa-heart-o"></i>';
            }
            // $widget .= '        <span class="badge wish_count">0</span>';
            $widget .= '</a>';
            $widget .= '</div>';
            $widget .= '<a href="' . URL_VIEW_LMS_CONTENTS . $series->slug . '">';
            $widget .= '<div class="course-image">';
            if ($series->image) {

                $cimage = $series->image;
                if (strpos($cimage, '.jpeg')) {
                    if (@getimagesize(IMAGE_PATH_UPLOAD_LMS_SERIES_WIDGET . $cimage)) {
                        $cimage = $series->image;

                    } else {
                        $cimage = str_replace('jpeg', 'jpg', $cimage);
                    }
                }
                $widget .= '<img src="' . IMAGE_PATH_UPLOAD_LMS_SERIES_WIDGET . $cimage . '" alt="' . ucfirst($series->title) . '" class="img-responsive">';
            } else {
                $widget .= '<img src="' . IMAGE_PATH_EXAMS_DEFAULT . '" width="272" height="194" alt="' . ucfirst($series->title) . '" class="">';
            }
            $widget .= '</div>   </a> <div class="course-details">';
            $widget .= ' <a class="title" href="' . URL_VIEW_LMS_CONTENTS . $series->slug . '"> ' . ucfirst($series->title) . ' </a>';
            $widget .= ' <p class="instructors">';
            $widget .= '   <i class="fa fa-graduation-cap"></i> ACCREDITED BY ' . $series->accreditedby->name . ' </p>';
            $widget .= '  <div class="d-flex h__mid">';
            $widget .= '  <div class="rating">';
            if (count($series->reviews) >= 1) {
                $totalratings = $series->reviews->sum('rating');
                $avgstars = round($totalratings / count($series->reviews), 1);
                $totstars = array_fill(0, $avgstars, NULL);
                $nilstars = 5 - count($totstars);
                $empstars = array_fill(0, $nilstars, NULL);
                //$totstars=array(1,2,3,4,5);
                foreach ($totstars as $key => $value) {
                    $widget .= '<i class="fas fa-star filled"></i>';
                }
                foreach ($empstars as $key => $value) {
                    $widget .= '<i class="fas fa-star "></i>';
                }

            } else {

                $widget .= '<i class="fas fa-star "></i>';
                $widget .= '<i class="fas fa-star "></i>';
                $widget .= '<i class="fas fa-star "></i>';
                $widget .= '<i class="fas fa-star "></i>';
                $widget .= '<i class="fas fa-star "></i>';

            }
            $discounts=false;
            $widget .= '</div>';
            if($series->number_of_students>0){
            $widget .= '<div class="user-count"><i class="fa fa-users"></i> '.$series->number_of_students.'</div>';
            }
            $widget .= '</div>';
            $widget .= '<div class="d-flex h__footer">';
            $randid=rand(1,111);
            if ($discounts) {
                if($series->is_paid == 2 || $series->is_paid == 3)
                    //$widget .= ' <div class="price"><del>'.getSetting('currency_code','site_settings') . $series->cost . '</del>'.getSetting('currency_code','site_settings') . $series->discount_price;
                    $widget .= ' <div class="price">'.formatPrice($series->cost, $series->discount_price, true);
                else
                    //$widget .= ' <div class="price">' .getSetting('currency_code','site_settings'). $series->cost;
                    $widget .= ' <div class="price">' .formatPrice($series->cost, $series->discount_price, false);
                if(\Cart::get($series->id)){
                    $widget .= '  </div><a href="'.url('/cart').'"  class="btn btn-success gotocart">Go to Cart</a>';
                }else{
                    $widget .= '  </div><a id="buy_'.$series->id.'_'.$randid.'"   href="javascript:void(0);" data-course-id="'.$series->id.'" data-course-name="'.$series->title.'" data-course-price="'. currencyPrice($series->discount_price).'"  data-course-awarding-body="'.$series->accreditedby->name.'" data-quantity="1" data-image="'.$series->image.'" class="btn btn-buy-now" onclick="buyNow(' . $series->id . ',\'' . addslashes($series->title) . '\',\'' . currencyPrice($series->discount_price) . '\',1,\'' . $series->image . '\',\'' . $series->slug . '\',\'' . $series->id.'_'.$randid . '\')">Buy Now</a>';
                   // $widget .= '   </div><a   href="'.URL_VIEW_LMS_CONTENTS.$series->slug.'"  data-course-id="'.$series->id.'" data-course-name="'.$series->title.'" data-course-price="'. $price.'"  data-course-awarding-body="'.$series->accreditedby->name.'" data-quantity="1" data-image="'.$series->image.'" class="btn btn-success gotocart">View Detail</a>';
//                    <a href="javascript:void(0);"
//                       data-course-id="{{$series->id}}"
//                       data-course-name="{{addslashes($series->title)}}"
//                       data-course-price="{{currencyPrice($series->cost)}}"
//                       data-course-awarding-body="{{$series->accreditedby->name}}"
//                       data-quantity="1"
//                       data-image="{{$series->image}}"
//                       class="btn btn-buy-now" id="{{'buy_'.$series->id.'_'.$randid}}"  onclick="buyNow({{$series->id}},'{{$title}}',{{currencyPrice($series->discount_price)}},'1','{{$series->image}}','{{$series->slug}}','{{$series->id.'_'.$randid}}')">Buy Now</a>

                }
                //           onclick="addToCart(' . $series->id . ',\'' . addslashes($series->title) . '\',\'' . $series->discount_price . '\',1,\'' . $series->image . '\')"

                $widget .= '</div>';
            } else {
                if($series->is_paid == 2 || $series->is_paid == 3)
                    //$widget .= ' <div class="price"><del>' .getSetting('currency_code','site_settings') . $series->cost . '</del>'.getSetting('currency_code','site_settings') . $series->discount_price;
                    $widget .= ' <div class="price">'.formatPrice($series->cost, $series->discount_price, true);
                else
                    //$widget .= ' <div class="price">'.getSetting('currency_code','site_settings'). $series->cost;
                    $widget .= ' <div class="price">'.formatPrice($series->cost, $series->discount_price, false);
                if(\Cart::get($series->id)){
                    $widget .= '  </div><a href="'.url('/cart').'"  class="btn btn-success gotocart">Go to Cart</a>';
                }else {
                    if($series->is_paid == 2 || $series->is_paid == 3)
                        $price=$series->discount_price;
                    else
                        $price=$series->cost;

                    //$widget .= '   </div><a id="'.$series->id.'_'.$randid.'" href="javascript:void(0);"  data-course-id="'.$series->id.'" data-course-name="'.$series->title.'" data-course-price="'. $price.'"  data-course-awarding-body="'.$series->accreditedby->name.'" data-quantity="1" data-image="'.$series->image.'" class="btn btn-success" onclick="addToCart(' . $series->id . ',\'' . addslashes($series->title) . '\',\'' . $price . '\',1,\'' . $series->image . '\',\'' . $series->slug . '\',\'' . $series->id.'_'.$randid . '\')">Add to Cart</a>';
                    //$widget .= '   </div><a  href="'.URL_VIEW_LMS_CONTENTS.$series->slug.'"  data-course-id="'.$series->id.'" data-course-name="'.$series->title.'" data-course-price="'. $price.'"  data-course-awarding-body="'.$series->accreditedby->name.'" data-quantity="1" data-image="'.$series->image.'" class="btn btn-success gotocart">View Detail</a>';
                    $widget .= '  </div><a id="buy_'.$series->id.'_'.$randid.'"   href="javascript:void(0);" data-course-id="'.$series->id.'" data-course-name="'.$series->title.'" data-course-price="'. currencyPrice($series->discount_price).'"  data-course-awarding-body="'.$series->accreditedby->name.'" data-quantity="1" data-image="'.$series->image.'" class="btn btn-buy-now" onclick="buyNow(' . $series->id . ',\'' . addslashes($series->title) . '\',\'' . currencyPrice($series->discount_price) . '\',1,\'' . $series->image . '\',\'' . $series->slug . '\',\'' . $series->id.'_'.$randid . '\')">Buy Now</a>';


                }
                //onclick="addToCart(' . $series->id . ',\'' . addslashes($series->title) . '\',\'' . $series->cost . '\',1,\'' . $series->image . '\')"
                //
                //$widget .= '   <button type="button"  ng-click="buyNow2()" class="btn btn-success btn-sm float-right">Buy Now </button>';
                $widget .= '</div>';
            }
            $widget .= '</div></div></div>';
            $widget .= '<div id="'.$widgt_id.'" class="hide">';
            $widget .= ' <div class="quick-view-box">';
        $widget .= '<a rel="canonical" href="'.URL_VIEW_LMS_CONTENTS.$series->slug.'" class="quick-view-box--Title">'.$series->title.'</a>';
        $widget .= '<div class="badge-container--1NLa hide">';
           $widget .= '<div class="nLAlite-badge badge-bestseller ">Bestseller</div><span class="nLAlite-text-xs updated--2NLA">Updated';
                $widget .= '<span class="nLAlite-heading-xs"> November 2018</span></span></div>';
        $widget .= '<div class="nLAlite-text-xs box--stats--3pNLA"><span>'.sprintf("%02d", count($series->sections)).' Sections</span><span>'.$series->level->name.'</span><span>'.$series->accreditedby->name.'</span></div>';
        //$widget .= '<div class="nLAlite-text-xs box--stats--3pNLA"><span>'.sprintf("%02d", count($series->sections)).' Sections</span><span>'.Course_Time($series->sections)["lec"].' Lectures</span><span>'.$series->level->name.'</span><span>'.$series->accreditedby->name.'</span></div>';
        $widget .= '<div class="nLAlite-text-sm box--objectives--3WNla">'.$series->what_will_i_learn.'</div>';



            $widget .= '<div class="quick-view-box--cta--3NLA">';
            if(\Cart::get($series->id)){
                $widget .= '<a href="'.url('/cart').'"  class="btn add-to-cart--2Nla gotocart">Go to Cart</a>';
            }else {
//                $widget .= '<a  id = "'.$series->id.'_'.$randid.'"   href = "javascript:void(0);" data - course - id = "'.$series->id.'" data-course-name="'.addslashes($series->title).'"';
//                $widget .= ' data-course-price="'.$series->cost.'" data-course-awarding-body = "'.$series->accreditedby->name.'" data-quantity="1" ';
//                $widget .= ' data-image="'.$series->image.'" onclick = "addToCart('.$series->id.','.addslashes($series->title).','.$series->discount_price.',"1",'.$series->image.','.$series->slug.','.$series->id.'_'.$randid.')" class="btn add-to-cart--2Nla"> Add to Cart </a>';
//                $widget .= ' ';
//

                $widget .= '<a id="'.$series->id.'_'.$randid.'" href="javascript:void(0);"  data-course-id="'.$series->id.'" data-course-name="'.addslashes($series->title).'" data-course-price="'. currencyPrice($price).'"  data-course-awarding-body="'.$series->accreditedby->name.'" data-quantity="1" data-image="'.$series->image.'" class="btn add-to-cart--2Nla" onclick="addToCart(' . $series->id . ',\'' . addslashes($series->title) . '\',\'' . currencyPrice($price) . '\',1,\'' . $series->image . '\',\'' . $series->slug . '\',\'' . $series->id.'_'.$randid . '\')">Add to Cart</a>';


            }
            $widget .= '<div class="header__btns">';
            $widget .= '<a href="javascript:void(0);" class="addToWishlist dsk_btns wish__btn" data-purpose="toggle-wishlist" data-course="' . $series->id . '" onclick = "addToWishlist( 0, ' . $series->id . ');" >';
            if(Auth::user()) {

                if (App\Http\Controllers\SiteController::CourseIsWishlisted($series->id)) {
                    $widget .= ' <i class="fa fa-heart" ></i >';
                } else {
                    $widget .= '<i class="fa fa-heart-o" ></i >';
                }
                $widget .= '</a>';
            }else {
                if (App\Http\Controllers\SiteController::CourseIsWishlisted($series->id)){
                    $widget .= '<i class="fa fa-heart" ></i >';
                }else{
                    $widget .= '<i class="fa fa-heart-o" ></i >';
                }
                $widget .= '</a >';
            }
            $widget .= '</div></div></div></div></div>';
        }

        return $widget;
    }

    public function switchCurrency(Request $request){

       // return $request;

        //$_SESSION['currency_id'] = $request->currency_id;
       // $_SESSION['currency_rate'] = $request->currency_rate;
       // $_SESSION['current_url'] = $request->current_url;
       // $_SESSION['currency_short'] = $request->currency_short;
       // $_SESSION['currency_symbol'] = $request->currency_symbol;

        $request->session()->put('currency_id', $request->currency_id);
        $request->session()->put('currency_rate', $request->currency_rate);
        $request->session()->put('currency_symbol', $request->currency_symbol);
        $request->session()->put('currency_short', $request->currency_short);

        $cartempty=\Cart::isEmpty();
        if(!$cartempty){
        $items = \Cart::getContent();
        if(count($items)){
            foreach($items as $item)
            {
                //
                if(Select_Courses_On_ID($item->id)->is_paid>1){
                    $price=Select_Courses_On_ID($item->id)->discount_price;
                }else{
                    $price=Select_Courses_On_ID($item->id)->cost;
                }
                // \Cart::add($id,$name, $price, $qty, $customAttributes);
                \Cart::update($item->id, array(
                    'name' => $item->name, // new item name
                    'price' => currencyPrice($price), //
                    'attributes' => array(
                        'discounted_price' => currencyPrice($item->attributes->discounted_price),
                        'image' => $item->attributes->image,
                        'slug' => $item->attributes->slug,
                        'from_gift' => $item->attributes->from_gift,
                        'currency' => session('currency_short'),
                        'symbol' => session('currency_symbol')

                    ),
                ));
            }
        }
        }

        return response()->json(['success'=>true,'title'=>'Congratulations!', 'message'=>'Thanks!']);

    }

    public static function CourseIsWishlisted($CourseID = 0) {
        if(Auth::user()) {
            return App\Wishlist::where('user_id', Auth::user()->id)->where('course_id', $CourseID)->first();
        } else {
            return false;
        }
    }

    public static function CountWishlistedItem() {
        if(Auth::user()) {
            return App\Wishlist::join('lmsseries', 'wishlists.course_id', '=', 'lmsseries.id')
                ->select('*')
                ->where('wishlists.user_id', '=', Auth::user()->id)
                ->count();
        } else {
            return 0;
        }
    }


    /**
     * View all contents in specific lms series
     * @param  [type] $slug [description]
     * @return [type]       [description]
     */
    public function frontLMSContents($slug)
    {

        $data['key'] = 'home';

        $data['active_class'] = 'lms';
        $data['preview_mode'] = false;
        if(Auth::check()){
            $user=Auth::user();
        }

        if(Auth::check() && (getRoleData($user->role_id)=='admin' || getRoleData($user->role_id)=='owner')) {
            $lms_series   = LmsSeries::where('slug',$slug)->first();
            if($lms_series->status==0){
                $data['preview_mode'] = true;
            }

        }else{
            $lms_series   = LmsSeries::where('slug',$slug)->where('status',1)->first();
        }
        if(!$lms_series){
            return abort(404);
        }else{
        $parent=false;
        if($lms_series->lms_parent_category_id!=null || $lms_series->lms_parent_category_id!=0 ){
            $parent=true;
            $lms_parent_category = App\LmsCategory::where('id',$lms_series->lms_parent_category_id)->first();

        }
        $lms_category = App\LmsCategory::where('id',$lms_series->lms_category_id)->first();

        $lms_series_related=LmsSeries::where([['status','=', 1],['lms_parent_category_id','=', $lms_series->lms_category_id]])
            ->orWhere([['status','=', 1],['lms_category_id','=', $lms_series->lms_category_id]])
            ->whereNotIn('id', [$lms_series->id])
            ->groupBy('id')
            ->inRandomOrder()
            ->limit(10)
            ->get();

        if(count($lms_series_related)<4){
            $lms_series_related=LmsSeries::where('lms_parent_category_id',$lms_category->parent_id)
                ->where('status','=',1)
                ->whereNotIn('id', [$lms_series->id])
                ->inRandomOrder()
                ->groupBy('id')
                ->limit(10)
                ->get();
        }
        $excludeids="";
        foreach ($lms_series_related as $item){
            $excludeids.=$item->id.",";
        }
            $excludeids= rtrim($excludeids, ",");
       // dd( rtrim($excludeids, ","));
        //echo count($lms_series_related);



///OLD frequently_bought =====================================/////////////////
        $moresells = DB::table('user_courses')
            ->select('item_id', DB::raw('count(item_id) as total'))
            ->where('item_price','>',0 )
            ->groupBy('item_id')
            ->orderByDesc('total')
            ->limit(5);

        $frequently_bought = LmsSeries::where('status','=',1)
            ->joinSub($moresells, 'most_sells', function ($join) {
                $join->on('lmsseries.id', '=', 'most_sells.item_id');
            })
            ->limit(5)
            ->get();
///OLD frequently_bought =====================================/////////////////


        $frequently_bought=LmsSeries::where([['status','=', 1],['lms_parent_category_id','=', $lms_series->lms_category_id]])
            ->orWhere([['status','=', 1],['lms_category_id','=', $lms_series->lms_category_id]])
            ->whereNotIn('id', [$lms_series->id])
            ->whereNotIn('id', explode(',',$excludeids))
            ->groupBy('id')
            ->inRandomOrder()
            ->limit(7)
            ->get();

            $data['already_purchased'] = false;
            $data['purchased_date'] = '';


            /*if(Auth::check()){
                $user_purchased = App\UserCourses::where('item_id',$lms_series->id)
                    ->where('user_id',Auth::user()->id)
                    ->first();
                if($user_purchased){
                    $data['already_purchased'] = true;
                    $data['purchased_date'] = date("M. d, Y",strtotime($user_purchased->created_at));
                }
            }*/



        $lms_sections = App\LmsSeriesSections::where('lmsseries_id',$lms_series->id)->get();
        $contents     = $lms_series->viewContents(9);
        $sections     = $lms_series->viewSections(9);

        $exams     = $lms_series->exams();
        $data['contents']     = $contents;
        //$data['sections']     = $lms_series->sections;
        $data['sections']     = $sections;
        $data['lms_sections']     = $lms_sections;
        $data['awardingbody']     = $lms_series->accreditedby;
        $data['lms_series']   = $lms_series;
        $data['title']        = ucfirst($lms_series->title);
        $data['image']         = $lms_series->image;

        $data['video']         = $lms_series->video;
        $data['desc']         = $lms_series->description;
        $data['number_of_reviews']         = $lms_series->number_of_reviews;
        $data['number_of_modules']         = $lms_series->number_of_modules;
        $data['desc']         = $lms_series->description;
        $data['short_desc']   = $lms_series->short_description;
        $lms_cates            = LmsSeries::getFreeSeries();
        $data['level']    = $lms_series->level;
        $data['lms_cates']    = $lms_cates;
        $data['lms_cat_slug'] = $lms_category->slug;
        $data['lms_cat_title'] = $lms_category->category;
        $data['parent_cat_status'] = $parent;
        if($parent) {
            $data['lms_parent'] = $lms_parent_category;
        }
        $data['discounts']  = $this->discounts;
        $data['lms_series_related'] = $lms_series_related;

        $data['frequently_bought'] = $frequently_bought;

        $data['edit_url']    = URL_LMS_SERIES_EDIT.$lms_series->slug;
        // dd($data);
        if(checkRole(getUserGrade(3)))  {
            $data['display_edit']    = true;

        }else{
            $data['display_edit']    = false;
        }
        //dd($data);
        $view_name = getTheme().'::site.lms-contents';
        return view($view_name, $data);
        }

    }

    public function viewCart(Request $request)
    {
        $data['active_class'] = 'lms';
        $cartCollection = \Cart::getContent();
        $cartTotalQuantity = \Cart::getTotalQuantity();
        $total = \Cart::getTotal();
        $data['total_quantity']     = $cartTotalQuantity;
        $data['total_amount']     = $total;
        $data['total_items']     = $cartCollection->count();;

        $data['cart_contents']     = $cartCollection;

        /********** if offer active **********/
        if(ActiveOfferChk(json_decode(GetActiveOfferData(4)->content_area, true)["offerID"])) {
            return redirect(PREFIX . 'promocheckout');
        }
        /********** if offer active **********/

        /******* Coupon Code ********/
        //$request->session()->flush();
        if($request->session()->has('Coupon_code')) {
            $data['CouponData'] = App\Couponcode::where("coupon_code", $request->session()->get('Coupon_code'))
                ->where('valid_from','<=',date('Y-m-d'))
                ->where('valid_to', '>=', date('Y-m-d'))
                ->where('status','=','Active')
                ->first();
        }
        /******* Coupon Code ********/

        $view_name = getTheme().'::site.cart-detail';
        return view($view_name, $data);




    }

    public function ApplyCouponCodeCart(Request $request)
    {
        $data['active_class'] = 'lms';
        $cartCollection = \Cart::getContent();
        $cartTotalQuantity = \Cart::getTotalQuantity();
        $total = \Cart::getTotal();
        $data['total_quantity']     = $cartTotalQuantity;
        $data['total_amount']     = $total;
        $data['total_items']     = $cartCollection->count();;

        $data['cart_contents']     = $cartCollection;

        /******* Coupon Code ********/
        if($request->session()->get('Coupon_code') == $request->coupon_code) {
            $Res_Coupon =   App\Couponcode::where("coupon_code", $request->coupon_code)
                ->where('valid_from','<=',date('Y-m-d'))
                ->where('valid_to', '>=', date('Y-m-d'))
                ->where('status','=','Active')
                ->first();
            $data['cartMSG']         = "You have already applied this promo code!";
        }
        $data['Coupon']  = $request->coupon_code;
        $Res_Coupon =   App\Couponcode::where("coupon_code", $request->coupon_code)
            ->where('valid_from','<=',date('Y-m-d'))
            ->where('valid_to', '>=', date('Y-m-d'))
            ->where('status','=','Active')
            ->first();
        if($Res_Coupon) {
            $data['code_value']         = $Res_Coupon->discount_value;
            $request->session()->put('Coupon_code', $request->coupon_code);
            $request->session()->put('Coupon_value', $Res_Coupon->discount_value);
        } else {
//            $data['Coupon']         = "non";
            $data['cartMSG']         = "Invalid Coupon Code!";
            //$request->session()->forget('Coupon_code');
            //$request->session()->forget('Coupon_value');
            if($request->session()->has('Coupon_code')) {
                $Res_Coupon =   App\Couponcode::where("coupon_code", $request->session()->get('Coupon_code'))
                    ->where('valid_from','<=',date('Y-m-d'))
                    ->where('valid_to', '>=', date('Y-m-d'))
                    ->where('status','=','Active')
                    ->first();
            }
        }
        $data['CouponData'] = $Res_Coupon;
        /******* Coupon Code ********/

        $view_name = getTheme().'::site.cart-detail';
        return view($view_name, $data);
    }

    public function viewCheckout(Request $request)
    {
        $user="";
        $userflag=false;
        if (Auth::check()) {
            $user = Auth::user();
            $userflag=true;
        }

        /********** if offer active **********/
        if(ActiveOfferChk(json_decode(GetActiveOfferData(4)->content_area, true)["offerID"])) {
            return redirect(PREFIX . 'promocheckout');
        }
        /********** if offer active **********/

        $data['userflag']=$userflag;
        $data['user']=$user;
        //dd($user);
        $data['active_class'] = 'lms';
        $cartCollection = \Cart::getContent();
        $cartTotalQuantity = \Cart::getTotalQuantity();
        $total = \Cart::getTotal();
        $countries = App\Country::all();
        $data['countries']     = $countries;
        $data['total_quantity']     = $cartTotalQuantity;
        $data['total_amount']     = $total;
        $data['total_items']     = $cartCollection->count();

        /******* Coupon Code ********/
        //$request->session()->flush();
        if($request->session()->has('Coupon_code')) {
            $data['CouponData'] = App\Couponcode::where("coupon_code", $request->session()->get('Coupon_code'))
                ->where('valid_from','<=',date('Y-m-d'))
                ->where('valid_to', '>=', date('Y-m-d'))
                ->where('status','=','Active')
                ->first();
        }
        /******* Coupon Code ********/

        $data['cart_contents']     = $cartCollection;

        //if (Auth::check() && $cartCollection->count()>0) {
        if ($cartCollection->count()>0) {
            $view_name = getTheme().'::site.checkout-detail';
            return view($view_name, $data);
        }else{
            return redirect('/cart')->withErrors(['You can not checkout with empty cart']);
        }



    }

    public function ApplyCouponCode(Request $request) {

        $data = [];
        $user="";
        $userflag=false;

        $data['active_class'] = 'LMS';
        $data['title']        = 'View Cart';

        if (Auth::check()) {
            $user = Auth::user();
            $userflag=true;
        }

        $data['userflag']=$userflag;
        $data['user']=$user;

        $cartCollection = \Cart::getContent();
        $cartTotalQuantity = \Cart::getTotalQuantity();
        $total = \Cart::getTotal();
        $countries = App\Country::all();


        $data['countries']      = $countries;
        $data['total_quantity'] = $cartTotalQuantity;
        $data['total_amount']   = $total;
        $data['total_items']    = $cartCollection->count();

        $data['cart_contents']  = $cartCollection;
        $data['Coupon']  = $request->coupon_codes;

        /******* Coupon Code ********/

        if($request->session()->get('Coupon_code') == $request->coupon_codes) {
            $Res_Coupon =   App\Couponcode::where("coupon_code", $request->coupon_codes)
                ->where('valid_from','<=',date('Y-m-d'))
                ->where('valid_to', '>=', date('Y-m-d'))
                ->where('status','=','Active')
                ->first();
            $data['cartMSG']         = "You have already applied this promo code!";
        }

        $Res_Coupon =   App\Couponcode::where("coupon_code", $request->coupon_codes)
            ->where('valid_from','<=',date('Y-m-d'))
            ->where('valid_to', '>=', date('Y-m-d'))
            ->where('status','=','Active')
            ->first();
        if($Res_Coupon) {
            $data['code_value']         = $Res_Coupon->discount_value;
            $request->session()->put('Coupon_code', $request->coupon_codes);
            $request->session()->put('Coupon_value', $Res_Coupon->discount_value);
        } else {
//            $data['Coupon']         = "non";
            $data['cartMSG']         = "Invalid Coupon Code!";
            //$request->session()->forget('Coupon_code');
            //$request->session()->forget('Coupon_value');
            if($request->session()->has('Coupon_code')) {
                $Res_Coupon =   App\Couponcode::where("coupon_code", $request->session()->get('Coupon_code'))
                    ->where('valid_from','<=',date('Y-m-d'))
                    ->where('valid_to', '>=', date('Y-m-d'))
                    ->where('status','=','Active')
                    ->first();
            }
        }
        $data['CouponData'] = $Res_Coupon;
        /******* Coupon Code ********/

        $view_name = getTheme().'::site.checkout-detail';
        return view($view_name, $data);
    }


    public function addToCart(Request $request)
    {

//      \Cart::remove(455);
//      \Cart::remove(456);
        //$userId = 1; // get this from session or wherever it came from
        $id = request('id');
        $name = request('name');
        $price = request('price');
        $qty = request('qty');
        $slug = request('slug');
        $image = request('image');
        $customAttributes = [
            'image' => $image,
            'slug' => $slug,
            'currency' => session('currency_short'),
            'symbol' => session('currency_symbol')
        ];
        $data['already_purchased'] = "";
        /*if (Auth::check()) {
            $user_purchased = App\UserCourses::where('item_id', $id)
                ->where('user_id', Auth::user()->id)
                ->first();
            if ($user_purchased) {
                $data['already_purchased'] = url('/course/' . $slug);
                return response(array(
                    'success' => true,
                    'data' => $data,
                    'message' => "item added."
                ), 201, []);

            }
        }*/
        //if (\Cart::get($id) == null) {
            \Cart::add($id, $name, $price, $qty, $customAttributes);
            //$item = \Cart::add($id, $name, $price, $qty, $customAttributes);
        //}

        $cartCollection = \Cart::getContent();
        // $cartCollection->count();
        $cartTotalQuantity = \Cart::getTotalQuantity();
        $total = \Cart::getTotal();
        $data['total_quantity']     = $cartTotalQuantity;
        $data['total_amount']     = round($total,2);
        $data['total_items']     = $cartCollection->count();

        $data['cart_contents']     = $cartCollection;
        $data['image']     = $image;
        $data['slug']     = $slug;
        $data['new_item']     = \Cart::get($id);


//        $view_name = getTheme().'::site.cart';
//        return view($view_name, $data);


        return response(array(
            'success' => true,
            'data' => $data,
            'message' => "item added."
        ),201,[]);

    }

    public function UpdateQuantity(Request $request){

        $data = json_decode($request->getContent());

        foreach ($data->items as $item){

            if($item->qty==0){
                \Cart::remove($item->id);
            }else{
                \Cart::update($item->id, array(
                    'quantity' => array(
                        'relative' => false,
                        'value' => $item->qty
                    ),

                ));

            }


        }
        return response(array(
            'success' => true,
            'data' => $data,
            'message' => "Cart Updated Successfully"
        ),201,[]);

    }
    public function UpdateCart(Request $request)
    {
        $id = $request->id;
        $NewPrice   = (\Cart::get($id)->price) - ((($request->percentagee) / 100) * (\Cart::get($id)->price));

        \Cart::update($id,[
            'price' => $NewPrice
        ]);

        $data   = \Cart::get($id)->price;
        return response(array(
            'success' => true,
            'data' => $data,
            'NewPrice' => $NewPrice,
            'message' => "Price Updated."
        ),201,[]);
    }

    public function buyNow(Request $request)
    {


        $id = request('id');
        $name = request('name');
        $price = request('price');
        $qty = request('qty');
        $slug = request('slug');
        $image = request('image');
        $customAttributes = [
            'image' => $image,
            'slug' => $slug

        ];

        $data['already_purchased']     = "";
        if(Auth::check()){
            $user_purchased = App\UserCourses::where('item_id',$id)
                ->where('user_id',Auth::user()->id)
                ->first();
            if($user_purchased){
                $data['already_purchased']= '/course/'.$slug;
            }
        }

        $alreadyincart=\Cart::get($id);
        if($alreadyincart==null)
        \Cart::add($id,$name, $price, $qty, $customAttributes);

        $data['already']     = $alreadyincart;


        $cartCollection = \Cart::getContent();
        // $cartCollection->count();
        $cartTotalQuantity = \Cart::getTotalQuantity();
        $total = \Cart::getTotal();
        $data['total_quantity']     = $cartTotalQuantity;
        $data['total_amount']     = $total;
        $data['cart']     = $cartCollection;
        $data['total_items']     = $cartCollection->count();;

        $data['cart_contents']     = $cartCollection;
        $data['image']     = $image;
        $data['slug']     = $slug;
        $data['new_item']     = \Cart::get($id);

//        $view_name = getTheme().'::site.checkout-detail';
//        return view($view_name, $data);

        return response(array(
            'success' => true,
            'data' => $data,
            'message' => "item added."
        ),201,[]);

    }


    public function removeToCart(Request $request)
    {
        $id = request('id');
        \Cart::remove($id);


        $cartCollection = \Cart::getContent();
        // $cartCollection->count();
        $cartTotalQuantity = \Cart::getTotalQuantity();
        $total = \Cart::getTotal();
        $data['total_quantity']     = $cartTotalQuantity;
        $data['total_amount']     = round($total,2);
        $data['total_items']     = $cartCollection->count();

        $data['cart_contents']     = $cartCollection;
        $data['is_empty']     = \Cart::isEmpty();
        if($data['is_empty']){
            $request->session()->forget('Coupon_code');
            $request->session()->forget('Coupon_value');
            $message="<div class='col-md-12 text-center'><h4 class='box_cart'>Your cart is Empty.</h4><br><a class='btn btn-primary' href='".url('/all-courses')."' type='button'>Browse and Keep Learning </a></div>";
        }else{
            $message="item removed.";

        }

        return response(array(
            'success' => true,
            'data' => $data,
            'message' => $message
        ),201,[]);

    }

    public function RemoveDeletedItem() {
        $items = \Cart::getContent();
        foreach($items as $item) {
            $CourseObj  =   LmsSeries::where("id", $item->id)->where("status", 1)->first();
            if(!$CourseObj) {
                \Cart::remove($item->id);
            }

        }

        return true;
    }


    public function clearCart(Request $request)
    {

        $data=\Cart::clear();
        $request->session()->forget('Coupon_code');
        $request->session()->forget('Coupon_value');


        return response(array(
            'success' => true,
            'data' => $data,
//            'message' => "<div class='col-md-12 text-center'><h4 class='box_cart'>Your cart is Empty.</h4><br><a class='btn btn-primary' href='".url('/all-courses')."' type='button'>Browse and Keep Learning </a></div>"
            'message' => "<div class='col-md-12 text-center'><h4 class='box_cart'>Your cart is Empty.</h4><br><a class='btn btn-primary' href='".url('/all-courses')."' type='button'>Browse and Keep Learning </a></div>"
        ),201,[]);

    }


    /**
     * Downlaod lms file type contents
     * @return [type] [description]
     */
    public function downloadLMSContent($content_slug){
        $content_record = App\LmsContent::getRecordWithSlug($content_slug);
        // dd($content_record);

        try {

            $pathToFile= "public/uploads/lms/content"."/".$content_record->file_path;

            return Response::download($pathToFile);

        } catch (Exception $e) {

            flash('Ooops','file_is_not_found','error');
            return back();
        }


    }

    /**
     * View video type lms contents
     * @param  [type] $content_slug [description]
     * @return [type]               [description]
     */
    public function viewVideo($content_slug,$series_id='')
    {
        // dd($series_id);
        $content_record = App\LmsContent::getRecordWithSlug($content_slug);


        $data['key'] = 'home';

        $data['active_class']    = 'lms';
        $data['title']           = ucfirst($content_record->title);
        $data['content_record']  = $content_record;
        $data['video_src']       =  $video_src = $content_record->file_path;
        if($series_id!=''){
            $first_series   = LmsSeries::where('id',$series_id)->first();

            $all_series   = LmsSeries::where('lms_category_id',$first_series->lms_category_id)
                ->where('id','!=',$first_series->id)
                ->where('show_in_front',1)
                ->where('total_items','>',0)
                ->get();
            // dd($all_series);
        }

        $data['first_series']  = $first_series;
        $data['all_series']    = $all_series;

        $view_name = getTheme().'::site.lms-content-video';
        return view($view_name, $data);
    }

    public function saveCourseProgress(Request $request){
        $user="";
        $userflag=false;
        if (Auth::check()) {
            $user = Auth::user();
            $userflag=true;
        }
        $lesson_id = $request->lesson_id;
        $progress = $request->progress;
        $user_id   = $user->id;
        $watch_history = $user->watch_history;
        $watch_history_array = array();
        if ($watch_history == '') {
            array_push($watch_history_array, array('lesson_id' => $lesson_id, 'progress' => $progress));
        } else {
            $founder = false;
            $watch_history_array = json_decode($watch_history, true);
            for ($i = 0; $i < count($watch_history_array); $i++) {
                $watch_history_for_each_lesson = $watch_history_array[$i];
                if ($watch_history_for_each_lesson['lesson_id'] == $lesson_id) {
                    $watch_history_for_each_lesson['progress'] = $progress;
                    $watch_history_array[$i]['progress'] = $progress;
                    $founder = true;
                }
            }
            if (!$founder) {
                array_push($watch_history_array, array('lesson_id' => $lesson_id, 'progress' => $progress));
            }
        }
//        $progress_bar =   ceil(course_progress($request->item_id));
        $data['watch_history'] = json_encode($watch_history_array);
        $record = User::where('id', $user_id)->get()->first();
        $record->watch_history = json_encode($watch_history_array);
        $record->save();
        // CHECK IF THE USER IS ELIGIBLE FOR CERTIFICATE
//        if (addon_status('certificate')) {
//            $this->load->model('addons/Certificate_model', 'certificate_model');
//            $this->certificate_model->check_certificate_eligibility("lesson", $lesson_id, $user_id);
//        }
        $completed_lessons_ids = array();
        $lesson_completed = 0;
        $progress_bar = 0;
        if($record->watch_history!="" || $record->watch_history!=null) {
            $watch_history_array = json_decode($record->watch_history, true);
            $lmsseries = \App\LmsSeriesData::where('lmsseries_id', $request->item_id)->get();
            $lessons_for_that_course = $lmsseries;
            $total_number_of_lessons = $lmsseries->count();
            for ($i = 0; $i < count($watch_history_array); $i++) {
                $watch_history_for_each_lesson = $watch_history_array[$i];
                if ($watch_history_for_each_lesson['progress'] == 1) {
                    array_push($completed_lessons_ids, $watch_history_for_each_lesson['lesson_id']);
                }
            }
            foreach ($lessons_for_that_course as $row) {

                if (in_array($row['lmscontent_id'], $completed_lessons_ids)) {
                    $lesson_completed++;
                }
            }
            if ($lesson_completed > 0 && $total_number_of_lessons > 0) {
                $course_progress = ($lesson_completed / $total_number_of_lessons) * 100;
                $progress_bar = ceil($course_progress);
            } else {
                $progress_bar = 0;
            }
        }
        return response()->json(['success'=>true,'title'=>'Congratulations!','progress_bar'=>$progress_bar, 'message'=>'You completed course unit successfully']);


    }

    /**
     * Send a email to super admin with user contact us details
     * @param Request $request [description]
     */

    function get_client_ip_server() {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';

        return $ipaddress;
    }

    public function getContactUs()
    {



        $data['active_class']  = "contact_us";
        $data['title']  = getPhrase('contact_us');
        $rechaptcha_status    = getSetting('enable_rechaptcha','recaptcha_settings');
        $data['rechaptcha_status']  = $rechaptcha_status;

        /*$userip=$this->get_client_ip_server();

        $userip='111.119.187.24';
        if ($position = Location::get($userip)) {
            // Successfully retrieved position.
            //dd($position);
            //echo $position->countryName;
        }*/


        try {

            $view_name = getTheme().'::site.contact-us';
            return view($view_name, $data);

        } catch (Exception $e) {
             dd($e->getMessage());
        }

    }

    public function getAboutUs()
    {
        // dd($request);


        $data['active_class']  = "about-us";
        $data['title']  = getPhrase('about_us');

        try {

            $view_name = getTheme().'::site.about-us';
            return view($view_name, $data);

        } catch (Exception $e) {
            // dd($e->getMessage());
        }

    }

    public function getFreeCourses()
    {

        return redirect('/courses/search?subcats=&levels=&price=free&last_filter=price&search_term=all');


        $data['key'] = 'home';

        $data['active_class'] = 'lms';
        $lms_cates            = array();
        $lms_cates            = LmsSeries::getFreeSeries();
        $data['lms_cates']    = $lms_cates;
        $all_series           = array();

        if(count($lms_cates))
        {

            //$firstOne        = $lms_cates[rand(0,count($lms_cat.es))];
            $all_series      = LmsSeries::where('status','=', 1)->where('is_paid','=', 0)->limit(15)->get();

            $data['title']  = "Free Courses";

        }
        try {
            $data['ptitle']  ="Courses";
            $data['plink']  = "";
            $data['all_series']   = $all_series;
            $data['lms_cat_slug'] ='';
            $data['discounts']  = $this->discounts;
            $view_name = getTheme().'::site.custom-courses';
            return view($view_name, $data);



        } catch (Exception $e) {
            dd($e->getMessage());
        }

    }

    public function getNewCourses()
    {
        // dd($request);
        return redirect('/courses/search?subcats=&levels=&sort=new&search_term=all');


        $data['key'] = 'home';

        $data['active_class'] = 'lms';
        $lms_cates            = array();
        $lms_cates            = LmsSeries::getFreeSeries();
        $data['lms_cates']    = $lms_cates;
        $all_series           = array();

        if(count($lms_cates))
        {

            //$firstOne        = $lms_cates[rand(0,count($lms_cates))];
            $all_series      = LmsSeries::where('status','=', 1)
                ->whereIn('slug',['behavioural-safety','cdm-awareness','conflict-resolution-in-the-workplace','control-of-substances-hazardous-to-health-coshh','customer-service','dementia-awareness','developing-good-employee-relations','developing-teamwork
', 'dignity-and-privacy', 'disciplinary-procedures', 'display-screen-equipment-awareness', 'drug-and-alcohol-awareness', 'duty-of-care', 'effective-delegation', 'electrical-safety', 'emergency-first-aid-at-work-annual-online-refresher'])->get();

            $data['title']  = "New Courses";

        }
        try {
            $data['ptitle']  ="Courses";
            $data['plink']  = "";
            $data['all_series']   = $all_series;
            $data['lms_cat_slug'] ='';
            $data['discounts']  = $this->discounts;
            $view_name = getTheme().'::site.free-courses';
            return view($view_name, $data);



        } catch (Exception $e) {
            dd($e->getMessage());
        }

    }

    public function getPopularCourses()
    {
        // dd($request);
        return redirect('/courses/search?subcats=&levels=&sort=popular&search_term=all');
        $data['key'] = 'home';

        $data['active_class'] = 'lms';
        $lms_cates            = array();
        $lms_cates            = LmsSeries::getFreeSeries();
        $data['lms_cates']    = $lms_cates;
        $all_series           = array();

        if(count($lms_cates))
        {

            //$firstOne        = $lms_cates[rand(0,count($lms_cates))];
            $all_series      = LmsSeries::where('status','=', 1)
                ->whereIn('slug',['gardening-and-landscaping','legal-secretary','daily-make-up','photoshop-illustrator-cc-become-a-professional-logo-designer','mastering-counselling','mastering-childcare-with-nutrition','microsoft-excel-2019-beginners','email-marketing-mastery-the-ultimate-guide-to-online-business
', 'project-management', 'dog-grooming', 'time-management'])->get();

            $data['title']  = "Popular Courses";

        }
        try {
            $data['ptitle']  ="Courses";
            $data['plink']  = "";
            $data['all_series']   = $all_series;
            $data['lms_cat_slug'] ='';
            $data['discounts']  = $this->discounts;

            //dd($data);
            $view_name = getTheme().'::site.free-courses';
            return view($view_name, $data);



        } catch (Exception $e) {
            dd($e->getMessage());
        }

    }

    public function getDiscountedCourses()
    {
        // dd($request);
        return redirect('/courses/search?subcats=&levels=&price=discounted&last_filter=discounted&search_term=all');
        //courses/search?subcats=&levels=&price=2,3&search_term=all

        $data['key'] = 'home';

        $data['active_class'] = 'lms';
        $lms_cates            = array();
        $lms_cates            = LmsSeries::getFreeSeries();
        $data['lms_cates']    = $lms_cates;
        $all_series           = array();

        if(count($lms_cates))
        {

            //$firstOne        = $lms_cates[rand(0,count($lms_cates))];
            $all_series      = LmsSeries::where('is_paid','=', 3)->OrderBy("updated_at", "desc")->get();

            $data['title']  = "Discounted Courses";

        }
        try {
            $data['ptitle']  ="Courses";
            $data['plink']  = "";
            $data['all_series']   = $all_series;
            $data['lms_cat_slug'] ='';
            $data['discounts']  = $this->discounts;
            $view_name = getTheme().'::site.free-courses';
            return view($view_name, $data);



        } catch (Exception $e) {
            dd($e->getMessage());
        }

    }

    public function getTerms()
    {
        // dd($request);


        $data['active_class']  = "terms-and-conditions";
        $data['title']  = getPhrase('terms_and_conditions');

        try {

            $view_name = getTheme().'::site.terms-and-conditions';
            return view($view_name, $data);

        } catch (Exception $e) {
            // dd($e->getMessage());
        }

    }

    /****** Close popup for 3 days ******/
    public static function SetUserdaysplus3(Request $request){
        $minutes = ((60*24)*3);
        $response = new Response('CookieSets');
        $response->withCookie(cookie('isActive', 'no', $minutes));
        return $response;
    }

    public static function getUserdaysplus3(Request $request){
        echo $request->cookie('isActive');
    }
    /****** Close popup for 3 days ******/

    public function getPrivacy()
    {
        // dd($request);


        $data['active_class']  = "privacy-policy";
        $data['title']  = getPhrase('privacy_policy');

        try {

            $view_name = getTheme().'::site.privacy-policy';
            return view($view_name, $data);

        } catch (Exception $e) {
            // dd($e->getMessage());
        }

    }

    public function ContactUsForm(Request $request)
    {
        if(checkSpam($request->name))  return abort(404);
        if(checkSpam($request->subject))  return abort(404);
        if(checkSpam($request->msg))  return abort(404);
        if ($request->name=='AnteseeHep')  return abort(404);

        try {



        $rechaptcha_status    = getSetting('enable_rechaptcha','recaptcha_settings');
        // $rechaptcha_status    = 'no';

        if ( $rechaptcha_status  == 'yes') {

            $columns = array(
                'name' => 'bail|required|max:250|',
                'email' => 'bail|required|email',
                'subject'=>'bail|required|max:250|',
                'phone'=>'required',
                'agree'=>'required',
                'msg'=>'required|max:250',
                'g-recaptcha-response' => 'required|captcha'
            );
            $messsages = array(
                'g-recaptcha-response.required'=>'Please Select Captcha',
                'name.required'=>'Name is required',
                'email.required'=>'Email is required',
                'subject.required'=>'Subject is required',
                'phone.required'=>'Phone is required',
                'msg.required'=>'Message is required',

                'agree.required'=>'Agree Terms & Conditions',
            );

            $this->validate($request,$columns,$messsages);

        }
        else {

            $rules = [
                'name' => 'bail|required|max:250|',
                'email' => 'bail|required|email',
                'subject'=>'bail|required|max:250|',
                'phone'=>'required',
                'msg'=>'required|max:250',

                'agree'=>'required'
            ];

            $messsages = array(
                'name.required'=>'Name is required',
                'email.required'=>'Email is required',
                'subject.required'=>'Subject is required',
                'phone.required'=>'Phone is required',
                'msg.required'=>'Message is required',
                'agree.required'=>'Agree Next Learn Academy Terms & Conditions',
            );

            $this->validate($request, $rules,$messsages);

        }



        $record = new App\Enquiry();

        $record->subject = $request->subject;
        $record->name = $request->name;
        $record->email = $request->email;
        $record->phone = $request->phone;
        $record->message = $request->msg;

        $record->Subscribed = ($request->sub=='Yes')?'1':'0';
        $record->enquiry_type= "Contact Us";
        if(Auth::user()) {
            $record->user_id = Auth::user()->id;
        }
        $record->save();




            sendEmail('contactus_admin', array('name'=> $request->name,
                'to_email' => $request->email,
                'send_to' => 'admin',
                'phone' => $request->phone,
                'subject' => $request->subject,
                'message' => $request->msg,
                'url' => BASE_PATH ));

            sendEmail('contactus_ack', array('name'=> $request->name,
                'to_email' => $request->email,
                'phone' => $request->phone,
                'subject' => $request->subject,
                'message' => $request->msg,
                'url' => BASE_PATH ));





        toastr()->success('Thanks! Our Team will contact you soon');
        // toastr('Thanks! Our Team will contact you soon', 'success','Congratulations!');
        //flash('congratulations','our_team_will_contact_you_soon','success');
        return redirect(URL_SITE_CONTACTUS.'#contact')->with('status', 'Thank you for getting in touch! ');

        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }



    public function ContactUs(Request $request)
    {
        //dd($request);
        if(checkSpam($request->name))  return abort(404);
        if(checkSpam($request->subject))  return abort(404);
        if(checkSpam($request->cmsg))  return abort(404);
        if ($request->name=='AnteseeHep')  return abort(404);




        if ($request->name=='AnteseeHep')  return abort(404);
        try {


        $rechaptcha_status    = getSetting('enable_rechaptcha','recaptcha_settings');
       // $rechaptcha_status    = 'yes';

        if ( $rechaptcha_status  == 'yes') {

            $columns = array(
                'name' => 'bail|required|max:250|',
                'email' => 'bail|required|email',
                'subject'=>'bail|required|max:250|',
                'cmsg'=>'required|max:1050',
                'g-recaptcha-response' => 'required|captcha'
            );
            $messsages = array(
                'g-recaptcha-response.required'=>'Please Select Captcha',
                'g-recaptcha-response.captcha'=>'Please Select Captcha ',
                'name.required'=>'Name is required',
                'email.required'=>'Email is required',
                'subject.required'=>'Subject is required',
                'cmsg.required'=>'Message is required',
                'cmsg.max'=>'Message max words allowed 1050'
            );
            $customMessages = [
                'required' => 'The :attribute field is required.'
            ];

            $validator = Validator::make($request->all(), $columns, $messsages);
            /******* Form Validation *****/
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator->errors());
            }

           // $this->validate($request,$columns,$messsages);

        }
        else {

            $rules = [
                'name' => 'bail|required|max:250|',
                'email' => 'bail|required|email',
                'subject'=>'bail|required|max:250|',
                'cmsg'=>'required|max:250'
            ];

            $messsages = array(
                'name.required'=>'Name is required',
                'email.required'=>'Email is required',
                'subject.required'=>'Subject is required',
                'cmsg.required'=>'Message is required'
            );

            $this->validate($request, $rules,$messsages);

        }



        $record = new App\Enquiry();

        $record->subject = $request->subject;
        $record->name = $request->name;
        $record->email = $request->email;
        $record->phone = $request->phone;
        $record->message = $request->cmsg;
        /********** subscription checked ********/
        if(isset($request->sub)) {
            $User = array(
                'name' => $request->name,
                'email'=> $request->email,
            );
            $User = (object)$User;
            App\Enquiry::insertSubscription($User);
        }
        /********** subscription checked ********/
        $record->Subscribed = ($request->sub=='Yes')? '1' : '0' ;
        $record->enquiry_type= "Contact Us";
        if(Auth::user()) {
            $record->user_id = Auth::user()->id;
        }
            $record->save();


                sendEmail('contactus_ack', array('name' => $request->name,
                    'to_email' => $request->email,
                    'phone' => $request->phone,
                    'subject' => $request->subject,
                    'message' => $request->cmsg,
                    'url' => BASE_PATH));
                sendEmail('contactus_admin', array('name' => $request->name,
                    'to_email' => $request->email,
                    'send_to' => 'admin',
                    'phone' => $request->phone,
                    'subject' => $request->subject,
                    'message' => $request->cmsg,
                    'url' => BASE_PATH));


//        toastr()->success('Thanks! Our Team will contact you soon');
        // toastr('Thanks! Our Team will contact you soon', 'success','Congratulations!');
        //flash('congratulations','our_team_will_contact_you_soon','success');
        return redirect(URL_SITE_CONTACTUS.'?contact=1')->with('status', 'Thank you for getting in touch! ');

        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    /********************* Affiliate Subscribe ****************/
    public function PostAffiliateSubscribe(Request $request)
    {
        $email  = $request->email;
        $record   = UserSubscription::where('email',$email)->first();
        if(!$record){
            $new_record   = new UserSubscription();
            $new_record->email  = $email;
            $new_record->first_name  = $request->name;
            $new_record->save();
            sendEmail('subscription_ack', array('email'=> $email, 'name'=> $request->name,
                'to_email' => $email,'url' => url('/') ));

            sendEmail('subscription_admin', array('email'=> $email, 'name'=> $request->name,
                'to_email' => $email,'send_to' => 'admin','url' => url('/') ));

            toastr()->success('Thank you for subscription we will get in touch with you!');
            return redirect()->back()->with('message', 'Thank you for subscription we will get in touch with you!');
        }
        else{
//            sendEmail('subscription_ack', array('email'=> $email, 'name'=> $request->name,
//                'to_email' => $email,'url' => url('/') ));
//            $record->status  = 1;
//            $record->save();
            toastr()->success('You are already subscribed, Thanks!');
            return redirect()->back()->with('message', 'You are already subscribed, Thanks!');
        }
    }
    /********************* Affiliate Subscribe ****************/

    /********************* Affiliate Marketing ****************/
    public function GetaffiliateMarketing()
    {
        $data['active_class']       = 'affiliate_marketing';
        $data['title']              = 'Affiliate Marketing';
        $rechaptcha_status    = getSetting('enable_rechaptcha','recaptcha_settings');
        $data['rechaptcha_status']  = $rechaptcha_status;

        try {
            $view_name = getTheme().'::site.affiliate_marketing';
            return view($view_name, $data);
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    public function PostaffiliateMarketing(Request $request)
    {
        //dd($request);
        if(checkSpam($request->name))  return abort(404);
        if(checkSpam($request->subject))  return abort(404);
        if(checkSpam($request->cmsg))  return abort(404);
        if ($request->name=='AnteseeHep')  return abort(404);
        if ($request->name=='AnteseeHep')  return abort(404);


        try {
            $rechaptcha_status    = getSetting('enable_rechaptcha','recaptcha_settings');

            if ( $rechaptcha_status  == 'yes') {

                $columns = array(
                    'f_name' => 'bail|required|max:250|',
                    'l_name' => 'bail|required|max:250|',
                    'email' => 'bail|required|email',
                    'contact'=>'required',
                    'c_name'=>'required',
                    'enquiry_type'=>'required',
                    'network'=>'required',
                    'comments'=>'required',
                    'g-recaptcha-response' => 'required|captcha'
                );
                $messsages = array(
                    'required' => 'The :attribute field is required.',
                    'g-recaptcha-response.required'=>'Please Select Captcha',
                    'g-recaptcha-response.captcha'=>'Please Select Captcha ',
                    'f_name.required'=>'First Name is required',
                    'l_name.required'=>'Last Name is required',
                    'email.required'=>'Email is required',
                    'contact.required'=>'Phone is required',
                    'c_name.required'=>'Business Website is required',
                    'enquiry_type.required'=>'How do you intend to promote our courses is required',
                    'network.required'=>'What is the current size of your database/network/reach is required',
                    'comments.required'=>'Additional information / comments is required',
                );

                $validator = Validator::make($request->all(), $columns, $messsages);
                /******* Form Validation *****/
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator->errors());
                }

                // $this->validate($request,$columns,$messsages);

            }
            else {

                $rules = [
                    'f_name' => 'bail|required|max:250|',
                    'l_name' => 'bail|required|max:250|',
                    'email' => 'bail|required|email',
                    'contact'=>'required',
                    'c_name'=>'required',
                    'enquiry_type'=>'required',
                    'network'=>'required',
                    'comments'=>'required'
                ];

                $messsages = array(
                    'required' => 'The :attribute field is required.',
                    'f_name.required'=>'First Name is required',
                    'l_name.required'=>'Last Name is required',
                    'email.required'=>'Email is required',
                    'contact.required'=>'Phone is required',
                    'c_name.required'=>'Business Website is required',
                    'enquiry_type.required'=>'How do you intend to promote our courses is required',
                    'network.required'=>'What is the current size of your database/network/reach is required',
                    'comments.required'=>'Additional information / comments is required',
                );

                $this->validate($request, $rules,$messsages);

            }



            $record = new App\GernalEnquiry();

            $record->title = "Affiliate Marketing";

            $jsonData   =   [];

            $jsonData["First Name"] = $request->f_name;
            $jsonData["Last Name"] = $request->l_name;
            $jsonData["Email Address"] = $request->email;
            $jsonData["Contact Number"] = $request->contact;
            $jsonData["Business Website"] = $request->c_name;
            $jsonData["How do you intend to promote our courses?"] = $request->enquiry_type;
            $jsonData["What is the current size of your database/network/reach?"] = $request->network;
            $jsonData["I have a marketing budget to promote our courses"] = $request->sub;
            $jsonData["Comments"] = $request->comments;


            $record->content_type= "Affiliate Marketing";
            $record->content_data= json_encode($jsonData);
            if(Auth::user()) {
                $record->user_id = Auth::user()->id;
            }
            $record->save();

            @sendEmail('affiliate_marketing_frm_ack', array('f_name' => $request->f_name,
                'to_email' => $request->email,
                'l_name' => $request->l_name,
                'email' => $request->email,
                'contact' => $request->contact,
                'c_name' => $request->c_name,
                'sub' => $request->sub,
                'enquiry_type' => $request->enquiry_type,
                'network' => $request->network,
                'comments' => $request->comments,
                'url' => url('/')));
            @sendEmail('affiliate_marketing_frm_admin', array('f_name' => $request->f_name,
                'send_to' => 'admin',
                'to_email' => $request->email,
                'l_name' => $request->l_name,
                'email' => $request->email,
                'contact' => $request->contact,
                'c_name' => $request->c_name,
                'sub' => $request->sub,
                'enquiry_type' => $request->enquiry_type,
                'network' => $request->network,
                'comments' => $request->comments,
                'url' => url('/')));

            toastr()->success('Thank you for submission,We will get in touch!');
            return redirect()->back()->with('message', 'Thank you for submission,We will get in touch!');

        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
    /********************* Affiliate Marketing ****************/



    /********************* Multiple course Redeem ****************/
    public function GetMultipleCourse()
    {
        $data['active_class']  = "multi_course";
        $data['title']  = "Course Voucher Redeem";
        $rechaptcha_status    = getSetting('enable_rechaptcha','recaptcha_settings');
        $data['rechaptcha_status']  = $rechaptcha_status;

        try {
            $view_name = getTheme().'::site.multi-course';
            return view($view_name, $data);
        } catch (Exception $e) {
            dd($e->getMessage());
        }

    }


    public function PostMultipleCourse(Request $request)
    {
        //dd($request);
        if(checkSpam($request->name))  return abort(404);
        if(checkSpam($request->subject))  return abort(404);
        if(checkSpam($request->cmsg))  return abort(404);
        if ($request->name=='AnteseeHep')  return abort(404);
        if ($request->name=='AnteseeHep')  return abort(404);


        try {
                $rechaptcha_status    = getSetting('enable_rechaptcha','recaptcha_settings');

            if ( $rechaptcha_status  == 'yes') {

                $columns = array(
                    'name' => 'bail|required|max:250|',
                    'email' => 'bail|required|email',
                    'phone'=>'required',
                    'vouchercode'=>'required',
                    'purchasedcourse'=>'required',
                    'g-recaptcha-response' => 'required|captcha'
                );
                $messsages = array(
                    'required' => 'The :attribute field is required.',
                    'g-recaptcha-response.required'=>'Please Select Captcha',
                    'g-recaptcha-response.captcha'=>'Please Select Captcha ',
                    'name.required'=>'Name is required',
                    'email.required'=>'Email is required',
                    'phone.required'=>'Phone is required',
                    'vouchercode.required'=>'Voucher Code is required',
                    'purchasedcourse.required'=>'Purchased Course Name is required'
                );

                $validator = Validator::make($request->all(), $columns, $messsages);
                /******* Form Validation *****/
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator->errors());
                }

                // $this->validate($request,$columns,$messsages);

            }
            else {

                $rules = [
                    'name' => 'bail|required|max:250|',
                    'email' => 'bail|required|email',
                    'phone'=>'required',
                    'vouchercode'=>'required',
                    'purchasedcourse'=>'required'
                ];

                $messsages = array(
                    'required' => 'The :attribute field is required.',
                    'name.required'=>'Name is required',
                    'email.required'=>'Email is required',
                    'phone.required'=>'Message is required',
                    'vouchercode.required'=>'Voucher Code is required',
                    'purchasedcourse.required'=>'Purchased Course Name is required'
                );

                $this->validate($request, $rules,$messsages);

            }



        $record = new App\GernalEnquiry();

        $record->title = "Course Voucher Redeem";

        $jsonData   =   [];

        $jsonData["Name"] = $request->name;
        $jsonData["Email Address"] = $request->email;
        $jsonData["Phone No"] = $request->phone;
        $jsonData["Voucher Code"] = $request->vouchercode;
        $jsonData["Purchased Course"] = $request->purchasedcourse;

            /************ Image Upload ***********/
            if (!empty($request->file('purchaseatt'))) {
                $PurchaseAttachment = $request->file('purchaseatt');
                $PurchaseAttachment_new_name = rand() . '.' . $PurchaseAttachment->getClientOriginalExtension();
//                $record->PurchaseAttachment = $PurchaseAttachment_new_name;
                $jsonData["Purchase Attachment"] = $PurchaseAttachment_new_name;

                if (env('FILESYSTEM_DRIVER') == 's3') {
                    $filePath = 'lms/PopupIMG/' . $PurchaseAttachment_new_name;
                    Storage::disk('s3')->put($filePath, file_get_contents($PurchaseAttachment));
                } else {
                    if (!empty($request->file('img'))) {
                        (file_exists('public/uploads/PopupIMG/' . $record->PurchaseAttachment)) ? unlink('public/uploads/PopupIMG/' . $record->PurchaseAttachment) : "";
                    }
                    $PurchaseAttachment->move('public/uploads/PopupIMG', $PurchaseAttachment_new_name);
                }
            }
            /************ Image Upload ***********/

        $record->content_type= "Course Voucher Redeem";
        $record->content_data= json_encode($jsonData);
        if(Auth::user()) {
            $record->user_id = Auth::user()->id;
        }
            $record->save();
//                exit(UPLOADS . 'lms/PopupIMG/' . $record->PurchaseAttachment);

                @sendEmail('multiple_course_ack', array('name' => $request->name,
                    'to_email' => $request->email,
                    'phone' => $request->phone,
                    'filepath' => UPLOADS . 'lms/PopupIMG/' . $record->PurchaseAttachment,
                    'vouchercode' => $request->vouchercode,
                    'purchasedcourse' => $request->purchasedcourse,
                    'url' => url('/')));
                @sendEmail('multiple_course_admin', array('name' => $request->name,
                    'to_email' => $request->email,
                    'send_to' => 'admin',
                    'phone' => $request->phone,
                    'filepath' => UPLOADS . 'lms/PopupIMG/' . $record->PurchaseAttachment,
                    'vouchercode' => $request->vouchercode,
                    'purchasedcourse' => $request->purchasedcourse,
                    'url' => url('/')));

        return redirect(URL_SITE_MULTICOURSE.'?contact=1')->with('status', 'Thank you for getting in touch! ');

        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
    /********************* Multiple course Redeem ****************/



    /********************* Redeem a Voucher ****************/
    public function GetRedeemVoucher()
    {
        $data['active_class']  = "multi_course";
        $data['title']  = "Redeem a Voucher";
        $rechaptcha_status    = getSetting('enable_rechaptcha','recaptcha_settings');
        $data['rechaptcha_status']  = $rechaptcha_status;

        try {
            $view_name = getTheme().'::site.redeem-voucher';
            return view($view_name, $data);
        } catch (Exception $e) {
            dd($e->getMessage());
        }

    }


    public function PostRedeemVoucher(Request $request)
    {
        //dd($request);
        if(checkSpam($request->name))  return abort(404);
        if(checkSpam($request->subject))  return abort(404);
        if(checkSpam($request->cmsg))  return abort(404);
        if ($request->name=='AnteseeHep')  return abort(404);
        if ($request->name=='AnteseeHep')  return abort(404);


        try {
                $rechaptcha_status    = getSetting('enable_rechaptcha','recaptcha_settings');

            if ( $rechaptcha_status  == 'yes') {

                $columns = array(
                    'name' => 'bail|required|max:250|',
                    'email' => 'bail|required|email',
                    'phone'=>'required',
                    'vouchercode'=>'required',
                    'purchasedcourse'=>'required',
                    'purchasefrom'=>'required',
                    'g-recaptcha-response' => 'required|captcha'
                );
                $messsages = array(
                    'required' => 'The :attribute field is required.',
                    'g-recaptcha-response.required'=>'Please Select Captcha',
                    'g-recaptcha-response.captcha'=>'Please Select Captcha ',
                    'name.required'=>'Name is required',
                    'email.required'=>'Email is required',
                    'phone.required'=>'Phone is required',
                    'vouchercode.required'=>'Voucher Code is required',
                    'purchasedcourse.required'=>'Purchased Course Name is required',
                    'purchasefrom.required'=>'Purchase From is required'
                );

                $validator = Validator::make($request->all(), $columns, $messsages);
                /******* Form Validation *****/
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator->errors());
                }

                // $this->validate($request,$columns,$messsages);

            }
            else {

                $rules = [
                    'name' => 'bail|required|max:250|',
                    'email' => 'bail|required|email',
                    'phone'=>'required',
                    'vouchercode'=>'required',
                    'purchasedcourse'=>'required',
                    'purchasefrom'=>'required'
                ];

                $messsages = array(
                    'required' => 'The :attribute field is required.',
                    'name.required'=>'Name is required',
                    'email.required'=>'Email is required',
                    'phone.required'=>'Message is required',
                    'vouchercode.required'=>'Voucher Code is required',
                    'purchasedcourse.required'=>'Purchased Course Name is required',
                    'purchasefrom.required'=>'Purchase From is required'
                );

                $this->validate($request, $rules,$messsages);

            }



        $record = new App\GernalEnquiry();

        $record->title = "Redeem a Voucher";

        $jsonData   =   [];

        $jsonData["Name"] = $request->name;
        $jsonData["Email Address"] = $request->email;
        $jsonData["Phone No"] = $request->phone;
        $jsonData["Voucher Code"] = $request->vouchercode;
        $jsonData["Purchased Course"] = $request->purchasedcourse;
        $jsonData["Purchase From"] = $request->purchasefrom;

        $record->content_type= "Redeem a Voucher";
        $record->content_data= json_encode($jsonData);
        if(Auth::user()) {
            $record->user_id = Auth::user()->id;
        }
            $record->save();
//                exit(UPLOADS . 'lms/PopupIMG/' . $record->PurchaseAttachment);

                @sendEmail('redeem_voucher_ack', array('name' => $request->name,
                    'to_email' => $request->email,
                    'phone' => $request->phone,
                    'purchasefrom' => $request->purchasefrom,
                    'vouchercode' => $request->vouchercode,
                    'purchasedcourse' => $request->purchasedcourse,
                    'url' => url('/')));
                @sendEmail('redeem_voucher_admin', array('name' => $request->name,
                    'to_email' => $request->email,
                    'send_to' => 'admin',
                    'phone' => $request->phone,
                    'purchasefrom' => $request->purchasefrom,
                    'vouchercode' => $request->vouchercode,
                    'purchasedcourse' => $request->purchasedcourse,
                    'url' => url('/')));

        return redirect(URL_SITE_REDEEMVOUCHER.'?contact=1')->with('status', 'Thank you for getting in touch! ');

        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
    /********************* Redeem a Voucher ****************/


    /************* freelance certificate  ****************/
    public function FreelanceCertificateFee($cid = 0)
    {

        $data['active_class']       = 'faqs';
        $data['title']              = 'Freelance Certificate Fee';

        if(isset($cid)){
            $user = Auth::user();

            $records = \App\LmsSeries::where('id',$cid)
                ->where('status',1)
                ->first();
            if(isset($records)){
                $data['cid']=$cid;
                $data['course_title']=$records->title;
                if($records->is_paid==0)
                    $data['course_type']='free';
                else
                    $data['course_type']='paid';

                $data['course_id']=$cid;
                $data['certificate']="";

                $view_name = getTheme().'::site.freelance_certificate_fee';
                return view($view_name, $data);
            }else{
                $view_name = getTheme().'::site.freelance_certificate_fee';
                return view($view_name, $data);
            }

        }else{ return abort(404);
        }
    }

    public function FreelancePayCertificateFee(Request $request)
    {
        //dd($request);
        if(checkSpam($request->name))  return abort(404);
        if(checkSpam($request->subject))  return abort(404);
        if(checkSpam($request->cmsg))  return abort(404);
        if ($request->name=='AnteseeHep')  return abort(404);
        if ($request->name=='AnteseeHep')  return abort(404);


        try {

            $rules = [
                'user_name' => 'bail|required|max:250|',
                'user_email' => 'bail|required|email',
                'user_phone'=>'required',
                'course_title'=>'required',
            ];

            $messsages = array(
                'required' => 'The :attribute field is required.',
                'user_name.required'=>'User Name is required',
                'user_email.required'=>'Email is required',
                'user_phone.required'=>'Contact Number is required',
                'course_title.required'=>'Course Title is required',
            );

            $this->validate($request, $rules,$messsages);



            $record = new App\GernalEnquiry();

            $record->title = "Freelance Certificate";

            $jsonData   =   [];
            $jsonData["User Name"] = $request->user_name;
            $jsonData["User Email"] = $request->user_email;
            $jsonData["User Phone"] = $request->user_phone;
            $jsonData["Course Title"] = $request->course_title;

            $record->content_type= "Freelance Certificate";
            $record->content_data= json_encode($jsonData);
            if(Auth::user()) {
                $record->user_id = Auth::user()->id;
            }
            $record->save();

            @sendEmail('freelance_certificate_ack', array('user_name' => $request->user_name,
                'to_email' => $request->user_email,
                'user_phone' => $request->user_phone,
                'user_email' => $request->user_email,
                'course_title' => $request->course_title,
                'url' => url('/')));

            @sendEmail('programme_ack', array('user_name' => $request->user_name,
                'send_to' => 'admin',
                'to_email' => $request->user_email,
                'user_phone' => $request->user_phone,
                'user_email' => $request->user_email,
                'course_title' => $request->course_title,
                'url' => url('/')));

            @sendEmail('freelance_certificate_admin', array('user_name' => $request->user_name,
                'send_to' => 'admin',
                'to_email' => $request->user_email,
                'user_phone' => $request->user_phone,
                'user_email' => $request->user_email,
                'course_title' => $request->course_title,
                'url' => url('/')));

            toastr()->success('Thank you for submission,We will get in touch!');
            return redirect()->back()->with('message', 'Thank you for submission,We will get in touch!');

        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
    /************* freelance certificate  ****************/


    public function getSeriesContents(Request $request)
    {
        $lms_series   = LmsSeries::find($request->lms_series_id);
        $contents     = $lms_series->viewContents();

        return json_encode(array('contents'=>$contents));

    }

    public function GetPreviewIframe(Request $request)
    {
        $data['series'] = App\LmsContent::where("id", $request->item_id)->first();
        return response(array(
            'status' => "success",
            'data' => $data,
            'message' => "Preview data exist"
        ),200,[]);
    }
    public function searchBlogs(Request $request)
    {
        $data['active_class'] = 'blog';
        $cartCollection = \Cart::getContent();
        $cartTotalQuantity = \Cart::getTotalQuantity();
        $total = \Cart::getTotal();
        $data['total_quantity']     = $cartTotalQuantity;
        $data['total_amount']     = $total;
        $data['total_items']     = $cartCollection->count();;

        $data['cart_contents']     = $cartCollection;
        $data['title']     = 'Search Blogs';
        $data['category']     = false;
        $keyword=$request->keyword;
        $data['keyword']     = $keyword;

//        $data['posts']     = App\Post::where('title','like','%'.$keyword.'%')
//            ->orWhere('description', 'like', '%' . $keyword . '%')->Orderby('id', 'desc')->get();
        $data['categories']         	=App\PostCategory::all();
        $data['posts']     = App\Post::where('title','like','%'.$keyword.'%')
            ->orWhere('description', 'like','%'.$keyword.'%')
            ->Orderby('id', 'desc')
            ->get();
        $data['latest_posts']     = App\Post::where('status','Active')->Orderby('id', 'desc')->limit(5)->get();

//echo "count>>".count($data['posts']);
//dd($data);

        $view_name = getTheme().'::site.blog-list';
        return view($view_name, $data);




    }



    public function getBlogList()
    {
        $data['active_class'] = 'blog';
        $cartCollection = \Cart::getContent();
        $cartTotalQuantity = \Cart::getTotalQuantity();
        $total = \Cart::getTotal();
        $data['total_quantity']     = $cartTotalQuantity;
        $data['total_amount']     = $total;
        $data['total_items']     = $cartCollection->count();;

        $data['cart_contents']     = $cartCollection;
        $data['title']     = 'Blogs';
        $data['category']     = false;
        $data['posts']     = App\Post::where('status','Active')->Orderby('id', 'asc')->limit(3)->get();
        $data['latest_posts']     = App\Post::where('status','Active')->Orderby('id', 'desc')->limit(5)->get();

        $data['categories']         	=App\PostCategory::all();
        $view_name = getTheme().'::site.blog-list';
        return view($view_name, $data);
    }

    public function getBlogAJAX($lim = 1)
    {

        $html = "";
        $limitChk   = $lim*3;
        $posts     = App\Post::where('status','Active')->Orderby('id', 'asc')->limit($limitChk)->get();
        $data['success']     = "success";
        foreach($posts as $post) {
            $html   .=   '<div class="col-sm-6 col-md-6 col-lg-4">';
            $html   .=   '<article class="post blog_postColmn mb-30">';
            $html   .=   '<div class="post-thumb">';
            if($post->image) {
                $html   .=   '<a href="/blog/'.$post->slug.'"><img src="'.getBlogImgPath($post->image).'" alt="'.$post->title.'" class="img-responsive"></a>';
            }  else {
                $html   .=   '<img src="https://picsum.photos/370/245/?random" class="img-responsive" alt="'.$post->title.'">';
            }
            $html   .=   '</div>';
            $html   .=   '<div class="post-description">';
            $html   .=   '<a href="/blog/'.$post->slug.'"><h3 class="post-title">';
            if(strlen($post->title)>50) {
                $html   .=   substr($post->title,0,50).'...</h3></a>';
            } else {
                $html   .=   $post->title;
            }
            $html   .=   '</h3></a>';
            $html   .=   '    <div class="post-meta">';
            $html   .=   '        <span>'.date('d/m/Y',strtotime($post->created_at)).'</span> <a href="javascript:void(0);">'.$post->category->category.'</a>';
            $html   .=   '    </div>';
            $html   .=   '    <div class="infodec">'.strip_tags($post->description).'</div>';
            $html   .=   '</div>';
            $html   .=   '<div class="post-meta bottom__meta">';
            $html   .=   '<a href="/blog/'.$post->slug.'" class="">Read More</a>';
            $html   .=   '</div>';
            $html   .=   '</article>';
            $html   .=   '</div>';

        }
        if($limitChk > $posts->count()) {
            $html   .=   '<div class="col-sm-12 col-md-12 col-lg-12 data-end-msg">More articles coming soon. Stay Tune.</div>';
            $data['removeload']     = "yes";
        }

        $data['html']     = $html;


        return \Illuminate\Support\Facades\Response::json($data);
    }

    public function getBlogCategoryList($slug)
    {
        $data['active_class'] = 'blog';
        $cartCollection = \Cart::getContent();
        $cartTotalQuantity = \Cart::getTotalQuantity();
        $total = \Cart::getTotal();
        $data['total_quantity']     = $cartTotalQuantity;
        $data['total_amount']     = $total;
        $data['total_items']     = $cartCollection->count();;

        $data['cart_contents']     = $cartCollection;

        $record = App\PostCategory::getRecordWithSlug($slug);
        $data['latest_posts']     = App\Post::where('status','Active')->Orderby('id', 'desc')->limit(5)->get();
        $data['keyword']     = $record->category;
        $data['title']     = $record->category;
        $data['category']     = $record;
        $data['posts']     = App\Post::where('category_id', $record->id)->get();
        $data['categories']         	=App\PostCategory::all();
        $view_name = getTheme().'::site.blog-list';
        return view($view_name, $data);




    }

    public function viewBlogArticle($slug)
    {
        $data['active_class'] = 'blog';
        $cartCollection = \Cart::getContent();
        $cartTotalQuantity = \Cart::getTotalQuantity();
        $total = \Cart::getTotal();
        $data['total_quantity']     = $cartTotalQuantity;
        $data['total_amount']     = $total;
        $data['total_items']     = $cartCollection->count();;

        $data['cart_contents']     = $cartCollection;

        $data['latest_posts']     = App\Post::where('status','Active')->Orderby('id', 'desc')->limit(5)->get();


        $record = App\Post::getRecordWithSlug($slug);

        $data['categories']         	=App\PostCategory::all();
        $data['blog_category']         	=App\PostCategory::where('id', $record->category_id)->first();
        $data['record']         	= $record;
        $data['title']       		= $record->title;
        $data['active_class']       = 'posts';
        $data['settings']           = json_encode($record);
        $data['layout']              = getLayout();
        // dd($data);
        $view_name = getTheme().'::site.blog-article';
        return view($view_name, $data);






    }


    public function page($slug)
    {

        if (!$slug)
            return redirect( PREFIX );

        $page = Page::where('slug', $slug)->first();
        if (!$page)
            return redirect( PREFIX );

        $data['page']   = $page;
        $data['title']  = $page->name;
        $data['active_class'] = $slug;

        // return view('site.dynamic-view', $data);

        $view_name = getTheme().'::site.page';
        return view($view_name, $data);

    }

    public function faqs()
    {
        $data['active_class']       = 'faqs';
        $data['title']              = getPhrase('FAQs');

        $categories = App\FaqCategory::where('status',1)->get();
        $data['categories'] = $categories;

        // return view('site.faqs',$data);
        $view_name = getTheme().'::site.faqs';
        return view($view_name, $data);
    }

    public function sendEnquiry(Request $request)
    {
//         $flag=false;

//         if(checkSpam($request->first_name)){   $flag=true; }
//         if(checkSpam($request->last_name)) {   $flag=true; }
//         if(checkSpam($request->email)) {   $flag=true; }
//         if(checkSpam($request->msg)) {   $flag=true; }
       

// if($flag){
//     return response()->json(['success'=>false,'title'=>'Spam enquiry!', 'message'=>'Invalid Message']);

// }



            $rules = array(
                'first_name' => 'bail|required|max:250|',
                'email' => 'bail|required|email', 
                'msg'=>'required|max:250'
            );
            $customMessages = array(
                'first_name.required'=>'Name is required',
                'email.required'=>'Email is required', 
                'msg.required'=>'Message is required', 
            );

            $validator = Validator::make($request->all(), $rules, $customMessages);
        /******* Form Validation *****/
        if ($validator->fails()) {
            //return redirect()->back()->withErrors($validator->errors());
            return $validator->errors();
        }
 


        try {

        $record = new App\Enquiry();

        $record->course_id = $request->course_id;
        $record->first_name = $request->first_name;
        $record->last_name = $request->last_name;
        $name = $request->first_name;
        $record->name = $name;
        $record->email = $request->email;
//        $record->phone = $request->phone;
        $record->message = $request->msg;
        //$record->country = $request->country;
        $record->course_title = $request->course_title;
        $record->course_slug= $request->course_slug;
//        $record->Subscribed= $request->sub;
        $record->Subscribed = ($request->sub=='Yes')? '1' : '0' ;
        $record->enquiry_type= $request->enquiry_type;
        /********** subscription checked ********/
        if(isset($request->sub)) {
            $User = array(
                'name' => $name,
                'email'=> $request->email,
            );
            $User = (object)$User;
            App\Enquiry::insertSubscription($User);
        }
        /********** subscription checked ********/
        if(Auth::user()) {
            $record->user_id = Auth::user()->id;
        }
        $record->save();
        //DB::commit();
//Imran commented for stop spamming
         if($request->course_slug!='') {


                sendEmail('courseenquiry_admin', array('name' => $name,
                    'send_to' => 'admin',
                    'to_email' => $request->email,
                    'phone' => $request->phone,
                    'slug' => $request->course_slug,
                    'subject' => $request->course_title,
                    'message' => $request->msg, 'url' => BASE_PATH));
                sendEmail('courseenquiry_ack', array('name' => $name,
                    'to_email' => $request->email,
                    'phone' => $request->phone,
                    'slug' => $request->course_slug,
                    'subject' => $request->course_title,
                    'message' => $request->msg, 'url' => BASE_PATH));

        }else{
            sendEmail('generalenquiry_admin', array('name' => $name,
                'send_to' => 'admin',
                'to_email' => $request->email,
                'phone' => $request->phone,
                'enquiry_type' => $request->enquiry_type,
                'message' => $request->msg, 'url' => BASE_PATH));
            sendEmail('generalenquiry_ack', array('name' => $name,
                'to_email' => $request->email,
                'phone' => $request->phone,
                'enquiry_type' => $request->enquiry_type,
                'message' => $request->msg, 'url' => BASE_PATH));

        }

        //toastr()->success('Thank you for getting in touch! ');

        return response()->json(['success'=>true,'title'=>'Congratulations!', 'message'=>'Thanks! Our team will contact you soon']);
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    public static function AllCountries() {
        return App\Country::select('name','nicename')->get();
    }


    public function handleSuperAdminUserLogin(Request $request)
    {


        try{
            setcookie("adminid", Auth::user()->id);
            $user = App\User::findOrFail($request->slug);

            //

            if(!$user)
            {
                return redirect(PREFIX);
            }else
            {

                // if($this->checkIsUserAvailable($user)) {
                Auth::logout();
                //print_r(auth()->user());
                // dd($user);
                Auth::loginUsingId($request->slug);
                //Auth::login($this->dbuser, true);
                // flash('Success...!', 'log_in_success', 'success');
                \Cart::session($user);
                session()->put("dash_layout",'student.dashboard');
                return redirect(URL_STUDENT_LMS_SERIES);
            }
        }
        catch (Exception $ex)
        {
            return redirect(PREFIX);
        }
    }

    public function handleSuperAdminBackLogin(Request $request)
    {


        try{
            \Cookie::queue(\Cookie::forget('adminid'));
            $user = App\User::findOrFail($request->slug);

            //

            if(!$user){

                return redirect(PREFIX);

            }else{

                Auth::logout();
                Auth::loginUsingId($request->slug);
                \Cart::session($user);
                session()->put("dash_layout",'admin.dashboard');
                return redirect(URL_DASHBOARD);
            }
        }
        catch (Exception $ex)
        {
            return redirect(PREFIX);
        }
    }

    public function studentIdCard()
    {
        $user="";
        $userflag=false;
        if (Auth::check()) {
            $user = Auth::user();
            $userflag=true;
        }

        $data['userflag']=$userflag;
        $data['user']=$user;

        $data['active_class']       = 'faqs';
        $data['title']              = 'Student ID Card';
        $view_name = getTheme().'::site.student_id_card';
        return view($view_name, $data);
    }

    public function setsess(Request $request) {
        return $request->session()->put('test', "something");
    }

    public function getsess(Request $request) {
        if($request->session()->has('test'))
            echo $request->session()->get('Coupon_code');
    }

    public function certificateRequest()
    {

        $data['active_class']       = 'faqs';
        $data['title']              = 'Certificate Request';




        //$data['cid']=$cid;
        //$data['course_title']=$records->title;
        $data['course_type']='reed';

        //$data['course_id']=$cid;
        $data['certificate']=false;
        //dd($data);
        $view_name = getTheme().'::site.certificate_request_fee';
        return view($view_name, $data);



    }

    public function eCertificateRequest()
    {

        $data['active_class']       = 'home';
        $data['title']              = 'E-Certificate Request';




        //$data['cid']=$cid;
        //$data['course_title']=$records->title;
        $data['course_type']='ecert';

        //$data['course_id']=$cid;
        $data['certificate']=false;
        $rechaptcha_status    = getSetting('enable_rechaptcha','recaptcha_settings');
        $data['rechaptcha_status']  = $rechaptcha_status;
        //dd($data);
        $view_name = getTheme().'::site.ecertificate_request_fee';
        return view($view_name, $data);



    }

    public function storeECertificateFee(Request $request)
    {
//dd($request);
        $data['active_class']       = 'home';
        $data['title']              = 'E Certificate Fee';
        /******* Form Validation *****/
        // $rules = [
        //     'first_name' => 'required',
        //     'last_name' => 'required',
        //     'user_email' => 'required|email',
        //     'user_phone' => 'required',
            
        // ];

        $columns = array(
            'first_name' => 'bail|required|max:250|',
            'last_name' => 'bail|required|max:250|',
             'user_email' => 'bail|required|email',
             'user_phone'=>'bail|required|max:250|',
             'course_title'=>'required|max:550' 
         );
         $messsages = array( 
            'first_name.required'=>'First Name is required',
            'last_name.required'=>'Last Name is required',
            'user_email.required'=>'Email is required',
            'user_phone.required'=>'user phone is required',
            'course_title.required'=>'course title is required' 
        );
        $rechaptcha_status    = getSetting('enable_rechaptcha','recaptcha_settings');
        // $rechaptcha_status    = 'yes';
 
         if ( $rechaptcha_status  == 'yes') {
            $columns['g-recaptcha-response'] = 'required|captcha';
            $messsages['g-recaptcha-response.required'] = 'Please Select required Captcha';
            $messsages['g-recaptcha-response.captcha'] = 'Please Select Captcha';
         }
             
 

       // $this->validate($request, $rules,$customMessages);

        $validator = Validator::make($request->all(), $columns, $messsages);
        /******* Form Validation *****/
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());

        }

        try {
            $trans_id='';
            $status='yes';
            
            // $newcertificate=false;
            // if($request->course_type=='ecert'){
            //     $newcertificate=true;
            // }else {
            //     $certificate = App\Certificate::where('user_id', '=', $request->user_id)
            //         ->where('course_id', '=', $request->course_id)
            //         ->first();
            //     if ($certificate->count() < 1) {
            //         $newcertificate = true;
            //     }
            // }
            
            $full_name=$request->first_name.' '.$request->last_name;
                /********* Insert Record Into DB ***********/
                $certificate = new App\Certificate();
                $certificate->user_id = $request->user_id;
                $certificate->user_name = $full_name;
                $certificate->user_email = $request->user_email;
                $certificate->user_phone = $request->user_phone;
                $certificate->course_id = $request->course_id;
                $certificate->course_type = $request->course_type;

                if($request->course_type=='ecert'){
                    $certificate->reed_course_name = $request->course_title;
                }

                $certificate->status = $status;
                $certificate->save();
            
                sendEmail('e_certificate_ack', array('name' =>$full_name,
                            'email' => $request->user_email,
                            'to_email' => $request->user_email,
                            'course' => $request->course_title,
                            'fee' => 0,
                            'contact' => $request->user_phone,
                            'url' => url('/')));
                        sendEmail('e_certificate_admin', array('name' => $full_name,
                            'send_to' => 'admin',
                            'email' => $request->user_email,
                            'to_email' => $request->user_email,
                            'course' => $request->course_title,
                            'fee' => 0,
                            'contact' => $request->user_phone,
                            'url' => url('/')));

                return redirect('/ecertificate_request?contact=1')->with('status', 'Thank You for Your E-Certficiate Request');
        } catch (Exception $e) {
            dd($e->getMessage());
        }


    }



    public function thankYou(Request $request)
    {
        $data['active_class']       = 'faqs';
        $data['title']              = 'Thank you';
        $request->session()->forget('Coupon_code');
        $request->session()->forget('Coupon_value');
        $view_name = getTheme().'::site.thankyou';
        return view($view_name, $data);
    }

    public function UnSubscribe()
    {
        $data['active_class'] = 'unsubscribe';
        $data['title'] = 'Un-Subscribe';
        if(isset($_REQUEST["email"]) && $_REQUEST["email"] != "") {
            if($subscriprion = UserSubscription::where("email", base64_decode(strtr($_REQUEST["email"], '._-', '+/=')))->first()) {
                $subscriprion->status   =   0;
                $subscriprion->save();
                $data['msg'] = 'You are unsubscribe successfully!';
            } else {
                $data['msg'] = 'You are not subscribed yet!';
            }
        } else {
            return redirect('/');
        }
        $view_name = getTheme().'::site.unsubscribe';
        return view($view_name, $data);
    }

    public function StudentThankYou(Request $request)
    {
        $data['active_class']       = 'faqs';
        $data['title']              = 'Thank you';
        $request->session()->forget('Coupon_code');
        $request->session()->forget('Coupon_value');
        $view_name = getTheme().'::site.StudentThankYou';
        return view($view_name, $data);
    }

    public function corporateTraining()
    {
        $data['active_class']       = 'faqs';
        $data['title']              = 'corporate Training';
        $rechaptcha_status    = getSetting('enable_rechaptcha','recaptcha_settings');
        $data['rechaptcha_status']  = $rechaptcha_status;
//        $data['rechaptcha_status']  = "yes";
        $view_name = getTheme().'::site.corporate_training';
        return view($view_name, $data);
    }

    public function instructorForm()
    {
        $data['active_class']       = 'faqs';
        $data['title']              = 'Instructor Application Form';
        $rechaptcha_status    = getSetting('enable_rechaptcha','recaptcha_settings');
        $data['rechaptcha_status']  = $rechaptcha_status;
        $user="";
        $userflag=false;
        if (Auth::check()) {
            $user = Auth::user();
            $userflag=true;
        }

        $data['userflag']=$userflag;
        $data['user']=$user;
        $view_name = getTheme().'::site.instructor-form';
        return view($view_name, $data);
    }

    public function testimonialrequest()
    {
        $data['active_class']       = 'faqs';
        $data['title']              = 'Testimonial Request';
        $view_name = getTheme().'::site.testimonial_request';
        return view($view_name, $data);
    }

    public function giftCourse()
    {
        $data['active_class']       = 'faqs';
        $data['title']              = 'Gift course';
        $rechaptcha_status    = getSetting('enable_rechaptcha','recaptcha_settings');
        $data['rechaptcha_status']  = $rechaptcha_status;


        $view_name = getTheme().'::site.gift_course';
        return view($view_name, $data);
    }

    public function giftCourseID($slug)
    {
        $data['active_class']       = 'faqs';
        $data['title']              = 'Gift course';
        $rechaptcha_status    = getSetting('enable_rechaptcha','recaptcha_settings');
        $data['rechaptcha_status']  = $rechaptcha_status;


        $data['slug']  = $slug;
        $data['course']  = App\LmsSeries::where("slug", $slug)->first();
        $view_name = getTheme().'::site.gift_course';
        return view($view_name, $data);
    }

    public function SavegiftCourse(Request $request)
    {
        $data['active_class']       = 'faqs';
        $data['title']              = 'Gift Course';


        /********** Form Functionality ***********/

        /** Validation Area **/
        $columns = array(
            'giftfname' => 'bail|required|max:250|',
            'giftemail' => 'bail|required|email',
            'giftdate'=>'bail|required|max:250|',
            'giftmessage'=>'required'
        );
        $messsages = array(
            'giftfname.required'=>'Please add text in name field, Thanks!',
            'giftemail.required'=>'Please add email in email field, Thanks!',
            'giftdate.required'=>'Please add date in date field, Thanks!',
            'giftmessage.required'=>'Please add text in message field, Thanks!',
        );

        $this->validate($request,$columns,$messsages);
        /** Validation Area **/

        /*** Check if user exists ***/
        $ReceiverData = App\User::where('email', $request->giftemail)->first();
        if(!$ReceiverData) {
            $message = getPhrase("Please Check Your Details, This user is not exist, Thanks");
            toastr()->error($message);
            return redirect()->back();
        }
        /*** Check if user exists ***/

        /*** Check if user gift himself ***/
        if($request->giftemail == \Auth::user()->email) {
            $message = getPhrase("You are not allowed to gift your self, Thanks!!");
            toastr()->error($message);
            return redirect()->back();
        }
        /*** Check if user gift himself ***/

        /*** Check if already gifted ***/
        if(App\GiftCourse::where('course_id', $request->cid)->where('giftemail', $request->giftemail)->where('user_id_to', $ReceiverData->id)->where('user_id_from', \Auth::user()->id)->first()) {
            $message = getPhrase("You have already gift '" . $request->gname . "' to " . $request->giftemail . ", Thanks");
            toastr()->error($message);
            return redirect()->back();
        }
        /*** Check if already gifted ***/


        /*** Course not purchased yet ***/
//        if(!App\UserCourses::where('item_id', $request->cid)->where('user_id', \Auth::user()->id)->first()) {
        if(!$request->thankyou) {

            /*** Set Cart ***/
            $id = $request->cid;
            $name = $request->gname;
            $price = $request->gcost;
            $qty = 1;
            $slug = $request->gslug;
            $image = $request->gimage;
            $customAttributes = array(
                'from_gift' => 1,
                'image' => $image,
                'currency' => session('currency_short'),
                'symbol' => session('currency_symbol'),
                'slug' => $slug,
            );


            $data['item_info'] = array("id" => $id, "name" => $name, "price" => $price, "qty" => $qty, "custom" => $customAttributes);
            /*** Set Cart ***/

            /********* Show Checkout ***********/
            $user="";
            $userflag=false;
            if (Auth::check()) {
                $user = Auth::user();
                $userflag=true;
            }

            $data['userflag']=$userflag;
            $data['user']=$user;
            //dd($user);
            $data['active_class'] = 'lms';
            $cartCollection = \Cart::getContent();
            $cartTotalQuantity = \Cart::getTotalQuantity();
            $total = \Cart::getTotal();
            $countries = App\Country::all();
            $data['countries']     = $countries;
            $data['total_quantity']     = $cartTotalQuantity;
            $data['total_amount']     = $total;
            $data['total_items']     = $cartCollection->count();

            /******* Coupon Code ********/
            //$request->session()->flush();
            if($request->session()->has('Coupon_code')) {
                $data['CouponData'] = App\Couponcode::where("coupon_code", $request->session()->get('Coupon_code'))
                    ->where('valid_from','<=',date('Y-m-d'))
                    ->where('valid_to', '>=', date('Y-m-d'))
                    ->where('status','=','Active')
                    ->first();
            }
            /******* Coupon Code ********/

            $data['cart_contents']     = $cartCollection;

            if (Auth::check()) {
                $view_name = getTheme().'::site.gift-checkout-detail';
                return view($view_name, $data);
            }else{
                return redirect('/cart')->withErrors(['You can not checkout with empty cart']);
            }
            /********* Show Checkout ***********/
        }
        /*** Course not purchased yet ***/



        /*** Insert Gifts Table ***/
        $record = new App\GiftCourse();

        $record->giftfname = $request->giftfname;
        $record->giftemail = $request->giftemail;
        $record->giftdate = date("Y-m-d", strtotime($request->giftdate));
        $record->giftmessage = $request->giftmessage;
        $record->course_id = $request->cid;
        $record->user_id_to = $ReceiverData->id;
        $record->user_id_from = \Auth::user()->id;
        $record->status = "yes";

        if($record->save()) {
            /*** Update user course ***/
//            echo $request->cid; echo \Auth::user()->id; exit();
            $ucrecord = App\UserCourses::where("item_id", $request->cid)->where("user_id", \Auth::user()->id)->latest()->first();

            if($ucrecord){
                $ucrecord->user_id = $ReceiverData->id;
                $ucrecord->save();
            } else {
                return redirect("/")->withErrors(['While purchanse there is some issue, That is why gift process failed!']);
            }
            /*** Update user course ***/

            /*** Send Emails ***/
            sendEmail('giftcourse_ack', array('email'=> $request->giftemail, 'name'=> $request->giftfname,
                'to_email' => $request->giftemail, 'course' => $request->gname,'url' => BASE_PATH ));

            sendEmail('giftcourse_admin', array('email'=> \Auth::user()->email, 'name'=> $request->giftfname,
                'to_email' => \Auth::user()->email,'send_to' => 'admin', 'course' => $request->gname,'url' => BASE_PATH ));
            /*** Send Emails ***/
        }
        /*** Insert Gifts Table ***/


        toastr()->success('Thanks! you are successfully gift this course!');
        return redirect("/gift-course/$request->gslug")->with('status', 'Thanks! you are successfully gift this course! ');
        /********** Form Functionality ***********/
    }

    public function PackageCheckout() {

        $data['active_class']       = 'promo';
        $data['title']              = 'Promotion Courses';

        /********* Show Checkout ***********/
        $user="";
        $userflag=false;
        if (Auth::check()) {
            $user = Auth::user();
            $userflag=true;
        }

        /*********** Update LP course Price *************/
        if(json_decode(GetActiveOfferData(4)->content_area, true)["UpdateCartPrice"] == "yes") {
            /*--- get offer data ---*/
            $offerRes = App\Offers::find(json_decode(GetActiveOfferData(4)->content_area, true)["offerID"]);
            /*--- get offer data ---*/

            $items = \Cart::getContent();
            foreach ($items as $item) {
                if (in_array($item->id, explode(",", str_replace('"', '', $offerRes->offer_keys)))) {
                    if ($offerRes->offer_Type == "fixprice") {
                        \Cart::update($item->id, array(
                            'price' => $offerRes->price
                        ));
                    }
                }
            }
        }
        /*********** Update LP course Price *************/

        /********* Add Cart **********/
        if(json_decode(GetActiveOfferData(4)->content_area, true)["activefreecourse"] == "yes") {
            \Cart::remove(json_decode(GetActiveOfferData(4)->content_area, true)["FreeCourseID"]);
            $lmsitem = LmsSeries::find(json_decode(GetActiveOfferData(4)->content_area, true)["FreeCourseID"]); $lmsitem->is_paid = 1; $lmsitem->save();
            if(!\Cart::get(json_decode(GetActiveOfferData(4)->content_area, true)["FreeCourseID"])) {
                \Cart::add(json_decode(GetActiveOfferData(4)->content_area, true)["FreeCourseID"], "FREE Special Effect Make up - Beginners", 0.00, 1, array('image' => "700-image.jpg", 'slug' => "free-special-effect-make-up-beginners"));
            }
        }
        /********* Add Cart **********/

        $data['userflag']=$userflag;
        $data['user']=$user;
        //dd($user);
        $data['active_class'] = 'lms';
        $cartCollection = \Cart::getContent();
        $cartTotalQuantity = \Cart::getTotalQuantity();
        $total = \Cart::getTotal();
        $countries = App\Country::all();
        $data['countries']     = $countries;
        $data['total_quantity']     = $cartTotalQuantity;
        $data['total_amount']     = $total;
        $data['total_items']     = $cartCollection->count();

        /******* Coupon Code ********/

        $view_name = getTheme().'::site.promo-checkout-detail';
        return view($view_name, $data);
    }

    public function AJAXCheckUserEmail(Request $request)
    {
        $respon = "";
        $UserData  = App\User::where("email", $request->emails)->first();
        if($UserData) {
            $respon = "success";
        }

        $data["status"] = $respon;
        $data["userdata"] = $UserData;

        return \Illuminate\Support\Facades\Response::json($data);
    }

    public function downloadPhoto($slug)
    {
        $respon = "";
        $record  = App\StudentIdCard::where("id", $slug)->first();
        $filename_from_url = parse_url(getPhotoPath($record->img,'thumb'));
        $ext = pathinfo($filename_from_url['path'], PATHINFO_EXTENSION);


        $filePath=CARD_PHOTO_PATH.$record->img;


        if(true){
             //$filePath = $fp;

            if(file_exists($filePath)) {
                $fileName = basename($filePath);
                $fileSize = filesize($filePath);

                // Output headers.
                header("Cache-Control: private");
                header("Content-Type: application/stream");
                header("Content-Length: ".$fileSize);
                header("Content-Disposition: attachment; filename=".$fileName);

                // Output file.
                readfile ($filePath);
                exit();
            }
            else {
                die('The provided file path is not valid.');
            }
        }

    }

    public function newLogin()
    {
        $data['active_class']       = 'faqs';
        $data['title']              = 'New Login';
        $rechaptcha_status    = getSetting('enable_rechaptcha','recaptcha_settings');
        $data['rechaptcha_status']  = $rechaptcha_status;
//        $data['rechaptcha_status']  = "yes";
        $view_name = getTheme().'::site.new-login';
        return view($view_name, $data);
    }

    public function studentDashboard()
    {
        $data['active_class']       = 'faqs';
        $data['title']              = 'Student Dashboard';
        $view_name = getTheme().'::site.student-dashboard.dashboard';
        return view($view_name, $data);
    }
    public function studentCourses()
    {
        $data['title']              = 'Student Courses';
        $data['record']         	= FALSE;
        $data['active_class']       = 'my-courses';
        $data['title']              = 'LMS'.' '.getPhrase('series');
        $data['layout']             = getLayout();
        $data['series']             = [];

        $user = Auth::user();
        $data['user']               = $user;
        $data['series']=$user->courses;
        $view_name = getTheme().'::site.student-dashboard.my-courses';
        return view($view_name, $data);
    }
    public function studentNotification()
    {
        $data['active_class']       = 'notifications';
        $data['title']              = getPhrase('notifications');
        $data['layout']              = getLayout();

        $view_name = getTheme().'::site.student-dashboard.notification';
        return view($view_name, $data);
    }
    public function studentMessages()
    {

        $currentUserId = Auth::user()->id;
        // All threads, ignore deleted/archived participants
        // $threads = Thread::getAllLatest()->get();

        // All threads that user is participating in
        $threads = Thread::forUser($currentUserId)->latest('updated_at')->paginate(getRecordsPerPage());
        // All threads that user is participating in, with new messages
        // $threads = Thread::forUserWithNewMessages($currentUserId)->latest('updated_at')->get();
        $data['title']        = getPhrase('create_message');
        $data['active_class'] = 'messages';
        $data['currentUserId']= $currentUserId;
        $data['threads'] 	  = $threads;
        $data['layout']       = getLayout();

        $view_name = getTheme().'::site.student-dashboard.my-message';
        return view($view_name, $data);
    }
    public function messageindex()
    {


        if(!getSetting('messaging', 'module'))
        {
            pageNotFound();
            return back();
        }
        $currentUserId = Auth::user()->id;
        // All threads, ignore deleted/archived participants
        // $threads = Thread::getAllLatest()->get();

        // All threads that user is participating in
        $threads = Thread::forUser($currentUserId)->latest('updated_at')->paginate(getRecordsPerPage());
        // All threads that user is participating in, with new messages
        // $threads = Thread::forUserWithNewMessages($currentUserId)->latest('updated_at')->get();
        $data['title']        = getPhrase('create_message');
        $data['active_class'] = 'messages';
        $data['currentUserId']= $currentUserId;
        $data['threads'] 	  = $threads;
        $data['layout']       = getLayout();

        // return view('messaging-system.index', $data);

        $view_name = getTheme().'::site.student-dashboard.messages.index';
        return view($view_name, $data);
    }
    /**
     * Shows a message thread.
     *
     * @param $id
     * @return mixed
     */
    public function messageshow($id)
    {
        if(!getSetting('messaging', 'module'))
        {
            pageNotFound();
            return back();
        }

        try {
            $thread = Thread::findOrFail($id);

        } catch (ModelNotFoundException $e) {
            Session::flash('error_message', 'The thread with ID: ' . $id . ' was not found.');
            return redirect('messages');
        }
        // show current user in list if not a current participant
        // $users = User::whereNotIn('id', $thread->participantsUserIds())->get();
        // don't show the current user in list
        $userId = Auth::user()->id;
        $thread_participants = $thread->participants()->get();
        $is_member = 0;
        foreach($thread_participants as $tp)
        {
            if($tp->user_id == $userId) {
                $is_member = 1;
                break;
            }
        }


        if(!$is_member)
        {
            pageNotFound();
            return back();
        }

        $participants = $thread->participantsUserIds($userId);

        $users = User::whereNotIn('id', $participants)->get();

        $thread->markAsRead($userId);

        $data['title']        = getPhrase('messages');
        $data['active_class']        = 'messages';
        $data['thread'] 	= $thread;
        $data['users']  = $users;
        $data['layout'] 	= getLayout();

        // return view('messaging-system.show', $data);

        $view_name = getTheme().'::site.student-dashboard.messages.show';
        return view($view_name, $data);
        // return view('messenger.show', compact('thread', 'users'));
    }
    /**
     * Creates a new message thread.
     *
     * @return mixed
     */
    public function messagecreate()
    {
        if(!getSetting('messaging', 'module'))
        {
            pageNotFound();
            return back();
        }

        $query = User::where('id', '!=', Auth::id());

        //if(getSetting('messaging_system_for','messaging_system')=='admin')
        //{
        // dd('hello');

        // If the loggedin user is admin
        // List all the users
        if(!checkRole(getUserGrade(2)))
            // if(Auth::user()->role_id==5)
        {

            $admin_role = getRoleData('admin');
            $owner_role = getRoleData('owner');

            $query->where('role_id', '=', $admin_role)
                ->orWhere('role_id', '=', $owner_role);
        }

        //}

        $users = $query->get();
        $data['title']        = getPhrase('send_message');
        $data['active_class']        = 'messages';
        // $data['currentUserId'] 	= $currentUserId;
        $data['users']  = $users;
        $data['layout'] 	= getLayout();

        // return view('messaging-system.create', $data);

        $view_name = getTheme().'::site.student-dashboard.messages.create';
        return view($view_name, $data);
        // return view('messenger.create', compact('users'));
    }
    public function messagestore(Request $request)
    {
        if(!getSetting('messaging', 'module'))
        {
            pageNotFound();
            return back();
        }

        $input = $request->all();
        if ($request->recipients) {

            $selectors = 'hai';
        }

        else{
            flash('Oops...!','please select the recipients', 'overlay');
            return redirect(URL_MESSAGES_CREATE);
        }
        $thread = Thread::create(
            [
                'subject' => $input['subject'],
            ]
        );
        // Message
        App\Message::create(
            [
                'thread_id' => $thread->id,
                'user_id'   => Auth::user()->id,
                'body'      => $input['message'],
            ]
        );
        // Sender
        App\Participant::create(
            [
                'thread_id' => $thread->id,
                'user_id'   => Auth::user()->id,
                'last_read' => new Carbon,
            ]
        );
        // Recipients
        if ($request->recipients) {
            $thread->addParticipant($input['recipients']);
        }
        return redirect(URL_MESSAGES);
    }

    /**
     * Adds a new message to a current thread.
     *
     * @param $id
     * @return mixed
     */
    public function messageupdate(Request $request, $id)
    {
        if(!getSetting('messaging', 'module'))
        {
            pageNotFound();
            return back();
        }

        try {
            $thread = Thread::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            Session::flash('error_message', 'The thread with ID: ' . $id . ' was not found.');
            return redirect('messages');
        }
        $thread->activateAllParticipants();
        // Message
        Message::create(
            [
                'thread_id' => $thread->id,
                'user_id'   => Auth::id(),
                'body'      => $request->message,
            ]
        );
        // Add replier as a participant
        $participant = App\Participant::firstOrCreate(
            [
                'thread_id' => $thread->id,
                'user_id'   => Auth::user()->id,
            ]
        );
        $participant->last_read = new Carbon;
        $participant->save();
        // Recipients
        if ($request->recipients) {
            $thread->addParticipants($request->recipients);
        }
        return redirect('messages/' . $id);
    }
    public function studentExams($slug)
    {

        $user = User::getRecordWithSlug($slug);

        if(!isEligible($slug))
            return back();

        $userid = $user->id;
        $data['active_class']       = 'analysis';
        $data['title']              = getPhrase('exam_analysis_by_attempts');
        $data['user']               = $user;
        // Chart code start
        $records = array();

        $records = App\Quiz::join('quizresults', 'quizzes.id', '=', 'quizresults.quiz_id')
            ->join('lmsseries_exams', 'quizresults.quiz_id', '=', 'lmsseries_exams.exam_quiz_id')
            ->select(['quiz_id','title','is_paid' ,'dueration', 'quizzes.total_marks',  \DB::raw('count(quizresults.user_id) as attempts, quizzes.slug, user_id') ])
            ->where('quizresults.user_id', '=',auth()->id())

            ->get();

        /*  $records = Quiz::join('quizresults', 'quizzes.id', '=', 'quizresults.quiz_id')
              ->join('lmsseries_exams', 'quizresults.quiz_id', '=', 'lmsseries_exams.exam_quiz_id')
              ->select(['quiz_id','title','is_paid' ,'dueration', 'quizzes.total_marks',  \DB::raw('count(quizresults.user_id) as attempts, quizzes.slug, user_id') ])
              ->where('quizresults.user_id', '=',auth()->id())

              ->get();*/
        // dd($records);
        $chartSettings = new App\ChartSettings();
        $colors = (object) $chartSettings->getRandomColors(count($records));
        $i=0;
        $labels = [];
        $dataset = [];
        $dataset_label = [];
        $bgcolor = [];

        foreach($records as $record) {
            $exam_record = App\LmsSeriesExams::where('exam_quiz_id','=',$record->quiz_id)->first();
            /*   dd($exam_record);
             $course_record = App\LmsSeries::where('id','=',$exam_record->lmsseries_id)->first();

               $course_title= $course_record->title;

               $quiz_record = $record->title;
               $labels[] = $course_title.'('.$record->title.') ('.$record->attempts.' '.getPhrase('attempts').')';
               $dataset[] = $record->attempts;

               $dataset_label[] = $course_title.'('.$record->title.') ('.$record->attempts.' '.getPhrase('attempts').')';
               $bgcolor[] = $colors->bgcolor[$i];
               $border_color[] = $colors->border_color[$i++];*/

        }


        $chart_data['type'] = 'pie';
        //horizontalBar, bar, polarArea, line, doughnut, pie
        $chart_data['title'] = getPhrase('exam_analysis_by_attempts');
        $border_color=[];
//        $chart_data['data']   = (object) array(
//            'labels'            => $labels,
//            'dataset'           => $dataset,
//            'dataset_label'     => $dataset_label,
//            'bgcolor'           => $bgcolor,
//            'border_color'      => $border_color
//            );
//
//        $data['chart_data'][] = (object)$chart_data;
        //Chart Code End
        $data['layout']             = getLayout();


        $view_name = getTheme().'::site.student-dashboard.my-exam';
        return view($view_name, $data);
    }
    public function studentCertificates()
    {
        $data['active_class']     = 'Certificate';
        $data['title']            = getPhrase('Certificate Listing');
        // return view('pages.list', $data);
        $view_name = getTheme().'::site.student-dashboard.my-certificates';
        return view($view_name, $data);
    }

    public function previewCertificate($id)
    {
        $record = App\Certificate::find($id);
        $data['record'] = $record;
        $data['active_class'] = 'certificate';
        $data['settings'] = FALSE;
        $data['title'] = getPhrase('view_page');
        $view_name = getTheme() . '::site.student-dashboard.certificate.add-edit';
        return view($view_name, $data);
    }

    public function studentOrders($slug = "isadmin")
    {
        if($slug != "isadmin") {
            if(!isEligible($slug))
                return back();
        }


        $data['is_parent']           = 0;
        $data['slug']                = "";

        if($slug != "isadmin") {
            $user = getUserWithSlug($slug);
        } else {
            $user = getAdminWithSlug();
            $data['slug']                = "admin";
        }

//    if(getRoleData($user->role_id)=='parent')
//      $data['is_parent']           = 1;

        $data['user']       		= $user;
        $data['active_class']       = 'orders';
        $data['title']              = getPhrase('orders_list');
        $data['layout']              = getLayout();


//      $payment = new Payment();
//      $records = $payment->updateTransactionRecords($user->id);
//      foreach($records as $record)
//      {
//      	$rec = Payment::where('id',$record->id)->first();
//      	$this->isExpired($rec);
//      }
//

        $view_name = getTheme().'::site.student-dashboard.my-orders';
        return view($view_name, $data);
    }


    public function studentWishlist()
    {
        if(checkRole(getUserGrade(7)))
        {
//            return back();
            return redirect()->back();
        }
        $data['record']         	= FALSE;
        $data['active_class']       = 'wishlists';
        $data['title']              = 'My Wishlists';
        $data['layout']             = getLayout();
        $data['series']             = [];

        $user = Auth::user();
        $data['user']               = $user;

        //exit(Auth::user());
        // $data['series']=$user->wishlists;
        // DB::enableQueryLog();
        $data['series'] = Wishlist::join('lmsseries', 'wishlists.course_id', '=', 'lmsseries.id')
            ->select('*')
            ->where('wishlists.user_id', '=', Auth::user()->id)
            ->orderBy('lmsseries.id', 'desc')
            ->get();
        // $query = DB::getQueryLog();
        // print_r($query);
        // exit(print_r($data['series']));
        // return view('student.lms.lms-series-list', $data);
        //dd($user->courses);
        $view_name = getTheme().'::site.student-dashboard.wishlist';
        return view($view_name, $data);


    }


    public function OfflineWishlist()
    {

        $data['record']         	= FALSE;
        $data['active_class']       = 'wishlists';
        $data['title']              = 'My Wishlists';
        $data['layout']             = getLayout();
        $data['series']             = [];

//        $ids    =   array(33, 34, 35, 36, 37, 41);
//        print_r(session()->get('Course_ids'));
        $ids    =   (session()->has('Course_ids')) ? session()->get('Course_ids') : [];

        $data['series'] = LmsSeries::wherein('id', $ids)
            ->orderBy('id', 'desc')
            ->get();

        $data['data']             = [];

        $view_name = getTheme().'::site.wishlist';
        return view($view_name, $data);

    }


    public function SaveOfflineWishlist(Request $request)
    {
        $response   =   0;
        $offID = $request->course_id;

        $data   =   ($request->session()->has('Course_ids')) ? $request->session()->get('Course_ids') : [];
        if(in_array($offID, $data)) {
            $key = array_search($offID, $data);
            unset($data[$key]);
            $response = 0;
        } else {
            $data[] =   $offID;
            $response = "wishlistit";
            $response   =   1;
        }

        $request->session()->put('Course_ids', $data);

        $data["status"] = $response;
//        return \Illuminate\Support\Facades\Response::json($data);
        return $response;
    }

    public function viewExamAnswers($exam_slug, $result_slug)
    {

        $exam_record = Quiz::getRecordWithSlug($exam_slug);
        if($isValid =  app("App\Http\Controllers\ReportsController")->isValidRecord($exam_record))
            return redirect($isValid);

        $result_record = App\QuizResult::getRecordWithSlug($result_slug);
        $user_details   = App\User::where('id','=',$result_record->user_id)->get()->first();

        if($isValid = app("App\Http\Controllers\ReportsController")->isValidRecord($result_record))
            return redirect($isValid);



        $prepared_records        = (object) $exam_record
            ->prepareQuestions($exam_record->getQuestions(),'examcomplted');
        $data['questions']       = $prepared_records->questions;
        $data['subjects']        = $prepared_records->subjects;


        $data['exam_record']        = $exam_record;
        $data['result_record']      = $result_record;
        $data['user_details']        = $user_details;
        $data['active_class']       = 'analysis';
        $data['title']              = $exam_record->title.' '.getPhrase('answers');
        $data['layout']             = getLayout();
        // return view('student.exams.results.answers', $data);
        //$pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('student.exams.results.answers', $data);
        //return $pdf->download('Certificate_'.$result_record->user_id.'.pdf');

        $view_name = getTheme().'::site.student-dashboard.answers';
        return view($view_name, $data);
    }

    public function downExamAnswers($exam_slug, $result_slug)
    {

        $exam_record = App\Quiz::getRecordWithSlug($exam_slug);
        if ($isValid = app("App\Http\Controllers\ReportsController")->isValidRecord($exam_record))
            return redirect($isValid);

        $result_record = App\QuizResult::getRecordWithSlug($result_slug);
        $user_details = App\User::where('id', '=', $result_record->user_id)->get()->first();

        if ($isValid = app("App\Http\Controllers\ReportsController")->isValidRecord($result_record))
            return redirect($isValid);


        $prepared_records = (object)$exam_record
            ->prepareQuestions($exam_record->getQuestions(), 'examcomplted');
        $data['questions'] = $prepared_records->questions;
        $data['subjects'] = $prepared_records->subjects;


        $data['exam_record'] = $exam_record;
        $data['result_record'] = $result_record;
        $data['user_details'] = $user_details;
        $data['active_class'] = 'analysis';
        $data['title'] = $exam_record->title . ' ' . getPhrase('answers');
        $data['layout'] = getLayout();
        $view_name = getTheme().'::student.exams.results.result_pdf';
        $pdf = \PDF::loadView($view_name, $data);

        return $pdf->download('Exam_Result_'.$exam_record->id.'-'.$result_record->id.'-'.$result_record->user_id.'.pdf');
    }

//    public function corporateTrainingSave(Request $request)
//    {
//
//
//        $data['active_class']       = 'faqs';
//        $data['title']              = 'corporate Training';
//
//        /******* Form Validation *****/
//        $rules = [
//            'f_name' => 'required',
//            'l_name' => 'required',
//            'c_name' => 'required',
//            'n_delegates' => 'required',
//            'c_address' => 'required',
//            'city' => 'required',
//            'cs_region' => 'required',
//            'zip_code' => 'required',
//            'country' => 'required',
//            'email' => 'required|email',
//            'contact'=>'required',
//            'training'=>'required',
//            'expected'=>'required',
//            'methods'=>'required',
//            'message'=>'required'
//        ];
//
//        $customMessages = [
//            'required' => 'The :attribute field is required.'
//        ];
//
//        $this->validate($request, $rules, $customMessages);
//        /******* Form Validation *****/
//        try {
//
//            /********* Email ***********/
//            $f_name         = $request->f_name;
//            $l_name         = $request->l_name;
//            $c_name         = $request->c_name;
//            $n_delegates    = $request->n_delegates;
//            $c_address      = $request->c_address;
//            $city           = $request->city;
//            $cs_region      = $request->cs_region;
//            $zip_code       = $request->zip_code;
//            $country        = $request->country;
//            $email          = $request->email;
//            $contact        = $request->contact;
//            $training       = $request->training;
//            $expected       = $request->expected;
//            $methods        = $request->methods;
//            $msg            = $request->message;
//
//
//
//            /********* Insert Record Into DB ***********/
//            $CorporateEmail   = new App\CorporateEmail();
//
//            $CorporateEmail->f_name             = $f_name;
//            $CorporateEmail->l_name             = $l_name;
//            $CorporateEmail->c_name             = $c_name;
//            $CorporateEmail->n_delegates        = $n_delegates;
//            $CorporateEmail->c_address          = $c_address;
//            $CorporateEmail->city               = $city;
//            $CorporateEmail->cs_region          = $cs_region;
//            $CorporateEmail->zip_code           = $zip_code;
//            $CorporateEmail->country            = $country;
//            $CorporateEmail->email              = $email;
//            $CorporateEmail->contact            = $contact;
//            $CorporateEmail->training           = $training;
//            $CorporateEmail->expected           = $expected;
//            $CorporateEmail->methods            = $methods;
//            $CorporateEmail->message            = $msg;
//
//            $CorporateEmail->save();
//            /********* Insert Record Into DB ***********/
//
//
//            sendEmail('corporatetraining_ack_copy', array('f_name'=> $f_name,
//                'l_name' => $l_name,
//                'c_name' => $c_name,
//                'email' => $email,
//                'to_email' => $email,
//                'n_delegates' => $n_delegates,
//                'c_address' => $c_address,
//                'city' => $city,
//                'cs_region' => $cs_region,
//                'zip_code' => $zip_code,
//                'country' => $country,
//                'contact' => $contact,
//                'training' => $training,
//                'expected' => $expected,
//                'methods' => $methods,
//                'msg' => $msg,
//                'url' => BASE_PATH ));
//
//            sendEmail('corporatetraining_admin', array('f_name'=> $f_name,
//                'send_to' => 'admin',
//                'to_email' => $email,
//                'email' => $email,
//                'l_name' => $l_name,
//                'c_name' => $c_name,
//                'n_delegates' => $n_delegates,
//                'c_address' => $c_address,
//                'city' => $city,
//                'cs_region' => $cs_region,
//                'zip_code' => $zip_code,
//                'country' => $country,
//                'contact' => $contact,
//                'training' => $training,
//                'expected' => $expected,
//                'methods' => $methods,
//                'msg' => $msg,
//                'url' => BASE_PATH ));
//
//
//        } catch (Exception $e) {
//            //dd($e->getMessage());
//        }
//
////        $view_name = getTheme().'::emails.CorporateTraining';
////
////        Mail::send($view_name, ['f_name' => $f_name, 'l_name' => $l_name, 'c_name' => $c_name, 'n_delegates' => $n_delegates, 'c_address' => $c_address, 'city' => $city, 'cs_region' => $cs_region, 'zip_code' => $zip_code, 'country' => $country, 'email' => $email, 'contact' => $contact, 'training' => $training, 'expected' => $expected, 'methods' => $methods, 'msg' => $msg], function($message)  use ($adminemail){
////            $message->to($adminemail);
////            $message->subject("Corporate Training form new request!!!");
////        });
//
//        /******* Mail To User ************/
////        Mail::send($view_name, ['f_name' => $f_name, 'l_name' => $l_name, 'c_name' => $c_name, 'n_delegates' => $n_delegates, 'c_address' => $c_address, 'city' => $city, 'cs_region' => $cs_region, 'zip_code' => $zip_code, 'country' => $country, 'email' => $email, 'contact' => $contact, 'training' => $training, 'expected' => $expected, 'methods' => $methods, 'msg' => $msg], function($message)  use ($email){
////            $message->to($email);
////            $message->subject("Your request has been send successfully !!!");
////        });
//
//
//        /********* Email ***********/
//        toastr()->success('Email has been submitted, Thanks!');
//        return redirect('/corporate?success=suc#corporate-form')->with('message', 'Email has been submitted, Thanks!');
//    }

    public function corporateTrainingSave(Request $request)
    {


        $data['active_class']       = 'faqs';
        $data['title']              = 'corporate Training';

        /******* Form Validation *****/
        $rules = [
            'f_name' => 'required',
            'l_name' => 'required',
            'email' => 'required|email',
            'contact'=>'required',
            'c_name' => 'required',
            'j_title'=>'required',
            'g-recaptcha-response' => 'required|captcha',
            'whatare'=>'required'
        ];

        $customMessages = [
            'f_name.required' => 'The First Name field is required.',
            'l_name.required' => 'The Last Name field is required.',
            'email.required' => 'The Work Email field is required.',
            'contact.required' => 'The Phone Number field is required.',
            'c_name.required' => 'The Company Name field is required.',
            'j_title.required' => 'The Job Title field is required.',
            'g-recaptcha-response.required' => 'The Captcha field is required.',
            'whatare.required' => 'The What are your training needs? field is required.',
        ];

        $this->validate($request, $rules, $customMessages);
        /******* Form Validation *****/
        try {

            /********* Email ***********/
            $f_name         = $request->f_name;
            $l_name         = $request->l_name;
            $email          = $request->email;
            $contact        = $request->contact;
            $c_name         = $request->c_name;
            $j_title        = $request->j_title;
            $whatare        = $request->whatare;



            /********* Insert Record Into DB ***********/
            $CorporateEmail   = new App\CorporateEmail();

            $CorporateEmail->f_name             = $f_name;
            $CorporateEmail->l_name             = $l_name;
            $CorporateEmail->c_name             = $c_name;
            $CorporateEmail->j_title            = $j_title;
            $CorporateEmail->email              = $email;
            $CorporateEmail->contact            = $contact;
            $CorporateEmail->whatare            = $whatare;

            $CorporateEmail->save();
            /********* Insert Record Into DB ***********/


            sendEmail('corporate_ack', array('f_name'=> $f_name,
                'send_to' => $f_name." ".$l_name,
                'to_email' => $email,
                'l_name' => $l_name,
                'c_name' => $c_name,
                'email' => $email,
                'contact' => $contact,
                'j_title' => $j_title,
                'whatare' => $whatare,
                'url' => BASE_PATH ));

            sendEmail('corporate_admin_ack', array('f_name'=> $f_name,
                'send_to' => 'admin',
                'to_email' => $email,
                'email' => $email,
                'l_name' => $l_name,
                'c_name' => $c_name,
                'contact' => $contact,
                'j_title' => $j_title,
                'whatare' => $whatare,
                'url' => BASE_PATH ));


        } catch (Exception $e) {
            //dd($e->getMessage());
        }

//        $view_name = getTheme().'::emails.CorporateTraining';
//
//        Mail::send($view_name, ['f_name' => $f_name, 'l_name' => $l_name, 'c_name' => $c_name, 'n_delegates' => $n_delegates, 'c_address' => $c_address, 'city' => $city, 'cs_region' => $cs_region, 'zip_code' => $zip_code, 'country' => $country, 'email' => $email, 'contact' => $contact, 'training' => $training, 'expected' => $expected, 'methods' => $methods, 'msg' => $msg], function($message)  use ($adminemail){
//            $message->to($adminemail);
//            $message->subject("Corporate Training form new request!!!");
//        });

        /******* Mail To User ************/
//        Mail::send($view_name, ['f_name' => $f_name, 'l_name' => $l_name, 'c_name' => $c_name, 'n_delegates' => $n_delegates, 'c_address' => $c_address, 'city' => $city, 'cs_region' => $cs_region, 'zip_code' => $zip_code, 'country' => $country, 'email' => $email, 'contact' => $contact, 'training' => $training, 'expected' => $expected, 'methods' => $methods, 'msg' => $msg], function($message)  use ($email){
//            $message->to($email);
//            $message->subject("Your request has been send successfully !!!");
//        });


        /********* Email ***********/
//        toastr()->success('Email has been submitted, Thanks!');
        return redirect('/corporate?success=suc#corporate-form')->with('message', 'Email has been submitted, Thanks!');
    }

    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $fbuser = Socialite::driver('facebook')->user();

        $userData   = App\User::where("email", $fbuser->getEmail())->first();

        if(!$userData) {
            /********** Register Functionality *********/
            $user   = new User();
            $password         = str_random(8);
            $user->password   = bcrypt($password);
            $slug             = (empty($fbuser->getNickname())) ? strtolower(str_replace(' ', '_', $fbuser->getName())) : $fbuser->getNickname();
            $user->username   = $slug;
            $user->slug       = $slug;

            $role_id        = getRoleData('student');

            $user->name         = $fbuser->getName();
            $user->first_name   = explode(" ", $fbuser->getName())[0];
            $user->last_name    = explode(" ", $fbuser->getName())[1];
            $user->email        = $fbuser->getEmail();
            $user->role_id      = $role_id;
            $user->login_enabled  = 1;
            $user->save();
            $user_id = $user->id;
            $user->roles()->attach($user->role_id);
            /********** Register Functionality *********/
        }

        $id = (isset($user_id)) ? $user_id : $userData->id;
        Auth::loginUsingId($id, true);
        return redirect(URL_DASHBOARD);
    }

    public function marketingLanding(Request $request){

        $data['active_class']       = 'offer1';
        $data['record']             = App\Offers::where("url", $request->slug)->first();
        $data['title']              = $data['record']->offer_name;

        $view_name = getTheme().'::site.marketing-landing';
        return view($view_name, $data);
    }

//    public function GetCourseOnID($CID) {
//        $res = "";
//        $allCourse  =   App\LmsSeries::where("lms_category_id", $CID)->get();
//        foreach($allCourse as $course){
//            $res    .=   "<option value='".$course->id."'>".$course->title."</option>";
//        }
//        echo $res;
//    }

    public function GetCourseOnID($CID) {
        $res = "";
        $catids[] = $CID;
        $catres  =   App\LmsCategory::where("parent_id", $CID)->get();
        if(count($catres) > 0) {
            foreach($catres as $cat) {
                $catids[] = $cat->id;
            }
        }
        $allCourse  =   App\LmsSeries::whereIn("lms_category_id", $catids)->get();
        foreach($allCourse as $course){
            $res    .=   "<option id='".$course->id."' value='".$course->id."'>".$course->title."</option>";
        }
        echo $res;
    }

    public function GetCourseIDonCat($CID) {
        $IDS = [];
        $catids[] = $CID;
        $catres  =   App\LmsCategory::where("parent_id", $CID)->get();
        if(count($catres) > 0) {
            foreach($catres as $cat) {
                $catids[] = $cat->id;
            }
        }
        $allCourse  =   App\LmsSeries::whereIn("lms_category_id", $catids)->get();
        foreach($allCourse as $course){
            $IDS[] = $course->id;
        }
        echo json_encode($IDS);
    }


    public function getValidate()
    {
        $data['active_class']       = 'faqs';
        $data['title']              = 'validate certificate';
        $view_name = getTheme().'::site.validate-certificate';
        return view($view_name, $data);
    }


    public function postValidate(Request $request){

        /******* Form Validation *****/
        $rules = [
            'user_name' => 'bail|required|max:250|',
            'certificate_code' => 'bail|required|max:18|',
        ];
        $customMessages = [
            'required' => 'The :attribute field is required.'
        ];
        $validator = Validator::make($request->all(), $rules, $customMessages);
        /******* Form Validation *****/
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        try{
            $certificate = App\Certificate::where('certificate_code','=',$request->certificate_code)
                ->where('user_name','=',$request->user_name)
                ->where('status','=','yes')->first();

            if ($certificate){
                $data['active_class']='home';
                $data['title']              = 'validate certificate';
                $data['cid']=$certificate->course_id;
                $data['user_name']=$certificate->user_name;
                $data['certificate_code']=$certificate->certificate_code;
                $data['certificate_file']=$certificate->certificate_file;
                $data['valid']='success';
                $view_name = getTheme().'::site.validate-certificate';
                return view($view_name, $data);

            }else{
                $data['active_class']='home';
                $data['title']              = 'validate certificate';
                $data['valid']='failed';
                $view_name = getTheme().'::site.validate-certificate';
                return view($view_name, $data);
            }



        } catch (Exception $e) {
            \Session::put('error',$e->getMessage());
            print($e->getMessage());
        }


        // dd($request);

    }
    public function viewCertificate(Request $request)
    {
//        if (!getSetting('certificate', 'module')) {
//            pageNotFound();
//            return back();
//        }
        $certificate_code=$request->certificate_code;
        $certificate_data = [];
        $certificate = App\Certificate::where('certificate_code','=',$certificate_code)
            ->where('status','=','yes')->first();
        if ($certificate) {

            $data['active_class'] = 'analysis';
            $data['awarded_date'] = $certificate->generated_date;
            $data['title'] = getPhrase('certificate_generation');
            $data['username'] = ucfirst($certificate->user_name);
            $data['certificate_code'] = $certificate_code;
            $data['course_type'] = $certificate->course_type;
            $certificate_file = UPLOADS . 'lms/certificate/' . $certificate->certificate_file;
            $data['certificate_file'] = $certificate_file;
            $html = view(getTheme() . '::exams.certificates.view_certificate', $data)->render();
            return response()->json(['html' => $html]);
        }

    }


    /********** Payment Option *********/

    public function postPaymentWithPayPalProAnonymous(Request $request)
    {
        $user_id ="";
        if($request->course_type=="reed"){
            $user_name=$request->user_name;
            $user_id='reed';
        }else {
            if (Auth::check()) {
                $user = Auth::user();
                $user_id = $user->id;
            } else {
                $user_id = createUserRecord($request);
                Auth::loginUsingId($user_id);
                $user = Auth::user();
            }
            $user_name=$user->name;
        }

        $input = $request->all();

        $record_id="";
        if($request->type=='studentcard-fee') {
            $record_id=app("App\Http\Controllers\PaymentsController")->studentIdCardSave($request,'save');
        }
        $messages = [
            'required' => 'The :attribute field is required.',
        ];
        $validator = Validator::make($request->all(), [

//            'f_name' => 'required',
//            'std_email' => 'required|email',
//            'std_tel' => 'required',
//            'std_dob' => 'required',
////            'std_adInfo'=>'required',
//            'std_address'=>'required',
//            'std_city'=>'required',
//            'std_zipcode'=>'required',
//            'std_country'=>'required',
            'card_no' => 'required',
            'ccExpiryMonth' => 'required',
            'ccExpiryYear' => 'required',
            'cvvNumber' => 'required'
            //'amount' => 'required',
        ],$messages);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }





        $input = array_except($input,array('_token'));
        try {
            if(isset($request->f_name)){
                $arr=split_name($request->f_name);
                $first_name=$arr[0];
                $last_name=$arr[1];
            }else{
                $first_name= $request->first_name;
                $last_name=$request->last_name;
            }

            $formData = array(
                'firstName' => $first_name,
                'lastName' => $last_name,
                'number' => $request->card_no,
                'expiryMonth' => $request->ccExpiryMonth,
                'expiryYear' => $request->ccExpiryYear,
                'cvv' => $request->cvvNumber
            );



            // Send purchase request
            $response = app("App\Http\Controllers\PaymentsController")->gateway->purchase([
                'amount' => $request->order_amount,
                'currency' => session('currency_short'),
                'card' => $formData
            ])->send();

            //

            $other_details = array();
            $other_details['is_coupon_applied'] = $request->is_coupon_applied;
            $other_details['actual_cost'] 		  = $request->actual_cost;
            $other_details['discount_availed'] 	= $request->discount_availed;
            $other_details['after_discount']    = $request->after_discount;
            $other_details['coupon_id']         = $request->coupon_id;
            $other_details['currency']=session('currency_short');
            $other_details['currency_icon']=session('currency_symbol');


            $request->request->add(['record_id' => $record_id]);
            // Process response
            if ($response->isSuccessful()) {

                // Payment was successful
                $arr_body = $response->getData();
                $amount = $arr_body['AMT'];
                $currency = $arr_body['CURRENCYCODE'];
                $transaction_id = $arr_body['TRANSACTIONID'];
                $other_details['transaction_id']=$transaction_id;
                $other_details['currency']=$currency;
                $other_details['admin_comments']=$user_name.' bought this course online with credit card '.$request->gateway;



                /**
                 * Write Here Your Database insert logic.
                 */
                $item=$request;
                $type=$request->type;
                $payment_gateway=$request->gateway;

                $token = app("App\Http\Controllers\PaymentsController")->preserveBeforeSave($item,$type, $payment_gateway, $other_details);
                //$user = Auth::user();

                if(app("App\Http\Controllers\PaymentsController")->paymentSuccess($request, $token))
                {
                    //dd($request);
                    $records = Payment::select(['id','created_at','item_name','payment_gateway','other_details','transaction_record','actual_cost','coupon_applied','discount_amount','after_discount','currency'])
                        ->where('slug',$token)
                        ->first();
                    //dd($records);
                    $orderid = makeOrderID($records->id);
                    $order_date = $records->created_at;
                    $order_amount = $records->actual_cost;
                    $currency = $records->currency;
                    $coursetitle=$records->item_name;
                    $gateway=$records->payment_gateway;
                    $transaction = $records->transaction_record;
                    $other_details = $records->other_details;
                    $discount_amt=0;
                    if($records->coupon_applied==1){
                        $discount_amt=$records->discount_amount;
                        $after_discount=$records->after_discount;
                    }

                    if($request->type=='studentcard-fee'){
                        app("App\Http\Controllers\PaymentsController")->studentIdCardSave($request,'update');

                        $records = Payment::select(['id'])
                            ->where('slug',$token)
                            ->first();
                        $orderid=makeOrderID($records->id);
                        //dd($response);
                        return redirect('/order-thankyou?cost=' . $request->actual_cost . '&ref=' . $orderid . "&method=card");



                    }else if($request->type=='certificate-fee'){
                        app("App\Http\Controllers\PaymentsController")->certificateSavePayPalPro($request);

                        sendEmail('certificate_fee_ack', array('name' => $request->user_name,
                            'email' => $request->user_email,
                            'to_email' => $request->user_email,
                            'course' => $request->course_title,
                            'fee' => $request->order_amount,
                            'contact' => $request->user_phone,
                            'address' => $request->std_address,
                            'address2' => $request->std_address2,
                            'city' => $request->std_city,
                            'zipcode' => $request->std_zipcode,
                            'country' => $request->std_country,
                            'gateway' => $request->gateway,
                            'orderid' => $orderid,
                            'url' => url('/')));
                        sendEmail('certificate_fee_admin', array('name' => $request->user_name,
                            'send_to' => 'admin',
                            'email' => $request->user_email,
                            'to_email' => $request->user_email,
                            'course' => $request->course_title,
                            'fee' => $request->order_amount,
                            'contact' => $request->user_phone,
                            'address' => $request->std_address,
                            'address2' => $request->std_address2,
                            'city' => $request->std_city,
                            'zipcode' => $request->std_zipcode,
                            'country' => $request->std_country,
                            'gateway' => $request->gateway,
                            'orderid' => $orderid,
                            'url' => url('/')));



                    }else if($request->type=='reed-certificate'){
                        app("App\Http\Controllers\PaymentsController")->certificateSavePayPalPro($request);

                        sendEmail('reed_certificate_fee_ack', array('name' => $request->user_name,
                            'email' => $request->user_email,
                            'to_email' => $request->user_email,
                            'course' => $request->course_title,
                            'fee' => $request->order_amount,
                            'contact' => $request->user_phone,
                            'address' => $request->std_address,
                            'address2' => $request->std_address2,
                            'city' => $request->std_city,
                            'zipcode' => $request->std_zipcode,
                            'country' => $request->std_country,
                            'gateway' => $request->gateway,
                            'orderid' => $orderid,
                            'url' => url('/')));
                        sendEmail('reed_certificate_fee_admin', array('name' => $request->user_name,
                            'send_to' => 'admin',
                            'email' => $request->user_email,
                            'to_email' => $request->user_email,
                            'course' => $request->course_title,
                            'fee' => $request->order_amount,
                            'contact' => $request->user_phone,
                            'address' => $request->std_address,
                            'address2' => $request->std_address2,
                            'city' => $request->std_city,
                            'zipcode' => $request->std_zipcode,
                            'country' => $request->std_country,
                            'gateway' => $request->gateway,
                            'orderid' => $orderid,
                            'url' => url('/')));



                    }else if($request->type=='retake-exam-fee'){
                        $record = new App\ExamRetakeFee();
                        $user = Auth::user();
                        $record->user_id = $user->id;
                        $record->user_name = $user->name;
                        $record->user_email = $user->email;
                        $record->user_phone = $user->phone;
                        $record->course_id = $request->course_id;
                        $record->quiz_id = $request->quiz_id;
                        $record->payment_type =$request->gateway;
                        $record->retake_fee = $amount;
                        $record->transaction_id = $transaction_id;
                        $record->save();

                        sendEmail('retake_order_confirmation_ack', array('username'=> $user->name,
                            'to_email' => $user->email,
                            'orderid' =>$orderid,
                            'date' => date("F j, Y", strtotime($order_date)),
                            'ordertable' =>getOrderTable($token, $transaction, $other_details, $request->course_id),
                            'address' =>"",
                            'name' => $user->name,
                            'url' => url('/')  ));

                        sendEmail('retake_order_confirmation_admin', array('username'=> $user->name,
                            'to_email' => $user->email,
                            'send_to' => 'admin',
                            'orderid' =>$orderid,
                            'date' => date("F j, Y", strtotime($order_date)),
                            'ordertable' =>getOrderTable($token, $transaction, $other_details, $request->course_id),
                            'address' =>"",
                            'name' => $user->name,
                            'url' => url('/')  ));

                    }else if($request->type=='gift-lms'){

                        $payment_course         = new App\UserCourses();
                        $payment_course->item_id 		    = $item->item_id;
                        $payment_course->item_name 		  = $item->item_name;
                        $payment_course->item_price 		  = $item->actual_cost;
                        $payment_course->item_quantity 		  = 1;
                        $course = LmsSeries::where('id', $item->item_id)->first();
                        $payment_course->instructor_id 			      = $course->user_id;
                        $payment_course->user_id         = (isset($user->id)) ? $user->id : 0;
                        $payment_course->payment_slug         = (App\Payment::select(["slug"])->where("item_id", $item->item_id)->where("user_id", $user->id)->latest()->first())->slug;
                        $payment_course->save();

                        //FOR GIFT COURSE
                        sendEmail('order_confirmation_ack', array('username'=> $user->name,
                            'to_email' => $user->email,
                            'orderid' =>$orderid,
                            'date' => date("F j, Y", strtotime($order_date)),
                            'ordertable' =>getOrderTable($token, $transaction, $other_details),
                            'address' =>getAddress($transaction),
                            'name' => $user->name,
                            'url' => url('/')  ));
                        //FOR GENERAL COURSE ORDER ADMIN EMAIL
                        sendEmail('order_confirmation_admin', array('username'=> $user->name,
                            'to_email' => $user->email,
                            'send_to' => 'admin',
                            'orderid' =>$orderid,
                            'date' => date("F j, Y", strtotime($order_date)),
                            'ordertable' =>getOrderTable($token, $transaction, $other_details),
                            'address' =>getAddress($transaction),
                            'name' => $user->name,
                            'url' => url('/')  ));

                    }else{  //LMS ORDER CASE

                        //FOR GENERAL COURSE ORDER ACKNOWLEDGMENT EMAIL
                        sendEmail('order_confirmation_ack', array('username'=> $user->name,
                            'to_email' => $user->email,
                            'orderid' =>$orderid,
//                            'date' => date("F j, Y", strtotime($order_date)),
                            'date' =>$order_date,
                            'ordertable' =>getOrderTable($token,$transaction,$other_details),
                            'address' =>getAddress($transaction),
                            'name' => $user->name,
                            'url' => url('/')  ));
                        //FOR GENERAL COURSE ORDER ADMIN EMAIL
                        sendEmail('order_confirmation_admin', array('username'=> $user->name,
                            'to_email' => $user->email,
                            'send_to' => 'admin',
                            'orderid' =>$orderid,
                            'date' =>$order_date,
//                            'date' => date("F j, Y", strtotime($order_date)),
                            'ordertable' =>getOrderTable($token,$transaction,$other_details),
                            'address' =>getAddress($transaction),
                            'name' => $user->name,
                            'url' => url('/')  ));



                    }
                    \Cart::clear();
                    \Cookie::queue(\Cookie::forget('preurl'));
                    return redirect(URL_ORDER_THANKYOU.'?cost='.$request->actual_cost.'&ref='.$orderid."&method=card");



                } else {
                    //PAYMENT RECORD IS NOT VALID
                    //PREPARE METHOD FOR FAILED CASE
                    pageNotFound();
                }
                //REDIRECT THE USER BY LOADING A VIEW

                return redirect(URL_PAYMENTS_LIST.$user->slug);


            } else {
                //\Session::put('error','Money not add in wallet!!');
                //echo "Payment failed. ". $response->getMessage();
                $cookie='';
                if(isset($_COOKIE['preurl'])){
                    $cookie=$_COOKIE['preurl'];
                }else{
                    $cookie="/cart";
                }
                toastr()->warning('Payment failed: '.$response->getMessage());
                return redirect($cookie);
                //$view_name = getTheme().'::site.paywithpaypalpro';
                //return redirect()->route($view_name);
            }
        } catch (Exception $e) {
            if(isset($request->f_name)) {
                return redirect('/student-id-card?msg=1');
            }
            \Session::put('error',$e->getMessage());
            print($e->getMessage());
        }
        //  }
    }



    public function PaypalExpressAnonymous(Request $request)
    {
        $record_id=0;
        $user_id="";
        if($request->course_type=="reed"){
            $user_name=$request->user_name;
            $user_id='reed';
        }else {
            if (Auth::check()) {
                $user = Auth::user();
                $user_id = $user->id;
            } else {

                $user_id = createUserRecord($request);
                Auth::loginUsingId($user_id);
                $user = Auth::user();
            }
            $user_name = $user->name;
        }
        $cartCollection =\Cart::getContent();

        $other_details = array();
        $other_details['is_coupon_applied'] = $request->is_coupon_applied;
        $other_details['actual_cost'] 		  = $request->actual_cost;
        $other_details['discount_availed'] 	= $request->discount_availed;
        $other_details['after_discount']    = $request->after_discount;
        $other_details['coupon_id']         = $request->coupon_id;
        $other_details['currency']=session('currency_short');
        $other_details['currency_icon']=session('currency_symbol');
        $other_details['admin_comments']=$user_name.' bought this item online with credit card '.$request->gateway;

        if($request->type=='studentcard-fee') {
            $record_id=app("App\Http\Controllers\PaymentsController")->studentIdCardSave($request,'save');
        }
        $request->request->add(['record_id' => $record_id]);
//        $request->record_id=$record_id;
        $payment_gateway = $request->gateway;
        $type = $request->type;
        $item=$request;


        $token = app("App\Http\Controllers\PaymentsController")->preserveBeforeSave($item,$type, $payment_gateway, $other_details);
        //$token ="";
        $items = array();
        $studentcardid=$item->item_id;
        if($type=='studentcard-fee'){
            $items[0]['id']=$studentcardid;
            $items[0]['name']='Student Id Card Fee';
            $items[0]['price']=$request->order_amount;
            $items[0]['description']='Student Id Card Fee for '. $user->name;
            $items[0]['quantity']=1;

        }else if($type=='certificate-fee'){
            $items[0]['id']=$request->course_id;
            $items[0]['name']='Free Certificate Fee';
            $items[0]['price']=$request->order_amount;
            $items[0]['description']='Free Certificate Fee paid by '. $user_name;
            $items[0]['quantity']=1;

        }else if($type=='reed-certificate'){
            $items[0]['id']=$request->course_id;
            $items[0]['name']='Reed Certificate Fee';
            $items[0]['price']=$request->order_amount;
            $items[0]['description']='Reed Certificate Fee  paid by '. $user_name;
            $items[0]['quantity']=1;

        }else if($type=='retake-exam-fee'){
            $items[0]['id']=$request->course_id;
            $items[0]['name']='Final Exam Retake Fee';
            $items[0]['price']=$request->actual_cost;
            $items[0]['description']='Final Exam Retake Fee paid by '. $user_name;
            $items[0]['quantity']=1;


        }else if($type=='gift-lms'){
            $items[0]['id']=$request->item_id;
            $items[0]['name']='Gift Course : '.$request->item_name;
            $items[0]['price']=$request->actual_cost;
            $items[0]['description']='Gift Course : '.$request->item_name;
            $items[0]['quantity']=1;

        }else{
            foreach ($cartCollection as  $key =>$item){
                $items[$key]['id']=$item->id;
                $items[$key]['name']=$item->name;
                $items[$key]['price']=$item->attributes->discounted_price ;
                $items[$key]['description']=$item->name;
                $items[$key]['quantity']=$item->quantity;

            }
        }



        try {

            $item_info  =   ($type=='gift-lms') ? "&itemid=$request->item_id" : "";
            $response = app("App\Http\Controllers\PaymentsController")->restgateway->purchase(array(
                'amount' => $request->order_amount,
                'currency' => session('currency_short'),
                'returnUrl' => URL_PAYPAL_PAYMENT_SUCCESS . '?slug=' . $token.'&user_id='.$user_id.$item_info,
                'cancelUrl' => URL_PAYPAL_PAYMENT_CANCEL . '?slug=' . $token.'&user_id='.$user_id,
                'items' => $items,
            ))->send();
            if ($response->isRedirect()) {
                $response->redirect(); // this will automatically forward the customer
            } else {
                // not successful
                return $response->getMessage();
            }
        } catch(Exception $e) {
            return $e->getMessage();
        }
    }



    /********** End Payment Option *********/

    public function get_paypal_success(Request $request)
    {
        try {


        if ($request->input('paymentId') && $request->input('PayerID')) {

            $transaction = app("App\Http\Controllers\PaymentsController")->restgateway->completePurchase(array(
                'payer_id' => $request->input('PayerID'),
                'transactionReference' => $request->input('paymentId'),
            ));
            $response = $transaction->send();

            if ($response->isSuccessful()) {
                $arr_body = $response->getData();
                //$arr=json_encode($arr_body);
                //$arr_body = (object)$arr;
                //echo "<pre>";
                $transaction_id=$arr_body['transactions'][0]['related_resources'][0]['sale']['id'];
                //dd($arr_body);
                //echo $arr_body['transactions'][0].related_resources[0].sale.id;

                $orderid = '';
                //if($_REQUEST['st']=='Pending'){
                $token = $request->input('slug');
                $user_id = $request->input('user_id');
                if ($user_id!="reed") {
                    Auth::loginUsingId($user_id);
                }
                    $payment_record = Payment::where('slug', $token)->first();
                    $user = User::find($payment_record->user_id);

                $daysToAdd = '365 days';
                $payment_record->start_date = date('Y-m-d');
                $payment_record->end_date = date('Y-m-d', strtotime($daysToAdd));
                $payment_record->paid_amount = $arr_body['transactions'][0]['amount']['total'];
                $payment_record->transaction_id = $transaction_id;
                $payment_record->paid_by =$arr_body['transactions'][0]['amount']['total'];
//              $payment_record->currency_icon = session('currency_symbol');
                $payment_record->payment_status = $arr_body['state']=='approved'?PAYMENT_STATUS_SUCCESS:$arr_body['state'];
                $payment_record->save();

                $package_type = $payment_record->plan_type;
                $orderid = makeOrderID($payment_record->id);
                $order_amount = $payment_record->cost;
                $order_date = $payment_record->created_at;
                $transaction = $payment_record->transaction_record;
                $other_details = $payment_record->other_details;
                $gateway = $payment_record->payment_gateway;
                $transaction_id = $arr_body['id'];

                if ($package_type == 'studentcard-fee') {//FOR STUDENT ID CARD FEE
                    $arr = json_decode($transaction, true);

                    $myRequest = new \Illuminate\Http\Request();
                    $myRequest->setMethod('POST');
                    $myRequest->merge($arr);
                    app("App\Http\Controllers\PaymentsController")->studentIdCardSave($myRequest,'update');

                }else if($package_type=='reed-certificate') {
                    //FOR CERTIFICATE ORDER  FEE
                    $trans_id = $payment_record->transaction_id;
                    $status = 'yes';
                    $item_name1 = $request->item_name1;
                    $mc_gross_1 = $request->mc_gross_1;
                    $arr = json_decode($transaction, true);
                    $request = (object)$arr;
                    $newcertificate = false;
                    if ($request->course_type == 'reed') {
                        $newcertificate = true;
                    }
                    if ($newcertificate) {

                        /********* Insert Record Into DB ***********/
                        $certificate = new App\Certificate();
                        $certificate->user_id = $request->user_id;
                        $certificate->user_name = $request->user_name;
                        $certificate->user_email = $request->user_email;
                        $certificate->user_phone = $request->user_phone;
                        $certificate->course_id = $request->course_id;
                        $certificate->course_type = $request->course_type;
                        $certificate->reed_course_name = $request->course_title;
                        $certificate->payment_type = $request->gateway;
                        $certificate->address1 = $request->std_address;
                        $certificate->address2 = $request->std_address2;
                        $certificate->city = $request->std_city;
                        $certificate->zipcode = $request->std_zipcode;
                        $certificate->country = $request->std_country;
                        $certificate->delivery_fee = $request->order_amount;
                        $certificate->transaction_id = $trans_id;
                        $certificate->status = $status;
                        $certificate->save();
                    }
                    sendEmail('reed_certificate_fee_ack', array('name' => $request->user_name,
                        'email' => $request->user_email,
                        'to_email' => $request->user_email,
                        'course' => $request->course_title,
                        'fee' => $mc_gross_1,
                        'contact' => $certificate->user_phone,
                        'address' => $certificate->address1,
                        'address2' => $certificate->address2,
                        'city' => $certificate->city,
                        'zipcode' => $certificate->zipcode,
                        'country' => $certificate->country,
                        'gateway' => $certificate->payment_type,
                        'orderid' => $orderid,
                        'url' => url('/')));
                    sendEmail('reed_certificate_fee_admin', array('name' => $request->user_name,
                        'send_to' => 'admin',
                        'email' => $request->user_email,
                        'to_email' => $request->user_email,
                        'course' => $request->course_title,
                        'fee' => $mc_gross_1,
                        'contact' => $certificate->user_phone,
                        'address' => $certificate->address1,
                        'address2' => $certificate->address2,
                        'city' => $certificate->city,
                        'zipcode' => $certificate->zipcode,
                        'country' => $certificate->country,
                        'gateway' => $certificate->payment_type,
                        'orderid' => $orderid,
                        'url' => url('/')));

                }else if ($package_type == 'certificate-fee') {//FOR CERTIFICATE ORDER  FEE
                    $trans_id = $payment_record->transaction_id;
                    $status = 'yes';
                    //  $item_name1 = $request->item_name1;
                    // $mc_gross_1 = $request->mc_gross_1;
                    $arr = json_decode($transaction, true);
                    $request = (object)$arr;
                    $item_name1 = $request->course_title;
                    $mc_gross_1 = $request->order_amount;
                    $certificate = App\Certificate::where('user_id', '=', $request->user_id)
                        ->where('course_id', '=', $request->course_id)
                        ->first();
                    if (!$certificate) {
                        /********* Insert Record Into DB ***********/
                        $certificate = new App\Certificate();
                        $certificate->user_id = $request->user_id;
                        $certificate->user_name = $request->user_name;
                        $certificate->user_email = $request->user_email;
                        $certificate->user_phone = $request->user_phone;
                        $certificate->course_id = $request->course_id;
                        $certificate->course_type = $request->course_type;
                        $certificate->payment_type = $request->gateway;
                        $certificate->address1 = $request->std_address;
                        $certificate->address2 = $request->std_address2;
                        $certificate->city = $request->std_city;
                        $certificate->zipcode = $request->std_zipcode;
                        $certificate->country = $request->std_country;
                        $certificate->delivery_fee = $request->order_amount;
                        $certificate->transaction_id = $trans_id;
                        $certificate->status = $status;
                        $certificate->save();
                    } else {

                        $certificate->user_name = $request->user_name;
                        $certificate->user_email = $request->user_email;
                        $certificate->user_phone = $request->user_phone;
                        $certificate->course_type = $request->course_type;
                        $certificate->payment_type = $request->gateway;
                        $certificate->address1 = $request->std_address;
                        $certificate->address2 = $request->std_address2;
                        $certificate->city = $request->std_city;
                        $certificate->zipcode = $request->std_zipcode;
                        $certificate->country = $request->std_country;
                        $certificate->delivery_fee = $request->order_amount;
                        $certificate->transaction_id = $trans_id;
                        $certificate->status = $status;
                        $certificate->save();
                    }
                    sendEmail('certificate_fee_ack', array('name' => $user->name,
                        'email' => $user->email,
                        'to_email' => $user->email,
                        'course' => $item_name1,
                        'fee' => $mc_gross_1,
                        'contact' => $certificate->user_phone,
                        'address' => $certificate->address1,
                        'address2' => $certificate->address2,
                        'city' => $certificate->city,
                        'zipcode' => $certificate->zipcode,
                        'country' => $certificate->country,
                        'gateway' => $certificate->payment_type,
                        'orderid' => $orderid,
                        'url' => url('/')));
                    sendEmail('certificate_fee_admin', array('name' => $user->name,
                        'send_to' => 'admin',
                        'email' => $user->email,
                        'to_email' => $user->email,
                        'course' => $item_name1,
                        'fee' => $mc_gross_1,
                        'contact' => $certificate->user_phone,
                        'address' => $certificate->address1,
                        'address2' => $certificate->address2,
                        'city' => $certificate->city,
                        'zipcode' => $certificate->zipcode,
                        'country' => $certificate->country,
                        'gateway' => $certificate->payment_type,
                        'orderid' => $orderid,
                        'url' => url('/')));

                }else if ($package_type == 'retake-exam-fee') {

                    $arr = json_decode($transaction, true);
                    $request = (object)$arr;
                    $record = new App\ExamRetakeFee();
                    $user = Auth::user();
                    $user = User::find($request->user_id);
                    $record->user_id = $user->id;
                    $record->user_name = $request->user_name;
                    $record->user_email = $request->user_email;
                    $record->user_phone = $request->user_phone;
                    $record->course_id = $request->course_id;
                    $record->quiz_id = $request->quiz_id;
                    $record->course_type = $request->course_type;
                    $record->payment_type = $request->gateway;
                    $record->expected_exam_date = date("Y-m-d H:i:s", strtotime($request->retake_date));
                    $record->retake_fee = $order_amount;
                    $record->transaction_id = $transaction_id;
                    $record->save();

                }else if($package_type=='gift-lms'){

                    $course                             = LmsSeries::where('id', $request->itemid)->first();
                    $payment_course                     = new App\UserCourses();
                    $payment_course->item_id 		    = $request->itemid;
                    $payment_course->item_name 		    = $course->title;
                    $payment_course->item_price 		= $arr_body['transactions'][0]['amount']['total'];
                    $payment_course->item_quantity 		= 1;
                    $payment_course->instructor_id 		= $request->itemid;
                    $payment_course->user_id         = (isset(Auth::user()->id)) ? Auth::user()->id : 0;
                    $payment_course->payment_slug         = (App\Payment::select(["slug"])->where("item_id", $request->itemid)->where("user_id", Auth::user()->id)->latest()->first())->slug;
                    $payment_course->save();

//                    //FOR GIFT COURSE
//                    sendEmail('order_confirmation_ack', array('username'=> $user->name,
//                        'to_email' => $user->email,
//                        'orderid' =>$orderid,
//                        'date' => date("F j, Y", strtotime($order_date)),
//                        'ordertable' =>getOrderTable($token,$transaction),
//                        'address' =>getAddress($transaction),
//                        'name' => $user->name,
//                        'url' => url('/')  ));
//                    //FOR GENERAL COURSE ORDER ADMIN EMAIL
//                    sendEmail('order_confirmation_admin', array('username'=> $user->name,
//                        'to_email' => $user->email,
//                        'send_to' => 'admin',
//                        'orderid' =>$orderid,
//                        'date' => date("F j, Y", strtotime($order_date)),
//                        'ordertable' =>getOrderTable($token,$transaction),
//                        'address' =>getAddress($transaction),
//                        'name' => $user->name,
//                        'url' => url('/')  ));

                }else  if ($package_type == 'lms') {

                    \Cart::clear();
                    session()->forget('Coupon_code');
                    session()->forget('Coupon_value');
                    \Cookie::queue(\Cookie::forget('preurl'));
                    sendEmail('order_confirmation_ack', array('username' => $user->name,
                        'to_email' => $user->email,
                        'orderid' => $orderid,
                        'date' =>$order_date,
//                        'date' => date("F j, Y", strtotime($order_date)),
                        'ordertable' => getOrderTable($token, $transaction, $other_details),
                        'address' => getAddress($transaction),
                        'name' => $user->name,
                        'url' => url('/')));
                    sendEmail('order_confirmation_admin', array('username' => $user->name,
                        'to_email' => $user->email,
                        'send_to' => 'admin',
                        'orderid' => $orderid,
                        'date' =>$order_date,
//                        'date' => date("F j, Y", strtotime($order_date)),
                        'ordertable' => getOrderTable($token, $transaction, $other_details),
                        'address' => getAddress($transaction),
                        'name' => $user->name,
                        'url' => url('/')));

                }
                return redirect(URL_ORDER_THANKYOU . '?cost=' . $order_amount . '&ref=' . $orderid);

            } else {
                return abort(404);
            }
        }
        }catch (Exception $e){
            dd($e->getMessage());
        }
        // return redirect(URL_ORDER_THANKYOU.'?cost=' . $order_amount . '&ref=' .$orderid . "&method=paypal");

    }


    /********** Landing pages 19-07-2021 *********/
    public function promotionExcel()
    {
        $data['active_class']       = 'faqs';
        $data['title']              = 'Promotion Excel Free';
        //$rechaptcha_status    = getSetting('enable_rechaptcha','recaptcha_settings');
        //$data['rechaptcha_status']  = $rechaptcha_status;
        //$data['rechaptcha_status']  = "yes";
        $series=LmsSeries::where('status','=', 1)
            ->whereIn('slug',['free-microsoft-excel-2016-beginner','free-microsoft-excel-2016-intermediate','free-microsoft-excel-2016-advanced'])
            ->orderBy('id', 'asc')
            ->get();

        $data['series_excel']              =$series;
        $view_name = getTheme().'::site.promotion_excel';
        return view($view_name, $data);
    }
    public function promotionMakeup()
    {
        $data['active_class']       = 'faqs';
        $data['title']              = 'Promotion Makeup Free';
        //free-employability-skills-for-makeup
        $series=LmsSeries::where('status','=', 1)
            ->whereIn('slug',['free-employability-skills-for-makeup'])
            ->get();

        $data['series_makeup']              =$series;

        $view_name = getTheme().'::site.promotion_makeup';
        return view($view_name, $data);
    }

    public function PaymentExport(Request $request) {
//        return Excel::download(new PaymentsExport('2021-07-01', '2021-08-16'))->download('invoices.xlsx');
        return (new PaymentsExport($request->sdate, $request->edate, $request->paymentdateway, $request->plantype))->download('invoices.xlsx');
//        return (new PaymentsExport($request->sdate, $request->edate, $request->paymentdateway, $request->plantype))->download('invoices.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
//        return (new PaymentsExport('2021-07-01', '2021-08-16'))->download('invoices.xlsx');
    }

    public function APISingleUser($ID) {
        return App\User::where("id", $ID)->first();
    }

    public function APIGetAllUser()
    {
        return App\User::all();
    }

    public function APIAllCourses() {
        return App\LmsSeries::All();
    }

    public function APISingleCourse($ID) {
        return App\LmsSeries::find($ID);
    }

    public function APIFeaturesCourses() {
//        return App\User::where("id", 1)->first();
        return response(array(
            'success' => true,
            'data' => "Course Data",
            'message' => "Features Courses"
        ),200,[]);
    }


    public function APIsendEnquiry(Request $request)
    {

        $rules = array(
            'first_name' => 'bail|required|max:250|',
            'email' => 'bail|required|email',
            'msg'=>'required|max:250'
        );
        $customMessages = array(
            'first_name.required'=>'Name is required',
            'email.required'=>'Email is required',
            'msg.required'=>'Message is required',
        );

        $validator = Validator::make($request->all(), $rules, $customMessages);
        /******* Form Validation *****/
        if ($validator->fails()) {

            return response(array(
                'success' => true,
                'data' => $validator->errors(),
                'message' => "Validation Error"
            ),200,[]);
        }



        try {

            $record = new App\Enquiry();

            $record->course_id = $request->course_id;
            $record->first_name = $request->first_name;
            $record->last_name = $request->last_name;
            $name = $request->first_name;
            $record->name = $name;
            $record->email = $request->email;
            $record->message = $request->msg;
            $record->course_title = $request->course_title;
            $record->course_slug= $request->course_slug;
            $record->Subscribed = ($request->sub=='Yes')? '1' : '0' ;
            $record->enquiry_type= $request->enquiry_type;
            /********** subscription checked ********/
            if(isset($request->sub)) {
                $User = array(
                    'name' => $name,
                    'email'=> $request->email,
                );
                $User = (object)$User;
                App\Enquiry::insertSubscription($User);
            }
            /********** subscription checked ********/
            if(Auth::user()) {
                $record->user_id = Auth::user()->id;
            }
            $record->save();

//            if($request->course_slug!='') {
//
//                sendEmail('courseenquiry_admin', array('name' => $name,
//                    'send_to' => 'admin',
//                    'to_email' => $request->email,
//                    'phone' => $request->phone,
//                    'slug' => $request->course_slug,
//                    'subject' => $request->course_title,
//                    'message' => $request->msg, 'url' => BASE_PATH));
//                sendEmail('courseenquiry_ack', array('name' => $name,
//                    'to_email' => $request->email,
//                    'phone' => $request->phone,
//                    'slug' => $request->course_slug,
//                    'subject' => $request->course_title,
//                    'message' => $request->msg, 'url' => BASE_PATH));
//
//            }else{
//                sendEmail('generalenquiry_admin', array('name' => $name,
//                    'send_to' => 'admin',
//                    'to_email' => $request->email,
//                    'phone' => $request->phone,
//                    'enquiry_type' => $request->enquiry_type,
//                    'message' => $request->msg, 'url' => BASE_PATH));
//                sendEmail('generalenquiry_ack', array('name' => $name,
//                    'to_email' => $request->email,
//                    'phone' => $request->phone,
//                    'enquiry_type' => $request->enquiry_type,
//                    'message' => $request->msg, 'url' => BASE_PATH));
//
//            }
            $message = 'Thanks! Our team will contact you soon';

            return response(array(
                'success' => true,
                'data' => $record,
                'message' => $message
            ),200,[]);


        } catch (Exception $e) {
            return response(array(
                'success' => true,
                'data' => $e->getMessage(),
                'message' => 'Some issue in request process'
            ),200,[]);
        }
    }



    public function APIfrontSearchCourses(Request $request)
    {
        try{

            $cartCollection = \Cart::getContent();
            $cartTotalQuantity = \Cart::getTotalQuantity();
            $total = \Cart::getTotal();
            $data['total_quantity']     = $cartTotalQuantity;
            $data['total_amount']     = $total;
            $data['total_items']     = $cartCollection->count();;
            $data['cart_contents']     = $cartCollection;

            $data['key'] = 'home';
            $data['active_class'] = 'lms';
            $data['title'] = 'All Courses';



            $levels= $request->input('levels');
            $price_str= $request->input('price');
            if($price_str=="free")
                $price =str_replace("free","0",$price_str);
            elseif($price_str=="discounted")
                $price =str_replace("discounted","2,3",$price_str);
            else
                $price=$price_str;
            $materials= $request->input('materials');
            $rating= $request->input('rating');
            $duration= $request->input('duration');
            $search_term= $request->input('search_term');
            $last_filter= $request->input('last_filter');
            $sort= $request->input('sort');

            if($search_term=='all' || $search_term==''){
                if(env('APP_CACHE')){
                    $all_series      = LmsSeries::where("status","=",1);
                    $count_series = Cache::rememberForever('count_series', function () {
                        return LmsSeries::where('status', '=', 1)
                            ->get();
                    });
                }else{
                    $all_series      = LmsSeries::where("status","=",1);
                    $count_series = LmsSeries::where('status', '=', 1)
                        ->get();
                }



            }else{

                $all_series      = LmsSeries::where('title', 'Like','%'.$search_term.'%')
                    ->where("status","=",1);
                $count_series      = LmsSeries::where('title', 'Like','%'.$search_term.'%')
                    ->where("status","=",1)->get();
            }

            $data['count_series']   = $count_series;

            if($levels!="") {
                $all_series= $all_series->whereIn('level_id', explode(',',$levels));
            }
            if($price!="") {
                $all_series= $all_series->whereIn('is_paid', explode(',',$price));
            }

            if($materials!="") {
                $idsArr = explode(',',$materials);
                $all_series= $all_series->whereIn('course_tags',$idsArr);
            }

            if($rating!="") {

                $cids=App\Review::select('course_id')->groupBy('course_id')
                    ->having(DB::raw('AVG(rating)'), '>=', $rating);
                $all_series= $all_series->whereIn('id', $cids);



            }

            if($duration!="") {
                $arr=explode('-',$duration);
                $start=(int)$arr[0]*60;
                $end=(int)$arr[1]*60;

                $vid_duration = DB::table('lmscontents')
                    ->join('lmsseries_data', 'lmscontents.id', '=', 'lmsseries_data.lmscontent_id')
                    ->select('lmsseries_data.lmsseries_id')
                    ->groupBy('lmsseries_data.lmsseries_id')
                    ->having(DB::raw('SUM(lmscontents.video_length)'), '>', $start )
                    ->having(DB::raw('SUM(lmscontents.video_length)'), '<=', $end);

                $all_series= $all_series->whereIn('id', $vid_duration);
            }

            //$all_series= $all_series->paginate(20);
            $all_series= $all_series->paginate(24);

            $all_series->appends(['levels' => $levels]);
            $all_series->appends(['price' => $price_str]);
            $all_series->appends(['materials' => $materials]);
            $all_series->appends(['rating' => $rating]);
            $all_series->appends(['duration' => $duration]);
            $all_series->appends(['search_term' => $search_term]);
            $all_series->appends(['sort' => $sort]);

            if(isset($search_term)){
                $data['title']  = ucfirst($search_term);
                $data['lms_cat_slug'] = $request->search_term;
            }else{
                $data['title'] = 'Search Results ';
                $data['lms_cat_slug']="";
            }


            $data['all_series']   = $all_series;
            $data['discounts']  = $this->discounts;
            $data['ptitle'] ="";
            $data['plink']  ="";
            if(env('APP_CACHE')){
                $free_series = Cache::rememberForever('free_series', function () {
                    return LmsSeries::where('status','=', 1)->where('is_paid','=', 0)->paginate(24);
                });
            }else{
                $free_series      = LmsSeries::where('status','=', 1)->where('is_paid','=', 0)->paginate(24);

            }
            $free_series->appends(['levels' => $levels]);
            $free_series->appends(['price' => $price_str]);
            $free_series->appends(['materials' => $materials]);
            $free_series->appends(['rating' => $rating]);
            $free_series->appends(['duration' => $duration]);
            $free_series->appends(['search_term' => $search_term]);
            $free_series->appends(['sort' => $sort]);

            if(env('APP_CACHE')){
                $disc_series = Cache::rememberForever('disc_series', function () {
                    return LmsSeries::where('status','=', 1)->where('is_paid','>', 1)->OrderBy("updated_at", "desc")->paginate(24);
                });
            }else{
                $disc_series      = LmsSeries::where('status','=', 1)->where('is_paid','>', 1)->OrderBy("updated_at", "desc")->paginate(24);

            }
            $disc_series->appends(['levels' => $levels]);
            $disc_series->appends(['price' => $price_str]);
            $disc_series->appends(['materials' => $materials]);
            $disc_series->appends(['rating' => $rating]);
            $disc_series->appends(['duration' => $duration]);
            $disc_series->appends(['search_term' => $search_term]);
            $disc_series->appends(['sort' => $sort]);

            if(env('APP_CACHE')){
                $popular_series = Cache::rememberForever('popular_series', function () {
                    return LmsSeries::where('status','=', 1)->where('setpopular','=', 'yes')->paginate(24);
                });
            }else{
                $popular_series   = LmsSeries::where('status','=', 1)->where('setpopular','=', 'yes')->paginate(24);

            }

            $popular_series->appends(['levels' => $levels]);
            $popular_series->appends(['sort' => $sort]);
            $popular_series->appends(['materials' => $materials]);
            $popular_series->appends(['rating' => $rating]);
            $popular_series->appends(['duration' => $duration]);
            $popular_series->appends(['search_term' => $search_term]);



            if(env('APP_CACHE')){
                $new_series = Cache::rememberForever('new_series', function () {
                    return LmsSeries::where('status','=', 1)->where('is_paid','=', 1)->OrderBy("updated_at", "desc")->limit(24)->get();
                });
            }else{
                $new_series       = LmsSeries::where('status','=', 1)->where('is_paid','=', 1)->OrderBy("updated_at", "desc")->limit(24)->get();

            }

            if(env('APP_CACHE')){
                $levels = Cache::rememberForever('levels', function () {
                    return \App\LmsLevel::with('courses')->select(['name','id','slug','count'])->orderBy('name','ASC')->get();
                });
            }else{
                $levels      = \App\LmsLevel::with('courses')->select(['name','id','slug','count'])->orderBy('name','ASC')->get();

            }
            $data['levels']  = $levels;
            $data['free_series']  = $free_series;
            $data['popular_series']  = $popular_series;
            $data['disc_series']  = $disc_series;
            $data['new_series']  = $new_series;

            return response(array(
                'success' => true,
                'data' => $data,
                'message' => "Recent search result!"
            ),200,[]);

        } catch (Throwable $e) {
            report($e);
            return false;
        }

    }


    public function APIbrowseData($slug='',Request $request)
    {

        try{


            $cartCollection = \Cart::getContent();
            $cartTotalQuantity = \Cart::getTotalQuantity();
            $total = \Cart::getTotal();
            $data['total_quantity']     = $cartTotalQuantity;
            $data['total_amount']     = $total;
            $data['total_items']     = $cartCollection->count();;
            $data['cart_contents']     = $cartCollection;

            $subcats= $request->input('subcats');
            $levels= $request->input('levels');
            $price_str= $request->input('price');
            if($price_str=="free")
                $price =str_replace("free","0",$price_str);
            elseif($price_str=="discounted")
                $price =str_replace("discounted","2,3",$price_str);
            else
                $price=$price_str;
            $materials= $request->input('materials');
            $rating= $request->input('rating');
            $duration= $request->input('duration');
            $last_filter= $request->input('last_filter');

            $data['key'] = 'home';

            $data['active_class'] = 'lms';
            $lms_cates            = array();
            $lms_cates            = LmsSeries::getFreeSeries();

            $all_series           = array();

            if(count($lms_cates) && !$slug)
            {

                $firstOne        = $lms_cates[0];

                if(env('APP_CACHE')){
                    $all_series = Cache::rememberForever('all_series', function ($firstOne) {
                        return LmsSeries::where([['status','=', 1],['lms_category_id','=', $firstOne->id]])
                            ->orWhere([['status','=', 1],['lms_parent_category_id','=', $firstOne->id]])
                            ->paginate(9);
                    });
                }else{
                    $all_series      = LmsSeries::where([['status','=', 1],['lms_category_id','=', $firstOne->id]])
                        ->orWhere([['status','=', 1],['lms_parent_category_id','=', $firstOne->id]])
                        ->paginate(9);
                }




                $data['title']  = ucfirst($firstOne->category);

            }

            if($slug)
            {
                $category     = App\LmsCategory::where('slug',$slug)->first();
                if(!$category){
                    return abort(404);
                }else {
                    if ($category->parent_id != 0) {
                        $parent_cat = App\LmsCategory::where('id', $category->parent_id)->first();
                        return redirect('/courses/' . $parent_cat->slug . '?subcats=' . $category->id);
                        //courses/accounting-finance?subcats=115
                    }
                }

                if($subcats!=""){
                    $child_cats     = App\LmsCategory::where('parent_id',$category->id)
                        ->whereIn('id', explode(',',$subcats))->get();
                }else{
                    $child_cats     = App\LmsCategory::where('parent_id',$category->id)->get();
                }

                $data['lms_cates']    = $child_cats;

                if($subcats!="") {

                    $all_series = LmsSeries::where('status', '=', 1)
                        ->whereIn('lms_category_id', explode(',',$subcats));
                    $count_series = LmsSeries::where('status', '=', 1)
                        ->whereIn('lms_category_id', explode(',',$subcats));


                }else{


                    $all_series = LmsSeries::where('status', '=', 1)->where('lms_parent_category_id', '=', $category->id);
                    $count_series = LmsSeries::where('status', '=', 1)->where('lms_parent_category_id', '=', $category->id);



                }

                if($levels!="") {
                    $all_series= $all_series->whereIn('level_id', explode(',',$levels));
                    if($last_filter!='levels') {
                        $count_series = $count_series->whereIn('level_id', explode(',', $levels));
                    }
                }
                if($price!="") {
                    $all_series= $all_series->whereIn('is_paid', explode(',',$price));
                    if($last_filter!='price') {
                        $count_series = $count_series->whereIn('is_paid', explode(',', $price));
                    }
                }

                if($materials!="") {
                    $idsArr = explode(',',$materials);
                    $all_series= $all_series->whereIn('course_tags',$idsArr);
                    if($last_filter!='materials') {
                        $count_series = $count_series->whereIn('course_tags', $idsArr);
                    }
                }

                if($rating!="") {
                    $cids=App\Review::select('course_id')->groupBy('course_id')
                        ->having(DB::raw('AVG(rating)'), '>=', $rating);

                    $all_series= $all_series->whereIn('id', $cids);


                    $count_series = $count_series->whereIn('id', $cids);



                }

                if($duration!="") {
                    $arr=explode('-',$duration);
                    $start=(int)$arr[0]*60;
                    $end=(int)$arr[1]*60;

                    $vid_duration = DB::table('lmscontents')
                        ->join('lmsseries_data', 'lmscontents.id', '=', 'lmsseries_data.lmscontent_id')
                        ->select('lmsseries_data.lmsseries_id')
                        ->groupBy('lmsseries_data.lmsseries_id')
                        ->having(DB::raw('SUM(lmscontents.video_length)'), '>', $start )
                        ->having(DB::raw('SUM(lmscontents.video_length)'), '<=', $end);




                    $all_series= $all_series->whereIn('id', $vid_duration);

                    if($last_filter!='duration') {
                        $count_series = $count_series->whereIn('id', $vid_duration);
                    }

                }


                //$all_series= $all_series->paginate(20);
                $data['count_series']   = $count_series->get();
                $all_series= $all_series->paginate(24);
                //subcats=&levels=&price=&materials=&rating=4&duration=
                $all_series->appends(['subcats' => $subcats]);
                $all_series->appends(['levels' => $levels]);
                $all_series->appends(['price' => $price_str]);
                $all_series->appends(['materials' => $materials]);
                $all_series->appends(['rating' => $rating]);
                $all_series->appends(['duration' => $duration]);


                $data['title']  = ucfirst($category->category);
                if($category->parent_id !=0){
                    $pcategory     = App\LmsCategory::where('id',$category->parent_id)->first();
                    $ptitle=ucfirst($pcategory->category);
                    $plink=$pcategory->slug;

                }else{

                    $ptitle = ucfirst($category->category);
                    $plink= $category->slug;

                }
                $data['ptitle'] =$ptitle;
                $data['plink']  =$plink;
                $data['description']  =$category->description;
            }else{

                $data['ptitle'] ="";
                $data['plink']  ="";
                $data['description'] = "";
            }


            $data['all_series']   = $all_series;
            $data['lms_cat_slug'] = $slug;
            $data['discounts']  = $this->discounts;

            return response(array(
                'success' => true,
                'data' => $data,
                'message' => "Course based search result!"
            ),200,[]);

        } catch (Throwable $e) {
            report($e);

            return response(array(
                'success' => false,
                'data' => "Faild",
                'message' => "Search failed"
            ),200,[]);
        }
    }


    public function APICourseDetail($slug)
    {

        $data['key'] = 'home';

        $data['active_class'] = 'lms';
        $data['preview_mode'] = false;
        if(Auth::check()){
            $user=Auth::user();
        }

        if(Auth::check() && (getRoleData($user->role_id)=='admin' || getRoleData($user->role_id)=='owner')) {
            $lms_series   = LmsSeries::where('slug',$slug)->first();
            if($lms_series->status==0){
                $data['preview_mode'] = true;
            }

        }else{
            $lms_series   = LmsSeries::where('slug',$slug)->where('status',1)->first();
        }
        if(!$lms_series){
            return abort(404);
        }else{
            $parent=false;
            if($lms_series->lms_parent_category_id!=null || $lms_series->lms_parent_category_id!=0 ){
                $parent=true;
                $lms_parent_category = App\LmsCategory::where('id',$lms_series->lms_parent_category_id)->first();

            }
            $lms_category = App\LmsCategory::where('id',$lms_series->lms_category_id)->first();

            $lms_series_related=LmsSeries::where([['status','=', 1],['lms_parent_category_id','=', $lms_series->lms_category_id]])
                ->orWhere([['status','=', 1],['lms_category_id','=', $lms_series->lms_category_id]])
                ->whereNotIn('id', [$lms_series->id])
                ->groupBy('id')
                ->inRandomOrder()
                ->limit(10)
                ->get();

            if(count($lms_series_related)<4){
                $lms_series_related=LmsSeries::where('lms_parent_category_id',$lms_category->parent_id)
                    ->where('status','=',1)
                    ->whereNotIn('id', [$lms_series->id])
                    ->inRandomOrder()
                    ->groupBy('id')
                    ->limit(10)
                    ->get();
            }
            $excludeids="";
            foreach ($lms_series_related as $item){
                $excludeids.=$item->id.",";
            }
            $excludeids= rtrim($excludeids, ",");
            // dd( rtrim($excludeids, ","));
            //echo count($lms_series_related);



///OLD frequently_bought =====================================/////////////////
            $moresells = DB::table('user_courses')
                ->select('item_id', DB::raw('count(item_id) as total'))
                ->where('item_price','>',0 )
                ->groupBy('item_id')
                ->orderByDesc('total')
                ->limit(5);

            $frequently_bought = LmsSeries::where('status','=',1)
                ->joinSub($moresells, 'most_sells', function ($join) {
                    $join->on('lmsseries.id', '=', 'most_sells.item_id');
                })
                ->limit(5)
                ->get();
///OLD frequently_bought =====================================/////////////////


            $frequently_bought=LmsSeries::where([['status','=', 1],['lms_parent_category_id','=', $lms_series->lms_category_id]])
                ->orWhere([['status','=', 1],['lms_category_id','=', $lms_series->lms_category_id]])
                ->whereNotIn('id', [$lms_series->id])
                ->whereNotIn('id', explode(',',$excludeids))
                ->groupBy('id')
                ->inRandomOrder()
                ->limit(7)
                ->get();

            $data['already_purchased'] = false;
            $data['purchased_date'] = '';


            /*if(Auth::check()){
                $user_purchased = App\UserCourses::where('item_id',$lms_series->id)
                    ->where('user_id',Auth::user()->id)
                    ->first();
                if($user_purchased){
                    $data['already_purchased'] = true;
                    $data['purchased_date'] = date("M. d, Y",strtotime($user_purchased->created_at));
                }
            }*/



            $lms_sections = App\LmsSeriesSections::where('lmsseries_id',$lms_series->id)->get();
            $contents     = $lms_series->viewContents(9);
            $sections     = $lms_series->viewSections(9);

            $exams     = $lms_series->exams();
            $data['contents']     = $contents;
            //$data['sections']     = $lms_series->sections;
            $data['sections']     = $sections;
            $data['lms_sections']     = $lms_sections;
            $data['awardingbody']     = $lms_series->accreditedby;
            $data['lms_series']   = $lms_series;
            $data['title']        = ucfirst($lms_series->title);
            $data['image']         = $lms_series->image;

            $data['video']         = $lms_series->video;
            $data['desc']         = $lms_series->description;
            $data['number_of_reviews']         = $lms_series->number_of_reviews;
            $data['number_of_modules']         = $lms_series->number_of_modules;
            $data['desc']         = $lms_series->description;
            $data['short_desc']   = $lms_series->short_description;
            $lms_cates            = LmsSeries::getFreeSeries();
            $data['level']    = $lms_series->level;
            $data['lms_cates']    = $lms_cates;
            $data['lms_cat_slug'] = $lms_category->slug;
            $data['lms_cat_title'] = $lms_category->category;
            $data['parent_cat_status'] = $parent;
            if($parent) {
                $data['lms_parent'] = $lms_parent_category;
            }
            $data['discounts']  = $this->discounts;
            $data['lms_series_related'] = $lms_series_related;

            $data['frequently_bought'] = $frequently_bought;

            $data['edit_url']    = URL_LMS_SERIES_EDIT.$lms_series->slug;
            // dd($data);
            if(checkRole(getUserGrade(3)))  {
                $data['display_edit']    = true;

            }else{
                $data['display_edit']    = false;
            }
            //dd($data);
            return response(array(
                'success' => true,
                'data' => $data,
                'message' => "Course based search result!"
            ),200,[]);
        }

    }


    public function APIaddToCart(Request $request)
    {

        $id = request('id');
        $name = request('name');
        $price = request('price');
        $qty = request('qty');
        $slug = request('slug');
        $image = request('image');
        $customAttributes = [
            'image' => $image,
            'slug' => $slug,
            'currency' => session('currency_short'),
            'symbol' => session('currency_symbol')
        ];
        $data['already_purchased'] = "";


        \Cart::add($id, $name, $price, $qty, $customAttributes);


        $cartCollection = \Cart::getContent();
        // $cartCollection->count();
        $cartTotalQuantity = \Cart::getTotalQuantity();
        $total = \Cart::getTotal();
        $data['total_quantity']     = $cartTotalQuantity;
        $data['total_amount']     = round($total,2);
        $data['total_items']     = $cartCollection->count();

        $data['cart_contents']     = $cartCollection;
        $data['image']     = $image;
        $data['slug']     = $slug;
        $data['new_item']     = \Cart::get($id);


        return response(array(
            'success' => true,
            'data' => $data,
            'message' => "item added."
        ),200,[]);

    }





    public function APIremoveToCart(Request $request)
    {
        $id = request('id');
        \Cart::remove($id);


        $cartCollection = \Cart::getContent();
        // $cartCollection->count();
        $cartTotalQuantity = \Cart::getTotalQuantity();
        $total = \Cart::getTotal();
        $data['total_quantity']     = $cartTotalQuantity;
        $data['total_amount']     = round($total,2);
        $data['total_items']     = $cartCollection->count();

        $data['cart_contents']     = $cartCollection;
        $data['is_empty']     = \Cart::isEmpty();
        $message="item removed.";

        return response(array(
            'success' => true,
            'data' => $data,
            'message' => $message
        ),200,[]);

    }


    public function APIUpdateQuantity($ID, $QTY){

        \Cart::update($ID, array(
            'quantity' => array(
                'relative' => false,
                'value' => $QTY
            ),

        ));

        $data["itemID"] = $ID;
        $data["NewQTY"] = $QTY;

        return response(array(
            'success' => true,
            'data' => $data,
            'message' => "Cart Updated Successfully"
        ),200,[]);

    }

    public function APIWishlistAdd(Request $request)
    {
        $data['record']         	= FALSE;
        $data['active_class']       = 'wishlists';
        $data['title']              = 'My Wishlists';
        $data['layout']             = getLayout();
        $data['series']             = [];

        $user = Auth::user();
        $data['user']               = $request->uid;

        $wishlisOBJ             =   new Wishlist();


        $wishlisOBJ->course_id  =   $request->cid;
        $wishlisOBJ->user_id    =   $request->uid;

        $wishlisOBJ->save();

        $data['series']         =   Wishlist::latest()->first();


        return response(array(
            'success' => true,
            'data' => $data,
            'message' => "Add Course to wishlist Successfully"
        ),200,[]);


    }

    public function APICheckOut()
    {


        $cartCollection = \Cart::getContent();
        $cartTotalQuantity = \Cart::getTotalQuantity();
        $total = \Cart::getTotal();
        $data['total_quantity']     = $cartTotalQuantity;
        $data['total_amount']     = $total;
        $data['cart']     = $cartCollection;
        $data['total_items']     = $cartCollection->count();

        $cart   =   array();

        foreach ($cartCollection as  $key =>$item){
            $items[$key]['id']=$item->id;
            $items[$key]['name']=$item->name;
            $items[$key]['price']=$item->attributes->discounted_price ;
            $items[$key]['description']=$item->name;
            $items[$key]['quantity']=$item->quantity;

            $cart[]   =   $items;
        }

        $data['cart']   =   $cart;

        return response(array(
            'success' => true,
            'data' => $data,
            'message' => "Checkout page data."
        ),200,[]);

    }

    /********************* Knowledge Based ****************/
    public function KnowledgeBased()
    {
        $data['active_class']  = "multi_course";
        $data['title']  = "Course Voucher Redeem";
        $rechaptcha_status    = getSetting('enable_rechaptcha','recaptcha_settings');
        $data['rechaptcha_status']  = $rechaptcha_status;

        try {
            $view_name = getTheme().'::site.knowledgebased';
            return view($view_name, $data);
        } catch (Exception $e) {
            dd($e->getMessage());
        }

    }

    /************ Landing Pages *********/
    public function KnowledgePhlebotomy($slug="")
    {
        $data['active_class']  = "knowledgephlebotomy";
        $data['title']  = $slug=="introduction-to-phlebotomy-knowledge-based" ? "Introduction to Phlebotomy - Knowledge Based" : "Introduction to Phlebotomy - Knowledge Based";
        $data['lms_series']   = LmsSeries::where('slug',$slug)->where('status',1)->first();
        $data['lms_sections'] = App\LmsSeriesSections::where('lmsseries_id',($data['lms_series'])->id)->get();

        try {
            $tplname = $slug=="introduction-to-public-speaking" ? "publicspeaking" : "knowledgephlebotomy";
            $view_name = getTheme()."::site.$tplname";
            return view($view_name, $data);
        } catch (Exception $e) {
            dd($e->getMessage());
        }

    }

//    public function PublicSpeaking($slug="")
//    {
//        $data['active_class']  = "publicspeaking";
//        $data['title']  = "Introduction to Public Speaking";
//        $data['lms_series']   = LmsSeries::where('slug',$slug)->where('status',1)->first();
//
//        try {
//            $view_name = getTheme().'::site.publicspeaking';
//            return view($view_name, $data);
//        } catch (Exception $e) {
//            dd($e->getMessage());
//        }
//
//    }
    /************ Landing Pages *********/

    /********************* Knowledge Based ****************/

}
