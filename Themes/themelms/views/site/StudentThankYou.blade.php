@extends('layouts.sitelayout')
@section('content')
    <?php

    $orderflag=false;
    $oid="";
    $coupon_code="";
    function getIfSet(&$value, $default = null)
    {
        return isset($value) ? $value : $default;
    }

    $p = getIfSet($_REQUEST['ref']);


    if ($p)
    {

        $oid=$_REQUEST["ref"];

    }
    else{

    ?>  <script>window.location = "{{url('/')}}";</script><?php
    }


    if(isset($oid)){


    $order = \App\Payment::where('id',(int)$oid)
        ->first();
    //dd($order);
    if($order){
    $ordercourses = \App\UserCourses::where('payment_slug',$order->slug)->get();


    $arr=json_decode($order->transaction_record,true);
    $request=(object)$arr;
    if(isset($request->coupon_code)){
        $coupon_code=$request->coupon_code;
    }else{
        $coupon_code="";
    }
    $item_name=$order->item_name;
    $item_id=$order->item_id;
    $user_id=$order->user_id;
    $currency_icon=$order->currency_icon;
    $transaction_id=$order->transaction_id;
    $payment_status=$order->payment_status;
    $order_date=$order->created_at;
    if($order->coupon_applied==1){
        $discount_amount=$order->discount_amount;
        $after_discount=$order->after_discount;
        $order_amount=$order->actual_cost;
    }else{
        $order_amount=$order->actual_cost;
    }

    $payment_gateway=$order->payment_gateway;
    $orderid = makeOrderID($order->id);
    $orderflag=true;

    ?>
    <script>
        window.dataLayer=window.dataLayer||[];
        dataLayer.push({
            'transactionId': '{{$oid}}',
            'country': '<?php echo strtolower(ip_info("Visitor", "Country Code")); ?>',  //Should be based on IP
            'courseCurrency': '{!! $order->currency !!}',
            'promo_code': '{{$coupon_code}}',
            'transactionTotal': '{{$order_amount}}',
            'transactionTax':0,
            'transactionShipping': 0,
            'transactionProducts': [
                    @foreach($ordercourses as $item){
                    <?php
                        $title_c=str_replace('&amp;','&',$item->item_name);
                        $c_category=str_replace('&amp;','&',getCourseCategory($item->item_id));

                        ?>
                    'sku': '{{$item->item_id}}',
                    'name': '{!!  $title_c !!}',
                    'category': '{!! $c_category !!}',
                    'price': '{{$item->item_price}}',
                    'quantity': '{{$item->item_quantity}}',
                    'transactionAffiliation':'{{getAccreditedBy($item->item_id)}}'

                },
                @endforeach
            ],

        });
    </script>
    <?php



    }else{
        abort(404);
    }


    }else{
        abort(404);
    }
    //dd($order);
    ?>

    <div class="main-content inner_pages">

        <section class="thankyou_section pt-60 pb-60">
            <div class="container text-center">
                @if($orderflag)
                    <img src="<?=UPLOADS?>images/thanksyou.png" class="">
                    <h4>Your Order is Complete!</h4>
                    <h5>Your product login details will be emailed to you and should arrive within the next 48 hours.</h5>
                    <h6>Note : Please check your email box including the spam folder to make sure you do not miss out on the login details email.</h6>



                    <ul class="order_list2 wrap">
                        <li>Order Number:</li>
                        <li><strong>{{$orderid}}</strong></li>
                        @if($user_id !== 0)
                            <li>Order By:</li>
                            <li>{{getUserName($user_id)}}</li>
                        @endif
                        <li>Order Date:</li>
                        <li>{{$order_date}}</li>
                        <li>Order Item(s):</li>
                        <li>{!! str_replace(',','<br>',$item_name) !!}</li>
                        <li>Item(s)ID:</li>
                        <li>{{$item_id}}</li>
                        <li>Transaction ID:</li>
                        <li>{{$transaction_id}}</li>
                        <li>Payment Status:</li>
                        <li>{{$payment_status}}</li>
                        @if($order->coupon_applied==1)
                            <li>Actual Cost:</li>
                            <li>{!! getCurrencyCode($currency_icon).$order_amount !!}</li>
                            <li>Discount Availed:</li>
                            <li>{!! getCurrencyCode($currency_icon).$discount_amount !!}</li>
                            <li>Coupon Applied:</li>
                            <li>{{$coupon_code}}</li>
                            <li>After Discount:</li>
                            <li>{!! getCurrencyCode($currency_icon).$after_discount !!}</li>
                            <li>Payment Method:</li>
                            <li>{{ ($payment_gateway == "paypalpro") ? "PayPal Pro (Credit Card)" : ucwords($payment_gateway)}}</li>
                            <li>Order Total:</li>
                            <li>{!! getCurrencyCode().$after_discount !!}</li>
                        @else
                            <li>Payment Method:</li>
                            <li>{{ ($payment_gateway == "paypalpro") ? "PayPal Pro (Credit Card)" : ucwords($payment_gateway)}}</li>
                            <li>Order Total:</li>
                            <li>{!! getCurrencyCode($currency_icon).$order_amount !!}</li>
                        @endif


                    </ul>

                @else
                    <ul class="order_list2 wrap">
                        <li>Order Number:</li>
                        <li><strong>No Order Exist with this Order ID:{{$oid}} </strong></li>
                    </ul>

                @endif
                <p>If you have any further questions, feel free to contact us through <a href="mailto:info@nextlearnacademy.com">info@nextlearnacademy.com</a>
                    or use instant chat on our website for quick support. or else you can contact our hotline:<a href="tel:+442081269090">+44 208 126 9090</a>
                    Our support lines are available <u>Monday-Friday</u> between the hours of <u>8.00 – 17.00</u> in UK time.</p>

                <div class="row">
                    <a href="{{url('/my-courses')}}" class="btn btn-primary">My Courses</a>
                </div>
                <div class="row DivGift" style="display: none;">
                    <a href="javascript:void(0);" id="giftthis" class="btn btn-primary">Proceed to Gift this Course</a>
                </div>


                <div class="text-center links-social">
                    <span>Follow us</span>
                    <a href="https://www.facebook.com/nextlearnacademy" target="_blank" class="facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://twitter.com/NextLearnUK" target="_blank" class="twitter"><i class="fab fa-twitter"></i></a>
                    <a href="https://www.instagram.com/nextlearnacademy/" target="_blank" class="instagram"><i class="fab fa-instagram"></i></a>
                    <a href="https://www.linkedin.com/company/nextlearnacademy" target="_blank" class="linkedin"><i class="fab fa-linkedin-in"></i></a>
                </div>

            </div>
        </section>


    </div>
    <form name="giftthankyou" id="giftthankyou" method="post" action="{!! URL::to("/savegift") !!}" style="display: none;">
        {!! csrf_field() !!}
        <input type="hidden" name="cid" id="cid" value="">
        <input type="hidden" name="gname" id="gname" value="">
        <input type="hidden" name="gcost" id="gcost" value="">
        <input type="hidden" name="gimage" id="gimage" value="">
        <input type="hidden" name="gslug" id="gslug" value="">
        <input type="hidden" name="giftfname" id="fname" value="">
        <input type="hidden" name="giftemail" id="email" value="">
        <input type="hidden" name="giftdate" id="giftdate" value="">
        <input type="hidden" name="giftmessage" id="giftmessage" value="">
        <input type="hidden" name="thankyou" id="thankyou" value="1">
    </form>
@stop
@section('footer_scripts')
    <script language="JavaScript">
        $(document).ready(function () {
            $("#giftthis").click(function(){
                /***** Set form data ******/
                $("#cid").val(sessionStorage.getItem("cid"));
                $("#gname").val(sessionStorage.getItem("gname"));
                $("#gcost").val(sessionStorage.getItem("gcost"));
                $("#gimage").val(sessionStorage.getItem("gimage"));
                $("#gslug").val(sessionStorage.getItem("gslug"));
                $("#fname").val(sessionStorage.getItem("fname"));
                $("#email").val(sessionStorage.getItem("email"));
                $("#giftdate").val(sessionStorage.getItem("giftdate"));
                $("#giftmessage").val(sessionStorage.getItem("giftmessage"));
                sessionStorage.setItem("gslug", "");
                $("#giftthankyou").submit();
                /***** Set form data ******/
            });

            if(sessionStorage.getItem("gslug")) {
                $(".DivGift").show();
                {{--$("#giftthis").attr("href", "{!! URL::to('/gift-course') !!}/" + sessionStorage.getItem("gslug"));--}}
            }
        });
    </script>
@endsection
