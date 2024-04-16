@extends('layouts.sitelayout')

@section('content')
    <div class="paypalDiv">
        <center>Process to Paypal ...</center>
    </div>
    {{--<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" name="paypalfrm" id="paypalfrm">--}}
    {{--<input type="hidden" name="business" value="habibahmad84@yahoo.com">--}}
    {{--<input type="hidden" name="cmd" value="_cart">--}}
    {{--<input type="hidden" name="add" value="1">--}}
    {{--<input type="hidden" name="item_name" value="ssss">--}}
    {{--<INPUT TYPE="hidden" NAME="return" value="http://ims.freevar.com/detail.php">--}}
    {{--<input type="hidden" name="amount" value="0.95">--}}
    {{--<input type="hidden" name="currency_code" value="USD">--}}
    {{--<input type="hidden" name="on0" value="Size">--}}
    {{--</form>--}}
<?php
    if(getSetting('account_type','paypal')=='sandbox'){
         $action_url="https://www.sandbox.paypal.com/cgi-bin/webscr";
    }else{
         $action_url="https://www.paypal.com/cgi-bin/webscr";
     }
    $business_email=getSetting('email','paypal');
    $currency=getSetting('currency','paypal');
?>
    <form method="post" name="paypalfrm" id="paypalfrm" action="{{$action_url}}">
        <input type="hidden" name="cmd" value="_cart" />
        <input type="hidden" name="upload" value="1" />
        <input type="hidden" name="business" value="{{$business_email}}" />
        <?php
            $count = 1;
            $CartItems = Cart::getContent();

            ?>

        @foreach($CartItems as $item)

            <input type="hidden" name="item_name_<?php  echo $count;?>" value="<?php  echo $item->name;?>" />
            <input type="hidden" name="quantity_<?php  echo $count;?>" value="<?php  echo $item->quantity;?>" />
            <input type="hidden" name="amount_<?php  echo $count;?>" value="<?php  echo $item->price;?>" />
            <input type="hidden" name="item_number_<?php  echo $count;?>" value="<?php  echo $item->id;?>" />
            {{--{{ $item->getPriceSum() }}--}}<?php  //echo $item->price - (($code_value/100)*$item->price);?>
            <?php $count++;

            ?>

        @endforeach
        <input type="hidden" name="no_shipping" value="1">

        {{--<input type="hidden" name="amount" value="{{$total}}">--}}
        {{--<input type="hidden" name="shipping_1" value="0" />--}}
        {{--<input type="hidden" name="handling_1" value="0" />--}}
        {{--<input type="hidden" name="tax_1" value="0" />--}}
        <input type="hidden" name="currency_code" value="{{$currency}}" />
        <input type="hidden" name="return" value="{{ URL::to('/payments/paypal/status-success?coupon_code='.$coupon_code.'&coupon_ID='.$coupon_ID.'&code_value='. $code_value) }}" />
        <input type="hidden" name="cancel_return" value="{{ URL::to('/payments/paypal/status-cancel') }}" />
        {{--<input type="hidden" name="lc" value="test lc country" />--}}
    </form>
@stop

@section('footer_scripts')
    <script language="JavaScript">
        $(document).ready(function () {
            $('#paypalfrm').submit();
        });
    </script>
@stop
