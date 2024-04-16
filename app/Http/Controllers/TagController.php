<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App;
use App\Http\Requests;
use App\Lmscategory;
use App\Tag;
use Yajra\Datatables\Datatables;
use DB;
use Auth;
use Image;
use ImageSettings;
use File;
use Exception;
use Illuminate\Support\Facades\Storage;

class TagController extends Controller
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
        $data['active_class'] = 'tags';
        $data['title'] = getPhrase('tags');
        $data['layout'] = getLayout();
        // return view('lms.lmscontents.list', $data);
//dd($data);

        $view_name = getTheme() . '::tags.list';
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

        $records = App\Tag::join('tag_categories', 'tags.type', '=', 'tag_categories.slug')
            ->select(['name','tags.id as tid', 'tags.slug as tagsslug', 'category', 'tags.updated_at'])
            ->orderBy('tags.updated_at', 'desc');
        //dd($records);
        $role = getRole();
//        if($role=="instructor"){
//            $records = $records->where('user_id', Auth::user()->id);
//        }

        $this->setSettings();
        return Datatables::of($records)
            ->addColumn('check_course', function ($records) {

                $link_data1 = '<input name="checkbox_course[]" type="checkbox" class="delete_check" id="delcheck_'.$records->tid.'"    value="'.$records->tid.'">';

                return $link_data1;
            })
            ->editColumn('name', function($records)
            {

                return '<a target="_blank" href="'.URL_TAGS.getTagValue($records->tagsslug).'">'.getTagValue($records->name).'</a>';
            })

            ->addColumn('category', function($records)
            {
                return $records->category;
            })
            ->addColumn('action', function ($records) {
                $extra = '<div class="dropdown more">
                        <a id="dLabel" type="button" class="more-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-dots-vertical"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dLabel">
                            <li><a href="' . URL_TAGS_EDIT . $records->tid . '"><i class="fa fa-pencil"></i>' . getPhrase("edit") . '</a></li>';
                $temp = "";
                if (checkRole(getUserGrade(1))) {
                    $temp = '<li><a href="javascript:void(0);" onclick="deleteRecord(\'' . $records->tid . '\');"><i class="fa fa-trash"></i>' . getPhrase("delete") . '</a></li>';
                }
                $extra .= $temp . '</ul></div>';
                return $extra;
            })
            ->rawColumns(['name',  'action',  'check_course'])
            ->removeColumn('tid')
            ->removeColumn('tags.updated_at')
//            ->removeColumn('tagsslug')

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
        $data['active_class'] = 'tags';
        $data['categories'] = array_pluck(App\TagCategory::all(), 'category', 'slug');
        $data['title'] = getPhrase('Create Tag');
        $data['layout'] = getLayout();

        // return view('lms.lmscontents.add-edit', $data);
        $view_name = getTheme() . '::tags.add-edit';
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
        $record = Tag::getRecordWithID($slug);
        if ($isValid = $this->isValidRecord($record))
            return redirect($isValid);
$record->name=getTagValue($record->name);
$record->slug=getTagValue($record->slug);
        $data['record'] = $record;
        $data['title'] = getPhrase('edit') . ' ' . $record->title;
        $data['active_class'] = 'tags';
        $data['categories'] = array_pluck(App\TagCategory::all(), 'category', 'slug');

        $data['settings'] = json_encode($record);
        $data['layout'] = getLayout();
       // dd($data);
        $view_name = getTheme() . '::tags.add-edit';
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

        $record = Tag::getRecordWithID($slug);
        $rules = [
            'name' => 'bail|required|max:60',
        ];


        $this->validate($request, $rules);
        DB::beginTransaction();
        try {
           // $name = $request->title;
//            if ($name != $record->title)
//                $record->slug = str_slug($name);

            $name = $request->name;
            $record->name = json_encode(array("en"=>$name));
            $record->slug = json_encode(array("en"=>str_slug($name)));


            $record->type = $request->type;


            $record->save();
            $record->slug = json_encode(array("en"=>str_slug($name).'_'.$record->id));
            $record->save();
            DB::commit();
            flash('success', 'record_updated_successfully', 'success');

        } catch (Exception $e) {
            DB::rollBack();
            if (getSetting('show_foreign_key_constraint', 'module')) {

                flash('oops...!', $e->errorInfo, 'error');
            }
        }
        return redirect(URL_TAGS);
    }

    /**
     * This method adds record to DB
     * @param  Request $request [Request Object]
     * @return void
     */
    public function store(Request $request)
    {

        //dd($request);
        if (!checkRole(getUserGrade(2))) {
            prepareBlockUserMessage();
            return back();
        }


        $rules = [
            'name' => 'bail|required|max:360'

        ];


        $this->validate($request, $rules);
        DB::beginTransaction();
        try {
            $record = new App\Tag();
            $name = $request->name;
            $record->name = json_encode(array("en"=>$name));
            $record->slug = json_encode(array("en"=>str_slug($name)));


            $record->type = $request->type;

             $record->save();
            $record->order_column =$record->id;
            $record->slug = json_encode(array("en"=>str_slug($name).'_'.$record->id));

            $record->save();


            DB::commit();
            flash('success', 'record_added_successfully', 'success');

        } catch (Exception $e) {
          //  dd($e->getMessage());
            DB::rollBack();
            if (getSetting('show_foreign_key_constraint', 'module')) {

                flash('oops...!', $e->errorInfo, 'error');
            }
        }

        return redirect(URL_TAGS);
    }


    public function deleteMultiple(Request $request)
    {
        if (!checkRole(getUserGrade(2))) {
            prepareBlockUserMessage();
            return back();
        }
        //$record = Post::where('slug', $slug)->first();
        $id_array = $request->input('deleteids_arr');
        $records_obj = Tag::whereIn('id', $id_array);
        $records=$records_obj->get();

        //$this->setSettings();
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
        $record = Tag::where('id', $slug)->first();

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
