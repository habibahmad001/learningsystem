<?php

namespace App\Http\Controllers;

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
use Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Validator;

class UsersController extends Controller
{

    public $excel_data = array();
    public $currentUser="";

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
    public function index($role = 'student')
    {
        if (!checkRole(getUserGrade(2))) {
            prepareBlockUserMessage();
            return back();
        }

        $data['records'] = FALSE;
        $data['layout'] = getLayout();
        $data['active_class'] = 'users';
        $data['heading'] = getPhrase('users');
        $data['title'] = getPhrase('users');
        // return view('users.list-users', $data);

        $view_name = getTheme() . '::users.list-users';
        return view($view_name, $data);
    }



    public function getDatatable($slug = '')
    {
        $records = array();

        if ($slug == '') {
            $records = User::join('roles', 'users.role_id', '=', 'roles.id')
                ->select(['users.name','users.id as uid', 'email', 'image', 'roles.display_name as role', 'login_enabled', 'role_id', 'users.created_at',
                    'slug', 'users.id', 'users.updated_at'])
                ->orderBy('users.created_at', 'desc');
        } else {

            $role = App\Role::getRoleId($slug);

            $records = User::join('roles', 'users.role_id', '=', 'roles.id', 'roles.id', '=', $role->id)
                ->select(['name','users.id as uid', 'image', 'email', 'roles.display_name as role', 'login_enabled', 'role_id', 'slug', 'users.updated_at', 'users.created_at'])
                ->orderBy('users.created_at', 'desc');

        }

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
                           <li><a href="' . URL_USERS_EDIT . $records->slug . '"><i class="fa fa-pencil"></i>' . getPhrase("edit") . '</a></li>';
                if (getRoleData($records->role_id) == 'student') {
                    $link_data .= ' <li><a href="' . URL_USERS_ASSIGN_COURSE . $records->slug . '"><i class="fa fa-book"></i>' . getPhrase("assign_course") . '</a></li>';
                }
                $temp = '';

                //Show delete option to only the owner user
                if (checkRole(getUserGrade(1)) && $records->id != \Auth::user()->id) {
                    $temp = '<li><a href="javascript:void(0);" onclick="deleteRecord(\'' . $records->slug . '\');"><i class="fa fa-trash"></i>' . getPhrase("delete") . '</a></li>';
//                    $temp .= '<li><a href="javascript:void(0);" onclick="deleteRecord(\''.$records->slug.'\');"><i class="fa fa-trash"></i>'. getPhrase("delete").'</a></li>';
                }
                //Show delete option to only the owner user
                if (checkRole(getUserGrade(4)) && $records->id != \Auth::user()->id) {
                    $temp .= '<li><form action="'.URL_AUTHADMIN_LOGIN.'" method="POST"><input type="hidden" name="slug"  id="slug_'.$records->id.'" value="'.$records->id.'"><input name="_token" value="'.csrf_token().'" type="hidden">';
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
                    return '<a href="' . URL_USER_DETAILS . $records->slug . '">' . ucfirst($records->name) .'-ID#'. $records->uid.'</a>'.'       ('.$records->role.')';
                }else{
                    return   '<span style="font-weight:bold">'.ucfirst($records->name) .'-ID#'. $records->uid . '('.$records->role.')</span  >';
                }
                return ucfirst($records->name);
            })
            ->editColumn('image', function ($records) {
                return '<img alt="'.$records->image.'" src="' .getProfilePath($records->image,'profile')  . '"  />';
            })
            ->rawColumns(['name', 'image', 'action','check_course'])
            ->removeColumn('login_enabled')
            ->removeColumn('role_id')
            ->removeColumn('id')
//            ->removeColumn('slug')
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
        $data['active_class'] = 'users';

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
        $data['title'] = getPhrase('add_user');
        if (checkRole(['parent']))
            $data['active_class'] = 'children';
        $data['layout'] = getLayout();

        // return view('users.add-edit-user', $data);

        $view_name = getTheme() . '::users.add-edit-user';
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

        $rules = [
            'first_name' => 'bail|required|max:100|',
            'last_name' => 'bail|required|max:100|',
            'username' => 'bail|required|unique:users,username',
            'email' => 'bail|required|unique:users,email',
            'image' => 'bail|mimes:png,jpg,jpeg|max:2048',
//            'password' => 'bail|required|min:5',
//            'password_confirmation' => 'bail|required|min:5|same:password',
        ];

        if (checkRole(getUserGrade(2)))
            $columns['role_id'] = 'bail|required';
        // dd($request);
        $customMessages = [
            'required' => 'The :attribute field is required.'
        ];

        /******** check if user exists ********/
        if(App\User::where("email", $request->email)->first()) {
            return redirect("/users/create?message=This email already exists, Please try some other email.");
        }

        if(App\User::where("username", $request->username)->first()) {
            return redirect("/users/create?message=This User Name already exists, Please try some other User Name.");
        }
        /******** check if user exists ********/

        $this->validate($request, $rules,$customMessages);

        //$this->validate($request, $columns);

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
        //$slug = str_slug($name);
        $user->username = $request->username;
        //$user->slug = $slug.'-'.$user->username;
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
                //$user->notify(new \App\Notifications\NewUserRegistration($user, $user->email, $password));

                sendEmail('newuserregister', array('user_name'=> $name,
                    'to_email' => $request->email,
                    'password' => $password ));

                sendEmail('registration', array('name'=> $request->first_name,
                    'to_email' => $request->email,
                    'url' => url('/') ));


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

        return redirect(URL_USERS);
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

            $fileName = $user->id . '.' . $request->image->guessClientExtension();


            if(env('FILESYSTEM_DRIVER')=='s3') {
                $file=$request->file('image');
                $image_normal = Image::make($file->getRealPath())->widen(1024, function ($constraint) {$constraint->upsize();});
                $image_thumb = Image::make($file->getRealPath())->fit($imageObject->getUserThumbnailSize());

                uploadToS3($image_normal,'users/',$fileName);
                uploadToS3($image_thumb,'users/thumbnail/',$fileName);

            }else {
                $request->file('image')->move($destinationPath, $fileName);

                Image::make($destinationPath . $fileName)->fit($imageObject->getProfilePicSize())->save($destinationPath . $fileName);
                Image::make($destinationPath . $fileName)->fit($imageObject->getThumbnailSize())->save($destinationPathThumb . $fileName);
            }
            $user->image = $fileName;
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
        return URL_USERS;
    }

    public function getRedirectUrl()
    {
        return URL_USERS;
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

        $data['record'] = $record;
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

        $data['active_class'] = 'users';
        $data['title'] = getPhrase('edit_user');
        $data['layout'] = getLayout();
        // dd($data);
        // return view('users.add-edit-user', $data);

        $view_name = getTheme() . '::users.add-edit-user';
        return view($view_name, $data);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $slug)
    {
        $record = User::where('slug', $slug)->get()->first();
        $rules = [
            'first_name' => 'bail|required|max:120|',
            'last_name' => 'bail|required|max:120|',
            'email' => 'bail|required|unique:users,email,' . $record->id,
            'image' => 'bail|mimes:png,jpg,jpeg|max:2048'

        ];

        if (!isEligible($slug))
            return back();

        if ($request->password!="") {
            $rules['password'] = 'min:6|same:password_confirmation';
        }
        if (checkRole(getUserGrade(2)))
            $rules['role_id'] = 'bail|required|integer';

        $customMessages = [
            'required' => 'The :attribute field is required.'
        ];

        $this->validate($request, $rules,$customMessages);



        $name = $request->first_name.' '.$request->last_name;

        $previous_role_id = $record->role_id;
        if ($name != $record->name)
            $record->slug = str_slug($name);

        $record->name = $name;
        $record->first_name = $request->first_name;
        $record->last_name = $request->last_name;
        $record->email = $request->email;

        if (checkRole(getUserGrade(2)))
            $record->role_id = $request->role_id;
        $record->phone = $request->phone;
        $record->address = $request->address;
        $record->save();
        if ($request->password!="") {
            $password = $request->password;
            $record->password = bcrypt($password);
            $record->save();
            sendEmail('password_updated', array(
                'user_name'=> $record->name,
                'to_email' => $record->email,
                'email' =>$record->email,
                'password' => $password,
                'url' => url('/')));

            //$record->notify(new \App\Notifications\PasswordChanged($record, $record->email, $password));
        }


        if (checkRole(getUserGrade(2))) {
            /**
             * Delete the Roles associated with that user
             * Add the new set of roles
             */

            if (!env('DEMO_MODE')) {
                DB::table('role_user')
                    ->where('user_id', '=', $record->id)
                    ->where('role_id', '=', $previous_role_id)
                    ->delete();

                $record->roles()->attach($request->role_id);
                if($previous_role_id==7){
                    App\Instructor::where('email', $record->email)
                        ->update(['status' => 0]);
                }
                if($previous_role_id==5 && $request->role_id==7){
                    App\Instructor::where('email', $record->email)
                        ->update(['status' => 1]);
                }
            }
        }
        //if(!env('DEMO_MODE')) {
        $this->processUpload($request, $record);
        //}
        flash('success', 'record_updated_successfully', 'success');
        // return redirect('users/edit/'.$record->slug);
        if (checkRole(getUserGrade(2)))
            return redirect(URL_USERS);
        return redirect(URL_USERS_EDIT . $record->slug);
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
            DB::table('role_user')->where('user_id', '=', $record->id)->delete();
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


    public function listUsers($role_name)
    {
        $role = App\Role::getRoleId($role_name);

        $users = User::where('role_id', '=', $role->id)->get();

        $users_list = array();

        foreach ($users as $key => $value) {
            $r = array('id' => $value->id, 'text' => $value->name, 'image' => $value->image);
            array_push($users_list, $r);
        }
        return json_encode($users_list);
    }

    public function details($slug)
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

        $data['record'] = $record;


        $user = $record;
        //Overall performance Report
        $resultObject = new App\QuizResult();
        $records = $resultObject->getOverallSubjectsReport($user);
        $color_correct = getColor('background', rand(0, 999));
        $color_wrong = getColor('background', rand(0, 999));
        $color_not_attempted = getColor('background', rand(0, 999));
        $correct_answers = 0;
        $wrong_answers = 0;
        $not_answered = 0;

        foreach ($records as $record) {
            $record = (object)$record;
            $correct_answers += $record->correct_answers;
            $wrong_answers += $record->wrong_answers;
            $not_answered += $record->not_answered;

        }

        $labels = [getPhrase('correct'), getPhrase('wrong'), getPhrase('not_answered')];
        $dataset = [$correct_answers, $wrong_answers, $not_answered];
        $dataset_label[] = 'lbl';
        $bgcolor = [$color_correct, $color_wrong, $color_not_attempted];
        $border_color = [$color_correct, $color_wrong, $color_not_attempted];
        $chart_data['type'] = 'pie';
        //horizontalBar, bar, polarArea, line, doughnut, pie
        $chart_data['title'] = getphrase('overall_performance');

        $chart_data['data'] = (object)array(
            'labels' => $labels,
            'dataset' => $dataset,
            'dataset_label' => $dataset_label,
            'bgcolor' => $bgcolor,
            'border_color' => $border_color
        );

        $data['chart_data'][] = (object)$chart_data;

        //Best scores in each quizzes
        $records = $resultObject->getOverallQuizPerformance($user);
        $labels = [];
        $dataset = [];
        $bgcolor = [];
        $bordercolor = [];

        foreach ($records as $record) {
            $color_number = rand(0, 999);
            $record = (object)$record;
            $labels[] = $record->title;
            $dataset[] = $record->percentage;
            $bgcolor[] = getColor('background', $color_number);
            $bordercolor[] = getColor('border', $color_number);
        }

        $labels = $labels;
        $dataset = $dataset;
        $dataset_label = getPhrase('performance');
        $bgcolor = $bgcolor;
        $border_color = $bordercolor;
        $chart_data['type'] = 'bar';
        //horizontalBar, bar, polarArea, line, doughnut, pie
        $chart_data['title'] = getPhrase('best_performance_in_all_quizzes');

        $chart_data['data'] = (object)array(
            'labels' => $labels,
            'dataset' => $dataset,
            'dataset_label' => $dataset_label,
            'bgcolor' => $bgcolor,
            'border_color' => $border_color
        );

        $data['chart_data'][] = (object)$chart_data;

        $data['ids'] = array('myChart0', 'myChart1');
        $data['title'] = getPhrase('user_details');
        $data['layout'] = getLayout();
        $data['active_class'] = 'users';
        if (checkRole(['parent']))
            $data['active_class'] = 'children';
        //   $data['right_bar']          = TRUE;

        // $data['right_bar_path']     = 'student.exams.right-bar-performance-chart';
        // $data['right_bar_data']     = array('chart_data' => $data['chart_data']);

        // return view('users.user-details', $data);

        $view_name = getTheme() . '::users.user-details';
        return view($view_name, $data);

    }

    /**
     * This method will show the page for change password for user
     * @param  [type] $slug [description]
     * @return [type]       [description]
     */
    public function changePassword($slug)
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

        $data['record'] = $record;
        $data['active_class'] = 'profile';
        $data['title'] = getPhrase('change_password');
        $data['layout'] = getLayout();
        // return view('users.change-password.change-view', $data);

        $view_name = getTheme() . '::users.change-password.change-view';
        return view($view_name, $data);
    }

    /**
     * This method updates the password submitted by the user
     * @param Request $request [description]
     * @return [type]           [description]
     */
    public function updatePassword(Request $request)
    {


        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required|confirmed',
        ]);

        $credentials = $request->only(
            'old_password', 'password', 'password_confirmation'
        );
        $user = \Auth::user();


        if (Hash::check($credentials['old_password'], $user->password)) {
            $password = $credentials['password'];
            $user->password = bcrypt($password);
            $user->save();
            flash('success', 'password_updated_successfully', 'success');
            //  toastr()->success('Your Password updated successfully');
            //return redirect(URL_USERS_CHANGE_PASSWORD . $user->slug);
            //session()->flash('success', 'Your Password updated successfully');
            return redirect(URL_USERS_CHANGE_PASSWORD . $user->slug);
        } else {
            //toastr()->warning('Old Password and New password are not same!','warning');
            flash('Oops..!', 'Old password not entered correctly', 'error');
            return redirect()->back()->withErrors(['Old password not entered correctly']);
            //  return redirect()->back();
        }
    }

    /**
     * Display a Import Users page
     *
     * @return Response
     */
    public function importUsers($role = 'student')
    {
        if (!checkRole(getUserGrade(2))) {
            prepareBlockUserMessage();
            return back();
        }

        $data['records'] = FALSE;
        $data['active_class'] = 'users';
        $data['heading'] = getPhrase('users');
        $data['title'] = getPhrase('import_users');
        $data['layout'] = getLayout();
        // return view('users.import.import', $data);

        $view_name = getTheme() . '::users.import.import';
        return view($view_name, $data);
    }

    public function readExcel(Request $request)
    {

        $columns = array(
            'excel' => 'bail|required',
        );

        $this->validate($request, $columns);

        if (!checkRole(getUserGrade(2))) {
            prepareBlockUserMessage();
            return back();
        }
        $success_list = [];
        $failed_list = [];

        try {
            if (Input::hasFile('excel')) {
                $path = Input::file('excel')->getRealPath();
                $data = Excel::load($path, function ($reader) {
                })->get();

                $user_record = array();
                $users = array();
                $isHavingDuplicate = 0;
                if (!empty($data) && $data->count()) {

                    foreach ($data as $key => $value) {

                        foreach ($value as $record) {
                            unset($user_record);

                            $user_record['username'] = $record->username;
                            $user_record['name'] = $record->name;
                            $user_record['email'] = $record->email;

                            $user_record['password'] = $record->password;
                            $user_record['phone'] = $record->phone;
                            $user_record['address'] = $record->address;
                            $user_record['role_id'] = STUDENT_ROLE_ID;

                            $user_record = (object)$user_record;
                            $failed_length = count($failed_list);
                            if ($this->isRecordExists($record->username, 'username')) {

                                $isHavingDuplicate = 1;
                                $temp = array();
                                $temp['record'] = $user_record;
                                $temp['type'] = 'Record already exists with this name';
                                $failed_list[$failed_length] = (object)$temp;
                                continue;
                            }

                            if ($this->isRecordExists($record->email, 'email')) {
                                $isHavingDuplicate = 1;
                                $temp = array();
                                $temp['record'] = $user_record;
                                $temp['type'] = 'Record already exists with this email';
                                $failed_list[$failed_length] = (object)$temp;
                                continue;
                            }

                            $users[] = $user_record;

                        }

                    }
                    if ($this->addUser($users))
                        $success_list = $users;
                }
            }


            $this->excel_data['failed'] = $failed_list;
            $this->excel_data['success'] = $success_list;

            flash('success', 'record_added_successfully', 'success');
            $this->downloadExcel();

        } catch (Exception $e) {
            if (getSetting('show_foreign_key_constraint', 'module')) {

                flash('oops...!', $e->errorInfo, 'error');
            } else {
                flash('oops...!', 'improper_sheet_uploaded', 'error');
            }

            return back();
        }

        // URL_USERS_IMPORT_REPORT
        $data['failed_list'] = $failed_list;
        $data['success_list'] = $success_list;
        $data['records'] = FALSE;
        $data['layout'] = getLayout();
        $data['active_class'] = 'users';
        $data['heading'] = getPhrase('users');
        $data['title'] = getPhrase('report');

        // return view('users.import.import-result', $data);

        $view_name = getTheme() . '::users.import.import-result';
        return view($view_name, $data);

    }

    public function getFailedData()
    {
        return $this->excel_data;
    }

    public function downloadExcel()
    {
        Excel::create('users_report', function ($excel) {
            $excel->sheet('Failed', function ($sheet) {
                $sheet->row(1, array('Reason', 'Name', 'Username', 'Email', 'Password', 'Phone', 'Address'));
                $data = $this->getFailedData();
                $cnt = 2;
                // dd($data['failed']);
                foreach ($data['failed'] as $data_item) {
                    $item = $data_item->record;
                    $sheet->appendRow($cnt++, array($data_item->type, $item->name, $item->username, $item->email, $item->password, $item->phone, $item->address));
                }
            });

            $excel->sheet('Success', function ($sheet) {
                $sheet->row(1, array('Name', 'Username', 'Email', 'Password', 'Phone', 'Address'));
                $data = $this->getFailedData();
                $cnt = 2;
                foreach ($data['success'] as $data_item) {
                    $item = $data_item;
                    $sheet->appendRow($cnt++, array($item->name, $item->username, $item->email, $item->password, $item->phone, $item->address));
                }

            });

        })->download('xlsx');

        return TRUE;
    }

    /**
     * This method verifies if the record exists with the email or user name
     * If Exists it returns true else it returns false
     * @param  [type]  $value [description]
     * @param string $type [description]
     * @return boolean        [description]
     */
    public function isRecordExists($record_value, $type = 'email')
    {
        return User::where($type, '=', $record_value)->get()->count();
    }

    public function addUser($users)
    {
        foreach ($users as $request) {
            $user = new User();
            $name = $request->name;
            $user->name = $name;
            $user->email = $request->email;
            $user->username = $request->username;
            $user->password = bcrypt($request->password);

            $user->role_id = $request->role_id;
            $user->login_enabled = 1;
            $user->slug = str_slug($name);
            $user->phone = $request->phone;
            $user->address = $request->address;

            $user->save();

            $user->roles()->attach($user->role_id);
        }
        return true;
    }

    /**
     * This method shows the user preferences based on provided user slug and settings available in table.
     * @param  [type] $slug [description]
     * @return [type]       [description]
     */
    public function settings($slug)
    {
        $record = User::where('slug', $slug)->first();

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

        $data['record'] = $record;
        $data['quiz_categories'] = App\QuizCategory::get();
        $data['lms_category'] = App\LmsCategory::get();

        // dd($data);
        $data['layout'] = getLayout();
        $data['active_class'] = 'users';
        $data['heading'] = getPhrase('account_settings');
        $data['title'] = getPhrase('account_settings');
        // flash('success','record_added_successfully', 'success');
        // return view('users.account-settings', $data);

        $view_name = getTheme() . '::users.account-settings';
        return view($view_name, $data);

    }

    /**
     * This method updates the user preferences based on the provided categories
     * All these settings will be stored under Users table settings field as json format
     * @param Request $request [description]
     * @param  [type]  $slug    [description]
     * @return [type]           [description]
     */
    public function updateSettings(Request $request, $slug)
    {
        $record = User::where('slug', $slug)->first();

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

        $options = [];
        if ($record->settings) {
            $options = (array)json_decode($record->settings)->user_preferences;

        }

        $options['quiz_categories'] = [];
        $options['lms_categories'] = [];
        if ($request->has('quiz_categories')) {
            foreach ($request->quiz_categories as $key => $value)
                $options['quiz_categories'][] = $key;
        }
        if ($request->has('lms_categories')) {
            foreach ($request->lms_categories as $key => $value)
                $options['lms_categories'][] = $key;
        }

        $record->settings = json_encode(array('user_preferences' => $options));

        $record->save();

        flash('success', 'record_updated_successfully', 'success');
        return back();
    }


    public function viewParentDetails($slug)
    {
        if (!checkRole(getUserGrade(4))) {
            prepareBlockUserMessage();
            return back();
        }

        $record = User::where('slug', '=', $slug)->first();

        if ($isValid = $this->isValidRecord($record))
            return redirect($isValid);

        $data['layout'] = getLayout();
        $data['active_class'] = 'users';
        $data['record'] = $record;

        $data['heading'] = getPhrase('parent_details');
        $data['title'] = getPhrase('parent_details');
        // return view('users.parent-details', $data);

        $view_name = getTheme() . '::users.parent-details';
        print_r($view_name);
        return view($view_name, $data);
    }

    public function updateParentDetails(Request $request, $slug)
    {

        if (!checkRole(getUserGrade(4))) {
            prepareBlockUserMessage();
            return back();
        }


        $user = User::where('slug', '=', $slug)->first();
        $role_id = getRoleData('parent');
        $message = '';
        $hasError = 0;

        DB::beginTransaction();
        if ($request->account == 0) {
            //User is not having an account, create it and send email
            //Update the newly created user ID to the current user parent record
            $parent_user = new User();
            $parent_user->name = $request->parent_name;
            $parent_user->username = $request->parent_user_name;
            $parent_user->role_id = $role_id;
            $parent_user->slug = str_slug($request->parent_user_name);
            $parent_user->email = $request->parent_email;
            $parent_user->password = bcrypt('password');

            try {
                $parent_user->save();
                $parent_user->roles()->attach($role_id);
                $user->parent_id = $parent_user->id;
                $user->save();

                sendEmail('registration', array(
                    'user_name' => $user->name,
                    'username' => $user->username,
                    'to_email' => $user->email,
                    'password' => $parent_user->password,
                    'url' => url('/')
                ));

                DB::commit();
                $message = 'record_updated_successfully';
            } catch (Exception $ex) {
                DB::rollBack();
                $hasError = 1;
                $message = $ex->getMessage();
            }
        }
        if ($request->account == 1) {
            try {
                $user->parent_id = $request->parent_user_id;
                $user->save();
                DB::commit();
            } catch (Exception $ex) {
                $hasError = 1;
                DB::rollBack();
                $message = $ex->getMessage();
            }
        }
        if (!$hasError)
            flash('success', $message, 'success');
        else
            flash('Ooops', $message, 'error');
        return back();
    }


    public function getParentsOnSearch(Request $request)
    {
        $term = $request->search_text;
        $role_id = getRoleData('parent');
        $records = App\User::
        where('name', 'LIKE', '%' . $term . '%')
            ->orWhere('username', 'LIKE', '%' . $term . '%')
            ->orWhere('phone', 'LIKE', '%' . $term . '%')
            ->groupBy('id')
            ->havingRaw('role_id=' . $role_id)
            ->select(['id', 'role_id', 'name', 'username', 'email', 'phone'])
            ->get();
        return json_encode($records);
    }
    public function getsubCategory(Request $request){
        $subcategory  = LmsCategory::where('parent_id',$request->id)->get();
        $html = '';
        if(count($subcategory)>0){
            $html .=     "<option value=''>Select Sub Category...</option>";
            foreach ($subcategory as $category){
                $html .=     "<option value='$category->id'>$category->category</option>";
            }
        }
        $category_id = $request->id;

        $records = LmsSeries::where('lms_category_id', $category_id)->get();
        $result = '';
        if (count($records) > 0) {
            foreach ($records as $record) {
                $payment_courses = App\UserCourses::where('user_id', $request->user_id)->where('item_id', $record->id)->get();

                if ($payment_courses->isEmpty()) {
                    $result .= "<tr class='ng-scope'><td>$record->title</td><td>$record->cost</td><td>$record->discount_price</td><td>$record->validity</td>";
                    $result .= "<td class='add'><a href='javascript:;' data-course='$record->id' class='label label-primary assign_courses'>Assign</a></td>";
                } else {
                    $result .= "<tr class='ng-scope'><td>$record->title</td><td>$record->cost</td><td>$record->discount_price</td><td>$record->validity</td>";
                    $result .= "<td class='remove'><a href='javascript:;' data-course='$record->id' class='label label-danger remove_courses'>remove</a></td>";
                }
            }
        } else {
            $result .= "<tr><td>No Record Found</td></tr>";
        }

        return response()->json(['result'=> $result,'html' =>$html]);

    }
    public function assignCourse($slug)
    {
        if (!checkRole(getUserGrade(4))) {
            prepareBlockUserMessage();
            return back();
        }
        $allcourses = LmsSeries::take(50)->get();
        $record = User::where('slug', '=', $slug)->first();
        $courses = App\UserCourses::where('user_id', $record->id)->get();
        if ($isValid = $this->isValidRecord($record))
            return redirect($isValid);

        $data['layout'] = getLayout();
        $data['active_class'] = 'users';
        $data['record'] = $record;
        $data['courses'] = $courses;
        $data['allcourses'] = $allcourses;

        $data['heading'] = getPhrase('assign_course');
        $data['title'] = getPhrase('assign_course');
        $data['lms_category'] = LmsCategory::where('parent_id', '=', 0)->get();
        $data['lms_sub_category'] = LmsCategory::where('parent_id', '!=', 0)->get();
        $view_name = getTheme() . '::users.assign-course';
        return view($view_name, $data);
    }

    public function getCourses(Request $request)
    {
        $category_id = $request->id;

        $records = LmsSeries::where('lms_category_id', $category_id)->get();
        $result = '';
        if (count($records) > 0) {
            foreach ($records as $record) {
                $payment_courses = App\UserCourses::where('user_id', $request->user_id)->where('item_id', $record->id)->get();

                if ($payment_courses->isEmpty()) {
                    $result .= "<tr class='ng-scope'><td>$record->title</td><td>$record->cost</td><td>$record->discount_price</td><td>$record->validity</td>";
                    $result .= "<td class='add'><a href='javascript:;' data-course='$record->id' class='label label-primary assign_courses'>Assign</a></td></tr>";
                } else {
                    $result .= "<tr class='ng-scope'><td>$record->title</td><td>$record->cost</td><td>$record->discount_price</td><td>$record->validity</td>";
                    $result .= "<td class='remove'><a href='javascript:;' data-course='$record->id' class='label label-danger remove_courses'>remove</a></td></tr>";
                }
            }
        } else {
            $result .= "<tr><td>No Record Found</td></tr>";
        }
        echo $result;
    }

    public function userassignCourses(Request $request)
    {
        $currentUser = \Auth::user();
        $payment_courses = App\UserCourses::where('user_id', $request->user_id)->where('item_id', $request->course_id)->get();
        $course = LmsSeries::where('id', $request->course_id)->first();

        if (count($payment_courses) > 0) {
            //will add some info
            return response()->json(['status'=>'success','message'=>'Course already Assigned']);

        } else {

            $course = LmsSeries::where('id', $request->course_id)->first();


            $instructor_id=$course->user_id;
            $payment_method="offline";
            $payment_course = new App\Payment();
            $payment_slug=str_slug(getHashCode());
            $payment_course->slug 			      = $payment_slug;
            $payment_course->payment_status 	= PAYMENT_STATUS_SUCCESS;
            $payment_course->payment_gateway = $payment_method;
            $payment_course->item_id = $request->course_id;
            $payment_course->instructor_id = $instructor_id;
            $payment_course->item_name = $course->title;
            $payment_course->cost = $course->cost;
            $payment_course->plan_type = 'lms';
            $payment_course->admin_comments = $currentUser->name.' (SUPER ADMIN) assigned this course offline in admin';
            $payment_course->user_id = $request->user_id;
            $payment_course->start_date = date("Y-m-d");
            $payment_course->end_date = date("Y-m-d",mktime(0, 0, 0, date("m"),   date("d"),   date("Y")+1));

            if ($payment_course->save()) {
                $button = "<a href='javascript:;' data-course='$course->id' class='label label-danger remove_courses'>Remove</a>";

                $user_course = new App\UserCourses();
                $user_course->payment_slug 			      = $payment_slug;
                $user_course->item_id = $request->course_id;
                $user_course->item_name = $course->title;
                $user_course->instructor_id = $instructor_id;
                $user_course->item_price = $course->cost;
                $user_course->user_id = $request->user_id;
                $user_course->admin_comments = $currentUser->name.' (SUPER ADMIN) assigned this course offline in admin';
                $user_course->save();


                $user = App\User::find($request->user_id);
                sendEmail('enrolled_confirmation_ack', array('name' => $user->name,
                    'email' => $user->email,
                    'to_email' => $user->email,
                    'course' => $course->title,
                    'contact' => $user->phone,
                    'date' => date('Y-m-d'),
                    'url' => url('/')));
                sendEmail('enrolled_confirmation_admin', array('name' => $user->name,
                    'send_to' => 'admin',
                    'email' => $user->email,
                    'to_email' => $user->email,
                    'course' => $course->title,
                    'contact' => $user->phone,
                    'date' => date('Y-m-d'),
                    'url' => url('/')));


                $courses = App\UserCourses::where('user_id', $request->user_id)->where('item_id', $request->course_id)->get();

                $html = "";
                if (count($courses) > 0) {
                    foreach ($courses as $course) {
                        $course_d = LmsSeries::where('id', $course->item_id)->first();

                        $html .= "<tr class='ng-scope'><td>$course_d->title</td><td>$course_d->cost</td><td>$course_d->discount_price</td><td>$course_d->validity</td><td class='remove'><a href='javascript:;' data-course='".$course_d->id."' class='label label-danger remove_courses'>remove</a></td>";

                    }
                }
                return response()->json(['status'=>'success','message'=>'Course Successfully Assigned','remove'=> $button,'html' =>$html]);

            } else {

                return response()->json(['status'=>'error','message'=>'Error Occured']);
            }
        }
    }

    public function userremoveCourses(Request $request)
    {
        //dd($request);

        if (App\Payment::where('user_id', $request->user_id)->where('item_id', $request->course_id)->delete()) {
            App\UserCourses::where('user_id', $request->user_id)->where('item_id', $request->course_id)->delete();
            $button = "<a href='javascript:;' data-course='$request->course_id' class='label label-primary assign_courses'>Assign</a>";

            $courses = App\UserCourses::with('enrolledcourses')->where('user_id', $request->user_id)->get();


            $html = "";
            if (count($courses) > 0) {
                foreach ($courses as $course) {

                    //$course->enrolledcourses->title;
                    $course_d = App\LmsSeries::where('id', $course->item_id)->first();

                    $html .= "<tr class='ng-scope'><td>".$course_d->title."</td><td>".$course_d->cost."</td><td>".$course_d->discount_price."</td><td>".$course_d->validity."</td><td class='remove'><a href='javascript:;' data-course='".$course_d->id."' class='label label-danger remove_courses'>remove</a></td>";
                    //$html .= "<tr class='ng-scope'><td>".$course->courses->title."</td><td> </td><td> </td><td> </td><td class='remove'><a href='javascript:;' data-course='".$course->enrolledcourses->id."' class='label label-danger remove_courses'>remove</a></td>";

                }
            }
            return response()->json(['status'=>'success','message'=>'Course Removed Successfully!','assign'=> $button,'html' =>$html]);


        } else {

            return response()->json(['status'=>'error','message'=>'Error Occured']);
        }

    }

    /**
     * Course listing method
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function SubscribedUsers()
    {
        if (!checkRole(getUserGrade(2))) {
            prepareBlockUserMessage();
            return back();
        }

        $data['active_class'] = 'users';
        $data['title'] = getPhrase('subscribed_users');
        // return view('exams . quizcategories . list', $data);

        $view_name = getTheme() . '::users . subscribeduser';
        return view($view_name, $data);
    }

    /**
     * This method returns the datatables data to view
     * @return [type] [description]
     */
    public function SubscribersData()
    {

        if (!checkRole(getUserGrade(2))) {
            prepareBlockUserMessage();
            return back();
        }

        $records = array();


        $records = App\UserSubscription::select(['email', 'created_at'])
            ->orderBy('updated_at', 'desc');


        return Datatables::of($records)
            ->make();

    }
    public function getUsersEnrolled()
    {
        if (!checkRole(getUserGrade(2))) {
            prepareBlockUserMessage();
            return back();
        }
        try{


            $data['active_class'] = 'users';
            $data['title'] = getPhrase('enrolled_users');
            //$orders = App\Payment::where('instructor_id', Auth::User()->id)->get();


//        $orders = App\UserCourses::with('enrolledusers')->join('payments', function($join)
//        {
//            $join->on('payments.item_id', "=", "user_courses.item_id");
//            $join->on('payments.user_id', "=", 'user_courses.user_id');
//
//        })->where('user_courses.instructor_id', Auth::User()->id)->get();



//        // return view('exams . quizcategories . list', $data);
            $orders = App\UserCourses::with('enrolledusers','enrolledcourses','courses','user','payment')
                ->join('users', 'users.id','=','user_courses.user_id')
                ->join('payments', 'payments.slug','=','user_courses.payment_slug')
                ->where('user_courses.instructor_id', '=', Auth::User()->id)
                ->get();
//
//
//dd($orders);

            $data['orders'] = $orders;

            $view_name = getTheme() . '::users.enrolled_users';
            return view($view_name, $data);

        } catch (Exception $e) {
            \Session::put('error',$e->getMessage());
            print($e->getMessage());
        }
    }


    public function getUsersEnrolledData()
    {
        if (!checkRole(getUserGrade(2))) {
            prepareBlockUserMessage();
            return back();
        }
        $data['active_class'] = 'users';
        $data['title'] = getPhrase('enrolled_users');
        // return view('exams . quizcategories . list', $data);

        //$records = App\Payment::where('instructor_id', Auth::User()->id)->get();


        $records = App\UserCourses::with('payment','enrolledusers','enrolledcourses')
            ->where('instructor_id', '=', auth()->user()->id);


        return Datatables::of($records)
            ->make();
    }


}
