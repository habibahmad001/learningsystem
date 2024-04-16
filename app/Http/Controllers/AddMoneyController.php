<?php
namespace App\Http\Controllers;
use App\Http\Requests;
use Illuminate\Http\Request;
use Validator;
use URL;
use Session;
use Redirect;
use Input;
use App\User;
use Stripe\Error\Card;
use Cartalyst\Stripe\Stripe;
class AddMoneyController extends Controller
{
    public function payWithStripe()
    {
        $data['active_class'] = 'lms';
        $view_name = getTheme().'::site.paywithstripe';
        return view($view_name,$data);
        //return view('paywithstripe');
    }
    public function postPaymentWithStripe(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'card_no' => 'required',
            'ccExpiryMonth' => 'required',
            'ccExpiryYear' => 'required',
            'cvvNumber' => 'required',
            //'amount' => 'required',
        ]);
        $input = $request->all();
        if ($validator->passes()) {

            $input = array_except($input,array('_token'));
            try {
             \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            $token = \Stripe\Token::create(array(
                "card" => array(
                    'number' => $request->get('card_no'),
                    'exp_month' => $request->get('ccExpiryMonth'),
                    'exp_year' => $request->get('ccExpiryYear'),
                    'cvc' => $request->get('cvvNumber'),
                    'name' => $request->get('card_name')
                )));



//            $token = $stripe->token()->create([
//                    'card' => [
//                        'number' => $request->get('card_no'),
//                        'exp_month' => $request->get('ccExpiryMonth'),
//                        'exp_year' => $request->get('ccExpiryYear'),
//                        'cvc' => $request->get('cvvNumber'),
//                    ],
//                ]);


            //            try {
//
//                $token = $stripe->tokens()->create([
//                    'card' => [
//                        'number' => $request->get('card_no'),
//                        'exp_month' => $request->get('ccExpiryMonth'),
//                        'exp_year' => $request->get('ccExpiryYear'),
//                        'cvc' => $request->get('cvvNumber'),
//                    ],
//                ]);
//                echo $token['id'];
//                dd($stripe->tokens());

                // $token = $stripe->tokens()->create([
                // 'card' => [
                // 'number' => '4242424242424242',
                // 'exp_month' => 10,
                // 'cvc' => 314,
                // 'exp_year' => 2020,
                // ],
                // ]);


                if (!isset($token['id'])) {
                    $view_name = getTheme().'::site.paywithstripe';
                    return redirect()->route($view_name);
//                    return redirect()->route('addmoney.paywithstripe');
                }
                $customer=\Stripe\Customer::all(["limit" => 1,"email" => 'imran@abiginc.com']);
//                $customer =  \Stripe\Customer::create([
//                    'email' => 'imran@abiginc.com',
//                ]);
//                echo $customer->data[0]->id;
//                dd($customer);


                $customer_id=$customer->data[0]->id;
                $customer = \Stripe\Customer::retrieve($customer_id);
                $customer->sources->create(["source" => $token['id']]);

                $charge = \Stripe\Charge::create([
                    'customer' =>$customer_id,
                    'currency' => 'GBP',
                    'amount' =>$request->get('order_amount')*100,
                    'description' => 'Add in wallet',
 ]);

 if($charge['status'] == 'succeeded') {
     /**
      * Write Here Your Database insert logic.
      */
     echo "<pre>";
 print_r($charge);exit();
     $view_name = getTheme().'::site.paywithstripe';
     return redirect()->route($view_name);

// return redirect()->route('addmoney.paywithstripe');
 } else {
     \Session::put('error','Money not add in wallet!!');
     $view_name = getTheme().'::site.paywithstripe';
     return redirect()->route($view_name);
// return redirect()->route('addmoney.paywithstripe');
 }
 } catch (Exception $e) {
                \Session::put('error',$e->getMessage());
                print($e->getMessage());
                return redirect()->route('addmoney.paywithstripe');
            } catch(\Cartalyst\Stripe\Exception\CardErrorException $e) {
                print($e->getMessage());
                \Session::put('error',$e->getMessage());
                return redirect()->route('addmoney.paywithstripe');
            } catch(\Cartalyst\Stripe\Exception\MissingParameterException $e) {
                print($e->getMessage());
                \Session::put('error',$e->getMessage());
                return redirect()->route('addmoney.paywithstripe');
            }
        }
    }
}