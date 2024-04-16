 					
 					 <fieldset class="form-group col-md-6">
						
						{{ Form::label('category', getphrase('category_name')) }}
						<span class="text-red">*</span>
						{{ Form::text('category', $value = null , $attributes = array('class'=>'form-control',
						'placeholder' => getPhrase('enter_category_name'),
						'ng-model'=>'level',
							'required'=> 'true', 
							'ng-pattern' => getRegexPattern("title"),
							'ng-minlength' => '2',
							'ng-maxlength' => '60',
							'ng-class'=>'{"has-error": formLms.category.$touched && formLms.category.$invalid}',

						)) }}
						<div class="validation-error" ng-messages="formLms.category.$error" >
	    					{!! getValidationMessage()!!}
	    					{!! getValidationMessage('minlength')!!}
	    					{!! getValidationMessage('maxlength')!!}
	    					{!! getValidationMessage('pattern')!!}
						</div>
					</fieldset>
					 <fieldset class="form-group col-md-6 " >

						 {{ Form::label('parent_id', 'Parent Category') }}



						 {{Form::select('parent_id', $categories,  $value = null , ['placeholder' => getPhrase('None'),'class'=>'form-control',

                         'ng-model'=>'parent_id',
						 'ng-class'=>'{"has-error": formLms.parent_id.$touched && formLms.parent_id.$invalid}',



                         ]) }}

						 <div class="validation-error" ng-messages="formLms.parent_id.$error" >

							 {!! getValidationMessage()!!}

						 </div>





					 </fieldset>
 					  <fieldset class="form-group col-md-4" >
				   {{ Form::label('category', getphrase('image')) }}
				         <input type="file" class="form-control" name="catimage"
				          accept=".png,.jpg,.jpeg" id="image_input">

					  </fieldset>
				     <fieldset class="form-group  col-md-2" >
					@if($record)	
				   		@if($record->image)
				         
				         <img src="{{ IMAGE_PATH_UPLOAD_LMS_CATEGORIES.$record->image }}" height="100" width="100">
				         @endif
				     @endif

					 </fieldset>
					 <fieldset class="form-group col-md-6">

						 {{ Form::label('category icon', getphrase('category_icon')) }}
						 {{--<span class="text-red">*</span>
						 {{ Form::text('category_icon', $value = null , $attributes = array('class'=>'form-control', 'role'=>'iconpicker', 'id'=>'target22',
                         'placeholder' => getPhrase('select_category_icon'),
                         'ng-model'=>'category_icon',

                             'ng-class'=>'{"has-error": formLms.category_icon.$touched && formLms.category_icon.$invalid}',

                         )) }}
						 <div class="validation-error" ng-messages="formLms.category_icon.$error" >

						 </div>--}}
						 <button id="target" type="button" class="btn btn-primary iconpicker dropdown-toggle" data-placement="right" style="margin-left: 30px;" data-original-title="" title="" aria-describedby="popover3984">
							 <i class="fas fa-address-book"></i>
							 <input type="hidden"  value="fas fa-address-book"><span class="caret"></span></button>
						 <input type="hidden" id="icon_name" name="icon_name" value="fas fa-address-book"><span class="caret"></span></button>
					 </fieldset>



					<fieldset class="form-group col-md-12">
						
						{{ Form::label('description', getphrase('description')) }}
						
						{{ Form::textarea('description', $value = null , $attributes = array('class'=>'form-control', 'rows'=>'5', 'placeholder' => 'Description')) }}
					</fieldset>
					 <fieldset class="form-group col-md-12">


						<div class="buttons text-center">
							<button class="btn btn-lg btn-success button"
							ng-disabled='!formLms.$valid'>{{ $button_name }}</button>
						</div>
					 </fieldset>