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
                                                <input id="checkuot-form-fname" name="first_name"  required="required" type="text" value="{{ old('first_name',trim($user->first_name))}}" class="form-control"
                                                       placeholder="First Name">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="checkuot-form-lname">Last Name<span>*</span></label>
                                                <input id="checkuot-form-lname" name="last_name"  required="required" type="text" class="form-control"  value="{{ old('last_name',trim($user->last_name))}}"
                                                       placeholder="Last Name">
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="checkuot-form-address">Address<span>*</span></label>
                                                    <input id="checkuot-form-address"  required="required" type="text" class="form-control" name="address"   value="{{ old('address',trim($user->address))}}"
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
                                                <input id="checkuot-form-zip" type="text" name="zipcode" size="6" class="form-control" value="{{ old('zipcode')}}"  placeholder="Zip/Postal Code">
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

                                            <?php //print_r($item_info); exit();?>
                                            <tr>
                                                <td class="product-thumbnail">
                                                    <a href="{{URL_VIEW_LMS_CONTENTS.$item_info["custom"]["slug"]}}">
                                                        <img alt="member" src="{{IMAGE_PATH_UPLOAD_LMS_SERIES_THUMB.$item_info["custom"]["image"]}}">
                                                    </a>
                                                </td>
                                                <td><a href="{{URL_VIEW_LMS_CONTENTS.$item_info["custom"]["slug"]}}"><?=$item_info["name"]?></a> x <?=$item_info["qty"]?> </td>
                                                <td><span class="amount imran"><?=getCurrencyCode() . parsePrice($item_info["price"] * $item_info["qty"])?></span></td>
                                            </tr>


                                            <tr>
                                                <td colspan="2">Cart Subtotal</td>
                                                <td><?=getCurrencyCode() . parsePrice($item_info["price"])?></td>
                                            </tr>

                                            <tr>
                                                <td colspan="2">Order Total</td>
                                                <td><?php echo getCurrencyCode() . parsePrice($item_info["price"]);?></td>
                                            </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                    <div class="box_cart">
                                        <h3>Payment Information</h3>

                                        <input type="hidden" type='text' value="<?=parsePrice($item_info["price"])?>" name="order_amount">
                                        <input type="hidden" name="gateway" id="gateway" value="paypalpro">

                                        <input type="hidden" name="type" ng-model="item_type" value="gift-lms">
                                        <input type="hidden" name="is_coupon_applied" id="is_coupon_applied" value="0">
                                        <input type="hidden" name="coupon_id" id="coupon_id" value="1">
                                        <input type="hidden" name="coupon_code" id="coupon_code" value="">
                                        <input type="hidden" name="item_id" id="item_id" value="{{rtrim($item_info["id"], ",")}}">
                                        <input type="hidden" name="item_name" id="item_name" value="{{rtrim($item_info["name"], ",")}}">
                                        <input type="hidden" name="actual_cost" id="actual_cost" value="{{parsePrice($item_info["price"])}}">
                                        <input type="hidden" name="discount_availed" id="discount_availed" value="{!! (isset($CouponData->coupon_code)) ? parsePrice($discountprice) : 0 !!}">
                                        <input type="hidden" name="after_discount" id="after_discount" value="{!! parsePrice($item_info["price"]) !!}">
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



        /*  app.controller('couponsController', function( $scope, $http) {



              $scope.intilizeData = function(data){



                  $scope.ngdiscount = 0;

                  $scope.ngtotal = {{ (isset($item->cost)) ? $item->cost : "" }};

                $scope.isApplied = false;

                return;

            }

            /!**
             * This method will validate the coupon code
             * @param  {[type]} item_name  Name of the item purchasing
             * @param  {[type]} item_type  Item type like lms,combo,quiz
             * @param  {[type]} cost       Cost of the item
             * @param  {[type]} student_id if parent is purchasing, the student_id is non-zero
             * @return {[type]}            [description]
             *!/
            $scope.validateCoupon = function(item_name, item_type, cost, student_id) {

                console.log(item_name+'=='+item_type+'==='+cost+'===='+student_id);

                coupon_code = $scope.coupon_code;



                if(coupon_code === undefined || coupon_code=='')

                    return;
                updated_student_id = student_id;
                //Update the student id i.e., the parent may change his selection
                if(student_id!=0)
                    updated_student_id =  $('#selected_child_id').val();



                route = '{{URL_COUPONS_VALIDATE}}';

                data= {

                    '_method': 'post',

                    '_token':$scope.getToken(),

                    'coupon_code': coupon_code,

                    'item_name': item_name,

                    'item_type': item_type,

                    'cost'     : cost,
                    'student_id'     : updated_student_id

                };



                $http.post(route, data).success(function(result, status) {

                    if(result.status==0) {



                        alertify.error(result.message);

                        return;

                    }

                    else{

                        if(updated_student_id!=0) {
                            $('#childrens_list_div').fadeOut(100);
                        }

                        $scope.test_amount  = result.amount_to_pay;

                        $scope.isApplied        = true;

                        $scope.ngdiscount       = result.discount;

                        $scope.discount_availed = result.discount;

                        $scope.ngtotal          = result.amount_to_pay;

                        $('#is_coupon_applied').val('1');

                        $('#discount_availed').val(result.discount);

                        $('#after_discount').val(result.amount_to_pay);

                        $('#coupon_id').val(result.coupon_id);

                        alertify.success(result.message);

                        return;

                    }



                });

            }





            /!**

             * Returns the token by fetching if from from form

             *!/

            $scope.getToken = function(){

                return  $('[name="_token"]').val();

            }



        });*/

        window.dataLayer=window.dataLayer||[];
        dataLayer.push({
            'pageType': 'course',
            'country': '<?php echo strtolower(ip_info("Visitor", "Country Code")); ?>',  //Should be based on IP
            'courseCurrency': '{{ getSetting('currency','site_settings')}}',
            'transactionProducts': [
                {
                    'sku': '{{$item_info["id"]}}',
                    'name': '{!!  $item_info["name"] !!}',
                    'category': '{{getCourseCategory($item_info["id"])}}',
                    'price': '{{$item_info["price"]}}',
                    'quantity': '{{$item_info["qty"]}}'

                },
            ],

        });
    </script>

@stop
