<!-- Footer -->
@if(\Illuminate\Support\Facades\Cookie::get('consent') === null)
    @include('site.partials.cookies')
@endif

<?php flush(); ?>
<div id="feedback">
    <a href="#" data-toggle="modal" data-target="#myModalRequest" ><i class="fa fa-question-circle mobile_icon" aria-hidden="true"></i><span class="desktop_text">Enquire Now</span></a>
</div>

{{--ENQUIRY FORM MODAL POPUP--}}
<div class="modal fade in request_form" id="myModalRequest" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content enquiry__from">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="javascript: resetenqform();"><span aria-hidden="true">&times;</span></button>
            <div class="w3l_form"></div>
            <div class="w3_info">
                @include('site.partials.enquiry_popup')
            </div>

        </div>
    </div>
</div>
@if(urlHasString('cart') || urlHasString('checkout') || urlHasString('course') || urlHasString('student-id-card'))
    {{--LOGIN MODAL POPUP--}}
    <div class="modal fade in  " id="LoginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog " role="document">
            <div class="modal-content newlogin__from">
                <div class="modal-header d-none">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Sign Up and Start Learning at Next Learn Academy </h4>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick=""><span aria-hidden="true">&times;</span></button>

                <div class="login__content">
                    {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>--}}
                    {{--<div class="w3l_form"></div>--}}
                    {{--<div class="w3_info">--}}
                    @include('site.partials.login_form')
                </div>

            </div>
        </div>
    </div>
@endif
{{--FORGOT PASSWORD MODAL FORM --}}
<div id="forgetPasswordModal" class="modal fade in" role="dialog">
    <div class="modal-dialog">
    {!! Form::open(array('url' => URL_USERS_FORGOT_PASSWORD, 'method' => 'POST', 'name'=>'formLanguage ', 'novalidate'=>'', 'class'=>"loginform", 'name'=>"passwordForm")) !!} <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">{{getPhrase('forgot_password')}}</h4>
                <h6 class="">Please write valid email address</h6>

                {{ csrf_field() }}
                <div class="form-group mt-20">
                    <label>Email Address</label>
                    {{ Form::email('email', $value = null , $attributes = array('class'=>'form-control', 'ng-model'=>'email', 'required'=> 'true', 'placeholder' => getPhrase('email'), 'ng-class'=>'{"has-error": passwordForm.email.$touched && passwordForm.email.$invalid}', )) }}
                    <div class="validation-error"
                         ng-messages="passwordForm.email.$error">{!! getValidationMessage('email')!!}</div>
                </div>

                <button type="button" class="btn btn-default" data-dismiss="modal">{{getPhrase('close')}}</button>
                <button type="submit" class="btn btn-primary" ng-disabled='!passwordForm.$valid'>{{getPhrase('submit')}}</button>

            </div>

        </div>

        {!! Form::close() !!}

    </div>
</div>

{{--ADDED TO CART POPUP MODAL--}}
<div class="modal fade in cart_added_popup" id="addedToCartModal" tabindex="-1" role="dialog" style="z-index: 9999 !important;" aria-labelledby="myModalLabel">
    <div class="modal-dialog " role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Added to Cart </h4>
            </div>
            <div class="modal-body">

            </div>
        </div>
    </div>
</div>
{{--------- Cart Message ------------}}
<div class="modal fade in cart_added_popup" id="alertMessageModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog " role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <button type="button" class="close" aria-label="Close" onclick="javascript: window.location.href='<?=url("/" . collect(request()->segments())->last());?>';"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Alert Message </h4>
            </div>
            <div class="modal-body">
                <p class="text-center pl-10 pr-10">{!! (isset($cartMSG)) ? $cartMSG : "" !!}</p>
            </div>
        </div>
    </div>
</div>
{{--------- Cart Message ------------}}


<footer id="footer" class="footer">

    <!--===== Subscription Form Start Here =====-->


    <section id="subcription">
        <div class="container">
            <div class="row subs-group-content">
                <div class="col-lg-7 col-md-8 col-sm-12 col-xs-12">
                    <div class="text-center">
                        <h2 class="text-white font-32 text-center">Subscribe Our Newsletters </h2>
                    </div>
                    <!--Mailchimp Subscription Form Starts Here -->
                    <form id="subscription-form-footer" class="newsletter-form1">
                        <div class="input-group">
                            <input type="email" value="" name="email" placeholder="Your Email"
                                   class="form-control input-lg font-16" data-height="45px" id="email" autocomplete="off">

                            <button class="btn btn-colored btn-xs m-0 font-16"
                                    onclick="showSubscription(this.form.id)"
                            >{{getPhrase('subscribe')}}<i class="fa fa-paper-plane"></i></button>

                        </div>
                    </form>
                    <!--Mailchimp Subscription Form Ends Here -->
                </div>
            </div>
        </div>
    </section>

    <!--===== Subscription Form End Here =====-->

    <!--===== Footer Start Here =====-->
    <section>
        <!--===== Footer Top Start Here =====-->
        <div class="container align-items-center pt-20 pb-10" id="footer-top">
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 mt-20">
                <div class="widget dark">
                    <a href="{{url('/')}}"><img alt="" width="260" src="<?=UPLOADS.'images/nla_NewLogo.png'?>"></a>
                    <p class="footer-text pt-20">Next Learn Academy is helping individuals reach their goals and pursue
                        their dreams by giving the opportunity to learn online and earn certifications as powerful proof
                        of their new competencies.</p>

                    <div class="w-100 text-center">
                        <a href="<?=url('/validate-certificate')?>" class="ftr_link">Verify Your Certificate</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 mt-20">
                <div class="widget dark">
                    <h4 class="widget-title line-bottom-theme-colored2 footer-sub-header">Top Courses</h4>
                    <div class="row clearfix">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <ul class="footer-link">
                                <li class=""><a href="<?=url('/free-courses')?>">Free Courses</a></li>
                                <li><a href="<?=url('/discounted-courses')?>">Discounted Courses</a></li>
                                <li><a href="<?=url('/popular-courses')?>">Popular Courses</a></li>
                                <li><a href="<?=url('/new-courses')?>">New Courses</a></li>
                            </ul>
                            <img src="<?=UPLOADS.'images/image-removebg-preview1.png'?>" class="ds30_img">
                        </div>
                        {{-- <div class="col-xs-12 col-sm-6 col-md-6">
                            <ul class="footer-link">
                                <li><a href="#">Business</a></li>
                                <li><a href="#">Finance</a></li>
                                <li><a href="#">Consulting</a></li>
                                <li><a href="#">Insurance</a></li>
                                <li><a href="#">Professional</a></li>
                            </ul>
                        </div>--}}
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 mt-20">
                <div class="widget dark">
                    <h4 class="widget-title line-bottom-theme-colored2 footer-sub-header">Useful Links</h4>
                    <div class="row clearfix">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <ul class="footer-link">
                                <li><a href="<?=url('/')?>">Home</a></li>
                                <li><a href="<?=url('/about-us')?>">About Us</a></li>
                                <li><a href="<?=url('/contact_us')?>">Contact us</a></li>
                                <li><a href="<?=url('/blogs')?>">Blog</a></li>
                                <li><a href="<?=url('/faqs')?>">FAQs</a></li>
                                <li><a href="<?=url('/privacy-policy')?>">Privacy Policy</a></li>
                                <li style="width: max-content;"><a href="<?=url('/redeem_a_voucher')?>">Redeem a Voucher</a></li>
                                <li style="width: max-content;"><a href="<?=url('/terms-and-conditions')?>">Terms & Conditions</a></li>
                            </ul>
                        </div>
                        {{-- <div class="col-xs-12 col-sm-6 col-md-6">
                            <ul class="footer-link">
                                <li><a href="#">Business</a></li>
                                <li><a href="#">Finance</a></li>
                                <li><a href="#">Consulting</a></li>
                                <li><a href="#">Insurance</a></li>
                                <li><a href="#">Professional</a></li>
                            </ul>
                        </div>--}}
                    </div>
                </div>
            </div>
            {{--<div class="col-sm-6 col-md-2">
                <div class="widget dark">
                    <h5 class="widget-title line-bottom-theme-colored2">Support</h5>
                    <ul class="list-border">
                        <li><a href="shortcode-sitemap.html">FAQ</a></li>
                        <li><a href="shortcode-sitemap.html">Sitemap</a></li>
                        <li><a href="page-contact1.html">Policy</a></li>
                    </ul>
                </div>
            </div>--}}
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 mt-20">
                <div class="widget dark">
                    <h5 class="widget-title line-bottom-theme-colored2 footer-sub-header">Contact Info</h5>
                    <ul class="list-inline contact-details">
                        <li class="m-0 pl-10 pr-10"> <i class="fa fa-map-marker mr-5"></i>&nbsp;Next Learn Academy <br>16 Upper Woburn Place, London,
                            <br>Greater London, WC1H 0AF, <br>United Kingdom</li>
                        <li class="m-0 pl-10 pr-10"> <i class="fa fa-phone mr-5"></i> <a href="tel:00442081260786">020 8126 0786</a> </li>
                        <li class="m-0 pl-10 pr-10"> <i class="fa fa-fax mr-5"></i> <a href="tel:00442038841890">0203
                                884 1890</a> </li>
                        <li class="m-0 pl-10 pr-10"> <i class="fa fa-envelope-o mr-5"></i> <a
                                    href="mailto:info@nextlearnacademy.com">info@nextlearnacademy.com</a> </li>
                        {{--<li class="m-0 pl-10 pr-10"> <i class="fa fa-globe mr-5"></i> <a href="#">www.yourdomain.com</a> </li>--}}
                    </ul>
                    <ul class="styled-icons icon-sm icon-dark icon-theme-colored2 icon-circled clearfix mt-10">
                        {{--<li><a href="{{getSetting('facebook_link', 'site_settings')}}" target="_blank"><i
                            class="fa fa-facebook"></i></a></li>--}}
                        {{--<li><a href="{{getSetting('twitter_link', 'site_settings')}}" target="_blank"><i
                            class="fa fa-twitter"></i></a></li>--}}
                        {{--<li><a href="{{getSetting('linkedin_link', 'site_settings')}}" target="_blank"><i
                            class="fa fa-linkedin"></i></a></li>--}}
                        {{--<li><a href="{{getSetting('instagram_link', 'site_settings')}}" target="_blank"><i
                            class="fa fa-instagram"></i></a></li>--}}
                        {{--<li><a href="https://www.facebook.com/Infinity-Learning-119333166501818" target="_blank"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="https://twitter.com/InfinityLearni5" target="_blank"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="https://www.linkedin.com/company/infinity-learning-global" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                        <li><a href="https://www.instagram.com/infinitylearninguk/" target="_blank"><i class="fa fa-instagram"></i></a></li>--}}
                    </ul>

                    <!-- Mailchimp Subscription Form Starts Here -->
                {{--<form id="subscription-form-footer" class="newsletter-form">
                    <div class="input-group">
                        <input type="email" value="" name="email" placeholder="Your Email" class="form-control input-lg font-16" data-height="45px" id="email1">
                        <span class="input-group-btn">
                            <button  data-height="45px" class="btn btn-colored btn-theme-colored btn-xs m-0 font-14" onclick="showSubscription()" >{{getPhrase('subscribe')}}</button>
                --}}{{--<button data-height="45px" class="btn btn-colored btn-theme-colored btn-xs m-0 font-14" type="submit">Subscribe</button>--}}{{--
                </span>
                    </div>
                </form>--}}

                <!-- Mailchimp Subscription Form Ends Here -->
                    <div class="paymentInfo">
                        {{--<img src="https://www.globaledulink.co.uk/wp-content/themes/wplms-child/assets/img/payment/seal_image.png" />--}}
                        {{--<img src="https://www.globaledulink.co.uk/wp-content/themes/wplms-child/assets/img/payment/paypal.png" />--}}
                        <img src="<?=UPLOADS.'images/trust_logo.png'?>">
                        <img src="<?=UPLOADS.'images/paypal.png'?>">
                    </div>
                </div>

            </div>
        </div>
        <!--===== Footer Top End Here =====-->

        <!--===== Footer bottom Start Here =====-->
        <div class="footer-bottom" data-bg-color="linear-gradient(to right, #063248, #156e9b)">
            <div class="container pt-10 pb-15">
                <div class="row align-items-center">
                    <div class="col-md-7 col-sm-12 col-xs-12">
                        <p class="font-14 sm-text-center m-0" style="color: #ffffff; font-weight: bold;">© Next Learn Academy, {!! date("Y") !!}</p>
                    </div>
                    <div class=" d-none col-md-4 col-sm-12 col-xs-12 text-right ftr_rPadding">
                        <a class="footer-social-icons" href="https://www.facebook.com/nextlearnacademy" target="_blank"><i class="fa fa-facebook"></i></a>
                        <a class="footer-social-icons" href="https://twitter.com/NextLearnUK" target="_blank"><i class="fa fa-twitter"></i></a>
                        <a class="footer-social-icons" href="https://www.linkedin.com/company/nextlearnacademy" target="_blank"><i class="fa fa-linkedin"></i></a>
                        <a class="footer-social-icons" href="https://www.instagram.com/nextlearnacademy/" target="_blank"><i class="fa fa-instagram"></i></a>
                        {{--<div class="widget no-border m-0">
                            <ul class="list-inline sm-text-center mt-5 font-14">
                                <li>
                                    <a href="terms-and-conditions.php">Terms and Conditions</a>
                                </li>
                                <li>|</li>
                                <li>
                                    <a href="privacy-policy.php">Privacy Policy</a>
                                </li>
                                <li>|</li>
                                <li>
                                    <a href="#">Support</a>
                                </li>
                            </ul>
                        </div>--}}
                    </div>

                    <div class="social-btns col-md-4 col-sm-12 col-xs-12 text-right ftr_rPadding">
                        <a class="btn facebook" href="https://www.facebook.com/nextlearnacademy" target="_blank"><i class="fa fa-facebook"></i></a>
                        <a class="btn twitter" href="https://twitter.com/NextLearnUK" target="_blank"><i class="fa fa-twitter"></i></a>
                        <a class="btn linkedin" href="https://www.linkedin.com/company/nextlearnacademy" target="_blank"><i class="fa fa-linkedin"></i></a>
                        <a class="btn instagram" href="https://www.instagram.com/nextlearnacademy/" target="_blank"><i class="fa fa-instagram"></i></a>
                    </div>

                </div>
            </div>
        </div>
        <!--===== Footer bottom END Here =====-->

    </section>
{{--@include('cookieConsent::index')--}}
{{--@include('cookie-consent::index')--}}
<!--===== Footer END Here =====-->
    @include('site.partials.popups')
</footer>
@if(Auth::check())
    @include('site.instructormodel')
@endif
<a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>
@yield('scripts')
<script>
    $( document ).ready(function() {
        $('[data-toggle=search-form]').click(function() {
            $('.search-form-wrappers').toggleClass('open');
            $('.search-form-wrappers .search').focus();
            $('html').toggleClass('search-form-open');
        });
        $('[data-toggle=search-form-close]').click(function() {
            $('.search-form-wrappers').removeClass('open');
            $('html').removeClass('search-form-open');
        });
        $('.search-form-wrappers .search').keypress(function( event ) {
            if($(this).val() == "Search") $(this).val("");
        });

        $('.search-close').click(function(event) {
            $('.search-form-wrappers').removeClass('open');
            $('html').removeClass('search-form-open');
        });
    });
</script>


{{--@if(\Illuminate\Support\Facades\Cookie::get('consent') === null)--}}
{{--@include('site.partials.cookiescript')--}}
{{--@include('cookie-consent::index')--}}
{{--@endif--}}
{{--@if(\Illuminate\Support\Facades\Cookie::get('consent') != null)--}}
{{--<script>console.log('Google analytics cookies created.')</script>--}}
{{--@endif--}}
