<?php

namespace App;

//use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
//    use Sluggable;

    protected $fillable = ['category_id', 'name', 'image', 'details', 'price_main', 'price_off', 'special', 'slug', 'active', 'position', 'totalSelling', 'latest', 'totalVisited', 'number'];

//    public function getRouteKeyName()
//    {
//        return 'slug';
//    }

//    public function sluggable()
//    {
//        return [
//            'slug' => [
//                'source' => 'name'
//            ]
//        ];
//    }
}
