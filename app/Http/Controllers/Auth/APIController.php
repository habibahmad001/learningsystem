<?php

namespace App\Http\Controllers\Auth;

use \App;
use App\User;
use Validator;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use \Auth;
use DB;
use Socialite;
use Exception;

class APIController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    // use AuthenticatesAndRegistersUsers, ThrottlesLogins;
    use  ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';
    protected $dbuser = '';
    protected $provider = '';


    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
                $this->middleware('guest', ['except' => 'logout']);
        // $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

       /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|max:255|unique:users',
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  Request  $request
     * @return User
     */
    public function APIpostRegister(Request $request)
    {

        $users = User::where('email', $request->email)->get();

        # check if email is more than 1
        if(sizeof($users) > 0){
            $msg = 'This user email already signed up !';
            return response(array(
                'success' => true,
                'data' => "UserExist",
                'message' => $msg
            ),200,[]);
        }

        $users = User::where('username', $request->username)->get();

        # check if email is more than 1
        if(sizeof($users) > 0){
            $msg = 'Choose different username, '.$request->username.' already exist!';
            return response(array(
                'success' => true,
                'data' => "DifferentUsername",
                'message' => $msg
            ),200,[]);
        }

//        $rechaptcha_status    = getSetting('enable_rechaptcha','recaptcha_settings');

//        if ( $rechaptcha_status  == 'yes') {
//
//            $columns = array(
//                'first_name'     => 'bail|required|max:250|',
//                'last_name'     => 'bail|required|max:250|',
//                'username' => 'bail|required|unique:users,username',
//                'email'    => 'bail|required|unique:users,email',
//                'password' => 'bail|required|min:5',
//                'password_confirmation'=>'bail|required|min:5|same:password',
//                'g-recaptcha-response' => 'required|captcha',
//                'agree-term' => 'required',
//            );
//
//
//            $messsages = array(
//
//                'g-recaptcha-response.required'=>'Please Select Captcha',
//                'agree-term.required' => 'Please select terms of service.' ,
//
//            );
//
//            $this->validate($request,$columns,$messsages);
//
//        }
//        else {
//
//            $columns = array(
//                'first_name'     => 'bail|required|max:250|',
//                'last_name'     => 'bail|required|max:250|',
//                'username' => 'bail|required|unique:users,username',
//                'email'    => 'bail|required|unique:users,email',
//                'password' => 'bail|required|min:5',
//                'password_confirmation'=>'bail|required|min:5|same:password',
//                'agree-term' => 'required',
//            );
//
//            $this->validate($request,$columns);
//
//        }




        $role_id = STUDENT_ROLE_ID;
        if ($request->is_student==1)
            $role_id = STUDENT_ROLE_ID;


        $user                   = new User();
        $name                   = $request->first_name." ".$request->last_name;
        $user->name=$name;
        $user->first_name       = $request->first_name;
        $user->last_name        = $request->last_name;
        $user->username         = $request->username;
        $user->email            = $request->email;
        $password               = $request->password;
        $user->password         = bcrypt($password);
        $user->role_id          = $role_id;


        $user->login_enabled  = 1;

        $user->save();


        $user->roles()->attach($user->role_id);

        try
        {
            if (!env('DEMO_MODE')) {

//                sendEmail('newuserregister_admin', array('user_name'=>  $request->username,
//                    'send_to' => 'admin',
//                    'to_email' => $request->email,
//                    'email' => $request->email,
//                    'name' => $name,
//                    'url' => url('/') ));
//
//                sendEmail('registration', array(
//                    'name'=> $request->first_name,
//                    'to_email' => $request->email,
//                    'username' => $request->username,
//                    'password' => $password,
//                    'url' => url('/') ));
            }

            return response(array(
                'success' => true,
                'data' => $user,
                'message' => 'You are Registered Successfully. Please Check Your Email!'
            ),200,[]);



//            $login_status = FALSE;
//            if (Auth::attempt(['username' => $request->email, 'password' => $request->password])) {
//                // return redirect(PREFIX);
//                $login_status = TRUE;
//            }
//
//            elseif (Auth::attempt(['email'=> $request->email, 'password' => $request->password])) {
//                $login_status = TRUE;
//            }

//            toastr()->success('You are Registered Successfully. Please Check Your Email!');
//            if($login_status){
//                $cookie='';
//                if(isset($_COOKIE['preurl'])){
//                    $cookie=$_COOKIE['preurl'];
//                }
//                if(checkRole(getUserGrade(5))) {
//                    if (stripos('/checkout', $cookie) !== false) {
//                        return redirect(url($cookie));
//                    } else {
//                        return redirect(URL_STUDENT_LMS_SERIES)->with('message', 'You registered Successfully. Please Check Your Email!');
//                    }
//                }
//            }

        }
        catch(Exception $ex)
        {
            $message = "Connection failed: " . $ex->getMessage();
//            $flash = app('App\Http\Flash');
//            $flash->create('Ooops...!', $message, 'error', 'flash_overlay',FALSE);
            return response(array(
                'success' => true,
                'data' => "Request Fail",
                'message' => $message
            ),200,[]);
        }

    }



    /**
     * This is method is override from Authenticate Users class
     * This validates the user with username or email with the sent password
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function APILogin(Request $request)
    {
        $login_status = FALSE;
        if (Auth::attempt(['username' => $request->email, 'password' => $request->password])) {
            // return redirect(PREFIX);
            $login_status = TRUE;
        }

        elseif (Auth::attempt(['email'=> $request->email, 'password' => $request->password])) {
            $login_status = TRUE;
        }

        if(!$login_status)
        {
            return response(array(
                'success' => true,
                'data' => "Faild",
                'message' => "Login request is fail."
            ),200,[]);
        }

        /**
         * Check if the logged in user is parent or student
         * if parent check if admin enabled the parent module
         * if not enabled show the message to user and logout the user
         */

        if($login_status) {
            if(checkRole(getUserGrade(7)))  {
                if(!getSetting('parent', 'module')) {
                    return response(array(
                        'success' => true,
                        'data' => "Parent",
                        'message' => "Current User is parent user."
                    ),200,[]);
                }
            }
        }

        /**
         * The logged in user is student/admin/owner
         */
        if($login_status)
        {
            if(checkRole(getUserGrade(5)))  {
                return response(array(
                    'success' => true,
                    'data' => "Leaner",
                    'message' => "Current User is leaner."
                ),200,[]);
            }

            if(checkRole(getUserGrade(2)))  {
                return response(array(
                    'success' => true,
                    'data' => "Admin",
                    'message' => "Current User is admin."
                ),200,[]);
            }

        }




    }


    public function APIcheckIsUserAvailable($user)
    {
        
        $id         = $user->getId();
        $nickname   = $user->getNickname();
        $name       = $user->getName();
        $email      = $user->getEmail();
        $avatar     = $user->getAvatar();
 
        $this->dbuser = User::where('email', '=',$email)->first();
        
        if($this->dbuser) {
            //User already available return true
            return TRUE;
        }
        
        $newUser = array(
                            'name' => $name,
                            'email'=>$email,
                        );
        $newUser = (object)$newUser;

        $userObj = new User();
       $this->dbuser = $userObj->registerWithSocialLogin($newUser);
       $this->dbuser = User::where('slug','=',$this->dbuser->slug)->first();
       // $this->sendPushNotification($this->dbuser);
       return TRUE;
     
    }


     public function APIresetUsersPassword(Request $request)
     {
        // dd($request);
         $user  = User::where('email','=',$request->email)->first();

         if(!$user) {
             return redirect("/login?msg=1")->with('message', 'email no existed , Thanks!');
         }

         
          DB::beginTransaction();

         try{

         if($user!=null){

           $password       = str_random(8);
           $user->password = bcrypt($password);

           $user->save();
           
           DB::commit();

          // $user->notify(new \App\Notifications\UserForgotPassword($user,$password));

             sendEmail('forgotpassword', array('username'=> $user->username,
                 'to_email' => $user->email,
                 'email' =>$user->email,
                 'password' => $password,
                 'url' => url('/')));

             toastr()->success('New Password is sent to your Email, Thanks!');
             return redirect("/login?msg=2")->with('message', 'Email has been submitted, Thanks!');

//           flash('Success', 'new_password_is_sent_to_your_email_account', 'success');

         }

         else{
             toastr()->error('email no existed , Thanks!');

//             flash('Ooops','email_is_not_existed','error');
            
         }
      }

      catch(Exception $ex){
          DB::rollBack();
// dd($e->getMessage());
         flash('oops...!', $ex->getMessage(), 'error');

      }
         
         
        return redirect(URL_USERS_LOGIN);
         
     } 

}
