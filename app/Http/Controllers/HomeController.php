<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Food;
use App\Models\Foodchef;
use App\Models\Cart;
use App\Models\Order;



class HomeController extends Controller
{
    public function index()
    {
        
        if(Auth::id())
        {
            return redirect('redirects');
        }
        
        else{
        $data =food::all();
        // dd($data);
        $data1 =foodchef::all();
        return view("home",compact("data","data1"));
        }
    }

    public function redirects(){
        // dd($data);
        $data=food::all();
        // dd($data);

        $data1 = foodchef::all();
        $usertype =Auth::user()->usertype;

        if($usertype=='1')
        {
            return view('admin.dashboard');
        }
        else
        {
            $user_id= Auth::id();
            $count = Cart::where('user_id',$user_id)->count();

    
            return view("home",compact("data","data1","count"));
       }

    }

    public function addcart(Request $request, $id)
    {
        // dd($id);
        if(Auth::id())
        {
            $user_id= Auth::id();
            // dd($user_id);
            $foodid= $id;
            $quantity = $request->quantity;
            $cart=new cart;
            $cart->user_id=$user_id;
            $cart->food_id=$foodid;
            $cart->quantity=$quantity;
            $cart->save();


            return redirect()->back();

        }
        else
        {
            return redirect('/login');
        }
    }

    // public function showcart(Request $request, $id)
    // { 
    //     // $count=cart::where('user_id',$id)->count();


    //     $cart = Cart::where('user_id', $id)->first();
       
    //     $quantity = $cart->quantity;
    //     // dd($quantity);
    
    //     if ($cart) {
    //         $foodId = $cart->food_id;
    //         $food = Food::where('id', $foodId)->first();
    

    //         $data = [$food]; // Or any other logic to prepare the data
            
    //         return view('showcart', compact('data', 'quantity','cart'));
    //     }
    //   else {
    //         return redirect()->back()->with('error', 'Cart not found');
    //     }
    // }
    
    public function showcart(Request $request, $id)
{ 
    if(Auth::id() == $id)
    {
        $cartItems = Cart::where('user_id', $id)->get();
        
        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Cart is empty');
        }

        $data = [];
        foreach ($cartItems as $cart) {
            $foodId = $cart->food_id;
            $food = Food::find($foodId);

            if ($food) {
                $data[] = [
                    'food' => $food,
                    'quantity' => $cart->quantity,
                    'cart' => $cart
                ];
            }
        }
        // dd($data);
        return view('showcart', compact('data'));
    } else {
        return redirect()->back()->with('error', 'Unauthorized access');
    }
}


    // public function remove($id)
    // {
    //     $item= Cart::find($id);
    //     $item->delete();

    //     return redirect()->back();


    // }

    public function remove(Request $request, $id)
    {
        try {
            $item = Cart::find($id);
            
            // Check if item exists
            if ($item) {
                $item->delete();
                return redirect()->back()->with('success', 'Item removed successfully');
            } else {
                return redirect()->back()->with('error', 'Item not found');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to remove item');
        }
    }
    


// public function deletechef($id){
     
//     $data =foodchef::find($id);
//     $data->delete();
//     return redirect()->back();

// }




    public function orderconfirm(Request $request)
    {
        // dd($request->all());
  
     foreach($request->foodname as $key =>$foodname)  
     {
        $data =new order;
        $data->foodname=$foodname;
        $data->price=$request->price[$key];
        $data->quantity=$request->quantity[$key];
        $data->name=$request->name;
        $data->phone=$request->phone;
        $data->address=$request->address;
        $data->save();

    }

    return redirect()->back();
     
    }  

}
