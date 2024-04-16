

				<div class="row" id="imgdiv">



					<fieldset class="form-group col-md-4">

						<label for="name">User Name: </label><br />

						{!! (isset($record->user_name) && $record->user_name != "") ? $record->user_name : "" !!}

					</fieldset>

					<fieldset class="form-group col-md-4">

						<label for="user_email">User Email: </label><br />

						{!! (isset($record->user_email) && $record->user_email != "") ? $record->user_email : "" !!}

					</fieldset>

					<fieldset class="form-group col-md-4">

						<label for="user_phone">Phone #: </label><br />

						{!! (isset($record->user_phone) && $record->user_phone != "") ? $record->user_phone : "" !!}

					</fieldset>

					<fieldset class="form-group col-md-4">

						<label for="course_type">Course Type: </label><br />

						{!! (isset($record->course_type) && $record->course_type != "") ? $record->course_type : "" !!}

					</fieldset>

					<fieldset class="form-group col-md-4">

						<label for="transaction_id">Transaction Id: </label><br />

						{!! (isset($record->transaction_id) && $record->transaction_id != "") ? $record->transaction_id : "" !!}

					</fieldset>

					<fieldset class="form-group col-md-4">

						<label for="delivery_fee">Delivery Fee: </label><br />

						{!! (isset($record->delivery_fee) && $record->delivery_fee != "") ? $record->delivery_fee : "" !!}

					</fieldset>

					<fieldset class="form-group col-md-4">

						<label for="address1">Address1: </label><br />

						{!! (isset($record->address1) && $record->address1 != "") ? $record->address1 : "" !!}

					</fieldset>

					<fieldset class="form-group col-md-4">

						<label for="address2">Address2: </label><br />

						{!! (isset($record->address2) && $record->address2 != "") ? $record->address2 : "" !!}

					</fieldset>

					<fieldset class="form-group col-md-4">

						<label for="city">City: </label><br />

						{!! (isset($record->city) && $record->city != "") ? $record->city : "" !!}

					</fieldset>

					<fieldset class="form-group col-md-4">

						<label for="zipcode">Zipcode: </label><br />

						{!! (isset($record->zipcode) && $record->zipcode != "") ? $record->zipcode : "" !!}

					</fieldset>

					<fieldset class="form-group col-md-4">

						<label for="country">Country: </label><br />

						{!! (isset($record->country) && $record->country != "") ? $record->country : "" !!}

					</fieldset>

					<fieldset class="form-group col-md-4">

						<label for="payment_type">Payment Type: </label><br />

						{!! (isset($record->payment_type) && $record->payment_type != "") ? $record->payment_type : "" !!}

					</fieldset>

					<fieldset class="form-group col-md-12">

						<label for="certificate">Certificate: </label>

					</fieldset>

					<fieldset class="form-group col-md-12">
						@if(isset($record->certificate_file))
							<iframe
									src="{!! UPLOADS.'lms/certificate/'.$record->certificate_file !!}#zoom=FitH"
									frameBorder="0"
									scrolling="auto"
									height="600px"
									width="400px"
							></iframe>
						@else
							<img src="https://via.placeholder.com/250x324" width="250" height="324" style="border-radius: 8px;" />
						@endif
					</fieldset>

				</div>