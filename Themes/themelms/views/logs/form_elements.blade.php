

				<div class="row">

					<fieldset class="form-group">

						<label for="offername">User Name: {!! (isset($records->user_id) && $records->user_id != "") ? GetUserOnID($records->user_id)->first_name . " " . GetUserOnID($records->user_id)->last_name . " #$records->user_id (" . GetRoleOnID(GetUserOnID($records->user_id)->role_id)->display_name . ")" : "" !!}</label>

					</fieldset>

					<fieldset class="form-group">

						<label for="price">Record ID: {!! (isset($records->operation_id) && $records->operation_id != "") ? $records->table_name . ": " . $records->operation_id : "" !!}</label>

					</fieldset>

					<fieldset class="form-group">

						<label for="price">Message: {!! (isset($records->message) && $records->message != "") ? $records->message : "" !!}</label>

					</fieldset>

					<fieldset class="form-group">

						<label for="price">Data JSON:</label>
						<div>{!! (isset($records->data_json) && $records->data_json != "") ? "<pre>" . $records->data_json . "</pre>" : "" !!}</div>

					</fieldset>

					<fieldset class="form-group">

						<label for="price">Model JSON:</label>
						<div>{!! (isset($records->model_json) && $records->model_json != "") ? "<pre>" . $records->model_json . "</pre>" : "" !!}</div>

					</fieldset>

				</div>