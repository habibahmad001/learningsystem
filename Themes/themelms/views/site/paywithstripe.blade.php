@extends('layouts.sitelayout')

@section('content')


    <!-- Start main-content -->
    <div class="main-content">
        <!-- Section: inner-header -->
        <section class="inner-header divider layer-overlay overlay-theme-colored-7"
                 data-bg-img="<?=url('/images/bg1.jpg')?>">
            <div class="container pt-20 pb-60">
                <!-- Section Content -->
                <div class="section-content">
                    <div class="row">
                        <div class="col-md-6">
                            <h2 class="text-theme-colored2 font-36">Checkout</h2>
                            <ol class="breadcrumb text-left mt-10 white">
                                <li><a href="<?=url('/')?>">Home</a></li>
                                <li><a href="<?=url('/cart')?>">Shopping Cart</a></li>
                                <li class="active">Checkout</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section>

            <div class="container">
                <div class='row'>
                    <div class='col-md-2'></div>
                    <div class='col-md-6'>
                        <form class="form-horizontal" method="POST" id="payment-form" role="form" action="{!!route('addmoney.stripe')!!}" >
                            {{ csrf_field() }}

                            <div class='form-row'>
                                <div class='col-xs-12 form-group required'>
                                    <label class='control-label'>Card Number</label>
                                    <input  class='form-control card-number' size='20' type='text' value="4242424242424242" name="card_no">
                                </div>
                            </div>
                            <div class='form-row'>
                                <div class='col-xs-4 form-group cvc required'>
                                    <label class='control-label'>CVV</label>
                                    <input  class='form-control card-cvc' value="321" placeholder='ex. 311' size='4' type='text' name="cvvNumber">
                                </div>
                                <div class='col-xs-4 form-group expiration required'>
                                    <label class='control-label'>Expiration</label>
                                    <input class='form-control card-expiry-month' value="11" placeholder='MM' size='2' type='text' name="ccExpiryMonth">
                                </div>
                                <div class='col-xs-4 form-group expiration required'>
                                    <label class='control-label'>Year </label>
                                    <input class='form-control card-expiry-year' value="2020" placeholder='YYYY' size='4' type='text' name="ccExpiryYear">
                                    <input class='form-control card-expiry-year' placeholder='YYYY' size='4' type='hidden' name="amount" value="300">
                                </div>
                            </div>
                            <div class='form-row'>
                                <div class='form-group col-md-6'>
                                    <div class='form-control total btn btn-info'>
                                        Total:
                                        <span class='amount'>$300</span>
                                    </div>
                                </div>
                            </div>
                            <div class='form-row'>
                                <div class='form-group col-md-6'>
                                    <button class='form-control btn btn-primary submit-button' type='submit'>Pay »</button>
                                </div>
                            </div>
                            <div class='form-row'>
                                <div class='col-md-12 error form-group hide'>
                                    <div class='alert-danger alert'>
                                        Please correct the errors and try again.
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class='col-md-2'></div>
                </div>
            </div>
        </section>
    </div>
    <!-- end main-content -->



@stop

@section('footer_scripts')
    <script>

        $(':radio[id=paypal]').change(function () {
            $("#ccform").hide();
            $("#paypalid").show();
            $("#directbank").hide();

        })
        $(':radio[id=creditcart]').change(function () {
            $("#ccform").show();
            $("#paypalid").hide();
            $("#directbank").hide();

        })
        $(':radio[id=bank]').change(function () {
            $("#directbank").show();
            $("#ccform").hide();
            $("#paypalid").hide();

        })

        function submitForm() {


            $('#payform').submit();

        }
    </script>
@stop