<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;


class ShopControllers extends Controller
{
    /*
     *
     */
    public function addcart(Request $request)
    {
        if (Session::has('cart')) {
            $cart = Session::get('cart');

            if (array_key_exists('$request->id', $cart)) {
                $cart['$request->id']++;
            } else {
                $cart['$request->id'] = 1;
            }

            Session::put('cart', $cart);
        } else {
            $cart = [];
            $cart['$request->id'] = 1;
            Session::put('cart', $cart);

        }


        return $cart;
    }
}
