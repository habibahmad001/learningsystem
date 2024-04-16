<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<div class="payment-method">



    <div class="radio">
        <label>
            <input type="radio" name="paymentmethod" id="creditcardpaypal" value="option3" checked> Credit or Debit Card Payment
            <img class="" src="{{UPLOADS.'images/paypal-1c.png'}}">
        </label>
        <div class="" id="ccpaypalform">
            <div class="form-horizontal stripe-form w-100" id="paypalpro-form" role="form" >
                {{ csrf_field() }}
                <div class='form-group row row-sm-padding '>
                    <div class='col-xs-12 '>
                        <label class='control-label'>Name on Card<span>*</span></label>
                        <input  class='form-control card-payment-info'  value=""   type='text' name="card_name">

                    </div>
                </div>
                <div class='form-group row row-sm-padding '>
                    <div class='col-xs-12 '>
                        <label class='control-label'>Card Number<span>*</span></label>
                        <input autocomplete='off'  class='form-control card-number card-payment-info' value="" size='16'   type="text"   maxlength="16"  name="card_no" id="card_no">
                    </div>
                </div>
                <div class='form-group row row-sm-padding'>

                    <div class='col-sm-4 col-xs-12 expiration '>
                        <label class='control-label'>Expiry Month<span>*</span></label>

                        <select class="form-control col-sm-2 card-payment-info"    data-stripe="exp-month" id="card-exp-month" name="ccExpiryMonth">
                            <option value="">Month</option>
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
                    <div class='col-sm-4 col-xs-12  expiration '>
                        <label class='control-label'>Expiry Year<span>*</span></label>
                        <select    class="form-control col-sm-2 card-payment-info"  data-stripe="exp-year" name="ccExpiryYear" id="card-exp-year">
                            <option value="">Year</option>
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
                    <div class='col-sm-4 col-xs-12 cvc '>
                        <label class='control-label'>Security Code<span>*</span></label>
                        <input autocomplete='off' value="" class='form-control  card-cvc card-payment-info'  placeholder='ex. 311' size='4'  maxlength="4" type='text' name="cvvNumber" style="margin-top:0;">
                    </div>
                </div>


            </div>

        </div>

    </div>



    <div class="radio">
        <label>
            <input type="radio" name="paymentmethod" id="paypal" value="option2">PayPal Express Checkout
            <img class="" src="{{UPLOADS.'images/paypal-express.jpg'}}">
        </label>

        <p id="paypalid" style="display: none"> Please use your Order ID as the payment reference. Your course would not be started until the funds cleared in our account.</p>
    </div>

<!--div class="radio">
                                            <label>
                                                <input type="radio" name="paymentmethod" id="bank" value="option3">Direct Bank Transfer <img class="" height="63" src="{{url('/images/bank-transfer.png')}}">
                                            </label>
                                            <p id="directbank" style="display: none">Make your payment directly into our bank account. Please use your Order ID as the payment reference. Please send us a confirmation email / proof of payment to info@infinitytraining.com after you made the payment in order to complete your order.</p>
                                        </div-->
    <div class="w-100" style="display:inline-block">
        @if(urlHasString('checkout'))
        <div class="form-group w-100 check__out">
            <label style="padding-left: 0px;">
                I have read and agree to the website <a href="{!! URL::to("/terms-and-conditions") !!}" class="a-colour" target="_blank">terms and conditions</a>
            </label>
            <button type="button" id="placeorder" class="btn btn-primary pull-right" >Place Order</button>
        </div>
        @else
            <div class="form-group w-100 check__out">
                <label>
                    <input type="checkbox" name="i_agree" class="hidden" id="i_agree">
                    <span class="checkmark"></span>
                    I have read and agree to the website <a href="{!! URL::to("/terms-and-conditions") !!}" class="a-colour" target="_blank">terms and conditions</a>
                </label>
                <button type="button" id="placeorder"   class="btn btn-primary pull-right" >Place Order</button>
            </div>
        @endif
        <div class="w-100 text-right" id="paynow_btn">
            {{--<button type="submit" id="placeorder" class="btn btn-primary pull-right" >Place Order</button>--}}
            {{--<a href="javascript:void(0)"   id="loginplaceorder" class="btn btn-primary pull-right" style="display: none;" >Login to Place Order</a>--}}
            <div style="display: none;" id="genloader">
                <img src="https://infinity-bucket-2020.s3.eu-west-2.amazonaws.com/images/ajax-loader.gif" width="50"> Order Processing ...
            </div>
        </div>
    </div>

</div>

<script>

    $( document ).ready(function($) {


        //Get all the inputs...
        const inputs = document.querySelectorAll('input, select, textarea');

// Loop through them...

        for(let input of inputs) {
            //var first_input = $(".form_with_payment input:text").first().focus();
            //var first_input = $('input[type=text]:visible:enabled:first, textarea:visible:enabled:first')[0];

            //console.log(first_input);
            // Just before submit, the invalid event will fire, let's apply our class there.
            input.addEventListener('invalid', (event) => {
                event.preventDefault();
                //console.log("inside invalid");
                input.classList.add('error');
                $('html, body').animate({
                    scrollTop: ($('.error').first().offset().top-200)
                },500);

            }, true);


            input.addEventListener('focus', (event) => {
                 input.classList.remove('error');

            }),
                input.addEventListener('valid', (event) => {
                    input.classList.remove('error');
                })

        }




        $('#card_no').mask("9999 9999 9999 9999");


        $(document).on('keyup','input',function(){

            $(this).removeClass('error');
        });



        $(document).on('click','#placeorder',function() {

            console.log("on click function  >>"+$(".form_with_payment").attr("action"));
            var validform=false;
            var form = $('.form_with_payment');

            // disable require:

// enable require
            if ($(':radio[id=creditcardpaypal]').is(':checked')) {
                $(".card-payment-info").attr('required', true);
            }else{
                $(".card-payment-info").attr('required', false);
            }

// Trigger HTML5 validity.
             var reportValidity = form[0].checkValidity();

// Then submit if form is OK.
            if(reportValidity){
                validform=true;
            }
            console.log(validform);
            console.log(form[0].checkValidity());
            if(validform){
            @if(Auth::check())

                    $(".form_with_payment").submit();

            @else
                    @if(urlHasString("certificate_request"))
                        //Cookies.set('preurl','/certificate_request');
                        $(".form_with_payment").submit();
                        //$('#LoginModal').modal({show: 'true'});
                    @elseif(urlHasString("student-id-card"))
                        //Cookies.set('preurl','/student-id-card');
                        $('#LoginModal').modal({show: 'true'});
                    @else

                    $(".form_with_payment").submit();
                        //COMMENTED DUE TO NEW CHECKOUT PROCESS
                        {{--@if(Auth::check())--}}
                        //     $(".form_with_payment").submit();
                        {{--@else--}}
                            {{--$('#LoginModal').modal({show: 'true'});--}}
                        {{--@endif--}}
                    @endif
            @endif

            }

        });


    });


    $(':radio[id=creditcardpaypal]').change(function () {
        $("#ccform").slideUp();
        $("#paypalid").slideUp();
        $("#ccpaypalform").slideDown();
        $("#directbank").slideUp();
        $("#paynow_btn").fadeIn();
        $("#paypalexpress_btn").fadeOut();

    })
    $(':radio[id=paypal]').change(function () {
        $("#ccform").slideUp();
        $("#paypalid").slideDown();
        $("#directbank").slideUp();
        $("#ccpaypalform").slideUp();
        $("#paynow_btn").fadeIn();
        $("#paypalexpress_btn").fadeOut();

    })


    $( ".form_with_payment" ).submit(function( event ) {
        console.log( "Handler for .submit() called." );

        if ($(':radio[id=creditcardpaypal]').is(':checked')){

                @if(Auth::check())
                    $(".form_with_payment").attr("action", "{!!route('addmoney.paypalproanonymous')!!}")
                @else
                    $(".form_with_payment").attr("action", "{!! route('addmoney.paypalproanonymous')!!}" )
                @endif

            $("#gateway").val('paypalpro');

        }


        if ($(':radio[id=paypal]').is(':checked')){
            $(".form_with_payment").attr("action", "{!! URL::to("/payments/paypalanonymous") !!}");
            //COMMENTED DUE TO NEW CHECKOUT PROCESS
            {{--@if(urlHasString('certificate_request'))--}}
                {{--$(".form_with_payment").attr("action", "{!! URL::to("/payments/paypalanonymous") !!}");--}}
            {{--@else--}}
                {{--$(".form_with_payment").attr("action", "{!! URL::to("/paypal_process") !!}");--}}
            {{--@endif--}}
            {{--$(".form_with_payment").attr("action", "{!! URL::to("/paypal_process") !!}");--}}
            $("#gateway").val('paypal');


        }

        if ($(':radio').is(':checked')) {

            //event.preventDefault();
            $('#genloader').show();
            $('#placeorder').hide();
            HoldOn.open({
                theme: 'sk-cube-grid',
                message: "<h4>Please wait ... Transaction is under processing </h4>"
            });
        }
    });


</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.js"></script>
