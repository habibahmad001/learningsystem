

				<div class="row">

					<fieldset class="form-group">

						<label for="name">Name:</label>

						<div>{!! (isset($record->f_name) && $record->f_name != "") ? $record->f_name : "" !!}</div>

					</fieldset>

					<fieldset class="form-group price-div" {!! (isset($record->offer_Type) && $record->offer_Type == "percentage") ? 'style="display: none;"' : "" !!}>

						<label for="email">Email:</label>

						<div>{!! (isset($record->std_email) && $record->std_email != "") ? $record->std_email : "" !!}</div>

					</fieldset>


					<fieldset class="form-group">

						<label for="contact">Telephone Number:</label>

						<div>{!! (isset($record->std_tel) && $record->std_tel != "") ? $record->std_tel : "" !!}</div>

					</fieldset>

					<fieldset class="form-group">

						<label for="dob">Date of Birth:</label>

						<div>{!! (isset($record->std_dob) && $record->std_dob != "") ? $record->std_dob : "" !!}</div>

					</fieldset>

					<fieldset class="form-group">

						<label for="adinfo">Additional Information:</label>

						<div>{!! (isset($record->std_adInfo) && $record->std_adInfo != "") ? $record->std_adInfo : "" !!}</div>

					</fieldset>

					<fieldset class="form-group">

						<label for="adinfo">Address:</label>

						<div>{!! (isset($record->std_address) && $record->std_address != "") ? $record->std_address : "" !!}</div>

					</fieldset>

					<fieldset class="form-group">

						<label for="add2">Address 2:</label>

						<div>{!! (isset($record->std_address2) && $record->std_address2 != "") ? $record->std_address2 : "" !!}</div>

					</fieldset>

					<fieldset class="form-group">

						<label for="city">City:</label>

						<div>{!! (isset($record->std_city) && $record->std_city != "") ? $record->std_city : "" !!}</div>

					</fieldset>

					<fieldset class="form-group">

						<label for="zipcode">Zip Code:</label>

						<div>{!! (isset($record->std_zipcode) && $record->std_zipcode != "") ? $record->std_zipcode : "" !!}</div>

					</fieldset>

					<fieldset class="form-group">

						<label for="country">Country:</label>

						<div>{!! (isset($record->std_country) && $record->std_country != "") ? $record->std_country : "" !!}</div>

					</fieldset>

				</div>

				<div class="row">

					<div class="buttons text-center">

						<button type="button" class="btn btn-lg btn-success button" name="backbtn" id="backbtn" onclick="javascript: window.location.href = '{!! URL_STUDENT_ID !!}';"><< Back</button>

					</div>

		 		</div>