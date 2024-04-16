<?php

namespace App\Http\Controllers\Auth;

use \Auth;
use App\User;
use App\Instructor;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
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

	public function getRegister( $role = 'user' )
	{
        $data['active_class']   = 'register';
		$data['title'] 	= getPhrase('register');

         $rechaptcha_status    = getSetting('enable_rechaptcha','recaptcha_settings');
         $data['rechaptcha_status']  = $rechaptcha_status;

		// return view('auth.register', $data);
           $view_name = getTheme().'::auth.login';
        return view($view_name, $data);
	}

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    public function postRegister(Request $request)
     {

         $users = User::where('email', $request->email)->get();

         # check if email is more than 1
         if(sizeof($users) > 0){
             # tell user not to duplicate same email
             $msg = 'This user email already signed up !';
             //flash('info',$msg, 'overlay');
             //Session::flash('userExistError', $msg);
             //return back();
             toastr()->info($msg);
            // return redirect()->back()->with('message', $msg);
//             return redirect()->back()->withErrors('message', $msg);
             return redirect()->back()->withErrors([$msg]);
         }

         $users = User::where('username', $request->username)->get();

         # check if email is more than 1
         if(sizeof($users) > 0){
             # tell user not to duplicate same email
             $msg = 'Choose different username, '.$request->username.' already exist!';
             toastr()->info($msg);
//             return redirect()->back()->with('message', $msg);
             return redirect()->back()->withErrors([$msg]);
             //flash('info',$msg, 'overlay');
             //Session::flash('userExistError', $msg);
             //return back();
         }

        $rechaptcha_status    = getSetting('enable_rechaptcha','recaptcha_settings');

        if ( $rechaptcha_status  == 'yes') {

           $columns = array(
               'first_name'     => 'bail|required|max:250|',
               'last_name'     => 'bail|required|max:250|',
               'username' => 'bail|required|unique:users,username',
                        'email'    => 'bail|required|unique:users,email',
                        'password' => 'bail|required|min:5',
                        'password_confirmation'=>'bail|required|min:5|same:password',
                        'g-recaptcha-response' => 'required|captcha',
                        'agree-term' => 'required',
                        );


                      $messsages = array(

                          'g-recaptcha-response.required'=>'Please Select Captcha',
                          'agree-term.required' => 'Please select terms of service.' ,

                     );

               $this->validate($request,$columns,$messsages);

            }
             else {

                $columns = array(
                    'first_name'     => 'bail|required|max:250|',
                    'last_name'     => 'bail|required|max:250|',
                    'username' => 'bail|required|unique:users,username',
                            'email'    => 'bail|required|unique:users,email',
                            'password' => 'bail|required|min:5',
                            'password_confirmation'=>'bail|required|min:5|same:password',
                    'agree-term' => 'required',
                            );

                  $this->validate($request,$columns);

            }




        $role_id = STUDENT_ROLE_ID;
        if ($request->is_student==1)
            $role_id = STUDENT_ROLE_ID;
//            $role_id = PARENT_ROLE_ID;


        $user           = new User();
         $name           = $request->first_name." ".$request->last_name;
         $user->name=$name;
         $user->first_name     = $request->first_name;
         $user->last_name     = $request->last_name;
         $user->username = $request->username;
        $user->email    = $request->email;
        $password       = $request->password;
        $user->password       = bcrypt($password);
        $user->role_id        = $role_id;

        //$slug = str_slug($name);
        //$user->slug           = $slug;


        $user->login_enabled  = 1;

        $user->save();


        $user->roles()->attach($user->role_id);

        try
        {
            if (!env('DEMO_MODE')) {

             // $user->notify(new \App\Notifications\NewUserRegistration($user,$user->email,$password));
//                sendEmail('newuserregister', array('user_name'=> $name,
//                    'to_email' => $request->email,
//                    'password' => $password ));

                sendEmail('newuserregister_admin', array('user_name'=>  $request->username,
                    'send_to' => 'admin',
                    'to_email' => $request->email,
                    'email' => $request->email,
                    'name' => $name,
                    'url' => url('/') ));

                sendEmail('registration', array(
                    'name'=> $request->first_name,
                    'to_email' => $request->email,
                    'username' => $request->username,
                    'password' => $password,
                    'url' => url('/') ));
            }



        $login_status = FALSE;
        if (Auth::attempt(['username' => $request->email, 'password' => $request->password])) {
            // return redirect(PREFIX);
            $login_status = TRUE;
        }

        elseif (Auth::attempt(['email'=> $request->email, 'password' => $request->password])) {
            $login_status = TRUE;
        }

        toastr()->success('You are Registered Successfully. Please Check Your Email!');
        if($login_status){
            $cookie='';
            if(isset($_COOKIE['preurl'])){
                $cookie=$_COOKIE['preurl'];
            }
            if(checkRole(getUserGrade(5))) {
                if (stripos('/checkout', $cookie) !== false) {
                    return redirect(url($cookie));
                } else {
                    return redirect(URL_STUDENT_LMS_SERIES)->with('message', 'You registered Successfully. Please Check Your Email!');
                }
            }
        }

        }
        catch(Exception $ex)
        {
            $message = "Connection failed: " . $ex->getMessage();
            $flash = app('App\Http\Flash');
            $flash->create('Ooops...!', $message, 'error', 'flash_overlay',FALSE);
            return 0;
        }
//        flash('success','You Have Registered Successfully. Please Check Your Email', 'overlay');
//        return redirect( '/dashboard' );
     }




    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
		$name = $data['first_name'] . ' ' . $data['last_name'];
		$user    = new User();
		$user->name     = $name;
        $user->first_name     = $data['first_name'];
        $user->last_name    = $data['last_name'];
		$user->email     = $data['email'];
        $user->password = bcrypt($data['password']);
        if( $data['role'] == 'vendor' ) {
			$user->role_id  = VENDOR_ROLE_ID;
		} else {
			$user->role_id  = USER_ROLE_ID;
		}
        $user->slug     = str_slug($user->name);
		$user->confirmation_code = str_random(30);
		$link = URL_USERS_CONFIRM.'/'.$user->confirmation_code;
		$user->save();
		$user->roles()->attach($user->role_id);
		try{
        sendEmail('registration', array('user_name'=>$user->email, 'username'=>$user->email, 'to_email' => $user->email, 'password'=>$data['password'], 'confirmation_link' => $link));
          }
         catch(Exception $ex)
        {

        }
		flash('Success','You Have Registered Successfully. Please Check Your Email Address To Activate Your Account', 'success');
		return $user;
    }

	/**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function register(Request $request)
    {
		$data = array(
			'first_name' => $request->first_name,
			'last_name' => $request->last_name,
			'email' => $request->email,
			'password' => $request->password,
			'role' => $request->role,
		);
		$name = $data['first_name'] . ' ' . $data['last_name'];
		$user    = new User();
		$user->name     = $name;
        $user->first_name     = $data['first_name'];
        $user->last_name    = $data['last_name'];
		$user->email     = $data['email'];
        $user->password = bcrypt($data['password']);
        if( $data['role'] == 'vendor' ) {
			$user->role_id  = VENDOR_ROLE_ID;
		} else {
			$user->role_id  = USER_ROLE_ID;
		}
        $user->slug     = str_slug($user->name);
		$user->confirmation_code = str_random(30);
		$link = URL_USERS_CONFIRM . '/' . $user->confirmation_code;
		$user->save();
		$user->roles()->attach($user->role_id);
		try{
        sendEmail('registration', array('user_name'=>$user->email, 'username'=>$user->email, 'to_email' => $user->email, 'password'=>$data['password'], 'confirmation_link' => $link));
          }
         catch(Exception $ex)
        {

        }
		flash('success','You Have Registered Successfully. Please Check Your Email Address To Activate Your Account', 'success');
		return redirect( URL_USERS_LOGIN );
    }




    public function studentOnlineRegistration()
    {
        return view('auth.student-online-registration');
    }
}
