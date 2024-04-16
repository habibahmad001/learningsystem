



					<fieldset class="form-group">

						<label for="offername">Role Title</label>

						<input type="text" name="name" class="form-control" id="name" value="{!! (isset($record->display_name) && $record->display_name != "") ? $record->display_name : "" !!}" />

					</fieldset>

					<fieldset class="form-group">

						<label for="price">Role Description</label>

						<input type="text" name="description" class="form-control" id="description" value="{!! (isset($record->description) && $record->description != "") ? $record->description : "" !!}" />

					</fieldset>

					<fieldset class="form-group">

						<input type="checkbox" name="is_admin" id="is_admin" class="permi-check" onclick="javascript: ($(this).is(':checked')) ? $('#permissions-div').slideUp(500) : $('#permissions-div').slideDown(500)" {!! (isset($record->role_permission) && $record->role_permission != NULL) ? "" : "checked" !!}>
						<span class="permi-check">Administrative Rights</span>
						<input type="hidden" name="id" id="id" value="{!! (isset($record->id) && $record->id != "") ? $record->id : "" !!}">

					</fieldset>

					@php $selectedRoles = (isset($record->role_permission) && $record->role_permission != NULL) ? $record->role_permission : "" @endphp


					<div class="permissions-div" id="permissions-div">

					@foreach(App\Role::getPermission() as $k=>$v)

					<fieldset class="form-group">

						<input type="checkbox" name="permi[]" id="permi-{!! $k !!}" value="{!! $v->name !!}" class="permi-check" {!! (strpos($selectedRoles, $v->name) !== FALSE) ? "checked" : "" !!}>
						<span class="permi-check">{!! $v->display_name !!}</span>

					</fieldset>

					@endforeach

					</div>


					<div class="buttons text-center">
						<button class="btn btn-lg btn-success button" name="saveBTN" id="saveBTN">{{ $button_name }}</button>
					</div>

