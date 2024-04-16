<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Answer;
use Auth;
use App\LmsSeries;
use App\Question;
use Session;
use App\User;

class InstructorAnswerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $data['active_class'] = 'discussions';
        $data['title'] = getPhrase('Answers');

        $data['answers']=Answer::all();

        return view(getTheme() . '::instructors.answer.index',$data);


    }

    public function create()
    {
        $course = LmsSeries::where('user_id', Auth::User()->id)->get();
        $data['active_class'] = 'discussions';
        $data['title'] = getPhrase('Answers');

        $data['course'] = $course;
        $data['questions'] = Question::where('user_id', Auth::User()->id)->get();

        return view(getTheme() . '::instructors.answer.add',$data);



    }

    public function store(Request $request)
    {
    	$data = $this->validate($request,[
            'course_id' => 'required',
            'answer' => 'required',
        ]);

        $input = $request->all();
        $data = Answer::create($input);
        $data->save(); 

        Session::flash('success','Added Successfully !');
        return redirect('instructoranswer');

    }

    public function show($id)
    {
        $answer = Answer::find($id);
        $user =  User::all();
        $courses = LmsSeries::all();

        $data['active_class'] = 'discussions';
        $data['title'] = getPhrase('Answers');
        $data['answer'] = $answer;
        $data['user'] = $user;
        $data['courses'] = $courses;

        return view(getTheme() . '::instructors.answer.edit',$data);
    }

    public function update(Request $request, $id)
    {
        $data = $this->validate($request,[
            'answer' => 'required',
        ]);
        
        $data = Answer::findorfail($id);
        $input = $request->all();
        $data->update($input);

        Session::flash('success','Updated Successfully !');
        return redirect('instructoranswer');

    }

    public function destroy($id)
    {
        Answer::where('id',$id)->delete();
        return back();
    }

}
