                       <?php    

                                    $image_path = PREFIX.(new App\ImageSettings())->

                                    getExamImagePath(); 



                                    ?>


                       <div class="row">
                           <div class="col-md-8 text-center">
                               @if($question->question_type!='audio' && $question->question_type !='video')
                                   @if($question->question_file)
                                       <img class="image " src="{{$image_path.$question->question_file}}" style="max-height:200px;">
                                   @endif
                               @endif
                           </div>
                           <div class="col-md-4 mb-10 text-md-right">
                               <small class="font-15"><strong>{{getPhrase('subject')}}:</strong>{{$subject->subject_title}}</small>
                           </div>
                       </div>
                    <div class="questions questions-withno questions_newStyle">
                        <span class="question-numbers">Q {{$question_number}}.</span>
                        <span class="language_l1">{!! $question->question !!}</span>
                        @if($question->question)
                            <span class="language_l2 mb-10" style="display: none;">{!! $question->question_l2 !!}</span>
                        @else
                            <span class="language_l2 mb-10" style="display: none;">{!! $question->question !!}</span>
                        @endif
                    </div>
                    <?php 
                    $meta = (object)$meta;
                   $question = $meta->question;
                    $time_spent = $meta->time_spent;

                    $timing_lable = 'label label-danger';
                    

                    if($question->time_to_spend > $time_spent->time_spent)

                    {

                        $timing_lable = 'label label-info';

                    }



                    ?>

                        <div class="answer-status-container">

                        <div class="row">

                            <div class="col-md-3">

                                <div class="question-status">

                                    <strong>{{getPhrase('time_limit')}}: </strong>

                                    {{gmdate("H:i:s", $question->time_to_spend)}} 

                                </div>

                            </div>

                            <div class="col-md-3">

                                <div class="question-status">

                                    <strong>{{getPhrase('time_taken')}}: </strong>

                                    <span class="{{$timing_lable}}"> {{gmdate("H:i:s", $time_spent->time_spent)}} </span>

                                     

                                </div>

                            </div>

                       

                            

                        </div>

                        </div>

                        <hr>