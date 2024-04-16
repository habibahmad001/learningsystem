

				<div class="row">

					<fieldset class="form-group col-md-4">

						<label for="name">First Name:</label>

						<div>{!! (isset($record->f_name) && $record->f_name != "") ? $record->f_name : "" !!}</div>

					</fieldset>

					<fieldset class="form-group col-md-4">

						<label for="l_name">Last Name:</label>

						<div>{!! (isset($record->l_name) && $record->l_name != "") ? $record->l_name : "" !!}</div>

					</fieldset>


					<fieldset class="form-group col-md-4">

						<label for="c_name">Company Name:</label>

						<div>{!! (isset($record->c_name) && $record->c_name != "") ? $record->c_name : "" !!}</div>

					</fieldset>

					{{--<fieldset class="form-group">--}}

						{{--<label for="delegates">No of Delegates:</label>--}}

						{{--<div>{!! (isset($record->n_delegates) && $record->n_delegates != "") ? $record->n_delegates : "" !!}</div>--}}

					{{--</fieldset>--}}

					{{--<fieldset class="form-group">--}}

						{{--<label for="c_address">Complete Address:</label>--}}

						{{--<div>{!! (isset($record->c_address) && $record->c_address != "") ? $record->c_address : "" !!}</div>--}}

					{{--</fieldset>--}}

					{{--<fieldset class="form-group">--}}

						{{--<label for="city">City:</label>--}}

						{{--<div>{!! (isset($record->city) && $record->city != "") ? $record->city : "" !!}</div>--}}

					{{--</fieldset>--}}

					{{--<fieldset class="form-group">--}}

						{{--<label for="cs_region">County / State / Region:</label>--}}

						{{--<div>{!! (isset($record->cs_region) && $record->cs_region != "") ? $record->cs_region : "" !!}</div>--}}

					{{--</fieldset>--}}

					{{--<fieldset class="form-group">--}}

						{{--<label for="zip_code">ZIP / Postal Code:</label>--}}

						{{--<div>{!! (isset($record->zip_code) && $record->zip_code != "") ? $record->zip_code : "" !!}</div>--}}

					{{--</fieldset>--}}

					{{--<fieldset class="form-group">--}}

						{{--<label for="country">Country:</label>--}}

						{{--<div>{!! (isset($record->country) && $record->country != "") ? $record->country : "" !!}</div>--}}

					{{--</fieldset>--}}

					<fieldset class="form-group col-md-4">

						<label for="email">Email:</label>

						<div>{!! (isset($record->email) && $record->email != "") ? $record->email : "" !!}</div>

					</fieldset>

					<fieldset class="form-group col-md-4">

						<label for="contact">Contact:</label>

						<div>{!! (isset($record->contact) && $record->contact != "") ? $record->contact : "" !!}</div>

					</fieldset>

					<fieldset class="form-group col-md-4">

						<label for="contact">Job Title:</label>

						<div>{!! (isset($record->j_title) && $record->j_title != "") ? $record->j_title : "" !!}</div>

					</fieldset>

					{{--<fieldset class="form-group">--}}

						{{--<label for="training">Training Method:</label>--}}

						{{--<div>{!! (isset($record->training) && $record->training != "") ? $record->training : "" !!}</div>--}}

					{{--</fieldset>--}}

					{{--<fieldset class="form-group">--}}

						{{--<label for="expected">Expected Intake:</label>--}}

						{{--<div>{!! (isset($record->expected) && $record->expected != "") ? $record->expected : "" !!}</div>--}}

					{{--</fieldset>--}}

					{{--<fieldset class="form-group">--}}

						{{--<label for="methods">Training Method:</label>--}}

						{{--<div>{!! (isset($record->methods) && $record->methods != "") ? $record->methods : "" !!}</div>--}}

					{{--</fieldset>--}}

					<fieldset class="form-group col-md-4">

						<label for="msg">What are your training needs?</label>

						<div>{!! (isset($record->whatare) && $record->whatare != "") ? $record->whatare : "" !!}</div>

					</fieldset>

				</div>

				<div class="row">

					<div class="buttons text-center">

						<button type="button" class="btn btn-lg btn-success button" name="backbtn" id="backbtn" onclick="javascript: window.location.href = '{!! URL_CORPORATE !!}';"><< Back</button>

					</div>

		 		</div>