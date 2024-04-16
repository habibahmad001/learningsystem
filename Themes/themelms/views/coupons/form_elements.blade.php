 					

 				

					<div class="row">

 					 <fieldset class="form-group col-md-6">

						{{ Form::label('title', getphrase('title')) }}

						<span class="text-red">*</span>

						{{ Form::text('title', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase('title'),

							'ng-model'=>'title',

							'required'=> 'true', 

							'ng-class'=>'{"has-error": formQuiz.title.$touched && formQuiz.title.$invalid}',

							'ng-minlength' => '4',

							'ng-maxlength' => '60',

							)) }}

						<div class="validation-error" ng-messages="formQuiz.title.$error" >

	    					{!! getValidationMessage()!!}

	    					{!! getValidationMessage('pattern')!!}

	    					{!! getValidationMessage('minlength')!!}

	    					{!! getValidationMessage('maxlength')!!}

						</div>

					</fieldset>

					

					<fieldset class="form-group col-md-6">

						

						{{ Form::label('coupon_code', getphrase('coupon_code')) }}

						<span class="text-red">*</span>

						{{ Form::text('coupon_code', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase('coupon_code'),

							'ng-model'=>'coupon_code', 

							'required'=> 'true', 

							'ng-class'=>'{"has-error": formQuiz.coupon_code.$touched && formQuiz.coupon_code.$invalid}',

							'ng-minlength' => '2',

							'ng-maxlength' => '20',

							)) }}

						<div class="validation-error" ng-messages="formQuiz.coupon_code.$error" >

	    					{!! getValidationMessage()!!}

	    					{!! getValidationMessage('pattern')!!}

	    					{!! getValidationMessage('minlength')!!}

	    					{!! getValidationMessage('maxlength')!!}

						</div>

					</fieldset>

				 </div>

				 <div class="row">

					<fieldset class="form-group col-md-6">

						<?php $discount_types = array('value' => getPhrase('value'), 'percent' => getPhrase('percent'), );?>

						{{ Form::label('discount_type', getphrase('discount_type')) }}

						<span class="text-red">*</span>

						{{Form::select('discount_type', $discount_types, null, ['class'=>'form-control'])}}

						

					</fieldset> 

					 <fieldset class="form-group col-md-6">

							

							{{ Form::label('discount_value', getphrase('discount_value')) }}

							<span class="text-red">*</span>

							{{ Form::number('discount_value', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase('enter_value'),
                            'min'=>1,
							'ng-model'=>'discount_value', 

							'required'=> 'true', 

							'ng-class'=>'{"has-error": formQuiz.discount_value.$touched && formQuiz.discount_value.$invalid}',

							 

							)) }}

						<div class="validation-error" ng-messages="formQuiz.discount_value.$error" >

	    					{!! getValidationMessage()!!}

	    					{!! getValidationMessage('number')!!}

						</div>

					</fieldset>

					</div>

					<div class="row">

					 <fieldset class="form-group col-md-6">

							

							{{ Form::label('minimum_bill', getphrase('minimum_bill')) }}

							{{--<span class="text-red">*</span>--}}

							{{ Form::number('minimum_bill', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase('enter_minimum_bill'),
                            'min'=>1,
							'ng-model'=>'minimum_bill',
							 

							)) }}

						<div class="validation-error" ng-messages="formQuiz.minimum_bill.$error" >

	    					{!! getValidationMessage()!!}

	    					{!! getValidationMessage('number')!!}

						</div>

					</fieldset>





					 <fieldset class="form-group col-md-6">

							

							{{ Form::label('discount_maximum_amount', getphrase('discount_maximum_amount')) }}

							{{--<span class="text-red">*</span>--}}

							{{ Form::number('discount_maximum_amount', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase('enter_maximum_amount'),
								'min'=>1,
							'ng-model'=>'discount_maximum_amount',
							 

							)) }}

						<div class="validation-error" ng-messages="formQuiz.discount_maximum_amount.$error" >

	    					{!! getValidationMessage()!!}

	    					{!! getValidationMessage('number')!!}

						</div>

					</fieldset>

					</div>

 			

 			 <div class="row input-daterange" id="dp">

		 	<?php 

		 	$date_from = date('Y/m/d');

		 	$date_to = date('Y/m/d');

		 	if($record)

		 	{

		 		$date_from = $record->valid_from;

		 		$date_to = $record->valid_to;

		 	}

		 	 ?>

  				 <fieldset class="form-group col-md-6">

                                     

                        {{ Form::label('valid_from', getphrase('valid_from')) }}

                     

                        {{ Form::text('valid_from', $value = $date_from , $attributes = array('class'=>'input-sm form-control', 'id'=>'date_from', 'placeholder' => '2015/7/17')) }}

                            
                       

                        </fieldset>



  				 <fieldset class="form-group col-md-6">

                                     

                        {{ Form::label('valid_to', getphrase('valid_to')) }}

                       

                        {{ Form::text('valid_to', $value = $date_to , $attributes = array('class'=>'input-sm form-control', 'id'=>'date_to', 'placeholder' => '2015/7/17')) }}
 
                     

                        </fieldset>

				</div>



				<div class="row">

					 <fieldset class="form-group col-md-6">

							

							{{ Form::label('usage_limit', getphrase('usage_limit')) }}

							<span class="text-red">*</span>

							{{ Form::number('usage_limit', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase('enter_usage_limit_per_user'),
								'min'=>1,
							'ng-model'=>'usage_limit',
							'required'=> 'true',
							'ng-class'=>'{"has-error": formQuiz.usage_limit.$touched && formQuiz.usage_limit.$invalid}',

							 

							)) }}

						<div class="validation-error" ng-messages="formQuiz.usage_limit.$error" >

	    					{!! getValidationMessage()!!}

	    					{!! getValidationMessage('number')!!}

						</div>

					</fieldset>



				<fieldset class="form-group col-md-6">

						<?php $status = array('Active' =>'Active', 'Inactive' => 'Inactive', );?>

						{{ Form::label('status', getphrase('status')) }}

						<span class="text-red">*</span>

						{{Form::select('status', $status, null, ['class'=>'form-control'])}}

						

				</fieldset>



				</div>
					<div class="row">
						<fieldset class="form-group col-md-12 field-selected-checkbox ">
							<input type="checkbox" name="forselectedcourses" id="forselectedcourses" onclick="javascript: ($(this).is(':checked')) ? $('#coursesection').show(300) : $('#coursesection').hide(300)" {!! (isset($record->selectcourses) && !empty($record->selectcourses)) ? "checked" : "" !!} />
							<span>Apply Selected Courses</span>
						</fieldset>
					</div>

					<div class="row">
						<fieldset class="form-group promotion-courses course homeandcourse" id="coursesection" {!! (isset($record->selectcourses) && !empty($record->selectcourses)) ? "" : "style='display:none;'" !!}>

							<div class="col-md-5">
								<label for="someinput">All Courses</label>

								<span class="text-red">*</span>

								<input type="text" id="allcourse" name="allcourse" class="form-control" placeholder="Search Course Here . . ." />
								<br/>
								<select class="form-control" name="course[]" id="course" style="min-height: 200px" multiple>
									@if(count(Select_Paid_Courses()) > 0)
										@foreach(Select_Paid_Courses() as $course)
											@if(!in_array($course->id, explode(",", json_decode($course->selectcourses, true))))
												<option value="{!! $course->id !!}">{!! $course->title !!}</option>
											@endif
										@endforeach
									@endif
								</select>
							</div>
							<div class="col-md-2 shiftter-class">
								<i class="fas fa-angle-double-right"></i><br />
								<i class="fas fa-angle-double-left"></i>
							</div>

							<div class="col-md-5">
								<label for="someinput">Selected Courses</label>
								<input type="text" id="selectedcourse" name="selectedcourse" class="form-control" placeholder="Search Course Here . . ."/><br/>

								<select class="form-control chosen-cities" name="coursename[]" id="coursename" style="min-height: 200px" multiple>
									@if(isset($record->id))
										@if($record->selectcourses)
											@foreach(explode(",", json_decode($record->selectcourses, true)) as $ids)
												<option value="{!! Select_Courses_On_ID($ids)->id !!}" selected>{!! Select_Courses_On_ID($ids)->title !!}</option>
											@endforeach
										@endif
									@endif
								</select>
							</div>

						</fieldset>
					</div>

					<div class="row">
						<input type="hidden" name="applicability" value="lms">
					</div>

  				  





						<div class="buttons text-center">

							<button id="saveBTN" class="btn btn-lg btn-success button"

							ng-disabled='!formQuiz.$valid'>{{ $button_name }}</button>

						</div>

		 