@extends('layouts.sitelayout')

@section('content')
    @php RemoveDeletedItem(); RemoveCartItemFree(); @endphp

    <?php $paypal = getSetting("paypal", "module"); ?>
    <!-- Start main-content -->
    <div class="main-content"  id="toplogin" >
        <!-- Section: inner-header -->
        <section class="inner-header divider layer-overlay overlay-theme-colored-7" >
            <div class="container pt-60 pb-60">
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
                <div class="section-content">

                    <div class="row mt-30">

                        <form id="checkout-form" class="new__formStyle form_with_payment "  method="POST"  role="form" action="{!!route('addmoney.paypalpro')!!}">
                            @include('errors.errors')
                            <div class="col-md-6">

                                <div class="billing-details box_cart">
                                    <h3 class="mb-30">Billing Details</h3>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="checkuot-form-email">Email Address<span>*</span></label>
                                                <input id="checkuot-form-email" type="email"  required="required" name="email" class="form-control"   value="@if($userflag) {{$user->email}} @endif"
                                                       placeholder="Email Address">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="checkuot-form-fname">First Name<span>*</span></label>
                                            <input id="checkuot-form-fname" name="first_name"  required="required" type="text" value="{{ old('first_name', ($userflag)?trim($user->first_name):'')}}" class="form-control"
                                                   placeholder="First Name">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="checkuot-form-lname">Last Name<span>*</span></label>
                                            <input id="checkuot-form-lname" name="last_name"  required="required" type="text" class="form-control"  value="{{ old('last_name',($userflag)?trim($user->last_name):'')}}"
                                                   placeholder="Last Name">
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="checkuot-form-address">Address<span>*</span></label>
                                                <input id="checkuot-form-address"  required="required" type="text" class="form-control" name="address"   value="{{ old('address',($userflag)?trim($user->address):'')}}"
                                                       placeholder="Street address">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Country<span>*</span></label>
                                                <select class="form-control"  required="required" id="country" name="country">
                                                    <option value="">Please Select...</option>
                                                    <?php foreach ($countries as $key=>$countryname): ?>
                                                    <option @if($countryname->id==old('country')) selected="selected" @endif value="<?php echo $countryname->id; ?>"><?php  echo $countryname->nicename  ; ?></option>
                                                    <?php endforeach; ?>
                                                </select>

                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="checkuot-form-city">City<span>*</span></label>
                                            <input id="checkuot-form-city"  required="required" type="text" value="{{ old('city')}}" name="city" class="form-control" placeholder="City">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="checkuot-form-zip">Zip/Postal Code (Optional)</label>
                                            <input id="checkuot-form-zip" type="text" name="zipcode" size="10" class="form-control" value="{{ old('zipcode')}}"  placeholder="Zip/Postal Code">
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="checkuot-form-phoneno">Phone Number (Optional)</label>
                                                <input id="checkuot-form-phoneno"  name="phone" type="text" class="form-control"  value="{{ old('phone')}}" placeholder="Phone Number">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="checkuot-form-cname">Company Name (Optional)</label>
                                                <input id="checkuot-form-cname"  name="company" type="text" class="form-control"  value="{{ old('company')}}" placeholder="Company Name">
                                            </div>
                                        </div>
                                        {{--    <div class="form-group col-md-6">
                                                <label>State/Province</label>
                                                <input id="checkuot-form-state" type="text" class="form-control"
                                                       placeholder="State">
                                            </div>--}}



                                    </div>
                                </div>
                                <div class="desk_div">
                                    @include('site.partials.checkout_stuff')
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="box_cart">
                                    <h3>Your Order Summary</h3>
                                    <table class="table table-striped  tbl-shopping-cart ">
                                        <thead>
                                        <tr>
                                            <th><span class="hidMob">Photo</span></th>
                                            <th>Product Name</th>
                                            <th>Total</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <?php
                                        $item_id="";
                                        $item_name="";
                                        $items = Cart::getContent();
                                        $subtotal = \Cart::getTotal();
                                        $total = 0;
                                        $iscopunapplied = 0;
                                        $discountprice = 0;
                                        $coupon_id=0;
                                        $coupon_code=0;
                                        foreach($items as $item)
                                        {
                                        $item->id; // the Id of the item
                                        $item->name; // the name
                                        $oldprice = 0;
                                        $price = $item->price;

                                        $item->getPriceSum(); // the subtotal without conditions applied
                                        $item->getPriceWithConditions(); // the single price with conditions applied
                                        $item->getPriceSumWithConditions(); // the subtotal with conditions applied
                                        $item->quantity; // the quantity
                                        $item->attributes; // the attributes
                                        $total = $total + ($price * $item->quantity);

                                        // Note that attribute returns ItemAttributeCollection object that extends the native laravel collection
                                        // so you can do things like below:
                                        $item_id.=$item->id.",";
                                        $item_name.=$item->name.",";
                                        ?>
                                        <tr>
                                            <td class="product-thumbnail">
                                                <a href="{{URL_VIEW_LMS_CONTENTS.$item->attributes->slug}}">
                                                    {!! ($item->attributes->from_gift == 1) ? '<span class="cart_giftit">Gift It</span>' : "" !!}
                                                    <img alt="member" src="{{IMAGE_PATH_UPLOAD_LMS_SERIES_THUMB.$item->attributes->image}}">
                                                </a>
                                            </td>
                                            <td class="product-name"><a href="{{URL_VIEW_LMS_CONTENTS.$item->attributes->slug}}"><?=$item->name?></a> x <?=$item->quantity?> @if($oldprice != 0) <span style="font-size: 13px;"> <br />(Regular Price - <?=getCurrencyCode() . parsePrice($oldprice*$item->quantity)?>) <br />(Discount Applied - {!! ((isset($CouponData->coupon_code))) ? parsePrice($CouponData->discount_value) . "% OFF" : "" !!})</span> @endif</td>
                                            <td><span class="amount imran"><?=getCurrencyCode() . parsePrice($price * $item->quantity)?></span></td>
                                        </tr>

                                        <?php
                                        \Cart::update($item->id, array(
                                            'attributes' => array(
                                                'discounted_price' => parsePrice($price * $item->quantity),
                                                'image' => $item->attributes->image,
                                                'slug' => $item->attributes->slug,
                                                'currency' => $item->attributes->currency,
                                                'symbol' => $item->attributes->symbol,
                                                'from_gift' => $item->attributes->from_gift
                                            ),
                                        ));

                                        }

                                        ?>


                                        <tr>
                                            <td colspan="2" class="amt_col">Cart Subtotal</td>
                                            <td><?=getCurrencyCode() . parsePrice($subtotal)?></td>
                                        </tr>
                                        {{--<tr>
                                            <td>Shipping and Handling</td>
                                            <td>&nbsp;</td>
                                            <td>Free Shipping</td>
                                        </tr>--}}
                                        @if(session()->has('Coupon_code') && $iscopunapplied == 1)
                                            <?php
                                            $coupon_id=$CouponData->id;
                                            $coupon_code=$CouponData->coupon_code;
                                            ?>
                                            @if(isset($code_value))
                                                <tr id="successrow">
                                                    <td colspan="3" class="successGreen"><center>Coupon Code Applied Successfully!</center></td>
                                                </tr>
                                            @endif
                                            <tr>
                                                <td colspan="2">Coupon Applied</td>
                                                <td>{!! $CouponData->coupon_code !!}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">Discount Amount</td>
                                                <td class="amt_col"><?=getCurrencyCode() . parsePrice($discountprice)?></td>
                                            </tr>
                                        @endif
                                        @if(isset($Coupon) && ($Coupon == "non" || $iscopunapplied == 0))
                                            <td colspan="3"><center>Invalid Coupon Code!</center></td>
                                        @endif
                                        <tr>
                                            <td colspan="2">Order Total</td>
                                            <td class="amt_col"><?php echo getCurrencyCode() . parsePrice($total);?></td>
                                        </tr>
                                        </tbody>
                                    </table>

                                    @if(last(explode("/", url()->previous())) == "offer-for-3" || last(explode("/", url()->previous())) == "offer-for-5")

                                    @else
                                    @endif

                                </div>
                                <div class="box_cart">
                                    <h3>Payment Information</h3>

                                    <input type="hidden" type='text' value="<?=parsePrice($total)?>" name="order_amount">
                                    <input type="hidden" name="gateway" id="gateway" value="paypalpro">

                                    <input type="hidden" name="type" ng-model="item_type" value="lms">
                                    <input type="hidden" name="is_coupon_applied" id="is_coupon_applied" value="{{ $discountprice > 0 ? '1' : '0' }}">
                                    <input type="hidden" name="coupon_id" id="coupon_id" value="{{$coupon_id}}">
                                    <input type="hidden" name="coupon_code" id="coupon_code" value="{{$coupon_code}}">
                                    <input type="hidden" name="item_id" id="item_id" value="{{rtrim($item_id, ",")}}">
                                    <input type="hidden" name="item_name" id="item_name" value="{{rtrim($item_name, ",")}}">
                                    <input type="hidden" name="actual_cost" id="actual_cost" value="{{parsePrice($subtotal)}}">
                                    <input type="hidden" name="discount_availed" id="discount_availed" value="{!! (isset($CouponData->coupon_code)) ? parsePrice($discountprice) : 0 !!}">
                                    <input type="hidden" name="after_discount" id="after_discount" value="{!! parsePrice($total) !!}">
                                    <input type="hidden" name="chk_login" id="chk_login" value="{!! (Auth::user()) ? Auth::user()->id : 0 !!}">

                                    @include('site.partials.payment_forms')
                                </div>

                                <div class="mobile_div">
                                    @include('site.partials.checkout_stuff')
                                </div>


                            </div>

                        </form>



                    </div>
                </div>
            </div>
        </section>

    </div>
    <!-- end main-content -->

<?php if(GetActiveOfferData(4)->content_status == "active") { $lmsitem = \App\LmsSeries::find(700); $lmsitem->is_paid = 0; $lmsitem->save(); } ?>

@stop

@section("footer_scripts")
    @include("site.scripts.front-js")
    <script>
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();

                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
        $( document ).ready(function($) {
            var a = $('.desk_div').html();
            var b = $('.mobile_div').html(a);

            /******** Hide top bar **********/
            $(".desktop__nav div.main-nav-wrap").hide();
            $(".desktop__nav form").hide();
            $(".desktop__nav div.header__btns").eq(0).hide();
            $(".desktop__nav div.header__btns").eq(0).after('<div style="width: 75%"></div>');
            $(".desktop__nav div.header__btns").eq(1).hide();
            $(".desktop__nav div.header__btns").eq(2).hide();
            $(".desktop__nav div.header__btns").eq(3).hide();
            $(".desktop__nav div.header__btns").eq(4).hide();
            /******** Hide top bar **********/
        });


        $('#applycoupon').click(function () {
            if($("#coupon_codes").val() == "") {
                $("#coupon_codes").css("border", "1px solid red");
                return false;
            }
            $(":radio").prop("checked", false);
            $("#checkout-form").attr("action", "{!! URL::to("/checkout") !!}").submit();
        });

        function submitForm() {


            $('#payform').submit();

        }

        window.dataLayer=window.dataLayer||[];
        dataLayer.push({
            'pageType': 'course',
            'country': '<?php echo strtolower(ip_info("Visitor", "Country Code")); ?>',  //Should be based on IP
            'courseCurrency': '{{ getSetting('currency','site_settings')}}',
            'transactionProducts': [
                    @foreach($items as $item)
                {
                    'sku': '{{$item->id}}',
                    'name': '{!!  $item->name !!}',
                    'category': '{{getCourseCategory($item->id)}}',
                    'price': '{{$item->price}}',
                    'quantity': '{{$item->quantity}}'

                },
                @endforeach
            ],

        });
    </script>

@stop
