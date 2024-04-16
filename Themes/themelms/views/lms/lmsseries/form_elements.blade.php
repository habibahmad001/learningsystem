
<?php
$settingsObj 			= new App\GeneralSettings();
$exam_max_options 		= $settingsObj->getExamMaxOptions();


?>
 				

					<div class="row">
 					 <fieldset class="form-group col-md-6">

						

						{{ Form::label('title', getphrase('course_title')) }}

						<span class="text-red">*</span>

						{{ Form::text('title', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase('series_title'),

							'ng-model'=>'title', 

							'ng-pattern'=>getRegexPattern('course'),

							'required'=> 'true', 

							'ng-class'=>'{"has-error": formLms.title.$touched && formLms.title.$invalid}',

							'ng-minlength' => '2',

							'ng-maxlength' => '230',

							)) }}

						<div class="validation-error" ng-messages="formLms.title.$error" >

	    					{!! getValidationMessage()!!}

	    					{!! getValidationMessage('pattern')!!}

	    					{!! getValidationMessage('minlength')!!}

	    					{!! getValidationMessage('maxlength')!!}

						</div>

					</fieldset>
						<fieldset class="form-group col-md-6">

							{{ Form::label('sub_title', getphrase('sub_title')) }}
							{{ Form::text('sub_title', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase('course_subtitle'),
                                 'ng-model'=>'sub_title',
                                'ng-class'=>'{"has-error": formLms.sub_title.$touched && formLms.sub_title.$invalid}',
                             )) }}

							<div class="validation-error" ng-messages="formLms.sub_title.$error" >

								{!! getValidationMessage()!!}
							</div>

						</fieldset>

				    </div>

<div class="row">
	<fieldset class="form-group col-md-6" >

		{{ Form::label('lms_parent_category_id', 'LMS Category') }}

		<span class="text-red">*</span>

		{{Form::select('lms_parent_category_id', $categories, null, ['placeholder' => getPhrase('select'),'class'=>'form-control lms_parent_category_id',

        'ng-model'=>'lms_parent_category_id',
            'required'=> 'true',
            'ng-class'=>'{"has-error": formLms.lms_parent_category_id.$touched && formLms.lms_parent_category_id.$invalid}',

        ]) }}

		<div class="validation-error" ng-messages="formLms.lms_parent_category_id.$error" >

			{!! getValidationMessage()!!}

		</div>





	</fieldset>
	<fieldset class="form-group col-md-6" >

		{{ Form::label('lms_category_id', 'LMS Sub Category') }}

		<span class="text-red">*</span>
        @if(!$record)
            <select class="form-control lms_sub_categories" name="lms_category_id">
                <option value="">Select Subcategory</option>

            </select>
            @else
<select class="form-control lms_sub_categories" name="lms_category_id">
	<option value="">Select Subcategory</option>
	@if(\App\LmsCategory::whereParent_id($record->lms_parent_category_id)->exists() )
		@foreach(App\LmsCategory::whereParent_id($record->lms_parent_category_id )->orderBy('category', 'ASC')->get() as $category)
			<option  value="{{$category->id}}" {{$category->id == $record->lms_category_id  ? 'selected' : '' }}>{{$category->category}}</option>
		@endforeach
	@endif
</select>
        @endif
{{--		{{Form::select('lms_category_id', $categories, null, ['placeholder' => getPhrase('select'),'class'=>'form-control lms_category_id',--}}

{{--    'ng-model'=>'lms_category_id',--}}
{{--        'required'=> 'true',--}}
{{--        'ng-class'=>'{"has-error": formLms.lms_category_id.$touched && formLms.lms_category_id.$invalid}',--}}

{{--    ]) }}--}}
		<div class="validation-error" ng-messages="formLms.lms_category_id.$error" >

			{!! getValidationMessage()!!}

		</div>
{{--		{{Form::select('lms_sub_category_id','',null, ['placeholder' => getPhrase('select'),'class'=>'form-control lms_sub_categories',--}}

{{--        'ng-model'=>'lms_sub_category_id',--}}
{{--            'required'=> 'true',--}}
{{--            'ng-class'=>'{"has-error": formLms.lms_sub_category_id.$touched && formLms.lms_sub_category_id.$invalid}',--}}

{{--        ]) }}--}}

		<div class="validation-error" ng-messages="formLms.lms_sub_category_id.$error" >

			{!! getValidationMessage()!!}

		</div>





	</fieldset>
	<fieldset class="form-group col-md-6" >

		{{ Form::label('level_id', 'Level') }}

		<span class="text-red">*</span>

		{{Form::select('level_id', $levels, null, ['placeholder' => getPhrase('select'),'class'=>'form-control',
       'ng-model'=>'level_id',
            'required'=> 'true',
            'ng-class'=>'{"has-error": formLms.level_id.$touched && formLms.level_id.$invalid}',
        ]) }}
		<div class="validation-error" ng-messages="formLms.level_id.$error" >
			{!! getValidationMessage()!!}
		</div>





	</fieldset>
	<fieldset class="form-group col-md-6" >

		{{ Form::label('user_id', getphrase('instructor')) }}

		<span class="text-red">*</span>

		{{Form::select('user_id', $instructors, null, ['placeholder' => getPhrase('select'),'class'=>'form-control',

            'ng-model'=>'user_id',

            'required'=> 'true',

            'ng-class'=>'{"has-error": formLms.user_id.$touched && formLms.user_id.$invalid}',



        ]) }}

		<div class="validation-error" ng-messages="formLms.user_id.$error" >

			{!! getValidationMessage()!!}

		</div>

	</fieldset>
	<fieldset class="form-group col-md-6" style="display: none">

		{{ Form::label('total_items', getphrase('total_items')) }}

		<span class="text-red">*</span>

		{{ Form::text('total_items', $value = null , $attributes = array('class'=>'form-control','readonly'=>'true' ,'placeholder' => getPhrase('It will be updated by adding the LMS items'))) }}

	</fieldset>
</div>

	<div  class="row">
			<?php $payment_options = array('1'=>'Paid', '0'=>'Free', '2'=>'Discounted', '3'=>'Discounted & Show in discount page');?>

					 <fieldset class="form-group col-md-6" >

						{{ Form::label('is_paid', getphrase('is_paid')) }}<span class="text-red">*</span>

						{{--<span class="text-red">*</span>--}}

						{{Form::select('is_paid', $payment_options, $value = null, ['placeholder' => getPhrase('select'),'class'=>'form-control',

						'ng-model'=>'is_paid',
						'required'=> 'true',
							'ng-class'=>'{"has-error": formLms.is_paid.$touched && formLms.is_paid.$invalid}',



						]) }}

						<div class="validation-error" ng-messages="formLms.is_paid.$error" >

	    					{!! getValidationMessage()!!}

						</div>





					</fieldset>

				<fieldset class="form-group col-md-2">



					{{ Form::label('validity', getphrase('validity_days')) }}

					<span class="text-red">*</span>

					{{ Form::number('validity',$value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase('validity_in_days'),

                    'ng-model'=>'validity',
                    'string-to-number'=>'true',

                    'min'=>'1',



                    'required'=> 'true',
                    'string-to-number'=>'true',
                    'ng-class'=>'{"has-error": formLms.validity.$touched && formLms.validity.$invalid}',



                    )) }}

					<div class="validation-error" ng-messages="formLms.validity.$error" >

						{!! getValidationMessage()!!}

						{!! getValidationMessage('number')!!}

					</div>

				</fieldset>

				<div ng-if="is_paid==1 || is_paid==2 || is_paid==3">



	  				 <fieldset class="form-group col-md-2">

						

						{{ Form::label('discount_price', getphrase('discount_price')) }}

						{{--<span class="text-red">*</span>--}}

						 {{ Form::number('discount_price', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => '40',

                             'min'=>'1',
                             'ng-model'=>'discount_price',
                             'string-to-number'=>'true',
                             'ng-class'=>'{"has-error": formLms.discount_price.$touched && formLms.discount_price.$invalid}',



                         )) }}

						<div class="validation-error" ng-messages="formLms.cost.$error" >

	    					{!! getValidationMessage()!!}

	    					{{--{!! getValidationMessage('number')!!}--}}

						</div>

				</fieldset>
						<fieldset class="form-group col-md-2">



							{{ Form::label('cost', getphrase('regular_price')) }}

							<span class="text-red">*</span>


							{{ Form::number('cost', $value = null , $attributes = array('class'=>'form-control',
								'placeholder' => '40',
								'min'=>'1',
								'required'=> 'true',
								'ng-model'=>'cost',
								'string-to-number'=>'true',
								'ng-class'=>'{"has-error": formLms.cost.$touched && formLms.cost.$invalid}',

								)) }}

							<div class="validation-error" ng-messages="formLms.discount_price.$error" >

								{!! getValidationMessage()!!}

								{{--{!! getValidationMessage('number')!!}--}}

							</div>

						</fieldset>

				</div>

				</div>




<div class="row">
	<fieldset class="form-group col-md-6" >
		{{ Form::label('certificate', getphrase('upload_certificate')) }}
		<input type="file" name="certificatefield" id="certificatefield">
	</fieldset>
	<fieldset class="form-group col-md-6" >
		<img src="{!! (isset($record->certificate)) ? UPLOADS.'lms/certificate/'.$record->certificate : "https://via.placeholder.com/150x150&text=244x346" !!}" width="150" height="150" style="border-radius: 8px;" />
	</fieldset>

</div>

<div class="row">

    <?php $certificate_options = array('1'=>'Yes', '2'=>'No');?>
	<fieldset class="form-group col-md-6" >

		{{ Form::label('completion_certificate', getphrase('completion_certificate')) }}

		<span class="text-red">*</span>

		{{Form::select('completion_certificate', $certificate_options, $value = null, ['placeholder' => getPhrase('select'),'class'=>'form-control',

        'ng-model'=>'completion_certificate',
        'required'=> 'true',
            'ng-class'=>'{"has-error": formLms.completion_certificate.$touched && formLms.completion_certificate.$invalid}',



        ]) }}

		<div class="validation-error" ng-messages="formLms.completion_certificate.$error" >

			{!! getValidationMessage()!!}

		</div>


	</fieldset>
		<fieldset class="form-group col-md-6">



			{{ Form::label('certificate_title', getphrase('certificate_title')) }}


			{{ Form::text('certificate_title', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase('certificate_title_or_leave_empty'),

                'ng-model'=>'certificate_title',

                'ng-pattern'=>getRegexPattern('title'),

                'ng-class'=>'{"has-error": formLms.certificate_title.$touched && formLms.certificate_title.$invalid}',

                'ng-minlength' => '2',

                'ng-maxlength' => '300',

                )) }}

			<div class="validation-error" ng-messages="formLms.certificate_title.$error" >

				{!! getValidationMessage()!!}

				{!! getValidationMessage('pattern')!!}

				{!! getValidationMessage('minlength')!!}

				{!! getValidationMessage('maxlength')!!}

			</div>

		</fieldset>



</div>


				<div class="row">

					<fieldset class="form-group col-md-6" >

						{{ Form::label('number_of_reviews', getphrase('number_of_reviews')) }}



						{{Form::text('number_of_reviews', null, ['placeholder' => '99','class'=>'form-control',

                        'ng-model'=>'number_of_reviews',


                            'ng-class'=>'{"has-error": formLms.number_of_reviews.$touched && formLms.number_of_reviews.$invalid}'

                        ]) }}


					</fieldset>
					<fieldset class="form-group col-md-6" >

						{{ Form::label('number_of_modules', getphrase('number_of_modules')) }}



						{{Form::text('number_of_modules', null, ['placeholder' => '99','class'=>'form-control',

                        'ng-model'=>'number_of_modules',


                            'ng-class'=>'{"has-error": formLms.number_of_modules.$touched && formLms.number_of_modules.$invalid}'

                        ]) }}


					</fieldset>
					<fieldset class="form-group col-md-6" >

						{{ Form::label('number_of_students', getphrase('number_of_students')) }}


						{{Form::text('number_of_students', null, ['placeholder' => '99','class'=>'form-control',

                        'ng-model'=>'number_of_students',


                            'ng-class'=>'{"has-error": formLms.level_id.$touched && formLms.level_id.$invalid}'

                        ]) }}


					</fieldset>
                     <?php $options = array('1'=>'Yes', '0'=>'No');?>

					<fieldset class="form-group col-md-3" >

						{{ Form::label('show_in_front', getphrase('show_in_home_page')) }}

						<span class="text-red">*</span>

						{{Form::select('show_in_front', $options, null, ['placeholder' => getPhrase('select'),'class'=>'form-control',

                            'ng-model'=>'show_in_front',

                            'required'=> 'true',

                            'ng-class'=>'{"has-error": formLms.show_in_front.$touched && formLms.show_in_front.$invalid}',



                        ]) }}

						<div class="validation-error" ng-messages="formLms.show_in_front.$error" >

							{!! getValidationMessage()!!}

						</div>

					</fieldset>
					<fieldset class="form-group col-md-3" >

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



			    </div>
 <div class="row">
	 <fieldset class="form-group col-md-6" >
		 {{ Form::label('image', getphrase('image')) }}
		 {{ Form::file('image',['id' => 'image_input', 'class' => 'form-control',
							 'ng-model'=>'image',
                            ]) }}
		 {{--<input type="file" class="form-control" required="required" name="image"
				accept=".png,.jpg,.jpeg" id="image_input">
--}}



	 </fieldset>



	 <fieldset class="form-group col-md-4" >

		 @if($record)

			 @if($record->image)

                 <?php $examSettings = getExamSettings(); ?>

				 <img src="{{ IMAGE_PATH_UPLOAD_LMS_SERIES.$record->image }}" height="100" width="100" >



			 @endif

		 @endif

	 </fieldset>
 </div>

<div class="row">

	<fieldset class="form-group col-md-6" >

		{{ Form::label('video', getphrase('featured video')) }}

<input type="hidden" value="{{$record->id ?? ''}}" id="series_id">
		<div class="dropzone dropzone-previews" id="my-awesome-dropzone">

		</div>
	</fieldset>

	<fieldset class="form-group col-md-6 lms_video" >
		<?php
			if(isset($record->video)){
		$video = $record->video ;
		}else{
				$video = '';
			}
		?>
		<video   width="320" height="240"  src="{{VIDEO_PATH_UPLOAD_LMS_SERIES.$video}}" controls>
		</video>
	</fieldset>
</div>

			<div class="row input-daterange" id="dp">
				<?php 
				$date_from = date('Y/m/d');
				$date_to = date('Y/m/d');
				if($record)
				{
					$date_from = $record->start_date;
					$date_to = $record->end_date;
				}
				 ?>
				 <fieldset class="form-group col-md-3">
					{{ Form::label('start_date', getphrase('start_date')) }}
					{{ Form::text('start_date', $value = $date_from , $attributes = array('class'=>'input-sm form-control', 'placeholder' => '2015/7/17')) }}
				</fieldset>

				<fieldset class="form-group col-md-3">
					{{ Form::label('end_date', getphrase('end_date')) }}
					{{ Form::text('end_date', $value = $date_to , $attributes = array('class'=>'input-sm form-control', 'placeholder' => '2015/7/17')) }}
				</fieldset>
					<fieldset class="form-group col-md-6" >

						{{ Form::label('accredited_by', getphrase('accredited_by')) }}

						<span class="text-red">*</span>

						{{Form::select('accredited_by', $accredited_bodies, null, ['placeholder' => getPhrase('select'),'class'=>'form-control',

						    'ng-model'=>'accredited_by',

							'required'=> 'true',

							'ng-class'=>'{"has-error": formLms.accredited_by.$touched && formLms.accredited_by.$invalid}',



						]) }}

						<div class="validation-error" ng-messages="formLms.accredited_by.$error" >

							{!! getValidationMessage()!!}

						</div>

					</fieldset>
			</div>
<div class="row">
	<fieldset class="form-group col-md-8" ><span>Guided Learning Hours</span><input type="text" name="learning_hoursfield" class="form-control" id="learning_hoursfield" placeholder="10" value="{!! (isset($record->learning_hours) && $record->learning_hours != "") ? $record->learning_hours : '' !!}"></fieldset>
	<fieldset class="form-group col-md-4" ><br /><br /><input type="checkbox" name="setpopularfield" id="setpopularfield" style="display: inline-block;" value="yes" {!! (isset($record->setpopular) && $record->setpopular == "yes") ? 'checked' : '' !!}> <span style="margin: 0 0 0 5px;">As home page popular</span></fieldset>
</div>
<div class="row lms-checkbox-setting">
	<fieldset class="form-group col-md-3" ><input type="checkbox" name="assesmentfield" id="assesmentfield" value="yes" {!! (isset($record->assesment) && $record->assesment == "yes") ? 'checked' : '' !!}><span>Assessment</span></fieldset>
	<fieldset class="form-group col-md-3" ><input type="checkbox" name="pdffield" id="pdffield" value="yes" {!! (isset($record->pdf) && $record->pdf == "yes") ? 'checked' : '' !!}><span>Is PDF Attached</span></fieldset>
	<fieldset class="form-group col-md-3" ><input type="checkbox" name="videofield" id="videofield" value="yes" {!! (isset($record->videoattach) && $record->videoattach == "yes") ? 'checked' : '' !!}><span>Is Video Attached</span></fieldset>
	<fieldset class="form-group col-md-3" ><input type="checkbox" name="keyf" id="keyf" value="yes" {!! (isset($record->features) && $record->features) ? 'checked' : '' !!} onclick="javascript:$('#festurediv').toggle(300);"><span>Add Key Features</span></fieldset>
</div>
<div class="row" id="tagsrow">
	<fieldset class="form-group col-md-12" >

		{{ Form::label('course_tags', getphrase('course_tags')) }}


		{{Form::text('course_tags', null, ['placeholder' => '','class'=>'form-control course_tags',
		 "id"=>"course_tags",

        'ng-model'=>'course_tags',


            'ng-class'=>'{"has-error": formLms.course_tags.$touched && formLms.course_tags.$invalid}'

        ]) }}


	</fieldset>
</div>
<div class="row" id="festurediv" {!! (isset($record->features) && $record->features) ? '' : 'style="display: none;"' !!}>
	<fieldset class="form-group  col-md-12">
	{{ Form::label('featureslabel', getphrase('Key_Features')) }}
	{{ Form::textarea('featuresfield', $value = (isset($record->features)) ? $record->features : null , $attributes = array('class'=>'form-control ckeditor', 'rows'=>'5', 'placeholder' => getPhrase('Key Features'))) }}
	</fieldset>
</div>
 					<div class="row">
						<fieldset class="form-group  col-md-12">
							{{ Form::label('description', getphrase('description')) }}
							{{ Form::textarea('description', $value = null , $attributes = array('class'=>'form-control ckeditor', 'rows'=>'5', 'placeholder' => getPhrase('description'))) }}
						</fieldset>
					</div>
<div class="row">
	<fieldset class="form-group  col-md-12">
		{{ Form::label('why_consider_nla', getphrase('why_consider_next_learn_academy')) }}
		{{ Form::textarea('why_consider_nla', $value = null , $attributes = array('class'=>'form-control ckeditor', 'rows'=>'5', 'placeholder' => getPhrase('why_consider_next_learn_academy'))) }}
	</fieldset>
</div>
<div class="row">
	<fieldset class="form-group  col-md-12">
		{{ Form::label('what_will_i_learn', getphrase('what_will_i_learn')) }}
		{{ Form::textarea('what_will_i_learn', $value = null , $attributes = array('class'=>'form-control ckeditor','name'=>'what_will_i_learn', 'rows'=>'5', 'placeholder' => getPhrase('what_will_i_learn'))) }}

	</fieldset>
</div>
				<div class="row">
					<fieldset class="form-group  col-md-12">
						{{ Form::label('entry_requirements', getphrase('entry_requirements')) }}
						{{ Form::textarea('entry_requirements', $value = null , $attributes = array('class'=>'form-control ckeditor', 'rows'=>'2', 'placeholder' => getPhrase('entry_requirements'))) }}
					</fieldset>

				</div>
				<div class="row">
					<fieldset class="form-group  col-md-12">
						{{ Form::label('who_should_attend', getphrase('who_should_attend')) }}
						{{ Form::textarea('who_should_attend', $value = null , $attributes = array('class'=>'form-control ckeditor', 'rows'=>'2', 'placeholder' => getPhrase('who_should_attend'))) }}
					</fieldset>

				</div>
				<div class="row">
					<fieldset class="form-group  col-md-12">
						{{ Form::label('method_of_assessment', getphrase('method_of_assessment')) }}
						{{ Form::textarea('method_of_assessment', $value = null , $attributes = array('class'=>'form-control ckeditor', 'rows'=>'2', 'placeholder' => getPhrase('method_of_assessment'))) }}
					</fieldset>

				</div>
				<div class="row">
					<fieldset class="form-group  col-md-12">
						{{ Form::label('certification', getphrase('certification')) }}
						{{ Form::textarea('certification', $value = null , $attributes = array('class'=>'form-control ckeditor', 'rows'=>'2', 'placeholder' => getPhrase('certification'))) }}
					</fieldset>

				</div>
				<div class="row">
					<fieldset class="form-group  col-md-12">
						{{ Form::label('other_information', getphrase('other_information')) }}
						{{ Form::textarea('other_information', $value = null , $attributes = array('class'=>'form-control ckeditor', 'rows'=>'2', 'placeholder' => getPhrase('other_information'))) }}
					</fieldset>

				</div>
				<div class="row">
					<fieldset class="form-group col-md-12 faqs-check" >
						<input type="checkbox" name="faqs" id="faqs" value="yes" {!! (isset($record->faqs) && $record->faqs) ? 'checked' : '' !!} onclick="javascript:$('#faq_div').toggle(600);">
						<span>Add FAQ's</span>
					</fieldset>

				</div>
				<div class="row" id="faq_div" {!! (isset($record->faqs) && $record->faqs) ? 'style="display: block;"' : '' !!}>
					<div id="faq_sec">
						@if(isset($record->faqs) && $record->faqs)
							@foreach(json_decode($record->faqs) as $key=>$faqs)
								<div id="faq_sec_item{!! $key !!}">
									<fieldset class="form-group col-md-12 text-right">
										<button type="button" name="faqremoveit" id="faqremoveit" onclick="javascript:removefaqs({!! $key !!});" class="btn btn-xs btn-danger button">-</button>
									</fieldset>
									<fieldset class="form-group col-md-12" >
										<input type="text" name="question[]" id="question" class="form-control" value="{!! $faqs[0] !!}" placeholder="Question" />
									</fieldset>
									<fieldset class="form-group col-md-12">
										<textarea name="answer[]" id="answer" class="form-control" rows="5" placeholder="Answer">{!! $faqs[1] !!}</textarea>
									</fieldset>
								</div>
							@endforeach
						@else
							<div id="faq_sec_item1">
								<fieldset class="form-group col-md-12 text-right">
									<button type="button" name="faqremoveit" id="faqremoveit" onclick="javascript:removefaqs(1);" class="btn btn-xs btn-danger button">-</button>
								</fieldset>
								<fieldset class="form-group col-md-12" >
									<input type="text" name="question[]" id="question" class="form-control" placeholder="Question" />
								</fieldset>
								<fieldset class="form-group col-md-12">
									<textarea name="answer[]" id="answer" class="form-control" rows="5" placeholder="Answer"></textarea>
								</fieldset>
							</div>
						@endif
					</div>
					<fieldset class="form-group col-md-12 text-right">
						<input type="hidden" id="faqcount" value="1">
						<button type="button" name="faqaddit" id="faqaddit" class="btn btn-xs btn-primary button">+</button>
					</fieldset>
				</div>


					{{--<div  >
						<fieldset class="form-group ">
							{{ Form::label('sections', getphrase('sections')) }}
							<span class="text-red">*</span>
							{{Form::select('total_sections',$exam_max_options , null, ['class'=>'form-control', "id"=>"total_sections", "ng-model"=>"total_sections", "ng-change" => "sectionsChanged(total_sections)",
                            'required'=> 'true',
                            'ng-class'=>'{"has-error": formLms.total_sections.$touched && formLms.total_sections.$invalid}',
                             ])}}
							<div class="validation-error" ng-messages="formLms.total_sections.$error" >
								{!! getValidationMessage()!!}
							</div>
						</fieldset>

						<div class="row" data-ng-repeat="i in range(total_sections) track by $index" ng-if="total_sections > 0">

							<fieldset class="form-group col-md-4" >
								<label >Section @{{ $index+1 }}</label> <span class="text-red">*</span>
								<input type="text" name="sections[]" id="section_@{{ $index }}" class="form-control" placeholder="Section @{{ $index+1 }}" ng-model="sections[$index].option_value"  min=1
									   required="true" >
							</fieldset>


						</div>



					</div>--}}

   {{-- <div ng-app="sortableApp" ng-controller="sortableController" class="container">
        <h2>ui.sortable demo</h2>

        <div class="floatleft">
            <ul ui-sortable="sortableOptions" ng-model="list" class="list">
                <li ng-repeat="item in list" class="item">
                    @{{item.text}}
                </li>
            </ul>
        </div>

        <div class="floatleft" style="margin-left: 20px;">
            <ul class="list logList">
                <li ng-repeat="entry in sortingLog track by $index" class="logItem">
                    @{{entry}}
                </li>
            </ul>
        </div>

        <div class="clear"></div>

        <a href="javascript:void(0)" ng-click="addItem()">Add Item</a>
    </div>--}}










	<div class="buttons text-center">

							<button class="btn btn-lg btn-success button">{{ $button_name }}</button>

						</div>

		 
