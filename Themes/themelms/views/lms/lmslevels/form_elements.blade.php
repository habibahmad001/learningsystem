 					
 					 <fieldset class="form-group">
						
						{{ Form::label('level', getphrase('level_name')) }}
						<span class="text-red">*</span>
						{{ Form::text('name', $value = null , $attributes = array('class'=>'form-control',
						'placeholder' => getPhrase('enter_level_name'),
						'ng-model'=>'name',
							'required'=> 'true', 
							'ng-pattern' => getRegexPattern("name"),
							'ng-minlength' => '2',
							'ng-maxlength' => '60',
							'ng-class'=>'{"has-error": formLms.name.$touched && formLms.name.$invalid}',

						)) }}
						<div class="validation-error" ng-messages="formLms.level.$error" >
	    					{!! getValidationMessage()!!}
	    					{!! getValidationMessage('minlength')!!}
	    					{!! getValidationMessage('maxlength')!!}
	    					{!! getValidationMessage('pattern')!!}
						</div>
					</fieldset>
 					  


				 

						
					</fieldset>
						<div class="buttons text-center">
							<button class="btn btn-lg btn-success button"
							ng-disabled='!formLms.$valid'>{{ $button_name }}</button>
						</div>
		 