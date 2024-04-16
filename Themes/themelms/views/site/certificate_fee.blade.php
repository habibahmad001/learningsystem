@extends('layouts.sitelayout')
<style>
    .social-btns .btn .fa {line-height: 40px;}
    @media screen and (min-width:320px) and (max-width:966px) {
        .social-btns .btn .fa {line-height:28px; }
    }
</style>
@section('content')
    <div class="main-content inner_pages">
        <section class="corporate_section certificate__HeaderSect" style="background-image:url('<?=UPLOADS.'images/header_bg/certificate_fee.jpg'?>');">
            <div class="container">
                <div class="row">
                    <div class="col-xl-5 col-lg-6 col-md-7 col-sm-8 col-12">
                        {{--<h3>A Whole Bunch of Amazing benefits for your Student Card</h3>--}}
                        <h3>Next Learn Academy Certificates</h3>
                        {{--<p>We offer all our learners a Student ID card that offers amazing savings across the UK.</p>--}}
                        <p>Get an official Certificate from us</p>
                        <a href="#card-area" class="btn btn-primary">Get yours now</a>
                    </div>
                </div>
            </div>
        </section>

@if($certificate)
            <section class="pt-60 pb-60" id="card-area">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-md-2 col-sm-2 col-xs-12"></div>
                        <div class="col-lg-6 col-md-8 col-sm-8 col-xs-12">
                            <div class="section-title text-center">
                                <h2 class="title text-uppercase">Your printed certificate request is already received</h2>
                                <p> Soon you will receive the certificate at your below mailing address.</p>
                                <p> {{$certificate->user_name}}</p>
                                <p> {{$certificate->address1}} {{$certificate->address2}} </p>
                                <p> {{$certificate->city}} {{$certificate->zipcode}}</p>
                                <p> {{$certificate->country}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
    @else

        <section class="pt-60 pb-60" id="card-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-2 col-sm-2 col-xs-12"></div>
                    <div class="col-lg-6 col-md-8 col-sm-8 col-xs-12">
                        <div class="section-title text-center">
                            <h2 class="title text-uppercase">Pay Fee <span class="text-theme-colored2" style="color: rgb(81, 172, 55) !important;">now</span></h2>
                            <p> Enter your payment details upon submission.</p>
                        </div>

                        @if(isset($_REQUEST["success"]))
                        <div class="alert alert-success" role="alert">
                            <b>Your Order has been send successfully!!</b>
                        </div>
                        @endif
<?php


                            $user = auth()->user();
                            $user_id=$user->id;
                            $user_name=$user->name;
                            $user_email=$user->email;
                            $user_phone=$user->phone;


                            $fee_amount=4.99;
                        ?>
                        <form class="studentId_form new__formStyle form_with_payment" name="std_frm" id="std_frm" method="post" enctype="multipart/form-data" action="{!! URL::to("/addmoney/paypalproanonymous") !!}">
                            @include('errors.errors')
                            <h4 onclick="javascript:$('.basicInfo').toggle(300); ($(this).find('i').attr('class') == 'fa fa-angle-down angle-position') ? $(this).find('i').attr('class', 'fa fa-angle-up angle-position') : $(this).find('i').attr('class', 'fa fa-angle-down angle-position')">Your Details <i class="fa fa-angle-up angle-position" aria-hidden="true"></i></h4>
                            {{ csrf_field() }}


                            <div class="row basicInfo">


                                <div class="form-content">
                                    <div class="form-group col-md-12">
                                        <div class="form-row">
                                            <label class="col-md-12 labels" style="font-weight: 500;">
                                                Printed Course Certificate is provided to you <span class="free-bld">FREE</span> and a delivery fee will be charged as below</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="labels" style="font-weight: 700; margin-bottom: 10px!important;">Delivery Options:</div>

                                        <label class="labels">Tracked & Signed <span>*</span></label>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="optradio" data-price="4.99" checked>(United Kingdom and Ireland Only) - {{getSetting('currency_code','site_settings')}} 4.99
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <label class="labels">International Delivery - Tracked & Signed <span>*</span></label>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="optradio" data-price="9.99">(Excluding African & Middle Eastern Countries) - {{getSetting('currency_code','site_settings')}} 9.99
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <label class="labels">DHL International Courier <span>*</span></label>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="optradio" data-price="45.00">(All Countries) - {{getSetting('currency_code','site_settings')}} 45.00
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Total Fee <b id="card_price">{{getSetting('currency_code','site_settings')}} 4.99</b></label>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="field">
                                            <input type="text" name="user_name"  required="required" id="user_name" value="{{$user_name}}" placeholder="User Name">
                                            <label for="user_name">Full Name <span>*</span></label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="field">
                                            <input type="email" name="user_email"  required="required" id="user_email" value="{{$user_email}}" placeholder="Email">
                                            <label for="user_email">Email Address <span>*</span></label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="field">
                                            <input type="tel" name="user_phone"  required="required" id="user_phone" value="{{$user_phone}}" placeholder="Contact Number">
                                            <label for="user_phone">Contact no. <span>*</span></label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="field">
                                            <input type="text" name="course_title" id="course_title" readonly value="{{$course_title}}" placeholder="Course Title">
                                            <label for="course_title">Course Name <span>*</span></label>
                                        </div>
                                    </div>


                                </div>



                            </div>
                            <div class="spacer-div"></div>
                            <div class="form-content">

                                <h4 onclick="javascript:$('.shipInfo').toggle(300); ($(this).find('i').attr('class') == 'fa fa-angle-down angle-position') ? $(this).find('i').attr('class', 'fa fa-angle-up angle-position') : $(this).find('i').attr('class', 'fa fa-angle-down angle-position')">Shipping Address <i class="fa fa-angle-down angle-position" aria-hidden="true"></i></h4>

                                <div class="row shipInfo" style="display: none;">
                                    <div class="form-group col-md-12">
                                        <div class="field">
                                            <input type="text" name="std_address"  required="required" id="std_address" placeholder="Address 1">
                                            <label for="std_address">Address 1<span>*</span></label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="field">
                                            <input type="text" name="std_address2" id="std_address2" placeholder="Address 2 (Optional)">
                                            <label for="std_address2">Address 2 (Optional)</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="field">
                                            <input type="text" name="std_city"  required="required" id="std_city" placeholder="City">
                                            <label for="std_city">City<span>*</span></label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="field">
                                            <input type="text" maxlength="10" name="std_zipcode"  required="required" id="std_zipcode" placeholder="Zip Code">
                                            <label for="std_zipcode">Zip Code<span>*</span></label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="field select_div">
                                            <select name="std_country" id="std_country"  required="required">
                                                <option value=""></option>
                                                @if(count(App\Http\Controllers\SiteController::AllCountries()) > 0)
                                                    @foreach(App\Http\Controllers\SiteController::AllCountries() as $county)
                                                        <option value="{!! $county->nicename !!}">{!! $county->name !!}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <label for="std_country">Select Country<span>*</span></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="spacer-div"></div>
                                <input type="hidden" type='text' value="{{$fee_amount}}" name="order_amount">
                                <input type="hidden" type='text' value="{{$user_id}}" name="user_id">
                                <input type="hidden" type='text' value="{{$course_id}}" name="course_id">
                                <input type="hidden" name="gateway" id="gateway" value="paypalpro">
                                <input type="hidden" name="type" ng-model="item_type" value="certificate-fee">
                                <input type="hidden" name="is_coupon_applied" id="is_coupon_applied" value="0">
                                <input type="hidden" name="coupon_id" id="coupon_id" value="0">
                                <input type="hidden" name="actual_cost" id="actual_cost" value="{{$fee_amount}}">
                                <input type="hidden" name="discount_availed" id="discount_availed" value="{{$fee_amount}}">
                                <input type="hidden" name="after_discount" id="after_discount" value="{{$fee_amount}}">
                                <input type="hidden" name="course_type" id="course_type" value="{{$course_type}}">

                                <h4 onclick="javascript:$('.billInfo').toggle(300); ($(this).find('i').attr('class') == 'fa fa-angle-down angle-position') ? $(this).find('i').attr('class', 'fa fa-angle-up angle-position') : $(this).find('i').attr('class', 'fa fa-angle-down angle-position')">Payment <i class="fa fa-angle-down angle-position" aria-hidden="true"></i></h4>
                                <div class="row billInfo" style="display: none;">

                                    @include('site.partials.payment_forms')
                                </div>
                            </div>

                        </form>

                    </div>
                    <div class="col-lg-3 col-md-2 col-sm-2 col-xs-12"></div>
                </div>
            </div>

        </section>

@endif


@stop
@section('footer_scripts')
    <script>
        $(document).ready(function() {


            /*$('input[name="paymentMethod"]').change(function() {
                if ($(':radio[id=paypalpro]').is(':checked')){
                    $("#std_frm").attr("action", "{!! URL::to('/addmoney/paypalpro') !!}");
                    $("#gateway").val('paypalpro');
                    $("#paypalexpress_btn").fadeOut();
                    $("#paynow_btn").fadeIn();
                } else {
                    $("#std_frm").attr("action", "{!! URL::to('/pay_certificate_fee') !!}");
                    $("#gateway").val('paypal');
                    $("#paypalexpress_btn").fadeIn();
                    $("#paynow_btn").fadeOut();
                }
            });*/
            $('input[name="optradio"]').change(function() {
                ($(this).data("price") == 45.00) ? $("#card_price").text("{{getSetting('currency_code','site_settings')}} " + (Number($(this).data("price")) + (0)) + ".00") : $("#card_price").text("{{getSetting('currency_code','site_settings')}} " + (Number($(this).data("price")) + (0)));
                $("#after_discount").val((Number($(this).data("price")) + (0)));
                $("#actual_cost").val((Number($(this).data("price")) + (0)));
                $("input[name=\"order_amount\"]").val((Number($(this).data("price")) + (0)));
            });

           /* $( "#std_frm" ).submit(function( event ) {
                console.log( "Handler for .submit() called." );
                //event.preventDefault();
                $('#genloader').show();
                $('#placeorder').hide();
                HoldOn.open({
                    theme: 'sk-cube-grid',
                    message: "<h4>Please wait ... Transaction is under processing </h4>"
                });
            });*/
            /*$('#placeorder').click(function () {
                $('#std_frm').submit();
                // HoldOn.open({
                //     theme: 'sk-cube-grid',
                //     message: "<h4>Please wait ... Transaction is under processing </h4>"
                // });
            });*/

        });
    </script>
@endsection