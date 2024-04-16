@extends('layouts.sitelayout')
<style>
.std_frm .datepicker-days {
    display: block !important;
}
.datepicker-days {
    display: block !important;
}
</style>
@section('content')
    <div class="main-content inner_pages">
        <section class="corporate_section studentpage_banner" style="background-image:url('<?=UPLOADS.'images/header_bg/bg_6.jpg'?>');">
            <div class="container">
                <div class="row">
                    <div class="col-xl-5 col-lg-6 col-md-7 col-sm-8 col-xs-9 col-12">
                        {{--<h3>A Whole Bunch of Amazing benefits for your Student Card</h3>--}}
                        <h3>Surprising Giveaways and Offers with Your Student ID Card</h3>
                        {{--<p>We offer all our learners a Student ID card that offers amazing savings across the UK.</p>--}}
                        <p>Special Discounts and Benefits on your Student ID Card</p>
                        <a href="{!! URL::to("/student-id-card#card-area") !!}" class="btn btn-primary">Get yours now</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="populr_courses pt-60 studentIdBenf">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 img_Idbenf">
                        <img src="<?=UPLOADS?>images/StudentID__Card.png" class="">
                    </div>
                    <div class="col-md-6 ">
                        <h2 class="title text-uppercase">Benefits</h2>
                        <ul>
                            <!--li>Get an additional 5% discount</li-->
                            <li>Indulge in appetising and flavourful delectable at the restaurant of your choice</li>
                            <li>Shop at a range of stores and enjoy the best giveaways</li>
                            <li>Whether its action or drama – get the cheapest movie tickets to your favourite</li>
                            <li>Keep healthy and fit! With discounted gym membership</li>
                            <li>Find a quiet corner in the library to rest and read</li>
                        </ul>
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
                            <h2 class="title text-uppercase">Apply <span class="text-theme-colored2" style="color: rgb(81, 172, 55) !important;">now</span></h2>
                            <p>Fill in the form with the correct details you want to appear on your Student ID Card. Enter your payment details upon submission.</p>
                        </div>

                        @if(isset($_REQUEST["success"]))
                        <div class="alert alert-success" role="alert">
                            <b>Your Order has been send successfully!!</b>
                        </div>
                        @endif

                        @if(isset($_REQUEST["msg"]) && $_REQUEST["msg"] == 1)
                            <div class="alert alert-danger stu_msg" role="alert">
                                <span><i class="fas fa-times-circle"></i> Your card number is incorrect, Please check it!!</span>
                                <span class="glyphicon glyphicon-remove" style="float: right; cursor: pointer;" onclick="javascript:$('.stu_msg').slideUp(300)" aria-hidden="true"></span>
                            </div>
                        @endif

                        <form class="studentId_form new__formStyle form_with_payment" name="std_frm" id="std_frm" method="post" enctype="multipart/form-data" action="{!! URL::to("/addmoney/paypalprostudent") !!}"  >
                            @include('errors.errors', ["removeIT" => "removeDiv"])
                            <h4 onclick="javascript:$('.basicInfo').toggle(300); ($(this).find('i').attr('class') == 'fa fa-angle-down angle-position') ? $(this).find('i').attr('class', 'fa fa-angle-up angle-position') : $(this).find('i').attr('class', 'fa fa-angle-down angle-position')">Your Details <i class="fa fa-angle-up angle-position" aria-hidden="true"></i></h4>
                            <div class="spacer-div"></div>
                            {{ csrf_field() }}
                            <div class="row basicInfo">
                                <div class="form-group col-md-12">
                                    <div class="form-row">
                                        <label class="col-md-7">Are you a Next Learn Academy Student?</label>
                                        <div class="col-md-5">
                                            <div class="form-check form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" id="inlineRadio1" value="option1" name="inlineRadioOptions" onclick="javascript:$('.form-content').fadeIn(300);$('.alter-content').fadeOut(300);" checked>Yes
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" id="inlineRadio2" onclick="javascript:$('.form-content').fadeOut(300);$('.alter-content').fadeIn(300);" value="option2" name="inlineRadioOptions">No
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-12 alter-content" style="display: none;">
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            Please note that you must enrol with a course by visiting the below link.Then you need to follow all the steps mentioned on that page to become our student after which you will be eligible for a student ID card.<br />
                                            <a href="<?=url('/all-courses')?>" class="a-colour" target="_blank">https://nextlearnacademy.com/all-courses</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-content">
                                    <div class="form-group col-md-12">
                                        <div class="form-row">
                                            <label class="col-md-6 labels">Student ID Card - Free </label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="labels">Delivery Method <span>*</span></label>
                                        @if(env('TEST_CARD'))
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio"  class="form-check-input" name="optradio" data-price="{{currencyPrice('1.00')}}" >Test Delivery - {!! formatPrice(1.00,0, false) !!}
                                                 <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        @endif
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio"  class="form-check-input" name="optradio" data-price="{{currencyPrice('4.99')}}" checked>UK Delivery - {!! formatPrice(4.99,0, false) !!}
                                                {{--{{getSetting('currency_code','site_settings')}} 4.99--}}
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio"  class="form-check-input" name="optradio" data-price="{{currencyPrice('9.99')}}">International Tracked &amp; Signed - {!! formatPrice(9.99,0, false) !!}
                                                {{--{{getSetting('currency_code','site_settings')}} 9.99--}}
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="optradio" data-price="{{currencyPrice('49.00')}}">International DHL Express - {!! formatPrice(49.00,0, false) !!}
                                                {{--{{getSetting('currency_code','site_settings')}} 49.00--}}
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Total Fee <i class="{{session('currency_symbol')}}"></i><b id="card_price">{!! currencyPrice(4.99,0, false) !!}</b></label>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="field">
                                            <input type="text" name="f_name" required="required" value="{{ old('f_name',($userflag)?trim($user->name):'')}}"  id="f-name" placeholder="First Name">
                                            <label for="f-name">Full Name <span>*</span></label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="field">
                                            <input type="email" name="std_email"  required="required"  value="{{ old('std_email',($userflag)?trim($user->email):'')}}"  id="std_email" placeholder="Email">
                                            <label for="std_email">Email Address <span>*</span></label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="field">
                                            <input type="text" name="std_tel"  value="{{ old('std_tel',($userflag)?trim($user->phone):'')}}"  required="required"  id="std_tel" placeholder="Contact">
                                            <label for="std_tel">Contact no. <span>*</span></label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="field">
                                            <input  type="text" name="std_dob"   value="{{ old('std_dob',($userflag)?trim($user->dob):'')}}" class="datepicker" required="required"   id="std_dob" placeholder="Date Of Birth">
                                            <label for="std_dob">Date Of Birth <span>*</span></label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="browsSty">
                                            <input type="file" name="image" onchange="ValidateSingleInput(this);" required="required" id="std_photo">
                                        </div>
                                        <small>Please provide a clear head and shoulder passport-style photo of yourself.</small>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="field">
                                            <textarea name="std_adInfo" id="std_adInfo" placeholder="Any Additional Info"></textarea>
                                            <label for="std_adInfo">Any Additional Info </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-content">
                                <h4 onclick="javascript:$('.shipInfo').toggle(300); ($(this).find('i').attr('class') == 'fa fa-angle-down angle-position') ? $(this).find('i').attr('class', 'fa fa-angle-up angle-position') : $(this).find('i').attr('class', 'fa fa-angle-down angle-position')">Shipping Address <i class="fa fa-angle-down angle-position" aria-hidden="true"></i></h4>
                                <div class="spacer-div"></div>
                                <div class="row shipInfo" style="display: none;">
                                    <div class="form-group col-md-12">
                                        <div class="field">
                                            <input type="text" name="std_address"  value="{{ old('std_address',($userflag)?trim($user->address):'')}}"  required="required"  id="std_address" placeholder="Address 1">
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
                                            <input type="text" name="std_city"  required="required"  id="std_city" placeholder="City">
                                            <label for="std_city">City<span>*</span></label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="field">
                                            <input type="text" maxlength="10" name="std_zipcode" id="std_zipcode" placeholder="Zip Code">
                                            <label for="std_zipcode">Zip Code</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="field select_div">
                                            <select name="std_country" id="std_country"  required="required" >
                                                <option value="">Select Country ...</option>
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
                                <input type="hidden" type='text' value="{{currencyPrice(4.99)}}" name="order_amount">
                                <input type="hidden" name="gateway" id="gateway" value="paypalpro">
                                <input type="hidden" name="type" ng-model="item_type" value="studentcard-fee">
                                <input type="hidden" name="is_coupon_applied" id="is_coupon_applied" value="0">
                                <input type="hidden" name="coupon_id" id="coupon_id" value="0">
                                <input type="hidden" name="actual_cost" id="actual_cost" value="{{currencyPrice(4.99)}}">
                                <input type="hidden" name="discount_availed" id="discount_availed" value="0">
                                <input type="hidden" name="after_discount" id="after_discount" value="{{currencyPrice(4.99)}}">
                                <input type="hidden" name="item_id" id="item_id" value="499">
                                <input type="hidden" name="item_name" id="item_name" value="Student ID Card Fee">
                                <input type="hidden" name="coupon_code" id="coupon_code" value="0">
                                <h4 onclick="javascript:$('.billInfo').toggle(300); ($(this).find('i').attr('class') == 'fa fa-angle-down angle-position') ? $(this).find('i').attr('class', 'fa fa-angle-up angle-position') : $(this).find('i').attr('class', 'fa fa-angle-down angle-position')">Payment <i class="fa fa-angle-down angle-position" aria-hidden="true"></i></h4>
                                <div class="spacer-div"></div>
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

        <section class="populr_courses terms__condition pb-60">
            <div class="container">
                <div class="row">
                    <div class="col-md-5 text-center">
                        <img src="<?=UPLOADS?>images/tc__image.png" class="">
                    </div>
                    <div class="col-md-7">
                        <div class="section-title text-left">
                            <h2 class="title text-uppercase">TERMS & CONDITIONS <span class="text-theme-colored2" style="color: rgb(81, 172, 55) !important;">APPLY</span></h2>
                            <div class="term_content scrollbar style-4">
                                <ul>
                                    <li>1) Your Card remains the property of the Next Learn Academy and must be returned when you suspend, withdraw from, or complete your course(s) at Infinity or your enrolment is terminated by the Next Learn Academy.</li>
                                    <li>2) The main objective of this student ID card is to verify that you are a student of Next Learn Academy</li>
                                    <li>3) Your Card is not transferable.</li>
                                    <li>4) You are responsible for use of your Card at all times.</li>
                                    <li>5) Offers you can claim depends on various circumstances and Next Learn Academy is not responsible for benefits you can gain using your Student ID.</li>
                                    <li>6) Next Learn Academy does not have any exclusive ties with any third-party entities currently.</li>
                                    <li>7) You must keep your Card secure.
                                        <ul>
                                            <li>a) You must not give your Card to another person to use.</li>
                                            <li>b) You must keep all personal and account details relating to your Card secure, and user name and account login details.</li>
                                            <li>c) You should not bend or deface your Card or expose it to extreme heat.</li>
                                        </ul>
                                    </li>
                                    <li>8) If your Card is lost, stolen or damaged:
                                        <ul>
                                            <li>a) You should report this immediately to Student Administration Services.</li>
                                            <li>b) You can request a replacement Card for a fee. For details go to Student ID Cards.</li>
                                        </ul>
                                    </li>
                                    <li>9) Next Learn Academy may collect and use information relating to your use of your Card. Any personal information will be handled by Next Learn Academy in accordance with the General Privacy Notice for Students.</li>
                                    <li>10) Next Learn Academy is not responsible for any unauthorised use of your Card or for any loss arising from your failure to comply with these terms and conditions.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>



@stop
@section('footer_scripts')
    <script>
        $(document).ready(function() {
            $('.datepicker').datepicker();
            /*$('input[name="paymentMethod"]').change(function() {
                if ($(':radio[id=paypalpro]').is(':checked')){
                    $("#std_frm").attr("action", "{!! URL::to('/addmoney/paypalpro') !!}");
                    $("#gateway").val('paypalpro');
                } else {
                    $("#std_frm").attr("action", "{!! URL::to('/student-id-card') !!}");
                    $("#gateway").val('paypal');
                }
            });*/
            $('input[name="optradio"]').change(function() {
                ($(this).data("price") == 49.00) ? $("#card_price").text( (Number($(this).data("price")) + (0)) + ".00") : $("#card_price").text((Number($(this).data("price")) + (0)));
                $("#after_discount").val((Number($(this).data("price")) + (0)));
                $("#actual_cost").val((Number($(this).data("price")) + (0)));
                $("input[name=\"order_amount\"]").val((Number($(this).data("price")) + (0)));
            });

           /* $( "#std_frm" ).submit(function( event ) {
                console.log( "Handler for .submit() called." );
                //event.preventDefault();
                $('#genloader').show();
                $('#placeorder').hide();
            });*/

           /* $('#placeorderddd').click(function () {
                console.log(validate_student(''));
                // $('#std_frm').submit();
                // if(validate_student()){
                // $('#genloader').show();
                // }

                // HoldOn.open({
                //     theme: 'sk-cube-grid',
                //     message: "<h4>Please wait ... Transaction is under processing </h4>"
                // });
            });*/


        });
    </script>
@endsection