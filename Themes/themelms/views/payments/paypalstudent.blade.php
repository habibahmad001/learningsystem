@extends('layouts.sitelayout')

@section('content')
    <div class="paypalDiv">
        <center>Process to Paypal ...</center>
    </div>

    <form method="post" name="paypalfrm" id="paypalfrm" action="https://www.sandbox.paypal.com/cgi-bin/webscr">
        <input type="hidden" name="cmd" value="_cart" />
        <input type="hidden" name="upload" value="1" />
        <input type="hidden" name="business" value="habibahmad84@yahoo.com" />
        <input type="hidden" name="item_name_1" value="Student Id Card" />
        <input type="hidden" name="quantity_1" value="1" />
        <input type="hidden" name="amount_1" value="0.01" />{!! $price !!}
        <input type="hidden" name="shipping_1" value="0.01" />
        <input type="hidden" name="handling_1" value="0.01" />
        <input type="hidden" name="tax_1" value="0.01" />
        <input type="hidden" name="currency_code" value="GBP" />
        <input type="hidden" name="return" value="{{ URL::to('/student-id-card?success=suc#card-area') }}" />
        <input type="hidden" name="cancel_return" value="{{ URL::to('/payments/paypal/status-cancel') }}" />
        <input type="hidden" name="lc" value="test lc country" />
    </form>
@stop

@section('footer_scripts')
    <script language="JavaScript">
        $(document).ready(function () {
            $('#paypalfrm').submit();
        });
    </script>
@stop
