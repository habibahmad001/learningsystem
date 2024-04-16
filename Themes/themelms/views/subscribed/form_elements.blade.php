

				<div class="row" id="imgdiv">

					<fieldset class="form-group">

						<label for="offer_type">Offer Type</label>

						<span class="text-red">*</span>

						<select class="form-control" id="offer_type" name="offer_type" onchange="javascript: if($(this).val() == 'percentage') { $('.price-div').slideUp(300);$('.pagee-div').slideDown(300); } else { $('.price-div').slideDown(300);$('.pagee-div').slideUp(300);}">
							<option value="package" {!! (isset($record->offer_Type) && $record->offer_Type == "package") ? "selected" : "" !!}>Package</option>
							<option value="percentage" {!! (isset($record->offer_Type) && $record->offer_Type == "percentage") ? "selected" : "" !!}>Percentage</option>
							<option value="fixprice" {!! (isset($record->offer_Type) && $record->offer_Type == "fixprice") ? "selected" : "" !!}>Fixed Price</option>
							<option value="referral" {!! (isset($record->offer_Type) && $record->offer_Type == "referral") ? "selected" : "" !!}>Referral</option>
							<option value="weekly" {!! (isset($record->offer_Type) && $record->offer_Type == "weekly") ? "selected" : "" !!}>Weekly Deal</option>
						</select>

					</fieldset>

					<fieldset class="form-group">

						<label for="offername">Offer Name</label>

						<input type="text" name="offername" class="form-control" id="offername" value="{!! (isset($record->offer_name) && $record->offer_name != "") ? $record->offer_name : "" !!}" />

					</fieldset>

					<fieldset class="form-group price-div" {!! (isset($record->offer_Type) && $record->offer_Type == "percentage") ? 'style="display: none;"' : "" !!}>

						<label for="price">Package Price</label>

						<input type="text" name="price" class="form-control" id="price" value="{!! (isset($record->price) && $record->price != "") ? $record->price : "" !!}" />

					</fieldset>

					<div class="pagee-div" {!! (isset($record->offer_Type) && $record->offer_Type == "percentage") ? "" : 'style="display: none;"' !!}>

						<fieldset class="form-group">

							<label for="pagee">Percentage Value</label>

							<input type="text" name="pagee" class="form-control" id="pagee" value="{!! (isset($record->PercentAge) && $record->PercentAge != "") ? $record->PercentAge : "" !!}" />

						</fieldset>

						<fieldset class="form-group">

							<label for="active_status">Percentage Type</label>

							<span class="text-red">*</span>

							<select class="form-control" id="percentage_type" name="percentage_type">
								<option value="normal" {!! (isset($record->PercentageType) && $record->PercentageType == "normal") ? "selected" : "" !!}>Normal</option>
								<option value="highe" {!! (isset($record->PercentageType) && $record->PercentageType == "highe") ? "selected" : "" !!}>highest</option>
								<option value="cheap" {!! (isset($record->PercentageType) && $record->PercentageType == "cheap") ? "selected" : "" !!}>cheapest</option>
							</select>

						</fieldset>

					</div>

					<fieldset class="form-group">

						<label for="url">Offer Slug</label>

						<input type="text" name="url" class="form-control" id="url" value="{!! (isset($record->url) && $record->url != "") ? $record->url : "" !!}" />

					</fieldset>

					<fieldset class="form-group">

						<label for="img">Image</label>

						<input type="file" name="img" id="img" />
						<br />
						<img src="{!! (isset($record->avatar)) ? UPLOADS.'lms/series/offerbanner/'.$record->avatar : "https://via.placeholder.com/700x250" !!}" width="700" height="250" style="border-radius: 8px;" />

					</fieldset>

					<fieldset class="form-group">

						<label for="introText">Introduction Text</label>

						<textarea name="introText" id="introText" rows="10" class="form-control" placeholder="Some text here . . .">{!! (isset($record->introText) && $record->introText != "") ? $record->introText : "" !!}</textarea>

					</fieldset>

					<fieldset class="form-group">
						<label for="contentareafield">TERMS & CONDITIONS</label>
						{{ Form::textarea('contentareafield', $value = (isset($record->contentarea)) ? $record->contentarea : null , $attributes = array('class'=>'form-control ckeditor', 'rows'=>'5', 'placeholder' => getPhrase('TERMS & CONDITIONS'))) }}
					</fieldset>

					<fieldset class="form-group checkbox-setting">

						<label for="cat">Categories</label>

						@if(count(Select_All_Categories()) > 0)
							@foreach(Select_All_Categories() as $category)
								<div class="col-md-4">
									<input type="checkbox" name="cat[]" id="{!! $category->id !!}" data-cid="{!! $category->id !!}" class="catField" value="{!! $category->id !!}" @if(isset($record->Cat) && in_array($category->id, explode(",", json_decode($record->Cat, true)))) checked @endif /> {!! $category->category !!}
								</div>
							@endforeach
						@endif

					</fieldset>

					<fieldset class="form-group">

						<div class="col-md-5">
							<label for="someinput">All Courses</label>

							<span class="text-red">*</span>

							<input id="someinput" class="form-control" placeholder="Search Course Here . . ." />
							<br/>
							<select class="form-control select-cities" name="course1" id="optlist" style="min-height: 200px" multiple>
								@if(isset($record->id))
									@if(count(explode(",", json_decode($record->Cat, true))) > 0)
										{!! Edit_Select_Courses(explode(",", json_decode($record->Cat, true))) !!}
									@endif
								@else
									@if(count(Select_Paid_Courses()) > 0)
										@foreach(Select_Paid_Courses() as $course)
											<!--option value="{!! $course->id !!}">{!! $course->title !!}</option-->
										@endforeach
									@endif
								@endif
							</select>
						</div>
						<div class="col-md-2 shiftter-class">
							<i class="fas fa-angle-double-right"></i><br />
							<i class="fas fa-angle-double-left"></i>
						</div>

						<div class="col-md-5">
							<label for="someinput">Selected Courses</label>
							<input id="someinput1" class="form-control" placeholder="Search Course Here . . ."/><br/>

							<select class="form-control chosen-cities" name="coursename[]" id="optlist1" style="min-height: 200px" multiple>
								@if(isset($record->id))
									@foreach(explode(",", json_decode($record->offer_keys, true)) as $ids)
										<option value="{!! Select_Courses_On_ID($ids)->id !!}" selected>{!! Select_Courses_On_ID($ids)->title !!}</option>
									@endforeach
								@endif
							</select>
						</div>

					</fieldset>

					<fieldset class="form-group">

						<label for="noofcourse">Number of courses</label>

						<input type="text" name="noofcourse" class="form-control" id="noofcourse" value="{!! (isset($record->NoOfCourse) && $record->NoOfCourse != "") ? $record->NoOfCourse : "" !!}" />

					</fieldset>

					<fieldset class="form-group">

						<label for="active_status">Status</label>

						<span class="text-red">*</span>

						<select class="form-control" id="active_status" name="active_status">
							<option value="active" {!! (isset($record->offer_Activate) && $record->offer_Activate == "Active") ? "selected" : "" !!}>Active</option>
							<option value="inactive" {!! (isset($record->offer_Activate) && $record->offer_Activate == "Inactive") ? "selected" : "" !!}>Inactive</option>
						</select>

					</fieldset>

				</div>

				<div class="row">

					<div class="buttons text-center">

						<button class="btn btn-lg btn-success button" name="saveBTN" id="saveBTN">{{ $button_name }}</button>

					</div>

		 		</div>