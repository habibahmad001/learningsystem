<?php
/*
 * PaypalExpress Class
 * This class is used to handle PayPal API related operations
 * @author    CodexWorld.com
 * @url        http://www.codexworld.com
 * @license    http://www.codexworld.com/license
 */
// Include configuration file
namespace App;
use Illuminate\Database\Eloquent\Model;
use DB;
class PaypalExpress extends Model {
    public $paypalEnv;
    public $paypalURL;
    public $paypalClientID;
    private $paypalSecret;

    public function __construct()
    {
        if(getSetting('account_type','paypalsmart')=='sandbox'){
            $this->paypalClientID=getSetting('paypal_clientid_sandbox','paypalsmart');
            $this->paypalSecret=getSetting('paypal_secretkey_sandbox','paypalsmart');
            $this->paypalURL="https://api.sandbox.paypal.com/v1/";
            $this->paypalEnv="sandbox";
        }else{
            $this->paypalClientID=getSetting('paypal_clientid','paypalsmart');
            $this->paypalSecret=getSetting('paypal_secretkey','paypalsmart');
            $this->paypalURL="https://api.paypal.com/v1/";
            $this->paypalEnv="production";

        }

    }
    public function validate($paymentID, $paymentToken, $payerID, $productID){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->paypalURL.'oauth2/token');
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, $this->paypalClientID.":".$this->paypalSecret);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
        $response = curl_exec($ch);
        curl_close($ch);

        if(empty($response)){
            return false;
        }else{
            $jsonData = json_decode($response);
            $curl = curl_init($this->paypalURL.'payments/payment/'.$paymentID);
            curl_setopt($curl, CURLOPT_POST, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'Authorization: Bearer ' . $jsonData->access_token,
                'Accept: application/json',
                'Content-Type: application/xml'
            ));
            $response = curl_exec($curl);
            curl_close($curl);

            // Transaction data
            $result = json_decode($response);

            return $result;
        }

    }
}