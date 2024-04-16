 <?php $contents = $series->getContents();  
 $active_class = '';
 $section_id='';
 $active_class_id = 0;
 $content_image_path = IMAGE_PATH_UPLOAD_LMS_DEFAULT;
 if(isset($content) && $content)
 {
    if(isset($content->id)) 
        $active_class_id = $content->id;
    if($content->image)
    $content_image_path = IMAGE_PATH_UPLOAD_LMS_CONTENTS.$content->image;
  $lms_series_data=APP\LmsSeriesData::where('lmscontent_id', '=', $content->id)->first();
  $section_id=$lms_series_data->section_id;
 }



 ?>
 <style>

     input[type="radio"], input[type="checkbox"] {
         display: contents !important;
     }

 </style>

<div >
    <h4 class="mainTitle">Course content</h4>
    <ul class="nav nav-tabs" id="myTabs" role="tablist">
        <li role="presentation" class="active"><a href="#section_and_lessons" id="lessons-tab" role="tab" data-toggle="tab" aria-controls="Lessons" aria-expanded="true">Lessons</a></li>
    </ul>

    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade active in" role="tabpanel" id="section_and_lessons" aria-labelledby="lessons-tab">

            <div class="panel-group" id="accordion">
                <!-- First Panel -->
                <?php $counter = 0;
                $section_active='';

                ?>
                @foreach($lms_sections as $section)
                    <?php $counter++;
                    if($section_id == $section->id){

                        $section_active='';
                        $heading_panel='<div class="panel-title" data-toggle="collapse" aria-expanded="true"  id="heading_'.$section->id.'" data-target="#collapseOne'.$section->id.'">';
                        $content_panel='<div id="collapseOne'.$section->id.'" class="panel-collapse collapse in"  aria-expanded="true" >';
                    }else{
                        $heading_panel='<div class="panel-title collapsed" data-toggle="collapse" aria-expanded="false" id="heading_'.$section->id.'" data-target="#collapseOne'.$section->id.'">';
                        $content_panel='<div id="collapseOne'.$section->id.'" class="panel-collapse collapse" aria-expanded="false">';
                    }
                    ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            {!! $heading_panel !!}
                            {{--<div class="panel-title" data-toggle="collapse" data-target="#collapseOne{{$section->id}}">--}}
                                <h6>Section {{$counter}}</h6>
                                {{$section->section_name}}
                            </div>
                        </div>
                        {!! $content_panel !!}
                        {{--<div id="collapseOne{{$section->id}}" class="panel-collapse collapse">--}}
                            <div class="panel-body">
                                <ul class="lesson-list list-unstyled">
                                    @foreach($section->contents as $content)
                                        <?php

                                        $active_class = '';

                                        if($active_class_id == $content->id){
                                            $active_class = ' active ';
                                            $section_active='';
                                        }

                                        $url = '#';
                                        $type = 'File';

                                        $user = Auth::user();
                                        if($user->role_id == 6){

                                            $children_ids  = App\User::where('parent_id',$user->id)->pluck('id')->toArray();

                                            $is_paid  = [];
                                            foreach ($children_ids as $key => $value) {

                                                $is_paid[]  = App\Payment::isParentPurchased($item->id, 'lms', $value);
                                            }
                                            // dd($is_paid);
                                            $paid_staus  = in_array('notpurchased', $is_paid);

                                            $paid  = FALSE;
                                            if($paid_staus)
                                                $paid  = TRUE;

                                        }
                                        else{

                                            $paid = ($item->is_paid && !isItemPurchased($item->id, 'lms')) ? TRUE : FALSE;
                                        }




                                        if($content->file_path) {
                                            switch($content->content_type)
                                            {
                                                case 'file': $url = URL_STUDENT_LMS_SERIES_VIEW.$series->slug.'/'.$content->slug;
                                                    $type = 'File';
                                                    break;
                                                case 'image': $url = IMAGE_PATH_UPLOAD_LMS_CONTENTS.$content->slug;
                                                    $type = 'Image';

                                                case 'url':  $url = URL_STUDENT_LMS_SERIES_VIEW.$series->slug.'/'.$content->slug;
                                                    $type = 'URL';
                                                    break;
                                                case 'video_url':
                                                case 'video':
                                                case 'iframe':
                                                    $url = URL_STUDENT_LMS_SERIES_VIEW.$series->slug.'/'.$content->slug;
                                                    $type = 'Video';
                                                    break;
                                                case 'audio_url':
                                                case 'audio':
                                                    $url = URL_STUDENT_LMS_SERIES_VIEW.$series->slug.'/'.$content->slug;
                                                    $type = 'Audio';
                                                    break;
                                            }
                                        }


                                        ?>

                                        <?php if($paid) $url = '#'; ?>

                                            @php
                                                $completed_id = "";
                                                if(auth()->user()->watch_history!="" || auth()->user()->watch_history!=null){

                                                    $history =   \GuzzleHttp\json_decode(auth()->user()->watch_history);

                         foreach ($history as $his)
                             {
                              if($content->id  == $his->lesson_id ){
                         $completed_id ="yes";
                              }
                             }
                                                }
                                            @endphp
                                        <li class="list-item {{$active_class}}">
                                            <div class="form-group">
                                                <input type="checkbox" title="Check to mark as completed" @if($completed_id == "yes") checked disabled @endif id="{{$content->id}}"  onchange="markThisLessonAsCompleted(this.id,'{{$item->id}}');" value="1">
                                                <label for="{{$content->id}}"></label>
                                            </div>
                                            @if($content->content_type=='url')
                                                <a target="_blank" href="{{$url}}"
                                                   @if($paid)
                                                   onclick="showMessage('Please buy this package to continue');"
                                                        @endif
                                                >{{$content->title}}

                                                </a>
                                            @else
                                                <a href="{{$url}}"
                                                   @if($paid)
                                                   onclick="showMessage('Please buy this package to continue');"
                                                        @endif
                                                >{{$content->title}}

                                                </a>
                                            @endif
                                            <span class="pull-right d-none">
                                                <a data-toggle="modal" data-target="#myModalRequest_{{$content->id}}" title="Request Details" href="#" class="unit_message"><i class="fa fa-comments-o" aria-hidden="true"></i></a>
                                            </span>
                                            <div class="modal fade in " id="myModalRequest_{{$content->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                <div class="modal-dialog modal-lg" role="document">

                                                    <div class="modal-dialog">
                                                        <div class="modal-content">


                                                            <div class="modal-header">
                                                                <h4 class="modal-title" id="myModalRequestLabel" style="float: left;">Request more details</h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                            </div>

                                                            <div class="row" style="margin-bottom: 0px; padding: 10px; display: block;">
                                                                <div class="col-md-12">
                                                                    <h3 style="margin: 10px">Course:{{$lms_series->title}}</h3>
                                                                    <h4 style="margin: 10px">Section: {{$section->section_name}}</h4>
                                                                    <h5 style="margin: 10px">Unit/Content: {{$content->title}}</h5>
                                                                    {{--<div>Provided by The University of Law Business School</div>--}}
                                                                </div>

                                                            </div>

                                                            <div class="modal-body">

                                                                @include('student.lms.partials.comment_popup')
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <span class="buttons-right pull-right pr-10"><a href="{{$url}}">
                                                     @if($content->content_type=='video_url')<i class="fas fa-play-circle"></i>@endif
                                                    @if($content->content_type=='video')<i class="fas fa-play-circle"></i>@endif
                                                    @if($content->content_type=='file')<i class="far fa-file"></i>@endif
                                                    @if($content->content_type=='iframe')<i class="fas fa-play-circle"></i>@endif
                                                    @if($content->content_type=='url')<i class="fas fa-link"></i>@endif
                                                </a></span>
                                        </li>
                                        {{--<li class="list-item"><a href="#">{{$content->title}}</a> <span class="buttons-right pull-right"></span></li>--}}
                                    @endforeach


                                        @foreach($section->exams as $exam)

                                            @php


                                                $records = App\Quiz::join('quizresults', 'quizzes.id', '=', 'quizresults.quiz_id')
                                                          ->select(['title','is_paid' ,'dueration', 'quizzes.total_marks',  \DB::raw('count(quizresults.user_id) as attempts, quizzes.slug, user_id') ])
                                                          ->where('user_id', '=', $user->id)
                                                          ->where('quizresults.quiz_id', '=', $exam->id)
                                                          ->first();

                                            $attempts=$records->attempts;

                                            $exam_type=DB::table('lmsseries_exams')->select('exam_type','lmsseries_id')
                                            ->where('lmsseries_id', $item->id)
                                            ->where('exam_quiz_id', $exam->id)
                                            ->first();

                                            @endphp

                                            <?php  //$url = URL_STUDENT_TAKE_EXAM.$content->slug;
                                            if(strpos($exam->title, "Mock") !== false){
                                                $exam_actual_type='Mock';
                                            }else if(strpos($exam->title, "Final") !== false){
                                                $exam_actual_type='Final';
                                            }else{
                                                $exam_actual_type=$exam_type->exam_type;
                                            }

                                            if($exam_actual_type=='Final'){
                                                $allowed=1;
                                                if(CheckExtraAttempt('Final', $item->id) > 0) {
                                                    $allowed=$allowed+CheckExtraAttempt('Final', $item->id);
                                                }
                                            }else{
                                                $allowed=3;
                                                if(CheckExtraAttempt("Mock", $item->id) > 0) {
                                                    $allowed=$allowed+CheckExtraAttempt('Final', $item->id);
                                                }
                                            }
                                            if(\App\ExamRetakeFee::checkRetakeFee( $item->id,$exam->id,$user->id)){
//                                                if($exam_actual_type=='Final'){
//                                                    $allowed=$attempts+1;
//                                                    // $attempts=0;
//                                                }
                                            }
                                            ?>
                                            <li  class="list-item d-none {{$active_class}}"><a href="{{URL_FRONTEND_START_EXAM.$exam->slug}}"  >
                                                    {{--<span class="icon"><i class="fa fa-car"></i></span>--}}
                                                    <span class="icon"><?php echo $exam->id; ?>
                                                             {{--           @if($exam->image)
                                                            <img src="{{IMAGE_PATH_EXAMS.$exam->image}}" alt="{{$lms_series->title}}" class="img-responsive">
                                                        @else
                                                            <img src="{{IMAGE_PATH_EXAMS_DEFAULT}}" alt="{{$lms_series->title}}" class="img-responsive">
                                                        @endif--}}
                                                            </span>
                                                 <span class="textexam">  {{$exam->title}}</span></a>

                                            </li>

                                            <li>
                                                <a class="notifylearner"   data-allowed="{{$allowed}}"   data-attempts="{{$attempts}}" data-exam_type="{{$exam_actual_type }}"  data-retakeurl="{{url('/retake_exam_fee/'.$exam_type->lmsseries_id.'/'.$exam->id)}}" data-url="{{URL_STUDENT_TAKE_EXAM.$exam->slug}}" href="javascript:void(0);"  >
                                                    <span class="icon hide">
                                                                        @if($exam->image)
                                                            <img src="{{IMAGE_PATH_EXAMS.$exam->image}}" alt="{{$lms_series->title}}" class="img-responsive" width="25">
                                                        @else
                                                            <img src="{{IMAGE_PATH_EXAMS_DEFAULT}}" alt="{{$lms_series->title}}" class="img-responsive" width="25">
                                                        @endif
                                                            </span>
                                                    <span class="textexam">  {{$exam->title}} </span></a> Attempts: {{$attempts}}
                                                  <div class="clearfix"></div>


                                            </li>



                                        @endforeach
                                 </ul>
                            </div>
                        </div>
                    </div>
                @endforeach

        @if ($lms_series->exams()->count()>0)


            <div class="panel panel-default ">
                <div class="panel-heading">
                    <div class="panel-title" data-toggle="collapse"   id="heading_'.$section->id.'" data-target="#collapseOne_exams">
                        <span  >
                            Exams
                            {{--                                                            <span class="badge badge-primary badge-pill"> </span>--}}
                        </span>

                    </div>

                </div>
                <div id="collapseOne_exams"
                     class="panel-collapse collapse"  aria-expanded="false">
                    <div class="panel-body">
                        <ul class="links">
                            @foreach($lms_series->exams() as $exam)

                                @php


                                        $records = App\Quiz::join('quizresults', 'quizzes.id', '=', 'quizresults.quiz_id')
                                                  ->select(['title','is_paid' ,'dueration', 'quizzes.total_marks',  \DB::raw('count(quizresults.user_id) as attempts, quizzes.slug, user_id') ])
                                                  ->where('user_id', '=', $user->id)
                                                  ->where('quizresults.quiz_id', '=', $exam->id)
                                                  ->first();

                                    $attempts=$records->attempts;

                                    $exam_type=DB::table('lmsseries_exams')->select('exam_type','lmsseries_id')
                                    ->where('lmsseries_id', $item->id)
                                    ->where('exam_quiz_id', $exam->id)
                                    ->first();

                                     @endphp


                                <?php  //$url = URL_STUDENT_TAKE_EXAM.$content->slug;
                                if(strpos($exam->title, "Mock") !== false){
                                    $exam_actual_type='Mock';
                                }else if(strpos($exam->title, "Final") !== false){
                                     $exam_actual_type='Final';
                                }else{
                                    $exam_actual_type=$exam_type->exam_type;
                                }

                                if($exam_actual_type=='Final'){
                                    $allowed=1;
                                }else{
                                    $allowed=3;
                                }
                                if(\App\ExamRetakeFee::checkRetakeFee( $item->id,$exam->id,$user->id)){
                                   if($exam_actual_type=='Final'){
                                       $allowed=$attempts+1;
                                      // $attempts=0;
                                    } else {
                                       $attempts=0;
                                   }
                                }
                                ?>
                                <li>

                                    <a class="notifylearner imran" id="{{$exam_actual_type}}"   data-allowed="{{$allowed}}"   data-attempts="{{$attempts}}" data-exam_type="{{$exam_actual_type }}"  data-retakeurl="{{url('/retake_exam_fee/'.$exam_type->lmsseries_id.'/'.$exam->id)}}" data-url="{{URL_STUDENT_TAKE_EXAM.$exam->slug}}" href="javascript:void(0);"  >
                                        {{--<span class="icon"><i class="fa fa-car"></i></span>--}}
                                        <span class="icon hide">
                                                                        @if($exam->image)
                                                <img src="{{IMAGE_PATH_EXAMS.$exam->image}}" alt="{{$lms_series->title}}" class="img-responsive" width="25">
                                            @else
                                                <img src="{{IMAGE_PATH_EXAMS_DEFAULT}}" alt="{{$lms_series->title}}" class="img-responsive" width="25">
                                            @endif
                                                            </span>
                                        {{--<span class="text">{{$exam->exam_type}} - {{$exam->title}}</span></a>--}}


                                        <span class="textexam">  {{$exam->title}} </span></a> Attempts: {{$attempts}}
                                        {{--<a href="#"><span class="textexam"> {{$exam->exam_type}} Exam - {{$exam->title}}</span></a>--}}
{{--                                        <a href="#"><span class="textexam"> {{$exam->title}}</span></a>--}}


                                        <div class="clearfix"></div>


                                </li>

                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif
            </div>



        </div>
    </div>


    <ul class="lesson-list list-unstyled" style="display: none;">
         @foreach($contents as $content)
             <?php

             $active_class = '';
             if($active_class_id == $content->id)
                 $active_class = ' active ';

             $url = '#';
             $type = 'File';

             $user = Auth::user();
             if($user->role_id == 6){

                 $children_ids  = App\User::where('parent_id',$user->id)->pluck('id')->toArray();

                 $is_paid  = [];
                 foreach ($children_ids as $key => $value) {

                     $is_paid[]  = App\Payment::isParentPurchased($item->id, 'lms', $value);
                 }
                 // dd($is_paid);
                 $paid_staus  = in_array('notpurchased', $is_paid);

                 $paid  = FALSE;
                 if($paid_staus)
                     $paid  = TRUE;

             }
             else{

                 $paid = ($item->is_paid && !isItemPurchased($item->id, 'lms')) ? TRUE : FALSE;
             }




             if($content->file_path) {
                 switch($content->content_type)
                 {
//                     case 'file': $url = VALID_IS_PAID_TYPE.$series->slug.'/'.$content->slug;
//                         $type = 'File';
//                         break;
                     case 'file': $url = URL_STUDENT_LMS_SERIES_VIEW.$series->slug.'/'.$content->slug;
                         $type = 'File';
                         break;
                     case 'image': $url = IMAGE_PATH_UPLOAD_LMS_CONTENTS.$content->slug;
                         $type = 'Image';

                     case 'url': $url = $content->file_path;
                         $type = 'URL';
                         break;
                     case 'video_url':
                     case 'video':
                     case 'iframe':
                         $url = URL_STUDENT_LMS_SERIES_VIEW.$series->slug.'/'.$content->slug;
                         $type = 'Video';
                         break;
                     case 'audio_url':
                     case 'audio':
                         $url = URL_STUDENT_LMS_SERIES_VIEW.$series->slug.'/'.$content->slug;
                         $type = 'Audio';
                         break;
                 }
             }


             ?>

             <?php if($paid) $url = '#'; ?>
             <li class="list-item {{$active_class}}">
                 @if($content->content_type=='url')
                     <a target="_blank" href="{{$url}}"
                        @if($paid)
                        onclick="showMessage('Please buy this package to continue');"
                             @endif
                     >{{$content->title}}

                     </a>
                 @else
                     <a href="{{$url}}"
                        @if($paid)
                        onclick="showMessage('Please buy this package to continue');"
                             @endif
                     >{{$content->title}}

                     </a>
                 @endif
                 <span class="buttons-right pull-right">
                    <a href="javascript:void(0);">
                         @if($content->content_type=='video_url')<i class="fas fa-play-circle"></i>@endif
                        @if($content->content_type=='video')<i class="fas fa-play-circle"></i>@endif
                        @if($content->content_type=='file')<i class="far fa-file"></i>@endif
                        @if($content->content_type=='iframe')<i class="fas fa-border-all"></i>@endif
                        @if($content->content_type=='url')<i class="fas fa-link"></i>@endif
                    </a>

                </span> </li>
         @endforeach
     </ul>
</div>


@if($content)
<div class="row hide" >
    <div class="col-md-3"><img src="{{$content_image_path}}" class="img-responsive center-block" alt=""> </div>
    <div class="col-md-8">
        <div class="series-details">
            <h2>{{$content->title}} </h2>
            {!! $content->description!!}
        </div>
    </div>
</div>
@endif

{{-- <script src="{{themes('site/js/jquery-plugin-collection.js')}}"></script>--}}