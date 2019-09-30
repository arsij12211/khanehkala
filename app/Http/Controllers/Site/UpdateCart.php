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
        $carts=[];

        if (Session::has('cart')) {
            $carts = Session::get('cart');
            $numberOfCarts = count($carts);

            $arrIndex = array_keys($carts);
            for ($i = 0; $i < count($carts); $i++) {
                $product = \DB::table('products')->where('id', $carts[$arrIndex[$i]]['product_id'])->first();
                $priceOfCarts += ($product->price_main * $carts[$arrIndex[$i]]['number']);
            }
            $priceOfCarts = number_format($priceOfCarts);
        } elseif (Cookie::has('cart')) {
            $cartCook = unserialize(stripslashes(Cookie::get('cart')));
            //  set session
            Session::put('cart', $cartCook);
//            dd(Session::get('cart'));

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
            $priceOfCarts, $numberOfCarts, $carts,
        ];
    }
}