 <?php $settings = getSettings('posts');

// $settingsObj 			= new App\GeneralSettings();
// $exam_max_options 		= $settingsObj->getExamMaxOptions();


 ?>
				<div class="row">
 					 <fieldset class="form-group col-md-12">

						{{ Form::label('title', getphrase('title')) }}
						<span class="text-red">*</span>
						{{ Form::text('title', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'C Programming',
						'ng-model'=>'title',
							'required'=> 'true', 
							 'ng-minlength' => '2',
							'ng-maxlength' => '460',
							'ng-class'=>'{"has-error": formLms.title.$touched && formLms.title.$invalid}',

						)) }}
						<div class="validation-error" ng-messages="formLms.title.$error" >
	    					{!! getValidationMessage()!!}
	    					{!! getValidationMessage('minlength')!!}
	    					{!! getValidationMessage('maxlength')!!}
	    					{!! getValidationMessage('pattern')!!}
						</div>
					</fieldset>


					
				</div>

 			<div class="row">

					 <fieldset class="form-group  col-md-12"   >
				   {{ Form::label('image', getphrase('image')) }}
				         <input type="file" class="form-control" name="image"
				          accept=".png,.jpg,.jpeg" id="image_input">

				    </fieldset>

					 <fieldset class="form-group col-md-6"   >
					@if($record)
				   		@if($record->image)
								 <img src="{{ getBlogImgPath($record->image) }}" class="img-responsive"/>
{{--				         <img src="{{ IMAGE_PATH_UPLOAD_POST_CONTENTS.$record->image }}" height="100" width="100">--}}
				         @endif
				     @endif
				    </fieldset>
					
			</div>
 <div class="row">

	 <fieldset class="form-group col-md-6" >
		 {{ Form::label('category_id', getphrase('category')) }}
		 <span class="text-red">*</span>
		 {{Form::select('category_id', $categories, null, ['placeholder' => getPhrase('select'),'class'=>'form-control',
         'ng-model'=>'category_id',
             'required'=> 'true',

             'ng-class'=>'{"has-error": formLms.category_id.$touched && formLms.category_id.$invalid}',

         ]) }}
		 <div class="validation-error" ng-messages="formLms.category_id.$error" >
			 {!! getValidationMessage()!!}
		 </div>


	 </fieldset>

	 <fieldset class="form-group col-md-6" >
         <?php $featured_options = array('1'=>'Yes', '0'=>'No');?>
		 {{ Form::label('featured', getphrase('featured_post')) }}
		 <span class="text-red"></span>
		 {{Form::select('featured', $featured_options, null, ['placeholder' => getPhrase('select'),'class'=>'form-control',
         'ng-model'=>'featured',


         ]) }}



	 </fieldset>
     <?php

     $role = getRole();
     if($role!="instructor"){
     $options = array('Active'=>'Yes', 'Inactive'=>'No');?>


	 <fieldset class="form-group col-md-6" >

		 {{ Form::label('status', getphrase('Publish')) }}

		 <span class="text-red">*</span>

		 {{Form::select('status', $options, null, ['placeholder' => getPhrase('select'),'class'=>'form-control',

             'ng-model'=>'status',

             'required'=> 'true',

             'ng-class'=>'{"has-error": formLms.status.$touched && formLms.status.$invalid}',



         ]) }}

		 <div class="validation-error" ng-messages="formLms.status.$error" >

			 {!! getValidationMessage()!!}

		 </div>

	 </fieldset>

<?php } ?>

 </div>
<div class="row">
 <fieldset class="form-group col-md-12">

	 {{ Form::label('tags', getphrase('tags')) }}
	 <span class="text-red">*</span>
	 {{ Form::text('tags', $value = null , $attributes = array('class'=>'form-control','data-role'=>'tagsinput',  'placeholder' => 'Enter comma separated tags',
     'ng-model'=>'tags',
          'ng-minlength' => '2',
         'ng-maxlength' => '560',
         'ng-class'=>'{"has-error": formLms.tags.$touched && formLms.tags.$invalid}',

     )) }}
	 <div class="validation-error" ng-messages="formLms.tags.$error" >
		 {!! getValidationMessage()!!}
		 {!! getValidationMessage('minlength')!!}
		 {!! getValidationMessage('maxlength')!!}
	 </div>
 </fieldset>

</div>
 <div class="row">
 <fieldset class="form-group col-md-12">

						{{ Form::label('description', getphrase('description')) }}

						{{ Form::textarea('description', $value = null , $attributes = array('class'=>'form-control ckeditor', 'rows'=>'5', 'placeholder' => 'Fine description')) }}
					</fieldset>

 </div>



 <div class="buttons text-center">
							<button class="btn btn-lg btn-success button"
							ng-disabled='!formLms.$valid'>{{ $button_name }}</button>
						</div>
