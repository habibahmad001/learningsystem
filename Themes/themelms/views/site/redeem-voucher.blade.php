@extends('layouts.sitelayout')
@section('header_scripts')
@stop
@section('content')
    <style>
        .new__pgfrmstyle .btn.theme-btn {
            padding: 14px 10px;border-radius:0 !important;
        }
        .redeem-voucherForm .field input, .redeem-voucherForm .field select{
            height: 50px !important;
        }

        .redeem-voucherForm .field input:placeholder-shown + label {
            padding: 0 10px;
        }
        .redeem-voucherForm .field label {
            font-size:13px;
        }

        .field input:placeholder-shown + label{
            cursor: text; padding:0 15px;max-width: 66.66%;white-space:nowrap;overflow: hidden;
            text-overflow: ellipsis;
            transform-origin: left bottom;
            transform: translate(0, 2.425rem) scale(1.15);
            -webkit-transition: translate(0, 2.425rem) scale(1.15);
            -moz-transition: translate(0, 2.425rem) scale(1.15);
            -o-transition: translate(0, 2.425rem) scale(1.15);
        }

        .field input:not(:placeholder-shown) + label, .field input:focus + label{
            padding:0!important;transform: translate(0, 0) scale(1);cursor: pointer;
        }

        @media screen and (min-width:320px) and (max-width:480px) {

            .field input:placeholder-shown + label, .field textarea:placeholder-shown + label {
                text-overflow: ellipsis;transform-origin:left bottom;transform: translate(0, 2.925rem) scale(1.1);padding: 0 10px;
            }
            .field input:not(:placeholder-shown) + label, .field input:focus + label, .field textarea:not(:placeholder-shown) + label, .field textarea:focus + label {
                padding:0;transform: translate(0, 0) scale(1);cursor: pointer;
            }
        }

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
{{--        <section id="home" class="all__coursesHeader overlay-dark-6" style="background-image: url('<?=UPLOADS?>lms/series/offerbanner/470477595.png'); "  >--}}
{{--            <div class="container-fluid pt-80 pb-80 pt-xs-50 pb-xs-50 position-relative text-center  ">--}}
{{--                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 bigger-teh-1930-0n">--}}
{{--                    <p class="multi-banner-main-txt">Redeem a Voucher</p>--}}
{{--                </div>--}}
{{--                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 bigger-teh-1930-0ff"></div>--}}
{{--            </div>--}}
{{--        </section>--}}

        <section class="inner-header divider layer-overlay overlay-theme-colored-9">
            <div class="container pt-50 pb-50">
                <!-- Section Content -->
                <div class="section-content">
                    <div class="row">
                        <div class="col-md-6">
                            <h2 class="text-theme-colored2">Redeem a Voucher</h2>
                            <ol class="breadcrumb text-left mt-10 white">
                                <li><a href="{!! url("/") !!}">Home</a></li>

                                <li class="active">Redeem a Voucher</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--=====End Page Banner=====-->

        <!-- ======= Contact Us Section ======= -->
        <section id="contact" class="contact new__pgfrmstyle redeem-voucherForm pt-50 pb-50">
            <div class="container">
                <div class="text-center">
                    <h3 class="title text-uppercase">Thank you for purchasing the course. <span class="text-theme-colored2" style="color: rgb(81, 172, 55) !important;">Please enter your details below to redeem your voucher.</span></h3>
                </div>

                <div class="row mt-15">
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
                                <form action="{{ URL::to( PREFIX . 'redeem_a_voucher') }}" name="cfrm" id="cfrm" method="post" role="form" enctype="multipart/form-data" class="php-email-form new__formStyle" onSubmit="return redeemvouchervalidation('');">
                                    @include('errors.errors')
                                    @if(session()->has('error_message'))
                                        <div class="success-message-box" style="color: #843534; background: #f2dede;border-color: #ebccd1;">
                                            {{ session()->get('error_message') }}
                                            <div class="cancel"></div>
                                        </div>
                                    @endif
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12">
                                            <div class="field">
                                                <div class="valmsg" id="namemsg"><p class="signuperrorp">Please enter charater only.</p></div>
                                                <input type="text" name="name" id="name" class="form-control" onkeyup="javascript:($(this).val()) ? $(this).removeClass('error') : $(this).addClass('error')" placeholder="Student Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                                                <label for="name">Student Name <span>*</span></label>
                                            </div>
                                        </div>

                                        <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12">
                                            <div class="field">
                                                <input type="text" class="" name="vouchercode" id="vouchercode" onkeyup="javascript:($(this).val()) ? $(this).removeClass('error') : $(this).addClass('error')" placeholder="Voucher Code" data-rule="minlen:4" data-msg="Please enter at least 8 chars of Voucher Code" />
                                                <label for="vouchercode">Voucher Code <span>*</span></label>
                                            </div>
                                        </div>

                                        <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12">
                                            <div class="field">
                                                <input type="text" class="" name="purchasedcourse" id="purchasedcourse" onkeyup="javascript:($(this).val()) ? $(this).removeClass('error') : $(this).addClass('error')" placeholder="Purchased Course Name" value="{!! isset($_REQUEST["coursenamepost"])  ? $_REQUEST["coursenamepost"] : "" !!}" data-rule="minlen:4" data-msg="Please enter at least 8 chars of Purchased Course Name" />
                                                <label for="purchasedcourse">Purchased Course Name <span>*</span></label>
                                            </div>
                                        </div>

                                        <div class="form-group col-lg-12 col-md-6 col-sm-12 col-12"><br />
                                            <div class="field">
                                                <select class="form-control selectarea" name="purchasefrom" onchange="javascript:($(this).val()) ? $(this).removeClass('error') : $(this).addClass('error')" id="purchasefrom" style="background: #fff">
{{--                                                    <option value="">Purchase From: Groupon/Wowcher/Cobone/DailyDealsCY/Great Deals</option>--}}
{{--                                                    <option value="groupon">Groupon</option>--}}
                                                    <option value="wowcher">Wowcher</option>
{{--                                                    <option value="cobone">Cobone</option>--}}
{{--                                                    <option value="dailydealscy">DailyDealsCY</option>--}}
{{--                                                    <option value="greatdeals">Great Deals</option>--}}
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group col-lg-12 col-md-12 valmsg" id="cemailmsg"><br />
                                            <div class=""><p class="signuperrorp">Both email address must be same.</p></div>
                                        </div>

                                        <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12">
                                            <div class="field">
                                                <input type="email" class="form-control" name="email" id="email" onkeyup="javascript:($(this).val()) ? $(this).removeClass('error') : $(this).addClass('error')" placeholder="Student Email Address" data-rule="email" data-msg="Please enter a valid Student Email Address" />
                                                <label for="email">Student Email Address <span>*</span></label>
                                            </div>
                                        </div>

                                        <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12">
                                            <div class="field">
                                                <input type="text" name="cemail" id="cemail" class="form-control" onkeyup="javascript:($(this).val()) ? $(this).removeClass('error') : $(this).addClass('error')" placeholder="Confirm Email" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                                                <label for="cemail">Student Confirm Email <span>*</span></label>
                                            </div>
                                        </div>

                                        <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12">
                                            <div class="field">
                                                <div class="valmsg" id="phonemsg"><p class="signuperrorp">Phone number must be greater then 10 and less then or equal to 15.</p></div>
                                                <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone Number" minlength="10" maxlength="15" />
                                                <label for="phone">Phone Number <span>*</span></label>
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


                                        <div class="form-group col-lg-4 col-md-6 col-sm-12 col-12 mb-0" id="btn-submit">
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