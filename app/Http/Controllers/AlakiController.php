<?php

namespace App\Http\Controllers;

use App\Attribute;
use App\Category;
use App\Product;
use App\PublicModel;
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

        if ($myTable == null)
            return 'baby, myTable not exists!';

        if (Category::count() > 0) {

            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            Product::truncate();
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

            $slugName = (new PublicModel())->slug_format($item->name) . Str::random(3);
            $product = Product::create([
                'category_id' => $category->id,
                'name' => $item->name,
                'image' => $item->image,
                'price_main' => $item->price_main,
                'number' => $item->number,
                'slug' => $slugName,
            ]);

            $product->colors()->attach(2, [
                'number' => 10,
            ]);

            $product->colors()->attach(3, [
                'number' => 10,
            ]);

            $product->update([
                'number' => 20,
            ]);

            $i++;
        }

        Attribute::create([
            'category_id' => 14,
            'key' => 'ram',
        ]);

        Attribute::create([
            'category_id' => 14,
            'key' => 'ظرفیت',
        ]);

        Attribute::create([
            'category_id' => 14,
            'key' => 'رزولوشن عکس',
        ]);

        if ($product = Product::find(14)) {
            $product->attributes()->attach(1, [
                'value' => '4 GiB',
            ]);
            $product->attributes()->attach(2, [
                'value' => '128 GiB',
            ]);
            $product->attributes()->attach(3, [
                'value' => '24 مگاپیکسل',
            ]);
        }

        return "Done";
    }

    public function getTestAccessor()
    {
        $p = Product::find(14);
        return $p->is_number_and_price_product;
    }
}
