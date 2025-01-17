<form action="{{ url('charge_rest') }}" method="post">
    <input type="text" name="amount" />
    <input type="text" value="test course" name="item" />
    {{ csrf_field() }}
    <input type="submit" name="submit" value="Pay Now">
</form>

<div id="smart-button-container">
    <div style="text-align: center;">
        <div id="paypal-button-container"></div>
    </div>
</div>
<script src="https://www.paypal.com/sdk/js?client-id=ARYbyWUQ7sYk_cFmGHCqdVDhWED-s_yZJ4VMJi1Yl1RJF5f5lFOBGuQa2kJ3SSAgMDhEKxIGma_MxvTz&enable-funding=venmo&currency=USD" data-sdk-integration-source="button-factory"></script>
<script>
    function initPayPalButton() {
        paypal.Buttons({
            style: {
                shape: 'rect',
                color: 'gold',
                layout: 'vertical',
                label: 'paypal',

            },

            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{"description":"test description ","amount":{"currency_code":"USD","value":95}}]
                });
            },
            onAuthorize: function (data, actions) {
            return actions.payment.execute()
                .then(function () {
                    console.log(data);
                    {{--//window.location = "{{url('/paypal_express_process')}}?paymentID="+data.paymentID+"&payerID="+data.payerID+"&orderid={{$orderNumber}}&token="+data.paymentToken+"&pid=<?php echo $productId; ?>";--}}
                });
        },

            onApprove: function(data, actions) {
                return actions.order.capture().then(function(orderData) {

                    // Full available details
                    console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));

                    // Show a success message within this page, e.g.
                    const element = document.getElementById('paypal-button-container');
                    element.innerHTML = '';
                    element.innerHTML = '<h3>Thank you for your payment!</h3>';

                    // Or go to another URL:  actions.redirect('thank_you.html');

                });
            },

            onError: function(err) {
                console.log(err);
            }
        }).render('#paypal-button-container');
    }
    initPayPalButton();
</script>

{{--
<html>
<head>

    <meta charset="utf-8"/>

    <!-- Optimal rendering on mobile devices. -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Optimal Internet Explorer compatibility -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- Sample CSS styles for demo purposes. You can override these styles to match your web page's branding. -->
    <link rel="stylesheet" type="text/css" href="https://www.paypalobjects.com/webstatic/en_US/developer/docs/css/cardfields.css"/>

</head>
<body>

<!-- JavaScript SDK -->
<script src="https://www.paypal.com/sdk/js?components=buttons,hosted-fields&client-id=ARYbyWUQ7sYk_cFmGHCqdVDhWED-s_yZJ4VMJi1Yl1RJF5f5lFOBGuQa2kJ3SSAgMDhEKxIGma_MxvTz" data-client-token="eyJicmFpbnRyZWUiOnsiYXV0aG9yaXphdGlvbkZpbmdlcnByaW50IjoiMWNmYzljMzUxZmRlNWFhN2UxNjA0NDUwZWYwYzY2MjYzM2I1ZjIwMGYyZTgzOWNhMjdkMjZmODgwZTZjYzI3ZHxtZXJjaGFudF9pZD1yd3dua3FnMnhnNTZobTJuJnB1YmxpY19rZXk9NjNrdm4zN3Z0MjlxYjRkZiZjcmVhdGVkX2F0PTIwMjEtMDgtMDRUMTE6MTQ6NTIuNjYzWiIsInZlcnNpb24iOiIzLXBheXBhbCJ9LCJwYXlwYWwiOnsiaWRUb2tlbiI6ImV5SnJhV1FpT2lJNE5URmhNakF6WWpRNU5ESTBaR0l5T0RaaFpEVXhZalkzWVdaak9HSTNNeUlzSW5SNWNDSTZJa3BYVkNJc0ltRnNaeUk2SWxKVE1qVTJJbjAuZXlKcGMzTWlPaUpvZEhSd2N6b3ZMMkZ3YVM1ellXNWtZbTk0TG5CaGVYQmhiQzVqYjIwaUxDSmhZM0lpT2xzaVkyeHBaVzUwSWwwc0ltRjFaQ0k2SWtGU1dXSjVWMVZSTjNOWmExOWpSbTFIU0VOeFpGWkVhRmRGUkMxelgzbGFTalJXVFVwcE1WbHNNVkpLUmpWbU5XeEdUMEpIZFZGaE1tdEtNMU5UUVdkTlJHaEZTM2hKUjIxaFgwMTRkbFI2SWl3aWNtOXNaU0k2SWsxRlVrTklRVTVVSWl3aVlYVjBhRjkwYVcxbElqb3hOakk0TURjMU5qa3lMQ0poZWlJNkltZGpjQzV6YkdNaUxDSnpZMjl3WlhNaU9sc2lRbkpoYVc1MGNtVmxPbFpoZFd4MElsMHNJbVY0Y0NJNk1UWXlPREEzTmpVNU15d2ljMlZ6YzJsdmJsOXBibVJsZUNJNkltaFNaRVpsVHpObFdWVjVZV1JKTjFCcVRVWk1Va0ZVWTBsV1Z5SXNJbWxoZENJNk1UWXlPREEzTlRZNU15d2lhblJwSWpvaVZUSkJRVXRyTUdWQlZuTnRVR0ZRVFVsMWFrTlFiVk5HWlhWemVFOUtNazlPWDFsRExUaFFaWEI2Tm5wdk5HOXpaRlV3VkRCRWVYZFVSbVpUWWtSWVMwODRSR0YxYlhodFoxaGtUR1k0YmxFdGNHcFJhVUZIUnpaTmEyVnlkR2REUmtkU1VqTnFURk50UVdGdVNrZFpNRVpETms1WFZHbGZRWFZxVDNGblMxRWlMQ0pqYkdsbGJuUmZhV1FpT2lKQlVsbGllVmRWVVRkeldXdGZZMFp0UjBoRGNXUldSR2hYUlVRdGMxOTVXa28wVmsxS2FURlpiREZTU2tZMVpqVnNSazlDUjNWUllUSnJTak5UVTBGblRVUm9SVXQ0U1VkdFlWOU5lSFpVZWlKOS5UbkgyZ0ZTb0pnVjZ0OHNuVlUyOGdkM01nWjRlTVBJMFhRcXM2SkxJZVR5MkVrZjZLclNVaFY4VVgwY0xZM0Z1bkxsZnR1UFVRNnpKMWZMTXNhX1R1Z2VyT3VCSGRsQjhIY2VydmtYVlNQeDNObFpSN0dQYVQzQW8xLTROeE1IamhiLWNOeEFGbExzUjRtS3hhUGJxWTNEMVAwT3VHS0JMdDdVa0huNzBtLUowY0tFUkRwODJ6UjNHUlN6MElmNWVfbEZFWkkta3NtdDdkX1lvY0lRMXo2UHRPSmFIZ0hqSWVFYzhoX1pCSkMzMXJUT2tUUVg0eDdaci1fVEUxNTlqT01LbVRVN1ZvQXJxRExDMGd6TmY5bENxYlpKR29Sb3dGX2hGS25ZTDJzVDMxLUlGempRd2FLeVF1OVk3aWgya3p5dXRuVWR3ckozSTBURjhjazhINlEiLCJhY2Nlc3NUb2tlbiI6IkEyMUFBSU5jSmVzcVNWSHo0Y2dHUC1fcnk5RFlfX0tGbW12ZFhvcXNkY0R4OEJwSEhGRGNvcGxiRm9iSTljbDU0OGJncjJXUnlwUlVXOWZ5bkRNc1Q1d2pBTHlVeG9lcGcifX0="></script>

<!-- Buttons container -->
<table border="0" align="center" valign="top" bgcolor="#FFFFFF" style="width: 39%">
    <tr>
        <td colspan="2">
            <div id="paypal-button-container"></div>
        </td>
    </tr>
    <tr><td colspan="2">&nbsp;</td></tr>
</table>

<div align="center"> or </div>

<!-- Advanced credit and debit card payments form -->
<div class="card_container">
    --}}
{{--<form id="card-form_" action="{{url('test/paypal/order')}}" method="post">--}}{{--

    <form id="card-form">

        <label for="card-number">Card Number</label><div id="card-number" class="card_field"></div>
        <div>
            <label for="expiration-date">Expiration Date</label>
            <div id="expiration-date" class="card_field"></div>
        </div>
        <div>
            <label for="cvv">CVV</label><div id="cvv" class="card_field"></div>
        </div>
        <label for="card-holder-name">Name on Card</label>
        <input type="text" id="card-holder-name" name="card-holder-name" autocomplete="off" placeholder="card holder name"/>
        <div>
            <label for="card-billing-address-street">Billing Address</label>
            <input type="text" id="card-billing-address-street" name="card-billing-address-street" autocomplete="off" placeholder="street address"/>
        </div>
        <div>
            <label for="card-billing-address-unit">&nbsp;</label>
            <input type="text" id="card-billing-address-unit" name="card-billing-address-unit" autocomplete="off" placeholder="unit"/>
        </div>
        <div>
            <input type="text" id="card-billing-address-city" name="card-billing-address-city" autocomplete="off" placeholder="city"/>
        </div>
        <div>
            <input type="text" id="card-billing-address-state" name="card-billing-address-state" autocomplete="off" placeholder="state"/>
        </div>
        <div>
            <input type="text" id="card-billing-address-zip" name="card-billing-address-zip" autocomplete="off" placeholder="zip / postal code"/>
        </div>
        <div>
            <input type="text" id="card-billing-address-country" name="card-billing-address-country" autocomplete="off" placeholder="country code" />
        </div>
        <br><br>
        <button value="submit" type="submit" id="submit" class="btn">Pay</button>
    </form>
</div>

<!-- Implementation -->
<script>
    let orderId;
    let resdata;

    // Displays PayPal buttons
    paypal.Buttons({
        style: {
            layout: 'horizontal'
        },
        createOrder: function(data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: "1.00"
                    }
                }]
            });
        },
        onApprove: function(data, actions) {
            return actions.order.capture().then(function(details) {
                console.log(details);
                //window.location.href = '/test/success';
            });
        }
    }).render("#paypal-button-container");

    // If this returns false or the card fields aren't visible, see Step #1.
    if (paypal.HostedFields.isEligible()) {

        // Renders card fields
        paypal.HostedFields.render({
            // Call your server to set up the transaction
            createOrder: function () {
                return fetch('/test/paypal/order', {
                    method: 'post'
                }).then(function(res) {
                    console.log("CREATED RESPONSE");
                    console.log(res.json());

                    //orderId = res.id;

                    return res.json();
                });
            },

            styles: {
                '.valid': {
                    'color': 'green'
                },
                '.invalid': {
                    'color': 'red'
                }
            },

            fields: {
                number: {
                    selector: "#card-number",
                    placeholder: "4111 1111 1111 1111"
                },
                cvv: {
                    selector: "#cvv",
                    placeholder: "123"
                },
                expirationDate: {
                    selector: "#expiration-date",
                    placeholder: "11/25"
                }
            }
        }).then(function (cardFields) {
            document.querySelector("#card-form").addEventListener('submit', (event) => {
                event.preventDefault();

                cardFields.submit({
                    // Cardholder's first and last name
                    cardholderName: document.getElementById('card-holder-name').value,
                    // Billing Address
                    billingAddress: {
                        // Street address, line 1
                        streetAddress: document.getElementById('card-billing-address-street').value,
                        // Street address, line 2 (Ex: Unit, Apartment, etc.)
                        extendedAddress: document.getElementById('card-billing-address-unit').value,
                        // State
                        region: document.getElementById('card-billing-address-state').value,
                        // City
                        locality: document.getElementById('card-billing-address-city').value,
                        // Postal Code
                        postalCode: document.getElementById('card-billing-address-zip').value,
                        // Country Code
                        countryCodeAlpha2: document.getElementById('card-billing-address-country').value
                    }
                }).then(function (res) {
                    console.log(res);
                    fetch('/test/order/' + orderId + '/capture', {
                        method: 'post'
                    }).then(function(res) {
                        return res.json();
                    }).then(function (orderData) {
                        // Three cases to handle:
                        //   (1) Recoverable INSTRUMENT_DECLINED -> call actions.restart()
                        //   (2) Other non-recoverable errors -> Show a failure message
                        //   (3) Successful transaction -> Show confirmation or thank you

                        // This example reads a v2/checkout/orders capture response, propagated from the server
                        // You could use a different API or structure for your 'orderData'
                        var errorDetail = Array.isArray(orderData.details) && orderData.details[0];

                        if (errorDetail && errorDetail.issue === 'INSTRUMENT_DECLINED') {
                            return actions.restart(); // Recoverable state, per:
                            // https://developer.paypal.com/docs/checkout/integration-features/funding-failure/
                        }

                        if (errorDetail) {
                            var msg = 'Sorry, your transaction could not be processed.';
                            if (errorDetail.description) msg += '\n\n' + errorDetail.description;
                            if (orderData.debug_id) msg += ' (' + orderData.debug_id + ')';
                            return alert(msg); // Show a failure message
                        }

                        // Show a success message or redirect
                        alert('Transaction completed!');
                    })
                }).catch(function (err) {
                    console.log(err);
                    console.log('Payment could not be captured! ' + JSON.stringify(err))
                });
            });
        });
    } else {
        // Hides card fields if the merchant isn't eligible
        document.querySelector("#card-form").style = 'display: none';
    }
</script>

</body>
</html>--}}
