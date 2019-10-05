<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id', 'name', 'details', 'price_main', 'number', 'slug', 'meta_title', 'meta_keyword', 'meta_description', 'type', 'active', 'active_special', 'totalSelling', 'totalVisited',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getIsNumberAndPriceProductAttribute()
    {
        $flag = false;
        if ($this->number > 0 && $this->price_main != '0') {
            $flag = true;
        }
        return $flag . '';
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function productAttrs()
    {
        return $this->hasMany(ProductAttr::class);
    }
}
