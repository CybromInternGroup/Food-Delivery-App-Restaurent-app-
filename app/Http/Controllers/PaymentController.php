<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use App\Models\Payment;
use App\Models\Order;
use App\Models\Address;
use Auth;


class PaymentController extends Controller
{
    protected $razorpay;

    public function __construct()
    {
        // $this->razorpay = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
    }    
    

    public function Payment(Request $request)
    {
        
        $user = Auth::user();
     
        // dd($request->all());

        
        $paymentId = $request->input('payment_id');
        $amount = $request->input('amount');
        $addressId = $request->input('address_id');

        
        $orderId = rand(99999, 99999999);
    
        
        $payment = Payment::create([
            'user_id' => $user->id,
            'payment_id' => $paymentId,
            'amount' => $amount,
            'order_id' => $orderId,
            'address_id' => $request->address_id, 
            'status' => '1', 
        ]);
    
        
        if ($payment) {
           
            
            return redirect()->route('thank-you')->with('message', 'Payment successful');
        } else {
            
            return response()->json(['success' => false, 'message' => 'Payment failed'], 500);
        }
    }
     

   
    public function callback(Request $request)
    {
        // Handle payment callback logic here
    }
}
