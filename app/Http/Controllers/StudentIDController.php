<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App;
use App\Http\Requests;
use App\Page;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Storage;
use DB;
use Auth;

class StudentIDController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    /**
     * [popup listing method]
     * @return [type] [description]
     */
    public function index()
    {
        if (!checkRole(getUserGrade(2)))
        {
        	prepareBlockUserMessage();
        	return back();
        }

        $data['active_class']     = 'Student Id Card';
        $data['title']            = getPhrase('Student Id Card Listing');
    	// return view('pages.list', $data);
        $view_name = getTheme().'::studentidcard.list';
        return view($view_name, $data);
    }


    /**
     * This method returns the datatables data to view
     * @return [type] [description]
     */
    public function getDatatable()
    {

        if (!checkRole(getUserGrade(2)))
        {
        	prepareBlockUserMessage();
        	return back();
        }

        $records = array();

        $records = App\StudentIdCard::select(['id', 'f_name', 'std_email', 'std_tel','img', 'cost', 'payment_status', 'payment_method'])
            			->orderBy('updated_at', 'desc');


        return Datatables::of($records)
            ->editColumn('id_#', function($records)
            {
                return ucfirst($records->id);
            })
            ->editColumn('name', function($records)
            {
                return '<a href="'.url('/studentid/view/'.$records->id).'" title="'.$records->f_name.'">'.ucfirst($records->f_name).'</a>';
            })

            ->editColumn('img', function ($records) {
                $filename_from_url = parse_url(getPhotoPath($records->img,'thumb'));
                $ext = pathinfo($filename_from_url['path'], PATHINFO_EXTENSION);
                return '<a title="Click to download photo"  href="'.url('/savephoto/'.$records->id).'" target="_blank" download="'.str_slug($records->f_name).'-'.$records->id.'.'.$ext.'"><img alt="'.$records->f_name.'" src="' .getPhotoPath($records->img,'thumb')  . '"  /></a>';
            })
            ->editColumn('email', function($records)
            {
                return ucfirst($records->std_email);
            })
            ->editColumn('phone_#', function($records)
            {
                return ucfirst($records->std_tel);
            })
            ->editColumn('price', function($records)
            {
                return ucfirst($records->cost);
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

            ->rawColumns([ 'id', 'name','email','img', 'phone_#', 'price','payment_status', 'check_course'])
            ->removeColumn('slug')
            ->removeColumn('updated_at')
        ->removeColumn('id')
        ->make();

    }

     /**
     * This method loads the create view
     * @return void
     */

    public function view($id)
    {
        if (!checkRole(getUserGrade(2)))
        {
            prepareBlockUserMessage();
            return back();
        }

        $record = App\StudentIdCard::find($id);

        $data['record']       		= $record;
        $data['active_class']     	= 'Student ID Card ';
        $data['settings']       	= FALSE;
        $data['title']            = getPhrase('view_student_card_detail');

        $view_name = getTheme().'::studentidcard.view';
        return view($view_name, $data);
    }




}
