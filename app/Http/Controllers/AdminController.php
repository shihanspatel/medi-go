<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\Rating;
use App\Models\ContactUs;
use App\Models\Cart;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.Admin_dashboard', [
            'totalUsers'    => User::count(),
            'totalOrders'   => Order::count(),
            'totalProducts' => Product::count(),
            'totalRevenue'  => Order::where('payment_status', 'paid')->sum('total_amount'),
        ]);
    }

    public function users()
    {
        $users = User::latest()->get();
        return view('admin.Admin_User', compact('users'));
    }

    public function deleteUser($id)
    {
        User::findOrFail($id)->delete();
        return back()->with('success', 'User deleted.');
    }

    public function products()
    {
        $products   = Product::with('ratings')->latest()->get();
        $categories = Category::all();
        return view('admin.Admin_products', compact('products', 'categories'));
    }

    public function storeProduct(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required',
            'category'    => 'required',
            'price'       => 'required|numeric',
            'old_price'   => 'nullable|numeric',
            'description' => 'nullable',
            'image'       => 'nullable|image',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('product_Images', 'public');
        }

        Product::create($data);
        return back()->with('success', 'Product added.');
    }

    public function updateProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $data = $request->validate([
            'name'        => 'required',
            'category'    => 'required',
            'price'       => 'required|numeric',
            'old_price'   => 'nullable|numeric',
            'description' => 'nullable',
            'image'       => 'nullable|image',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('product_Images', 'public');
        }

        $product->update($data);
        return back()->with('success', 'Product updated.');
    }

    public function deleteProduct($id)
    {
        Product::findOrFail($id)->delete();
        return back()->with('success', 'Product deleted.');
    }

    public function categories()
    {
        $categories = Category::latest()->get();
        return view('admin.Admin_categories', compact('categories'));
    }

    public function storeCategory(Request $request)
    {
        $data = $request->validate([
            'name'   => 'required|unique:categories,name',
            'slug'   => 'required|unique:categories,slug',
            'status' => 'required',
        ]);
        Category::create($data);
        return back()->with('success', 'Category added.');
    }

    public function updateCategory(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $data = $request->validate([
            'name'   => 'required|unique:categories,name,' . $id,
            'slug'   => 'required|unique:categories,slug,' . $id,
            'status' => 'required',
        ]);
        $category->update($data);
        return back()->with('success', 'Category updated.');
    }

    public function deleteCategory($id)
    {
        Category::findOrFail($id)->delete();
        return back()->with('success', 'Category deleted.');
    }

    public function orders()
    {
        $orders = Order::with('user')->latest()->get();
        return view('admin.Admin_orders', compact('orders'));
    }

    public function updateOrderStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->update(['status' => $request->status]);
        return back()->with('success', 'Order status updated.');
    }

    public function ratings()
    {
        $ratings = Rating::with(['user', 'product'])->latest()->get();
        return view('admin.Admin_ratings', compact('ratings'));
    }

    public function deleteRating($id)
    {
        Rating::findOrFail($id)->delete();
        return back()->with('success', 'Rating deleted.');
    }

    public function contact()
    {
        $messages = ContactUs::latest()->get();
        return view('admin.Admin_contact', compact('messages'));
    }

    public function deleteContact($id)
    {
        ContactUs::findOrFail($id)->delete();
        return back()->with('success', 'Message deleted.');
    }

    public function cart()
    {
        $carts = Cart::with(['user', 'product'])->latest()->get();
        return view('admin.Admin_cart', compact('carts'));
    }

    public function wishlist()
    {
        $wishlists = Wishlist::with(['user', 'product'])->latest()->get();
        return view('admin.Admin_wishlist', compact('wishlists'));
    }
}
