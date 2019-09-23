<?php

namespace App\Http\Controllers\Site;

use App\Cart;
use App\Product;
use App\PublicModel;
use Arr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Session;


class ShopControllers extends Controller
{
    use UpdateCart;

    /*
     *
     */
    public function addcart($id)
    {
        $cartDB = '';
        $user = Auth::user();
        if ($user) {
            $userId = $user->id;
            $cartDB = \DB::table('carts')->where('user_id', $userId)->orWhere('user_ip', \request()->ip())->delete();
        } else {
            $userId = null;
            $cartDB = \DB::table('carts')->where('user_ip', \request()->ip())->delete();
        }

        $productCurrent = \DB::table('products')->where('id', $id)->first();

        if (Session::has('cart')) {
            $cart = Session::get('cart');
            $arrIndex = array_keys($cart);
            for ($i = 0; $i < count($cart); $i++) {
                Cart::create([
                    'user_id' => $userId,
                    'product_id' => $cart[$arrIndex[$i]]['product_id'],
                    'myCookei' => $cart[$arrIndex[$i]]['myCookei'],
                    'user_ip' => $cart[$arrIndex[$i]]['user_ip'],
                    'number' => $cart[$arrIndex[$i]]['number'],
                ]);
            }

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
                $cart[$id]['product_id'] = $id;
                $cart[$id]['user_ip'] = \request()->ip();
                $cart[$id]['myCookei'] = $valueCookie;
                $cart[$id]['name'] = $productCurrent->name;
                $cart[$id]['slug'] = $productCurrent->slug;
                $cart[$id]['image'] = $productCurrent->image;
                $cart[$id]['price'] = $productCurrent->price_main;

                \DB::table('carts')->insert([
                    'user_id' => $userId,
                    'product_id' => $id,
                    'user_ip' => request()->ip(),
                    'number' => $cart[$id]['number'],
                    'myCookei' => $valueCookie,
                ]);
            }
            Session::put('cart', $cart);
        } else {
            $valueCookie = time();
            Cookie::queue('cookieCart', $valueCookie, 30 * 24 * 60);
            $cart = [];
            $cart[$id]['product_id'] = $id;
            $cart[$id]['number'] = 1;
            $cart[$id]['user_ip'] = \request()->ip();
            $cart[$id]['myCookei'] = $valueCookie;
            $cart[$id]['name'] = $productCurrent->name;
            $cart[$id]['slug'] = $productCurrent->slug;
            $cart[$id]['image'] = $productCurrent->image;
            $cart[$id]['price'] = $productCurrent->price_main;

            Session::put('cart', $cart);


            \DB::table('carts')->insert([
                'user_id' => $userId,
                'product_id' => $id,
                'user_ip' => request()->ip(),
                'number' => 1,
                'myCookei' => $valueCookie,
            ]);
        }


        $cartIndex = array_keys($cart);

        $cartSend = [];
        for ($i = 0; $i < count($cart); $i++) {
            $productId = $cart[$cartIndex[$i]]['product_id'];

            $cartSend[$i]['product_id'] = $productId;

            if ($productId != $id) {
                $productOther = \DB::table('products')->where('id', $productId)->first();
                $cartSend[$i]['product_name'] = $productOther->name;
                $cartSend[$i]['product_slug'] = $productOther->slug;
                $cartSend[$i]['product_image'] = $productOther->image;
                $cartSend[$i]['product_price'] = $productOther->price_main;
            } else {
                $cartSend[$i]['product_name'] = $productCurrent->name;
                $cartSend[$i]['product_slug'] = $productCurrent->slug;
                $cartSend[$i]['product_image'] = $productCurrent->image;
                $cartSend[$i]['product_price'] = $productCurrent->price_main;
            }

            $cartSend[$i]['product_number'] = $cart[$cartIndex[$i]]['number'];
        }

        $response = array(
            'cartSend' => $cartSend,

        );
//        dump($cartSend);
//        dump(Session::get('cart'));
        return \Response::json($cartSend);

//        return [
//            $cartSend
//        ];
    }

    public function seecart()
    {
        $updateallcarts = $this->updateAllCarts();
        $priceOfCarts = $updateallcarts[0];
        $numberOfCarts = $updateallcarts[1];

        return view('front.seeCart', compact('product', 'numberOfCarts', 'priceOfCarts'));
    }
}
