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
use Illuminate\Support\Facades\Hash;

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

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'name'    => 'required',
            'email'   => 'required|email|unique:users,email,' . $id,
            'city'    => 'nullable',
            'state'   => 'nullable',
            'address' => 'nullable',
            'pincode' => 'nullable',
        ]);
        $user->update($request->only('name', 'email', 'city', 'state', 'address', 'pincode'));
        return back()->with('success', 'User updated.');
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
            $filename = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('images/product_Images'), $filename);
            $data['image'] = $filename;
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
            $filename = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('images/product_Images'), $filename);
            $data['image'] = $filename;
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

    public function toggleCategoryStatus($id)
    {
        $category = Category::findOrFail($id);
        // supports both string ('active'/'inactive') and integer (1/0) columns
        if ($category->status == 'active' || $category->status == 1) {
            $category->status = 'inactive';
        } else {
            $category->status = 'active';
        }
        $category->save();
        return back()->with('success', 'Category status updated.');
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

    public function profile()
    {
        /** @var User $admin */
        $admin = auth()->user();
        return view('admin.Admin_profile', compact('admin'));
    }

    public function profileUpdate(Request $request)
    {
        /** @var User $admin */
        $admin = auth()->user();
        $request->validate([
            'name'    => 'required',
            'email'   => 'required|email|unique:users,email,' . $admin->id,
            'city'    => 'nullable',
            'state'   => 'nullable',
            'address' => 'nullable',
            'pincode' => 'nullable',
        ]);
        $admin->update($request->only('name', 'email', 'city', 'state', 'address', 'pincode'));
        return back()->with('success', 'Profile updated successfully.');
    }

    public function profilePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password'         => 'required|min:6|confirmed',
        ]);

        /** @var User $admin */
        $admin = auth()->user();

        if (!Hash::check($request->current_password, $admin->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        $admin->update(['password' => Hash::make($request->password)]);
        return back()->with('success', 'Password changed successfully.');
    }
}
