@extends('layouts.sitelayout')
@section('header_scripts')
@stop
@section('content')
    <style>
        @media screen and (min-width: 1930px) and (max-width: 2700px) {
            .all__coursesHeader {
                background-position: center -90px;
            }
            .multi-banner-top-txt {
                font-size: 28px;
                margin-top: 10%;
                margin-bottom: 3%;
            }
            .multi-banner-main-txt {
                font-size: 54px;
            }
            .multi-banner-bottom-txt {
                font-size: 28px;
                margin-bottom: 10%;
                line-height: 36px;
                width: 80%;
            }
            .bigger-teh-1930-0n {
                margin-left: 17%;
            }
            .bigger-teh-1930-0ff {
                display: none;
            }
        }
        @media screen and (min-width: 2700px) and (max-width: 5200px) {
            .bigger-teh-1930-0n {
                margin-left: 31%;
            }
        }
    </style>
    <div class="main-content inner_pages">

        <!--=====Start Page Banner=====-->
        <section id="home" class="all__coursesHeader overlay-dark-6" style="background-image: url('<?=UPLOADS?>lms/series/offerbanner/470477595.png'); "  >
            <div class="container-fluid pt-80 pb-80 pt-xs-50 pb-xs-50 position-relative text-center  ">
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 bigger-teh-1930-0n">
{{--                    <p class="multi-banner-top-txt">earn 25% Commission</p>--}}
                    <p class="multi-banner-main-txt">Course Voucher Redeem</p>
{{--                    <p class="multi-banner-bottom-txt">Join now and start earning with One Education!--}}
{{--                        Become one of our partners as an affiliate and help us promote--}}
{{--                        quality education worldwide.--}}
{{--                    </p>--}}
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 bigger-teh-1930-0ff"></div>
            </div>
        </section>
        <!--=====End Page Banner=====-->

        <!-- ======= Contact Us Section ======= -->
        <section id="contact" class="contact new__pgfrmstyle pt-50 pb-50">
            <div class="container">
                <div class="section-title text-center">
                    <h2 class="title text-uppercase">Fill Out <span class="text-theme-colored2" style="color: rgb(81, 172, 55) !important;">Form</span></h2>
                </div>

                <div class="row">
                    <!-- ======= Contact Us Form Start ======= -->
                    <div class="col-lg-12 col-md-12 justify-content-center">
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
                                        We have received your message and would like to thank you for writing to us. we will reply by email as soon as possible.
                                    </p>
                                    <hr/>
                                    <p>
                                        Talk to you soon,<br/>
                                        <strong>Next Learn Academy</strong>
                                    </p>
                                </div>
                            @else
                                <form action="{{ URL::to( PREFIX . 'multiple_course_redeem') }}" name="cfrm" id="cfrm" method="post" role="form" enctype="multipart/form-data" class="php-email-form new__formStyle" onSubmit="return multicoursevalidation('');">
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
                                                <input type="text" name="name" id="name" class="form-control" onkeyup="javascript:($(this).val()) ? $(this).removeClass('error') : $(this).addClass('error')" placeholder="Student Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                                                <label for="name">Student Name <span>*</span></label>
                                            </div>
                                        </div>

                                        <div class="form-group col-lg-6 col-md-6">
                                            <div class="field">
                                                <input type="email" class="form-control" name="email" id="email" onkeyup="javascript:($(this).val()) ? $(this).removeClass('error') : $(this).addClass('error')" placeholder="Student Email Address" data-rule="email" data-msg="Please enter a valid Student Email Address" />
                                                <label for="email">Student Email Address <span>*</span></label>
                                            </div>
                                        </div>

                                        <div class="form-group col-lg-12 col-md-12">
                                            <div class="field">
                                                <div class="valmsg" id="phonemsg"><p class="signuperrorp">Please enter valid phone number.</p></div>
                                                <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone Number" />
                                                <label for="phone">Phone Number <span>*</span></label>
                                            </div>
                                        </div>

                                        <div class="form-group col-lg-12 col-md-12">
                                            <div class="field">
                                                <input type="file" name="purchaseatt" class="form-control" id="purchaseatt" placeholder="Purchase Attachment">
{{--                                                <label for="purchaseatt" style="font-size: 16px;">Purchase Attachment <span>*</span></label>--}}
                                            </div>
                                            <div class="redeem-label-font redeem-label-color" id="purchaseattmsg">
                                                Accepted file types: jpg, gif, png, pdf, jpeg, Max. file size: 5 MB. (<span class="">Please add a screenshot/invoice showing the voucher code you received from our partnered brands.</span>)
                                            </div>
{{--                                            <div class="alert alert-danger" id="purchaseattmsg" role="alert">--}}
{{--                                                <b>Purchase Attachment: Please add a screenshot/invoice showing the voucher code you received from our partnered brands.</b>--}}
{{--                                            </div>--}}
                                        </div>

                                        <div class="form-group col-lg-12 col-md-12">
                                            <div class="field">
                                                <input type="text" class="" name="vouchercode" id="vouchercode" onkeyup="javascript:($(this).val()) ? $(this).removeClass('error') : $(this).addClass('error')" placeholder="Voucher Code" data-rule="minlen:4" data-msg="Please enter at least 8 chars of Voucher Code" />
                                                <label for="vouchercode">Voucher Code <span>*</span></label>
                                            </div>
                                            <div class="redeem-label-font redeem-label-color" id="vouchercodemsg">
                                                eg. 0000000000 or 000000-000000
                                            </div>
                                        </div>

                                        <div class="form-group col-lg-12 col-md-12">
                                            <div class="field">
                                                <input type="text" class="" name="purchasedcourse" id="purchasedcourse" onkeyup="javascript:($(this).val()) ? $(this).removeClass('error') : $(this).addClass('error')" placeholder="Purchased Course Name" data-rule="minlen:4" data-msg="Please enter at least 8 chars of Purchased Course Name" />
                                                <label for="purchasedcourse">Purchased Course Name <span>*</span></label>
                                            </div>
                                            <div class="redeem-label-font redeem-label-color" id="purchasedcoursemsg">
                                                eg. British Sign Language level 1 and 2 N.B. *Add comma after each course
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


                                        <div class="form-group col-lg-4 col-md-4 mb-0" id="btn-submit">
                                            <input name="form_botcheck" class="form-control" type="hidden" value="" />
                                            <!--<button type="submit" class="btn btn-success btn-theme-colored" data-loading-text="Please wait..."-->
                                            <!--  style="background-color: rgb(81, 172, 55);">SEND YOUR MESSAGE</button>-->
                                            <div class="wrapper">
                                                <a data-loading-text="Please wait..." onclick="javascript:$('#cfrm').submit();" class="btn btn-primary theme-btn btn-block" id="save"><span>Submit</span></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-8 col-md-8 mb-0" id="btn-submit">&nbsp;</div>
                                </form>
                                {!! Form::close() !!}
                            @endif
                        </div>
                    </div>
                    <!-- ======= Contact Us Form END ======= -->

                </div>
            </div>
        </section>
        <!-- ======= Contact Us Section END ======= -->

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
        $(".topbar-img").hide();
        $(".mobile-topbar-img").hide();

        window.dataLayer=window.dataLayer||[];
        dataLayer.push({
            'pageType': 'contact',
            'country': '<?php echo strtolower(ip_info("Visitor", "Country Code")); ?>',  //Should be based on IP
        });



    </script>

@stop