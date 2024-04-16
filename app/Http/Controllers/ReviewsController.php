<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App;
use App\Http\Requests;
use App\Lmscategory;
use App\Review;

use Yajra\Datatables\Datatables;
use DB;
use Auth;
use Image;
use ImageSettings;
use File;
use Exception;

class ReviewsController extends Controller
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
        $data['active_class'] = 'reviews';
        $data['title'] = getPhrase('reviews');
        $data['layout'] = getLayout();

        $view_name = getTheme() . '::reviews.list';
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
        $records = Review::join('users', 'users.id','=','reviews.user_id')
            ->leftjoin('lmsseries', 'lmsseries.id','=','reviews.course_id')
            ->select(['reviews.id','lmsseries.title as course','lmsseries.slug as slug','reviews.comment','reviews.review_title as  review_title','approved', 'users.name as username','reviews.rating','reviews.updated_at'])
            ->orderBy('updated_at', 'desc');

        $this->setSettings();
        return Datatables::of($records)
            ->addColumn('check_course', function ($records) {

                $link_data1 = '<input name="checkbox_course[]" type="checkbox" class="delete_check" id="delcheck_'.$records->id.'"    value="'.$records->id.'">';

                return $link_data1;
            })
            ->editColumn('course', function($records)
            {
                return '<a target="_blank" href="'.URL_VIEW_LMS_CONTENTS.$records->slug.'">'.$records->course.'</a>';
            })
            ->addColumn('action', function ($records) {
                $extra = '<div class="dropdown more">
                        <a id="dLabel" type="button" class="more-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-dots-vertical"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dLabel">
                            <li><a href="' . URL_REVIEWS_EDIT . $records->id . '"><i class="fa fa-pencil"></i>' . getPhrase("edit") . '</a></li>';
                $temp = "";
                if (checkRole(getUserGrade(1))) {
                    $temp = '<li><a href="javascript:void(0);" onclick="deleteRecord(\'' . $records->id . '\');"><i class="fa fa-trash"></i>' . getPhrase("delete") . '</a></li>';
                }
                $extra .= $temp . '</ul></div>';
                return $extra;
            })
            ->rawColumns(['action','course','check_course'])
            ->removeColumn('id')
            ->removeColumn('slug')
            ->removeColumn('updated_at')
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
        $data['active_class'] = 'reviews';
        $allcoures = App\LmsSeries::select('title', 'id')->get();
        $allusers= App\User::select('name', 'id')->get();
        $data['courses'] = array_pluck($allcoures, 'title', 'id');
        $data['users'] = array_pluck($allusers, 'name', 'id');


        $data['title'] = getPhrase('Create Review');
        $data['layout'] = getLayout();

        // return view('lms.lmscontents.add-edit', $data);
        $view_name = getTheme() . '::reviews.add-edit';
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
        $record = Review::getRecordWithId($slug);
        if ($isValid = $this->isValidRecord($record))
            return redirect($isValid);

        $data['record'] = $record;
        $data['title'] = getPhrase('Edit Review');
//        $data['title'] = getPhrase('edit') . ' ' . $record->comment;
        $data['active_class'] = 'reviews';
        $data['courses'] = array_pluck(App\LmsSeries::all(), 'title', 'id');
        $data['users'] = array_pluck(App\User::all(), 'name', 'id');

        $data['settings'] = json_encode($record);
        $data['layout'] = getLayout();
        $view_name = getTheme() . '::reviews.add-edit';
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
//        if (!checkRole(getUserGrade(2))) {
//            prepareBlockUserMessage();
//            return back();
//        }

        $record = Review::getRecordWithId($slug);
        $rules = [
            'comment' => 'bail|required|max:1060',
        ];


        $this->validate($request, $rules);
        DB::beginTransaction();
        try {

            $record->comment = $request->comment;
            $record->rating = $request->rating;

            $record->user_id = $request->user_id;
            $record->review_title = $request->review_title;
            $record->course_id = $request->course_id;
            $record->created_at = $request->created_at;


            $record->save();


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
        return redirect(URL_REVIEWS);
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
            'comment' => 'bail|required|max:1060',
        ];


        $this->validate($request, $rules);
        DB::beginTransaction();
        try {



            $record = new App\Review();
            $record->comment = $request->comment;
            $record->rating = $request->rating;
            $record->review_title = $request->review_title;

            $record->user_id = $request->user_id;
            $record->course_id = $request->course_id;
            $record->created_at = $request->created_at;

            $record->save();

            DB::commit();
            flash('success', 'record_added_successfully', 'success');

        } catch (Exception $e) {
            DB::rollBack();
            if (getSetting('show_foreign_key_constraint', 'module')) {

                flash('oops...!', $e->errorInfo, 'error');
            } else {
                flash('oops...!', 'improper_data_file_submitted', 'error');
            }
        }

        return redirect(URL_REVIEWS);
    }

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
        $record = Review::where('id', $slug)->first();
        $this->setSettings();
        try {
            if (!env('DEMO_MODE')) {

                $record->delete();
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

    public function deleteMultiple(Request $request)
    {
        if (!checkRole(getUserGrade(2))) {
            prepareBlockUserMessage();
            return back();
        }
        //$record = Post::where('slug', $slug)->first();
        $id_array = $request->input('deleteids_arr');
        $records = Review::whereIn('id', $id_array);
        $this->setSettings();
        try {
            if (!env('DEMO_MODE')) {

                $records->delete();
            }

            $response['status'] = 1;
            $response['message'] = getPhrase('reviews_deleted_successfully');
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

}
