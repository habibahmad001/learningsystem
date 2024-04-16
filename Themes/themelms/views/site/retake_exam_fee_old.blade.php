@extends('layouts.sitelayout')

@section('content')
    <div class="main-content inner_pages">
        <section class="corporate_section" style="background-image:url('<?=UPLOADS.'images/header_bg/certificate_fee.jpg'?>');">
            <div class="container">
                <div class="row">
                    <div class="col-xl-5 col-lg-6 col-md-7 col-sm-8 col-xs-9 col-12">
                        {{--<h3>A Whole Bunch of Amazing benefits for your Student Card</h3>--}}
                        <h3> Final Exam Retake Fee</h3>
                        {{--<p>We offer all our learners a Student ID card that offers amazing savings across the UK.</p>--}}
                        <p>Get another chance to take the Final Exam again by paying small amount of fee.</p>
                        <a href="#card-area" class="btn btn-primary">Get yours now</a>
                    </div>
                </div>
            </div>
        </section>



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


                            $fee_amount=9.99;
                        ?>
                        <form class="studentId_form new__formStyle" name="std_frm" id="std_frm" method="post" enctype="multipart/form-data" action="{!! URL::to("/addmoney/paypalproexamfee") !!}" onsubmit="return validate_student('');">
                            @include('errors.errors')
                            <h4 onclick="javascript:$('.basicInfo').toggle(300); ($(this).find('i').attr('class') == 'fa fa-angle-down angle-position') ? $(this).find('i').attr('class', 'fa fa-angle-up angle-position') : $(this).find('i').attr('class', 'fa fa-angle-down angle-position')">Your Details <i class="fa fa-angle-up angle-position" aria-hidden="true"></i></h4>
                            {{ csrf_field() }}


                            <div class="row basicInfo">


                                <div class="form-content">
                                    <div class="form-group col-md-12">
                                        <div class="form-row">
                                            <label class="col-md-6 labels">Final Exam Retake Fee</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12 d-none">
                                        <label class="labels">Delivery Method <span>*</span></label>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="optradio" data-price="19.99" checked>UK & International Delivery - {{getSetting('currency_code','site_settings')}} 19.99
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                       {{-- <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="optradio" data-price="19.99">International Tracked &amp; Signed - {{getSetting('currency_code','site_settings')}} 19.99
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>--}}
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="optradio" data-price="39.99">International DHL Express - {{getSetting('currency_code','site_settings')}} 39.99
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Total Fee <b id="card_price">{{getSetting('currency_code','site_settings')}} {{$fee_amount}}</b></label>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="field">
                                            <input type="text" name="user_name" required id="user_name" value="{{$user_name}}" placeholder="User Name">
                                            <label for="user_name">Full Name <span>*</span></label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="field">
                                            <input type="email" name="user_email" required id="user_email" value="{{$user_email}}" placeholder="Email">
                                            <label for="user_email">Email Address <span>*</span></label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="field">
                                            <input type="tel" name="user_phone" required id="user_phone" value="{{$user_phone}}" placeholder="Contact Number">
                                            <label for="user_phone">Contact no. <span>*</span></label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="field">
                                            <input type="text" name="course_title" id="course_title" readonly value="{{$course_title}}" placeholder="Course Title">
                                            <label for="course_title">Course Name <span>*</span></label>
                                        </div>
                                    </div>

                                     <div class="form-group col-md-6">
                                        <div class="field"   >
                                            <input type="datetime-local" name="retake_date" id="retake_date" value="" placeholder="Select Exam Retake Dat">


                                            <label for="retake_date">Expected Exam Retake Date<span>*</span></label>
                                        </div>
                                    </div>


                                </div>



                            </div>
                            <div class="spacer-div"></div>
                            <div class="form-content">


                                <div class="spacer-div"></div>
                                <input type="hidden" type='text' value="{{$fee_amount}}" name="order_amount">
                                <input type="hidden" type='text' value="{{$user_id}}" name="user_id">
                                <input type="hidden" type='text' value="{{$course_id}}" name="course_id">
                                <input type="hidden" name="gateway" id="gateway" value="paypalpro">
                                <input type="hidden" name="type" ng-model="item_type" value="retake-exam-fee">
                                <input type="hidden" name="is_coupon_applied" id="is_coupon_applied" value="0">
                                <input type="hidden" name="coupon_id" id="coupon_id" value="0">
                                <input type="hidden" name="actual_cost" id="actual_cost" value="{{$fee_amount}}">
                                <input type="hidden" name="discount_availed" id="discount_availed" value="{{$fee_amount}}">
                                <input type="hidden" name="after_discount" id="after_discount" value="{{$fee_amount}}">
                                <input type="hidden" name="course_type" id="course_type" value="Free">
                                <?php

                                $productName = "Final Exam Retake Fee";
                                $productDesc = "Retake Fee For another chance of Final Exam";
                                $currency = "GBP";
                                $productPrice = $fee_amount;
                                $productId = $course_id;
                                $orderNumber = $course_id.'-'.$user_id.'-'.$quiz_id;

                                ?>

                                <input type="hidden" name="item_id" id="item_id" value="{{$orderNumber}}">
                                <input type="hidden" name="item_name" id="item_name" value="{{$productName}}">
                                <input type="hidden" name="quiz_id" id="quiz_id" value="{{$quiz_id}}">




                                <h4 onclick="javascript:$('.billInfo').toggle(300); ($(this).find('i').attr('class') == 'fa fa-angle-down angle-position') ? $(this).find('i').attr('class', 'fa fa-angle-up angle-position') : $(this).find('i').attr('class', 'fa fa-angle-down angle-position')">Payment <i class="fa fa-angle-down angle-position" aria-hidden="true"></i></h4>
                                <div class="row billInfo" style="display: none;">

                                    <div class="form-group check__out col-md-12">
                                        <label>
                                            <input type="radio" name="paymentMethod" id="paypalpro" value="st" onclick="javascript:($('#card-div').attr('style') == 'display: none;') ? $('#card-div').fadeIn(300) : $('#card-div').fadeOut(300); $('#std_frm').attr('action', '{!! URL::to("/addmoney/stripe_student") !!}')" checked>
                                            <span class="checkmark"></span>
                                            Process With Credit debit card
                                        </label>


                                        <div id="card-div">
                                            <div class='form-group form-row row'>
                                                <div class='col-xs-12 required'>
                                                    <label class='control-label'>Name on Card<span>*</span></label>
                                                    <input  class='form-control '  required="required" type='text' name="card_name">

                                                    {{--  <input type="hidden" name="course_title" id="course_title" value="{{$course_title}}">
                                                      <input type="hidden" name="user_name" id="user_name" value="{{$user_name}}">
                                                      <input type="hidden" name="user_email" id="user_email" value="{{$user_email}}">--}}
                                                </div>
                                            </div>
                                            <div class='form-group form-row row'>
                                                <div class='col-xs-12 required'>
                                                    <label class='control-label'>Card Number<span>*</span></label>
                                                    <input  required="required" class='form-control card-number' value="" size='16'  maxlength="16" type='text' name="card_no">
                                                </div>
                                            </div>
                                            <div class='form-group form-row row'>
                                                <div class='col-sm-4 col-xs-12 cvc required'>
                                                    <label class='control-label'>CVV<span>*</span></label>
                                                    <input value="" class='form-control  card-cvc' placeholder='ex. 311' size='4' type='text' name="cvvNumber" style="margin-top:0;">
                                                </div>
                                                <div class='col-sm-4 col-xs-12 expiration required'>
                                                    <label class='control-label'>Expiry Month<span>*</span></label>
                                                    <select class="form-control col-sm-2" required="required" data-stripe="exp-month" id="card-exp-month" name="ccExpiryMonth">
                                                        <option>Month</option>
                                                        <option value="01">Jan (01)</option>
                                                        <option value="02">Feb (02)</option>
                                                        <option value="03">Mar (03)</option>
                                                        <option value="04">Apr (04)</option>
                                                        <option value="05">May (05)</option>
                                                        <option value="06">June (06)</option>
                                                        <option value="07">July (07)</option>
                                                        <option value="08">Aug (08)</option>
                                                        <option value="09">Sep (09)</option>
                                                        <option value="10">Oct (10)</option>
                                                        <option value="11">Nov (11)</option>
                                                        <option value="12">Dec (12)</option>
                                                    </select>
                                                    {{--<input class='form-control card-expiry-month' placeholder='MM' size='2' type='text' name="ccExpiryMonth">--}}
                                                </div>
                                                <div class='col-sm-4 col-xs-12  expiration required'>
                                                    <label class='control-label'>Expiry Year<span>*</span></label>
                                                    <select  required="required" class="form-control col-sm-2" data-stripe="exp-year" name="ccExpiryYear" id="card-exp-year">
                                                        <option value="2021">2021</option>
                                                        <option value="2022">2022</option>
                                                        <option value="2023">2023</option>
                                                        <option value="2024">2024</option>
                                                        <option value="2025">2025</option>
                                                        <option value="2026">2026</option>
                                                        <option value="2027">2027</option>
                                                    </select>
                                                    {{--<input class='form-control card-expiry-year' placeholder='YYYY' size='4' type='text' name="ccExpiryYear">--}}
                                                    {{--<input class='form-control card-expiry-year' placeholder='YYYY' size='4' type='hidden' name="amount" value="300">--}}
                                                </div>
                                            </div>
                                        </div>
                                        <br />
                                        <label>
                                            <input type="radio" name="paymentMethod" id="paypal" value="pay" onclick="javascript:$('#card-div').fadeOut(300); $('#std_frm').attr('action', '{!! URL::to("/pay_certificate_fee") !!}')">
                                            <span class="checkmark"></span>
                                            Process With paypal Express Checkout







                                        </label>


                                    </div>


                                    <div class="form-group check__out col-md-12">
                                        <label>
                                            <input type="checkbox" name="i_agree"  required="required" id="i_agree">
                                            <span class="checkmark"></span>
                                            I have read and agree to the website <a href="{!! URL::to("/terms-and-conditions") !!}" class="a-colour" target="_blank">terms and conditions</a>
                                        </label>
                                    </div>
                                    <div class="form-group text-center col-md-12" id="paynow_btn">
                                        <a href="javascript:void(0);" class="btn btn-primary theme-btn btn-block" id="placeorder"  >Place Order</a>
                                        {{--<a href="javascript:void(0);" class="btn btn-primary theme-btn btn-block" onclick="javascript: $('#std_frm').submit();">Place Order</a>--}}
                                    </div>
                                    <div class="form-group text-center col-md-12" style="display: none" id="paypalexpress_btn">
                                        @include('site.partials.paypalcheckout')
                                    </div>

                                </div>
                            </div>

                        </form>

                    </div>
                    <div class="col-lg-3 col-md-2 col-sm-2 col-xs-12"></div>
                </div>
            </div>

        </section>

    </div>


@stop

@section('footer_scripts')
    <script>


        $(document).ready(function() {


            $('input[name="paymentMethod"]').change(function() {
                if ($(':radio[id=paypalpro]').is(':checked')){
                    $("#std_frm").attr("action", "{!! URL::to('/addmoney/paypalproexamfee') !!}");
                    $("#gateway").val('paypalpro');
                    $("#paypalexpress_btn").fadeOut();
                    $("#paynow_btn").fadeIn();
                } else {
                    $("#std_frm").attr("action", "{!! URL::to('/pay_exam_fee') !!}");
                    $("#gateway").val('paypal');
                    $("#paypalexpress_btn").fadeIn();
                    $("#paynow_btn").fadeOut();
                }
            });
            $('input[name="optradio"]').change(function() {
                ($(this).data("price") == 39.00) ? $("#card_price").text("{{getSetting('currency_code','site_settings')}} " + (Number($(this).data("price")) + (0)) + ".00") : $("#card_price").text("{{getSetting('currency_code','site_settings')}} " + (Number($(this).data("price")) + (0)));
                $("#after_discount").val((Number($(this).data("price")) + (0)));
                $("#actual_cost").val((Number($(this).data("price")) + (0)));
                $("input[name=\"order_amount\"]").val((Number($(this).data("price")) + (0)));
            });


            $('#placeorder').click(function () {
                $('#std_frm').submit();
                // HoldOn.open({
                //     theme: 'sk-cube-grid',
                //     message: "<h4>Please wait ... Transaction is under processing </h4>"
                // });
            });


        });
    </script>

@endsection