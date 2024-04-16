<?php
namespace App\Http\Controllers;
use \App;
use Illuminate\Http\Request;
use PHPUnit\Framework\Exception;
use App\Http\Requests;
use App\PostCategory;
use Yajra\Datatables\Datatables;
use DB;
use Auth;
use Image;
use ImageSettings;
use File;
use Illuminate\Support\Facades\Storage;

class PostCategoryController extends Controller
{

    public function __construct()
    {
    	$this->middleware('auth');


    }

    protected  $postSettings;

    public function setPostSettings()
    {
        $this->postSettings = getPostSettings();
    }

    public function getPostSettings()
    {
        return $this->postSettings;
    }

    /**
     * Course listing method
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        if(!checkRole(getUserGrade(2)))
        {
          prepareBlockUserMessage();
          return back();
        }

        $data['active_class']       = 'posts';
        $data['title']              = getPhrase('post_categories');

         $view_name = getTheme().'::posts.postcategories.list';
        return view($view_name, $data);
    }

    /**
     * This method returns the datatables data to view
     * @return [type] [description]
     */
    public function getDatatable()
    {

        if(!checkRole(getUserGrade(2)))
        {
          prepareBlockUserMessage();
          return back();
        }

         $records = PostCategory::select([
         	'category', 'image', 'description','id','slug'])
         ->orderBy('updated_at', 'desc');
         $this->setPostSettings();

        return Datatables::of($records)
        ->addColumn('action', function ($records) {

         $link_data = '<div class="dropdown more">
                        <a id="dLabel" type="button" class="more-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-dots-vertical"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dLabel">
                            <li><a href="'.URL_POST_CATEGORY_EDIT.'/'.$records->slug.'"><i class="fa fa-pencil"></i>'.getPhrase("edit").'</a></li>';


        $temp = '';
        if(checkRole(getUserGrade(1))) {
        $temp .= '<li><a href="javascript:void(0);" onclick="deleteRecord(\''.$records->slug.'\');"><i class="fa fa-trash"></i>'. getPhrase("delete").'</a></li>';
        }
        $temp .='</ul></div>';

        $link_data = $link_data.$temp;
            return $link_data;
            })
        ->removeColumn('id')
        ->removeColumn('slug')
        ->editColumn('image', function($records){
            $settings = $this->getPostSettings();
            $path = $settings->categoryImagepath;
            $image = $path.$settings->defaultCategoryImage;
            if($records->image)
                $image = UPLOADS."lms/categories/" . $records->image;
            else
                $image = "https://via.placeholder.com/150";

            return '<img src="'.$image.'" height="100" width="100" />';
        })
          ->rawColumns(['image','action'])
        ->make();
    }

    /**
     * This method loads the create view
     * @return void
     */
    public function create()
    {
        if(!checkRole(getUserGrade(2)))
        {
          prepareBlockUserMessage();
          return back();
        }

    	$data['record']         	= FALSE;
    	$data['active_class']       = 'posts';
    	$data['title']              = getPhrase('create_category');
    	// return view('posts.postcategories.add-edit', $data);

           $view_name = getTheme().'::posts.postcategories.add-edit';
        return view($view_name, $data);
    }

    /**
     * This method loads the edit view based on unique slug provided by user
     * @param  [string] $slug [unique slug of the record]
     * @return [view with record]
     */
    public function edit($slug)
    {
         if(!checkRole(getUserGrade(2)))
        {
          prepareBlockUserMessage();
          return back();
        }

    	$record = PostCategory::getRecordWithSlug($slug);
    	if($isValid = $this->isValidRecord($record))
    		return redirect($isValid);

    	$data['record']       		= $record;
    	$data['active_class']       = 'posts';
    	$data['title']              = getPhrase('edit_category');
    	// return view('posts.postcategories.add-edit', $data);

          $view_name = getTheme().'::posts.postcategories.add-edit';
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
         if(!checkRole(getUserGrade(2)))
        {
          prepareBlockUserMessage();
          return back();
        }

    	$record = PostCategory::getRecordWithSlug($slug);
		$rules = [
         'category'          => 'bail|required|max:60',
          'catimage'         => 'bail|mimes:png,jpg,jpeg|max:2048'
          ];
         /**
        * Check if the title of the record is changed,
        * if changed update the slug value based on the new title
        */
       $name = $request->category;
//        if($name != $record->category)
//            $record->slug = str_slug($name);

       //Validate the overall request
       $this->validate($request, $rules);
    	$record->category 			= $name;
        $record->description		= $request->description;
        $record->record_updated_by 	= Auth::user()->id;
        $file_name = 'catimage';
        /************ Image Upload ***********/
        if (!empty($request->file($file_name))) {
            $BlogCatImage = $request->file($file_name);
            $BlogCatImage_new_name = rand() . '.' . $BlogCatImage->getClientOriginalExtension();
            $record->image = $BlogCatImage_new_name;

            if (env('FILESYSTEM_DRIVER') == 's3') {
                $filePath = 'lms/categories/' . $BlogCatImage_new_name;
                Storage::disk('s3')->put($filePath, file_get_contents($BlogCatImage));
            } else {
                if (!empty($request->file($file_name))) {
                    (file_exists('public/lms/categories/' . $record->image)) ? unlink('public/lms/categories/' . $record->image) : "";
                }
                $BlogCatImage->move('public/lms/categories/', $BlogCatImage_new_name);
            }
        }
        /************ Image Upload ***********/
        $record->save();

        flash('success','record_updated_successfully', 'success');
    	return redirect(URL_POST_CATEGORIES);
    }

    /**
     * This method adds record to DB
     * @param  Request $request [Request Object]
     * @return void
     */
    public function store(Request $request)
    {
        if(!checkRole(getUserGrade(2)))
        {
          prepareBlockUserMessage();
          return back();
        }
// catimage
        try {
	    $rules = [
         'category'          	   => 'bail|required|max:60' ,
         'catimage'                => 'bail|mimes:png,jpg,jpeg|max:2048'
            ];
        $this->validate($request, $rules);
        $record = new PostCategory();
      	$name  						=  $request->category;
		$record->category 			= $name;
       	//$record->slug 				= str_slug($name);
        $record->description		= $request->description;
        $record->record_updated_by 	= Auth::user()->id;

        $file_name = 'catimage';
        /************ Image Upload ***********/
        if (!empty($request->file($file_name))) {
            $BlogCatImage = $request->file($file_name);
            $BlogCatImage_new_name = rand() . '.' . $BlogCatImage->getClientOriginalExtension();
            $record->image = $BlogCatImage_new_name;

            if (env('FILESYSTEM_DRIVER') == 's3') {
                $filePath = 'lms/Categories/' . $BlogCatImage_new_name;
                Storage::disk('s3')->put($filePath, file_get_contents($BlogCatImage));
            } else {
                if (!empty($request->file($file_name))) {
                    (file_exists('public/lms/Categories/' . $record->image)) ? unlink('public/lms/Categories/' . $record->image) : "";
                }
                $BlogCatImage->move('public/lms/Categories/', $BlogCatImage_new_name);
            }
        }
        /************ Image Upload ***********/
        $record->save();

            flash('success','record_added_successfully', 'success');
            return redirect(URL_POST_CATEGORIES);
        }

//catch exception
        catch(\Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

    }

    /**
     * Delete Record based on the provided slug
     * @param  [string] $slug [unique slug]
     * @return Boolean
     */
    public function delete($slug)
    {
         if(!checkRole(getUserGrade(2)))
        {
          prepareBlockUserMessage();
          return back();
        }

        $record = PostCategory::where('slug', $slug)->first();
            try{
            if(!env('DEMO_MODE')) {
                $this->setPostSettings();
                $postSettings = $this->getPostSettings();
                $path = $postSettings->categoryImagepath;
                $this->deleteFile($record->image, $path);
                $record->delete();
            }
            $response['status'] = 1;
            $response['message'] = getPhrase('category_deleted_successfully');

       } catch ( \Illuminate\Database\QueryException $e) {
                 $response['status'] = 0;
           if(getSetting('show_foreign_key_constraint','module'))
            $response['message'] =  $e->errorInfo;
           else
            $response['message'] =  getPhrase('this_record_is_in_use_in_other_modules');
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
    	return URL_POST_CATEGORIES;
    }

     public function deleteFile($record, $path, $is_array = FALSE)
    {
         if(env('DEMO_MODE')) {
        return ;
       }

        $files = array();
        $files[] = $path.$record;
        File::delete($files);
    }

     /**
     * This method process the image is being refferred
     * by getting the settings from ImageSettings Class
     * @param  Request $request   [Request object from user]
     * @param  [type]  $record    [The saved record which contains the ID]
     * @param  [type]  $file_name [The Name of the file which need to upload]
     * @return [type]             [description]
     */
     public function processUpload(Request $request, $record, $file_name)
     {
         if(env('DEMO_MODE')) {
        return ;
       }

         if ($request->hasFile($file_name)) {
          $postSettings = getPostSettings();

          $destinationPath      = $postSettings->categoryImagepath;

          $fileName = $record->id.'-'.$file_name.'.'.$request->$file_name->guessClientExtension();

          $request->file($file_name)->move($destinationPath, $fileName);

         //Save Normal Image with 300x300
          Image::make($destinationPath.$fileName)->fit($postSettings->imageSize)->save($destinationPath.$fileName);
         return $fileName;
        }
     }
}
