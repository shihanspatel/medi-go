<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Product;
use App\Models\Banner;
class guest extends Controller
{
    public function index()
{
    $banner     = Banner::where('status', 1)->first();
    $categories = Category::where('status', 1)->get();
    $products   = Product::where('is_trending', 1)->limit(4)->get();

    return view('home', compact('banner', 'categories', 'products'));
}
}
