@extends($layout)



 

 <?php

/**

 * Varables Used

 * @submitted_answers               -- The answers submitted by the user

 * @correct_answer_questions        -- It contains overall correct answer questions id's

 * @answer_status                   -- It will have a class if the answer is wrong

 * @user_answers                    -- It will hold all the user answers specific to question

 * @time_spent_correct_answers      -- It will maintain the list of time to spend and time spent on 

 *                                     question associated to question id

 * @time_spent_wrong_answers        -- It will maintain the list of time to spend and time spent on 

 *                                     question associated to question id

 * @time_spent_not_answers          -- It will maintain the list of time to spend and time spent on 

 *                                     question associated to question id

 */

 ?>

@section('content')
<style>
    input[type="radio"], input[type="checkbox"] {
        display: contents;
    }
</style>
  <div id="page-wrapper" class="answer-sheet" ng-controller="angExamScript" >

            <div class="container-fluid">

                <!-- Page Heading -->

                <div class="row">

                    <div class="col-lg-12">

                        <ol class="breadcrumb">

                            <li><a href="{{PREFIX}}"><i class="mdi mdi-home"></i></a> </li>

                            <li><a href="{{URL_STUDENT_ANALYSIS_BY_EXAM.$user_details->slug}}">{{getPhrase('analysis')}}</a></li>

                            <li>{{$exam_record->title.' '.getPhrase('answers')}}</li>

                        </ol>

                    </div>

                </div>

                <!-- /.statistic -->




                <div class="panel panel-custom">

                    <div class="panel-heading">
                        <div class="pull-right messages-buttons">

                            <a href="{{route('download.exam.res',[$exam_record->slug,$result_record->slug])}}" class="btn  btn-primary button">Export to PDF</a>

                        </div>
                        <h1>{{$exam_record->title}} 



                        <span class="result-pf-text">{{getPhrase('result').': '.$result_record->exam_status}} </span>
                            
                              <span class="pull-right">
                               
                                @include('student.exams.languages',['quiz'=>$exam_record])
                            </span>

                        </h1> 

                        

                        </div>

                    <?php 

                   

                    $submitted_answers = [];

                            $answers = (array)json_decode($result_record->answers);



                            foreach ($answers as $key => $value) {

                                $submitted_answers[$key] = $value;

                            }



                    $correct_answer_questions = [];

                    $correct_answer_questions = (array) 

                                                json_decode($result_record->correct_answer_questions);

                     



                    $time_spent_correct_answers = 

                            getArrayFromJson($result_record->time_spent_correct_answer_questions);

                                                    

                    $time_spent_wrong_answers = getArrayFromJson($result_record->time_spent_wrong_answer_questions);



                    $time_spent_not_answers = getArrayFromJson($result_record->time_spent_not_answered_questions);

                                                



                    // print_r($time_spent_correct_answers);

                    $question_number =0;

                   ?>

                    @foreach($questions as $question)

                           <?php 

                           $question_number++;

                                $user_answers   = FALSE;

                                $time_spent     = array();



                                //Pull User Answers for this question

                                if(array_key_exists($question->id, $submitted_answers)) {

                                    $user_answers = $submitted_answers[$question->id];

                                }

 

                                 //Pull Timing details for this question for correct answers

                                if(array_key_exists($question->id, $time_spent_correct_answers)) 

                                    $time_spent = $time_spent_correct_answers[$question->id];

                                

                                 //Pull Timing details for this question for wrong answers

                                if(array_key_exists($question->id, $time_spent_wrong_answers)) 

                                    $time_spent = $time_spent_wrong_answers[$question->id];

                                 

                                 //Pull Timing details for this question which are not answered

                                if(array_key_exists($question->id, $time_spent_not_answers)) 

                                    $time_spent = $time_spent_not_answers[$question->id];

                          



                    ?> 



                    <div class="panel-body question-ans-box" id="{{$question->id}}"  style="display:block;">

                    <?php 

                   

                        $question_type = $question->question_type;



                        $subject_record = array();

                        foreach ($subjects as $subject) {

                            if($subject->id == $question->subject_id) {

                                $subject_record = $subject;

                                break;

                            }

                        }



                         $inject_data = array(

                                    'question'      => $question,

                                    'user_answers'  => $user_answers,

                                    'subject'      => $subject_record,

                                    'question_number' => $question_number,

                                    'time_spent'    => $time_spent,   

                                );

                    ?>


                      @include('student.exams.results.question-metainfo',array('meta'=> $inject_data))

                         @include('student.exams.results.'.$question_type.'-answers', $inject_data)

                        

                         @if($question->explanation)

                         

                          <div class="answer-status-container">

                        <div class="row">

                            <div class="col-md-12">

                                <div class="question-status">

                                    <strong>{{getPhrase('explanation')}}: </strong>

                                       <span class="language_l1"> {!! $question->explanation!!}</span>
                                       @if(isset($question->explanation_l2))
                                       <span class="language_l2" style="display: none;"> {!! $question->explanation_l2!!}</span>
                                       @else
                                       <span class="language_l2" style="display: none;"> {!! $question->explanation!!}</span>
                                       @endif

                                </div>

                            </div>

                            

                        </div>

                        </div>

                        @endif

                         

                    </div>

                    @endforeach

     

                    <div class="row">
                        <div class="col-md-12">
<div class="text-center pb-30">
                            <?php



    $records = App\Quiz::join('quizresults', 'quizzes.id', '=', 'quizresults.quiz_id')
                                ->select(['title','is_paid' ,'dueration', 'quizzes.total_marks',  \DB::raw('count(quizresults.user_id) as attempts, quizzes.slug, user_id') ])
                                ->where('user_id', '=', $user_details->id)
                                ->where('quizresults.quiz_id', '=', $exam_record->id)
                                ->first();

                            $attempts=$records->attempts;

                             //   dd($exam_record);

                            $exam_type=DB::table('lmsseries_exams')->select('exam_type','lmsseries_id')
                                //->where('lmsseries_id', $item->id)
                                ->where('exam_quiz_id', $exam_record->id)
                                ->first();

                            //If exam is taken then attemp is over in case of retake exam
                            $examretakefee = App\ExamRetakeFee::where('user_id','=',$user_details->id)
                                ->where('course_id','=',$exam_type->lmsseries_id)
                                ->where('quiz_id','=',$exam_record->id)
                                ->where('attempt_status','=','no')
                                ->first();
                            if($examretakefee){
                                $examretakefee->attempt_status = 'yes';
                                $examretakefee->save();
                            }

    if(strpos($exam_record->title, "Mock") !== false){
                                $exam_actual_type='Mock';
                            }else if(strpos($exam_record->title, "Final") !== false){
                                $exam_actual_type='Final';
                            }else{
                                $exam_actual_type=$exam_type->exam_type;
                            }

    if($exam_actual_type=='Final'){
        $allowed=1;
    }else{
        $allowed=3;
    }
    if(\App\ExamRetakeFee::checkRetakeFee( $exam_type->lmsseries_id,$exam_record->id,$user_details->id)){
        if($exam_actual_type=='Final'){
            $allowed=2;
            // $attempts=0;
        }
    }
                           // if($exam_actual_type=='Mock' && $result_record->exam_status=='fail'){
                                ?>

                                <h3>Retake Exam :  {{$exam_record->title}} </h3>
                                <a class="notifylearner btn btn-lg btn-success button"    data-allowed="{{$allowed}}"  data-attempts="{{$attempts}}" data-exam_type="{{$exam_actual_type }}" data-url="{{URL_STUDENT_TAKE_EXAM.$exam_record->slug}}" data-retakeurl="{{url('/retake_exam_fee/'.$exam_type->lmsseries_id.'/'.$exam_record->id)}}" href="javascript:void(0);">
                                    <span class="textexam"> Retake {{$exam_actual_type}} Exam  </span></a>
                                <a class=" btn btn-lg btn-primary button" href="{{URL_STUDENT_ANALYSIS_BY_EXAM.$user_details->slug}}">Your Exams Analysis</a>
                            <?php
                            //}
                            ?>
                            </div>
                        </div>
                    </div>
                            <div class="row" style="display: none">

                                <div class="col-md-12">
<div class="d_but">
                                    <button class="btn btn-lg btn-success button prev" type="button">

                                        <i class="mdi mdi-chevron-left ">

                                        </i>

                                        {{getPhrase('previous')}}

                                    </button>

                                  

                                    <button class="btn btn-lg btn-success button next" type="button">

                                        {{ getPhrase('next')}}

                                        <i class="mdi mdi-chevron-right">

                                        </i>

                                    </button>
 </div>

                                    

                                </div>

                            </div>

                        </hr>

                    

                </div>

                <!-- /.row -->

            </div>

            <!-- /.container-fluid -->

        </div>

          

@stop

 

@section('footer_scripts')
@include('student.exams.results.scripts.js-scripts')
@include('student.lms.scripts.common-scripts')
<script>

    function languageChanged(language_value)
    {
      if(language_value=='language_l2')
      {
        $('.language_l1').hide();
        $('.language_l2').show();
      }
      else {
        $('.language_l2').hide();
        $('.language_l1').show(); 
      }
      
    }

</script>

  
@stop