<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Category;


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
        //
        view()->composer('layouts.app', function ($view) {

        if (Auth::check()) {
            $carts = Cart::with('product.images')
                ->where('user_id', Auth::id())
                ->where('status',1)
                ->get();

            $total = $carts->sum(function ($cart) {
                $price = $cart->offer_price ?? $cart->product->price;
                return $price * $cart->quantity;
            });
            $wishlist = session()->get('wishlist', []); // get wishlist array from session
            $wishlistCount = count($wishlist); // get number of items
            // dd($total);
        } else {
            $carts = collect();
            $total = 0;
            $wishlistCount = 0;
        }
       $categories = Category::with('subCategories')
            ->where('status', 1)
            ->get();    
        $view->with([
            'carts' => $carts,
            'total' => $total,
            'categories' => $categories,
            'wishlistCount' =>$wishlistCount
        ]);
    });
    }
}
