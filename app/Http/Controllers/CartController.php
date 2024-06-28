<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;


class CartController extends Controller
{
    public function remove($id)
    {
        try {
            $cartItem = Cart::find($id);
            
            if ($cartItem) {
                $cartItem->delete();
                return redirect()->back()->with('success', 'Item removed successfully');
            } else {
                return redirect()->back()->with('error', 'Item not found');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to remove item');
        }
    }
}


