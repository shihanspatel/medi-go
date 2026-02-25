<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    // 🛒 Show Cart Page
    public function index()
    {
        $cartItems = Cart::with('product')
            ->where('user_id', auth()->id())
            ->get();

        $subtotal = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        $tax = $subtotal * 0.05;
        $total = $subtotal + $tax;

        return view('cart', compact('cartItems', 'subtotal', 'tax', 'total'));
    }

    // ➕ Add Product To Cart
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id'
        ]);

        $cartItem = Cart::where('user_id', auth()->id())
            ->where('product_id', $request->product_id)
            ->first();

        if ($cartItem) {
            // If already exists → increase quantity
            $cartItem->increment('quantity');
        } else {
            // If not exists → create new
            Cart::create([
                'user_id' => auth()->id(),
                'product_id' => $request->product_id,
                'quantity' => 1
            ]);
        }

        return back()->with('success', 'Product added to cart successfully');
    }

    // 🔄 Update Quantity
    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = Cart::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $cart->update([
            'quantity' => $request->quantity
        ]);

        return back()->with('success', 'Cart updated successfully');
    }

    // ❌ Remove Item
    public function remove($id)
    {
        Cart::where('id', $id)
            ->where('user_id', auth()->id())
            ->delete();

        return back()->with('success', 'Item removed from cart');
    }
    // Show Wishlist Page
    public function wishlist_index()
    {
        $wishlistItems = Wishlist::with('product.category')
            ->where('user_id', auth()->id())
            ->get();

        return view('wishlist', compact('wishlistItems'));
    }

    // Add To Wishlist
    public function wishlist_add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id'
        ]);

        $exists = Wishlist::where('user_id', auth()->id())
            ->where('product_id', $request->product_id)
            ->first();

        if (!$exists) {
            Wishlist::create([
                'user_id' => auth()->id(),
                'product_id' => $request->product_id
            ]);
        }

        return back()->with('success','Added to wishlist');
    }

    // Remove From Wishlist
    public function wishlist_remove($id)
    {
        Wishlist::where('id', $id)
            ->where('user_id', auth()->id())
            ->delete();

        return back()->with('success','Removed from wishlist');
    }
}