<?php 
	$questions 	= $data['questions'];
	$quiz 		= $data['quiz'];
	if(isset($data['current_state']))
    $cState     = $data['current_state'];

 ?>
<div class="panel-heading pb-0"><h2 class="p-0">Time Status</h2></div>
<div id="timerdiv" class="countdown-styled ">
	<span id="hours">{{$data['time_hours']}}</span> :
	<span id="mins">{{ $data['time_minutes']}}</span> :
	<span id="seconds">00</span>
</div>
<div class="panel-heading countdount-heading">
	<h2>{{getPhrase('total_time')}} <span class="pull-right">{{$data['atime_hours']}}:{{ $data['atime_minutes']}}:00</span></h2>
</div>
<div class="panel-body">
	<div class="sub-heading">
		<h3>{{$quiz->title}}</h3>
		<p>{{ ucfirst($quiz->category->category) .' '. getPhrase('category')}}</p>
	</div>
	<ul class="question-palette" id="pallete_list">

						    <?php
						         $i=0;
						         $section_data  = (array)json_decode($quiz->section_data);
						    ?>

                           @foreach($section_data as $key=>$value)
                              
                              <?php
                               
                              $section_questions  =  $value->questions;

                             ?>


                              @foreach($section_questions as $key_id => $question_id)

                                <?php
                                 
                                 $question  = App\QuestionBank::where('id',$question_id)->first();


                                ?>

						

							<?php 
									$default_class = 'not-visited';
									if(isset($cState) && $cState) {
									if(array_key_exists($questions[$i]->id, $cState))
										$default_class = 'answered';
								}
							?>

						 <?php $subject_pallet_class = 'pallet_subject_'.$key; ?>
                        
                      <li 
                      id="pallet_{{$question->id}}" 
                      class="palette pallete-elements pallete-elements-item {{$subject_pallet_class}}  not-visited" 
                      onclick="showSpecificQuestion({{$i}});"
                      data-psubject_id="{{$key}}"
                      >
						<span>{{$i+1}}</span>
						</li>

						  <?php $i++; ?>
                       
                        @endforeach

                    @endforeach

					
					</ul>
</div>
<div class="panel-heading pt-0 pb-0">
	<h2 class="p-0">{{ getPhrase('summary')}}</h2>
</div>
<div class="panel-body pt-0">
					<ul class="legends">
						<li  class="palette answered"><span id="palette_total_answered">1</span> {{getPhrase('answered')}}</li>
						<li  class="palette marked"><span id="palette_total_marked">2</span> {{getPhrase('marked')}}</li>
						<li  class="palette not-answered"><span id="palette_total_not_answered">3</span> {{getPhrase('not_answered')}}</li>
						<li  class="palette not-visited"><span id="palette_total_not_visited">4</span> {{getPhrase('not_visited')}}</li>
					</ul>
				</div>
