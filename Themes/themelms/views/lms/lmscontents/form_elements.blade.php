 <?php $settings = getSettings('lms');?>

 <?php
 $settingsObj 			= new App\GeneralSettings();
 $exam_max_options 		= $settingsObj->getExamMaxOptions();


 ?>
				<div class="row">
 					 <fieldset class="form-group col-md-6">

						{{ Form::label('title', getphrase('title')) }}
						<span class="text-red">*</span>
						{{ Form::text('title', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'C Programming',
						'ng-model'=>'title',
							'required'=> 'true', 
							'ng-pattern' => getRegexPattern("title"),
							'ng-minlength' => '2',
							'ng-maxlength' => '260',
							'ng-class'=>'{"has-error": formLms.title.$touched && formLms.title.$invalid}',

						)) }}
						<div class="validation-error" ng-messages="formLms.title.$error" >
	    					{!! getValidationMessage()!!}
	    					{!! getValidationMessage('minlength')!!}
	    					{!! getValidationMessage('maxlength')!!}
	    					{!! getValidationMessage('pattern')!!}
						</div>
					</fieldset>

					 <fieldset class="form-group col-md-6">

						{{ Form::label('code', getphrase('code')) }}
						<span class="text-red">*</span>
						{{ Form::text('code', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'CNT100',
							'ng-model'=>'code',
							'required'=> 'true', 
							'ng-pattern' => getRegexPattern("title"),
							'ng-minlength' => '2',
							'ng-maxlength' => '20',
							'ng-class'=>'{"has-error": formLms.code.$touched && formLms.code.$invalid}',

						)) }}
						<div class="validation-error" ng-messages="formLms.code.$error" >
	    					{!! getValidationMessage()!!}
	    					{!! getValidationMessage('minlength')!!}
	    					{!! getValidationMessage('maxlength')!!}
	    					{!! getValidationMessage('pattern')!!}
						</div>
					</fieldset>
					
				</div>

 			<div class="row">
 					<fieldset class="form-group col-md-6">
						{{ Form::label('subject_id', getphrase('subject')) }}
						<span class="text-red">*</span>
						{{Form::select('subject_id', $subjects, null, [ 'class'=>'form-control'])}}
					</fieldset>

					 <fieldset class="form-group  col-md-6"   >
				   {{ Form::label('image', getphrase('image')) }}  <span class="badge badge-success"> Size:5MB, Allowed Ext: .png, .jpg, .jpeg</span>
				         <input type="file" class="form-control" name="image"
				          accept=".png,.jpg,.jpeg" id="image_input">

				    </fieldset>

					 <fieldset class="form-group col-md-6"   >
					@if($record)
				   		@if($record->image)
				         <img src="{{ IMAGE_PATH_UPLOAD_LMS_CONTENTS.$record->image }}" height="100" width="100">
				         @endif
				     @endif
				    </fieldset>
					
			</div>

 
					<div  class="row">
				 	 <fieldset class="form-group col-md-6" >
						{{ Form::label('content_type', getphrase('content_type')) }}
						<span class="text-red">*</span>
						{{Form::select('content_type', $settings->content_types, null, ['placeholder' => getPhrase('select'),'class'=>'form-control', 
						'ng-model'=>'content_type',
							'required'=> 'true', 
							'ng-pattern' => getRegexPattern("name"),
							'ng-minlength' => '2',
							'ng-maxlength' => '20',
							'ng-class'=>'{"has-error": formLms.content_type.$touched && formLms.content_type.$invalid}',

						]) }}
						<div class="validation-error" ng-messages="formLms.content_type.$error" >
	    					{!! getValidationMessage()!!}
						</div>


					</fieldset>

					 <fieldset ng-if="content_type=='url' || content_type=='iframe' || content_type=='video_url'|| content_type=='audio_url'" class="form-group col-md-6">
							{{ Form::label('file_path', getphrase('resource_link')) }}
							<span class="text-red">*</span>
							{{ Form::text('file_path', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'Resource URL',
								'ng-model'=>'file_path',
								'required'=> 'true', 
								'ng-class'=>'{"has-error": formLms.file_path.$touched && formLms.file_path.$invalid}',

						)) }}
						<div class="validation-error" ng-messages="formLms.file_path.$error" >
	    					{!! getValidationMessage()!!}
						</div>
						</fieldset>



					<fieldset ng-if="content_type=='file' || content_type=='video' || content_type=='audio'" class="form-group col-md-6">
							{{ Form::label('lms_file', getphrase('lms_file')) }}  <span class="badge badge-success" > Size:20MB, Allowed Ext: .pdf .mp3, .mp4</span>
							<span class="text-red">*</span>
							 <input type="file" 
							 class="form-control" 
							 name="lms_file"  >

						@if($record)

							@if($record->file_path)

                                <?php $examSettings = getExamSettings(); ?>

								<a  href="{{ IMAGE_PATH_UPLOAD_LMS_CONTENTS.$record->file_path }}" target="_blank">
									View File</a>



							@endif

						@endif
					</fieldset>
						<fieldset ng-if="content_type=='iframe'  || content_type=='video'  || content_type=='file'" class="form-group col-md-6" >

							{{ Form::label('Video Length (Minutes & Seconds)', getphrase('Video Length (Minutes & Seconds)')) }}

							{{Form::text('video_length', $value=null,$attributes = array('class'=>'form-control', 'placeholder' => '04:01' ,
                            'ng-model'=>'video_length',
                            'ng-pattern' => getRegexPattern("duration"),
							'ng-minlength' => '0',
							'ng-maxlength' => '8',
                                'ng-class'=>'{"has-error": formLms.video_length.$touched && formLms.video_length.$invalid}')) }}

							<div class="validation-error" ng-messages="formLms.video_length.$error" >
								{!! getValidationMessage()!!}
							</div>
						</fieldset>


						<fieldset ng-if="content_type=='iframe'  || content_type=='video'" class="form-group col-md-6" >

							{{ Form::label('Preview Item', getphrase('Preview Item')) }}

							<select name="preview" id="preview" class="form-control">
								<option value="">--- Select One ---</option>
								<option value="yes" {!! isset($record->preview) && $record->preview == "yes" ? "selected='selected'" : "" !!}>Yes</option>
								<option value="no" {!! isset($record->preview) && $record->preview == "no" ? "selected='selected'" : "" !!}>No</option>
							</select>

						</fieldset>


					<?php $allowed_options = array('0'=>'No', '1'=>'Yes');?>
						<fieldset ng-if="content_type=='file'" class="form-group col-md-6" >

							{{ Form::label('download_allowed', getphrase('download_allowed')) }}

							<span class="text-red">*</span>
							{{Form::select('download_allowed', $allowed_options, null, ['placeholder' => getPhrase('select'),'class'=>'form-control',

                            'ng-model'=>'download_allowed',
                            'required'=> 'true',
                                'ng-class'=>'{"has-error": formLms.download_allowed.$touched && formLms.download_allowed.$invalid}',
           ]) }}

							<div class="validation-error" ng-messages="formLms.download_allowed.$error" >
					{!! getValidationMessage()!!}
							</div>
						</fieldset>

					@if($record)
						@if($record->resource_link!='')
						<fieldset class="form-group col-md-6">
							<label>   &nbsp;</label>
						 {{link_to_asset(IMAGE_PATH_UPLOAD_LMS_CONTENTS.$record->resource_link, getPhrase('download'))}} 
						 </fieldset>
						@endif
					@endif

					</div>

					<fieldset class="form-group">

						{{ Form::label('description', getphrase('description')) }}

						{{ Form::textarea('description', $value = null , $attributes = array('class'=>'form-control ckeditor', 'rows'=>'5', 'placeholder' => 'Fine description')) }}
					</fieldset>





 <div class="buttons text-center">
							<button class="btn btn-lg btn-success button"
							ng-disabled='!formLms.$valid'>{{ $button_name }}</button>
						</div>
