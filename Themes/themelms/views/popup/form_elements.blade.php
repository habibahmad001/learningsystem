

				<div class="row">

					<fieldset class="form-group">

						<label for="promotionname">Promotion Name</label>

						<input type="text" name="promotionname" placeholder="Promotion Name here . . ." class="form-control" id="promotionname" value="{!! (isset($record->PromotionName) && $record->PromotionName != "") ? $record->PromotionName : "" !!}" />

					</fieldset>

					<fieldset class="form-group">

						<label for="promotion_type">Promotion Type</label>

						<span class="text-red">*</span>

						<select class="form-control" id="promotion_type" name="promotion_type" onchange="javascript: $('.promotion-content').slideUp(300);$('#' + $(this).val()).slideDown(300);">
							<option value="text" {!! (isset($record->PromotionType) && $record->PromotionType == "text") ? "selected" : "" !!}>Text</option>
							<option value="image" {!! (isset($record->PromotionType) && $record->PromotionType == "image") ? "selected" : "" !!}>Image</option>
							<option value="video" {!! (isset($record->PromotionType) && $record->PromotionType == "video") ? "selected" : "" !!}>Video</option>
							<option value="iframe" {!! (isset($record->PromotionType) && $record->PromotionType == "iframe") ? "selected" : "" !!}>Iframe</option>
						</select>

					</fieldset>

					<fieldset class="form-group promotion-content" id="text" {!! (isset($record->PromotionType) && $record->PromotionType == "text") ? "" : 'style="display: none;"' !!}>

						<label for="promotiontext">Promotion Text</label>

						{{ Form::textarea('promotiontext', $value = (isset($record->PromotionType) && $record->PromotionType == "text" && $record->PromotionContent != "") ? $record->PromotionContent : "" , $attributes = array('class'=>'form-control ckeditor editor1', 'id'=>'promotiontext', 'rows'=>'5', 'placeholder' => getPhrase('Promotion Text'))) }}

					</fieldset>

					<fieldset class="form-group promotion-content" id="image" {!! (isset($record->PromotionType) && $record->PromotionType == "image") ? "" : 'style="display: none;"' !!}>

						<label for="promotionimage">Promotion Image</label>

						<input type="file" name="img" id="img" />

						<img src="{!! (isset($record->PromotionType) && $record->PromotionType == "image" && $record->PromotionContent != "") ? UPLOADS . 'lms/PopupIMG/' . $record->PromotionContent : "https://via.placeholder.com/480x335" !!}" width="480" height="335" style="border-radius: 8px;" /><br />

						<label for="promotiontext">Offer Link</label>

						<input type="text" name="imglinkfield" placeholder="https://nextlearnacademy.com/offers/offer-for-3" class="form-control" id="imglinkfield" value="{!! (isset($record->imglink) && $record->imglink != "") ? $record->imglink : "" !!}" />
					</fieldset>

					<fieldset class="form-group promotion-content" id="video" {!! (isset($record->PromotionType) && $record->PromotionType == "video") ? "" : 'style="display: none;"' !!}>

						<label for="promotionvideo">Promotion Video</label>

						<textarea name="promotionvideo" placeholder="https://www.youtube.com/embed/Jfrjeg26Cwk" class="form-control" id="promotionvideo">{!! (isset($record->PromotionType) && $record->PromotionType == "video" && $record->PromotionContent != "") ? $record->PromotionContent : "" !!}</textarea>

					</fieldset>

					<fieldset class="form-group promotion-content" id="iframe" {!! (isset($record->PromotionType) && $record->PromotionType == "iframe") ? "" : 'style="display: none;"' !!}>

						<label for="promotioniframe">Promotion Iframe</label>

						<textarea name="promotioniframe" placeholder="Copy and past iframe code here . . ." class="form-control" id="promotioniframe">{!! (isset($record->PromotionType) && $record->PromotionType == "iframe" && $record->PromotionContent != "") ? $record->PromotionContent : "" !!}</textarea>

					</fieldset>

					<div class="row">
						<fieldset class="form-group col-md-6">

							<label for="price">Promotion Start Date</label>

							<input type="text" name="psd" placeholder="12/12/2020" class="form-control" id="psd" value="{!! (isset($record->PromotionStart) && $record->PromotionStart != "") ? $record->PromotionStart : "" !!}" />

						</fieldset>

						<fieldset class="form-group col-md-6">

							<label for="url">Promotion End Date</label>

							<input type="text" name="ped" placeholder="12/12/2020" class="form-control" id="ped" value="{!! (isset($record->PromotionEnd) && $record->PromotionEnd != "") ? $record->PromotionEnd : "" !!}" />

						</fieldset>
					</div>

					<fieldset class="form-group">

						<label for="active_status">Promotion Status</label>

						<span class="text-red">*</span>

						<select class="form-control" id="active_status" name="active_status">
							<option value="active" {!! (isset($record->PromotionStatus) && $record->PromotionStatus == "active") ? "selected" : "" !!}>Active</option>
							<option value="inactive" {!! (isset($record->PromotionStatus) && $record->PromotionStatus == "inactive") ? "selected" : "" !!}>Inactive</option>
						</select>

					</fieldset>

					<fieldset class="form-group">

						<label for="promotiondisplay">Promotion Display On</label>

						<span class="text-red">*</span>

						<select class="form-control" id="promotiondisplay" name="promotiondisplay" onchange="javascript: $('.promotion-courses').slideUp(300);$('.' + $(this).val()).slideDown(300);">
							<option value="all" {!! (isset($record->PromotionDisplay) && $record->PromotionDisplay == "all") ? "selected" : "" !!}>All Pages</option>
							<option value="home" {!! (isset($record->PromotionDisplay) && $record->PromotionDisplay == "home") ? "selected" : "" !!}>Home Page</option>
							<option value="course" {!! (isset($record->PromotionDisplay) && $record->PromotionDisplay == "course") ? "selected" : "" !!}>Course Page</option>
							<option value="homeandcourse" {!! (isset($record->PromotionDisplay) && $record->PromotionDisplay == "homeandcourse") ? "selected" : "" !!}>Home Page & Course Page</option>
							<option value="custom" {!! (isset($record->PromotionDisplay) && $record->PromotionDisplay == "custom") ? "selected" : "" !!}>Custom</option>
						</select>

					</fieldset>

					<fieldset class="form-group promotion-courses course homeandcourse" {!! (isset($record->PromotionDisplay) && ($record->PromotionDisplay == "course" || $record->PromotionDisplay == "homeandcourse")) ? "" : 'style="display: none;"' !!}>

						<div class="col-md-5">
							<label for="someinput">All Courses</label>

							<span class="text-red">*</span>

							<input type="text" id="allcourse" name="allcourse" class="form-control" placeholder="Search Course Here . . ." />
							<br/>
							<select class="form-control" name="course[]" id="course" style="min-height: 200px" multiple>
								@if(count(Select_All_Courses()) > 0)
									@foreach(Select_All_Courses() as $course)
										<option value="{!! $course->id !!}">{!! $course->title !!}</option>
									@endforeach
								@endif
							</select>
						</div>
						<div class="col-md-2 shiftter-class">
							<i class="fas fa-angle-double-right"></i><br />
							<i class="fas fa-angle-double-left"></i>
						</div>

						<div class="col-md-5">
							<label for="someinput">Selected Courses</label>
							<input type="text" id="selectedcourse" name="selectedcourse" class="form-control" placeholder="Search Course Here . . ."/><br/>

							<select class="form-control chosen-cities" name="coursename[]" id="coursename" style="min-height: 200px" multiple>
								@if(isset($record->id))
									@if($record->PromotionCourses)
										@foreach(explode(",", json_decode($record->PromotionCourses, true)) as $ids)
											<option value="{!! Select_Courses_On_ID($ids)->id !!}" selected>{!! Select_Courses_On_ID($ids)->title !!}</option>
										@endforeach
									@endif
								@endif
							</select>
						</div>

					</fieldset>

					<fieldset class="form-group promotion-courses custom" {!! (isset($record->PromotionDisplay) && $record->PromotionDisplay == "custom") ? "" : 'style="display: none;"' !!}>

						<label for="customurl">Promotion Custom URL</label>
						<div>
							<span class="urlplaceholder">https://nextlearnacademy.com/</span>
							<input type="text" name="customurl" placeholder="course/accounting-for-business" class="form-control urlplaceholderinput" id="customurl" value="{!! (isset($record->PromotionDisplay) && $record->PromotionDisplay == "custom" && $record->PromotionCustom != "") ? $record->PromotionCustom : "" !!}" />
						</div>
					</fieldset>

				</div>

				<div class="row">

					<div class="buttons text-center">

						<button class="btn btn-lg btn-success button" name="saveBTN" id="saveBTN">{{ $button_name }}</button>

					</div>

		 		</div>