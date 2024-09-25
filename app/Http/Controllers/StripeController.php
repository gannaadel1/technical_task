<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  Stripe\StripeClient;
use App\Models\Payment;
use Stripe\Exception\ApiErrorException;


class StripeController extends Controller
{
    public $stripe;
    public function __construct()
    {
        $this->stripe=new StripeClient(
            config('stripe.api_key.secret')
        );
    }


    public function index()
    {
        return view('payment');
    }

    public function processPayment(Request $request)
{
    $request->validate([
        'amount' => 'required|numeric|min:1', 
        'stripeToken' => 'required'
    ]);

    try {
        $charge = $this->stripe->charges->create([
            'amount' => $request->amount * 100, 
            'currency' => 'usd',
            'source' => $request->stripeToken,
            'description' => 'Payment for order',
        ]);
        $payment = new Payment();
        $payment->amount = $request->amount; 
        $payment->currency = 'usd';
        $payment->stripe_charge_id = $charge->id; 
        $payment->status = $charge->status; 
        $payment->save(); 

       
        return back()->with('success', 'Payment successful! Charge ID: ' . $charge->id);
    } catch (ApiErrorException $e) {
        return back()->with('error', 'Payment failed: ' . $e->getMessage());
    } catch (\Exception $e) {
        return back()->with('error', 'An error occurred while processing your payment: ' . $e->getMessage());
    }
}

}
