<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;


class CartController extends Controller
{
    public function remove($id)
    {
        try {
            // Find the item in the cart
            $cartItem = Cart::find($id);
            
            // Check if the item exists
            if ($cartItem) {
                // Delete the item
                $cartItem->delete();
                // Redirect back with success message
                return redirect()->back()->with('success', 'Item removed successfully');
            } else {
                // Redirect back with error message
                return redirect()->back()->with('error', 'Item not found');
            }
        } catch (\Exception $e) {
            // Redirect back with error message
            return redirect()->back()->with('error', 'Failed to remove item');
        }
    }
}


