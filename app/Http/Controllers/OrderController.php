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

        $order = Order::with('orderItems')
                        ->where('status', 0)
                        ->where('user_id', $user_id)
                        ->first();
        
        if ($order) {
                        $orderItem = $order->orderItems->first(); 
            // dd($orderItem);
            $address_id = $orderItem->address_id;
        
            $address = Address::where('id', $address_id)->get();
            // dd($address);
        } else {
            dd("Order not found.");
        }
        


    if ($order) {
        return view('myorder', ['order' => $order,'address'=>$address]);
    } else {
        return view('myorder', ['order' => null,'address_id' => null]); 
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

    
    
//     public function addtoCart(Request $request, $id)
// {
    
//     $product = Product::find($id);

//     if (!$product) {
//         return redirect()->route('cart')->with('error', 'Product not found');
//     }

//     $user_id = Auth::user()->id;

//     // Check if there is an active order for the user
//     $order = Order::where('status', false)
//                    ->where('user_id', $user_id)
//                    ->first();

    
//     if ($order) {
//         // Check if the product is already in the cart
//         $orderItem = Orderitem::where('status', false)
//                               ->where('product_id', $id)
//                               ->where('order_id', $order->id)
//                               ->first();

//         // If the product is already in the cart, update quantity
//         if ($orderItem) {
//             $orderItem->quantity += 1;
//             $orderItem->save();
//         } else {
//             // If the product is not in the cart, create a new Orderitem
//             $orderItem = new Orderitem();
//             $orderItem->status = false;
//             $orderItem->product_id = $id;
//             $orderItem->user_id = $user_id;
//             $orderItem->order_id = $order->id;
//             $orderItem->quantity = 1; 
//             $orderItem->save();
//         }
//     } else {
//         // If no active order exists, create a new order
//         $order = new Order();
//         $order->user_id = $user_id;
//         $order->status = false;
//         $order->save();

//         // Create a new Orderitem for the product
//         $orderItem = new Orderitem();
//         $orderItem->status = false;
//         $orderItem->product_id = $id;
//         $orderItem->user_id = $user_id;
//         $orderItem->order_id = $order->id;
//         $orderItem->quantity = 1;
//         $orderItem->save();
//     }

//     // Redirect to the cart page
//     return redirect()->back()->with('success', 'Product added or updated in the cart successfully');
// }

public function addtoCart($id)
{
    $user_id = Auth::id();
    $product = Product::findOrFail($id);

    // Check if the product exists
    if (!$product) {
        return redirect()->back()->with('error', 'Product not found.');
    }

    // Find or create an open order for the user
    $order = Order::where('user_id', $user_id)
                 ->where('status', false)
                 ->firstOrCreate(['user_id' => $user_id]);

    // Check if the item already exists in the order
    $orderItem = OrderItem::where('order_id', $order->id)
                          ->where('product_id', $product->id)
                          ->first();

    if ($orderItem) {
        // Increment the quantity if the item already exists
        $orderItem->quantity++;
        $orderItem->save();
    } else {
        // Create a new order item if it doesn't exist
        $orderItem = new OrderItem([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'quantity' => 1, // Initial quantity
            'price' => $product->discount_price // Use discount price or regular price
        ]);
        $orderItem->save();
    }

    // Calculate total items in the current order for the user
    $totalItems = OrderItem::where('order_id', $order->id)->sum('quantity');

    // Return success message or redirect to cart page
    return response()->json(['success' => true, 'totalItems' => $totalItems]);
}


public function viewcart()
{
    $user_id = Auth::user()->id;

    // Retrieve order items with related products for the authenticated user
    $orders = Orderitem::with('product')
                    ->where('user_id', $user_id)
                    ->get();
    
    $totalItems = OrderItem::whereHas('order', function ($query) use ($user_id) {
              $query->where('user_id', $user_id)->where('status', false);
               })->sum('quantity');

                
    return view('cart', compact('orders', 'totalItems'));

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
   
return redirect()->route('cart')->with('success','product updated on cart successfully');
}
else{
return redirect()->route('home.index')->with('error','product not fonud');
}
}


public function getCartItemCount()
{
    $user_id = Auth::id();

    // Fetch count of items in the cart
    $count = OrderItem::whereHas('order', function ($query) use ($user_id) {
                $query->where('status', false)
                      ->where('user_id', $user_id);
            })
            ->count();

    return response()->json(['count' => $count]);
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
       $address_id = $address->id;
       $user_id = Auth::id();
       Orderitem::where('user_id', $user_id)->update(['address_id' => $address_id]);

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


