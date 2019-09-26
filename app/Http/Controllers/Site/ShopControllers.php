<?php

namespace App\Http\Controllers\Site;

use App\Cart;
use App\Color;
use App\Product;
use App\PublicModel;
use Arr;
use Gate;
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
    public function addcart($id, $colorProductId = 1)       //  $colorProductId = 1 means of free color
    {

        $productCurrent = \DB::table('products')->where('id', $id)->first();
        $colorProduct = \DB::table('color_product')->where('id', $colorProductId)->first();

//     if (!Gate::allows('exists-product', $productCurrent->id)) {
//            return 'موجودی این محصول صفر یا اینکه، قیمت آن صفر می باشد';
//        }


        $cartDB = '';
        $user = Auth::user();
        if ($user) {
            $userId = $user->id;
            $cartDB = \DB::table('carts')->where('user_id', $userId)->orWhere('user_ip', \request()->ip())->delete();
        } else {
            $userId = null;
            $cartDB = \DB::table('carts')->where('user_ip', \request()->ip())->delete();
        }


        if (Session::has('cart')) {
            $cart = $this->updateSessionAndInsertDB($id, $colorProductId, $productCurrent, $userId);

        } else {
            if (Cookie::has('cart')) {
                $cartCook = unserialize(stripslashes(Cookie::get('cart')));
                //  set session
                Session::put('cart', $cartCook);
                $cart = $this->updateSessionAndInsertDB($id, $colorProductId, $productCurrent, $userId);

            } else {
                $valueCookie = time();
                Cookie::queue('cookieCart', $valueCookie, 30 * 24 * 60);
                $cart = [];
                $cart[$id]['product_id'] = $id;

                $colorProductNew = \DB::table('color_product')->where('id', $colorProductId)->first();
                $colorNameNew = Color::find($colorProductNew->color_id)->name;
                $cart[$id]['color_product_name'] = $colorNameNew;
                $cart[$id]['number'] = 1;
                $cart[$id]['user_ip'] = \request()->ip();
                $cart[$id]['myCookie'] = $valueCookie;
                $cart[$id]['name'] = $productCurrent->name;
                $cart[$id]['slug'] = $productCurrent->slug;
                $cart[$id]['image'] = $productCurrent->image;
                $cart[$id]['price'] = $productCurrent->price_main;

                //  set session
                Session::put('cart', $cart);

                //  set cookie
                $cartStr = serialize($cart);
                Cookie::queue('cart', $cartStr, 30 * 24 * 60);

                \DB::table('carts')->insert([
                    'user_id' => $userId,
                    'product_id' => $id,
                    'color_product_id' => $colorProductId,
                    'user_ip' => request()->ip(),
                    'number' => 1,
                    'myCookie' => $valueCookie,
                ]);
            }
        }


        $cartIndex = array_keys($cart);

        $cartSend = [];
        for ($i = 0; $i < count($cart); $i++) {
            $productId = $cart[$cartIndex[$i]]['product_id'];

            $colorId = $colorProduct->color_id;
            $colorName = '';
            if ($colorId == 1) {    //  means of color free
                $colorName = '-1';
            } else {
                $colorName = \DB::table('colors')->where('id', $colorId)->first()->name;
            }

            $cartSend[$i]['product_id'] = $productId;
            $cartSend[$i]['color_name'] = $colorName;

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

        return \Response::json($cartSend);
    }

    private function updateSessionAndInsertDB($productId, $colorProductId, $productCurrent, $userId)
    {
        $cart = Session::get('cart');
        $arrIndex = array_keys($cart);
        for ($i = 0; $i < count($cart); $i++) {

            $colorId = \DB::table('colors')->where('name', $cart[$arrIndex[$i]]['color_product_name'])->first();
            $colorProductNewId = \DB::table('color_product')
                ->where('product_id', $cart[$arrIndex[$i]]['product_id'])
                ->where('color_id', $colorId->id)->first()->id;
            Cart::create([
                'user_id' => $userId,
                'product_id' => $cart[$arrIndex[$i]]['product_id'],
                'color_product_id' => $colorProductNewId,
                'myCookie' => $cart[$arrIndex[$i]]['myCookie'],
                'user_ip' => $cart[$arrIndex[$i]]['user_ip'],
                'number' => $cart[$arrIndex[$i]]['number'],
            ]);
        }

        if (isset($cart[$productId]) && isset($cart['color_product_name'])) {
            $cart[$productId]['number']++;
            if ($userId) {
                Cart::where('product_id', $productId)->where('user_id', $userId)->first()->update([
                    'number' => $cart[$productId]['number'],
                ]);
            } else {
                Cart::where('product_id', $productId)->where('user_ip', request()->ip())->first()->update([
                    'number' => $cart[$productId]['number'],
                ]);
            }
        } else {
            $valueCookie = time();
            Cookie::queue('cookieCart', $valueCookie, 30 * 24 * 60);
            $cart[$productId]['number'] = 1;
            $cart[$productId]['product_id'] = $productId;

            $colorProductNew = \DB::table('color_product')->where('id', $colorProductId)->first();
            $colorNameNew = Color::find($colorProductNew->color_id)->name;
            $cart[$productId]['color_product_name'] = $colorNameNew;
            $cart[$productId]['user_ip'] = \request()->ip();
            $cart[$productId]['myCookie'] = $valueCookie;
            $cart[$productId]['name'] = $productCurrent->name;
            $cart[$productId]['slug'] = $productCurrent->slug;
            $cart[$productId]['image'] = $productCurrent->image;
            $cart[$productId]['price'] = $productCurrent->price_main;

            \DB::table('carts')->insert([
                'user_id' => $userId,
                'product_id' => $productId,
                'user_ip' => request()->ip(),
                'number' => $cart[$productId]['number'],
                'myCookie' => $valueCookie,
                'color_product_id' => $colorProductId,
            ]);
        }
        Session::put('cart', $cart);

        return $cart;
    }

    public function seecart()
    {
        $updateallcarts = $this->updateAllCarts();
        $priceOfCarts = $updateallcarts[0];
        $numberOfCarts = $updateallcarts[1];

        return view('front.seeCart', compact('product', 'numberOfCarts', 'priceOfCarts'));
    }
}
