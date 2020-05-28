<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Paystack;
use App\Payments;
use App\Laundry;
use App\KleanaryList;


class PaymentController extends Controller
{

    /**
     * Redirect the User to Paystack Payment Page
     * @return Url
     */
    public function redirectToGateway()
    {
        return Paystack::getAuthorizationUrl($amount,$reference,$email,$first_name)->redirectNow();
    }

     public function Resp()
    {
          $klists = new KleanaryList();
        $klists= $klists->List();
        return view('requestresponse',['klists'=>$klists]);
    }

    /**
     * Obtain Paystack payment information
     * @return void
     */
    public function handleGatewayCallback()
    {
        $paymentDetails = Paystack::getPaymentData();
        $pay = new Payments();
        //echo $paymentDetails;
        
        if ($paymentDetails['status']=='success') {
              $txref= $paymentDetails['data']['reference'];

        $laundry = Laundry::where('txref','=',$txref)->first();

        $pay->txref = $txref;
         $pay->uid = $laundry->user_id;
          $pay->status = $paymentDetails['status'];
           $pay->totalamount = $paymentDetails['data']['amount'];
            $pay->lid = $laundry->id;
            $pay->branch = $laundry->picker;
             $laundry->paymentstatus = 'success';
             $laundry->update();
            $pay->save();

 
return response()->json('requestresponse',['laundry'=>$laundry,'preturn'=>$paymentDetails['data']['amount'],'status'=>$paymentDetails['status']],200);
       
        }

      



       // dd($paymentDetails);
        // Now you have the payment details,
        // you can store the authorization_code in your db to allow for recurrent subscriptions
        // you can then redirect or do whatever you want
        
    }
}