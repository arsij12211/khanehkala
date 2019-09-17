<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('front.main');
})->name('urlMain');

Route::group(['prefix' => '/', 'namespace' => 'Site'], function () {
    // product
    Route::get('/productMore/{slug?}', 'ProductControllers@productMore')->name('productMore');

    // shop
    Route::get('/addcart/{id}', 'ShopControllers@addcart')->name('addcart');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


//================================Alaki Controller==============================
Route::get('/convert', 'AlakiController@convertMyTableToProducts')->name('convert');


//==============================================================================
Route::get('/clear-cache', function () {
//    $exitCode = Artisan::call('optimize');
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('view:clear');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    return 'DONE'; //Return anything
});

//==============================================================================


// categories route
Route::get('cat/{name}', 'CategryController@show')->name('category.show');

//end categories route

//  Shop routes

//  end of Shop routes

//************************************ADMIN ROUTE **********************
Route::middleware(['admin'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('', function () {
            return view('admin.layouts.main');
        });


        //category resource
        Route::resource('admincategory', 'AdminCategoryController')->only([
            'create', 'show', 'store'
        ]);


        //end category resource


    });
});


//************************************ END ADMIN ROUTE **********************