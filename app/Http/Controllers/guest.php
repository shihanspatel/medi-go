<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Banner;
use App\Models\ContactUs;
use App\Models\ContactSetting;
use App\Models\Rating;

class Guest extends Controller
{
    public function index()
    {
        $banner = Banner::where('status', 1)->first();
        $categories = Category::where('status', 1)->get();
        $products = Product::where('is_trending', 1)
            ->where('status', 1)
            ->latest()
            ->limit(4)
            ->get();

        return view('home', compact('banner', 'categories', 'products'));
    }

    public function show($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $products = Product::where('category', $category->name)->get();

        return view('category_products', compact('category', 'products'));
    }

    public function product_show($id)
    {
        $product = Product::findOrFail($id);
        $ratings = Rating::where('product_id', $id)->with('user')->latest()->get();
        $avgRating = $product->averageRating();
        $ratingCount = $product->ratingCount();

        return view('view_prod', compact('product', 'ratings', 'avgRating', 'ratingCount'));
    }

    public function contact_index()
    {
        $contact = ContactSetting::where('status', 1)->first();
        return view('contact_us', compact('contact'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'email'      => 'required|email',
            'message'    => 'required'
        ]);

        ContactUs::create([
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'email'      => $request->email,
            'phone'      => $request->phone,
            'message'    => $request->message
        ]);

        return back()->with('success', 'Message sent successfully!');
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $products = Product::where('name', 'LIKE', "%$search%")->get();

        return view('search_results', compact('products', 'search'));
    }
}
