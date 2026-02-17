<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Banner;
use App\Models\ContactUS;
use Illuminate\Http\Request;

class guest extends Controller
{
    public function index()
    {
        $banner     = Banner::where('status', 1)->first();
        $categories = Category::where('status', 1)->get();
        $products   = Product::where('is_trending', 1)->limit(4)->get();

        return view('home', compact('banner', 'categories', 'products'));
    }
    public function show($slug)
    {
        // Get category
        $category = Category::where('slug', $slug)
            ->where('status', 1)
            ->firstOrFail();

        // Get products of that category
        $products = Product::where('category', $category->name)
            ->get();

        return view('category_products', compact('category', 'products'));
    }
    public function contact_index()
    {
        $contact = \App\Models\ContactSetting::where('status',1)->first();

        return view('contact_us', compact('contact'));
    }


    public function store(Request $request)
    {

        // Validation
        $request->validate([
            'first_name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);


        // Save Data
        ContactUs::create([

            'first_name' => $request->first_name,

            'last_name' => $request->last_name,

            'email' => $request->email,

            'phone' => $request->phone,

            'message' => $request->message

        ]);


        return redirect()->back()->with('success','Message sent successfully!');

    }
}
