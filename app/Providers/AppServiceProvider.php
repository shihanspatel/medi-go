<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

use App\Models\Cart;
use App\Models\Wishlist;
use App\Models\Order;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {

            if (Auth::check()) {

                $cartCount = Cart::where('user_id', Auth::id())->count();
                $wishlistCount = Wishlist::where('user_id', Auth::id())->count();
                $orderCount = Order::where('user_id', Auth::id())->count();

            } else {

                $cartCount = 0;
                $wishlistCount = 0;
                $orderCount = 0;
            }

            $view->with([
                'cartCount' => $cartCount,
                'wishlistCount' => $wishlistCount,
                'orderCount' => $orderCount
            ]);
        });
    }
}