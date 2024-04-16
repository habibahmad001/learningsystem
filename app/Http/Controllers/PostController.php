<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App;
use App\Http\Requests;
use App\Lmscategory;
use App\Post;
use Yajra\Datatables\Datatables;
use DB;
use Auth;
use Image;
use ImageSettings;
use File;
use Exception;
use Illuminate\Support\Facades\Storage;
//use Illuminate\Support\Facades\Session;
//use Session;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    protected $postSettings;

    public function setSettings()
    {
        $this->postSettings = getSettings('post');
    }

    public function getSettings()
    {
        return $this->postSettings;
    }

    /**
     * Course listing method
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        if (!checkRole(getUserGrade(2))) {
            prepareBlockUserMessage();
            return back();
        }
        $data['active_class'] = 'posts';
        $data['title'] = getPhrase('Posts');
        $data['layout'] = getLayout();
        // return view('lms.lmscontents.list', $data);
//dd($data);

        $view_name = getTheme() . '::posts.list';
        return view($view_name, $data);
    }

    /**
     * This method returns the datatables data to view
     * @return [type] [description]
     */
    public function getDatatable()
    {
        if (!checkRole(getUserGrade(2))) {
            prepareBlockUserMessage();
            return back();
        }

        $records = Post::with('author')->select(['title', 'image', 'slug', 'user_id', 'id','status', 'updated_at'])
            ->orderBy('updated_at', 'desc');
        $role = getRole();
        if($role=="instructor"){
            $records = $records->where('user_id', Auth::user()->id);
        }

        $this->setSettings();
        return Datatables::of($records)
            ->addColumn('check_course', function ($records) {

                $link_data1 = '<input name="checkbox_course[]" type="checkbox" class="delete_check" id="delcheck_'.$records->id.'"    value="'.$records->id.'">';

                return $link_data1;
            })
            ->editColumn('title', function($records)
            {
                return '<a target="_blank" href="'.URL_POST.$records->slug.'">'.$records->title.'</a>';
            })
            ->editColumn('status', function($records)
            {
                return ($records->status=='Active') ? '<span class="label label-success">'.getPhrase('active') .'</span>' : '<span class="label label-danger">'.getPhrase('inactive').'</span>';
            })
            ->addColumn('author', function($records)
            {
                return getUserName($records->user_id);
            })
            ->addColumn('action', function ($records) {
                $extra = '<div class="dropdown more">
                        <a id="dLabel" type="button" class="more-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-dots-vertical"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dLabel">
                            <li><a href="' . URL_POSTS_EDIT . $records->slug . '"><i class="fa fa-pencil"></i>' . getPhrase("edit") . '</a></li>';
                $temp = "";
                if (checkRole(getUserGrade(1))) {
                    $temp = '<li><a href="javascript:void(0);" onclick="deleteRecord(\'' . $records->slug . '\');"><i class="fa fa-trash"></i>' . getPhrase("delete") . '</a></li>';
                }
                $extra .= $temp . '</ul></div>';
                return $extra;
            })
            ->rawColumns(['title', 'image', 'status', 'action', 'author','check_course'])
            ->removeColumn('id')
            ->removeColumn('updated_at')
            ->removeColumn('slug')
            ->editColumn('image', function ($records) {
                $imageObject = new ImageSettings();

               // $destinationPath      = $imageObject->getBlogImgPath();
                $destinationPathThumb = $imageObject->getBlogImgThumbnailpath();

                if ($records->image) {
                    $image_path = $destinationPathThumb . $records->image;
                    return '<img src="' . $image_path. '"  width="50" />';
                }else{
                    return '';
                }
            })
            ->make();
    }

    /**
     * This method loads the create view
     * @return void
     */
    public function create()
    {
        if (!checkRole(getUserGrade(2))) {
            prepareBlockUserMessage();
            return back();
        }
        $data['record'] = FALSE;
        $data['active_class'] = 'posts';
        $data['categories'] = array_pluck(App\PostCategory::all(), 'category', 'id');
        $data['title'] = getPhrase('Create Post');
        $data['layout'] = getLayout();

        // return view('lms.lmscontents.add-edit', $data);
        $view_name = getTheme() . '::posts.add-edit';
        return view($view_name, $data);
    }

    /**
     * This method loads the edit view based on unique slug provided by user
     * @param  [string] $slug [unique slug of the record]
     * @return [view with record]
     */
    public function edit($slug)
    {
        if (!checkRole(getUserGrade(2))) {
            prepareBlockUserMessage();
            return back();
        }
        $record = Post::getRecordWithSlug($slug);
        if ($isValid = $this->isValidRecord($record))
            return redirect($isValid);

        $data['record'] = $record;
        $data['title'] = getPhrase('edit') . ' ' . $record->title;
        $data['active_class'] = 'posts';
        $data['categories'] = array_pluck(App\PostCategory::all(), 'category', 'id');

        $data['settings'] = json_encode($record);
        $data['layout'] = getLayout();
        $view_name = getTheme() . '::posts.add-edit';
        return view($view_name, $data);
    }

    /**
     * Update record based on slug and reuqest
     * @param  Request $request [Request Object]
     * @param  [type]  $slug    [Unique Slug]
     * @return void
     */
    public function update(Request $request, $slug)
    {
        if (!checkRole(getUserGrade(2))) {
            prepareBlockUserMessage();
            return back();
        }

        $record = Post::getRecordWithSlug($slug);
        $rules = [
            'title' => 'bail|required|max:60',
        ];
        $file_path = $record->file_path;


        $this->validate($request, $rules);
        DB::beginTransaction();
        try {
           // $name = $request->title;
//            if ($name != $record->title)
//                $record->slug = str_slug($name);

            $name = $request->title;
            $record->title = $name;
            $previous_image = $record->image;

            $record->description = $request->description;
            $record->category_id = $request->category_id;
            $record->featured = $request->featured;
            $record->tags = $request->tags;
            $record->user_id = Auth::user()->id;
            $role = getRole();
            $user=Auth::user();
            if($role=="instructor"){
                $record->status = 'Inactive';

            }else{
                $record->status =  $request->status;
                if($request->status=='Active'){
                    $user=getUserRecord($record->user_id);
                    sendEmail('instructor_blog_approved_ack', array(
                        'to_email' => $user->email,
                        'email' => $user->email,
                        'name' => $user->name,
                        'article' => $name,
                        'article_link' => URL_POST.$record->slug,
                        'updated_at' => $record->updated_at
                    ));
                }
            }

            $record->save();
            if($role=="instructor") {
                sendEmail('instructor_blog_updated_admin', array(
                    'send_to' => 'admin',
                    'to_email' => $user->email,
                    'email' => $user->email,
                    'name' => $user->name,
                    'article' => $name,
                    'updated_at' => $record->updated_at
                ));
            }

            if (!env('DEMO_MODE')) {
                if ($request->hasFile('image')) {

                    $this->processUpload($request, $record);

                    if ($request->hasFile('image') && $previous_image!='') {

                        $imageObject = new ImageSettings();

                        $destinationPath      = $imageObject->getBlogImgPath();
                        $destinationPathThumb = $imageObject->getBlogImgThumbnailpath();

                        $this->deleteFile($previous_image, $destinationPath);
                        $this->deleteFile($previous_image, $destinationPathThumb);
                    }
                }
            }

//
//            $file_name = 'image';
//            if ($request->hasFile($file_name)) {
//
//                $rules = array($file_name => 'mimes:jpeg,jpg,png,gif|max:1000000');
//                $this->validate($request, $rules);
//                $this->setSettings();
//                $postSettings = $this->getSettings();
//                $path = $postSettings->contentImagepath;
//                $this->deleteFile($record->image, $path);
//
//                $record->image = $this->processUpload($request, $record, $file_name);
//
//                $record->save();
//            }


            DB::commit();
            flash('success', 'record_updated_successfully', 'success');

        } catch (Exception $e) {
            DB::rollBack();
            if (getSetting('show_foreign_key_constraint', 'module')) {

                flash('oops...!', $e->errorInfo, 'error');
            } else {
                flash('oops...!', 'improper_data_file_submitted', 'error');
            }
        }
        return redirect(URL_POSTS);
    }

    /**
     * This method adds record to DB
     * @param  Request $request [Request Object]
     * @return void
     */
    public function store(Request $request)
    {

        if (!checkRole(getUserGrade(2))) {
            prepareBlockUserMessage();
            return back();
        }


        $rules = [
            'title' => 'bail|required|max:360',
            'image'		=> 'mimes:png,jpg,jpeg|max:9900000' //10kb

        ];
        $file_path = '';
        $customMessages = [
            'required' => 'The :attribute field is required.'
        ];

        $this->validate($request, $rules,$customMessages);
        DB::beginTransaction();
        try {
            $record = new App\Post();
            $name = $request->title;
            $record->title = $name;
            //$record->slug = str_slug($name);


            $record->description = $request->description;
            $record->category_id = $request->category_id;
            $record->description = $request->description;
            $record->featured = $request->featured;
            $record->tags = $request->tags;
            $record->user_id = Auth::user()->id;
            $role = getRole();
            if($role=="instructor"){
                $record->status = 'Inactive';
                $user=Auth::user();
            }

             $record->save();
            if($role=="instructor") {
                sendEmail('instructor_blog_created_admin', array(
                    'send_to' => 'admin',
                    'to_email' => $user->email,
                    'email' => $user->email,
                    'name' => $user->name,
                    'article' => $name,
                    'created_at' => $record->created_at
                ));
            }
            if (!env('DEMO_MODE') && $request->hasFile('image'))
                $this->processUpload($request, $record);
//            $path = $request->file('image')->store('blogs', 's3');
//
//            Storage::disk('s3')->setVisibility($path, 'public');
//
//
//            $image = Image::create([
//                'filename' => basename($path),
//                'url' => Storage::disk('s3')->url($path)
//            ]);
//
//            echo  $path;
//            dd($request);

            DB::commit();
             flash('success', 'record_added_successfully', 'success');
            //Session::flash('success', getPhrase('record_added_successfully'));
            //\Session::flash('success', "Special message goes here");
            $request->session()->flash('success', 'Record Added Successfully!');
        } catch (Exception $e) {
          dd($e->getMessage());
            DB::rollBack();
            if (getSetting('show_foreign_key_constraint', 'module')) {

                flash('oops...!', $e->errorInfo, 'error');
            } else {
                flash('oops...!', 'improper_data_file_submitted', 'error');
            }
        }

        return redirect(URL_POSTS);
    }


    public function deleteMultiple(Request $request)
    {
        if (!checkRole(getUserGrade(2))) {
            prepareBlockUserMessage();
            return back();
        }
        //$record = Post::where('slug', $slug)->first();
        $id_array = $request->input('deleteids_arr');
        $records_obj = Post::whereIn('id', $id_array);
        $records=$records_obj->get();
//print_r($records);


        //$this->setSettings();
         try {
            if (!env('DEMO_MODE')) {
                $imageObject = new ImageSettings();
                $destinationPath      = $imageObject->getBlogImgPath();
                $destinationPathThumb = $imageObject->getBlogImgThumbnailpath();

                 foreach ($records as $record) {


                  //  dd($record);
                    $this->deleteFile($record->image, $destinationPath);
                    $this->deleteFile($record->image, $destinationPathThumb);
                   //  $record->delete();

               }
               // $records = Post::whereIn('id', $id_array);
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
        return URL_LMS_CONTENT;
    }


    public function deleteFile($record, $path, $is_array = FALSE)
    {

        $destinationPath      = $path;

        $files = array();
        $files[] = $destinationPath.$record;
        if(env('FILESYSTEM_DRIVER')=='s3'){
            Storage::delete($files);
        }else{
            File::delete($files);
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
        $record = Post::where('slug', $slug)->first();

        try {
            if (!env('DEMO_MODE')) {

                $imageObject = new ImageSettings();

                $destinationPath      = $imageObject->getBlogImgPath();
                $destinationPathThumb = $imageObject->getBlogImgThumbnailpath();

                $this->deleteFile($record->image, $destinationPath);
                $this->deleteFile($record->image, $destinationPathThumb);

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
    protected function processUpload(Request $request, $record)
    {

        if (env('DEMO_MODE')) {
            return 'demo';
        }

        if ($request->hasFile('image')) {

            $imageObject = new ImageSettings();

            $destinationPath      = $imageObject->getBlogImgPath();
            $destinationPathThumb = $imageObject->getBlogImgThumbnailpath();
            $BlogThumbnailSize = $imageObject->getBlogThumbnailSize();

            $random_str = rand(0,9999999);

            $fileName = $record->id.'_'.$random_str.'.'.$request->image->guessClientExtension();


            $image_normal = Image::make($request->file('image'))->widen(1024, function ($constraint) {
                $constraint->upsize();
            });
            $image_thumb = Image::make($request->file('image'))->fit($BlogThumbnailSize, 242, function ($constraint) {

                $constraint->upsize();
            });
            if(env('FILESYSTEM_DRIVER')=='s3') {
                uploadToS3($image_normal, 'blogs/', $fileName);
                uploadToS3($image_thumb, 'blogs/thumbnail/', $fileName);
            }else{
                $image = Image::make($request->file('image'))->resize(1024, 600);

                $request->file('image')->move($destinationPath, $fileName);


                Image::make($destinationPath.$fileName)->resize(1024, 600)->save($destinationPath.$fileName);

                Image::make($destinationPath.$fileName)->resize($BlogThumbnailSize,'242')->save($destinationPathThumb.$fileName);

            }




            $record->image = $fileName;
            $record->save();
        }
    }



}
