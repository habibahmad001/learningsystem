

				<div class="row" id="imgdiv">



					<fieldset class="form-group col-md-4">

						<label for="name">First Name: </label><br />

						{!! (isset($record->first_name) && $record->first_name != "") ? $record->first_name : "" !!}

					</fieldset>

					<fieldset class="form-group col-md-4">

						<label for="user_email">Last Name: </label><br />

						{!! (isset($record->last_name) && $record->last_name != "") ? $record->last_name : "" !!}

					</fieldset>

					<fieldset class="form-group col-md-4">

						<label for="user_phone">Name: </label><br />

						{!! (isset($record->name) && $record->name != "") ? $record->name : "" !!}

					</fieldset>

					<fieldset class="form-group col-md-4">

						<label for="course_type">Email: </label><br />

						{!! (isset($record->email) && $record->email != "") ? $record->email : "" !!}

					</fieldset>

					<fieldset class="form-group col-md-4">

						<label for="transaction_id">Phone #: </label><br />

						{!! (isset($record->phone) && $record->phone != "") ? $record->phone : "" !!}

					</fieldset>

					<fieldset class="form-group col-md-4">

						<label for="delivery_fee">Subject: </label><br />

						{!! (isset($record->subject) && $record->subject != "") ? $record->subject : "" !!}

					</fieldset>

					<fieldset class="form-group col-md-4">

						<label for="address1">Country: </label><br />

						{!! (isset($record->country) && $record->country != "") ? $record->country : "" !!}

					</fieldset>

					<fieldset class="form-group col-md-4">

						<label for="address2">Message: </label><br />

						{!! (isset($record->message) && $record->message != "") ? $record->message : "" !!}

					</fieldset>

					<fieldset class="form-group col-md-4">

						<label for="city">Course Title: </label><br />

						{!! (isset($record->course_title) && $record->course_title != "") ? $record->course_title : "" !!}

					</fieldset>

					<fieldset class="form-group col-md-4">

						<label for="zipcode">Enquiry Type: </label><br />

						{!! (isset($record->enquiry_type) && $record->enquiry_type != "") ? $record->enquiry_type : "" !!}

					</fieldset>

					<fieldset class="form-group col-md-4">

						<label for="country">Posted At: </label><br />

						{!! (isset($record->created_at) && $record->created_at != "") ? date("F j, Y", strtotime($record->created_at)) : "" !!}

					</fieldset>

				</div>