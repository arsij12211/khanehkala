<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['category_id', 'name', 'image', 'details', 'price_main', 'special', 'slug', 'active', 'position', 'totalSelling', 'latest', 'totalVisited', 'number'];

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
        return $flag.'';
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function colors()
    {
        return $this->belongsToMany(Color::class, 'color_product')->withPivot(['id', 'number'])->withTimestamps();
    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'attribute_product')->withPivot(['id', 'value'])->withTimestamps();
    }
}
