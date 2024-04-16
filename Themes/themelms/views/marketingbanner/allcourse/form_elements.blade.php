


			<div class="row" id="imgdiv">

				<fieldset class="form-group col-md-12">

					<label for="img">Main Banner:</label>

					<input type="file" name="img" id="img" />
					<span class="text-red">Image width must be 4000px and max height is 1200px.</span>
					<br />
					<img src="{!! (isset($Promo->content_type) && $Promo->content_type == "allcourse") ? getSettings('lms')->allcourse.json_decode($Promo->content_area, true)["Main_Banner"] : "https://via.placeholder.com/300x250" !!}" width="100%" height="250" style="border-radius: 8px;" />

				</fieldset>

				<fieldset class="form-group col-md-12">

					<label for="img">Mobile Banner:</label>

					<input type="file" name="mimg" id="mimg" />
					<span class="text-red">Image width must be 477px and max height is 1200px.</span>
					<br />
					<img src="{!! (isset($Promo->content_type) && $Promo->content_type == "allcourse") ? getSettings('lms')->allcourse.json_decode($Promo->content_area, true)["Mobile_Banner"] : "https://via.placeholder.com/300x250" !!}" width="50%" height="250" style="border-radius: 8px;" />

				</fieldset>

				<fieldset class="form-group col-md-12">

					<label for="area">Link</label>

					<span class="text-red">*</span>

					<input type="text" name="img_link" id="img_link" value="{!! (isset($Promo->content_type) && $Promo->content_type == "allcourse") ? $Promo->content_link : "" !!}" class="form-control">

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