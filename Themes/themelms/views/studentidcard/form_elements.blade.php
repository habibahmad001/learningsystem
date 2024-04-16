

				<div class="row" id="imgdiv">

					<fieldset class="form-group  col-md-4">

						<label for="offer_type">Student name</label><br />

						{!! $record->f_name !!}

					</fieldset>

					<fieldset class="form-group col-md-4">

						<label for="user_email">Student Email: </label><br />

						{!! (isset($record->std_email) && $record->std_email != "") ? $record->std_email : "" !!}

					</fieldset>

					<fieldset class="form-group col-md-4">

						<label for="user_phone">Phone #: </label><br />

						{!! (isset($record->std_tel) && $record->std_tel != "") ? $record->std_tel : "" !!}

					</fieldset>

					<fieldset class="form-group col-md-4">

						<label for="course_type">Date of Birth: </label><br />

						{!! (isset($record->std_dob) && $record->std_dob != "") ? $record->std_dob : "" !!}

					</fieldset>

					<fieldset class="form-group col-md-4">

						<label for="transaction_id">Additional Info: </label><br />

						{!! (isset($record->std_adInfo) && $record->std_adInfo != "") ? $record->std_adInfo : "" !!}

					</fieldset>
					<fieldset class="form-group col-md-4">

						<label for="transaction_id">Address: </label><br />

						{!! (isset($record->std_address) && $record->std_address != "") ? $record->std_address : "" !!}

					</fieldset>

					<fieldset class="form-group col-md-4">

						<label for="transaction_id">Address 2: </label><br />

						{!! (isset($record->std_address2) && $record->std_address2 != "") ? $record->std_address2 : "" !!}

					</fieldset>
					<fieldset class="form-group col-md-4">

						<label for="transaction_id">City: </label><br />

						{!! (isset($record->std_city) && $record->std_city != "") ? $record->std_city : "" !!}

					</fieldset>
					<fieldset class="form-group col-md-4">

						<label for="transaction_id">Zipcode: </label><br />

						{!! (isset($record->std_zipcode) && $record->std_zipcode != "") ? $record->std_zipcode : "" !!}

					</fieldset>
					<fieldset class="form-group col-md-4">

						<label for="transaction_id">Country: </label><br />

						{!! (isset($record->std_country) && $record->std_country != "") ? $record->std_country : "" !!}

					</fieldset>
					<fieldset class="form-group  col-md-4">

						<label for="img">Image</label><br>

						 <img id="photoimage" alt="{{$record->f_name}}" src="{{getPhotoPath($record->img,'thumb')}}"  /><br>
                        <?php
                        $filename_from_url = parse_url(getPhotoPath($record->img,'thumb'));
                        $ext = pathinfo($filename_from_url['path'], PATHINFO_EXTENSION);
                        ?>
						{{--<button id="downloadimg" class="d-none" data-id="{{$record->id}}"  >Download Image</button>--}}
                        <a  href="{{url('/savephoto/'.$record->id)}}" target="_blank" download="{{str_slug($record->f_name).'-'.$record->id.'.'.$ext}}">

                            Download Photo</a>
					</fieldset>


					<fieldset class="form-group  col-md-4">

						<label for="introText">Payment Method</label>
						{!! (isset($record->payment_method) && $record->payment_method != "") ? $record->payment_method : "" !!}

					</fieldset>


					<fieldset class="form-group  col-md-4">

						<label for="active_status">Payment Status</label>

						<?php
                        $rec = '';
                        if($record->payment_status==PAYMENT_STATUS_CANCELLED)
                            $rec = '<span class="label label-danger">'.ucfirst($record->payment_status).'</span>';
						elseif($record->payment_status==PAYMENT_STATUS_PENDING)
                            $rec = '<span class="label label-info">'.ucfirst($record->payment_status).'</span>';
						elseif($record->payment_status==PAYMENT_STATUS_SUCCESS)
                            $rec = '<span class="label label-success">'.ucfirst($record->payment_status).'</span>';

                        echo $rec;
						?>

					</fieldset>

				</div>

