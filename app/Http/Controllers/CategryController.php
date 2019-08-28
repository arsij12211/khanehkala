<?php

namespace App\Http\Controllers;

use App\Category;
use App\PublicModel;
use Illuminate\Http\Request;

class CategryController extends Controller
{
    public function show($name){
        $namecat=(new PublicModel)->name_format($name);
        return Category::query()->where('name','=',$namecat)->get();
    }
}
