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
use Session;



class OrderController extends Controller
{    

    public function myorder()
{
    $user_id = Auth::user()->id;
    $order = Order::with('Orderitem')->where('status', 0)->where('user_id', $user_id)->first();

    if ($order) {
        return view('myorder', ['order' => $order]);
    } else {
        return view('myorder', ['order' => null]); 
    }
}

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

  
        
    public function addtoCart(Request $request, $id){
        // dd($pid);
        $product = Product::find($id);
        // dd($product);

        $user = Auth::user();
        if($product){
            $order = Order::where([['status',false],['user_id',$user->id]])->first();

            if($order){
                $Orderitem = Orderitem::where('status',false)->where('product_id',$id)->where('order_id',$order->id)->first();
                //if orderitem already in a cart
                if($Orderitem){
                    $Orderitem->quantity+= 1;
                    $Orderitem->save();
                }
                else{
                   $Orderitem = new Orderitem();
                   $Orderitem->status = false;
                   $Orderitem->product_id = $id;
                   $Orderitem->order_id = $order->id;
                   $Orderitem->save();
            }
        }
        //if order not exist in cart
        else{
        $order = new Order();
        $order->user_id = $user->id;
        $order->status = false;
        $order->save();

    
    
    }

//need to change with cart page
return redirect()->route('cart')->with('success','product added or updated on cart successfully');
}
else{
    return redirect()->route('home.index')->with('error','product not fonud');
}
}

public function removefromCart(Request $request, $id){
    
    $product = Product::find($id);

    $user = Auth::user();
    
    if($product){
        $order = Order::where([['status',false],['user_id',$user->id]])->first();

        if($order){
            $Orderitem = Orderitem::where('status',false)->where('product_id',$id)->where('order_id',$order->id)->first();
            if($Orderitem){
               if($Orderitem->quantity > 1){
                $Orderitem->quantity -= 1;
                $Orderitem->save();
               }

              else{
               $Orderitem->delete();
              }


            }
               }
    //if order not exist in cart
   

//need to change with cart page
return redirect()->route('cart')->with('success','product updated on cart successfully');
}
else{
return redirect()->route('home.index')->with('error','product not fonud');
}
}

public function cart(){
    $data['order'] = Order::where([['user_id', Auth::id()], ['status', false]])->first();
    return view('cart', $data);
}

public function saveadd(Request $request){
    $data['addresses'] = Address::where('user_id',Auth::id())->get();
    
    if($request->isMethod('post')){
       $data = $request->validate([
        'fullname' => 'required',
        'street_name' => 'required',
        'landmark' => 'required',
        'area' => 'required',
        'pincode' => 'required',
        'city' => 'required',
        'state' => 'required',
        'alt_contact' =>'required',
        'type' => 'required',
       ]);

       $data['user_id'] = Auth::id();
       $address=Address::create($data);
       session::put('address',$address);
       return redirect()->back()->with('success','Address Inserted Successfully');
    }
    return view('checkout',$data);
}


public function thankYou()
    {
        
        $message = session('message');
    
        return view('thanku', ['message' => $message]);
    }


}


