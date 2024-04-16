{{--<link  rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">--}}
<style>
    .correct-answer:before {
        background: #cef7c0;
        content: '';
        position: absolute;
        left: 0;
        top: -3px;
        width: 100%;
        height: 100%;
        z-index: 0;
        /* box-shadow: 0 0 30px #cef7c0; */
    }
    input[type="radio"], input[type="checkbox"] {
        display: contents;
    }
    .panel-heading{
        text-align: center;
    }
    .questions.questions-withno {
        position: relative;
        padding-left: 50px;
    }
    .answer-status-container {
        background: #fafafa;
        margin: 10px 0;
    }
    .questions.questions-withno .question-numbers {
        position: absolute;
        left: 0;
        top: 0;
        font-weight: 700;
    }
    .questions {
        font-size: 20px;
    }
    .col-md-6 {
        width: 50%;
    }
    p {
        margin: 0 0 10px;
    }
    .pull-right {
        float: right!important;
    }
    .answer-status-container {
        background: #fafafa;
        margin: 10px 0;
    }
    .row {
        margin-right: -15px;
        margin-left: -15px;
    }
    .col-md-3 {
        width: 25%;
    }
    button[disabled], html input[disabled] {
        background-color: #eee;
        color: #a9c2ca;
    }
    .answer-status-container .question-status {
        margin: 10px 0;
        padding: 0 20px;
    }
    .label {
        font-weight: 400;
        letter-spacing: .5px;
    }
    .label-info {
        background-color: #5bc0de;
    }
    .label {
        display: inline;
        padding: .2em .6em .3em;
        font-size: 75%;
        font-weight: 700;
        line-height: 1;
        color: #fff;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: .25em;
    }
    .optional-questions {
        margin: 0;
        padding: 0;
        list-style: none;
    }
    .answer_radio {
        margin-bottom: 30px;
    }
    input[type="radio"] + label, input[type="checkbox"] + label {
        line-height: 28px;
        cursor: pointer;
        position: relative;
    }
    input[type="radio"] + label .radio-button {
        width: 28px;
        height: 28px;
        border: 2px solid #000;
        border-radius: 100%;
    }
    input[type="radio"] + label span.fa-stack, input[type="checkbox"] + label span.fa-stack {
        float: left;
        margin: 0 20px 0 0;
    }
    .answer_radio {
        margin-bottom: 30px;
    }
    .correct-answer, .wrong-answer {
        position: relative;
    }
</style>
<div id="page-wrapper" class="answer-sheet" ng-controller="angExamScript" >

    <div class="container-fluid">
        <!-- Page Heading -->
        <!-- /.statistic -->
        <div class="panel panel-custom">
            <div class="panel-heading">
                <h1>{{$exam_record->title}}
                    <br>
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

            $correct_answer_questions = (array)json_decode($result_record->correct_answer_questions);

            $time_spent_correct_answers =getArrayFromJson($result_record->time_spent_correct_answer_questions);

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
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>