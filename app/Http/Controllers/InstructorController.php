<?php

namespace App\Http\Controllers;

use App\Instructor;

use App\LmsCategory;
use App\LmsSeries;
use Illuminate\Http\Request;
use \App;
use App\Http\Requests;
use App\User;
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


class InstructorController extends Controller
{

//    public function index()
//    {
//        if(Auth::User()->role == "instructor")
//        {
//            return view('instructor.dashboard');
//        }
//        else
//        {
//            return "You're Not a Instructor !";
//        }
//    }
    public function index()
    {
        if (!checkRole(getUserGrade(2))) {
            prepareBlockUserMessage();
            return back();
        }
        $data['records'] = FALSE;
        $data['layout'] = getLayout();
        $data['active_class'] = 'instructors';
        $data['title'] = getPhrase('instructors');
        // return view('lms.lmscontents.list', $data);
//dd($data);
        $view_name = getTheme() . '::instructors.list-users';
        return view($view_name, $data);
    }

    /**
     * This method returns the datatables data to view
     * @return [type] [description]
     */
    public function getDatatable($slug = '')
    {
        $records = array();

        $slug=7;

          //  $role = App\Role::getRoleId($slug);

            $records = User::join('roles', 'users.role_id', '=', 'roles.id')
                ->select(['users.name', 'users.id', 'image', 'email', 'roles.display_name as role', 'login_enabled', 'role_id', 'slug', 'users.updated_at'])
                ->where('users.role_id','=',7)
                ->orderBy('users.updated_at', 'desc');
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
                           <li><a href="' . URL_INSTRUCTORS_EDIT. $records->slug . '"><i class="fa fa-pencil"></i>' . getPhrase("edit") . '</a></li>';
                if (getRoleData($records->role_id) == 'instructor') {
                    $link_data .= ' <li><a href="'.url('/lms/series/'.$records->id).' "><i class="fa fa-book"></i>' . getPhrase("view_courses") . '</a></li>';
                }
                $temp = '';

                //Show delete option to only the owner user
                if (checkRole(getUserGrade(1)) && $records->id != \Auth::user()->id) {
                    $temp = '<li><a href="javascript:void(0);" onclick="deleteRecord(\'' . $records->slug . '\');"><i class="fa fa-trash"></i>' . getPhrase("delete") . '</a></li>';
//                    $temp .= '<li><a href="javascript:void(0);" onclick="deleteRecord(\''.$records->slug.'\');"><i class="fa fa-trash"></i>'. getPhrase("delete").'</a></li>';
                }
                //Show delete option to only the owner user
                if (checkRole(getUserGrade(1)) && $records->id != \Auth::user()->id) {
                    $temp .= '<li><form action="'.URL_AUTHADMIN_LOGIN.'" method="POST"><input type="hidden" name="slug"  id="slug" value="'.$records->id.'"><input name="_token" value="'.csrf_token().'" type="hidden">';
                    $temp .= '<a onclick="this.closest(\'form\').submit();return true;" ><i class="fa fa-user-secret"></i>' . getPhrase("Login as User") . '</a>';
                    $temp .= '</form></li>';
//                        $temp .= '<li><a href="javascript:void(0);" onclick="deleteRecord(\''.$records->slug.'\');"><i class="fa fa-trash"></i>'. getPhrase("delete").'</a></li>';
                }

                $temp .= '</ul> </div>';
                $link_data .= $temp;
                return $link_data;
            })
            ->editColumn('name', function ($records) {
                if (getRoleData($records->role_id) == 'student') {
                    return '<a href="' . URL_INSTRUCTORS_DETAILS. $records->slug . '">' . ucfirst($records->name) . '</a>'.'       ('.$records->role.')';
                }else{
                    return   '<span style="font-weight:bold">'.ucfirst($records->name) . '('.$records->role.')</span  >';
                }
                return ucfirst($records->name);
            })
            ->editColumn('image', function ($records) {
                return '<img src="' . getProfilePath($records->image,'thumb')  . '"  />';
//                return '<img src="' . getProfilePath($records->image) . '"  />';
            })
            ->rawColumns(['name', 'image', 'action','check_course'])
            ->removeColumn('role_id')
            ->removeColumn('id')
            ->removeColumn('slug')
            ->removeColumn('updated_at')
            // ->addAction('action',['printable' => false])


            ->make();
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        if (!checkRole(getUserGrade(4))) {
            prepareBlockUserMessage();
            return back();
        }

        $data['record'] = FALSE;
        $data['active_class'] = 'instructors';

        // $data['roles']        = $this->getUserRoles();
        $roles = \App\Role::select('display_name', 'id', 'name')->get();
        $final_roles = [];
        foreach ($roles as $role) {

            if (!checkRole(getUserGrade(1))) {

                if (!(strtolower($role->name) == 'admin' || strtolower($role->name) == 'owner'))
                    $final_roles[$role->id] = $role->display_name;
            } else
                $final_roles[$role->id] = $role->display_name;
        }
        $data['roles'] = $final_roles;
        $data['title'] = getPhrase('add_instructor');
        if (checkRole(['parent']))
            $data['active_class'] = 'children';
        $data['layout'] = getLayout();

        // return view('users.add-edit-user', $data);

        $view_name = getTheme() . '::instructors.add-edit-user';
        return view($view_name, $data);
    }

    /**
     * This method returns the roles based on the user type logged in
     * @param  [type] $roles [description]
     * @return [type]        [description]
     */
    public function getUserRoles()
    {
        $roles = \App\Role::pluck('display_name', 'id');

        return array_where($roles, function ($key, $value) {
            if (!checkRole(getUserGrade(1))) {
                if (!($value == 'Admin' || $value == 'Owner'))
                    return $value;
            } else
                return $value;
        });
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {


        $instructor_resume='';
        $instructor_picture='';

        $users = Instructor::where('email', $request->email)
            // ->orwhere('user_id', $request->user_id)
            ->get();



        $columns = array(
            'fname' => 'bail|required|max:250|',
            'lname' => 'bail|required|max:250|',
            'email' => 'bail|required|email',
            'subject'=>'bail|required|max:250|',
            'detail'=>'required',
            'uname'=>'required',
            'designation'=>'required',
            'rating'=>'required',
            'reviews'=>'required',
            'students'=>'required',
            'ncourses'=>'required',
            'introduction'=>'required',
            'baddress'=>'required',

        );
        $messsages = array(
            'fname.required'=>'First Name is required',
            'lname.required'=>'Last Name is required',
            'email.required'=>'Email is required',
            'subject.required'=>'Subject is required',
            'detail.required'=>'Additional Comments are required',
            'uname.required'=>'User Name is required',
            'designation.required'=>'Designation is required',
            'rating.required'=>'Instructor Rating is required',
            'reviews.required'=>'Number of Reviews is required',
            'students.required'=>'Number of Students is required',
            'ncourses.required'=>'Number of courses is required',
            'introduction.required'=>'Instructor introduction is required',
            'baddress.required'=>'Billing Address is required',
        );



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

//             dd($input);

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
      //  return redirect(URL_INSTRUCTOR_APPLICATION.'#instructor')->with('status', 'We have received your instructor application successfully, we will be get in touch with you! ');
        return redirect(URL_INSTRUCTORS)->with('success','Instructor added Successfully !');

/*



        $columns = array(
            'first_name' => 'bail|required|max:100|',
            'last_name' => 'bail|required|max:100|',
            'username' => 'bail|required|unique:users,username',
            'email' => 'bail|required|unique:users,email',
            'image' => 'bail|mimes:png,jpg,jpeg|max:2048',
//            'password' => 'bail|required|min:5',
//            'password_confirmation' => 'bail|required|min:5|same:password',
        );

        if (checkRole(getUserGrade(2)))
            $columns['role_id'] = 'bail|required';


        $this->validate($request, $columns);

        $role_id = getRoleData('student');

        if ($request->role_id)
            $role_id = $request->role_id;

        $user = new User();
        $name = $request->first_name.' '.$request->last_name;
        $user->name = $name;
        $user->email = $request->email;

//        $password = $request->password;
        $password = str_random(8);

        $user->password = bcrypt($password);
        if (checkRole(['parent']))
            $user->parent_id = getUserWithSlug()->id;

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->role_id = $role_id;
        $user->login_enabled = 1;
        $slug = str_slug($name);
        $user->username = $request->username;
        $user->slug = $slug.'-'.$user->username;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->save();


        //if(!env('DEMO_MODE')) {
        $hasRole = $user->roles()->where('role_user.role_id', $user->role_id)->exists();
        if (!$hasRole){
            $user->roles()->attach($user->role_id);
        }
        $this->processUpload($request, $user);
        //}
        $message = getPhrase('record_added_successfully_with_password ') . ' ' . $password;
        $exception = 0;
        try {
            if (!env('DEMO_MODE')) {
                $user->notify(new \App\Notifications\NewUserRegistration($user, $user->email, $password));

            }

            //$this->sendPushNotification($user);
        } catch (Exception $ex) {
            $message = getPhrase('record_added_successfully_with_password ') . ' ' . $password;
            $message .= getPhrase('\ncannot_send_email_to_user, please_check_your_server_settings');
            $exception = 1;
        }

        $flash = app('App\Http\Flash');
        $flash->create('Success...!', $message, 'success', 'flash_overlay', FALSE);


        if (checkRole(['parent']))
            return redirect('dashboard');

        return redirect(URL_INSTRUCTORS)->with('success','Instructor added Successfully !');*/
    }


    public function sendPushNotification($user)
    {
        if (getSetting('push_notifications', 'module')) {
            if (getSetting('default', 'push_notifications') == 'pusher') {
                $options = array(
                    'name' => $user->name,
                    'image' => getProfilePath($user->image),
                    'slug' => $user->slug,
                    'role' => getRoleData($user->role_id),
                );

                pushNotification(['owner', 'admin'], 'newUser', $options);
            } else {
                $this->sendOneSignalMessage('New Registration');
            }
        }
    }

    /**
     * This method sends the message to admin via One Signal
     * @param string $message [description]
     * @return [type]          [description]
     */
    public function sendOneSignalMessage($new_message = '')
    {
        $gcpm = new OneSignalApp();

        $message = array(
            "en" => $new_message,
            "title" => 'New Registration',
            "icon" => "myicon",
            "sound" => "default"
        );
        $data = array(
            "body" => $new_message,
            "title" => "New Registration",
        );

        $gcpm->setDevices(env('ONE_SIGNAL_USER_ID'));
        $response = $gcpm->sendToAll($message, $data);
    }


    protected function processUpload(Request $request, User $user)
    {

//       if(env('DEMO_MODE')) {
//        return 'demo';
//       }

        if ($request->hasFile('image')) {

            $imageObject = new ImageSettings();

            $destinationPath = $imageObject->getProfilePicsPath();
            $destinationPathThumb = $imageObject->getProfilePicsThumbnailpath();

            $fileName = $user->id . '.' . $request->image->guessClientExtension();;
            $request->file('image')->move($destinationPath, $fileName);
            $user->image = $fileName;

            Image::make($destinationPath . $fileName)->fit($imageObject->getProfilePicSize())->save($destinationPath . $fileName);

            Image::make($destinationPath . $fileName)->fit($imageObject->getThumbnailSize())->save($destinationPathThumb . $fileName);
            $user->save();
        }
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
        return URL_INSTRUCTORS;
    }

    /**
     * Display the specified resource.
     *
     * @param unique string  $slug
     * @return Response
     */
    public function show($slug)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param unique string  $slug
     * @return Response
     */
    public function edit($slug)
    {
        $record = User::where('slug', $slug)->get()->first();

        if ($isValid = $this->isValidRecord($record))
            return redirect($isValid);
        /**
         * Validate the non-admin user wether is trying to access other user profile
         * If so return the user back to previous page with message
         */

        if (!isEligible($slug))
            return back();


        /**
         * Make sure the Admin or staff cannot edit the Admin/Owner accounts
         * Only Owner can edit the Admin/Owner profiles
         * Admin can edit his own account, in that case send role type admin on condition
         */

        $UserOwnAccount = FALSE;
        if (\Auth::user()->id == $record->id)
            $UserOwnAccount = TRUE;

        if (!$UserOwnAccount) {
            $current_user_role = getRoleData($record->role_id);

            if ((($current_user_role == 'admin' || $current_user_role == 'owner'))) {
                if (!checkRole(getUserGrade(1))) {
                    prepareBlockUserMessage();
                    return back();
                }
            }
        }

        $records = Instructor::where('email', $record->email)->first();
//        dd($records);
        $data['record'] = $record;
        $data['records'] = $records;
        $data['uid'] = $record->id;
        $data['iid'] = $records->id;

        // dd('hrere');
        // $data['roles']              = $this->getUserRoles();

        $roles = \App\Role::select('display_name', 'id', 'name')->get();
        $final_roles = [];
        foreach ($roles as $role) {

            if (!checkRole(getUserGrade(1))) {

                if (!(strtolower($role->name) == 'admin' || strtolower($role->name) == 'owner'))
                    $final_roles[$role->id] = $role->display_name;
            } else
                $final_roles[$role->id] = $role->display_name;
        }
        $data['roles'] = $final_roles;


        if ($UserOwnAccount && checkRole(['admin']))
            $data['roles'][getRoleData('admin')] = 'Admin';

        $data['active_class'] = 'instructors';
        $data['title'] = getPhrase('edit_instructor');
        $data['layout'] = getLayout();
        // dd($data);
        // return view('users.add-edit-user', $data);

        $view_name = getTheme() . '::instructors.add-edit-user';
        return view($view_name, $data);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     * @return Response
     */
//    public function update(Request $request, $slug)
//    {
//        $record = User::where('slug', $slug)->get()->first();
//        $validation = [
//            'first_name' => 'bail|required|max:120|',
//            'last_name' => 'bail|required|max:120|',
//            'email' => 'bail|required|unique:users,email,' . $record->id,
//            'image' => 'bail|mimes:png,jpg,jpeg|max:2048',
//            'uname'=>'required',
//            'designation'=>'required',
//            'rating'=>'required',
//            'reviews'=>'required',
//            'students'=>'required',
//            'ncourses'=>'required',
//            'introduction'=>'required',
//            'baddress'=>'required',
//        ];
//
//        if (!isEligible($slug))
//            return back();
//
//        if (checkRole(getUserGrade(2)))
//            $validation['role_id'] = 'bail|required|integer';
//
//
//        $this->validate($request, $validation);
//
//        $name = $request->first_name.' '.$request->last_name;
//
//        $previous_role_id = $record->role_id;
//        if ($name != $record->name)
//            $record->slug = str_slug($name);
//
//        $record->name = $name;
//        $record->first_name = $request->first_name;
//        $record->last_name = $request->last_name;
//        $record->email = $request->email;
//
//        if (checkRole(getUserGrade(2)))
//            $record->role_id = $request->role_id;
//        $record->phone = $request->phone;
//        $record->address = $request->address;
//        $record->save();
//        if ($request->password) {
//            $password = $request->password;
//            $record->password = bcrypt($password);
//            $record->save();
//            $record->notify(new \App\Notifications\PasswordChanged($record, $record->email, $password));
//        }
//
//
//        if (checkRole(getUserGrade(2))) {
//            /**
//             * Delete the Roles associated with that user
//             * Add the new set of roles
//             */
//
//            if (!env('DEMO_MODE')) {
//                DB::table('role_user')
//                    ->where('user_id', '=', $record->id)
//                    ->where('role_id', '=', $previous_role_id)
//                    ->delete();
//
//                $record->roles()->attach($request->role_id);
//            }
//        }
//        //if(!env('DEMO_MODE')) {
//        $this->processUpload($request, $record);
//        //}
//        flash('success', 'record_updated_successfully', 'success');
//        // return redirect('users/edit/'.$record->slug);
//        if (checkRole(getUserGrade(2)))
//            return redirect(URL_INSTRUCTORS)->with('success','Instructor updated Successfully !');
//        return redirect(URL_INSTRUCTORS_EDIT. $record->slug)->with('success','Instructor updated Successfully !');
//    }

    public function update(Request $request, $slug)
    {

        $columns = array(
            'fname' => 'bail|required|max:250|',
            'lname' => 'bail|required|max:250|',
            'email' => 'bail|required|email',
            'subject'=>'bail|required|max:250|',
            'detail'=>'required',
            'uname'=>'required',
            'designation'=>'required',
            'rating'=>'required',
            'reviews'=>'required',
            'students'=>'required',
            'ncourses'=>'required',
            'introduction'=>'required',
            'baddress'=>'required',

        );
        $messsages = array(
            'fname.required'=>'First Name is required',
            'lname.required'=>'Last Name is required',
            'email.required'=>'Email is required',
            'subject.required'=>'Subject is required',
            'detail.required'=>'Additional Comments are required',
            'uname.required'=>'User Name is required',
            'designation.required'=>'Designation is required',
            'rating.required'=>'Instructor Rating is required',
            'reviews.required'=>'Number of Reviews is required',
            'students.required'=>'Number of Students is required',
            'ncourses.required'=>'Number of courses is required',
            'introduction.required'=>'Instructor introduction is required',
            'baddress.required'=>'Billing Address is required',
        );

        $this->validate($request,$columns,$messsages);

        $urecords = User::where("id", $request->uid)->first();
        $irecords = Instructor::where("id", $request->iid)->first();


        $irecords->fname =   $request->fname;
        $irecords->lname =   $request->lname;
        $irecords->email =   $request->email;
        $irecords->subject =   $request->subject;
        $irecords->detail =   $request->detail;
        $irecords->mobile =   $request->mobile;
        $irecords->uname =   $request->uname;
        $irecords->designation =   $request->designation;
        $irecords->rating =   $request->rating;
        $irecords->reviews =   $request->reviews;
        $irecords->students =   $request->students;
        $irecords->ncourses =   $request->ncourses;
        $irecords->introduction =   $request->introduction;
        $irecords->baddress =   $request->baddress;

        $irecords->save();



        $urecords->first_name =   $request->fname;
        $urecords->last_name =   $request->lname;
        $urecords->email =   $request->email;
        $urecords->username =   $request->uname;
        $urecords->address =   $request->baddress;

        $urecords->save();


        flash('success', 'record_updated_successfully', 'success');
        return redirect(URL_INSTRUCTORS)->with('success','Instructor updated Successfully !');
    }


    public function settings()
    {
        if (!checkRole(getUserGrade(4))) {
            prepareBlockUserMessage();
            return back();
        }
        $record = App\InstructorSetting::all()->first();

        $data['record'] = $record;
        $data['active_class'] = 'instructors';

        $data['title'] = getPhrase('instructor_settings');

        $data['layout'] = getLayout();


        $view_name = getTheme() . '::instructors.settings';
        return view($view_name, $data);
    }
    public function saveSettings(Request $request)
    {

//         dd($request);

        $user =  App\InstructorSetting::where('id', $request->setting_id)->get()->first();

       // $user = new App\InstructorSetting();

        $user->instructor_revenue = $request->instructor_revenue;
        $user->admin_revenue = $request->admin_revenue;

        $user->instructor_application_note = $request->instructor_application_note;
        if(isset($request->paypal_enable))
        $user->paypal_enable = 1;
        if(isset($request->bank_enable))
        $user->bank_enable = 1;

        $user->save();


        try {
            if (!env('DEMO_MODE')) {
                $user->notify(new \App\Notifications\NewUserRegistration($user, $user->email, $password));

            }

            //$this->sendPushNotification($user);
        } catch (Exception $ex) {
            $message = getPhrase('settings are updated ');
             $exception = 1;
        }

        $flash = app('App\Http\Flash');
        $flash->create('Success...!', $message, 'success', 'flash_overlay', FALSE);

        if (checkRole(['parent']))
            return redirect('dashboard');
        //   return back()->with('success','Request Successfully !');

      return redirect(URL_INSTRUCTORS)->with('success','Instructor Settings are updated Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param unique string  $slug
     * @return Response
     */
    /**
     * Delete Record based on the provided slug
     * @param  [string] $slug [unique slug]
     * @return Boolean
     */
    public function delete($slug)
    {
        if (!checkRole(getUserGrade(2))) {
            prepareBlockUserMessage();
            return back();
        }

        $record = User::where('slug', $slug)->first();

        /**
         * Check if any exams exists with this category,
         * If exists we cannot delete the record
         */
        if (!env('DEMO_MODE')) {
            $imageObject = new ImageSettings();

            $destinationPath = $imageObject->getProfilePicsPath();
            $destinationPathThumb = $imageObject->getProfilePicsThumbnailpath();

            $this->deleteFile($record->image, $destinationPath);
            $this->deleteFile($record->image, $destinationPathThumb);
            $record->delete();
        }
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
        $records = User::whereIn('id', $id_array);

        try {
            if (!env('DEMO_MODE')) {
                foreach ($records as $record) {
                    $imageObject = new ImageSettings();

                    $destinationPath = $imageObject->getProfilePicsPath();
                    $destinationPathThumb = $imageObject->getProfilePicsThumbnailpath();

                    $this->deleteFile($record->image, $destinationPath);
                    $this->deleteFile($record->image, $destinationPathThumb);

                }
                $records->delete();
            }

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


    public function deleteFile($record, $path, $is_array = FALSE)
    {
        if (env('DEMO_MODE')) {
            return;
        }

        $files = array();
        $files[] = $path . $record;
        File::delete($files);
    }


    /**
     * Delete Record based on the provided slug
     * @param  [string] $slug [unique slug]
     * @return Boolean
     */


}
