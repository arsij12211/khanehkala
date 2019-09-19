<?php

namespace App\Http\Controllers;

use App\Category;
use App\PublicModel;
use Illuminate\Http\Request;

class AdminCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:categories',
            'parent_id' => 'required',
            'icon'=>'nullable|image'
        ],['name.required'=>'نام دسته الزامی می باشد!','name.unique'=>'این نام قبلا ثبت شد!','icon.image'=>'فایل آیکن تصویر نمی باشد!']);

        $category=new Category();
        if (isset($request->icon)){
            $category->icon=(new PublicModel())->image($request,'public/assets/img/product','icon');
        }
        $category->name=$request->name;
        $category->parent_id=$request->parent_id;

        if ($category->save()){
            session()->flash('alert','<div class="alert alert-success">دسته جدید با موفقیت ثبت شد!</div>');
            return back();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category=Category::query()->find($id);
        return view('admin.category.show',['category'=>$category]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
