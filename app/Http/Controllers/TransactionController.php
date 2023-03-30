<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    private $duitkuConfig;

    public function __construct()
    {
        $this->duitkuConfig = new \Duitku\Config("d554deee413a416bed29883ec3b0420b","DS15355");
        // false for production mode
        // true for sandbox mode
        $this->duitkuConfig->setSandboxMode(true);
        // set sanitizer (default : true)
        $this->duitkuConfig->setSanitizedMode(false);
        // set log parameter (default : true)
        $this->duitkuConfig->setDuitkuLogs(false);
    }

    public function create()
    {
        $paymentAmount      = 10000; // Amount
        $email              = "customer@gmail.com"; // your customer email
        $phoneNumber        = "081234567890"; // your customer phone number (optional)
        $productDetails     = "Test Payment";
        $merchantOrderId    = "".Str::random(10).""; // from merchant, unique   
        $additionalParam    = ''; // optional
        $merchantUserInfo   = ''; // optional
        $customerVaName     = 'John Doe'; // display name on bank confirmation display
        $callbackUrl        = route('landing-page.transaction.callback'); // url for callback
        $returnUrl          = route('landing-page.transaction.return'); // url for redirect
        $expiryPeriod       = 60; // set the expired time in minutes

        // Customer Detail
        $firstName          = "John";
        $lastName           = "Doe";

        // Address
        $alamat             = "Jl. Kembangan Raya";
        $city               = "Jakarta";
        $postalCode         = "11530";
        $countryCode        = "ID";

        $address = array(
            'firstName'     => $firstName,
            'lastName'      => $lastName,
            'address'       => $alamat,
            'city'          => $city,
            'postalCode'    => $postalCode,
            'phone'         => $phoneNumber,
            'countryCode'   => $countryCode
        );

        $customerDetail = array(
            'firstName'         => $firstName,
            'lastName'          => $lastName,
            'email'             => $email,
            'phoneNumber'       => $phoneNumber,
            'billingAddress'    => $address,
            'shippingAddress'   => $address
        );


        // Item Details
        $item1 = array(
            'name'      => $productDetails,
            'price'     => $paymentAmount,
            'quantity'  => 1
        );


        $itemDetails = array(
            $item1
        );

        $params = array(
            'paymentAmount'     => $paymentAmount,
            'merchantOrderId'   => $merchantOrderId,
            'productDetails'    => $productDetails,
            'additionalParam'   => $additionalParam,
            'merchantUserInfo'  => $merchantUserInfo,
            'customerVaName'    => $customerVaName,
            'email'             => $email,
            'phoneNumber'       => $phoneNumber,
            'itemDetails'       => $itemDetails,
            'customerDetail'    => $customerDetail,
            'callbackUrl'       => $callbackUrl,
            'returnUrl'         => $returnUrl,
            'expiryPeriod'      => $expiryPeriod
        );

        try {
            // createInvoice Request
            $responseDuitkuPop = \Duitku\Pop::createInvoice($params, $this->duitkuConfig);

            header('Content-Type: application/json');
            // echo $responseDuitkuPop;
            $decode = json_decode($responseDuitkuPop, true);

            return redirect($decode['paymentUrl']);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function callback(){
        try {
            $callback = \Duitku\Pop::callback($this->duitkuConfig);
        
            header('Content-Type: application/json');
            $notif = json_decode($callback);
        
            var_dump($callback);
        
            if ($notif->resultCode == "00") {
                return "Success";
            } else if ($notif->resultCode == "01") {
                return "Failed";
            }
        } catch (Exception $e) {
            http_response_code(400);
            echo $e->getMessage();
        }
    }

    public function transactionCheck(Request $request){
        try {
            $merchantOrderId = "ADaoKxRoWx";;
            $transactionList = \Duitku\Pop::transactionStatus($merchantOrderId, $this->duitkuConfig);
        
            header('Content-Type: application/json');
            $transaction = json_decode($transactionList);
        
            if ($transaction->statusCode == "00") {
                return "Transaction Success";
            } else if ($transaction->statusCode == "01") {
                return "Transaction Pending";
            } else {
                return "Transaction Failed";
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function return(Request $request){
        return $request;
    }
}
