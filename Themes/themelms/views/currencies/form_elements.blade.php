 					

					<fieldset class="form-group ">

						{{ Form::label('Country', getphrase('Country')) }}
						<span class="text-red">*</span>
						{{--<select class="form-control"  required="required" id="country" name="country">
							<option value="">Please Select...</option>
                            <?php foreach ($countries as $key=>$countryname): ?>
							<option @if($countryname->id==old('country')) selected="selected" @endif value="<?php echo $countryname->id; ?>"><?php  echo $countryname->nicename  ; ?></option>
                            <?php endforeach; ?>
						</select>--}}
						{{Form::select('country_id', $countries, null, ['placeholder' => getPhrase('select'),'class'=>'form-control',
                                 'ng-model'=>'country_id',
                                     'required'=> 'true',
                                     'ng-class'=>'{"has-error": formQuiz.country_id.$touched && formQuiz.country_id.$invalid}',

                                 ]) }}
						<div class="validation-error" ng-messages="formQuiz.country_id.$error" >
							{!! getValidationMessage()!!}
						</div>
					</fieldset>

					<fieldset class="form-group ">

						{{ Form::label('currency_name', getphrase('currency_name')) }}

						<span class="text-red">*</span>

						{{ Form::text('currency_type', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase('currency_name like US DOllar'),
							'ng-model'=>'currency_type',
							'required'=> 'true',
							'ng-class'=>'{"has-error": formQuiz.currency_type.$touched && formQuiz.currency_type.$invalid}',
							'ng-maxlength' => '250',
						)) }}

						<div class="validation-error" ng-messages="formQuiz.currency_type.$error" >
							{!! getValidationMessage()!!}
							{!! getValidationMessage('maxlength')!!}
						</div>

					</fieldset>
					<div class="row">
					<fieldset class="form-group  col-md-6">

						{{ Form::label('currency_short', getphrase('currency_short')) }}

						<span class="text-red">*</span>

						{{ Form::text('currency_short', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase('currency_short like USD'),
							'ng-model'=>'currency_short',
							'required'=> 'true',
							'ng-class'=>'{"has-error": formQuiz.currency_short.$touched && formQuiz.currency_short.$invalid}',
							'ng-maxlength' => '4',
						)) }}

						<div class="validation-error" ng-messages="formQuiz.currency_short.$error" >
							{!! getValidationMessage()!!}
							{!! getValidationMessage('maxlength')!!}
						</div>

					</fieldset>

					<fieldset class="form-group col-md-6">

						{{ Form::label('currency_symbol icon', getphrase('currency_symbol')) }}<span class="text-red">*</span>

						<button id="target" type="button" class="btn btn-primary iconpicker dropdown-toggle" data-placement="right" style="margin-left: 30px;" data-original-title="" title="" aria-describedby="popover3984">
							<i class="fas fa-address-book"></i>
							<input type="hidden"  value="fas fa-address-book"><span class="caret"></span></button>
						<input type="hidden" id="currency_symbol" name="currency_symbol" value="fas fa-address-book"><span class="caret"></span></button>
					</fieldset>
					</div>

                        <?php
                        $date_from = date('Y/m/d');
                        if($record){
								$date_from = $record->affected_from;
						}
						?>
					<div class="row">
						<fieldset class="form-group   col-md-6 input-daterange " id="dp">
							{{ Form::label('affected_from', getphrase('affected_from')) }}<span class="text-red">*</span>
							{{ Form::text('affected_from', $value = $date_from , $attributes = array('class'=>'input-sm form-control', 'placeholder' => 'like 2015/7/17',
							'ng-model'=>'affected_from',
							'ng-pattern'=>getRegexPattern('date'),
							'required'=> 'true',
							'ng-class'=>'{"has-error": formQuiz.affected_from.$touched && formQuiz.affected_from.$invalid}'
							)) }}
							<div class="validation-error" ng-messages="formQuiz.affected_from.$error" >
								{!! getValidationMessage()!!}
								{!! getValidationMessage('pattern')!!}
							</div>
						</fieldset>
						<fieldset class="form-group  col-md-6">

							{{ Form::label('rate', getphrase('rate')) }}

							<span class="text-red">*</span>

							{{ Form::text('rate', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase('rate like 1.37'),
                                'ng-model'=>'rate',
                                'ng-pattern'=>getRegexPattern('float'),
                                'required'=> 'true',
                                'ng-class'=>'{"has-error": formQuiz.rate.$touched && formQuiz.rate.$invalid}',
                                'ng-maxlength' => '50',
                            )) }}

							<div class="validation-error" ng-messages="formQuiz.rate.$error" >
								{!! getValidationMessage()!!}
								{!! getValidationMessage('pattern')!!}
							</div>

						</fieldset>
					</div>

					<fieldset class="form-group ">

						<?php $status = array('Active' =>'Active', 'Inactive' => 'Inactive', );?>

						{{ Form::label('status', getphrase('status')) }}

						<span class="text-red">*</span>

						{{Form::select('status', $status, null, ['class'=>'form-control'])}}

					</fieldset>




		 	<div class="buttons text-center">

				<button class="btn btn-lg btn-success button"

				ng-disabled='!formQuiz.$valid'>{{ $button_name }}</button>

			</div>