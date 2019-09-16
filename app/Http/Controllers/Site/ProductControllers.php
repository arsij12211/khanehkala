<?php

namespace App\Http\Controllers\Site;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductControllers extends Controller
{
    public function productMore($slug=null)
    {
        $product=Product::find($slug);
        $product1=Product::find(1);
        dd($product1);
        return view('front.productMore');
    }
}
