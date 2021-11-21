<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Validator;
use DB;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class DonationController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $available_amounts = ['5','10','20','50', '100'];
        return view('donation.index', ['available_amounts' => $available_amounts]);
    }
    public function create(Request $request)
    {
        $provider = new PayPalClient;
        $data = json_decode($request->getContent(), true);
        
        $provider->setApiCredentials(config('paypal'));
        $token = $provider->getAccessToken();
        $provider->setAccessToken($token);
        $order = $provider->createOrder([
            "intent"=> "CAPTURE",
            "purchase_units"=> [
                 [
                    "amount"=> [
                        "currency_code"=> "USD",
                        "value"=> $data['amount']
                    ],
                     'description' => $data['message'],
                ]
            ],
        ]);
        return response()->json($order);
    }
    public function capture(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $provider = new PayPalClient;
        $orderId = $data['orderId'];
        $message = $data['message'];
        $provider->setApiCredentials(config('paypal'));
        $token = $provider->getAccessToken();
        $provider->setAccessToken($token);
        $result = $provider->capturePaymentOrder($orderId);
        try {
            DB::beginTransaction();
            if($result['status'] === "COMPLETED"){
                $transaction = Transaction::create([
                    'vendor_payment_id' => $orderId,
                    'message' => $message,
                    'email' => $result['payer']['email_address'],
                    'name' => $result['payer']['name']['given_name'].' '.$result['payer']['name']['surname'],
                    'country' => $result['payer']['address']['country_code'],
                    'status' => 'COMPLETED',
                ]);
                DB::commit();
            }
        } catch (Exception $e) {
            DB::rollBack();
            dd($e);
        }
        return response()->json($result);
    }
}
