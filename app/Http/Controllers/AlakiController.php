<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AlakiController extends Controller
{
    public function convertMyTableToProducts()
    {
        set_time_limit(3600);
        $myTable = \DB::table('mytable')->get();
//        dd(Category::count());

        if (Category::count() > 0) {
            Product::truncate();

            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            Category::truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }
//        dd("s");
        $i = 0;
        foreach ($myTable as $item) {

            $category = Category::create([
                'name' => $item->category,
                'parent_id' => 0,
            ]);

            $product = Product::create([
                'category_id' => $category->id,
                'name' => $item->name,
                'image' => $item->image,
                'price_main' => $item->price_main,
                'price_off' => $item->price_off,
                'slug' => Str::slug($item->name) . $i,
                'position' => $item->position,
                'number' => $item->number,
            ]);

            $i++;
        }
        return "Done";

    }
}
