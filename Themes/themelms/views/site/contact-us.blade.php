@extends('layouts.sitelayout')
@section('header_scripts')
@stop
@section('content')
    <div class="main-content inner_pages">

        <!--=====Start Page Banner=====-->
        <section class="inner-header divider layer-overlay overlay-theme-colored-9 pt-50 pb-50">
            <div class="container">
                <!-- Section Content -->
                <div class="section-content">
                    <div class="row">
                        <div class="col-md-6">
                            <h2 class="font-36">{{ ucfirst($title) }}</h2>
                            <ol class="breadcrumb text-left mt-10 white">
                                <li><a href="{{url('/')}}">Home</a></li>
                                {{--<li><a href="#">Pages</a></li>--}}
                                <li class="active">{{ ucfirst($title) }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--=====End Page Banner=====-->

        <!-- ======= Contact Us Section ======= -->
        <section id="contact" class="contact new__pgfrmstyle pt-50 pb-50">
            <div class="container">
                <div class="section-title text-center">
                    <h2 class="title text-uppercase">Have any <span class="text-theme-colored2" style="color: rgb(81, 172, 55) !important;">questions ?</span></h2>
                </div>

                <div class="row">
                    <!-- ======= Contact Us Form Start ======= -->
                    <div class="col-lg-8 col-md-7 justify-content-center">
                        <div class="prc_wrap contact_successMsg">
                            @if (isset($_REQUEST['contact']))
                                @php
                                    //
                                    toastr()->success('Thanks! Our Team will contact you soon');
                                @endphp
                                <div class="alert alert-success" role="alert">
                                    <h4 class="alert-heading contactok">
                                        <i class="fa fa-check-circle" aria-hidden="true"></i>
                                        <br/>
                                        {{ session('status') }}
                                    </h4>
                                    <p>
                                        We have received your message and would like to thank you for writing to us. If your inquiry is urgent, please use the telephone number listed below to talk to one of our staff members. Otherwise, we will reply by email as soon as possible.
                                    </p>
                                    <hr/>
                                    <p>
                                        Talk to you soon,<br/>
                                        <strong>Next Learn Academy</strong>
                                    </p>
                                </div>
                            @else
                                <form action="{{ URL::to( PREFIX . 'send/contact_us/details') }}" name="cfrm" id="cfrm" method="post" role="form" class="php-email-form new__formStyle" onSubmit="return contactUsvalidation('');">
                                    @include('errors.errors')
                                    @if(session()->has('error_message'))
                                        <div class="success-message-box" style="color: #843534; background: #f2dede;border-color: #ebccd1;">
                                            {{ session()->get('error_message') }}
                                            <div class="cancel"></div>
                                        </div>
                                    @endif
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div class="form-group col-lg-6 col-md-6">
                                            <div class="field">
                                                <div class="valmsg" id="namemsg"><p class="signuperrorp">Please enter charater only.</p></div>
                                                <input type="text" name="name" id="name" class="form-control" id="name" onkeyup="javascript:($(this).val()) ? $(this).removeClass('error') : $(this).addClass('error')" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                                                <label for="name">Full Name <span>*</span></label>
                                            </div>
                                        </div>

                                        <div class="form-group col-lg-6 col-md-6">
                                            <div class="field">
                                                <input type="email" class="form-control" name="email" id="email" onkeyup="javascript:($(this).val()) ? $(this).removeClass('error') : $(this).addClass('error')" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
                                                <label for="email">Email Address <span>*</span></label>
                                            </div>
                                        </div>

                                        <div class="form-group col-lg-12 col-md-12">
                                            <div class="field">
                                                <input type="text" class="" name="subject" id="subject" onkeyup="javascript:($(this).val()) ? $(this).removeClass('error') : $(this).addClass('error')" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                                                <label for="subject">Subject <span>*</span></label>
                                            </div>
                                        </div>

                                        <div class="form-group col-lg-12 col-md-12">
                                            <div class="field">
                                                <div class="valmsg" id="phonemsg"><p class="signuperrorp">Please enter valid phone number.</p></div>
                                                <input type="text" class="" name="phone" id="phone" placeholder="Phone" />
                                                <label for="phone">Phone <span>*</span></label>
                                            </div>
                                        </div>

                                        <div class="form-group col-lg-12 col-md-12">
                                            <div class="field">
                                                <textarea class="form-control" name="cmsg" id="cmsg" rows="5" onkeyup="javascript:($(this).val()) ? $(this).removeClass('error') : $(this).addClass('error')" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
                                                <label for="cmsg">Message <span>*</span></label>
                                            </div>
                                        </div>

                                        <div class="form-group col-lg-12 col-md-12">
                                            <div class="form-group" style="display: none;" id="captcha_msg_conc">
                                                <div class="alert alert-danger" role="alert">
                                                    <b>Please check captcha before submit !!</b>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group col-lg-12 col-md-12">
                                            @if($rechaptcha_status == 'yes')
                                                <div class="{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}" style="margin: 15px 0px">
                                                    {!! app('captcha')->display() !!}
                                                    {{--{!! NoCaptcha::displaySubmit('registrationForm', 'Register Now', ['data-theme' => 'dark','class'=>'btn btn-success','id'=>'submit']) !!}--}}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group checks_div col-lg-12 col-md-12">
                                            <label class="" for="defaultCheck1">
                                                <input class="form-check-input" type="checkbox" name="sub" value="Yes" id="defaultCheck1">
                                                Subscribe me to receive the latest promotions and courses.
                                            </label>
                                            <div class="clearfix"></div>
                                            <label class="ctermsclass" for="defaultCheck2">
                                                <input class="form-check-input" type="checkbox" name="agree" value="1" id="cdefaultCheck2">
                                                I have read and agreed to the <a href="{!! URL::to("/privacy-policy") !!}" style="color:#51ac37">Privacy Policy</a> *
                                            </label>
                                        </div>
                                        <div class="form-group col-lg-12 col-md-12 mb-0" id="btn-submit">
                                            <input name="form_botcheck" class="form-control" type="hidden" value="" />
                                            <!--<button type="submit" class="btn btn-success btn-theme-colored" data-loading-text="Please wait..."-->
                                            <!--  style="background-color: rgb(81, 172, 55);">SEND YOUR MESSAGE</button>-->
                                            <div class="wrapper">
                                                <a data-loading-text="Please wait..." onclick="javascript:$('#cfrm').submit();" class="btn btn-primary theme-btn btn-block" id="save"><span>SEND YOUR MESSAGE</span></a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                {!! Form::close() !!}
                            @endif
                        </div>
                    </div>
                    <!-- ======= Contact Us Form END ======= -->

                    <!-- ======= Contact Us Details Start ======= -->
                    <div class="col-lg-4 col-md-5 justify-content-center" id="contact-details">
                        <div class="prc_wrap">
                            <div class="align-item-center">
                                <div class="col-lg-12 col-md-12">
                                    <h2>Get In Touch</h2>
                                    <!--p style="color: #555555 !important;font-weight:300px">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do </p-->
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div class="cn-info-detail">
                                        <div class="cn-info-icon">
                                            <i class="fa fa-map-marker"></i>
                                        </div>
                                        <div class="cn-info-content">
                                            <h4 class="cn-info-title">Our Address</h4>
                                            Next Learn Academy<br>
                                            {!! getSetting('site_address','site_settings') !!}, {!! getSetting('site_city','site_settings') !!},
                                            <br>{!! getSetting('site_zipcode','site_settings') !!},
                                            <br>{!! getSetting('site_country','site_settings')!!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div class="cn-info-detail">
                                        <div class="cn-info-icon">
                                            <i class="fa fa-envelope"></i>
                                        </div>
                                        <div class="cn-info-content">
                                            <h4 class="cn-info-title">Email Us</h4>
                                            <p><a href="mailto:{{getSetting('admin_email','site_settings')}}">{{getSetting('admin_email','site_settings')}}</a></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div class="cn-info-detail">
                                        <div class="cn-info-icon">
                                            <i class="fa fa-phone"></i>
                                        </div>
                                        <div class="cn-info-content">
                                            <h4 class="cn-info-title">Call Us</h4>
                                            <p><a href="tel:00442081260786">{{getSetting('site_phone','site_settings')}}</a></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div class="cn-info-detail">
                                        <a class="footer-social-icons" href="https://www.facebook.com/nextlearnacademy" target="_blank"><i class="fa fa-facebook"></i></a>
                                        <a class="footer-social-icons" href="https://twitter.com/NextLearnUK" target="_blank"><i class="fa fa-twitter"></i></a>
                                        <a class="footer-social-icons" href="https://www.linkedin.com/company/nextlearnacademy" target="_blank"><i class="fa fa-linkedin"></i></a>
                                        <a class="footer-social-icons" href="https://www.instagram.com/nextlearnacademy/" target="_blank"><i class="fa fa-instagram"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ======= Contact Us Details END ======= -->

                </div>
            </div>
        </section>
        <!-- ======= Contact Us Section END ======= -->

        <!-- ======= Contact us Map ======= -->
        <div class="container-fluid pb-0 map-section" data-aos="fade-up">
            <div class="row contact-us-map" data-aos="fade-up" data-aos-delay="100">
                <div class="col-md-12">
                    <iframe class="mb-4 mb-lg-0"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1343.7214216493712!2d-0.13190922490345347!3d51.526903463469885!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x48761b253e27b599%3A0xcb4805ace2a7d7ca!2s16%20Woburn%20Pl%2C%20London%20WC1H%200AF%2C%20UK!5e0!3m2!1sen!2sus!4v1627472997844!5m2!1sen!2sus"
                            width="100%" height="400" frameborder="0" style="border-radius:0px;" allowfullscreen="" aria-hidden="false" tabindex="0">
                    </iframe>
                </div>
            </div>
        </div>
        <!-- ======= Contact Us Map END ======= -->
    </div>

@stop

@section('footer_scripts')
    {{--            @include('common.validations', array('isLoaded'=>true))--}}
    {{-- <script src="{{JS}}recaptcha.js"></script> --}}
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <!-- script src="{{themes('js/google-map-init-multilocation.js')}}"></script>
<script src='https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js'></script>
<script src='https://www.google.com/recaptcha/api.js'></script-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
    <script>

        // jQuery( function() {
        //
        //
        //     jQuery("#save").click(function(){
        //         jQuery("#cfrm").validate({
        //             rules: {
        //                 name: {
        //                     required: true
        //                 },
        //                 email: {
        //                     required: true,
        //                     email: true
        //                 },
        //                 subject: {
        //                     required: true
        //                 },
        //                 phone: {
        //                     required: true,
        //                     minlength:12,
        //                     maxlength:12
        //                 },
        //                 msg: {
        //                     required: true
        //                 }
        //             },
        //             messages: {
        //                 name: "Please enter Name",
        //                 email: {
        //                     required: "Please enter email address",
        //                     email: "Please enter a valid email address"
        //                 },
        //                 subject: "Please enter text in Subject",
        //                 phone: "Please enter phone",
        //                 msg: "Please enter some text in message",
        //             },
        //             submitHandler: function(form){ alert("Here");
        //                 jQuery('#save').attr('disabled', 'disabled');
        //                 form.submit();
        //             }
        //         });
        //     });
        // });


        window.dataLayer=window.dataLayer||[];
        dataLayer.push({
            'pageType': 'contact',
            'country': '<?php echo strtolower(ip_info("Visitor", "Country Code")); ?>',  //Should be based on IP
        });

    </script>

@stop