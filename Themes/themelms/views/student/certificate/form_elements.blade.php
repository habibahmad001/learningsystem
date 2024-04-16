

				<div class="row" id="imgdiv">



					<fieldset class="form-group">

						<label for="name">User Name</label>

						<input type="text" name="name" class="form-control" id="name" value="{!! (isset($record->user_name) && $record->user_name != "") ? $record->user_name : "" !!}" disabled="disabled" />

					</fieldset>

					<fieldset class="form-group">

						<label for="user_email">User Email</label>

						<input type="text" name="user_email" class="form-control" id="user_email" value="{!! (isset($record->user_email) && $record->user_email != "") ? $record->user_email : "" !!}" disabled="disabled" />

					</fieldset>

					<fieldset class="form-group">

						<label for="user_phone">Phone #</label>

						<input type="text" name="user_phone" class="form-control" id="user_phone" value="{!! (isset($record->user_phone) && $record->user_phone != "") ? $record->user_phone : "" !!}" disabled="disabled" />

					</fieldset>

					<fieldset class="form-group">

						<label for="course_type">Course Type</label>

						<input type="text" name="course_type" class="form-control" id="course_type" value="{!! (isset($record->course_type) && $record->course_type != "") ? $record->course_type : "" !!}" disabled="disabled" />

					</fieldset>

					<fieldset class="form-group">

						<label for="transaction_id">Transaction Id</label>

						<input type="text" name="transaction_id" class="form-control" id="transaction_id" value="{!! (isset($record->transaction_id) && $record->transaction_id != "") ? $record->transaction_id : "" !!}" disabled="disabled" />

					</fieldset>

					<fieldset class="form-group">

						<label for="delivery_fee">Delivery Fee</label>

						<input type="text" name="delivery_fee" class="form-control" id="delivery_fee" value="{!! (isset($record->delivery_fee) && $record->delivery_fee != "") ? $record->delivery_fee : "" !!}" disabled="disabled" />

					</fieldset>

					<fieldset class="form-group">

						<label for="certificate">Certificate</label>

					</fieldset>

                    <fieldset class="form-group">
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

					<fieldset class="form-group">

						<label for="address1">Address1</label>

						<input type="text" name="address1" class="form-control" id="address1" value="{!! (isset($record->address1) && $record->address1 != "") ? $record->address1 : "" !!}" disabled="disabled" />

					</fieldset>

					<fieldset class="form-group">

						<label for="address2">Address2</label>

						<input type="text" name="address2" class="form-control" id="address2" value="{!! (isset($record->address2) && $record->address2 != "") ? $record->address2 : "" !!}" disabled="disabled" />

					</fieldset>

					<fieldset class="form-group">

						<label for="city">City</label>

						<input type="text" name="city" class="form-control" id="city" value="{!! (isset($record->city) && $record->city != "") ? $record->city : "" !!}" disabled="disabled" />

					</fieldset>

					<fieldset class="form-group">

						<label for="zipcode">Zipcode</label>

						<input type="text" name="zipcode" class="form-control" id="zipcode" value="{!! (isset($record->zipcode) && $record->zipcode != "") ? $record->zipcode : "" !!}" disabled="disabled" />

					</fieldset>

					<fieldset class="form-group">

						<label for="country">Country</label>

						<input type="text" name="country" class="form-control" id="country" value="{!! (isset($record->country) && $record->country != "") ? $record->country : "" !!}" disabled="disabled" />

					</fieldset>

					<fieldset class="form-group">

						<label for="payment_type">Payment Type</label>

						<input type="text" name="payment_type" class="form-control" id="payment_type" value="{!! (isset($record->payment_type) && $record->payment_type != "") ? $record->payment_type : "" !!}" disabled="disabled" />

					</fieldset>

				</div>