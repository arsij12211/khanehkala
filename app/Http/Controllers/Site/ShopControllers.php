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
use Illuminate\Support\Str;
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


        $user = Auth::user();
        $cartDB = '';
        $userId = '';
        if ($user) {
            $userId = $user->id;
            $cartDB = \DB::table('carts')->where('user_id', $userId)->orWhere('user_ip', \request()->ip())->delete();
        } else {
            $userId = null;
            $cartDB = \DB::table('carts')->where('user_ip', \request()->ip())->delete();
        }


        if (Session::has('cart')) {
            $cart = $this->updateSessionAndInsertDB($id, $colorProductId, $productCurrent, $userId, $colorProduct->color_id);
        } else {
            if (Cookie::has('cart')) {
                $cartCook = unserialize(stripslashes(Cookie::get('cart')));
                //  set session
                Session::put('cart', $cartCook);
                $cart = $this->updateSessionAndInsertDB($id, $colorProductId, $productCurrent, $userId, $colorProduct->color_id);

            } else {
                $valueCookie = time();
                Cookie::queue('cookieCart', $valueCookie, 30 * 24 * 60);
                $cart = [];
                $cart[0]['product_id'] = $id;

                $colorProductNew = \DB::table('color_product')->where('id', $colorProductId)->first();
                $colorNameNew = Color::find($colorProductNew->color_id)->name;
                $cart[0]['color_product_name'] = $colorNameNew;
                $cart[0]['number'] = 1;
                $cart[0]['user_ip'] = \request()->ip();
                $cart[0]['myCookie'] = $valueCookie;
                $cart[0]['name'] = $productCurrent->name;
                $cart[0]['slug'] = $productCurrent->slug;
                $cart[0]['image'] = $productCurrent->image;
                $cart[0]['price'] = $productCurrent->price_main;

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


        $cartSend = [];
        for ($i = 0; $i < count($cart); $i++) {
            $productId = $cart[$i]['product_id'];


            $colorName = $cart[$i]['color_product_name'];
            if ($colorName == "بدون رنگ") {    //  means of color free
                $colorName = '-';
            }

            $cartSend[$i]['product_id'] = $productId;
            $cartSend[$i]['color_name'] = $colorName;

            if ($productId != $id) {
                $productOther = \DB::table('products')->where('id', $productId)->first();
                $cartSend[$i]['product_name'] = Str::limit($productOther->name,25,'...');
                $cartSend[$i]['product_slug'] = $productOther->slug;
                $cartSend[$i]['product_image'] = $productOther->image;
                $cartSend[$i]['product_price'] = $productOther->price_main;
            } else {
                $cartSend[$i]['product_name'] =  Str::limit($productCurrent->name,25,'...');
                $cartSend[$i]['product_slug'] = $productCurrent->slug;
                $cartSend[$i]['product_image'] = $productCurrent->image;
                $cartSend[$i]['product_price'] = $productCurrent->price_main;
            }

            $cartSend[$i]['product_number'] = $cart[$i]['number'];
        }


        return \Response::json($cartSend);
    }

    private function updateSessionAndInsertDB($productId, $colorProductId, $productCurrent, $userId, $colorIdRow)
    {
        $cart = Session::get('cart');
        for ($i = 0; $i < count($cart); $i++) {
            $colorId = \DB::table('colors')->where('name', $cart[$i]['color_product_name'])->first();
            $colorProductNewId = \DB::table('color_product')
                ->where('product_id', $cart[$i]['product_id'])
                ->where('color_id', $colorId->id)->first()->id;
            Cart::create([
                'user_id' => $userId,
                'product_id' => $cart[$i]['product_id'],
                'color_product_id' => $colorProductNewId,
                'myCookie' => $cart[$i]['myCookie'],
                'user_ip' => $cart[$i]['user_ip'],
                'number' => $cart[$i]['number'],
            ]);
        }


        $colorProductName = \DB::table('colors')->where('id', $colorIdRow)->first()->name;

        $indxfind = '';
        $hasProductIdAndColorNameInArrayCart = false;
        for ($i = 0; $i < count($cart); $i++) {
            if ($cart[$i]['product_id'] == $productId && $cart[$i]['color_product_name'] == $colorProductName) {
                $indxfind = $i;
                $hasProductIdAndColorNameInArrayCart = true;
                break;
            }
        }

        if ($hasProductIdAndColorNameInArrayCart) {
            $cart[$indxfind]['number']++;
            if ($userId) {
                Cart::where('product_id', $productId)->where('user_id', $userId)->first()->update([
                    'number' => $cart[$indxfind]['number'],
                ]);
            } else {
                Cart::where('product_id', $productId)->where('user_ip', request()->ip())->first()->update([
                    'number' => $cart[$indxfind]['number'],
                ]);
            }
        } else {
            $indexRow = count($cart);
            $valueCookie = time();
            Cookie::queue('cookieCart', $valueCookie, 30 * 24 * 60);

            $cart[$indexRow]['number'] = 1;
            $cart[$indexRow]['product_id'] = $productId;

            $colorProductNew = \DB::table('color_product')->where('id', $colorProductId)->first();
            $colorNameNew = Color::find($colorProductNew->color_id)->name;
            $cart[$indexRow]['color_product_name'] = $colorNameNew;
            $cart[$indexRow]['user_ip'] = \request()->ip();
            $cart[$indexRow]['myCookie'] = $valueCookie;
            $cart[$indexRow]['name'] = $productCurrent->name;
            $cart[$indexRow]['slug'] = $productCurrent->slug;
            $cart[$indexRow]['image'] = $productCurrent->image;
            $cart[$indexRow]['price'] = $productCurrent->price_main;


            \DB::table('carts')->insert([
                'user_id' => $userId,
                'product_id' => $productId,
                'user_ip' => request()->ip(),
                'number' => $cart[$indexRow]['number'],
                'myCookie' => $valueCookie,
                'color_product_id' => $colorProductId,
            ]);
        }
        Session::put('cart', $cart);


        \Cookie::queue(\Cookie::forget('cookieCart'));
        Cookie::queue('cookieCart', serialize($cart), 30 * 24 * 60);

        return $cart;
    }

    public function seecart()
    {
        $updateallcarts = $this->updateAllCarts();
        $priceOfCarts = $updateallcarts[0];
        $numberOfCarts = $updateallcarts[1];

        return view('front.seeCart', compact('product', 'numberOfCarts', 'priceOfCarts'));
    }

    private function hasColorNameInArray($colorProductName, $cart)
    {
        $flag = false;

        for ($i = 0; $i < count($cart); $i++) {
            if ($colorProductName == $cart[$i]["color_product_name"]) {
                $flag = true;
                break;
            }
        }

        return $flag;
    }

    private function hasProductInArray($productId, $cart)
    {
        $flag = false;

        for ($i = 0; $i < count($cart); $i++) {
            if ($productId == $cart[$i]["product_id"]) {
                $flag = true;
                break;
            }
        }

        return $flag;
    }
}
