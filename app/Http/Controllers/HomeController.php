<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Food;
use App\Models\Foodchef;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Category;


class HomeController extends Controller
{
    public function index()
     {
        
        
       $data['categories'] = Category::all();
       return view('home',$data);
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



     public function logout() {
      Auth::logout();
      return redirect()->route('home.index'); 

     }

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

    public function remove(Request $request, $id)
    {
        try {
            $item = Cart::find($id);
            
            
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



    public function orderconfirm(Request $request)
    {
  
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
