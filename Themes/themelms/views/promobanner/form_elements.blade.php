
				<div class="row">

					<fieldset class="form-group col-md-12">

						<label for="status">Type</label>

						<span class="text-red">*</span>

						<select class="form-control" id="contenttype" name="contenttype" onchange="javascript: if($(this).val() == 'textcontent') {$('#imgdiv').slideUp(500); $('#contentdiv').slideDown(500)} else {$('#contentdiv').slideUp(500); $('#imgdiv').slideDown(500)}">
							<option value="textcontent" {!! (isset($Promo->content_type) && $Promo->content_type == "textcontent") ? "selected" : "" !!}>Text</option>
							<option value="imagecontent" {!! (isset($Promo->content_type) && $Promo->content_type == "imagecontent") ? "selected" : "" !!}>Image</option>
						</select>

					</fieldset> 

				</div>


				<div class="row" id="contentdiv" {!! (isset($Promo->content_type) && $Promo->content_type == "imagecontent") ? 'style="display: none;"' : "" !!}>

					<fieldset class="form-group col-md-12">

						<label for="area">Content</label>

						<span class="text-red">*</span>

						{{ Form::textarea('area', $value = (isset($Promo->content_type) && $Promo->content_type == "textcontent") ? $Promo->content_area : "" , $attributes = array('class'=>'form-control ckeditor', 'rows'=>'5', 'placeholder' => getPhrase('Text Content'))) }}

					</fieldset>

					<fieldset class="form-group col-md-12">

						<label for="area">Link</label>

						<span class="text-red">*</span>

						<input type="text" name="content_link" id="content_link" value="{!! (isset($Promo->content_type) && $Promo->content_type == "textcontent") ? $Promo->content_link : "" !!}" class="form-control">

					</fieldset>

					<fieldset class="form-group col-md-12">

						<label for="status">Background Type</label>

						<span class="text-red">*</span>

						<select class="form-control" id="bgtype" name="bgtype" onchange="javascript: if($(this).val() == 'bgcolour') {$('#bgimgfield').slideUp(500); $('#bgcolourfield').slideDown(500)} else {$('#bgcolourfield').slideUp(500); $('#bgimgfield').slideDown(500)}">
							<option value="bgcolour" {!! (isset(json_decode($Promo->bannerBG, true)["BackgroundType"]) && json_decode($Promo->bannerBG, true)["BackgroundType"] == "bgcolour") ? "selected" : "" !!}>Background Colour</option>
							<option value="bgimg" {!! (isset(json_decode($Promo->bannerBG, true)["BackgroundType"]) && json_decode($Promo->bannerBG, true)["BackgroundType"] == "bgimg") ? "selected" : "" !!}>Background Image</option>
						</select>

					</fieldset>

					<fieldset class="form-group col-md-12" id="bgcolourfield" {!! (isset(json_decode($Promo->bannerBG, true)["BackgroundType"]) && json_decode($Promo->bannerBG, true)["BackgroundType"] == "bgimg") ? 'style="display: none;"' : "" !!}>

						<label for="area">Background Colour</label>

						<span class="text-red">*</span>

						<input type="text" name="background_colour" id="background_colour" value="{!! (isset(json_decode($Promo->bannerBG, true)["BackgroundType"]) && json_decode($Promo->bannerBG, true)["BackgroundType"] == "bgcolour") ? json_decode($Promo->bannerBG, true)["BackgroundContent"] : "#dff0d8" !!}" class="form-control">
						<br />
						<label for="area">Text Colour</label>

						<span class="text-red">*</span>

						<input type="text" name="textcolourfield" id="textcolourfield" value="{!! (isset(json_decode($Promo->bannerBG, true)["textcolour"])) ? json_decode($Promo->bannerBG, true)["textcolour"] : "#dff0d8" !!}" class="form-control">
					</fieldset>

					<fieldset class="form-group col-md-12" id="bgimgfield" {!! ($Promo->bannerBG == "IMGUPLOAD" || json_decode($Promo->bannerBG, true)["BackgroundType"] == "bgcolour") ? 'style="display: none;"' : "" !!}>

						<label for="img">Backgound Image</label>

						<input type="file" name="background_img" id="background_img" />
						<br />
						<img src="{!! (isset(json_decode($Promo->bannerBG, true)["BackgroundType"]) && json_decode($Promo->bannerBG, true)["BackgroundType"] == "bgimg") ? UPLOADS."promobanner/BG/".json_decode($Promo->bannerBG, true)["BackgroundContent"] : "https://via.placeholder.com/1920x100&text=1920x100" !!}" width="100%" height="100" style="border-radius: 8px;" />

					</fieldset>

					<fieldset class="form-group col-md-12">

						<label for="status">Status</label>

						<span class="text-red">*</span>

						<select class="form-control" id="content_status" name="content_status">
							<option value="active" {!! (isset($Promo->content_status) && $Promo->content_status == "active") ? "selected" : "" !!}>Active</option>
							<option value="inactive" {!! (isset($Promo->content_status) && $Promo->content_status == "inactive") ? "selected" : "" !!}>Inactive</option>
						</select>

					</fieldset>

				</div>

				<div class="row" id="imgdiv" {!! (isset($Promo->content_type) && $Promo->content_type == "textcontent") ? 'style="display: none;"' : "" !!}>

					<fieldset class="form-group col-md-6">

						<label for="img">Image</label>

						<input type="file" name="img" id="img" />
						<br />
						<img src="{!! (isset($Promo->content_type) && $Promo->content_type == "imagecontent") ? UPLOADS."promobanner/".$Promo->content_area : "https://via.placeholder.com/1920x100&text=1920x100" !!}" width="100%"  style="border-radius: 8px;" />

					</fieldset>

					<fieldset class="form-group col-md-6">

						<label for="mobile_img">Mobile Image</label>

						<input type="file" name="mobile_img" id="mobile_img" />
						<br />
						<img src="{!! (isset($Promo->content_type) && $Promo->content_type == "imagecontent") ? isset($Promo->mobile_img) ? UPLOADS."promobanner/BG/".$Promo->mobile_img : "https://via.placeholder.com/1920x100&text=400x100" : "" !!}" width="60%" height="100px"  style="border-radius: 8px;" />

					</fieldset>


					<fieldset class="form-group col-md-12">

						<label for="timmer">Set Timer</label>

						<input type="text" name="timmer" id="timmer" placeholder="Jan 5, 2024 15:37:25" value="{!! (isset($Promo->content_type) && $Promo->content_type == "imagecontent") ? $Promo->timmer : "" !!}" class="form-control">

					</fieldset>

					<fieldset class="form-group col-md-6">

						<label for="area">Link</label>

						{{--<span class="text-red">*</span>--}}

						<input type="text" name="img_link" id="img_link" value="{!! (isset($Promo->content_type) && $Promo->content_type == "imagecontent") ? $Promo->content_link : "" !!}" class="form-control">

					</fieldset>

					<fieldset class="form-group col-md-12">

						<label for="status">Status</label>

						<span class="text-red">*</span>

						<select class="form-control" id="img_status" name="img_status">
							<option value="active" {!! (isset($Promo->content_status) && $Promo->content_status == "active") ? "selected" : "" !!}>Active</option>
							<option value="inactive" {!! (isset($Promo->content_status) && $Promo->content_status == "inactive") ? "selected" : "" !!}>Inactive</option>
						</select>

					</fieldset>

				</div>

				<div class="row">

					<div class="buttons text-center col-md-12">

						<button class="btn btn-lg btn-success button" name="saveBTN" id="saveBTN">{{ $button_name }}</button>

					</div>

		 		</div>