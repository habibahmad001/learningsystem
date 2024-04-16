<div class="widget subscribe-widget">
    <i class="fa fa-envelope-o"></i>
    <h2>Subscribe Our Newsletters</h2>
    {{--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore </p>--}}
    <form class="new__formStyle text-left" id="postsubscribe">
        <div class="form-group">
            <div class="field">
                <input type="email" name="email" id="email" placeholder="Your Email Address">
                <label for="email">Your Email Address</label>
            </div>
        </div>
        <div class="form-group text-center">
            <button href="javascript:void(0);" onclick="showSubscription(this.form.id)" class="btn theme-btn btn-block text-uppercase">Subscribe</button>
        </div>
        <div class="form-group mb-0">
            <label class="checkMark">
                <input type="checkbox" name="i_agree" style="display: none;" id="i_agree">
                I have read and agree to the <a href="{!! URL::to("/terms-and-conditions") !!}" target="_blank">terms and conditions</a>
            </label>
        </div>
    </form>
</div>