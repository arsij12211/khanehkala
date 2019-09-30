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
            $cart = $this->updateSessionAndInsertDB($id, $colorProductId, $productCurrent, $userId);
        } else {
            if (Cookie::has('cart')) {
                $cartCook = unserialize(stripslashes(Cookie::get('cart')));
                //  set session
                Session::put('cart', $cartCook);
                $cart = $this->updateSessionAndInsertDB($id, $colorProductId, $productCurrent, $userId);

            } else {
                $valueCookie = time();
                Cookie::queue('cart', $valueCookie, 30 * 24 * 60);
                $cart = [];
                $cart[0]['product_id'] = $id;

                $colorProductNew = \DB::table('color_product')->where('id', $colorProductId)->first();
                $colorNameNew = Color::find($colorProductNew->color_id)->name;
                $cart[0]['color_product_name'] = $colorNameNew;
                $cart[0]['color_product_id'] = $colorProductId;
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

        $cartSend = $this->createOutputAjaxForCart($id, $cart, $productCurrent);

        return \Response::json($cartSend);
    }

    private function updateSessionAndInsertDB($productId, $colorProductId, $productCurrent, $userId)
    {
        $cart = Session::get('cart');
        for ($i = 0; $i < count($cart); $i++) {
            Cart::create([
                'user_id' => $userId,
                'product_id' => $cart[$i]['product_id'],
                'color_product_id' => $cart[$i]['color_product_id'],
                'myCookie' => $cart[$i]['myCookie'],
                'user_ip' => $cart[$i]['user_ip'],
                'number' => $cart[$i]['number'],
            ]);
        }

        $indxfind = '';
        $hasProductIdAndColorProductIdInArrayCart = false;
        for ($i = 0; $i < count($cart); $i++) {
            if ($cart[$i]['product_id'] == $productId && $cart[$i]['color_product_id'] == $colorProductId) {
                $indxfind = $i;
                $hasProductIdAndColorProductIdInArrayCart = true;
                break;
            }
        }

        if ($hasProductIdAndColorProductIdInArrayCart) {
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
            Cookie::queue('cart', $valueCookie, 30 * 24 * 60);

            $cart[$indexRow]['number'] = 1;
            $cart[$indexRow]['product_id'] = $productId;
            $cart[$indexRow]['color_product_id'] = $colorProductId;

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
                'color_product_id' => $colorProductId,
                'user_ip' => request()->ip(),
                'number' => $cart[$indexRow]['number'],
                'myCookie' => $valueCookie,
            ]);
        }
        Session::put('cart', $cart);


        \Cookie::queue(\Cookie::forget('cart'));
        Cookie::queue('cart', serialize($cart), 30 * 24 * 60);

        return $cart;
    }

    public function deleteCart($id)
    {
        $carts = [];
        $product_id = '';
        if (Session::has('cart')) {
            $carts = Session::get('cart');
            $product_id = $carts[$id]['product_id'];
            $color_product_id = $carts[$id]['color_product_id'];
            if (isset($carts[$id])) {

//                delete in DB
                $this->deleteCartRowInDB($product_id, $color_product_id);

//                delete in session
                unset($carts[$id]);
                $carts = array_values($carts);  //  reindex the keys
                \Cookie::forget('cart');
                Cookie::queue('cart', serialize($carts), 30 * 24 * 60);
            }
        } elseif (Cookie::has('cart')) {
            $carts = unserialize(stripslashes(Cookie::get('cart')));
            $product_id = $carts[$id]['product_id'];
            $color_product_id = $carts[$id]['color_product_id'];

//            delete in DB
            $this->deleteCartRowInDB($product_id, $color_product_id);

//            delete in cookie
            if (isset($carts[$id])) {
                unset($carts[$id]);
                $carts = array_values($carts);  //  reindex the keys
                \Cookie::queue(\Cookie::forget('cart'));
                Cookie::queue('cart', serialize($carts), 30 * 24 * 60);
            }

        } else {  //  in DB
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            Cart::truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            $carts = [];
        }

        if ($carts != null) {
            //  set session
            Session::put('cart', $carts);
        } else {    //  $cart is null
            if (Session::has('cart'))
                Session::forget('cart');
        }

        if ($carts != null) {
            $productCurrent = \DB::table('products')->where('id', $product_id)->first();
            $cartSend = $this->createOutputAjaxForCart($product_id, $carts, $productCurrent);
            return \Response::json($cartSend);

        } else {
            return $carts;  //  is empty
        }
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

    private function deleteCartRowInDB($product_id, $color_product_id)
    {
        $user = Auth::user();
        $userId = '';
        if ($user) {
            $userId = $user->id;
            $tableCartRowWithUser = \DB::table('carts')->where('user_id', $userId)->orWhere('user_ip', \request()->ip())
                ->where('product_id', $product_id)
                ->where('color_product_id', $color_product_id);
            if ($tableCartRowWithUser->exists()) {
                $tableCartRowWithUser->delete();
            }
        } else {
            $userId = null;

            $tableCartRowWithoutUser = \DB::table('carts')->where('user_ip', \request()->ip())
                ->where('product_id', $product_id)
                ->where('color_product_id', $color_product_id);;
            if ($tableCartRowWithoutUser->exists()) {
                $tableCartRowWithoutUser->delete();
            }
        }
    }

    private function createOutputAjaxForCart($id, array $cart, $productCurrent)
    {
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
                $cartSend[$i]['product_name'] = Str::limit($productOther->name, 25, '...');
                $cartSend[$i]['product_slug'] = $productOther->slug;
                $cartSend[$i]['product_image'] = $productOther->image;
                $cartSend[$i]['product_price'] = $productOther->price_main;
            } else {
                $cartSend[$i]['product_name'] = Str::limit($productCurrent->name, 25, '...');
                $cartSend[$i]['product_slug'] = $productCurrent->slug;
                $cartSend[$i]['product_image'] = $productCurrent->image;
                $cartSend[$i]['product_price'] = $productCurrent->price_main;
            }

            $cartSend[$i]['product_number'] = $cart[$i]['number'];
        }
        return $cartSend;
    }


}   //  end of class
