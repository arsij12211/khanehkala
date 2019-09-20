<?php
/**
 * Created by PhpStorm.
 * User: Mehdi
 * Date: 04/04/2019
 * Time: 11:02 AM
 */

namespace App\Http\Controllers\Site;

use App\Cart;

use App\Product;
use App\User;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Session;

trait UpdateCart
{
    public function updateAllCarts()
    {
        $priceOfCarts = 0;
        $numberOfCarts = 0;
        if (Session::has('cart')) {
            $cart = Session::get('cart');
            $numberOfCarts = count($cart);

            $arrIndex = array_keys($cart);
            for ($i = 0; $i < count($cart); $i++) {
                $product = \DB::table('products')->where('id', $cart[$arrIndex[$i]]['product_id'])->first();
                $priceOfCarts += ($product->price_main * $cart[$arrIndex[$i]]['number']);
            }
            $priceOfCarts = number_format($priceOfCarts);
        } else {
            $user = \Auth::user();
            if (\Auth::check()) {
                $userId = $user->id;
                $cartDB = \DB::table('carts')->where('user_id', $userId)->orWhere('user_ip', \request()->ip())->delete();
            } else {
                $userId = null;
                $cartDB = \DB::table('carts')->where('user_ip', \request()->ip())->delete();
            }
        }

        return [
            $priceOfCarts,$numberOfCarts,
        ];
    }
}