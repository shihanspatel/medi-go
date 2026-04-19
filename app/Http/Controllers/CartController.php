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
            'product_id' => 'required|exists:products,id',
            'quantity' => 'nullable|integer|min:1'
        ]);

        $quantity = $request->quantity ?? 1;
        $product = Product::find($request->product_id);
        $cartItem = Cart::where('user_id', auth()->id())
            ->where('product_id', $request->product_id)
            ->first();

        if ($cartItem) {
            $cartItem->increment('quantity', $quantity);
            $message = $product->name . ' quantity updated in cart';
        } else {
            Cart::create([
                'user_id' => auth()->id(),
                'product_id' => $request->product_id,
                'quantity' => $quantity
            ]);
            $message = $product->name . ' added to cart';
        }

        // Remove from wishlist if exists
        Wishlist::where('user_id', auth()->id())
            ->where('product_id', $request->product_id)
            ->delete();

        // Redirect to cart if coming from wishlist
        if (strpos(url()->previous(), 'wishlist') !== false) {
            return redirect()->route('cart.index')->with('success', $message);
        }

        return back()->with('success', $message);
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
        $cart = Cart::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $productName = $cart->product->name;
        $cart->delete();

        return back()->with('success', $productName . ' removed from cart');
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

        $product = Product::find($request->product_id);
        $exists = Wishlist::where('user_id', auth()->id())
            ->where('product_id', $request->product_id)
            ->first();

        if (!$exists) {
            Wishlist::create([
                'user_id' => auth()->id(),
                'product_id' => $request->product_id
            ]);
            $message = $product->name . ' added to wishlist';
        } else {
            $message = $product->name . ' is already in wishlist';
        }

        return back()->with('success', $message);
    }

    // Remove From Wishlist
    public function wishlist_remove($id)
    {
        $wishlist = Wishlist::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $productName = $wishlist->product->name;
        $wishlist->delete();

        return back()->with('success', $productName . ' removed from wishlist');
    }
}
