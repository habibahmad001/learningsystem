<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Omnipay\Omnipay;
use App\Payment;
use PayPalHttp\HttpRequest;
use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;
use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;


class PaymentControllerRest extends Controller
{

    public $gateway;
    public $environment;
    public $client;

    public function __construct()
    {
     //   Client id:
//ARYbyWUQ7sYk_cFmGHCqdVDhWED-s_yZJ4VMJi1Yl1RJF5f5lFOBGuQa2kJ3SSAgMDhEKxIGma_MxvTz
// Secret
//EJqNLezQGGnbAU7ZSWVTZGz4a4FdoN1tbhOxllr71R7apDO8jCmj22hJ3xup5jGIt2l_CZWo-Dg2bPa5
        $this->gateway = Omnipay::create('PayPal_Rest');
        $clientid=getSetting('paypal_clientid_sandbox', 'paypalsmart');
        $secret=getSetting('paypal_secretkey_sandbox', 'paypalsmart');
        if(getSetting('account_type','paypalsmart')=='sandbox') {
            $this->gateway->setClientId($clientid);
            $this->gateway->setSecret($secret);
            $this->gateway->setTestMode(true); //set it to 'false' when go live
        }

        $environment = new SandboxEnvironment($clientid, $secret);
        $this->client = new PayPalHttpClient($environment);

    }

    public function index()
    {


        $data['active_class']       = 'orders';
        $data['title']              = getPhrase('orders_list');
        $data['layout']              = getLayout();



        $view_name = getTheme().'::site.payment_rest';
        return view($view_name, $data);

    }
    public function testorder(Request $request)
    {


        $request = new OrdersCreateRequest();
        $request->prefer('return=representation');
        $request->body = [
            "intent" => "CAPTURE",
            "purchase_units" => [[
                "reference_id" => "test_ref_id1",
                "amount" => [
                    "value" => "100.00",
                    "currency_code" => "USD"
                ]
            ]],
            "application_context" => [
                "cancel_url" => "https://example.com/cancel",
                "return_url" => "https://example.com/return"
            ]
        ];

        try {
            // Call API with your client and get a response for your call
            $response = $this->client->execute($request);
//
//            print "Status Code: {$response->statusCode}\n";
//            print "Status: {$response->result->status}\n";
//            print "Order ID: {$response->result->id}\n";
//            print "Intent: {$response->result->intent}\n";
//            print "Links:\n";
//            foreach($response->result->links as $link)
//            {
//                print "\t{$link->rel}: {$link->href}\tCall Type: {$link->method}\n";
//            }

            // If call returns body in response, you can get the deserialized version from the result attribute of the response
            return json_encode((array)$response->result);

        }catch (HttpException $ex) {
            echo $ex->statusCode;
            print_r($ex->getMessage());
        }


    }

    public function testordercapture($order)
    {
        echo "inside capture area";
        echo $order;
        $request = new OrdersCaptureRequest($order);
        $request->prefer('return=representation');
        try {
            // Call API with your client and get a response for your call
            $response = $this->client->execute($request);

            // If call returns body in response, you can get the deserialized version from the result attribute of the response
            print_r($response);
        }catch (HttpException $ex) {
            echo $ex->statusCode;
            print_r($ex->getMessage());
        }

       // return $request;
    }

    public function testsuccess(Request $request){
        dd($request);
    }


    public function charge(Request $request)
    {

        if($request->input('submit'))
        {
            try {
                $response = $this->gateway->purchase(array(
                    'amount' => $request->input('amount'),
                    'currency' => 'USD',
                    'returnUrl' => url('paymentsuccess_rest?slug=3654ea9962ef657ec2fe4065623018210e042026'),
                    'cancelUrl' => url('paymenterror_rest?slug=3654ea9962ef657ec2fe4065623018210e042026'),
                ))->send();

                if ($response->isRedirect()) {
                    $response->redirect(); // this will automatically forward the customer
                } else {
                    // not successful
                    return $response->getMessage();
                }
            } catch(Exception $e) {
                return $e->getMessage();
            }
        }
    }

    public function payment_success(Request $request)
    {

        // Once the transaction has been approved, we need to complete it.
        if ($request->input('paymentId') && $request->input('PayerID'))
        {
            $transaction = $this->gateway->completePurchase(array(
                'payer_id'             => $request->input('PayerID'),
                'transactionReference' => $request->input('paymentId'),
            ));
            $response = $transaction->send();

            if ($response->isSuccessful())
            {
                // The customer has successfully paid.
                $arr_body = $response->getData();


//                Notice: Constant URL_PAYPAL_PAYMENT_SUCCESS already defined in D:\wamp64\www\infinitylive\app\constants.php on line 324
//array:10 [▼
//  "id" => "PAYID-MEF5AEI5Y421750HK5917609"
//  "intent" => "sale"
//  "state" => "approved"
//  "cart" => "30E95981N3184723N"
//  "payer" => array:3 [▶]
//  "transactions" => array:1 [▶]
//  "failed_transactions" => []
//  "create_time" => "2021-08-05T11:48:32Z"
//  "update_time" => "2021-08-05T11:50:46Z"
//  "links" => array:1 [▼
//    0 => array:3 [▼
//      "href" => "https://api.sandbox.paypal.com/v1/payments/payment/PAYID-MEF5AEI5Y421750HK5917609"
//      "rel" => "self"
//      "method" => "GET"
//    ]
//  ]
//]
                // Insert transaction data into the database
                $isPaymentExist = Payment::where('transaction_id', $arr_body['id'])->first();

                if(!$isPaymentExist)
                {
                    $payment = new Payment;
                    $payment->transaction_id = $arr_body['id'];
                    $payment->user_id = $arr_body['payer']['payer_info']['payer_id'];
                    $payment->paid_by = $arr_body['payer']['payer_info']['email'];
                    $payment->paid_amount = $arr_body['transactions'][0]['amount']['total'];
                    $payment->currency = 'USD';
                    $payment->payment_status = $arr_body['state'];
                    $payment->save();
                }

                return "Payment is successful. Your transaction id is: ". $arr_body['id'];
            } else {
                return $response->getMessage();
            }
        } else {
            return 'Transaction is declined';
        }
    }

    public function payment_error()
    {
        return 'User is canceled the payment.';
    }

}