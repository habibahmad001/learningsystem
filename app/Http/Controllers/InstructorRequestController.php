<?php

namespace App\Http\Controllers;

 
use App\Instructor;
 
use App\User;

use App\LmsCategory;
use App\LmsSeries;
use Illuminate\Http\Request;
use \App;
use App\Http\Requests;
use Auth;
use App\GeneralSettings as Settings;
use Image;
use ImageSettings;
use Yajra\Datatables\Datatables;
use DB;
use Illuminate\Support\Facades\Hash;
use Excel;
use Input;
use File;
use Artisan;
use App\OneSignalApp;
use Exception;
use Illuminate\Support\Facades\Storage;

class InstructorRequestController extends Controller
{
    public function index()
    {
        $data['records'] = FALSE;
        $data['layout'] = getLayout();
        $data['active_class'] = 'instructors';
        $items = Instructor::where('status', '0')->get();
        $data['items'] = $items;
        $data['title'] = getPhrase('instructors requests');
        return view(getTheme() . '::instructor_request.index',$data);
    }
    public function getDatatable($slug = '')
    {
        $records = array();

        //  $role = App\Role::getRoleId($slug);

        $records = Instructor::select(['fname', 'lname', 'id', 'image', 'email', 'mobile', 'gender', 'detail', 'status', 'user_id', 'updated_at'])

            ->orderBy('updated_at', 'desc');
        /*$records = User::select(['name','id', 'image', 'email', 'roles.display_name as role', 'login_enabled', 'role_id', 'slug', 'updated_at'])
            ->where('role_id','=',7)
            ->orderBy('updated_at', 'desc');*/



        return Datatables::of($records)
            // ->addColumn('action', function ($user) {
            //         return '<a href="#edit-'.$user->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
            //     })
            ->addColumn('check_course', function ($records) {
                $link_data1 = '<input name="checkbox_course[]" type="checkbox" class="delete_check" id="delcheck_'.$records->id.'"   value="'.$records->id.'">';
                return $link_data1;
            })
            ->addColumn('action', function ($records) {

                $link_data = '<div class="dropdown more">
                        <a id="dLabel" type="button" class="more-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-dots-vertical"></i>
                        </a>

                        <ul class="dropdown-menu" aria-labelledby="dLabel">
                           <li><a href="' . URL_INSTRUCTORSREQUEST_REVIEW. $records->id . '"><i class="fa fa-pencil"></i>' . getPhrase("review") . '</a></li>';

                $temp = '';


                    $temp = '<li><a href="javascript:void(0);" onclick="deleteRecord(\'' . $records->id . '\');"><i class="fa fa-trash"></i>' . getPhrase("delete") . '</a></li>';


                $temp .= '</ul> </div>';
                $link_data .= $temp;
                return $link_data;
            })
            ->editColumn('fname', function ($records) {


                return ucfirst($records->fname.' '.$records->lname);
            })
                ->editColumn('status', function ($records) {
if($records->status==0){
    return '<div class="badge badge-danger">Pending</div>';
}else{
    return '<div class="badge badge-success">Approved</div>';
}

                })

            ->editColumn('image', function ($records) {
                return '<img src="' .  IMAGE_PATH_INSTRUCTOR.$records->image  . '"  />';
            })
            ->rawColumns(['fname', 'status','image', 'action','check_course'])
            ->removeColumn('id')
            ->removeColumn('updated_at')
            // ->addAction('action',['printable' => false])


            ->make();
    }

    public function create()
    {
        $data = Instructor::all();
        return view(getTheme() . '::instructor_request.create',compact('data'));
    }

    public function review($id)
    {


        $record = Instructor::where('id', $id)->first();




        $data['show'] = $record;

        $data['active_class'] = 'instructors';
        $data['title'] = getPhrase('reviews_and_approve_instructor');
        $data['layout'] = getLayout();
        // dd($data);
        // return view('users.add-edit-user', $data);

        $view_name = getTheme() . '::instructor_request.review';
        return view($view_name, $data);


    }

    public function update(Request $request, $id)
    {
        //dd($request);
        if(isset($request->approve_status))
            $status = 1;
        else
            $status = 0;





        if($status){

            $data = Instructor::findorfail($id);
            $input['status'] = $request->status;


            if($data->status == 1 ){
                $show = User::where('id', $request->user_id)->first();
                $rolerecord = App\Role::getRoleId( $request->role);

                $role=$rolerecord->id;
                User::where('id', $request->user_id)
                    ->update(['role_id' => $role]);



                Instructor::where('user_id', $request->user_id)
                    ->update(['status' => 1]);

            }else{
                $rolerecord = App\Role::getRoleId( $request->role);

                $role=$rolerecord->id;
                $abc['role_id'] = $role;
                $password       = '@'.$request->fname.'_123';

                $users = User::where('email', $request->email)->get();

                # check if email is more than 1
                if(sizeof($users) > 0){
//                    $password='XXXXX';
                    $username=$users[0]->username;
                    $name=$users[0]->name;
                    $user_id=$users[0]->id;
                    $previous_role_id = $users[0]->role_id;
                    Instructor::where('user_id', $request->user_id)
                        ->where('id',$id)
                        ->update(['status' => 1]);

                    User::where('email', $request->email)
                        ->update([
                            'role_id' => $role,
                            'phone' => $request->mobile,
                            'subject' => $request->subject,
                            'password' => bcrypt($password),
                            'detail' => $request->detail
                        ]);
                    DB::table('role_user')
                        ->where('user_id', '=', $user_id)
                        ->where('role_id', '=', $previous_role_id)
                        ->delete();
                    $users[0]->roles()->attach($role);

                    sendEmail('instructor_approved', array(
                        'to_email' => $request->email,
                        'name' => $name,
                        'username' => $username,
                        'password' => $password
                    ));


                }else{

                    $user           = new User();
                    $name           = $request->fname." ".$request->lname;
                    $user->name=$name;
                    $user->first_name     = $request->fname;
                    $user->last_name     = $request->lname;
                    $user->username = $request->username.'_'.$request->ins_id;
                    $user->email    = $request->email;
//            $user->dob    = $request->dob;
                    $user->phone    = $request->mobile;
                    $user->image    = $request->image;
                    $user->role_id        = $role;

                    $user->password       = bcrypt($password);
                    $user->login_enabled  = 1;

                    $user->save();


                    $user->roles()->attach($user->role_id);


                    Instructor::where('email', $request->email)
                        ->update(['status' => 1],['user_id' => $user->id]);

                    sendEmail('instructor_approved', array(
                        'to_email' => $request->email,
                        'name' => $name,
                        'username' => $user->username,
                        'password' => $password
                    ));

                }


            }





            flash('success', 'instructor_approved_successfully', 'success');


        }
        else
        {
            $show = User::where('email', $request->email)->first();
            // dd($show);
            if ($show) {
                $previous_role_id = $show->role_id;
                $rolerecord = App\Role::getRoleId('student');
                $role = $rolerecord->id;
                if (isset($show->id)) {
                    User::where('id', $show->id)
                        ->update(['role_id' => $role]);

                }
                DB::table('role_user')
                    ->where('user_id', '=', $show->id)
                    ->where('role_id', '=', $previous_role_id)
                    ->delete();
                $show->roles()->attach($role);
                Instructor::where('id', $id)
                    ->update(['status' => 0]);
            }else{
                Instructor::where('id', $id)
                    ->update(['status' => 0]);
            }
            // dd($request);


            flash('success', 'instructor_deactivated_successfully', 'success');


        }


        return redirect()->route('requestinstructor.index');
    }

    public function delete($id)
    {
        $records = Instructor::where('id', $id)->first();
        App\User::where('email', $records->email)->delete();
        DB::table('instructors')->where('id',$id)->delete();
        $response['status'] = 1;
        $response['message'] = getPhrase('record_deleted_successfully');
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
        $records = Instructor::whereIn('id', $id_array);
        $recordsData = Instructor::whereIn('id', $id_array)->get();

        try {
            foreach($recordsData as $data) {
                App\User::where('email', $data->email)->delete();
            }

            $records->delete();

            $response['status'] = 1;
            $response['message'] = getPhrase('user(s)_deleted_successfully');
        } catch (\Illuminate\Database\QueryException $e) {
            $response['status'] = 0;
            if (getSetting('show_foreign_key_constraint', 'module'))
                $response['message'] = $e->errorInfo;
            else
                $response['message'] = getPhrase('this_record_is_in_use_in_other_modules');
        }
        return json_encode($response);

    }

    public function allinstructor()
    {
        $items = Instructor::all();
        return view(getTheme() . '::admin.instructor.all_instructor.index',compact('items'));
    }

    public function instructorpage()
    {
        return view(getTheme() . '::front.instructor');
    }


    public function instructor(Request $request)
    {
//dd($request);

        $instructor_resume='';
        $instructor_picture='';

        $users = Instructor::where('email', $request->email)
           // ->orwhere('user_id', $request->user_id)
                ->get();

        $rechaptcha_status    = getSetting('enable_rechaptcha','recaptcha_settings');



            $columns = array(
                'fname' => 'bail|required|max:250|',
                'lname' => 'bail|required|max:250|',
                'email' => 'bail|required|email',
                'subject'=>'bail|required|max:250|',
                'detail'=>'required'

            );
            $messsages = array(
                'fname.required'=>'First Name is required',
                'lname.required'=>'Last Name is required',
                'email.required'=>'Email is required',
                'subject.required'=>'Subject is required',
                'detail.required'=>'Additional Comments are required'
            );


        if ( $rechaptcha_status  == 'yes') {
            $columns['g-recaptcha-response']= 'required|captcha';
            $messsages['g-recaptcha-response.required'] ='Please Select Captcha';
        }

         $this->validate($request,$columns,$messsages);

        if(!$users->isEmpty()){
            return back()->with('delete','You application is already submitted ' );
        }
        else{

            $input = $request->all();

            if ($request->hasFile('image'))
            {
                $ext=$request->image->guessClientExtension();
                $random_str = rand(0,9999999);
                $fileName = $random_str.'_'.time().'.'.$ext;
               // $fileName = $record->id.'_'.$random_str.'.'.$request->image->guessClientExtension();
                $ThumbnailSize=250;
                $image_normal = Image::make($request->file('image'))->widen(1024, function ($constraint) {
                    $constraint->upsize();
                });
                $image_thumb = Image::make($request->file('image'))->fit($ThumbnailSize, 242, function ($constraint) {
                    $constraint->upsize();
                });
                if(env('FILESYSTEM_DRIVER')=='s3'){
                    uploadToS3($image_normal, 'instructors/images/', $fileName);
                    uploadToS3($image_thumb, 'instructors/images/thumbnail/', $fileName);
//
//                    $filePath = 'instructors/images/' . $fileName;
//                    Storage::disk('s3')->put($filePath, file_get_contents($fileName));
                }else{
                    $request->file('image')->move('public/uploads/instructors/images/', $fileName);
                }
                $input['image'] = $fileName;
                $instructor_picture=$fileName;

            }


            if($file = $request->file('file'))
            {
                $ext=$file->getClientOriginalExtension();
                $random_str = rand(0,9999999);
                $name = str_slug($request->fname).'_'.$random_str.'_'.time().'.'.$ext;


                if(env('FILESYSTEM_DRIVER')=='s3'){
                    $filePath = 'instructors/files/' . $name;
                    Storage::disk('s3')->put($filePath, file_get_contents($file));
                }else{
                    $file->move('public/uploads/instructors/files/',$name);
                }

                $input['file'] = $name;
                $instructor_resume=$name;
            }
                      
           // dd($input);

            $data = Instructor::create($input);
            $data->save();


            // $user->notify(new \App\Notifications\NewUserRegistration($user,$user->email,$password));
            sendEmail('newinstructor_ack', array(
                'to_email' => $request->email,
                'name' => $request->fname.' '.$request->lname,
//                'dob' => $request->dob,
                'mobile' => $request->mobile,
                'subject' => $request->subject,
                'detail' => $request->detail,
                'file' => $instructor_resume,
                'image' => $instructor_picture
            ));

            sendEmail('newinstructor_admin', array(
                'send_to' => 'admin',
                'to_email' => $request->email,
                'name' => $request->fname.' '.$request->lname,
//                'dob' => $request->dob,
                'mobile' => $request->mobile,
                'subject' => $request->subject,
                'detail' => $request->detail,
                'file' => $instructor_resume,
                'image' => $instructor_picture
            ));


        }

        toastr()->success('Thanks! Our Team will contact you soon');
        // toastr('Thanks! Our Team will contact you soon', 'success','Congratulations!');
        //flash('congratulations','our_team_will_contact_you_soon','success');
        return redirect(URL_INSTRUCTOR_APPLICATION.'#instructor')->with('status', 'We have received your instructor application successfully, we will be get in touch with you! ');




    }


    public function getInstructorRegister(){

        $data['active_class']       = 'faqs';
        $data['title']              = 'Instructor';
        $rechaptcha_status    = getSetting('enable_rechaptcha','recaptcha_settings');
        $data['rechaptcha_status']  = $rechaptcha_status;

        $view_name = getTheme().'::site.instructor-sign-up';
        return view($view_name, $data);
    }


    public function postInstructorRegister(Request $request)
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
            return redirect()->back()->with('message', $msg);
        }

        $users = User::where('username', $request->username)->get();

        # check if email is more than 1
        if(sizeof($users) > 0){
            # tell user not to duplicate same email
            $msg = 'Choose different username, '.$request->username.' already exist!';
            toastr()->info($msg);
            return redirect()->back()->with('message', $msg);
            //flash('info',$msg, 'overlay');
            //Session::flash('userExistError', $msg);
            //return back();
        }


        $rechaptcha_status    = getSetting('enable_rechaptcha','recaptcha_settings');

        if ( $rechaptcha_status  == 'yes') {

            $columns = array(
                'first_name'     => 'bail|required|max:250|',
                'last_name'     => 'bail|required|max:250|',
                'dob'     => 'bail|required|',
                'mobile'     => 'bail|required|max:250|',
                'gender'     => 'bail|required|max:250|',
                'detail'     => 'bail|required|',
                'email'    => 'bail|required|unique:instructors,email',
                'username' => 'bail|required|unique:users,username',

                'password' => 'bail|required|min:5',
                'password_confirmation'=>'bail|required|min:5|same:password',
                'g-recaptcha-response' => 'required|captcha',
                'agree-term' => 'required',
            );


            $messsages = array(

                'g-recaptcha-response.required'=>'Please Select Captcha',

            );

            $this->validate($request,$columns,$messsages);

        }
        else {

            $columns = array(
                'first_name'     => 'bail|required|max:250|',
                'last_name'     => 'bail|required|max:250|',
                'email'    => 'bail|required|unique:instructors,email',
                'username' => 'bail|required|unique:users,username',
                'password' => 'bail|required|min:5',
                'password_confirmation'=>'bail|required|min:5|same:password',
                'dob'     => 'bail|required|',
                'mobile'     => 'bail|required|max:250|',
                'gender'     => 'bail|required|max:250|',
                'detail'     => 'bail|required|',
                'agree-term' => 'required',
            );

            $this->validate($request,$columns);

        }




        $role_id = INSTRUCTOR_ROLE_ID;
        if ($request->is_instructor==1)
            $role_id = INSTRUCTOR_ROLE_ID;
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
        $user->phone        =  $request->mobile;

        $slug = str_slug($name);
        $user->slug           = $slug;


        $user->login_enabled  = 1;

        $user->save();


        $user->roles()->attach($user->role_id);

        $user->id;

        $users = Instructor::where('user_id', $user->id)->get();

        if(!$users->isEmpty()){
            return back()->with('delete','Already Submitted Application ' );
        }
        else{

            $instructor = new Instructor();

            $instructor->user_id     = $user->id;
            $instructor->fname     = $request->first_name;
            $instructor->lname     = $request->last_name;
            $instructor->dob = $request->dob;
            $instructor->email    = $request->email;

            $instructor->mobile        =  $request->mobile;
            $instructor->gender        =  $request->gender;
            $instructor->detail        =  $request->detail;




            if ($file = $request->file('image'))
            {
                $ext=$file->getClientOriginalExtension();
                $name = str_slug($request->first_name.'_'.$request->last_name).'_'.time().'.'.$ext;


                if(env('FILESYSTEM_DRIVER')=='s3'){
                    $filePath = 'instructors/images/' . $name;
                    Storage::disk('s3')->put($filePath, file_get_contents($file));
                }else{
                    $file->move('public/uploads/instructors/images/', $name);
                }
                $instructor->image = $name;
                $instructor_picture=$name;

            }


            if($file = $request->file('file'))
            {
                $ext=$file->getClientOriginalExtension();
                $name = str_slug($request->first_name.'_'.$request->last_name).'_'.time().'.'.$ext;


                if(env('FILESYSTEM_DRIVER')=='s3'){
                    $filePath = 'instructors/files/' . $name;
                    Storage::disk('s3')->put($filePath, file_get_contents($file));
                }else{
                    $file->move('public/uploads/instructors/files/',$name);
                }

                $instructor->file = $name;
                $instructor_resume=$name;
            }

            $instructor->save();

        }






        try
        {

            // $user->notify(new \App\Notifications\NewUserRegistration($user,$user->email,$password));
            sendEmail('newinstructor_ack', array(
                'to_email' => $request->email,
                'name' => $request->first_name.' '.$request->last_name,
                'username' => $request->username,
                'password' => $request->password,
                'dob' => $request->dob,
                'gender' => $request->gender,
                'mobile' => $request->mobile,
                'detail' => $request->detail,
                'file' => $instructor_resume,
                'image' => $instructor_picture
                ));

            sendEmail('newinstructor_admin', array(
                'send_to' => 'admin',
                'to_email' => $request->email,
                'name' => $request->first_name.' '.$request->last_name,
                'username' => $request->username,
                'password' => "XXXXXX",
                'dob' => $request->dob,
                'gender' => $request->gender,
                'mobile' => $request->mobile,
                'detail' => $request->detail,
                'file' => $instructor_resume,
                'image' => $instructor_picture
            ));




            toastr()->success('Your Application submitted Successfully. Please Check Your Email!');

             return redirect('/')->with('status', 'Thank you for getting in touch! ');

        }
        catch(Exception $ex)
        {
            $message = "Connection failed: " . $ex->getMessage();
            $flash = app('App\Http\Flash');
            $flash->create('Ooops...!', $message, 'error', 'flash_overlay',FALSE);
            return 0;
        }

    }



    protected function processUpload(Request $request, $record)
    {

        if (env('DEMO_MODE')) {
            return 'demo';
        }



        if ($request->hasFile('image')) {

            $imageObject = new ImageSettings();

            $destinationPath      = $imageObject->getInstructorPicsPath();
            $destinationPathThumb = $imageObject->getInstructorPicsThumbPath();
            $BlogThumbnailSize = $imageObject->getBlogThumbnailSize();

            $random_str = rand(0,9999999);

            $fileName = $record->id.'_'.$random_str.'.'.$request->image->guessClientExtension();

            $request->file('image')->move($destinationPath, $fileName);
            $record->image = $fileName;

            Image::make($destinationPath.$fileName)->resize(1024, 600)->save($destinationPath.$fileName);

            Image::make($destinationPath.$fileName)->resize($BlogThumbnailSize,'242')->save($destinationPathThumb.$fileName);
            $record->save();
        }
    }

}
