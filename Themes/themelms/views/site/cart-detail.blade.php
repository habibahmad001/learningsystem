@extends('layouts.sitelayout')

@section('content')
    <?php
                                    RemoveDeletedItem();
                                    RemoveCartItemFree();
                                    $items = Cart::getContent();
                                    //dd($items);
                                    //$total = \Cart::getTotal();
                                    $total = 0;
                                    $cart_empty=\Cart::isEmpty();
                                    ?>
    <!-- Start main-content -->
    <div class="main-content">
        <!-- Section: inner-header -->
        <section class="inner-header divider layer-overlay overlay-theme-colored-7"  data-bg-img="<?=url('/images/bg1.jpg')?>">
            <div class="container pt-20 pb-60">
                <!-- Section Content -->
                <div class="section-content">
                    <div class="row">
                        <div class="col-md-6">
                            <h2 class="text-theme-colored2 font-36">Shopping Cart</h2>
                            <ol class="breadcrumb text-left mt-10 white">
                                <li><a href="<?=url('/')?>">Home</a></li>
                                <li class="active">Shopping Cart</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="pt-60 pb-60">
            <div class="container pt-0 pb-0">
                <div class="section-content">
                    <div class="row cart_area">
                        @include('errors.errors')
                        @if($cart_empty)
                            <div class="col-md-12 text-center">
                                <h4 class="box_cart p-20 mb-30 text-center text-uppercase">Your cart is empty</h4>
                                <a class='btn btn-primary' href='{{url('/all-courses')}}' type='button'>Browse and Keep Learning </a>
                            </div>
                        @else
                        <div class="col-md-8">
                            <div class="box_cart">
                                <div class="continue_shopping"><a   href="<?=url('/all-courses')?>" class="btn btn-primary">Continue Shopping <i class="fas fa-arrow-right"></i></a></div>
                                <div class="table-responsive">

                                    <table class="table table-striped tbl-shopping-cart cart_shoppingTable">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th><span class="hidMob">Photo</span></th>
                                        <th>Course Name</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <script>var tran_products=[];</script>
                                    <?php
                                    $iscopunapplied = 0;
                                    $discountprice = 0;
                                    $subtotal = \Cart::getTotal();
                                    foreach($items as $item)
                                    {
                                    $item->id; // the Id of the item
                                    $item->name; // the name
                                    $oldprice = 0;
?>
                                            <script>

                                                tran_products.push({
                                                    'sku': '{{$item->id}}',
                                                    'name': '{!!  $item->name !!}',
                                                    'category': '{{getCourseCategory($item->id)}}',
                                                    'price': '{{parsePrice($item->price)}}',
                                                    'quantity': '{{$item->quantity}}'

                                                });
                                            </script>


                                    <?php
                                    if(session()->has('Coupon_code')) {
                                        if(Is_Paid_Course($item->id) == "yes") {
                                            if(empty($CouponData->selectcourses)) {
                                                $iscopunapplied = 1;
                                                $oldprice = $item->price;
                                                $price = ($CouponData->discount_type == "percent") ? $item->price-(($CouponData->discount_value/100)*($item->price)) : ($item->price-$CouponData->discount_value);
                                                //$discountprice += ($item->price)-$price;
                                                $discountprice += ($item->price*$item->quantity)-($price*$item->quantity);
                                            } else {
                                                if(in_array($item->id, explode(",", json_decode($CouponData->selectcourses, true)))) {
                                                    $iscopunapplied = 1;
                                                    $oldprice = $item->price;
                                                    $price = ($CouponData->discount_type == "percent") ? $item->price-(($CouponData->discount_value/100)*($item->price)) : ($item->price-$CouponData->discount_value);
                                                    //$discountprice += ($item->price)-$price;
                                                    $discountprice += ($item->price*$item->quantity)-($price*$item->quantity);
                                                } else {
                                                    $price = $item->price;
                                                        }
                                            }
                                        } else {
                                            $price = $item->price;
                                        }

                                    } else {
                                        $price = $item->price;

                                    }
                                    $item->getPriceSum(); // the subtotal without conditions applied
                                    $item->getPriceWithConditions(); // the single price with conditions applied
                                    $item->getPriceSumWithConditions(); // the subtotal with conditions applied
                                    $item->quantity; // the quantity
                                    $item->attributes; // the attributes

                                    $total = $total + ($price * $item->quantity);
                                    //$subtotal = $subtotal + (Select_Courses_On_ID($item->id)->cost * $item->quantity);
                                    //$subtotal = $subtotal + ($oldprice * $item->quantity);

                                    // Note that attribute returns ItemAttributeCollection object that extends the native laravel collection
                                    // so you can do things like below:
                                    ?>
                                    <tr class="cart_item cart_item_<?=$item->id?>">

                                        <td class="product-remove"><a title="Remove this item" class="remove"
                                                                      data-course-id="{{$item->id}}"
                                                                      data-course-name="{{addslashes($item->title)}}"
                                                                      data-course-price="{{parsePrice(Select_Courses_On_ID($item->id)->cost)}}"
                                                                       data-quantity="{{$item->quantity}}"
                                                                      data-image="{{$item->image}}"
                                                                      onclick="removeToCart({{$item->id}})"><i class="fa fa-trash"></i></a></td>
                                        <td class="product-thumbnail">
                                            <a href="{{URL_VIEW_LMS_CONTENTS.$item->attributes->slug}}">
                                                {!! ($item->attributes->from_gift == 1) ? '<span class="cart_giftit">Gift It</span>' : "" !!}
                                                <img alt="member" src="{{IMAGE_PATH_UPLOAD_LMS_SERIES_THUMB.$item->attributes->image}}">
                                            </a>
                                        </td>

                                        <td class="product-name"><a href="{{URL_VIEW_LMS_CONTENTS.$item->attributes->slug}}"><?=$item->name?></a> @if($oldprice != 0) <span style="font-size: 13px;"> <br />(Regular Price - <?=getCurrencyCode() . parsePrice($oldprice*$item->quantity);?>) <br />(Discount Applied - {!! ((isset($CouponData->coupon_code))) ? parsePrice($CouponData->discount_value) . "% OFF" : "" !!})</span> @endif</td>
                                        {{--<td class="product-price"><span class="amount"><?=getCurrencyCode() . number_format((float)round((Select_Courses_On_ID($item->id)->cost * $item->quantity),2), 2, '.', '')?></span></td>--}}
                                        <td class="product-price"><span class="amount"><?=getCurrencyCode() . parsePrice($item->price)?></span></td>


                                        <td class="product-quantity">
                                                <input type="number" data-id="{{ $item->id}}" id="quantity_<?=$item->id?>" class="input-text qty text" step="1" min="1" max="" name="[qty]" value="<?=$item->quantity?>" title="Qty" size="4" placeholder="" inputmode="numeric">
                                                 </td>
                                        <td class="product-subtotal"><span class="amount"><?=getCurrencyCode() . parsePrice($item->price * $item->quantity)?></span></td>
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

                                    if( $item->attributes->has('size') )
                                    {
                                        // item has attribute size
                                    }
                                    else
                                    {
                                        // item has no attribute size
                                    }
                                    }

                                    ?>





                                    </tbody>
                                </table>
                                </div>
                                <div class="row">
                                    <div class="col-xs-6"><button type="button" id="emptycartbtn" ng-click="clearCart()" class="btn btn-primary">Empty Cart</button> </div>
                                     <div class="col-xs-6">
                                         <button style="float: right;" id="updatecartbtn" disabled="disabled" type="button" ng-click="updateQuantity()" class="btn btn-primary">Update Cart</button>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 ">
                            <div class="view__cartSummary">
                                <h4>Cart Totals</h4>
                                <table class="table table-bordered">
                                    <tbody>
                                    <tr>
                                        <td>Cart Subtotal</td>
                                        <td><?=getCurrencyCode() . parsePrice($subtotal);?></td>
                                    </tr>

                                    @if(session()->has('Coupon_code') && $iscopunapplied == 1)
                                        @if(isset($code_value))
                                        <tr id="successrow">
                                            <td colspan="2" class="successGreen"><center>Coupon Code Applied Successfully!</center></td>
                                        </tr>
                                        @endif
                                        <tr>
                                            <td>Coupon Applied</td>
                                            <td>{!! $CouponData->coupon_code !!}</td>
                                        </tr>
                                        <tr>
                                            <td>Discount Amount</td>
                                            <td><?=getCurrencyCode() . parsePrice($discountprice)?></td>
                                        </tr>
                                    @endif
                                    @if(isset($Coupon) && ($Coupon == "non" || $iscopunapplied == 0))
                                        <td colspan="2"><center>Invalid Coupon Code!</center></td>
                                    @endif
                                    <tr>
                                        <td>Order Total</td>
                                        <td><?php echo getCurrencyCode() . parsePrice($total);?></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <form action="{{ URL::to('cart') }}" name="coupon_frm" id="coupon_frm" method="post" role="form" class="php-email-form new__formStyle">
                                <div class="apply-coupon">
                                    {{ csrf_field() }}
                                    @if(getSetting('coupons', 'module') ==  '1')
                                        <div class="form-group mb-0 row row-sm-padding">
                                            <div class="col-lg-8 col-md-9 col-sm-9 col-xs-8">
                                                <input type="text" id="coupon_code" name="coupon_code" value="{!! (isset($CouponData->coupon_code)) ? "" : "" !!}" class="form-control apply-input-lg" placeholder="{{getPhrase('enter_coupon_code')}}" ng-disabled="isApplied" >
                                            </div>
                                            <div class="col-lg-4 col-md-3 col-sm-3 col-xs-4">
                                                <button style="margin-top: 0px" class="btn btn-primary apply-input-button" name="applycoupon" id="applycoupon" type="button">{{getPhrase('apply')}}</button>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </form>
                            <div class="pt-30">
                                <a href="{{ url('/checkout') }}"  class="btn btn-block btn-primary mb-0">Proceed to Checkout</a>
                                {{--COMMENDETED DUE TO NEW CHECKOUT SETUP--}}
                                {{--@if(Auth::check())--}}
                                    {{--<a href="{{ url('/checkout') }}"  class="btn btn-block btn-primary mb-0">Proceed to Checkout</a>--}}
                                {{--@else--}}
                                    {{--<a href="javascript:void(0);" onclick="gotoLogin()" class="btn btn-block btn-primary mb-0">Proceed to Checkout</a>--}}
                                {{--@endif--}}
                            </div>

                                <div class="text-center pt_6 border-one-gray">
                                    <img src="<?=UPLOADS?>images/trust_logo.png">
                                    <img src="<?=UPLOADS?>images/paypal.png">
                                </div>

                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- end main-content -->



@stop
@section('footer_scripts')
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script language="JavaScript">
        $('#applycoupon').click(function () {
            if($("#coupon_code").val() == "") {
                $("#coupon_code").css("border", "1px solid red");
                return false;
            }
            $("#coupon_frm").submit();




        });
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