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

    public function add(Request $request)
    {
        $userId = Auth::id();
        if (!$userId) {
            return redirect()->back()->with('error', 'User not authenticated');
        }

        $productId = $request->input('product_id');
        if (!$productId) {
            return redirect()->back()->with('error', 'Product ID not provided');
        }

        
        $cartItem = Cart::firstOrNew([
            'user_id' => $userId,
            'product_id' => $productId,
        ]);

        // Increment quantity
        $cartItem->quantity += 1;
        $cartItem->save();

        return redirect()->back()->with('success', 'Product added to cart!');
    }
}


