<!-- Footer -->
@if(\Illuminate\Support\Facades\Cookie::get('consent') === null)
    @include('site.partials.cookies')
@endif

<style>
    .newsletter-form1{
        max-width: 500px !important;
        margin: 0 auto;
    }

    .btn-theme-colored{
        background-color: rgb(81, 172, 55);
        color: white !important;
        font-weight: bold !important;
        border-radius: 5px;
        border-color: unset !important;
    }
</style>

<!--Divider Call to Action-->
<section class="parallax layer-overlay overlay-theme-colored-9" data-bg-img="{{url('/images/subscribe.jpg')}}" data-parallax-ratio="0.4">
    <div class="container pt-70 pb-60">
        <div class="section-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="banner-text text-center">
                        <h2 class="text-white font-32" style="padding-bottom: 20px;">Subscribe Our Newsletters </h2>
                        <!-- Mailchimp Subscription Form Starts Here -->
                        <form id="subscription-form-footer" class="newsletter-form1">
                            <div class="input-group">
                                <input type="email" value="" name="email" placeholder="Your Email" class="form-control input-lg font-16" data-height="45px" id="email1">
                                <button  data-height="45px" class="btn btn-colored btn-theme-colored btn-xs m-0 font-16" onclick="showSubscription()">{{getPhrase('subscribe')}}</button>
                            </div>
                        </form>
                        <!-- Mailchimp Subscription Form Ends Here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@yield('scripts')
{{--
@if(\Illuminate\Support\Facades\Cookie::get('consent') === null)
    @include('site.partials.cookiescript')
@endif
@if(\Illuminate\Support\Facades\Cookie::get('consent') != null)
    <script>console.log('Google analytics cookies created.')</script>
@endif--}}
