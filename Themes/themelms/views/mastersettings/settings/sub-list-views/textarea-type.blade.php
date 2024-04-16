<div class="col-md-12">
 <fieldset class="form-group">
	{{ Form::label($key, getPhrase($key)) }}
	<textarea rows="15" name="{{$key}}[value]" class="form-control ckeditor">{{$value->value}}</textarea>
						  
	<input type="hidden" name="{{$key}}[type]" value = "{{$value->type}}" >
<input type="hidden" name="{{$key}}[tool_tip]" value = "{{$value->tool_tip}}" >
</fieldset>
</div>