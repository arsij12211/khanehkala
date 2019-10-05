<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductAttr extends Model
{
    protected $fillable = ['product_id', 'wholesale_price', 'number', 'minimal_number'];

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'attribute_productattr')->withPivot(['id'])->withTimestamps();
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
