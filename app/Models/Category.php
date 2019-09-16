<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable=['name', 'creator', 'parent_id', 'icon',];

   public function childs(){
       return $this->hasMany('App\Models\Category','parent_id');
   }

}
