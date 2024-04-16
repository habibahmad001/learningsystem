<?php

namespace App\Http\Controllers;

use App\LmsSeries;
use Illuminate\Http\Request;
use App\Question;
use Auth;
use App\Course;
use Session;
use App\User;
use App\Answer;

class InstructorQuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data['active_class'] = 'discussions';
        $data['title'] = getPhrase('Questions');
    	$questions = Question::where('instructor_id', Auth::User()->id)->get();
        $data['questions']=$questions;
    	return view(getTheme() . '::instructors.question.index',$data);
    }

    public function create()
    {
        $course = LmsSeries::where('user_id', Auth::User()->id)->get();
        $data['active_class'] = 'discussions';
        $data['title'] = getPhrase('Questions');

        $data['course'] = $course;

        return view(getTheme() . '::instructors.question.add',$data);
    }

    public function store(Request $request)
    {
        $data = $this->validate($request,[
            'course_id' => 'required',
            'question' => 'required',
        ]);

        $input = $request->all();
        $data = Question::create($input);
        $data->save(); 

        Session::flash('success','Added Successfully !');
        return redirect('instructorquestion');
    }

    public function show($id)
    {
        $que = Question::find($id);
        $user =  User::all();
        $courses = LmsSeries::all();

        $data['active_class'] = 'discussions';
        $data['title'] = getPhrase('Questions');
        $data['que'] = $que;
        $data['user'] = $user;
        $data['courses'] = $courses;


        return view(getTheme() . '::instructors.question.edit',$data);
    }

    public function update(Request $request, $id)
    {
        $data = $this->validate($request,[
            'question' => 'required',
        ]);

        $data = Question::findorfail($id);
        $input = $request->all();
        $data->update($input);

        Session::flash('success','Updated Successfully !');
        return redirect('instructorquestion');

    }

    public function destroy($id)
    {
        Question::where('id',$id)->delete();
        Answer::where('question_id',$id)->delete();
        return back();
    }
}
