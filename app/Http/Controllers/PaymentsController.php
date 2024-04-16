<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use \App;
use App\Quiz;
use App\Subject;
use App\QuestionBank;
use App\QuizCategory;
use App\ExamSeries;
use App\Certificate;
use App\LmsSeries;
use App\EmailTemplate;
use Razorpay\Api\Api;
use Yajra\Datatables\Datatables;
use DB;
use Auth;
use App\Paypal;
use App\PaypalExpress;
use App\Payment;
use Input;
use Softon\Indipay\Facades\Indipay;
//use Excel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Carbon;
use Exception;
use Response;
use URL;
use Session;
use Redirect;
use Validator;
use Darryldecode\Cart\CartCondition;
use Illuminate\Support\ServiceProvider;
use Stripe\Error\Card;
use Cartalyst\Stripe\Stripe;
use Omnipay\Omnipay;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Image;
use ImageSettings;
use File;



class PaymentsController extends Controller
{
    public $payment_records = [];
    public $gateway;
    public $restgateway;
    public $transaction_details = array();


    public function __construct()
    {



        $this->middleware('auth');
        $this->gateway = Omnipay::create('PayPal_Pro');
        if(getSetting('account_type','paypalpro')=='sandbox'){
            $this->gateway->setUsername(getSetting('sandbox_api_username','paypalpro'));
            $this->gateway->setPassword(getSetting('sandbox_api_password','paypalpro'));
            $this->gateway->setSignature(getSetting('sandbox_api_signature','paypalpro'));
            $this->gateway->setTestMode(true);
        }else{
            $this->gateway->setUsername(getSetting('api_username','paypalpro'));
            $this->gateway->setPassword(getSetting('api_password','paypalpro'));
            $this->gateway->setSignature(getSetting('api_signature','paypalpro'));
            $this->gateway->setTestMode(false);
        }


        $this->restgateway = Omnipay::create('PayPal_Rest');
        if(getSetting('account_type','paypalsmart')=='sandbox') {
            $this->restgateway->setClientId(getSetting('paypal_clientid_sandbox', 'paypalsmart'));
            $this->restgateway->setSecret(getSetting('paypal_secretkey_sandbox', 'paypalsmart'));
            $this->restgateway->setTestMode(true); //set it to 'false' when go live
        }else{
            $this->restgateway->setClientId(getSetting('paypal_clientid', 'paypalsmart'));
            $this->restgateway->setSecret(getSetting('paypal_secretkey', 'paypalsmart'));
            $this->restgateway->setTestMode(false); //set it to 'false' when go live

        }


    }

    /**
     * This method displays the payment transactions made by the user
     * The user info is accessed by the provided slug
     * @param  [type] $slug [description]
     * @return [type]       [description]
     */
    public function index($slug = "isadmin")
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

        $view_name = getTheme().'::student.payments.list';
        return view($view_name, $data);
    }

    public function getDatatable($slug = "isadmin")
    {

        $is_parent = 0;
        if($slug != "isadmin") {
            $user = getUserWithSlug($slug);
        } else {
            $user = getAdminWithSlug();
        }
        $user=Auth::user();
        // dd(getRoleData($user->role_id));
        if(getRoleData($user->role_id)=='parent')
        {
            $is_parent = 1;
            $childs_list = App\User::where('parent_id','=',$user->id)->get();

            $records = Payment::join('users', 'users.id','=','payments.user_id')
                ->where('users.parent_id','=',$user->id)
                ->select(['users.image', 'users.name', 'payments.id as pid', 'item_name', 'plan_type', 'start_date', 'end_date', 'payment_gateway','payments.updated_at','payment_status','payments.cost', 'payments.after_discount', 'payments.paid_amount','payments.id' ]);

            $ind = 0;
            foreach($childs_list as $child) {
                if($ind++ ==0) {
                    $records->where('user_id', '=', $child->id);
                    continue;
                }

                $records->orWhere('user_id', '=', $child->id);
            }

            $records->orderBy('updated_at', 'desc');
        }

        else if(getRoleData($user->role_id)=='admin' || getRoleData($user->role_id)=='owner') {

            $records= Payment::query()->with('user')->orderBy('updated_at', 'desc');
       /* $records__ = Payment::with('user')->join('users', 'users.id','=','payments.user_id')
            ->select(['item_name', 'plan_type', 'start_date', 'end_date', 'payment_gateway','currency_icon', 'transaction_id', 'payments.updated_at as order_updated_at', 'payments.created_at as order_created_at','payment_status','payments.id as pid','cost','actual_cost', 'after_discount', 'discount_amount', 'paid_amount', 'users.name as username', 'users.slug as userslug', 'users.id as userid'])
            ->orderBy('order_updated_at', 'desc');*/
    } else {

            $records= Payment::query()->with('user')->where('user_id', '=', $user->id)->orderBy('updated_at', 'desc');

        /*$records = Payment::with('user')->select(['item_name', 'plan_type', 'start_date', 'end_date','currency_icon', 'payments.updated_at as order_updated_at', 'users.slug as userslug', 'payment_gateway', 'transaction_id', 'payments.created_at  as order_created_at','payment_status','payments.id as pid','cost','actual_cost', 'after_discount', 'discount_amount', 'paid_amount'])
            ->join('users', 'users.id','=','payments.user_id')
            ->where('user_id', '=', $user->id)
            ->orderBy('order_updated_at', 'desc');*/
    }



        $dta = Datatables::of($records)

            ->addColumn('action', function ($records) {
                if(!($records->payment_status==PAYMENT_STATUS_CANCELLED || $records->payment_status==PAYMENT_STATUS_PENDING)) {
                    $link_data = ' <a >View More</a>';
                    return $link_data;
                }
                return ;
            })
            ->editColumn('payment_status',function($records){

                $rec = '';
                if($records->payment_status==PAYMENT_STATUS_CANCELLED)
                    $rec = '<span class="label label-danger">'.ucfirst($records->payment_status).'</span>';
                elseif($records->payment_status==PAYMENT_STATUS_PENDING)
                    $rec = '<span class="label label-info">'.ucfirst($records->payment_status).'</span>';
                elseif($records->payment_status==PAYMENT_STATUS_SUCCESS)
                    $rec = '<span class="label label-success">'.ucfirst($records->payment_status).'</span>';
                return $rec;
            })
            ->editColumn('item_name', function($records)
            {
                //$arr=explode(',',$records->item_name);
                //dd($arr);
                $user=Auth::user();
//            $username='';
//            if(getRoleData($user->role_id)=='admin' || getRoleData($user->role_id)=='owner') {
//                $username='<br><a href="'.URL_USER_DETAILS.$records->username.'"> '.$records->username.'</a>';
//            }

            if(strpos($records->item_name,',')) {
                $short=substr($records->item_name, 0, strpos($records->item_name,','));
                $more=substr($records->item_name, strpos($records->item_name,',')+1);
                $more=str_replace(',','<br>',$more);
                return  $short. '...<a id="link_'.$records->id.'" href="javascript:void(0);" onclick="showmore('.$records->id.')" class="show_hide_'.$records->id.'" data-content="toggle-text">more</a><div id="more_'.$records->id.'" style="display:none;" class="content_'.$records->id.'">' . $more . '</div>';


                }else{
//                return $records->item_name.$username;
                    return $records->item_name;
                }
            })
            ->editColumn('user_id', function($records)
            {
                 $username='';
                $user=Auth::user();
                if(getRoleData($user->role_id)=='admin' || getRoleData($user->role_id)=='owner') {
                    $username=(isset($records->user)? '<a href="'.URL_USER_DETAILS.$records->user->slug.'">'.$records->user->name.'</a>':'N/A');
//                  $username='<a href="'.URL_USER_DETAILS.$records->userslug.'"> '.$records->username.'</a>';
                }else{
                    $username="Self";
                }
                return $username;
            })
            ->editColumn('id', function($records)
            {
                return '<a target="_blank" href="'.URL_ORDER_THANKYOU.'?ref='.$records->id.'">'.$records->id.'</a>';
            })

        ->editColumn('created_at', function($records)
        {
        	//return timeago($records->created_at->diffForHumans());
            	//return time_elapsed_string(strtotim($records->created_at));
            	return timeago__($records->updated_at);
        })
//            ->editColumn('actual_cost', function($records)
//            {
//                return getCurrencyCode($records->currency_icon).$records->actual_cost;
//            })
//            ->editColumn('discount_amount', function($records)
//            {
//                return getCurrencyCode($records->currency_icon).$records->discount_amount;
//            })
            ->editColumn('paid_amount', function($records)

            {
                return getCurrencyCode($records->currency_icon).$records->paid_amount;
            })



            ->rawColumns(['payment_status','actual_cost','user_id','id','item_name','discount_amount','paid_amount','created_at','action'])

            ->removeColumn('action');


        if($is_parent) {
            $dta = $dta->editColumn('image', function($records) {
                return '<img src="'.getProfilePath($records->image).'"  /> ';
            })
                ->editColumn('name', function($records)
                {
                    return ucfirst($records->name);
                });
        }
        /*$dta->filterColumn('id', function($query, $keyword) {
        $query->whereRaw("id = ", ["{$keyword}"]);
    });*/

        return $dta->make(true);
    }


    public function GetReports($slug = "isadmin")
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


        $data['user']       		= $user;
        $data['active_class']       = 'orders';
        $data['title']              = getPhrase('orders_list');
        $data['layout']              = getLayout();


        $view_name = getTheme().'::reports.payments.list';
        return view($view_name, $data);
    }

    public function getDatatableList($slug = "isadmin")
    {

        $is_parent = 0;
        if($slug != "isadmin") {
            $user = getUserWithSlug($slug);
        } else {
            $user = getAdminWithSlug();
        }
        $user=Auth::user();
        // dd(getRoleData($user->role_id));
        if(getRoleData($user->role_id)=='parent')
        {
            $is_parent = 1;
            $childs_list = App\User::where('parent_id','=',$user->id)->get();

            $records = Payment::join('users', 'users.id','=','payments.user_id')
                ->where('users.parent_id','=',$user->id)
                ->select(['users.image', 'users.name', 'payments.id as pid', 'item_name', 'plan_type', 'start_date', 'end_date', 'payment_gateway','payments.updated_at','payment_status','payments.cost', 'payments.after_discount', 'payments.paid_amount','payments.id' ]);

            $ind = 0;
            foreach($childs_list as $child) {
                if($ind++ ==0) {
                    $records->where('user_id', '=', $child->id);
                    continue;
                }

                $records->orWhere('user_id', '=', $child->id);
            }

            $records->orderBy('updated_at', 'desc');
        }

        else if(getRoleData($user->role_id)=='admin' || getRoleData($user->role_id)=='owner') {


            $records = Payment::with('user')->join('users', 'users.id','=','payments.user_id')
                ->select(['item_name', 'plan_type', 'start_date', 'end_date', 'payment_gateway','currency_icon', 'transaction_id', 'payments.updated_at as order_updated_at', 'payments.created_at as order_created_at','payment_status','payments.id as pid','cost','actual_cost', 'after_discount', 'discount_amount', 'paid_amount', 'users.name as username', 'users.slug as userslug', 'users.id as userid'])
                ->orderBy('order_updated_at', 'desc');
        } else {

            $records = Payment::with('user')->select(['item_name', 'plan_type', 'start_date', 'end_date','currency_icon', 'payments.updated_at as order_updated_at', 'users.slug as userslug', 'payment_gateway', 'transaction_id', 'payments.created_at  as order_created_at','payment_status','payments.id as pid','cost','actual_cost', 'after_discount', 'discount_amount', 'paid_amount'])
                ->join('users', 'users.id','=','payments.user_id')
                ->where('user_id', '=', $user->id)
                ->orderBy('order_updated_at', 'desc');
        }



        $dta = Datatables::of($records)

            ->addColumn('action', function ($records) {
                if(!($records->payment_status==PAYMENT_STATUS_CANCELLED || $records->payment_status==PAYMENT_STATUS_PENDING)) {
                    $link_data = ' <a >View More</a>';
                    return $link_data;
                }
                return ;
            })
            ->editColumn('payment_status',function($records){

                $rec = '';
                if($records->payment_status==PAYMENT_STATUS_CANCELLED)
                    $rec = '<span class="label label-danger">'.ucfirst($records->payment_status).'</span>';
                elseif($records->payment_status==PAYMENT_STATUS_PENDING)
                    $rec = '<span class="label label-info">'.ucfirst($records->payment_status).'</span>';
                elseif($records->payment_status==PAYMENT_STATUS_SUCCESS)
                    $rec = '<span class="label label-success">'.ucfirst($records->payment_status).'</span>';
                return $rec;
            })
            ->editColumn('item_name', function($records)
            {

                if(strpos($records->item_name,',')) {
                    $short=substr($records->item_name, 0, strpos($records->item_name,','));
                    $more=substr($records->item_name, strpos($records->item_name,',')+1);
                    $more=str_replace(',','<br>',$more);
                    return  $short. '...<a id="link_'.$records->id.'" href="javascript:void(0);" onclick="showmore('.$records->pid.')" class="show_hide_'.$records->pid.'" data-content="toggle-text">more</a><div id="more_'.$records->pid.'" style="display:none;" class="content_'.$records->pid.'">' . $more . '</div>';


                }else{
                    return $records->item_name;
                }
            })
            ->editColumn('order_by', function($records)
            {
                $username='';
                $user=Auth::user();
                if(getRoleData($user->role_id)=='admin' || getRoleData($user->role_id)=='owner') {
                    $username='<a href="'.URL_USER_DETAILS.$records->userslug.'"> '.$records->username.'</a>';
                }else{
                    $username="Self";
                }
                return $username;
            })
            ->editColumn('pid', function($records)
            {
                return '<a target="_blank" href="'.URL_ORDER_THANKYOU.'?ref='.$records->pid.'">'.$records->pid.'</a>';
            })

            ->editColumn('order_created_at', function($records)
            {
                return timeago__($records->order_created_at);
            })

            ->editColumn('paid_amount', function($records)

            {
                return getCurrencyCode($records->currency_icon).$records->paid_amount;
            })



            ->rawColumns(['payment_status','actual_cost','order_by','pid','item_name','discount_amount','paid_amount','order_created_at','action'])
            ->removeColumn('action');


        if($is_parent) {
            $dta = $dta->editColumn('image', function($records) {
                return '<img src="'.getProfilePath($records->image).'"  /> ';
            })
                ->editColumn('name', function($records)
                {
                    return ucfirst($records->name);
                });
        }

        return $dta->make();
    }

    /**
     * This method identifies the type of package user is requesting and redirects to the payment gateway
     * The payments are categorized to 3 modules
     * 1) Combo -- Contains the items related to test series [it may have exams or study materials]
     * 2) LMS  -- It only contains Study materials
     * 3) EXAM -- It only contains single exams package
     * @param  [type] $type ['combo', 'lms', 'exam']
     * @param  [type] $slug [description]
     * @return [type]       [description]
     */


    public function postPaymentWithPayPalPro(Request $request)
    {
        if(Auth::check()) {
            $user = Auth::user();

        }else{
            $user_id = createUserRecord($request);
            Auth::loginUsingId($user_id);
            $user = Auth::user();
        }

        $input = $request->all();

        $messages = [
            'required' => 'The :attribute field is required.',
        ];
        $validator = Validator::make($request->all(), [
            'card_no' => 'required',
            'ccExpiryMonth' => 'required',
            'ccExpiryYear' => 'required',
            'cvvNumber' => 'required',
            //'amount' => 'required',
        ],$messages);


        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator->errors())->withInput();
//            return redirect()->back()->withInput();;

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
                $response = $this->gateway->purchase([
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
                // Process response



            if ($response->isSuccessful()) {


                    // Payment was successful
                    $arr_body = $response->getData();
                    $amount = $arr_body['AMT'];
                    $currency = $arr_body['CURRENCYCODE'];
                    $transaction_id = $arr_body['TRANSACTIONID'];
                    $other_details['transaction_id']=$transaction_id;
                    $other_details['currency']=$currency;
                    $other_details['currency_icon']=session('currency_symbol');
                    $other_details['admin_comments']=$first_name.' '.$last_name.' bought this course online with credit card '.$request->gateway;
                    $this->transaction_details=$other_details;
                  //  echo "Payment of $amount $currency is successful. Your Transaction ID is: $transaction_id";




                /**
                 * Write Here Your Database insert logic.
                 */
                $item=$request;
                $type=$request->type;
                $payment_gateway=$request->gateway;


                    $token = $this->preserveBeforeSave($item,$type, $payment_gateway, $other_details);


                    if($this->paymentSuccess($request, $token))
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
                            $this->studentIdCardSave($request);
                        }else if($request->type=='certificate-fee'){
                            $this->certificateSavePayPalPro($request);

                                sendEmail('certificate_fee_ack', array('name' => $request->user_name,
                                    'email' => $request->user_email,
                                    'to_email' => $request->user_email,
                                    'course' => $request->course_title,
                                    'fee' => $request->order_amount,
                                    'contact' => $request->user_phone,
                                    'address' => $request->address,
                                    'address2' => $request->address2,
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
                                    'address' => $request->address,
                                    'address2' => $request->address2,
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
                                'ordertable' =>getOrderTable($token,$transaction),
                                'address' =>getAddress($transaction),
                                'name' => $user->name,
                                'url' => url('/')  ));
                            //FOR GENERAL COURSE ORDER ADMIN EMAIL
                            sendEmail('order_confirmation_admin', array('username'=> $user->name,
                                'to_email' => $user->email,
                                'send_to' => 'admin',
                                'orderid' =>$orderid,
                                'date' => date("F j, Y", strtotime($order_date)),
                                'ordertable' =>getOrderTable($token,$transaction),
                                'address' =>getAddress($transaction),
                                'name' => $user->name,
                                'url' => url('/')  ));
                        }else{


                        //FOR GENERAL COURSE ORDER ACKNOWLEDGMENT EMAIL
                        sendEmail('order_confirmation_ack', array('username'=> $user->name,
                            'to_email' => $user->email,
                            'orderid' =>$orderid,
                            'date' => date("F j, Y", strtotime($order_date)),
                            'ordertable' =>getOrderTable($token,$transaction,$other_details),
                            'address' =>getAddress($transaction),
                            'name' => $user->name,
                            'url' => url('/')  ));
                        //FOR GENERAL COURSE ORDER ADMIN EMAIL
                        sendEmail('order_confirmation_admin', array('username'=> $user->name,
                            'to_email' => $user->email,
                            'send_to' => 'admin',
                            'orderid' =>$orderid,
                            'date' => date("F j, Y", strtotime($order_date)),
                            'ordertable' =>getOrderTable($token,$transaction,$other_details),
                            'address' =>getAddress($transaction),
                            'name' => $user->name,
                            'url' => url('/')  ));


                        \Cart::clear();
                        \Cookie::queue(\Cookie::forget('preurl'));
                    }
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
                toastr()->warning('Payment failed: '.$response->getMessage());
                return Redirect::back()->with('message',$response->getMessage());
                //return redirect('/checkout');
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

    }
    public function postPaymentWithStripeStudent(Request $request)
    {

        // dd($request);
        $validator = Validator::make($request->all(), [
            'card_no' => 'required',
            'ccExpiryMonth' => 'required',
            'ccExpiryYear' => 'required',
            'cvvNumber' => 'required',
            //'amount' => 'required',
        ]);
        $input = $request->all();
        if ($validator->passes()) {

            $input = array_except($input,array('_token'));
            try {
                \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
                $token = \Stripe\Token::create(array(
                    "card" => array(
                        'number' => $request->get('card_no'),
                        'exp_month' => $request->get('ccExpiryMonth'),
                        'exp_year' => $request->get('ccExpiryYear'),
                        'cvc' => $request->get('cvvNumber'),
                        'name' => $request->get('card_name')
                    )));



                $other_details = array();
                $other_details['is_coupon_applied'] = $request->is_coupon_applied;
                $other_details['actual_cost'] 		  = $request->actual_cost;
                $other_details['discount_availed'] 	= $request->discount_availed;
                $other_details['after_discount']    = $request->after_discount;
                $other_details['coupon_id']         = $request->coupon_id;
                $token_id=$token->id;





                if (!isset($token_id)) {
                    $view_name = getTheme().'::site.paywithstripe';
                    return redirect()->route($view_name);
//                    return redirect()->route('addmoney.paywithstripe');
                }


                $customer =  \Stripe\Customer::create([
                    'email' => $request->email,
                    'name' => $request->first_name.' '.$request->last_name,
                    'source' => $token_id
                ]);

                $customer_id=$customer->id;
                //              $customer = \Stripe\Customer::retrieve($customer_id);
                //              $customer->sources->create(["source" => $token_id]);

                $charge = \Stripe\Charge::create([
                    'customer' =>$customer_id,
                    'currency' => 'GBP',
                    'amount' =>$request->get('order_amount')*100,
                    'description' => 'Add in wallet',
                ]);

                if($charge['status'] == 'succeeded') {
                    /**
                     * Write Here Your Database insert logic.
                     */
                    $item=$request;
                    $type=$request->type;
                    $payment_gateway=$request->gateway;

                    $token = $this->preserveBeforeSave($item,$type, $payment_gateway, $other_details);
                    $user = Auth::user();

                    if($this->paymentSuccessStripe($request, $token))
                    {
                        //PAYMENT RECORD UPDATED SUCCESSFULLY
                        //PREPARE SUCCESS MESSAGE
                        $email_template = 'subscription_success';
                        $template    = new EmailTemplate();
                        $content_data =  $template->sendEmailNotification($email_template,
                            array('username' =>$user->name,
                                'plan'     => 'lms',
                                'to_email' => $user->email));

                        try {

                            $user->notify(new \App\Notifications\UsersNotifcations($user,$content_data));

                        } catch (Exception $e) {

                        }

                        flash('success', 'your_subscription_was_successfull', 'success');

                        // sendEmail($email_template, array('username'=>$user->name,
                        // 'plan' => $package_name,
                        // 'to_email' => $user->email));

                    }
                    else {
                        //PAYMENT RECORD IS NOT VALID
                        //PREPARE METHOD FOR FAILED CASE
                        pageNotFound();
                    }
                    //REDIRECT THE USER BY LOADING A VIEW

                    $this->studentIdCardSave($request);
//                    return redirect(URL_PAYMENTS_LIST.$user->slug);
//                    toastr()->success('Email has been submitted, Thanks!');
                    return redirect('/student-id-card?success=suc#card-area');


                    //$view_name = getTheme().'::site.paywithstripe';
//                    return redirect()->route($view_name);
                    // return redirect()->route('addmoney.paywithstripe').http_build_query(['token' => $token], null, '&', PHP_QUERY_RFC3986);
                } else {
                    \Session::put('error','Money not add in wallet!!');
                    $view_name = getTheme().'::site.paywithstripe';
                    return redirect()->route($view_name);
// return redirect()->route('addmoney.paywithstripe');
                }
            } catch (Exception $e) {
                \Session::put('error',$e->getMessage());
                print($e->getMessage());
                // return redirect()->route('addmoney.paywithstripe');
            } catch(\Cartalyst\Stripe\Exception\CardErrorException $e) {
                print($e->getMessage());
                \Session::put('error',$e->getMessage());
                //  return redirect()->route('addmoney.paywithstripe');
            } catch(\Cartalyst\Stripe\Exception\MissingParameterException $e) {
                print($e->getMessage());
                \Session::put('error',$e->getMessage());
                //   return redirect()->route('addmoney.paywithstripe');
            }
        }
    }

    public function stripe_success(Request $request)
    {


        $user = Auth::user();
        //  $response = $request->all();

        // dd($request);


        if($this->paymentSuccess($request))
        {
            //PAYMENT RECORD UPDATED SUCCESSFULLY
            //PREPARE SUCCESS MESSAGE
//            $email_template = 'subscription_success';
//            $template    = new EmailTemplate();
//           $content_data =  $template->sendEmailNotification($email_template,
//          array('username' =>$user->name,
//                   'plan'     => $payment_record->plan_type,
//                   'to_email' => $user->email));

            try {

                $user->notify(new \App\Notifications\UsersNotifcations($user,$content_data));

            } catch (Exception $e) {

            }

            flash('success', 'your_subscription_was_successfull', 'success');

            // sendEmail($email_template, array('username'=>$user->name,
            // 'plan' => $package_name,
            // 'to_email' => $user->email));

        }
        else {
            //PAYMENT RECORD IS NOT VALID
            //PREPARE METHOD FOR FAILED CASE
            pageNotFound();
        }
        //REDIRECT THE USER BY LOADING A VIEW

        return redirect(URL_PAYMENTS_LIST.$user->slug);

    }


    /**
     * This method returns the object details
     * @param  [type] $type [description]
     * @param  [type] $slug [description]
     * @return [type]       [description]
     */
    public function getPackageDetails($type, $slug)
    {
        return $this->getmodelName($type,$slug);
    }

    /**
     * This method returns the Class based on the type of request
     * @param  [type] $type [description]
     * @return [type]       [description]
     */
    public function getModelName($type, $slug)
    {
        switch($type)
        {
            case 'combo':
                return ExamSeries::where('slug', '=', $slug)->first();
                break;
            case 'lms':
                return LmsSeries::where('slug', '=', $slug)->first();
                break;
            case 'exam':
                return Quiz::where('slug', '=', $slug)->first();
                break;
        }

        return null;
    }


    public function paypal_cancel()
    {

        if($this->paymentFailed())
        {
            //FAILED PAYMENT RECORD UPDATED SUCCESSFULLY
            //PREPARE SUCCESS MESSAGE
            flash('Ooops...!', 'your_payment_was cancelled', 'overlay');
        }
        else {
            //PAYMENT RECORD IS NOT VALID
            //PREPARE METHOD FOR FAILED CASE
            pageNotFound();
        }

        //REDIRECT THE USER BY LOADING A VIEW
        $user = Auth::user();
        return redirect(URL_PAYMENTS_LIST.$user->slug);

    }

    public function paypalExpressProcess()
    {
        try {
            $paypal = new PaypalExpress();
            // Get payment info from URL
            $paymentID = $_GET['paymentID'];
            $token = $_GET['token'];
            $payerID = $_GET['payerID'];
            $productID = $_GET['pid'];
            $orderid = $_GET['orderid'];
            $arr=explode('-',$orderid);
            $course_id=$arr[0];

            $quiz_id=$arr[2];
            // Validate transaction via PayPal API
            $paymentCheck = $paypal->validate($paymentID, $token, $payerID, $productID);

            // If the payment is valid and approved
            if($paymentCheck && $paymentCheck->state == 'approved') {

                // Get the transaction data
                $id = $paymentCheck->id;
                $state = $paymentCheck->state;
                $payerFirstName = $paymentCheck->payer->payer_info->first_name;
                $payerLastName = $paymentCheck->payer->payer_info->last_name;
                $payerName = $payerFirstName . ' ' . $payerLastName;
                $payerEmail = $paymentCheck->payer->payer_info->email;
                $payerID = $paymentCheck->payer->payer_info->payer_id;
                $payerCountryCode = $paymentCheck->payer->payer_info->country_code;
                $paidAmount = $paymentCheck->transactions[0]->amount->details->subtotal;
                $currency = $paymentCheck->transactions[0]->amount->currency;
                $description = $paymentCheck->transactions[0]->description;
                $custom = $paymentCheck->transactions[0]->custom;
                $arr=explode('-',$custom);
                $course_id=$arr[0];
                $user_id=$arr[1];
                $quiz_id=$arr[2];


                $retake_recrod = App\ExamRetakeFee::where('user_id','=',$user_id)
                    ->where('course_id','=',$course_id)
                    ->where('quiz_id','=',$quiz_id)
                    ->where('attempt_status','=','no')->first();


                if(!$retake_recrod) {
                    $payment_record = new Payment();
                    $payment_record->slug = str_slug(getHashCode());
                    $payment_record->item_id = $custom;
                    $payment_record->item_name = $description;
                    $payment_record->plan_type = 'retake_exam_fee';
                    $payment_record->payment_gateway = 'paypalexpress';
                    $payment_record->cost = $paidAmount;
                    $payment_record->actual_cost = $paidAmount;
                    $payment_record->user_id = $user_id;
                    $daysToAdd = '365 days';
                    $payment_record->start_date = date('Y-m-d');
                    $payment_record->end_date = date('Y-m-d', strtotime($daysToAdd));
                    $payment_record->transaction_id = $id;
                    $payment_record->paid_amount = $paidAmount;
                    $payment_record->paid_by = $payerEmail;
                    $payment_record->currency = $payerCountryCode;
                    $payment_record->currency_icon = 'fa fa-gbp';
                    $payment_record->payment_status = PAYMENT_STATUS_SUCCESS;
                    $payment_record->coupon_applied = 0;
                    $payment_record->coupon_id = 0;
                    $payment_record->transaction_record = json_encode($paymentCheck->payer);
                    $payment_record->save();
                    /********* Insert Record Into DB ***********/
                    $record = new App\ExamRetakeFee();
                    $user = Auth::user();
                    $record->user_id = $user_id;
                    $record->user_name = $user->name;
                    $record->user_email = $user->email;
                    $record->user_phone = $user->phone;
                    $record->course_id = $course_id;
                    $record->quiz_id = $quiz_id;
                    $record->payment_type = 'paypalexpress';
                    $record->retake_fee = $paidAmount;
                    $record->transaction_id = $id;
                    $record->save();
                    /*sendEmail('order_confirmation_short_ack', array('username' => $user->name,
                        'to_email' => $user->email,
                        'orderid' => $orderid,
                        'date' => $order_date,
                        'coursetitle' => $package_name,
                        'price' => $order_amount,
                        'totalprice' => $order_amount,
                        'currency' => $currency,
                        'url' => url('/')));
                    sendEmail('order_received_short_admin', array('username' => $user->name,
                        'send_to' => 'admin',
                        'to_email' => $user->email,
                        'orderid' => $orderid,
                        'date' => $order_date,
                        'coursetitle' => $package_name,
                        'price' => $order_amount,
                        'totalprice' => $order_amount,
                        'currency' => $currency,
                        'url' => url('/')));*/
                    $orderid = makeOrderID($payment_record->id);
                    return redirect(URL_ORDER_THANKYOU . '?cost=' . $paidAmount . '&ref=' . $orderid . "&method=paypalexpress");
                }else{
                    $payment_record = Payment::where('transaction_id', '=', $retake_recrod->transaction_id)->first();
                    $orderid = makeOrderID($payment_record->id);
                    return redirect(URL_ORDER_THANKYOU . '?cost=' . $retake_recrod->retake_fee. '&ref=' . $orderid . "&method=paypalexpress");
                }
            }else{
                return redirect('/retake_exam_fee/'.$course_id.'/'.$quiz_id);

            }
        }catch (Exception $e){
            dd($e->getMessage());
        }


    }

    public function retakeExamFee($cid,$qid)
    {

        $data['active_class']       = 'faqs';
        $data['title']              = 'Retake Exam Fee';

        if(isset($cid) && isset($qid)){
            $records = DB::table('quizresults')
                ->join('quizzes', 'quizresults.quiz_id', '=', 'quizzes.id')
                ->join('lmsseries_exams', 'quizresults.quiz_id', '=', 'lmsseries_exams.exam_quiz_id')
                ->select('quizresults.*', 'lmsseries_exams.exam_type', 'quizzes.title')
                ->where('lmsseries_exams.lmsseries_id','=',$cid)
                ->where('lmsseries_exams.exam_quiz_id','=',$qid)
                ->first();


            $courses = \App\LmsSeries::select(['title', 'image', 'is_paid', 'status'])
                ->where('id',$cid)
                //->where('is_paid','>=',1)
                ->where('status',1)
                ->first();
            //dd($courses);
            if(isset($records) && isset($courses)){
                $data['cid']=$cid;
                $data['course_title']=$courses->title;
                $data['course_id']=$cid;
                $data['quiz_id']=$qid;
                $view_name = getTheme().'::site.retake_exam_fee';
                return view($view_name, $data);

            }else{
                return abort(404);

            }

        }else{ return abort(404);
        }
    }

    public function certificateFee($cid)
    {

        $data['active_class']       = 'faqs';
        $data['title']              = 'Certificate Fee';

        if(isset($cid)){
            $user = Auth::user();
            $certificate = App\Certificate::where('course_id','=',$cid)
                ->where('user_id','=',$user->id)
                ->where('transaction_id','!=','(NULL)')->first();



            $records = \App\LmsSeries::select(['title', 'image', 'is_paid', 'status'])
                ->where('id',$cid)
                //->where('is_paid',0)
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
                $data['certificate']=$certificate;
                //dd($data);
                $view_name = getTheme().'::site.certificate_fee';
                return view($view_name, $data);

            }else{
                return abort(404);

            }

        }else{ return abort(404);
        }
    }


    public function studentIdCardSave(Request $request,$action="save")
    {



        $data['active_class']       = 'faqs';
        $data['title']              = 'Student ID Card';
        try {

            /********* Email ***********/
            $f_name              = $request->f_name;
            $std_email           = $request->std_email;
            $std_tel             = $request->std_tel;
            $std_dob             = $request->std_dob;
            $std_adInfo          = $request->std_adInfo;
            $std_address         = $request->std_address;
            $std_city            = $request->std_city;
            $std_zipcode         = $request->std_zipcode;
            $std_country         = $request->std_country;

        if($action=="save"){
        /******* Form Validation *****/
     /*   $rules = [
            'f_name' => 'required',
            'std_email' => 'required|email',
            'std_tel' => 'required',
            'std_dob' => 'required',
//            'std_adInfo'=>'required',
            'std_address'=>'required',
            'std_city'=>'required',
            'std_zipcode'=>'required',
            'std_country'=>'required'
        ];

        $customMessages = [
            'required' => 'The :attribute field is required.'
        ];

            $validator = Validator::make($request->all(), $rules, $customMessages);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator->errors())->withInput();
            }*/

        /******* Form Validation *****/




            /********* Insert Record Into DB ***********/
            $StudentIdCard   = new App\StudentIdCard();

            $StudentIdCard->f_name                     = $f_name;
            $StudentIdCard->std_email                  = $std_email;
            $StudentIdCard->std_tel                    = $std_tel;
            $StudentIdCard->std_dob                    = $std_dob;
            $StudentIdCard->std_adInfo                 = $std_adInfo;
            $StudentIdCard->std_address                = $std_address;
            $StudentIdCard->std_city                   = $std_city;
            $StudentIdCard->std_zipcode                = $std_zipcode;
            $StudentIdCard->std_country                = $std_country;
            $StudentIdCard->std_address2               = $request->std_address2;

            $StudentIdCard->payment_method             = $request->gateway;
            $StudentIdCard->cost                       = $request->order_amount;

            $StudentIdCard->save();

            $this->processUpload($request, $StudentIdCard);

            $studentcardid=$StudentIdCard->id;
            /********* Insert Record Into DB ***********/
            return $studentcardid;
        }else{
            $record=getStudentRecord($request->record_id);
            $record->status="yes";
            $record->save();

            sendEmail('studentidcard_ack', array('f_name'=> $request->f_name,
                'email' => $std_email,
                'to_email' => $std_email,
                'std_email' => $std_email,
                'std_tel' => $std_tel,
                'std_dob' => $std_dob,
                'std_photo' => CARD_PHOTO_PATH.$record->img,
                'std_adInfo' => $std_adInfo,
                'std_address' => $std_address,
                'std_city' => $std_city,
                'std_zipcode' => $std_zipcode,
                'std_country' => $std_country,
                'url' => url('/') ));

            sendEmail('studentidcard_admin', array('f_name'=> $f_name,
                'send_to' => 'admin',
                'email' => $std_email,
                'to_email' => $std_email,
                'std_email' => $std_email,
                'std_tel' => $std_tel,
                'std_dob' => $std_dob,
                'std_photo' => CARD_PHOTO_PATH.$record->img,
                'std_adInfo' => $std_adInfo,
                'std_address' => $std_address,
                'std_city' => $std_city,
                'std_zipcode' => $std_zipcode,
                'std_country' => $std_country,
                'url' => url('/') ));
            return true;
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }




    }

    protected function processUpload(Request $request, $record)
    {



        if ($request->hasFile('image')) {

            $imageObject = new ImageSettings();

            $destinationPath = $imageObject->getCardPhotoPath();
            $destinationPathThumb = $imageObject->getCardPhotoPathThumb();
            $ThumbnailSize = $imageObject->getProfilePicSize();
            $random_str = rand(0,9999999);
            $fileName = $record->id.'_'.$random_str.'.'.$request->image->guessClientExtension();


            if(env('FILESYSTEM_DRIVER')=='s3') {
                $file=$request->file('image');
                $image_normal = Image::make($file->getRealPath())->widen(1024, function ($constraint) {$constraint->upsize();});
                $image_thumb = Image::make($file->getRealPath())->fit($ThumbnailSize);

                uploadToS3($image_normal,'users/cards/',$fileName);
                uploadToS3($image_thumb,'users/cards/thumbnail/',$fileName);

            }else {
                $request->file('image')->move($destinationPath, $fileName);

                Image::make($destinationPath . $fileName)->fit($ThumbnailSize)->save($destinationPath . $fileName);
                Image::make($destinationPath . $fileName)->fit($ThumbnailSize)->save($destinationPathThumb . $fileName);
            }
            $record->img = $fileName;
            $record->save();
        }
    }


    public function retakeFeeSave(Request $request)
    {


        $data['active_class']       = 'home';
        $data['title']              = 'Final Exam Retake Fee';
        try {
//        $records = Certificate::where('user_id','=',$request->user_id)
//            ->where('course_id','=',$request->course_id)
//            ->get();

            $succflag=count($this->transaction_details)? true : false;
            $trans_id='';
            $status='no';

            // if($records->count()>0) {

            if ($succflag) {



                $trans_id = $this->transaction_details['txn_id'];
                $status = 'yes';
                $user = Auth::user();


                $certificate = App\Certificate::where('user_id','=',$user->id)
                    ->where('course_id','=',$this->transaction_details['item_number1'])
                    ->where('transaction_id','=','')->first();



                $certificate->status = $status;
                $certificate->transaction_id = $trans_id;

                $certificate->save();

                $orderid = makeOrderID($this->transaction_details['item_number1']);

                /*sendEmail('certificate_fee_ack', array('name' => $user->name,
                    'email' => $user->email,
                    'to_email' => $user->email,
                    'course' => $this->transaction_details['item_name1'],
                    'fee' => $this->transaction_details['mc_gross_1'],
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
                    'course' => $this->transaction_details['item_name1'],
                    'fee' => $this->transaction_details['mc_gross_1'],
                    'contact' => $certificate->user_phone,
                    'address' => $certificate->address1,
                    'address2' => $certificate->address2,
                    'city' => $certificate->city,
                    'zipcode' => $certificate->zipcode,
                    'country' => $certificate->country,
                    'gateway' => $certificate->payment_type,
                    'orderid' => $orderid,
                    'url' => url('/')));*/


            }else{

                /******* Form Validation *****/
                $rules = [
                    'user_name' => 'required',
                    'user_email' => 'required|email',
                    'user_phone' => 'required',
                    'std_address' => 'required',
                    'std_address2' => 'required',
                    'std_city' => 'required',
                    'std_zipcode' => 'required',
                    'std_country' => 'required'
                ];
                $customMessages = [
                    'required' => 'The :attribute field is required.'
                ];
                $validator = Validator::make($request->all(), $rules, $customMessages);
                /******* Form Validation *****/
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator->errors());

                }


                /********* Insert Record Into DB ***********/
                $record   = new App\ExamRetakeFee();

                $record->user_id                     = $request->user_id;
                $record->user_name= $request->user_name;
                $record->user_email                     = $request->user_email;
                $record->user_phone                     = $request->user_phone;
                $record->course_id                  = $request->course_id;
                $record->course_type                    = $request->course_type;
                $record->payment_type                    = $request->gateway;

                $record->delivery_fee                 = $request->order_amount;
                $record->expected_exam_date                 = date("Y-m-d H:i:s",strtotime($request->retake_date));
                $record->transaction_id                 = $trans_id;
                $record->status                = $status;

                $record->save();
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }




    }

    public function certificateSavePayPalPro(Request $request)
    {

        $data['active_class']       = 'home';
        $data['title']              = 'Certificate Fee';
        /******* Form Validation *****/
        $rules = [
            'user_name' => 'required',
            'user_email' => 'required|email',
            'user_phone' => 'required',
            'std_address' => 'required',
            'std_address2' => 'required',
            'std_city' => 'required',
            'std_zipcode' => 'required',
            'std_country' => 'required'
        ];
        $customMessages = [
            'required' => 'The :attribute field is required.'
        ];
        $validator = Validator::make($request->all(), $rules, $customMessages);
        /******* Form Validation *****/
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());

        }

        try {
            $trans_id='';
            $status='no';
            if(isset($this->transaction_details['transaction_id'])){
                $trans_id=$this->transaction_details['transaction_id'];
                $status='yes';
            }
            $newcertificate=false;
            if($request->course_type=='reed'){
                $newcertificate=true;
            }else {
                $certificate = Certificate::where('user_id', '=', $request->user_id)
                    ->where('course_id', '=', $request->course_id)
                    ->first();
                if (!$certificate) {
                    $newcertificate = true;
                }
            }
            if($newcertificate) {
                /********* Insert Record Into DB ***********/
                $certificate = new App\Certificate();
                $certificate->user_id = $request->user_id;
                $certificate->user_name = $request->user_name;
                $certificate->user_email = $request->user_email;
                $certificate->user_phone = $request->user_phone;
                $certificate->course_id = $request->course_id;
                $certificate->course_type = $request->course_type;

                if($request->course_type=='reed'){
                    $certificate->reed_course_name = $request->course_title;
                }

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
            }else{
                $certificate->user_name = $request->user_name;
                $certificate->user_email = $request->user_email;
                $certificate->user_phone = $request->user_phone;
                $certificate->course_type = $request->course_type;
                if($request->course_type=='reed'){
                    $certificate->reed_course_name = $request->course_title;
                }
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

        } catch (Exception $e) {
            dd($e->getMessage());
        }


    }

    public function payu_success(Request $request)
    {

        $response = $request->all();
        $package_name = ucwords($response['productinfo']);

        $user = Auth::user();
        if($this->paymentSuccess($request))
        {
            //PAYMENT RECORD UPDATED SUCCESSFULLY
            //PREPARE SUCCESS MESSAGE

            // $email_template = 'subscription_success';

            //    $template    = new EmailTemplate();
            //   $content_data =  $template->sendEmailNotification($email_template,
            //  array('username' =>$user->name,
            //           'plan'     => $payment_record->plan_type,
            //           'to_email' => $user->email));

            try {

                $user->notify(new \App\Notifications\UsersNotifcations($user,$content_data));
            } catch (Exception $e) {

            }



            // sendEmail($email_template, array('username'=>$user->name,
            // 'plan' => $package_name,
            // 'to_email' => $user->email));
            // flash('success', 'your_subscription_was_successfull', 'success');
        }
        else {
            //PAYMENT RECORD IS NOT VALID
            //PREPARE METHOD FOR FAILED CASE
            pageNotFound();
        }
        //REDIRECT THE USER BY LOADING A VIEW

        return redirect(URL_PAYMENTS_LIST.$user->slug);

    }

    public function payu_cancel(Request $request)
    {
        if($this->paymentFailed())
        {
            //FAILED PAYMENT RECORD UPDATED SUCCESSFULLY
            //PREPARE SUCCESS MESSAGE
            flash('Ooops...!', 'your_payment_was cancelled', 'overlay');
        }
        else {
            //PAYMENT RECORD IS NOT VALID
            //PREPARE METHOD FOR FAILED CASE
            pageNotFound();
        }

        //REDIRECT THE USER BY LOADING A VIEW
        $user = Auth::user();
        return redirect(URL_PAYMENTS_LIST.$user->slug);

    }


    /**
     * This method saves the record before going to payment method
     * The exact record can be identified by using the slug
     * By using slug we will fetch the record and update the payment status to completed
     * @param  [type] $item           [description]
     * @param  [type] $payment_method [description]
     * @return [type]                 [description]
     */
    public function preserveBeforeSave($course, $package_type,$payment_method, $other_details,$coupon_zero=0)
    {
        //dd($course);
        //   $course_id=$course->user_id;
        $user = getUserRecord();


//     if($other_details['paid_by_parent'])
//	      $user = getUserRecord($other_details['child_id']);
//

      $payment_slug=str_slug(getHashCode());
      $payment = new Payment();
      $payment->payment_gateway = $payment_method;
      $payment->slug 			      = $payment_slug;
      $payment->plan_type 			      = $package_type;
      $payment->cost 			      = $course->order_amount;
      $payment->actual_cost 			      = $course->actual_cost;
      $payment->discount_amount 			      = $course->discount_availed;
      $payment->after_discount 			      = $course->after_discount;
      $payment->coupon_id 			      = $course->coupon_id;
      $payment->coupon_applied 			      = $course->is_coupon_applied;
      $payment->transaction_record = json_encode($course->all());
      $payment->currency = $other_details['currency'];
      $payment->currency_icon = $other_details['currency_icon'];
      $payment->admin_comments = $other_details['admin_comments'];


        if($package_type=="lms" || $package_type=="studentcard-fee" || $package_type=="gift-lms"){
            $payment->item_id=$course->item_id;
            $payment->item_name=$course->item_name;

        }
        if($package_type=="reed-certificate"){
            $payment->item_id=$course->course_id;
            $payment->item_name=$course->course_title;

        }

        if($package_type=="certificate-fee"){
            $payment->item_id=$course->course_id;
            $payment->item_name=$course->course_title;

        }
        if($package_type=="retake-exam-fee"){
            $payment->item_id=$course->item_id;
            $payment->item_name=$course->item_name;

        }
        $payment->user_id         = (isset($user->id)) ? $user->id : 0;

        //$payment->instructor_id         = $course_id;
        // $payment->paid_by_parent 	= $other_details['paid_by_parent'];
        $payment->payment_status 	= PAYMENT_STATUS_PENDING;
        $payment->other_details 	= json_encode($other_details);

        if($payment_method!='paypal') {
            $payment->transaction_id = $other_details['transaction_id'];
            $payment->currency = $other_details['currency'];
            $payment->currency_icon = $other_details['currency_icon'];
            $payment->admin_comments = $other_details['admin_comments'];
        }
        if(!$coupon_zero)
        {
            if($payment_method=='offline')
                $payment->notes = $other_details['payment_details'];
        }
        $payment->save();

        if($package_type=='lms'){
            $items = \Cart::getContent();

            $total = \Cart::getTotal();


            foreach ($items as $item){
                $payment_course         = new App\UserCourses();
                $payment_course->item_id 		    = $item->id;
                $payment_course->item_name 		  = $item->name;
                $payment_course->item_price 		  = $item->price;
                $payment_course->item_quantity 		  = $item->quantity;
                $course = LmsSeries::where('id', $item->id)->first();
                $payment_course->instructor_id 			      = $course->user_id;
                $payment_course->user_id         = (isset($user->id)) ? $user->id : 0;
                $payment_course->payment_slug         = $payment_slug;
                $payment_course->save();
            }

            \Cart::clear();
            \Cookie::queue(\Cookie::forget('preurl'));
        }
        return $payment_slug;

    }

    /**
     * Common method to handle payment failed records
     * @return [type] [description]
     */
    protected function paymentFailed()
    {
        if(env('DEMO_MODE')) {
            return TRUE;
        }

        $params = explode('?token=',$_SERVER['REQUEST_URI']) ;

        if(!count($params))
            return FALSE;

        $slug = $params[1];
        $payment_record = Payment::where('slug', '=', $slug)->first();


        if(!$this->processPaymentRecord($payment_record))
        {
            return FALSE;
        }

        $payment_record->payment_status = PAYMENT_STATUS_CANCELLED;
        $payment_record->save();

        return TRUE;

    }

    /**
     * Common method to handle success payments
     * @return [type] [description]
     */

    protected function paymentSuccessStripe(Request $request, $slug)
    {



        $payment_record = Payment::where('slug', '=', $slug)->first();

        if($this->processPaymentRecord($payment_record))
        {
            $payment_record->payment_status = PAYMENT_STATUS_SUCCESS;
            $item_details = '';

            if($payment_record->plan_type == 'combo')
            {
                $item_model = new ExamSeries();
            }


            if($payment_record->plan_type == 'exam') {
                $item_model = new Quiz();
            }

            if($payment_record->plan_type == 'lms') {
                $item_model = new LmsSeries();
            }

            //$item_details = $item_model->where('id', '=',$payment_record->item_id)->first();


            //$daysToAdd = '+'.$item_details->validity.'days';
            $daysToAdd = '365 days';

            $payment_record->start_date = date('Y-m-d');
            $payment_record->end_date = date('Y-m-d', strtotime($daysToAdd));

            $details_before_payment         = (object)json_decode($payment_record->other_details);
            $payment_record->coupon_applied = $details_before_payment->is_coupon_applied;
            $payment_record->coupon_id      = $details_before_payment->coupon_id;
            $payment_record->actual_cost    = $details_before_payment->actual_cost;
            $payment_record->discount_amount= $details_before_payment->discount_availed;
            $payment_record->after_discount = $details_before_payment->after_discount;
            if($payment_record->payment_gateway=='paypal') {
                $payment_record->paid_amount = $request->mc_gross;
                $payment_record->transaction_id = $request->txn_id;
                $payment_record->paid_by = $request->payer_email;
            }

            //Capcture all the response from the payment.
            //In case want to view total details, we can fetch this record
            $payment_record->transaction_record = json_encode($request->request->all());

            $payment_record->save();

            if($payment_record->coupon_applied)
            {
                $this->couponcodes_usage($payment_record);
            }


            return TRUE;
        }
        return FALSE;
    }

    public function paymentSuccess(Request $request, $token='')
    {



        if(isset($token) && $token!=null && $token!=''){
            $slug=$token;
        }else{
            $params = explode('?token=',$_SERVER['REQUEST_URI']) ;
            if(!count($params))
                return FALSE;
            $slug = $params[1];
        }

        $payment_record = Payment::where('slug', '=', $slug)->first();


        if($this->processPaymentRecord($payment_record))
        {
            $payment_record->payment_status = PAYMENT_STATUS_SUCCESS;
            $item_details = '';

//            if($payment_record->plan_type == 'combo')
//            {
//                $item_model = new ExamSeries();
//            }
//
//
//            if($payment_record->plan_type == 'exam') {
//                $item_model = new Quiz();
//            }

//            if($payment_record->plan_type == 'lms') {
//                $item_model = new LmsSeries();
//            }
//
//            $item_details = $item_model->where('id', '=',$payment_record->item_id)->first();
//

            //$daysToAdd = '+'.$item_details->validity.'days';
            $daysToAdd = '365 days';

            $payment_record->start_date = date('Y-m-d');
            $payment_record->end_date = date('Y-m-d', strtotime($daysToAdd));

            $details_before_payment         = (object)json_decode($payment_record->other_details);
            $payment_record->coupon_applied = $details_before_payment->is_coupon_applied;
            $payment_record->coupon_id      = $details_before_payment->coupon_id;
            $payment_record->actual_cost    = $details_before_payment->actual_cost;
            $payment_record->discount_amount= $details_before_payment->discount_availed;
            $payment_record->after_discount = $details_before_payment->after_discount;
            $payment_record->paid_amount = $details_before_payment->after_discount;

            if($payment_record->payment_gateway=='paypal') {
                $payment_record->cost = $request->mc_gross;
                $payment_record->paid_amount = $request->mc_gross;
                $payment_record->transaction_id = $request->txn_id;
                $payment_record->paid_by = $request->payer_email;
                $payment_record->currency = $request->mc_currency;
                $payment_record->currency_icon = 'fa fa-gbp';
            }

            //Capture all the response from the payment.
            //In case want to view total details, we can fetch this record
            //$payment_record->transaction_record = json_encode($request->request->all());

            $payment_record->save();

            if($payment_record->coupon_applied)
            {
                $this->couponcodes_usage($payment_record);
            }


            return TRUE;
        }
        return FALSE;
    }

    public function couponcodes_usage($payment_record)
    {
        $coupon_usage['user_id'] = $payment_record->user_id;
        $coupon_usage['item_id'] = $payment_record->item_id;
        $coupon_usage['item_type'] = $payment_record->plan_type;
        $coupon_usage['item_cost'] = $payment_record->actual_cost;
        $coupon_usage['total_invoice_amount'] = $payment_record->paid_amount;
        $coupon_usage['discount_amount'] = $payment_record->discount_amount;
        $coupon_usage['coupon_id'] = $payment_record->coupon_id;
        $coupon_usage['updated_at'] =  new \DateTime();
        DB::table('couponcodes_usage')->insert($coupon_usage);
        return TRUE;
    }

    /**
     * This method validates the payment record before update the payment status
     * @param  [type]  $payment_record [description]
     * @return boolean                 [description]
     */
    protected function isValidPaymentRecord(Payment $payment_record)
    {
        $valid = FALSE;
        if($payment_record)
        {
            if($payment_record->payment_status == PAYMENT_STATUS_PENDING || $payment_record->payment_status == PAYMENT_STATUS_SUCCESS || $payment_record->payment_gateway=='offline')
                $valid = TRUE;
        }
        return $valid;
    }

    /**
     * This method checks the age of the payment record
     * If the age is > than MAX TIME SPECIFIED (30 MINS), it will update the record to aborted state
     * @param  payment $payment_record [description]
     * @return boolean                 [description]
     */
    protected function isExpired(Payment $payment_record)
    {

        $is_expired = FALSE;
        $to_time = strtotime(Carbon\Carbon::now());
        $from_time = strtotime($payment_record->updated_at);
        $difference_time = round(abs($to_time - $from_time) / 60,2);

        if($difference_time > PAYMENT_RECORD_MAXTIME)
        {
            $payment_record->payment_status = PAYMENT_STATUS_CANCELLED;
            $payment_record->save();
            return $is_expired =  TRUE;
        }
        return $is_expired;
    }

    /**
     * This method Process the payment record by validating through
     * the payment status and the age of the record and returns boolen value
     * @param  Payment $payment_record [description]
     * @return [type]                  [description]
     */
    protected  function processPaymentRecord(Payment $payment_record)
    {

        if(!$this->isValidPaymentRecord($payment_record))
        {
            flash('Oops','invalid_record', 'error');
            return FALSE;
        }

        if($this->isExpired($payment_record))
        {
            flash('Oops','time_out', 'error');
            return FALSE;
        }

        return TRUE;
    }


    /**
     * This method handles the request before payment page
     * It shows the checkout page and gives an option for coupon codes
     * @param  [type] $slug [description]
     * @return [type]       [description]
     */
    public function checkout($type, $slug)
    {

        $record = $this->getModelName($type, $slug);

        if($isValid = $this->isValidRecord($record))
            return redirect($isValid);

        $user = Auth::user();
        //Check if user is already paid to the same item and the item is in valid date

        if($user->role_id == 6){

            $children_ids  = App\User::where('parent_id',$user->id)->pluck('id')->toArray();

            $is_paid  = [];
            foreach ($children_ids as $key => $value) {

                $is_paid[]  = Payment::isParentPurchased($record->id, $type, $value);
            }
            // dd($is_paid);
            $paid_staus  = in_array('notpurchased', $is_paid);

            if(!$paid_staus){

                flash('Hey '.$user->name, 'you_already_purchased_this_item', 'overlay');
                return back();
            }

        }

        if(Payment::isItemPurchased($record->id, $type, $user->id))
        {
            //User already purchased this item and it is valid
            //Return the user to back by the message
            flash('Hey '.$user->name, 'you_already_purchased_this_item', 'overlay');
            return back();
        }
        $active_class = 'lms';
        if($type == 'combo' || $type=='exams'|| $type=='exam')
            $active_class = 'exams';
        $data['active_class']       = $active_class;
        $data['pay_by']             = '';
        $data['title']              = $record->title;
        $data['item_type']          = $type;
        $data['item']               = $record;
        $current_theme            = getDefaultTheme();
        if($current_theme == 'default'){
            $data['right_bar']          = FALSE;
            $data['right_bar_class']   	= 'order-user-details';
            $data['right_bar_path']     = 'student.payments.billing-address-right-bar';
            $data['right_bar_data']     = array(
                'item' => $record,
            );
        }

        $data['layout']              = getLayout();
        $data['parent_user'] = FALSE;
        if(checkRole(getUserGrade(7)))
        {
            $data['parent_user'] = TRUE;
            $data['children'] = App\User::where('parent_id', '=', $user->id)->get();

        }

        $data['use_razorpay']   = FALSE;

        // return view('student.payments.checkout', $data);

        $view_name = getTheme().'::student.payments.checkout';
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
        return URL_EXAM_SERIES;
    }

    /**
     * This method saves the submitted data from user and waits for the admin approval
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function updateOfflinePayment(Request $request)
    {

        $payment_data = json_decode($request->payment_data);
        $item = $this->getPackageDetails($payment_data->type, $payment_data->item_name);

        if(!$item)
        {
            dd('failed');
        }

        $other_details = array();
        $other_details['is_coupon_applied'] = $payment_data->is_coupon_applied;
        $other_details['actual_cost']       = $payment_data->actual_cost;
        $other_details['discount_availed']  = $payment_data->discount_availed;
        $other_details['after_discount']    = $payment_data->after_discount;
        $other_details['coupon_id']         = $payment_data->coupon_id;
        $other_details['paid_by_parent']    = $payment_data->parent_user;
        $other_details['child_id']          = $payment_data->selected_child_id;
        $other_details['payment_details']   = $request->payment_details;

        $payment_gateway = $payment_data->gateway;
        $token = $this->preserveBeforeSave($item,$payment_data->type, $payment_gateway, $other_details);

        try {

            $owner       = App\User::where('role_id',1)->first();
            $paid_user    = getUserRecord();
            $owner->notify(new \App\Notifications\UserOfflinePaymentSubmit($owner,$paid_user,$item));
            $paid_user->notify(new \App\Notifications\PaidUserOfflinePayment($paid_user,$item));

        } catch (Exception $e) {
            // dd($e->getMessage());
        }


        flash('success', 'your_request_was_submitted_to_admin', 'overlay');
        return redirect(URL_PAYMENTS_LIST.Auth::user()->slug);
    }

    public function approveOfflinePayment(Request $request)
    {

        // dd($request);

        $payment_record = Payment::where('id','=',$request->record_id)->first();
        // dd($payment_record);
        try{
            if($request->submit == 'approve')
            {
                $this->approvePayment($payment_record, $request);
            }
            else {

                $user = getUserRecord($payment_record->user_id);




                // sendEmail('offline_subscription_failed', array('username'=>$user->name,
                //   'plan' => $payment_record->plan_type,
                //   'to_email' => $user->email, 'admin_comment'=>$request->admin_comment));

                $payment_record->payment_status = PAYMENT_STATUS_CANCELLED;
                $payment_record->admin_comments = $request->admin_comment;

                $payment_record->save();



                $template    = new EmailTemplate();
                $subject  = getPhrase('offline_subscription_failed');
                $content_data =  $template->sendEmailNotification('offline_subscription_failed',
                    array(   'username'      =>$user->name,
                        'plan'          => $payment_record->plan_type,
                        'to_email'      => $user->email,
                        'admin_comment' =>$request->admin_comment));

                // $user->notify(new \App\Notifications\UsersNotifcations($user,$content_data,$subject));
                try {

                    $user->notify(new \App\Notifications\AdminCancelledOfflinePayment($user,$payment_record->plan_type,$request->admin_comment));
                } catch (Exception $e) {

                }

            }

            flash('success', 'record_was_updated_successfully', 'success');
        }
        catch(Exception $ex){

            $message = $ex->getMessage();
            flash('Oops..!', $message, 'warning');
        }
        return redirect(URL_OFFLINE_PAYMENT_REPORTS);

    }

    public function overallPayments($slug)
    {
        $paymentObject = new Payment();

        $payments = Payment::where('payment_status', '=', 'success')->get();
        $payments = Payment::all();

        $data['active_class']       = 'analysis';
        $data['title']              = getPhrase('quiz_attempts');

        $data['exam_record']        = $exam_record;

        $data['layout']             = getLayout();

        // return view('payments.reports.overall-analysis', $data);

        $view_name = getTheme().'::payments.reports.overall-analysis';
        return view($view_name, $data);


    }


    /**
     * This method redirects the user to view the onlinepayments reports dashboard
     * It contains an optional slug, if slug is null it will redirect the user to dashboard
     * If the slug is success/failed/cancelled/all it will show the appropriate result based on slug status from payments table
     * @param  string $slug [description]
     * @return [type]       [description]
     */
    public function onlinePaymentsReport()
    {

        if(!checkRole(getUserGrade(2)))
        {
            prepareBlockUserMessage();
            return back();
        }


        $data['active_class']       = 'reports';
        $data['title']              = getPhrase('online_payments');
        $data['payments']           = (object)$this->prepareSummaryRecord('online');
        $data['payments_chart_data']= (object)$this->getPaymentStats($data['payments']);
        $data['payments_monthly_data'] = (object)$this->getPaymentMonthlyStats();
        $data['payment_mode']      = 'online';
        $data['layout']             = getLayout();
        // return view('payments.reports.payments-report', $data);

        $view_name = getTheme().'::payments.reports.payments-report';
        return view($view_name, $data);
    }

    /**
     * This method list the details of the records
     * @param  [type] $slug [description]
     * @return [type]       [description]
     */
    public function listOnlinePaymentsReport($slug)
    {
        if(!checkRole(getUserGrade(2)))
        {
            prepareBlockUserMessage();
            return back();
        }
        if(!in_array($slug, ['all','pending', 'success','cancelled']))
        {
            pageNotFound();
            return back();
        }

        $payment = new Payment();
        $this->updatePaymentTransactionRecords($payment->updateTransactionRecords('online'));

        $data['active_class']       = 'reports';
        $data['payments_mode']      = getPhrase('online_payments');
        if($slug=='all'){
            $data['title']              = getPhrase('all_payments');

        }
        elseif($slug=='success'){
            $data['title']              = getPhrase('success_list');
        }
        elseif($slug=='pending'){
            $data['title']              = getPhrase('pending_list');
        }
        elseif($slug='cancelled'){
            $data['title']              = getPhrase('cancelled_list');
        }
        $data['layout']             = getLayout();
        $data['ajax_url']           = URL_ONLINE_PAYMENT_REPORT_DETAILS_AJAX.$slug;
        $data['payment_mode']       = 'online';
        // return view('payments.reports.payments-report-list', $data); 

        $view_name = getTheme().'::payments.reports.payments-report-list';
        return view($view_name, $data);
    }

    public function updatePaymentTransactionRecords($records)
    {

        foreach($records as $record)
        {
            $rec = Payment::where('id',$record->id)->first();
            $this->isExpired($rec);
        }
    }

    public function getOnlinePaymentReportsDatatable($slug)
    {

        if(!checkRole(getUserGrade(2)))
        {
            prepareBlockUserMessage();
            return back();
        }

        $records = Payment::join('users', 'users.id','=','payments.user_id')

            ->select(['users.image', 'users.name',  'item_name', 'plan_type', 'start_date', 'end_date', 'payment_gateway','payments.updated_at','payment_status','payments.cost', 'payments.after_discount', 'payments.paid_amount','payments.id' ])
            ->where('payment_gateway', '!=', 'offline')
            ->orderBy('updated_at', 'desc');
        if($slug!='all')
            $records->where('payment_status', '=', $slug);
        return Datatables::of($records)

            ->editColumn('payment_status',function($records){

                $rec = '';
                if($records->payment_status==PAYMENT_STATUS_CANCELLED)
                    $rec = '<span class="label label-danger">'.ucfirst($records->payment_status).'</span>';
                elseif($records->payment_status==PAYMENT_STATUS_PENDING)
                    $rec = '<span class="label label-info">'.ucfirst($records->payment_status).'</span>';
                elseif($records->payment_status==PAYMENT_STATUS_SUCCESS)
                    $rec = '<span class="label label-success">'.ucfirst($records->payment_status).'</span>';
                return $rec;
            })
            ->editColumn('image', function($records) {
                return '<img src="'.getProfilePath($records->image).'"  /> ';
            })
            ->editColumn('name', function($records)
            {
                return ucfirst($records->name);
            })

            ->editColumn('plan_type', function($records)
            {
                return ucfirst($records->plan_type);
            })
            ->editColumn('payment_gateway', function($records)
            {
                $text =  ucfirst($records->payment_gateway);

                if($records->payment_status==PAYMENT_STATUS_SUCCESS) {
                    $extra = '<ul class="list-unstyled payment-col clearfix"><li>'.$text.'</li>';
                    $extra .='<li><p>Cost:'.$records->cost.'</p><p>Aftr Dis.:'.$records->after_discount.'</p><p>Paid:'.$records->paid_amount.'</p></li></ul>';
                    return $extra;
                }
                return $text;
            })
            ->editColumn('start_date', function($records)
            {
                if($records->payment_status==PAYMENT_STATUS_CANCELLED || $records->payment_status==PAYMENT_STATUS_PENDING)
                    return '-';
                return $records->start_date;
            })
            ->editColumn('end_date', function($records)
            {
                if($records->payment_status==PAYMENT_STATUS_CANCELLED || $records->payment_status==PAYMENT_STATUS_PENDING)
                    return '-';
                return $records->end_date;
            })
            ->rawColumns(['image','payment_gateway','payment_status'])
            ->removeColumn('id')
            ->removeColumn('users.image')
            ->removeColumn('action')
            ->make();
    }


    /**
     * This method redirects the user to view the onlinepayments reports dashboard
     * It contains an optional slug, if slug is null it will redirect the user to dashboard
     * If the slug is success/failed/cancelled/all it will show the appropriate result based on slug status from payments table
     * @param  string $slug [description]
     * @return [type]       [description]
     */
    public function offlinePaymentsReport()
    {
        if(!checkRole(getUserGrade(2)))
        {
            prepareBlockUserMessage();
            return back();
        }

        $data['active_class']       = 'reports';
        $data['title']              = getPhrase('offline_payments');
        $data['payments']           = (object)$this->prepareSummaryRecord('offline');

        $data['payments_chart_data'] = (object)$this->getPaymentStats($data['payments']);
        $data['payments_monthly_data'] = (object)$this->getPaymentMonthlyStats('offline', '=');
        $data['payment_mode']       = 'offline';


        $data['layout']             = getLayout();

        // return view('payments.reports.payments-report', $data);

        $view_name = getTheme().'::payments.reports.payments-report';
        return view($view_name, $data);
    }

    /**
     * This method list the details of the records
     * @param  [type] $slug [description]
     * @return [type]       [description]
     */
    public function listOfflinePaymentsReport($slug)
    {
        if(!in_array($slug, ['all','pending', 'success','cancelled']))
        {
            pageNotFound();
            return back();
        }


        $data['active_class']       = 'reports';
        $data['payments_mode']      = getPhrase('offline_payments');
        if($slug=='all'){
            $data['title']              = getPhrase('all_payments');

        }
        elseif($slug=='success'){
            $data['title']              = getPhrase('success_list');
        }
        elseif($slug=='pending'){
            $data['title']              = getPhrase('pending_list');
        }
        elseif($slug='cancelled'){
            $data['title']              = getPhrase('cancelled_list');
        }
        $data['layout']             = getLayout();
        $data['ajax_url']           = URL_OFFLINE_PAYMENT_REPORT_DETAILS_AJAX.$slug;
        $data['payment_mode']       = 'offline';


        // return view('payments.reports.payments-report-list', $data); 

        $view_name = getTheme().'::payments.reports.payments-report-list';
        return view($view_name, $data);
    }

    /**
     * This method gets the list of records
     * @param  [type] $slug [description]
     * @return [type]       [description]
     */
    public function getOfflinePaymentReportsDatatable($slug)
    {
        if(!checkRole(getUserGrade(2)))
        {
            prepareBlockUserMessage();
            return back();
        }

        $records = Payment::join('users', 'users.id','=','payments.user_id')

            ->select(['users.image', 'users.name',  'item_name', 'plan_type', 'start_date', 'end_date', 'payment_gateway', 'payments.updated_at','payment_status','payments.id','payments.cost', 'payments.after_discount', 'payments.paid_amount'])
            ->where('payment_gateway', '=', 'offline')
            ->orderBy('updated_at', 'desc');
        if($slug!='all')
            $records->where('payment_status', '=', $slug);
        return Datatables::of($records)

            ->editColumn('payment_status',function($records){

                $rec = '';
                if($records->payment_status==PAYMENT_STATUS_CANCELLED)
                    $rec = '<span class="label label-danger">'.ucfirst($records->payment_status).'</span>';
                elseif($records->payment_status==PAYMENT_STATUS_PENDING) {
                    $rec = '<span class="label label-info">'.ucfirst($records->payment_status).'</span>&nbsp;<button class="btn btn-primary btn-sm" onclick="viewDetails('.$records->id.');">'.getPhrase('view_details').'</button>';
                }
                elseif($records->payment_status==PAYMENT_STATUS_SUCCESS)
                    $rec = '<span class="label label-success">'.ucfirst($records->payment_status).'</span>';
                return $rec;
            })
            ->editColumn('image', function($records){
                return '<img src="'.getProfilePath($records->image).'"  /> ';
            })
            ->editColumn('name', function($records)
            {
                return ucfirst($records->name);
            })
            ->editColumn('payment_gateway', function($records)
            {
                $text =  ucfirst($records->payment_gateway);

                if($records->payment_status==PAYMENT_STATUS_SUCCESS) {
                    $extra = '<ul class="list-unstyled payment-col clearfix"><li>'.$text.'</li>';
                    $extra .='<li><p>Cost:'.$records->cost.'</p><p>Aftr Dis.:'.$records->after_discount.'</p><p>Paid:'.$records->paid_amount.'</p></li></ul>';
                    return $extra;
                }
                return $text;
            })

            ->editColumn('plan_type', function($records)
            {
                return ucfirst($records->plan_type);
            })
            ->editColumn('start_date', function($records)
            {
                if($records->payment_status==PAYMENT_STATUS_CANCELLED || $records->payment_status==PAYMENT_STATUS_PENDING)
                    return '-';
                return $records->start_date;
            })
            ->editColumn('end_date', function($records)
            {
                if($records->payment_status==PAYMENT_STATUS_CANCELLED || $records->payment_status==PAYMENT_STATUS_PENDING)
                    return '-';
                return $records->end_date;
            })

            ->rawColumns(['payment_status','image','name','plan_type','start_date','end_date','payment_gateway' ])
            ->removeColumn('id')
            ->removeColumn('users.image')
            ->removeColumn('action')
            ->make();
    }

    /**
     * This method prepares different variations of reports based on the type
     * This is a common method to prepare online, offline and overall reports
     * @param  string $type [description]
     * @return [type]       [description]
     */
    public function prepareSummaryRecord($type='overall')
    {

        $payments = [];
        if($type=='online') {
            $payments['all'] = $this->getRecordsCount('online');

            $payments['success'] = $this->getRecordsCount('online', 'success');
            $payments['cancelled'] = $this->getRecordsCount('online', 'cancelled');
            $payments['pending'] = $this->getRecordsCount('online', 'pending');
        }
        else if($type=='offline') {
            $payments['all'] = $this->getRecordsCount('offline');

            $payments['success'] = $this->getRecordsCount('offline', 'success');
            $payments['cancelled'] = $this->getRecordsCount('offline', 'cancelled');
            $payments['pending'] = $this->getRecordsCount('offline', 'pending');
        }

        return $payments;
    }

    /**
     * This is a helper method for fetching the data and preparing payment records count
     * @param  [type] $type   [description]
     * @param  string $status [description]
     * @return [type]         [description]
     */
    public function getRecordsCount($type, $status='')
    {
        $count = 0;
        if($type=='online') {
            if($status=='')
                $count = Payment::where('payment_gateway', '!=', 'offline')->count();

            else
            {
                $count = Payment::where('payment_gateway', '!=', 'offline')
                    ->where('payment_status', '=', $status)
                    ->count();
            }
        }
        else if($type=='offline')
        {
            if($status=='')
                $count = Payment::where('payment_gateway', '=', 'offline')->count();

            else
            {
                $count = Payment::where('payment_gateway', '=', 'offline')
                    ->where('payment_status', '=', $status)
                    ->count();
            }
        }


        return $count;
    }

    /**
     * This method prepares the chart data for success and failed records
     * @param  [type] $payment_data [description]
     * @return [type]               [description]
     */
    public function getPaymentStats($payment_data)
    {
        if(!checkRole(getUserGrade(2)))
        {
            prepareBlockUserMessage();
            return back();
        }

        $payment_dataset = [$payment_data->success, $payment_data->cancelled, $payment_data->pending];
        $payment_labels = [getPhrase('success'), getPhrase('cancelled'), getPhrase('pending')];
        $payment_dataset_labels = [getPhrase('total')];

        $payment_bgcolor = [getColor('',4),getColor('',9),getColor('',18)];
        $payment_border_color = [getColor('background',4),getColor('background',9),getColor('background',18)];

        $payments_stats['data']    = (object) array(
            'labels'            => $payment_labels,
            'dataset'           => $payment_dataset,
            'dataset_label'     => $payment_dataset_labels,
            'bgcolor'           => $payment_bgcolor,
            'border_color'      => $payment_border_color
        );
        $payments_stats['type'] = 'bar';
        $payments_stats['title'] = getPhrase('overall_statistics');

        return $payments_stats;
    }

    /**
     * This method returns the overall monthly summary of the payments made with status success
     * @return [type] [description]
     */
    public function getPaymentMonthlyStats($type = 'offline',$symbol='!=')
    {
        if(!checkRole(getUserGrade(2)))
        {
            prepareBlockUserMessage();
            return back();
        }
        $paymentObject = new App\Payment();
        $payment_data = (object)$paymentObject->getSuccessMonthlyData('',$type, $symbol);


        $payment_dataset = [];
        $payment_labels = [];
        $payment_dataset_labels = [getPhrase('total')];
        $payment_bgcolor = [];
        $payment_border_color = [];


        foreach($payment_data as $record)
        {
            $color_number = rand(0,999);;
            $payment_dataset[] = $record->total;
            $payment_labels[]  = $record->month;
            $payment_bgcolor[] = getColor('',$color_number);
            $payment_border_color[] = getColor('background', $color_number);

        }

        $payments_stats['data']    = (object) array(
            'labels'            => $payment_labels,
            'dataset'           => $payment_dataset,
            'dataset_label'     => $payment_dataset_labels,
            'bgcolor'           => $payment_bgcolor,
            'border_color'      => $payment_border_color
        );
        $payments_stats['type'] = 'line';
        $payments_stats['title'] = getPhrase('payments_reports_in').' '.getCurrencyCode();

        return $payments_stats;
    }

    /**
     * This method displays the form for export payments list with different combinations
     * @return [type] [description]
     */
    public function exportPayments()
    {
        if(!checkRole(getUserGrade(2)))
        {
            prepareBlockUserMessage();
            return back();
        }

        if(isset($_REQUEST) && count($_REQUEST)){
            $data['active_class']       = 'reports';
            $data['title']              = getPhrase('export_payments_report');
            $data['layout']             = getLayout();
            $data['record']             = $_REQUEST['record'];
            $data['reporturl']             = $_REQUEST['reporturl'];
        }else{
            $data['active_class']       = 'reports';
            $data['title']              = getPhrase('export_payments_report');
            $data['layout']             = getLayout();
            $data['record']             = FALSE;

        }

        // return view('payments.reports.payments-export', $data);    

        $view_name = getTheme().'::payments.reports.payments-export';
        return view($view_name, $data);
    }

    public function doExportPayments(Request $request)
    {
        if(!checkRole(getUserGrade(2)))
        {
            prepareBlockUserMessage();
            return back();
        }

        $columns = array(
            'all_records'  => 'bail|required'
        );

        if($request->all_records==0)
        {
            $columns['from_date'] = 'bail|required';
            $columns['to_date']    = 'bail|required';
        }

        $this->validate($request,$columns);

        $payment_status = $request->payment_status;
        $payment_type = $request->payment_type;
        $record_type  = $request->all_records;
        $from_date = '';
        $to_date = '';

        if(!$record_type)
        {
            $from_date = $request->from_date;
            $to_date = $request->to_date;
        }
        $records = [];
        $query = '';

        if($payment_status=='all' && $payment_type=='all' && $record_type=='1')
        {

            $query =  Payment::whereRaw("1 = 1");
        }
        else {

            if($record_type==0)
            {
                $query = Payment::where('created_at', '>=', $from_date)
                    ->where('created_at', '<=', $to_date);

            }
            else {

                $query =  Payment::whereRaw("1 = 1");
            }

            if($payment_type!='all')
            {

                if($payment_type=='online') {
                    $query->where('payment_gateway','!=','offline');
                }
                else {
                    $query->where('payment_gateway','=','offline');
                }


            }

            if($payment_status!='all')
            {
                $query->where('payment_status', '=', $payment_status);
            }

        }
        $records = $query->get();


        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet
            ->setCellValue('A1', 'SNo')
            ->setCellValue('B1', 'Item ID')
            ->setCellValue('C1', 'Item ame')
            ->setCellValue('C1', 'Item Type')
            ->setCellValue('D1', 'User ID')
            ->setCellValue('E1', 'Instructor ID')
            ->setCellValue('F1', 'Start Date')
            ->setCellValue('G1', 'End Date')
            ->setCellValue('H1', 'Transaction ID')
            ->setCellValue('I1', 'Payment Gateway')
            ->setCellValue('J1', 'Coupon Applied')
            ->setCellValue('K1', 'Coupon ID')
            ->setCellValue('L1', 'Actual Cost')
            ->setCellValue('M1', 'Discounted Amount')
            ->setCellValue('N1', 'After Discount')
            ->setCellValue('O1', 'Paid Amount')
            ->setCellValue('P1', 'Currency')
            ->setCellValue('Q1', 'Transaction Date')
            ->setCellValue('R1', 'Payment Status')
            ->setCellValue('S1', 'Plan Type')
        ;


        //$records = $this->getPaymentRecords();
        // dd($records);
        $cnt = 2;
        foreach ($records as $item) {
            $item_type = ucfirst($item->plan_type);
            if($item->plan_type=='combo')
                $item_type = 'Exam Series';
            $sheet
                ->setCellValue("A{$cnt}", $item->id)
                ->setCellValue("B{$cnt}", $item->item_id)
                ->setCellValue("C{$cnt}", $item->item_name)
                ->setCellValue("D{$cnt}", $item->user_id)
                ->setCellValue("E{$cnt}", $item->instructor_id)
                ->setCellValue("F{$cnt}", $item->start_date)
                ->setCellValue("G{$cnt}", $item->end_date)
                ->setCellValue("H{$cnt}", $item->transaction_id)
                ->setCellValue("I{$cnt}", $item->payment_gateway)
                ->setCellValue("J{$cnt}", $item->coupon_applied)
                ->setCellValue("K{$cnt}", $item->coupon_id)
                ->setCellValue("L{$cnt}", $item->actual_cost)
                ->setCellValue("M{$cnt}", $item->discount_amount)
                ->setCellValue("N{$cnt}", $item->after_discount)
                ->setCellValue("O{$cnt}", $item->paid_amount)
                ->setCellValue("P{$cnt}", $item->currency)
                ->setCellValue("Q{$cnt}", $item->created_at)
                ->setCellValue("R{$cnt}", $item->payment_status)
                ->setCellValue("S{$cnt}", $item->plan_type)
            ;
            // $item_type, $item->payment_gateway, $item->, $item->paid_by_parent, $item->paid_by, $item->cost, $item->, $item->, $item->actual_cost, $item->discount_amount, $item->after_discount, $item->paid_amount, $item->payment_status, $item->created_at, $item->updated_at));
            $cnt++;
        }


        $writer = new Xlsx($spreadsheet);
        //$writer->save(time().'_report.xlsx');
        if(isset($from_date) && isset($to_date)){
            $from_date = str_replace(array('/', ' '), array('-', ''), $from_date);
            $to_date = str_replace(array('/', ' '), array('-', ''), $to_date);
            $filename='Report_'.$from_date.'-'.$to_date.'_'.time().'.xlsx';
        }else{
            $filename='Report_All_Orders_'.time().'.xlsx';
        }

        $filePath = 'lms/reports/' . $filename;

        ob_start();
        $writer->save('php://output');
        $content = ob_get_contents();
        ob_end_clean();

        Storage::disk('s3')->put($filePath,  $content,'public');
        // echo '<a href='.UPLOADS.$filePath.'>Download</a>';

        toastr()->success('Report Created successfully!');
//        return redirect()->back()->withSuccess('IT WORKS!');
        // return redirect(UPLOADS.$filePath);


//        $view_name = getTheme().'::payments.reports.payments-export';
//        return view($view_name, $data);
        return redirect(url('/payments-report/export?record=true&reporturl='.UPLOADS.$filePath));




        //        $this->payment_records = $records;


        //   $this->downloadExcel();

    }

    public function getPaymentRecords()
    {
        return $this->payment_records;
    }

    public function downloadExcel()
    {
        if(!checkRole(getUserGrade(2)))
        {
            prepareBlockUserMessage();
            return back();
        }


    }

    public function downloadExcel_OLD()
    {
        if(!checkRole(getUserGrade(2)))
        {
            prepareBlockUserMessage();
            return back();
        }
        Excel::create('payments_report', function($excel) {
            $excel->sheet('payments_records', function($sheet) {
                $sheet->row(1, array('sno','slug', 'ItemID', 'Purchased Item Name','User ID','Instructor ID','Plan Startdate','Plan Enddate','Plan Type', 'Payment Gateway', 'TransactionID','Paid by parent', 'Paid UserID', 'Cost', 'Coupon Applied', 'Currency', 'Currency Icon', 'CouponID', 'Actual Cost', 'Discount Amount', 'After Discount', 'Paid Amount', 'Payment status', 'Other Details', 'Transaction record', 'Notes', 'admin comments', 'created_datetime','updated_datetime'));
                $records = $this->getPaymentRecords();
                $cnt = 2;
                foreach ($records as $item) {
                    $item_type = ucfirst($item->plan_type);
                    if($item->plan_type=='combo')
                        $item_type = 'Exam Series';

                    $sheet->appendRow($cnt, array(($cnt-1), $item->item_id, $item->item_name, $item->user_id, $item->start_date, $item->end_date, $item_type, $item->payment_gateway, $item->transaction_id, $item->paid_by_parent, $item->paid_by, $item->cost, $item->coupon_applied, $item->coupon_id, $item->actual_cost, $item->discount_amount, $item->after_discount, $item->paid_amount, $item->payment_status, $item->created_at, $item->updated_at));
                    $cnt++;
                }
            });


        })->download('xlsx');
    }

    public function getPaymentRecord(Request $request)
    {
        if(!checkRole(getUserGrade(2)))
        {
            prepareBlockUserMessage();
            return back();
        }
        $payment_record = Payment::where('id','=',$request->record_id)->first();
        $result['status'] = 0;
        $result['record'] = null;
        if($payment_record)
        {
            $result['status'] = 1;
            $result['record'] = $payment_record;
        }
        return json_encode($result);
    }

    public function validateAndApproveZeroDiscount($token, Request $request)
    {

        $payment_record = Payment::where('slug','=',$token)->first();


        return $this->approvePayment($payment_record,$request, 1);

    }

    public function approvePayment(Payment $payment_record,Request $request ,$iscoupon_zero = 0)
    {



        if($payment_record->plan_type == 'combo')
        {
            $item_model = new ExamSeries();
        }


        if($payment_record->plan_type == 'exam') {
            $item_model = new Quiz();
        }

        if($payment_record->plan_type == 'lms') {
            $item_model = new LmsSeries();
        }

        $item_details = $item_model->where('id', '=',$payment_record->item_id)->first();

        $daysToAdd = '+'.$item_details->validity.'days';

        $payment_record->start_date = date('Y-m-d');
        $payment_record->end_date = date('Y-m-d', strtotime($daysToAdd));

        $details_before_payment          = (object)json_decode($payment_record->other_details);
        $payment_record->coupon_applied  = $details_before_payment->is_coupon_applied;
        $payment_record->coupon_id       = $details_before_payment->coupon_id;
        $payment_record->actual_cost     = $details_before_payment->actual_cost;
        $payment_record->discount_amount = $details_before_payment->discount_availed;
        $payment_record->after_discount  = $details_before_payment->after_discount;
        $payment_record->paid_amount     = $details_before_payment->after_discount;

        if(!$iscoupon_zero)
            $payment_record->admin_comments = $request->admin_comment;

        $payment_record->payment_status = PAYMENT_STATUS_SUCCESS;

        $user = getUserRecord($payment_record->user_id);

        $email_template = 'offline_subscription_success';
        try{
            if($iscoupon_zero){
                // $email_template = 'subscription_success';

                // sendEmail($email_template, array('username'=>$user->name,
                // 'plan' => $payment_record->plan_type,
                // 'to_email' => $user->email));

                $email_template = 'subscription_success';
                $subject  = getPhrase($email_template);
                $template     = new EmailTemplate();
                $content_data   =  $template->sendEmailNotification($email_template,

                    array('username'  =>$user->name,
                        'plan'     => $payment_record->plan_type,
                        'to_email' => $user->email));

                // $user->notify(new \App\Notifications\UsersNotifcations($user,$content_data,$subject));

                try {
                    $user->notify(new \App\Notifications\AdminApproveOfflinePayment($user,$payment_record->plan_type));

                } catch (Exception $e) {

                }

            }


            else {
                // sendEmail($email_template, array('username'=>$user->name,
                // 'plan' => $payment_record->plan_type,
                // 'to_email' => $user->email, 'admin_comment'=>$request->admin_comment));

                $template    = new EmailTemplate();
                $subject  = getPhrase($email_template);
                $content_data =  $template->sendEmailNotification($email_template,
                    array('username' =>$user->name,
                        'plan'     => $payment_record->plan_type,
                        'to_email' => $user->email,
                        'admin_comment'=>$request->admin_comment));

                // $user->notify(new \App\Notifications\UsersNotifcations($user,$content_data,$subject));

                try {
                    $user->notify(new \App\Notifications\AdminApproveOfflinePayment($user,$payment_record->plan_type));

                } catch (Exception $e) {

                }
            }

        }
        catch(Exception $ex)
        {

            $message = getPhrase('\ncannot_send_email_to_user, please_check_your_server_settings');
            $exception = 1;
        }

        $payment_record->save();

        if($payment_record->coupon_applied)
        {
            $this->couponcodes_usage($payment_record);
        }

        return TRUE;
    }


    public function razorpaySuccess(Request $request)
    {

        // dd($request);
        $user    = Auth::user();
        //Input items of form
        $input = Input::all();

        //get API Configuration 
        $api = new Api(env('RAZORPAY_APIKEY'), env('RAZORPAY_SECRET'));
        //Fetch payment information by razorpay_payment_id
        $payment = $api->payment->fetch($input['razorpay_payment_id']);

        if(count($input)  && !empty($input['razorpay_payment_id'])) {

            try {

                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount'=>$payment['amount']));
                // dd($response);

                $item = $this->getPackageDetails($request->type, $request->item_name);
                $user = getUserRecord();

                if($request->parent_user)
                    $user = getUserRecord($request->selected_child_id);

                $payment_record                  = new Payment();
                $payment_record->transaction_id  = $request->razorpay_payment_id;
                $payment_record->item_id         = $item->id;
                $payment_record->item_name       = $item->title;
                $payment_record->plan_type       = $request->type;
                $payment_record->payment_gateway = 'Razorpay';
                $payment_record->slug            = str_slug(getHashCode());
                $payment_record->cost            = $item->cost;
                $payment_record->user_id         = $user->id;
                $payment_record->payment_status  = PAYMENT_STATUS_SUCCESS;
                $payment_record->coupon_applied  = $request->is_coupon_applied;
                $payment_record->coupon_id       = $request->coupon_id;
                $payment_record->actual_cost     = $request->actual_cost;
                $payment_record->discount_amount = $request->discount_availed;
                $payment_record->after_discount  = $request->after_discount;
                $payment_record->paid_by         = $response->email;
                $payment_record->paid_amount     = $request->after_discount;
                $payment_record->paid_by_parent  = $request->parent_user;

                $daysToAdd = '+'.$item->validity.'days';

                $payment_record->start_date = date('Y-m-d');
                $payment_record->end_date = date('Y-m-d', strtotime($daysToAdd));

                $payment_record->save();

                if($payment_record->coupon_applied)
                {
                    $this->couponcodes_usage($payment_record);
                }



            } catch (\Exception $e) {
// dd($e->getMessage());
                flash('Ooops..!',$e->getMessage(),'overlay');
                return redirect(URL_PAYMENTS_CHECKOUT.$request->type.'/'.$request->item_name);
            }

            flash('success','your_payment_done_successfully','success');
            return redirect(URL_PAYMENTS_LIST.$user->slug);

            // Do something here for store payment details in database...
        }

    }

}
