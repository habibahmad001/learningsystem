 					 
 					 <fieldset class="form-group">
						
						{{ Form::label('name', getphrase('awarding_body_name')) }}
						<span class="text-red">*</span>
						{{ Form::text('name', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase('enter_awarding_body_name'),
							'ng-model'=>'name',
							 'ng-minlength' => '2',
							'ng-maxlength' => '160',
							 'required'=> 'true',
							'ng-class'=>'{"has-error": formCategories.name.$touched && formCategories.name.$invalid}',
							 
							)) }}
							<div class="validation-error" ng-messages="formCategories.name.$error" >
	    					{!! getValidationMessage()!!}
	    					{!! getValidationMessage('minlength')!!}
	    					{!! getValidationMessage('maxlength')!!}
	    			 	</div>
					</fieldset>
 			 
 					  <fieldset class="form-group" >
				   {{ Form::label('category', getphrase('image')) }}
				         <input type="file" class="form-control" name="catimage" 
				         accept=".png,.jpg,.jpeg,.gif" id="image_input">
				          
				          
				    </fieldset>

				     <fieldset class="form-group" >
					@if($record)	
				   		@if($record->image)
				         <?php $postSettings =getSettings('lms'); ?>
				         <img src="{{ PREFIX.$postSettings->awardingbodyImagepath.$record->image }}" height="100" width="100" >

				         @endif
				     @endif
					

				    </fieldset>

				  
					<fieldset class="form-group">
						
						{{ Form::label('description', getphrase('description')) }}
						
						{{ Form::textarea('description', $value = null , $attributes = array('class'=>'form-control', 'rows'=>'5', 'placeholder' => 'Description')) }}
					</fieldset>
						
					</fieldset>
						<div class="buttons text-center">
							<button class="btn btn-lg btn-success button"
							ng-disabled='!formCategories.name.$valid'>{{ $button_name }}</button>
						</div>
		 