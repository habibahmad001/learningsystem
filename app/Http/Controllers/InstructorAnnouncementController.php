<?php

namespace App\Http\Controllers;

use App\LmsSeries;
use Illuminate\Http\Request;
use App\Announcement;
use App\Course;
use Auth;
use Session;

class InstructorAnnouncementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $data['active_class'] = 'announcements';
        $data['title'] = getPhrase('announcements');
        if(getRoleData(Auth::User()->role_id)=="admin" || getRoleData(Auth::User()->role_id)=="owner")
        $announs = Announcement::with('user','courses')->get();
        else
        $announs = Announcement::with('user','courses')->where('user_id', Auth::User()->id)->get();
        $data['announs']=$announs;
        $data['userrole']=getRoleData(Auth::User()->role_id);
 //dd($data);
        return view(getTheme() . '::instructors.announcement.index',$data);


    }

    public function create()
    {
        if(getRoleData(Auth::User()->role_id)=="admin" || getRoleData(Auth::User()->role_id)=="owner")
        $course = LmsSeries::where('status', 1)->get();
        else
        $course = LmsSeries::where('user_id', Auth::User()->id)->where('status', 1)->get();
        $data['active_class'] = 'announcements';
        $data['title'] = getPhrase('announcements');
        $data['userrole']=getRoleData(Auth::User()->role_id);
        $data['course'] = $course;

        return view(getTheme() . '::instructors.announcement.create',$data);


    }

    public function store(Request $request)
    {
       $data = $this->validate($request,[
            'course_id' => 'required',
            'announsment' => 'required',
        ]);

        $input = $request->all();
        $data = Announcement::create($input);
        $data->save();
        flash('success','Added Successfully !', 'success');
//        Session::flash('success','Added Successfully !');
        return redirect('instructor/announcement'); 
    }

    public function show($id)
    {

        $course = LmsSeries::where('user_id', Auth::User()->id)->get();
        $announs = Announcement::find($id);

        $data['active_class'] = 'announcements';
        $data['title'] = getPhrase('announcements');
           $data['announs'] = $announs;
        $data['course'] = $course;

        $data['userrole']=getRoleData(Auth::User()->role_id);
        return view(getTheme() . '::instructors.announcement.show',$data);
     }

    public function edit($id)
    {

        $course = LmsSeries::where('user_id', Auth::User()->id)->get();
        $announs = Announcement::find($id);

        $data['active_class'] = 'announcements';
        $data['title'] = getPhrase('announcements');
        $data['announs'] = $announs;
        $data['userrole']=getRoleData(Auth::User()->role_id);
        $data['course'] = $course;

        return view(getTheme() . '::instructors.announcement.edit',$data);
    }

    public function update(Request $request, $id)
    {

        $data = $this->validate($request,[
            'announsment' => 'required',
        ]);

        $data = Announcement::findorfail($id);
        $input = $request->all();
        $data->update($input);
        flash('success','Updated Successfully !', 'success');
//        Session::flash('success','Updated Successfully !');
        return redirect('instructor/announcement');

    }

    public function destroy($id)
    {
        Announcement::where('id',$id)->delete();
        return back();
    }

}
