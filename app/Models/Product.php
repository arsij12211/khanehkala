<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable=['category_id', 'name', 'image', 'details', 'price_main', 'price_off', 'special', 'slug', 'active', 'position', 'totalSelling', 'latest', 'totalVisited', 'number'];

//    public function getRouteKeyName()
//    {
//        return 'slug';
//    }
}
