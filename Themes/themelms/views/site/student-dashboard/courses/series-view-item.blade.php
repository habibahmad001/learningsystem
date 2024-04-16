@extends('layouts.sitelayout')
@toastr_css
<style>
    .modal-body {
        display: grid;
    }

    .form-group label {
        position: relative;
        cursor: pointer;
    }

    .list-item .form-group {
        margin-bottom: 0px;
        display: inline;
    }
    #pdfviewer .modal-body {
        padding: 0;
    }
    #pdfviewer button.close{
        position: absolute;
        right: 0;
        z-index: 999;
        background: #000;
        width: 100px;
        font-size: 40px;
        bottom: 0;
    }

    .modal-body .form-group {

        margin-right: 5px;
    }

    .lesson-list .form-group input {
        padding: 0;
        height: initial;
        width: initial;
        margin-bottom: 0;
        display: none !important;
        cursor: pointer;
    }

    .lesson-list .form-group label:before {
        content: '';
        -webkit-appearance: none;
        background-color: transparent;
        border: 2px solid #097e97;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05), inset 0px -15px 10px -12px rgba(0, 0, 0, 0.05);
        padding: 6px;
        display: inline-block;
        position: relative;
        vertical-align: middle;
        cursor: pointer;
        margin-right: 5px;
    }

    .lesson-list .form-group input:checked + label:after {
        content: '';
        display: block;
        position: absolute;
        top: 1px;
        left: 6px;
        width: 5px;
        height: 11px;
        border: solid #097e97;
        border-width: 0 2px 2px 0;
        transform: rotate(45deg);
    }
    .modal-body form .form-group {
        margin-right: 10px;
    }
    .lesson-list .list-item .form-group label {
        color: #353f4d;
        font-weight: normal;
        margin-bottom: 0px;
        margin-left: 5px;
    }
</style>
@section('content')
    @include('site.partials.student_topBar')

<div id="page-wrapper">
    <div class="container-fluid"  id="course_area">
        <div class="row">
            <div class="col-lg-9 col-md-8 course_header_col">
                {{--<a href="{{URL_STUDENT_LMS_SERIES}}">{{getPhrase('learning_management_series')}} </a>--}}
                <h5>{{ $title }}</h5>
            </div>
            <div class="col-lg-3 col-md-4 course_header_col text-right">
                <a href="javascript:void(0)" id="fullscreen_toggle" class="course_btn"><i class="fa fa-arrows-h"></i></a>
                <a href="{{URL_STUDENT_LMS_SERIES}}" class="course_btn"> <i class="fa fa-chevron-left"></i> My Courses</a>
                <a href="{{URL_STUDENT_LMS_SERIES_VIEW.$item->slug}}"  class="course_btn">Course Details <i class="fa fa-chevron-right"></i></a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-9 col-md-8">
        @if(!$content_record)
                <?php
                $image = IMAGE_PATH_UPLOAD_LMS_DEFAULT;

                if($item->image)

                    $image = IMAGE_PATH_UPLOAD_LMS_SERIES.$item->image;

                ?>


                        {{--<h2>{{$item->title}} </h2>--}}
{{--                        {!! $item->description!!}--}}

                <!-- courses-content start -->
                    @include('admin.message')

                    <section id="learning-courses-home" class="learning-courses-home-main-block">
                        <div class="">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="learning-courses-home-video text-white btm-30">
                                        <div class="video-item hidden-xs">
                                            <div class="video-device">
                                                <img src="{{$image}}" class="img-responsive center-block" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="learning-courses-home-block text-white">
                                        <div class="item-details">
                                            <h3>Contents/Units Completion Progress</h3>
                                            <div class="quiz-short-discription d-none">{!! substr($item->sub_title,0,70).'...' !!}{{--{!!$c->sub_title!!}--}}</div>
                                            <div class="progress" >
                                                <div class="progress-bar progress-bar-striped bg-danger" role="progressbar" style="width: <?php echo course_progress($item->id); ?>%" aria-valuenow="<?php echo course_progress($item->id); ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>

                                            <?php //print(course_progress($c->id)); ?>

<div class="completed"><small><?php echo ceil(course_progress($item->id)); ?>% {{getPhrase('completed')}}</small>
</div>
                                                           </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section id="learning-courses" class="learning-courses-about-main-block">
                        <div class="">
                            <div class="about-block">
                                <nav>
                                    <?php
                                    $quizzes = DB::table('quizzes')
                                        ->join('lmsseries_exams', 'quizzes.id', '=', 'lmsseries_exams.exam_quiz_id')
                                        ->select('quizzes.*', 'lmsseries_exams.exam_type')
                                        ->where('lmsseries_exams.lmsseries_id','=',$item->id)
                                        ->where('lmsseries_exams.exam_type','=','Final')
                                        ->where('quizzes.title','like','%Final%')
                                        ->first();

                                    ?>
                                    <div class="nav nav-tabs new__tbsAdmin" id="nav-tab" role="tablist">
                                        <a class="nav-item nav-link active text-center" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">{{ getPhrase('Overview') }}</a>
                                        @if(!$quizzes)
                                        <a class="nav-item nav-link  text-center" id="nav-assign-tab" data-toggle="tab" href="#nav-assign" role="tab" aria-controls="nav-assign" aria-selected="false">{{ getPhrase('Assignments') }}</a>
                                        @endif
                                            {{--<a class="nav-item nav-link text-center" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">{{ getPhrase('CourseContent') }}</a>--}}
                                        <a class="nav-item nav-link text-center" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">{{ getPhrase('Discussions') }}</a>
                                        <a class="nav-item nav-link text-center" id="nav-announcement-tab" data-toggle="tab" href="#nav-announcement" role="tab" aria-controls="nav-announcement" aria-selected="false">{{ getPhrase('Announcements') }}</a>
                                        <a class="nav-item nav-link text-center" id="nav-certificate-tab" data-toggle="tab" href="#nav-certificate" role="tab" aria-controls="nav-certificate" aria-selected="false">{{ getPhrase('Certificate') }}</a>
                                        {{--<a class="nav-item nav-link text-center" id="nav-quiz-tab" data-toggle="tab" href="#nav-quiz" role="tab" aria-controls="nav-quiz" aria-selected="false">{{ getPhrase('Quiz') }}</a>--}}

                                        {{--@if($gsetting->assignment_enable == 1)
                                            <a class="nav-item nav-link text-center" id="nav-assign-tab" data-toggle="tab" href="#nav-assign" role="tab" aria-controls="nav-assign" aria-selected="false">{{ getPhrase('Assignment') }}</a>
                                        @endif

                                        @if($gsetting->appointment_enable == 1)
                                            <a class="nav-item nav-link text-center" id="nav-appoint-tab" data-toggle="tab" href="#nav-appoint" role="tab" aria-controls="nav-appoint" aria-selected="false">{{ getPhrase('Appointment') }}</a>
                                        @endif--}}
                                    </div>
                                </nav>
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade" id="nav-assign" role="tabpanel" aria-labelledby="nav-assign-tab">
                                        <div class="">
                                            <div class="assignment-main-block">

                                                <div class="row">

                                                    <div class="col-md-8">
                                                        <h3>{{ getPhrase('Your Assignments') }}</h3>
                                                        <div class="row">
                                                            <?php // dd($assignment) ?>
                                                            @foreach($assignment as $assign)
                                                                <div class="col-md-12">
                                                                    <div class="assignment-tab-block">
                                                                        <div class="categories-block assign-tab-one text-center">

                                                                            <table>
                                                                                <td>
                                                                                    <div class="row">

                                                                                        <div class="col-md-9">
                                                                                            @if($assign->type == 1)
                                                                                                <a href="" data-toggle="tooltip" data-placement="top" title="{{ $assign->rating }}/10 scores"><i class="far fa-check-circle" title="approved"></i></a>
                                                                                            @else
                                                                                                <i class="far fa-times-circle" title="pending"></i>
                                                                                            @endif
                                                                                            <span>{{ getPhrase('Title') }}:{{ $assign->title }}</span>
                                                                                        </div>
                                                                                        <div class="col-md-3">
                                                                                            <div class="assignment-delete-block text-right">
                                                                                                <?php $settings = getSettings('lms'); ?>
                                                                                                <a href="{{ asset($settings->seriesAssignmentpath.$assign->assignment) }}" target="_blank" download="{{$assign->assignment}}" title="Download"> <i class="fa fa-download"></i></a>


                                                                                                <form  method="post" id="deleteAssignmentForm" action="{{url('assignment/delete/'.$assign->id)}}" ata-parsley-validate class="form-horizontal form-label-left">
                                                                                                    {{ csrf_field() }}

                                                                                                    <button  type="submit" class="assign-remove-btn display-inline"  onclick="archiveFunction()" title="Delete"> <i class="fas fa-trash-alt"></i></button>
                                                                                                </form>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>



                                                                                </td>


                                                                            </table>

                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            @endforeach
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">

                                                        <div class="contact-search-block btm-40">

                                                            <div class="udemy-contact-btn text-center">
                                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#assignmodel">{{ getPhrase('Submit Assignment') }}
                                                                </button>
                                                            </div>

                                                            @php
                                                                $user = Auth::user();
                                                            @endphp

                                                            <div class="modal fade" id="assignmodel" role="dialog" aria-labelledby="myModalLabel">
                                                                <div class="modal-dialog modal-sm" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title" id="myModalLabel">{{ getPhrase('Submit Assignment') }}</h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                        </div>
                                                                        <div class="box box-primary">
                                                                            <div class="panel panel-sum">
                                                                                <div class="modal-body">
                                                                                    <form id="demo-form2" method="post" action="{{ route('assignment.submit', $item->id) }}" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
                                                                                        {{ csrf_field() }}

                                                                                        <input type="hidden" name="user_id"  value="{{ Auth::user()->id }}" />

                                                                                        <input type="hidden" name="instructor_id"  value="{{ $item->record_updated_by }}" />

                                                                                        <div class="text-left">
                                                                                            <div class="">
                                                                                                <div class="col-md-12">
                                                                                                    <div class="form-group">
                                                                                                        <label for="exampleInputDetails">{{ getPhrase('Section Name') }}:<sup class="redstar">*</sup></label>
                                                                                                        <select style="width: 100%" name="course_chapters" class="form-control js-example-basic-single" required>
                                                                                                            @foreach($lms_sections as $c)
                                                                                                                <option value="{{ $c->id }}">{{ $c->section_name }}</option>
                                                                                                            @endforeach
                                                                                                        </select>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-md-12">
                                                                                                    <div class="form-group">
                                                                                                        <label for="title">{{ getPhrase('Title') }}:<sup class="redstar">*</sup></label>
                                                                                                        <input type="text" class="form-control" name="title" id="title" placeholder="Please Enter Title" value="" required>
                                                                                                    </div>
                                                                                                </div>

                                                                                                <div class="col-md-6">
                                                                                                    <div class="form-group">
                                                                                                        <label for="title">{{ getPhrase('First Name') }}:</label>
                                                                                                        <input type="text" class="form-control" name="fname" id="title" placeholder="Please Enter First Name" value="{{$user->first_name}}" required>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-md-6">
                                                                                                    <div class="form-group">
                                                                                                        <label for="title">{{ getPhrase('Last Name') }}:</label>
                                                                                                        <input type="text" class="form-control" name="lname" id="title" placeholder="Please Enter Last Name" value="{{$user->last_name}}" required>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-md-6">
                                                                                                    <div class="form-group">
                                                                                                        <label for="title">{{ getPhrase('Email') }}:</label>
                                                                                                        <input type="text" class="form-control" name="email" id="email" placeholder="Please Enter Email" value="{{$user->email}}" required>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-md-6">
                                                                                                    <div class="form-group">
                                                                                                        <label for="title">{{ getPhrase('Address') }}:</label>
                                                                                                        <input type="text" class="form-control" name="address" id="address" placeholder="Please Enter Address" value="{{$user->address}}" required>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-md-12">
                                                                                                    <div class="form-group">

                                                                                                        <div class="wrapper">
                                                                                                            <label for="detail">{{ getPhrase('Assignment Upload') }}:<sup class="redstar">*</sup></label>
                                                                                                            <div class="file-upload">
                                                                                                                <input type="file" name="assignment" class="form-control" />
                                                                                                                <i class="fa fa-arrow-up"></i>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>

                                                                                            </div>
                                                                                            <div class="form-group text-center">
                                                                                                <button type="submit" class="btn btn-lg btn-primary">{{ getPhrase('Submit') }}</button>
                                                                                            </div>

                                                                                        </div>

                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade  active in" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                        <div class="overview-block">
                                            <h4>{{ getPhrase('Recent Activity') }}</h4>
                                       <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="learning-questions-block btm-40">
                                                        <h5 class="learning-questions-heading">{{ getPhrase('Recent Questions') }}</h5>

                                                        @if($coursequestions->isEmpty())
                                                            <div class="learning-questions-content text-center">
                                                                <h4 class="text-center">{{ getPhrase('No') }} {{ getPhrase('Recent Questions') }}</h4>
                                                            </div>
                                                        @else
                                                            @php
                                                                $questions = App\Question::where('course_id', $item->id)->orderBy('created_at','desc')->limit(2)->get();
                                                            @endphp
                                                            @foreach($questions as $question)
                                                                <div class="learning-questions-dtl-block  ">
                                                                    <div class="profile-img  rgt-10 float-left" style="float: left"> <img src="{{ getProfilePath(Auth::user()->image, 'thumb') }}" width="35" alt="{{ $question->user->first_name[0] ?? "" }}{{ $question->user->last_name[0] ?? "" }}"> </div>

                                                                    {{--<div class="learning-questions-img rgt-20">{{ $question->user->first_name[0] }}{{ $question->user->last_name[0] }}</div>--}}
                                                                    <div class="learning-questions-dtl"><a href="#" title="questions">{{ $question->question }}</a>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        @endif
                                                        <div class="learning-questions-heading"><a href="#" id="goTab2" title="browse">{{ getPhrase('Browse Discussions') }}</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="learning-questions-block btm-40">
                                                        <h5 class="learning-questions-heading">{{ getPhrase('Recent Announcements') }}</h5>
                                                        @if($announsments->isEmpty())
                                                            <div class="learning-questions-content text-center">
                                                                <h4 class="text-center">{{ getPhrase('No') }} {{ getPhrase('Recent Announcements') }}</h4>
                                                            </div>
                                                        @else
                                                            <div id="accordion" class="second-accordion">
                                                                @foreach($announsments->take(2) as $announsment)
                                                                    <div class="card">
                                                                        <div class="card-header" id="headingFour{{ $announsment->id }}">
                                                                            <div class="mb-0">
                                                                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseFour{{ $announsment->id }}" aria-expanded="true" aria-controls="collapseFour">
                                                                                   {{--<div class="learning-questions-img rgt-20">{{ $announsment->user->first_name[0] }} {{ $announsment->user->last_name[0] }}
                                                                                    </div>--}}
                                                                                    <div class="row">
                                                                                        <div class="col-lg-1">
                                                                                        <div class="profile-img   rgt-10 float-left"> <img src="{{ getProfilePath(Auth::user()->image, 'thumb') }}" width="35" alt="{{ $announsment->user->first_name[0] }}{{ $announsment->user->last_name[0]  }}"> </div>
                                                                                        </div>
                                                                                        <div class="col-lg-6">
                                                                                            <div class="section"><a href="#" title="questions">{{ $announsment->user->name }}</a> <a href="#" title="questions">{{ date('jS F Y', strtotime($announsment->created_at)) }}</a></div>
                                                                                        </div>
                                                                                        <div class="col-lg-6">
                                                                                            <div class="section-dividation text-right">

                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                        <div class="col-lg-1 col-1 offset-sm-0"></div>
                                                                                        <div class="col-lg-11 offset-3 col-9 offset-sm-0">
                                                                                            <div class="profile-heading">{{ getPhrase('Announcements') }}</div>
                                                                                        </div>

                                                                                    </div>
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                        <div id="collapseFour{{ $announsment->id }}" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">

                                                                            <div class="card-body">
                                                                                <p class="announsment-text">{{ $announsment->announsment }}</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        @endif
                                                        <div class="learning-questions-heading"><a id="goTab4" href="" title="browse">{{ getPhrase('Browse announcements') }}</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="content-course-block">
                                                <h4 class="content-course">{{ getPhrase('About this course') }}</h4>
                                                <?php
                                                //$newdesc=substr($item->description,0,strrpos($item->description,'<p style="text-align: justify;">'));
                                                ?>
                                                <p class="btm-40"> {!! $item->description!!}</p>
                                            </div>
                                            <hr>
                                            {{--<div class="content-course-number-block">
                                                <div class="row">
                                                    <div class="col-lg-3 col-sm-4">
                                                        <div class="content-course-number">{{ getPhrase('Bythenumbers') }}</div>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-5">
                                                        <div class="content-course-number">
                                                            <ul>
                                                                <li>{{ getPhrase('studentsenrolled') }}:
                                                                    @php
                                                                        $data = App\Order::where('course_id', $course->id)->get();
                                                                        if(count($data)>0){

                                                                            echo count($data);
                                                                        }
                                                                        else{

                                                                            echo "0";
                                                                        }
                                                                    @endphp
                                                                </li>
                                                                @if($course->language_id == !NULL)
                                                                    <li>{{ getPhrase('Languages') }}: {{ $course->language->name }}</li>
                                                                @endif
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-sm-3">
                                                        <div class="content-course-number">
                                                            <ul>
                                                                <li>{{ getPhrase('Classes') }}:
                                                                    @php
                                                                        $data = App\CourseClass::where('course_id', $course->id)->get();
                                                                        if(count($data)>0){

                                                                            echo count($data);
                                                                        }
                                                                        else{

                                                                            echo "0";
                                                                        }
                                                                    @endphp
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <div class="content-course-number">{{ getPhrase('Description') }}</div>
                                                    </div>
                                                    <div class="col-lg-9">
                                                        <div class="content-course-number content-course-one">
                                                            <h5 class="content-course-number-heading">{{ getPhrase('Aboutthiscourse') }}</h5>
                                                            <p>{{ $course->short_detail }}<p>
                                                            <h5 class="content-course-number-heading">{{ getPhrase('Description') }}</h5>
                                                            <p>{!! $course->detail !!}<p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-lg-3 col-sm-3">
                                                        <div class="content-course-number">{{ getPhrase('Instructor') }}</div>
                                                    </div>
                                                    <div class="col-lg-9 col-sm-9">
                                                        <div class="content-course-number content-course-number-one">
                                                            <div class="content-img-block btm-20">
                                                                <div class="content-img">


                                                                    @if($course->user->user_img != null || $course->user->user_img !='')
                                                                        <a href="{{ route('instructor.profile', $course->user->id) }}" title="profile"><img src="{{ asset('images/user_img/'.$course->user->user_img) }}" class="img-fluid"  alt="instructor" ></a>
                                                                    @else
                                                                        <a href="{{ route('instructor.profile', $course->user->id) }}" title="profile"><img src="{{ asset('images/default/user.jpg')}}" class="img-fluid" alt="instructor"></a>
                                                                    @endif
                                                                </div>
                                                                <div class="content-img-dtl">
                                                                    <div class="profile"><a href="{{ route('instructor.profile', $course->user->id) }}" title="profile">{{ $course->user->first_name }}
                                                                        </a></div>
                                                                    <p>{{ $course->user->email }}</p>
                                                                </div>
                                                            </div>
                                                            <ul>
                                                                @if($course->user->twitter_url != NULL)
                                                                    <li class="rgt-10"><a href="{{ $course->user['twitter_url'] }}" target="_blank" title="twitter"><i class="fab fa-twitter"></i></a></li>
                                                                @endif
                                                                @if($course->user->fb_url != NULL)
                                                                    <li class="rgt-10"><a href="{{ $course->user['fb_url'] }}" target="_blank" title="facebook"><i class="fa fa-facebook"></i></a></li>
                                                                @endif
                                                                @if($course->user->linkedin_url != NULL)
                                                                    <li class="rgt-10"><a href="{{ $course->user['linkedin_url'] }}" target="_blank" title="linkedin"><i class="fa fa-linkedin"></i></a></li>
                                                                @endif
                                                                @if($course->user->youtube_url != NULL)
                                                                    <li class="rgt-10"><a href="{{ $course->user['youtube_url'] }}" target="_blank" title="twitter"><i class="fa fa-youtube"></i></a></li>
                                                                @endif

                                                            </ul>
                                                            <p>{!! $course->user->detail !!}<p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>--}}
                                        </div>
                                    </div>
                                     <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                                        <div class="learning-contact-block">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="contact-search-block btm-40">
                                                        <div class="learning-contact-search">
                                                            @if($coursequestions->isEmpty())
                                                                <h4 class="question-text">{{ getPhrase('No') }} {{ getPhrase('Recent Questions') }}</h4>
                                                            @else
                                                                <h4 class="question-text">
                                                                    @php
                                                                        $quess = App\Question::where('course_id', $item->id)->get();
                                                                        if(count($quess)>0){

                                                                            echo count($quess);
                                                                        }
                                                                        else{

                                                                            echo "0";
                                                                        }
                                                                    @endphp
                                                                    {{ getPhrase('questions in this course') }}</h4>
                                                            @endif

                                                        </div>
                                                        <div class="learning-contact-btn">
                                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">{{ getPhrase('Ask a new question') }}
                                                            </button>

                                                            <!--Model start-->
                                                            <div id="myModal" class="modal fade" role="dialog">
                                                                <div class="modal-dialog">

                                                                    <!-- Modal content-->
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title">{{ getPhrase('Ask a new question') }}</h4>
                                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                        </div>

                                                                        <div class="modal-body">

                                                                            <form id="demo-form2" method="post" action="{{ url('addquestion', $item->id) }}"
                                                                                  data-parsley-validate class="form-horizontal form-label-left">
                                                                                {{ csrf_field() }}

                                                                                        <input type="hidden" name="instructor_id" class="form-control" value="{{$item->user_id}}"  />
                                                                                        <input type="hidden" name="user_id"  value="{{Auth::user()->id}}" />

                                                                                        <input type="hidden" name="course_id"  value="{{$item->id}}" />
                                                                                        <input type="hidden" name="status"  value="0" />


                                                                                    <div class=" col-md-12">
                                                                                        <div class="form-group col-md-12">
                                                                                        <label for="detail">{{ getPhrase('Question') }}:<sup class="redstar">*</sup></label>
                                                                                        <textarea name="question" rows="4"  class="form-control" placeholder=""></textarea>
                                                                                    </div>
                                                                                    </div>

                                                                                <div class="col-md-12 mt-15">

                                                                                    <button type="submit" class="btn btn-lg col-md-3 btn-primary mt-15">{{ getPhrase('Submit') }}</button>

                                                                                </div>
                                                                            </form>
                                                                        </div>


                                                                    </div>

                                                                </div>
                                                            </div>
                                                            <!--Model end-->
                                                        </div>
                                                    </div>

                                                     <div id="accordion" class="second-accordion">
                                                        @php
                                                            $course=$item;
                                                                $questions = App\Question::where('course_id', $course->id)->get();
                                                        @endphp
                                                        @foreach($questions as $ques)
                                                            @if($ques->status == 1)
                                                                @php
                                                                    // dd($ques->user->first_name[0]);
                                                                @endphp
                                                                <div class="card btm-10">
                                                                    <div class="card-header" id="headingThree{{ $ques->id }}">
                                                                        <div class="mb-0">
                                                                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseThree{{ $ques->id }}" aria-expanded="true" aria-controls="collapseThree">
                                                                               {{-- <div class="learning-questions-img rgt-10">{{ $ques->user->first_name[0] }}{{ $ques->user->last_name[0]  }}
                                                                                </div>--}}
                                                                                <div class="row no-gutters">
                                                                                    <div class="col-lg-1 col-1 text-center">
                                                                                        <div class="profile-img  float-left  rgt-10"> <img src="{{ getProfilePath(Auth::user()->image, 'thumb') }}" width="35" alt="{{ $ques->user->first_name[0] }}{{ $ques->user->last_name[0]  }}"> </div>

                                                                                    </div>
                                                                                    <div class="col-lg-5 col-7">

                                                                                        <div class="section">
                                                                                            <a href="#" title="questions">{{ $ques->user->first_name }} </a>
                                                                                            <a href="#" title="questions">{{ date('jS F Y', strtotime($ques->created_at)) }}</a>
                                                                                            <div class="author-tag">
                                                                                                {{ ($ques->user->role_id==5)?'Learner':'Admin'}}

                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="col-lg-5 col-3">
                                                                                        <div class="section-dividation text-right">
                                                                                            @php
                                                                                                $answer = App\Answer::where('question_id', $ques->id)->get();
                                                                                                if(count($answer)>0){

                                                                                                    echo count($answer);
                                                                                                }
                                                                                                else{

                                                                                                    echo "0";
                                                                                                }
                                                                                            @endphp
                                                                                            {{ getPhrase('Reply') }}
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-1 col-1">
                                                                                        <div class="question-report text-right">
                                                                                            <a href="#" data-toggle="modal" data-target="#myModalquesReport{{ $ques->id }}" title="response"><i class="fa fa-flag" aria-hidden="true"></i></a>
                                                                                        </div>

                                                                                    </div>

                                                                                </div>
                                                                                <div class="row no-gutters">
                                                                                    <div class="col-lg-1 col-1"></div>
                                                                                    <div class="col-lg-7 col-7">
                                                                                        <div class="profile-heading profile-heading-two">{{ $ques->question }}
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-3 col-3">
                                                                                        <div class="profile-heading text-right"><a href="#" data-toggle="modal" data-target="#myModalanswer{{ $ques->id }}" title="response">{{ getPhrase('Reply') }}</a>
                                                                                        </div>
                                                                                    </div>


                                                                                </div>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                    <!--Model start-->
                                                                    <div class="modal fade" id="myModalanswer{{ $ques->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                                        <div class="modal-dialog modal-lg" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">

                                                                                    <h4 class="modal-title" id="myModalLabel">{{ getPhrase('Reply') }}</h4>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                                </div>
                                                                                <div class="box box-primary">
                                                                                    <div class="panel panel-sum">
                                                                                        <div class="modal-body">

                                                                                            <form id="demo-form2" method="post" action="{{ url('addanswer', $ques->id) }}"
                                                                                                  data-parsley-validate class="form-horizontal form-label-left">
                                                                                                {{ csrf_field() }}

                                                                                                <input type="hidden" name="question_id"  value="{{$ques->id}}" />
                                                                                                <input type="hidden" name="instructor_id"  value="{{$course->user_id}}" />
                                                                                                <input type="hidden" name="ans_user_id"  value="{{Auth::user()->id}}" />
                                                                                                <input type="hidden" name="ques_user_id"  value="{{$ques->user_id}}" />
                                                                                                <input type="hidden" name="course_id"  value="{{$ques->course_id}}" />
                                                                                                <input type="hidden" name="question_id"  value="{{$ques->id}}" />
                                                                                                <input type="hidden" name="status"  value="1" />

                                                                                                <div class="row">
                                                                                                    <div class="col-md-12">
                                                                                                        {{ $ques->question }}

                                                                                                    </div>
                                                                                                    <div class="col-md-12">
                                                                                                        <div class="form-group col-md-12">
                                                                                                        <label for="detail">{{ getPhrase('Reply') }}:<sup class="redstar">*</sup></label>
                                                                                                            <textarea name="answer" rows="4"  class="form-control" placeholder=""></textarea>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>

                                                                                                <div class="box-footer">
                                                                                                    <button type="submit" class="btn btn-lg col-md-3 btn-primary">{{ getPhrase('Submit') }}</button>
                                                                                                </div>
                                                                                            </form>

                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!--Model close -->

                                                                    <!--Model start Question Report-->

                                                                    <div class="modal fade" id="myModalquesReport{{ $ques->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                                        <div class="modal-dialog modal-lg" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">

                                                                                    <h4 class="modal-title" id="myModalLabel">{{ getPhrase('Report') }} Question</h4>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                                </div>
                                                                                <div class="box box-primary">
                                                                                    <div class="panel panel-sum">
                                                                                        <div class="modal-body">

                                                                                            <form id="demo-form2" method="post" action="{{ route('question.report', $ques->id) }}"
                                                                                                  data-parsley-validate class="form-horizontal form-label-left">
                                                                                                {{ csrf_field() }}

                                                                                                <input type="hidden" name="course_id"  value="{{ $course->id }}" />

                                                                                                <input type="hidden" name="question_id"  value="{{ $ques->id }}" />


                                                                                                    <div class="col-md-6">
                                                                                                        <div class="form-group">
                                                                                                            <label for="title">{{ getPhrase('Title') }}:<sup class="redstar">*</sup></label>
                                                                                                            <input type="text" class="form-control" name="title" id="title" placeholder="Please Enter Title" value="" required>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="col-md-6">
                                                                                                        <div class="form-group">
                                                                                                            <label for="email">{{ getPhrase('Email') }}:<sup class="redstar">*</sup></label>
                                                                                                            <input type="email" class="form-control" name="email" id="title" placeholder="Please Enter Email" value="{{ Auth::user()->email }}" required>
                                                                                                        </div>
                                                                                                    </div>

                                                                                                    <div class="col-md-12">
                                                                                                        <div class="form-group">
                                                                                                            <label for="detail">{{ getPhrase('Detail') }}:<sup class="redstar">*</sup></label>
                                                                                                            <textarea name="detail" rows="4"  class="form-control" placeholder="Enter Detail" required></textarea>
                                                                                                        </div>
                                                                                                    </div>

                                                                                                <div class="col-md-12">
                                                                                                    <div class="form-group">
                                                                                                    <button type="submit" class="btn btn-lg col-md-3 btn-primary">{{ getPhrase('Submit') }}</button>
                                                                                                    </div>
                                                                                                    </div>
                                                                                            </form>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <!--Model close -->


                                                                    <div id="collapseThree{{ $ques->id }}" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                                                        @php
                                                                            $answers = App\Answer::where('question_id', $ques->id)->get();
                                                                        @endphp
                                                                        @foreach($answers as $ans)
                                                                            @if($ans->status == 1)
                                                                                @php
                                                                                  $fname=$ans->user->first_name;
                                                                                  $lname=$ans->user->last_name;


                                                                                @endphp
                                                                                <div class="card-body">
                                                                                    <div class="answer-block">
                                                                                        <div class="row no-gutters">
                                                                                            <div class="col-lg-1 col-2 text-right">
                                                                                                <div class="profile-img   rgt-10"> <img src="{{ getProfilePath(Auth::user()->image, 'thumb') }}" width="35" alt="{{ $fname[0] }}{{ $lname[0]  }}"> </div>

                                                                                                {{--<div class="learning-questions-img-two">
                                                                                                </div>--}}
                                                                                            </div>
                                                                                            <div class="col-lg-11 col-10">

                                                                                                <div class="section">
                                                                                                    <a href="#" title="questions">{{ $ans->user->first_name }}</a> <a href="#" title="questions">{{ date('jS F Y', strtotime($ans->created_at)) }}</a>
                                                                                                    <div class="author-tag">
                                                                                                        {{ ($ans->user->role_id==5)?'Learner':'Admin'}}
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="section-answer">
                                                                                                    <a href="#" title="Course">{{ $ans->answer }}</a>
                                                                                                </div>

                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            @endif
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="nav-announcement" role="tabpanel" aria-labelledby="nav-announcement-tab">
                                        @if($announsments->isEmpty())
                                            <div class="learning-announcement-null text-center">
                                                <div class="col-md-12">
                                                    <h1>{{ getPhrase('No announcements') }}</h1>
                                                    <p>{{ getPhrase('No announcements detail') }}</p>
                                                </div>
                                            </div>
                                        @else
                                            <div class="learning-announcement text-center">
                                                <div class="col-lg-12">
                                                    <div id="accordion" class="second-accordion">

                                                        @foreach($announsments as $announsment)
                                                            @if($announsment->status == 1)
                                                                <div class="card btm-30">
                                                                    <div class="card-header" id="headingFive{{ $announsment->id }}">
                                                                        <div class="mb-0">
                                                                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseFive{{ $announsment->id }}" aria-expanded="true" aria-controls="collapseFive">
                                                                               {{-- <div class="learning-questions-img rgt-20">
                                                                                </div>--}}

                                                                                <div class="row">
                                                                                    <div class="col-lg-1 text-center">
                                                                                        <div class="profile-img   rgt-10"> <img src="{{ getProfilePath(Auth::user()->image, 'thumb') }}" width="35" alt="{{ $announsment->user->first_name[0] }}{{ $announsment->user->last_name[0]  }}"> </div>

                                                                                    </div>
                                                                                    <div class="col-lg-6">
                                                                                        <div class="section"><a href="#" title="questions">{{ $announsment->user->name }}</a> <a href="#" title="questions">{{ date('jS F Y', strtotime($announsment->created_at)) }}</a></div>
                                                                                    </div>
                                                                                    <div class="col-lg-5">
                                                                                        <div class="section-dividation text-right">

                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-lg-1 col-md-1"></div>
                                                                                    <div class="col-lg-11 offset-3 col-9 offset-sm-0 col-sm-11 offset-md-0 col-md-11">
                                                                                        <div class="profile-heading profile-heading-one">
                                                                                            {{ getPhrase('Announcements') }}
                                                                                        </div>
                                                                                    </div>

                                                                                </div>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                    <div id="collapseFive{{ $announsment->id }}" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
                                                                        <div class="card-body">
                                                                            <p>{{ $announsment->announsment }}</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="tab-pane fade" id="nav-appoint" role="tabpanel" aria-labelledby="nav-appoint-tab">
                                        <div class="container">
                                            <div class="appointment-main-block">
                                                <h3>{{ getPhrase('Your Appointment') }}</h3>
                                                <div class="row">

                                                    <div class="col-md-8">
                                                     {{--   @foreach($appointment as $appoint)
                                                            <div class="col-md-12">
                                                                <div class="assignment-tab-block">
                                                                    <div class="categories-block assign-tab-one text-center">
                                                                        <ul>
                                                                            <li class="btm-5"><span>{{ $appoint->title }}</span></li>
                                                                            <li class="btm-5"><span>{!! $appoint->detail !!}</span></li>
                                                                            <li>

                                                                                <form  method="post" action="{{url('appointment/delete/'.$appoint->id)}}" ata-parsley-validate class="form-horizontal form-label-left">
                                                                                    {{ csrf_field() }}

                                                                                    <button  type="submit" class="cart-remove-btn display-inline" title="Remove From cart"> {{ getPhrase('Delete') }}</button>
                                                                                </form>

                                                                            </li>
                                                                            @if($appoint->accept == 1)
                                                                                <li><a href="" data-toggle="modal" data-target="#myModalresponse" title="response">Response</a></li>

                                                                                <div class="modal fade" id="myModalresponse" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                                                    <div class="modal-dialog modal-lg" role="document">
                                                                                        <div class="modal-content">
                                                                                            <div class="modal-header">

                                                                                                <h4 class="modal-title" id="myModalLabel">{{ getPhrase('Response') }}</h4>
                                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                                            </div>
                                                                                            <div class="box box-primary">
                                                                                                <div class="panel panel-sum">
                                                                                                    <div class="modal-body">
                                                                                                        <div class="instructor-detail">
                                                                                                            <ul>
                                                                                                                <li>

                                                                                                                    <div class="instructor-img btm-30">
                                                                                                                        @if($appoint->user->user_img != null || $appoint->user->user_img !='')
                                                                                                                            <a href="{{ route('instructor.profile', $item->user->id) }}" title="instructor"><img src="{{ asset('images/user_img/'.$appoint->instructor->user_img) }}" width="100px" height="100px" class="img-fluid img-circle"/></a>
                                                                                                                        @else

                                                                                                                            <a href="{{ route('instructor.profile', $item->user->id) }}" title="instructor"><img src="{{ asset('images/default/user.jpg')}}" width="100px" height="100px" class="img-fluid img-circle"/></a>
                                                                                                                        @endif
                                                                                                                    </div>
                                                                                                                </li>
                                                                                                                <li>
                                                                                                                    {{ getPhrase('Instructor') }}: {{ $appoint->instructor->first_name }} {{ $appoint->instructor->last_name }}
                                                                                                                </li>
                                                                                                                <li>
                                                                                                                    {{ getPhrase('Email') }}: {{ $appoint->instructor->email }}
                                                                                                                </li>
                                                                                                                <li>
                                                                                                                    {{ getPhrase('Response') }}: {!! $appoint->reply !!}
                                                                                                                </li>

                                                                                                            </ul>
                                                                                                        </div>

                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            @endif
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        @endforeach--}}
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="contact-search-block btm-40">
                                                            <div class="udemy-contact-btn text-center">
                                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#appointmodel">{{ getPhrase('RequestAppointment') }}
                                                                </button>
                                                            </div>
                                                            <div class="modal fade" id="appointmodel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                                <div class="modal-dialog modal-lg" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title" id="myModalLabel">{{ getPhrase('RequestAppointment') }}</h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                        </div>
                                                                        <div class="box box-primary">
                                                                            <div class="panel panel-sum">
                                                                                <div class="modal-body">
{{--                                                                                    <form id="demo-form2" method="post" action="{{ route('appointment.request', $course->id) }}" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">--}}
                                                                                        {{ csrf_field() }}

                                                                                        <input type="hidden" name="user_id"  value="{{ Auth::user()->id }}" />

                                                                                        <input type="hidden" name="instructor_id"  value="{{ $item->user_id }}" />


                                                                                        <div class="row">
                                                                                            <div class="col-md-6">
                                                                                                <div class="form-group">
                                                                                                    <label for="title">{{ getPhrase('User') }}:<sup class="redstar">*</sup></label>
                                                                                                    <input type="text" name="first_name" value="{{ Auth::user()->email }}" class="form-control" disabled />
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-6">
                                                                                                <div class="form-group">
                                                                                                    <label for="title">{{ getPhrase('Instructor') }}:<sup class="redstar">*</sup></label>
                                                                                                    {{--<input type="text" name="instructor" value="{{ $item->user->email }}" class="form-control" disabled/>--}}
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>



                                                                                        <div class="row">
                                                                                            <div class="col-md-6">
                                                                                                <div class="form-group">
                                                                                                    <label for="title">{{ getPhrase('Title') }}:<sup class="redstar">*</sup></label>
                                                                                                    <input type="text" class="form-control" name="title" id="title" placeholder="Please Enter Title" value="">
                                                                                                </div>
                                                                                            </div>

                                                                                            <div class="col-md-6">
                                                                                                <div class="form-group">
                                                                                                    <label for="title">{{ getPhrase('Date') }}:<sup class="redstar">*</sup></label>
                                                                                                    <input type="datetime-local" class="form-control" id="date_time" name="date_time" placeholder="Please Enter Title" value="">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="row">
                                                                                            <div class="col-md-12">
                                                                                                <div class="form-group">
                                                                                                    <label for="detail">{{ getPhrase('Title') }}:<sup class="redstar">*</sup></label>
                                                                                                    <textarea id="detail" name="detail" class="form-control" placeholder="Enter your details" value=""></textarea>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>

                                                                                        <hr>
                                                                                        <div class="box-footer">
                                                                                            <button type="submit" class="btn btn-sm btn-primary">{{ getPhrase('Submit') }}</button>
                                                                                        </div>
                                                                                    {{--</form>--}}
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="nav-certificate" role="tabpanel" aria-labelledby="nav-certificate-tab">
                                        @if($item->is_paid==0)
                                            <div class=" text-center container-fluid">
                                                <div class="col-md-12 pb-60 pt-60">
                                                    <div class="row">

                                                        {{--<p>Special Discounts and Benefits on Free Courses Certificates</p>--}}
                                                        <div class="text-center">
                                                            @if(\App\Payment::isCertificatePaid($item->id,'certificate-fee',auth()->id()))
{{--                                                             {{dd(\App\User::generateCertificate($item->id))}}--}}
                                                                @if($certificate!=null)
                                                                @if($certificate->certificate_file=='')

                                                                    <h4 class="pb-20">Get Your Printed Certificate Now</h4>
                                                                    <a  href="javascript:void(0)" onclick="generatepdf('{{$item->id}}',0)" class="btn btn-lg btn-primary generatebtn">View/Generate Certificate </a>
                                                                @else
                                                                    <h4 class="pb-20">Your certificate is already generated on {{$certificate->generated_date}} and will be received at your mailing address
                                                                        </h4>
                                                                    {{--<a href="javascript:void(0)" onclick="generatepdf('{{$item->id}}',0)" class=" btn btn-lg btn-success generatebtn">View Certificate </a>--}}
                                                                @endif
                                                                    @endif
                                                            @else
                                                                <h4 class="pb-20">Get Your Printed Certificate Now</h4>
                                                            <a href="{{url("certificate_fee/".$item->id)}}" class="btn btn-lg btn-primary">Proceed to Pay Now</a>
                                                                @endif
                                                            <div style="display: none;" id="genloader">
                                                                <img src="https://infinity-bucket-2020.s3.eu-west-2.amazonaws.com/images/ajax-loader.gif" width="50"> Generating Certificate ...
                                                            </div>
                                                            <div id="pdfgenerated"  style="display: none;"></div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        @else
                                            <div class="learning-announcement text-center">
                                                <div class="col-lg-12 pb-60">
                                                    <div class="row">
                                                        <h4>For Paid Courses you need to complete the exams for generating Course Certificate</h4>
<?php
                                                        $quizzes2 = DB::table('quizresults')
                                                            ->join('lmsseries_exams', 'quizresults.quiz_id', '=', 'lmsseries_exams.exam_quiz_id')
                                                            ->join('quizzes', 'quizresults.quiz_id', '=', 'quizzes.id')
                                                            ->select('quizresults.*', 'lmsseries_exams.exam_type','quizzes.title')
                                                            ->where('lmsseries_exams.lmsseries_id','=',$item->id)
                                                            ->where('quizresults.user_id','=',auth()->id())
                                                            ->where('lmsseries_exams.exam_type','=','Final')
                                                            ->where('quizzes.title','like','%Final%')
                                                            ->orderBy('quizresults.created_at', 'desc')
                                                            ->first();
                                                        $quizzes=$quizzes2;


//dd($quizzes);
//                                                        $quizzes = DB::table('quizresults')
//                                                            ->join('lmsseries_exams', 'quizresults.quiz_id', '=', 'lmsseries_exams.exam_quiz_id')
//                                                             ->select('quizresults.*', 'lmsseries_exams.exam_type')
//                                                            ->where('lmsseries_exams.lmsseries_id','=',$item->id)
//                                                            ->where('lmsseries_exams.exam_type','=','Final')
//                                                            ->first();
 //
                                                        ?>
                                                        @if($quizzes)
                                                    @if($quizzes->exam_status=="pass")
                                                            <div class="text-center">
                                                                <h3>Congratulations, You have passed the Final Exam </h3>
                                                                <h4 class="pb-20">Get Your Printed Certificate Now</h4>
                                                                <a href="{{url("certificate_fee/".$item->id)}}" class="btn btn-lg btn-success">Order Printed Certificate</a>
                                                                <a href="javascript:void(0)" onclick="generatepdf('{{$item->id}}','{{$quizzes->quiz_id}}')" class="btn btn-lg btn-primary generatebtn">View/Generate Certificate </a>
                                                            </div>
                                                        @elseif ($quizzes->exam_status=="fail")
                                                        <?php

                                                                   // dd($quizzes);

                                                                $quiz_record = DB::table('exam_retake_fee')
                                                                    ->select('*')
                                                                    ->where('quiz_id','=',$quizzes->quiz_id)
                                                                    ->where('user_id','=',$user->id)
                                                                    ->where('course_id','=',$item->id)
                                                                    ->where('attempt_status','=','no')
                                                                    ->first();

                                                                if($quiz_record){
                                                                        $retake_record = DB::table('quizzes')
                                                                            ->where('id','=',$quizzes->quiz_id)
                                                                            ->first();
                                                                            ?>
                                                                    <div class="text-center">
                                                                        <h3>You have paid the final exam retake fee, you can proceed to take final exam again.</h3>
                                                                        <a href="{{URL_STUDENT_TAKE_EXAM.$retake_record->slug}}" target="_blank" class="btn btn-lg btn-primary">Proceed to Take Final Exam</a>

                                                                    </div>
                                                                    <?php

                                                                }else{
                                                                    ?>
                                                                <div class="text-center">
                                                                    <h3>Unfortunately you are failed in your final exam, you can retake final exam by paying retake exams fee</h3>
                                                                    <a href="{{url("/retake_exam_fee/".$item->id."/".$quizzes->quiz_id)}}" class="btn btn-lg btn-primary">Proceed to Pay Now</a>

                                                                 </div>
                                                        <?php } ?>
                                                    @else
                                                                <h3>Make sure you passed the Final Exam before Generating the Certificate</h3>
                                                        @endif
                                                            @else
                                                            <h3>Make sure you passed the Final Exam before Generating the Certificate</h3>

                                                        @endif

                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>


                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- courses-content end -->





                @elseif($content_record->content_type == 'video' || $content_record->content_type == 'iframe' || $content_record->content_type == 'video_url')

                            @include('student.lms.series-video-player', array('series'=>$item, 'content' => $content_record))

                @elseif($content_record->content_type == 'audio' || $content_record->content_type == 'audio_url')

                    @include('student.lms.series-audio-player', array('series'=>$item, 'content' => $content_record))
                @elseif($content_record->content_type == 'file' )

                    @include('student.lms.series-pdf-view', array('series'=>$item, 'content' => $content_record))
                @elseif($content_record->content_type == 'url' )

                    @include('student.lms.series-url-view', array('series'=>$item, 'content' => $content_record))
                @endif
                    </div>
                    <div class="col-lg-3 col-md-4 bg-white">
                        @include('student.lms.series-items', array('series'=>$item, 'content'=>$content_record))
                    </div>
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div><!-- /#page-wrapper -->
<div class="modal fade" id="pdfviewer" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            <div class="modal-body">

            </div>
        </div>
    </div>
</div>
@stop
@section('footer_scripts')
    @toastr_js
    @toastr_render
    @include('student.lms.scripts.common-scripts')
    <script>


        function archiveFunction() {
            event.preventDefault(); // prevent form submit
            var form = event.target.form; // storing the form

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $("#deleteAssignmentForm").submit();
                    // Swal.fire(
                    //     'Deleted!',
                    //     'Your file has been deleted.',
                    //     'success'
                    // )
                }
            })


           /* swal({
                    title: "Are you sure?",
                    text: "But you will still be able to retrieve this file.",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, archive it!",
                    cancelButtonText: "No, cancel please!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm){
                    if (isConfirm) {
                        form.submit();          // submitting the form when user press yes
                    } else {
                        swal("Cancelled", "Your imaginary file is safe :)", "error");
                    }
                });*/
        }

        jQuery( document ).ready(function() {

            $('#fullscreen_toggle').click(function() {
                $('#course_area').css({
                    position: 'absolute',
                    top: 60,
                    width: $(window).width(),
                    height: $(window).height(),
                    left: 0,
                    zIndex: 9999,
                    'background-color':'white'
                });
            });


            $('.sendComment').click(function(e) {
                console.log("hello");
                var valid = this.form.checkValidity();
                if (valid){
                    e.preventDefault();
                    // $('#lesson_list_area').hide();
                    //$('#lesson_list_loader').show();


                    var loading = $(this).data("loading-text");
                    var course_id = $(this).data("course");
                    var section_id = $(this).data("section");
                    var content_id = $(this).data("content");
                    var course_title = $(this).data("title");
                    var course_slug = $(this).data("slug");
                    var message = $("#message_"+content_id).val();
                    console.log(content_id+"=="+section_id+"=="+course_id+"=="+message);

                    $.ajax({
                        beforeSend: function () {
                            $('#load').css("display", "block");
                            $(".sendComment").text(loading);
                            $('.sendComment').prop('disabled', true);
                            //$('.sendComment').css("display", "none");
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                        },
                        type: 'POST',
                        url: '{{url('my-courses/storeComment')}}',
                        data: {
                            course_id: course_id,
                            section_id: section_id,
                            content_id: content_id,
                            course_title: course_title,
                            course_slug: course_slug,
                            message: message
                        },
                        success: function (response) {
                            console.log(response);
                            if (response.success) {
                                $("#myModalRequest_"+content_id).modal("hide");
                                $("form").trigger("reset");
                                toastr["success"](response.message);

                            } else {

                            }
                        },
                        complete: function () {
                            // $('#load').css("display", "none");
                           // $('.sendComment').css("display", "block");
                            $(".sendComment").text('POST YOUR COMMENT');
                            $('.sendComment').prop('disabled', false);
                        }
                    });
                }
            });


        });

        var newProgress;
        var savedProgress;

      /*  function markThisLessonAsCompleted(content_id) {
           // $('#lesson_list_area').hide();
            //$('#lesson_list_loader').show();
            var progress;
            if ($('input#'+content_id).is(':checked')) {
                progress = 1;
            }else{
                progress = 0;
            }
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                },
                type : 'POST',
                url : '{{url('progress/save_course_progress')}}',
                data : {lesson_id : content_id, progress : progress},
                success : function(response){
                    if (response.success) {
                        toastr["success"](response.message);
                    }
                    //currentProgress = response;
                    //$('#lesson_list_area').show();
                    //$('#lesson_list_loader').hide();
                }
            });
        }
*/

        function markThisLessonAsCompleted(content_id,item_id) {
            // $('#lesson_list_area').hide();
            //$('#lesson_list_loader').show();
            var progress;
            if ($('input#'+content_id).is(':checked')) {
                progress = 1;
            }else{
                progress = 0;
            }
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                },
                type : 'POST',
                url : '<?php echo e(url('progress/save_course_progress'), false); ?>',
                data : {lesson_id : content_id, progress : progress,item_id:item_id},
                success : function(response){
                    if (response.success) {
                        toastr["success"](response.message);
                        $('.progress-bar').attr('aria-valuenow',response.progress_bar);
                        $('.progress-bar').css('width', +response.progress_bar+'%');
                        $('.completed small').html(Math.round(response.progress_bar)+'% Completed');
                    }
                    //currentProgress = response;
                    //$('#lesson_list_area').show();
                    //$('#lesson_list_loader').hide();
                }
            });
        }


        $(document).ready(function(){

            $('.nav-item').on("click", function(){

                $('.nav-item').removeClass('active');

                $(this).addClass('active');
            });



        });
    </script>


    <script>
        (function($) {
            "use strict";
            $("#goTab4").click(function(){
                $("#nav-tab a:nth-child(4)").click();
                return false;
            });

            $("#goTab3").click(function(){
                $("#nav-tab a:nth-child(3)").click();
                return false;
            });

            $("#goTab2").click(function(){
                $("#nav-tab a:nth-child(2)").click();
                return false;
            });


        })(jQuery);
    </script>
@if($content_record)
    @if($content_record->content_type == 'video' || $content_record->content_type == 'video_url')
        @include('common.video-scripts')
    @endif

@endif
@include('common.custom-message-alert')
@stop