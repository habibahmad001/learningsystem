<div id="paypal-button-container"></div>
<div id="paypal-button"></div>
<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<?php
        $ProPayPal=0;
if(getSetting('account_type','paypalsmart')=='sandbox'){
    $PayPalClientId=getSetting('paypal_clientid_sandbox','paypalsmart');
    $paypalSecret=getSetting('paypal_secretkey_sandbox','paypalsmart');
    $paypalURL="https://api.sandbox.paypal.com/v1/";
    $PayPalENV="sandbox";
}else{
    $ProPayPal=1;
    $PayPalClientId=getSetting('paypal_clientid','paypalsmart');
    $paypalSecret=getSetting('paypal_secretkey','paypalsmart');
    $paypalURL="https://api.paypal.com/v1/";
    $PayPalENV="production";

}
?>
<script>
    paypal.Button.render({
        env: '<?php echo $PayPalENV; ?>',
        client: {
            <?php if($ProPayPal) { ?>
            production: '{{$PayPalClientId}}',
            <?php } else { ?>
            sandbox: '{{$PayPalClientId}}'
            <?php } ?>
        },
        // Customize button (optional)
        locale: 'en_US',
        style: {
            size: 'large',
            color: 'blue',
            shape: 'rect',
        },
        payment: function (data, actions) {
            return actions.payment.create({

                transactions: [{
                    amount: {
                        total: '{{$productPrice}}',
                        currency: '{{$currency}}'
                    },
                    description: '{{$productDesc}}',
                    custom: '{{$orderNumber}}',
                    item_list: {
                        items: [
                            {
                                name: '{{$productName}}',
                                description: '{{$productDesc}}',
                                quantity: '1',
                                price: '{{$productPrice}}',
                                tax: '0.0',
                                sku: '{{$orderNumber}}',
                                currency: '{{$currency}}'
                            }]
                    }
                }]


            });
        },
        onAuthorize: function (data, actions) {
            return actions.payment.execute()
                .then(function () {
                    console.log(data);
                     window.location = "{{url('/paypal_express_process')}}?paymentID="+data.paymentID+"&payerID="+data.payerID+"&orderid={{$orderNumber}}&token="+data.paymentToken+"&pid=<?php echo $productId; ?>";
                });
        }
    }, '#paypal-button');
</script>