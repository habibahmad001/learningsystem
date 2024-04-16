 <?php $settings = getSettings('posts');

// $settingsObj 			= new App\GeneralSettings();
// $exam_max_options 		= $settingsObj->getExamMaxOptions();


 ?>
				<div class="row">
 					 <fieldset class="form-group col-md-12">

						{{ Form::label('name', getphrase('name')) }}
						<span class="text-red">*</span>
						{{ Form::text('name', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'enter tag name',
						'ng-model'=>'name',
							'required'=> 'true', 
							 'ng-minlength' => '2',
							'ng-maxlength' => '60',
							'ng-class'=>'{"has-error": formLms.name.$touched && formLms.name.$invalid}',

						)) }}
						<div class="validation-error" ng-messages="formLms.name.$error" >
	    					{!! getValidationMessage()!!}
	    					{!! getValidationMessage('minlength')!!}
	    					{!! getValidationMessage('maxlength')!!}
	    					{!! getValidationMessage('pattern')!!}
						</div>
					</fieldset>


					
				</div>


 <div class="row">

	 <fieldset class="form-group col-md-6" >
		 {{ Form::label('type', getphrase('category')) }}
		 <span class="text-red">*</span>
		 {{Form::select('type', $categories, null, ['placeholder' => getPhrase('select'),'class'=>'form-control',
         'ng-model'=>'type',
             'required'=> 'true',

             'ng-class'=>'{"has-error": formLms.type.$touched && formLms.type.$invalid}',

         ]) }}
		 <div class="validation-error" ng-messages="formLms.type.$error" >
			 {!! getValidationMessage()!!}
		 </div>


	 </fieldset>


 </div>




 <div class="buttons text-center">
							<button class="btn btn-lg btn-success button"
							ng-disabled='!formLms.$valid'>{{ $button_name }}</button>
						</div>
