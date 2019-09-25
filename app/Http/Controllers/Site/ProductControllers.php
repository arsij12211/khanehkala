<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Site\UpdateCart;
use App\Product;
use App\PublicModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;

class ProductControllers extends Controller
{
    use UpdateCart;

    public function productMore($slug = null)
    {
        $updateallcarts = $this->updateAllCarts();
        $priceOfCarts = $updateallcarts[0];
        $numberOfCarts = $updateallcarts[1];

        $product = Product::where('slug', $slug)->first();
        if ($product) {
            $colors = $product->colors;
            $attributes = $product->attributes()->get();
            return view('front.productMore', compact('product', 'colors','attributes', 'numberOfCarts', 'priceOfCarts'));
        } else {
            return "این مجصول وجود ندارد.";
        }
    }
}
