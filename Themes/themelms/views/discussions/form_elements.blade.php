 <?php $settings = getSettings('posts');

// $settingsObj 			= new App\GeneralSettings();
// $exam_max_options 		= $settingsObj->getExamMaxOptions();


 ?>


 <div class="row">

	 <fieldset class="form-group col-md-6" >
		 {{ Form::label('course_id', getphrase('Course')) }}
		 <span class="text-red">*</span>
		 {{Form::select('course_id', $courses, null, ['placeholder' => getPhrase('select'),'class'=>'form-control',
         'ng-model'=>'course_id',
             'required'=> 'true',

             'ng-class'=>'{"has-error": formLms.course_id.$touched && formLms.course_id.$invalid}',

         ]) }}
		 <div class="validation-error" ng-messages="formLms.course_id.$error" >
{{--			 {!! getValidationMessage()!!}--}}
		 </div>


	 </fieldset>


	 <fieldset class="form-group col-md-6" >
		 {{ Form::label('user_id', getphrase('User')) }}
		 <span class="text-red">*</span>
		 {{Form::select('user_id', $users, null, ['placeholder' => getPhrase('select'),'class'=>'form-control',
         'ng-model'=>'user_id',
             'required'=> 'true',

             'ng-class'=>'{"has-error": formLms.user_id.$touched && formLms.user_id.$invalid}',

         ]) }}
		 <div class="validation-error" ng-messages="formLms.user_id.$error" >
{{--			 {!! getValidationMessage()!!}--}}
		 </div>


	 </fieldset>


	 <fieldset class="form-group col-md-6" >
         <?php $featured_options = array('0'=>'0','1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5' );?>
		 {{ Form::label('rating', getphrase('rating')) }}
		 <span class="text-red"></span>
		 {{Form::select('rating', $featured_options, null, ['placeholder' => getPhrase('select'),'class'=>'form-control',
         'ng-model'=>'rating',


         ]) }}



	 </fieldset>
	 <fieldset class="form-group col-md-6" >
		 {{ Form::label('created_at', getphrase('review_date')) }}
		 <span class="text-red">*</span>
		 {{ Form::text('created_at', $value = null , $attributes = array('class'=>'form-control reviewdate','placeholder' => 'Enter review date',
         'ng-model'=>'title',
							'required'=> 'true',

							'ng-class'=>'{"has-error": formLms.created_at.$touched && formLms.created_at.$invalid}',

         )) }}
		 <div class="validation-error" ng-messages="formLms.created_at.$error" >
			 {!! getValidationMessage()!!}
		 </div>




	 </fieldset>
	 <fieldset class="form-group  col-md-12">

		 {{ Form::label('review_title', getphrase('review_title')) }}

		 {{ Form::text('review_title', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase('enter review title'),
                                 'ng-model'=>'review_title',
                                 'ng-class'=>'{"has-error": formLms.review_title.$touched && formLms.review_title.$invalid}'
                             )) }}

		 <div class="validation-error" ng-messages="formLms.review_title.$error" >

			 {!! getValidationMessage()!!}

		 </div>
	 </fieldset>
	 <fieldset class="form-group  col-md-12">
		 {{ Form::label('comment', getphrase('comment')) }}
		 {{ Form::textarea('comment', $value = null , $attributes = array('class'=>'form-control', 'rows'=>'5', 'placeholder' => 'comment description')) }}
	 </fieldset>

 </div>
 







 <div class="buttons text-center">
							<button class="btn btn-lg btn-success button"
							ng-disabled='!formLms.$valid'>{{ $button_name }}</button>
						</div>
