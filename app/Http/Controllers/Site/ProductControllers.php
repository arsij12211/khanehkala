<?php

namespace App\Http\Controllers\Site;

use App\Models\Product;
use App\Models\PublicModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductControllers extends Controller
{
    public function productMore($slug = null)
    {

        $product = Product::where('slug', $slug)->first();

        return view('front.productMore', compact('product'));
    }
}
