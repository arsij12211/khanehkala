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


        return view('front.productMore', compact('product', 'numberOfCarts', 'priceOfCarts'));
    }
}
