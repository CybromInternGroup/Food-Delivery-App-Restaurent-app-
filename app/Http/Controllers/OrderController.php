<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\Orderitem;
use App\Models\Address;
use Razorpay\Api\Api;
use Auth;
use App\Models\User;
use App\Models\Payment;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Collection;
use Session;



class OrderController extends Controller
{    

    public function myorder()
    {    

        $user_id = Auth::user()->id;
        $order_id = Payment::where('status', 1)
                        ->where('user_id', $user_id)
                        ->get('order_id');
        
        if ($order_id) {
                        $orderItem = Orderitem::where('user_id', $user_id)->get(); 
            // $address_id = $orderItem->address_id;
            // $address_id = session::get('address_id');

            // dd($address_id);

            $address=Payment::where('status', 1)
            ->where('user_id', $user_id)
            ->first('address_id');
            $address_id = $address->address_id;
                        // dd($address_id);
            $address = Address::where('id', $address_id)->get();

        } else {
            dd("Order not found.");
        }
    
    if ($order_id) {
        return view('myorder', ['order' => $orderItem,'address'=>$address, 'order_id'=>  $order_id]);
    } else {
        return view('myorder', ['order' => null,'address_id' => null]); 
    }
}


// public function myorder()
// {    
//     $user_id = Auth::user()->id;

    
//     $payment = Payment::where('status', 1)
//                     ->where('user_id', $user_id)
//                     ->first(); 

//     if ($payment) {
        
//         $orderItems = Orderitem::where('user_id', $user_id)->get();

        
//         $address_id = $payment->address_id;
//         $address = Address::where('id', $address_id)->first(); 
//         //  dd($address);
//         return view('myorder', [
//             'order' => $orderItems,
//             'address' => $address,
//             'order_id' => $payment->order_id, 
//         ]);
//     } else {
//         dd("Order not found."); 
//     }
// }

    public function addProduct(Request $request, $orderId)
    {   
        $order = Order::findOrFail($orderId);
        $order = Order::with('address')->findOrFail($orderId);

        
        $orderItem = new OrderItem([
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            
        ]);
        $order->Orderitem()->save($orderItem);

        
         $order->update(['created_at' => now()]);

    
        $order = Order::with('address')->findOrFail($orderId);


        $order = Order::findOrFail($orderId);

        return view('myorder', compact('order'));
    }

    
    
    public function addtoCart(Request $request, $id)
{
    
    
    $product = Product::find($id);

    if (!$product) {
        return redirect()->route('cart')->with('error', 'Product not found');
    }

    $user_id = Auth::user()->id;

    
    $order = Order::where('status', false)
                   ->where('user_id', $user_id)
                   ->first();

    
    if ($order) {
        
        $orderItem = Orderitem::where('status', false)
                              ->where('product_id', $id)
                              ->where('order_id', $order->id)
                              ->first();

        
        if ($orderItem) {
            $orderItem->quantity += 1;
            $orderItem->save();
        } else {
            
            $orderItem = new Orderitem();
            $orderItem->status = false;
            $orderItem->product_id = $id;
            $orderItem->user_id = $user_id;
            $orderItem->order_id = $order->id;
            $orderItem->quantity = 1; 
            $orderItem->save();
        }
    } else {
        
        $order = new Order();
        $order->user_id = $user_id;
        $order->status = false;
        $order->save();

    
        $orderItem = new Orderitem();
        $orderItem->status = false;
        $orderItem->product_id = $id;
        $orderItem->user_id = $user_id;
        $orderItem->order_id = $order->id;
        $orderItem->quantity = 1;
        $orderItem->save();
    }


    return redirect()->back()->with('success', 'Product added or updated in the cart successfully');
}



public function removeFromCart($pId) {
    

    $item= Orderitem::find($pId)->delete();
    
    return redirect()->back()->with('success', 'Item removed successfully.');
}

public function viewcart()
{
    $user_id = Auth::user()->id;

    
    $orders = Orderitem::with('product')
                    ->where('user_id', $user_id)
                    ->get();
              
    return view('cart', compact('orders'));
    // return view('cart', ['orders' => $orders]);


}

public function cart(){
    $data['order'] = Order::where([['user_id', Auth::id()], ['status', false]])->first();
    return view('cart', $data);
}

public function saveadd(Request $request)
{    
    // dd(request);
    $data = Address::where('user_id', Auth::id())->get();
    // dd($data);
    if ($request->isMethod('post')) {
        $totalPay = $request->input('netpayable', session('totalPay', 0));
        $request->session()->put('totalPay', $totalPay);

        $data = Address::where('user_id', Auth::id())->get();
        return view('checkout', compact('totalPay', 'data'));
    }
}

// public function updateadd(Request $request)
// {
//     // Debugging
//     // dd("hii");

//     $request->validate([
//         'fullname' => 'required|string|max:255',
//         'alt_contact' => 'required|string|max:15',
//         'landmark' => 'required|string|max:255',
//         'street_name' => 'required|string|max:255',
//         'area' => 'required|string|max:255',
//         'pincode' => 'required|string|max:10',
//         'city' => 'required|string',
//         'state' => 'required|string',
//         'type' => 'required|string',
//     ]);

//     $data = Address::create([
//         'fullname' => $request->fullname,
//         'alt_contact' => $request->alt_contact,
//         'landmark' => $request->landmark,
//         'street_name' => $request->street_name,
//         'area' => $request->area,
//         'pincode' => $request->pincode,
//         'city' => $request->city,
//         'state' => $request->state,
//         'type' => $request->type,
//         'user_id' => auth()->id(),
//     ]);

//     $add = $data->session()->put('address_id', $id);
//     // Fetch saved addresses
//     // $data = Address::where('user_id', auth()->id())->get();
//     dd($add);
//     return view('checkout', compact('data'));
// }

public function updateadd(Request $request)
{
    $request->validate([
        'fullname' => 'required|string|max:255',
        'alt_contact' => 'required|string|max:15',
        'landmark' => 'required|string|max:255',
        'street_name' => 'required|string|max:255',
        'area' => 'required|string|max:255',
        'pincode' => 'required|string|max:10',
        'city' => 'required|string',
        'state' => 'required|string',
        'type' => 'required|string',
    ]);

    
    $address = Address::create([
        'fullname' => $request->fullname,
        'alt_contact' => $request->alt_contact,
        'landmark' => $request->landmark,
        'street_name' => $request->street_name,
        'area' => $request->area,
        'pincode' => $request->pincode,
        'city' => $request->city,
        'state' => $request->state,
        'type' => $request->type,
        'user_id' => auth()->id(),
    ]);

    
    session(['address_id' => $address->id]);

    
    $data = Address::where('user_id', auth()->id())->get();

    return view('checkout', compact('data'));
}



public function thankYou()
    {
        
        $message = session('message');
    
        return view('thanku', ['message' => $message]);
    }

}
