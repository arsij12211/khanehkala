<?php

namespace App\Http\Controllers\Site;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Session;


class ShopControllers extends Controller
{
    /*
     *
     */
    public function addcart($id)
    {

        $user = Auth::user();
        if ($user) {
            $userId = $user->id;
        } else {
            $userId = null;
        }

        $product = \DB::table('products')->where('id', $id)->first();

        if (Session::has('cart')) {
            $cart = Session::get('cart');

            if (isset($cart[$id])) {
                $cart[$id]['number']++;
                if ($userId) {
                    Cart::where('product_id', $id)->where('user_id', $userId)->first()->update([
                        'number' => $cart[$id]['number'],
                    ]);
                } else {
                    Cart::where('product_id', $id)->where('user_ip', request()->ip())->first()->update([
                        'number' => $cart[$id]['number'],
                    ]);
                }
            } else {
                $valueCookie = time();
                Cookie::queue('cookieCart', $valueCookie, 30 * 24 * 60);
                $cart[$id]['number'] = 1;
                $cart[$id]['product->id'] = $id;
                $cart[$id]['user_ip'] = \request()->ip();

                dump("1");
            }
            Session::put('cart', $cart);
        } else {
            $valueCookie = time();
            Cookie::queue('cookieCart', $valueCookie, 30 * 24 * 60);
            $cart = [];
            $cart[$id]['product->id'] = $id;
            $cart[$id]['number'] = 1;
            $cart[$id]['user_ip'] = \request()->ip();
            $cart[$id]['myCookei'] = $valueCookie;

            Session::put('cart', $cart);


            \DB::table('carts')->insert([
                'user_id' => $userId,
                'product_id' => $id,
                'user_ip' => request()->ip(),
                'number' => 1,
                'myCookei' => $valueCookie,
            ]);
        }

        return $cart;
    }
}
